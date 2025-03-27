<?php

namespace App\Livewire\Home\Pages;

use App\Models\Feature;
use App\Models\Property;
use Livewire\Attributes\Url;
use Livewire\Component;
use Staudenmeir\EloquentEagerLimit\Builder;

class PropertiesList extends Component
{
    #[Url]
    public $deal_type = '';
    #[Url]
    public $property_type = '';
    #[Url]
    public $district = '';
    //    public $user_type = '';
    public $user_id = '';

    public $filter = [
        'deal_type'        => '',
        'property_type' => '',
        'user_type' => '',
        'search' => '',
        'district'         => '',
        'price_range'      => [],
        'rent_range'       => [],
        'rahn_range' => [],
        'meter_range' => [],
        'floor_range' => [1, 5],
        'floor_sell_range' => [1, 5],
        'bedroom' => '',
        'code'             => '',
        'docType' => '',
        'features' => []
    ];
    public $all_features;
    public $all_districts;

    private function getMinMaxOfColumn($column, $defaultMax): array
    {
        $min_value = Property::min($column);
        $max_value = Property::max($column);
        $min_value = (int)(10 ** floor(log10($min_value)));
        if ($max_value)
            $max_value = (int)(10 ** (ceil(log10($max_value))));
        else
            $max_value = $defaultMax;
        // if max and min value was same set zero for min
        if ($max_value === $min_value) {
            $min_value = 0;
        }
        return [$min_value, $max_value];
    }

    public function mount()
    {
        $this->all_features = Feature::all();
        $this->all_districts = Property::active()->get()->unique('district')->pluck('district');

        if ($this->deal_type)
            $this->filter['deal_type'] = $this->deal_type;
        if ($this->property_type)
            $this->filter['property_type'] = $this->property_type;
        if ($this->district)
            $this->filter['district'] = $this->district;

        $this->filter["meter_rang"] = $this->getMinMaxOfColumn('meter', 5000);
        $this->filter["rahn_range"] = $this->getMinMaxOfColumn('rahn', 1000000000);
        $this->filter["rent_range"] = $this->getMinMaxOfColumn('rent', 500000000);
        $this->filter["price_range"] = $this->getMinMaxOfColumn('bidprice', 90000000000);
        // get the maximum floors of properties
        $m_floors = Property::max("floor");
        if ($m_floors > $this->filter["floor_range"][1]) {
            $this->filter["floor_range"][1] = (int)$m_floors;
            $this->filter["floor_sell_range"][1] = (int)$m_floors;
        }
    }

    public function render()
    {
        $properties = Property::with('user')->active()->whereBetween("floor", $this->filter["floor_range"])
            ->when(count($this->filter['floor_sell_range']) === 2, function ($query) {


                $query->whereHas('floors_sell', function ($query) {
                    $query->whereBetween('floor', $this->filter['floor_sell_range']);
                });


                return $query;
            })
            ->when($this->user_id, function ($query) {
                return $query->where('user_id', $this->user_id);
            })->when($this->filter['deal_type'], function ($query) {
                return $query->where('tr_type', $this->filter['deal_type']);
            })->when($this->filter['user_type'], function ($query) {
                return $query->where('usertype', $this->filter['user_type']);
            })->when($this->filter['property_type'], function ($query) {
                return $query->where('type', $this->filter['property_type']);
            })->when($this->filter['district'], function ($query) {
                return $query->where('district', $this->filter['district']);
            })->when($this->filter['search'], function ($query) {
                return $query->whereAny(['title', 'address'], 'like', '%' . $this->filter['search'] . '%');
            })->when(
                $this->filter['deal_type'] === 'فروش' && count($this->filter['price_range']) === 2,
                function ($query) {
                    return $query->whereBetween('bidprice', $this->filter['price_range']);
                }
            )->when(
                $this->filter['deal_type'] === 'رهن و اجاره' && count($this->filter['rahn_range']) === 2,
                function ($query) {
                    return $query->whereBetween('rahn', $this->filter['rahn_range']);
                }
            )->when(
                $this->filter['deal_type'] === 'رهن و اجاره' && count($this->filter['rent_range']) === 2,
                function ($query) {
                    return $query->whereBetween('rent', $this->filter['rent_range']);
                }
            )->when($this->filter['meter_range'] && count($this->filter['meter_range']) === 2, function ($query) {
                return $query->whereBetween('meter', $this->filter['meter_range']);
            })->when($this->filter['bedroom'], function ($query) {
                return $query->where('bedroom', $this->filter['bedroom']);
            })->when($this->filter['code'], function ($query) {
                return $query->where('code', $this->filter['code']);
            })->when($this->filter['docType'], function ($query) {
                return $query->where('doc', $this->filter['docType']);
            })->when(count($this->filter['features']) > 0, function ($query) {
                foreach ($this->filter['features'] as $featureId) {
                    $query->whereHas('features', function ($query) use ($featureId) {
                        $query->where('features.id', $featureId);
                    });
                }
                return $query;
            })->withCount('images')->latest()->paginate(6);

        return view(
            'livewire.home.pages.properties-list',
            [
                'properties' => $properties,
                'all_features' => $this->all_features,
                'districts'  => $this->all_districts
            ]
        )->extends('home.layout.HomeLayout');
    }
}
