<?php

namespace App\Livewire\Home\Pages;

use App\Models\Feature;
use App\Models\Property;
use Livewire\Attributes\Url;
use Livewire\Component;

class PropertyList extends Component
{
    #[Url]
    public $deal_type = '';
    #[Url]
    public $property_type = '';
    #[Url]
    public $district = '';
//    public $user_type = '';
    public $user_id = '';

    public $filter = ['deal_type'   => '', 'property_type' => '', 'user_type' => '', 'search' => '', 'district' => '',
                      'price_range' => [],
                      'rent_range'  => [], 'rahn_range' => [], 'meter_range' => [], 'bedroom' => '', 'floor' => '',
                      'code'        => '', 'docType' => '', 'features' => []];
    /*public $filter_deal_type = '';
    public $filter_property_type = '';
    public $filter_district = '';
    public $search = '';
    public $filter_price_range = [];
    public $filter_rent_range = [];
    public $filter_rahn_range = [];
    public $filter_meter_range = [];
    public $bedroom = '';
    public $floor = '';
    public $code = '';
    public $docType = '';
    public $features = [];*/
    public $all_features;
    public $all_districts;
    public $price_range = [];
    public $rent_range = [];
    public $rahn_range = [];
    public $meter_range = [];

    private function getMinMaxOfColumn($column, $defaultMax)
    {

        $min_value = Property::min($column);
        $max_value = Property::max($column);
        $min_value = 10 ** floor(log10($min_value));
        if ($max_value)
            $max_value = 10 ** (ceil(log10($max_value)));
        else
            $max_value = $defaultMax;
        // if max and min value was same set zero for min
        if ($max_value===$min_value){
            $min_value=0;
        }
        return [$min_value, $max_value];
    }

    public function mount()
    {
        $this->all_features = Feature::all();
        $this->all_districts = Property::all()->unique('district')->pluck('district');

        if ($this->deal_type)
            $this->filter['deal_type'] = $this->deal_type;
        if ($this->property_type)
            $this->filter['property_type'] = $this->property_type;
        if ($this->district)
            $this->filter['district'] = $this->district;

        $this->meter_range = $this->getMinMaxOfColumn('meter', 5000);
        $this->rahn_range = $this->getMinMaxOfColumn('rahn', 1000000000);
        $this->rent_range = $this->getMinMaxOfColumn('rent', 500000000);
        $this->price_range = $this->getMinMaxOfColumn('bidprice', 90000000000);
    }

    public function search_properties()
    {
        dd($this->deal_type);
    }

    public function render()
    {
        $properties = Property::with('user')->active()->when($this->user_id, function ($query) {
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
        })->when($this->filter['deal_type'] === 'فروش' && count($this->filter['price_range']) === 2, function ($query) {
            return $query->whereBetween('bidprice', $this->filter['price_range']);
        })->when($this->filter['deal_type'] === 'رهن و اجاره' && count($this->filter['rahn_range']) === 2,
            function ($query) {
                return $query->whereBetween('rahn', $this->filter['rahn_range']);
            })->when($this->filter['deal_type'] === 'رهن و اجاره' && count($this->filter['rent_range']) === 2,
            function ($query) {
                return $query->whereBetween('rent', $this->filter['rent_range']);
            })->when($this->filter['meter_range'] && count($this->filter['meter_range']) === 2, function ($query) {
            return $query->whereBetween('meter', $this->filter['meter_range']);
        })->when($this->filter['bedroom'], function ($query) {
            return $query->where('bedroom', $this->filter['bedroom']);
        })->when($this->filter['floor'], function ($query) {
            return $query->where('floorsell', $this->filter['floor']);
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

        return view('livewire.home.pages.properties-list',
            ['properties' => $properties, 'all_features' => $this->all_features,
             'districts'  => $this->all_districts])->extends('home.layout.HomeLayout');
    }
}
