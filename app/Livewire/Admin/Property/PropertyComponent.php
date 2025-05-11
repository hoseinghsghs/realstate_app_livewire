<?php

namespace App\Livewire\Admin\Property;

use App\Models\Feature;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Livewire\Forms\CreatPropertyForm;
use Livewire\WithPagination;

class PropertyComponent extends Component
{
    use  WithPagination;
    public $numberOfPaginatorsRendered = [];
    protected $paginationTheme = 'bootstrap';

    public $tr_type;
    public $type;
    public $district;
    public $doc;
    public $bedroom;
    public $search;
    public $code;
    public $features = [];
    public $floor_range = [1, 5];
    public $deal_floor_range = [1, 5];
    public $meter_range;
    public $price_range;
    public $rahn_range;
    public $rent_range;
    public $usertype;
    public $all_features;
    public $all_districts;

    private function getMinMaxOfColumn($column, $defaultMax): array
    {

        $values = Property::whereNotNull($column)->pluck($column)->map(fn($value) => (int)$value);

        if ($values->isEmpty()) {
            return [0, $defaultMax];
        }

        $min_value = $values->min();
        $max_value = $values->max();

        $min_value = (int)(10 ** floor(log10($min_value)));
        $max_value = (int)(10 ** ceil(log10($max_value)));

        // if max and min value are the same, set zero for min
        if ($max_value <= $min_value) {
            $min_value = 0;
        }

        return [$min_value, $max_value];
    }

    public function mount()
    {
        $this->all_features = Feature::all();
        $this->all_districts = Property::active()->get()->unique('district')->pluck('district');

        $this->meter_range = $this->getMinMaxOfColumn('meter', 5000);
        $this->rahn_range = $this->getMinMaxOfColumn('rahn', 1000000000);
        $this->rent_range = $this->getMinMaxOfColumn('rent', 500000000);
        $this->price_range = $this->getMinMaxOfColumn('bidprice', 90000000000);

        // get the maximum floors of properties
        $m_floors = Property::max("floor");
        if ($m_floors > $this->floor_range[1]) {
            $this->floor_range[1] = (int)$m_floors;
            $this->deal_floor_range[1] = (int)$m_floors;
        }
    }

    public function render()
    {
        $properties = Property::with('user')->whereBetween(DB::raw('CAST(floor AS SIGNED)'), $this->floor_range)
            ->when(count($this->deal_floor_range) === 2, function ($query) {
                return $query->whereHas('floors_sell', function ($query) {
                    $query->whereBetween(DB::raw('CAST(floor AS SIGNED)'), $this->deal_floor_range);
                });
            })->when(Auth::user()->role->id == 2, function ($query) {
                return $query->where('user_id', Auth::user()->id);
            })->when($this->tr_type, function ($query, $tr_type) {
                return $query->where('tr_type', $this->tr_type);
            })->when($this->usertype, function ($query, $usertype) {
                return $query->where('usertype', $this->usertype);
            })->when($this->type, function ($query, $type) {
                return $query->where('type', $this->type);
            })->when($this->district, function ($query, $district) {
                return $query->where('district', $this->district);
            })->when($this->search, function ($query, $search) {
                return $query->whereAny(['title', 'address'], 'like', '%' . $this->search . '%');
            })->when($this->tr_type === 'فروش' && count($this->price_range) == 2, function ($query) {
                return $query->whereBetween(DB::raw('CAST(bidprice AS SIGNED)'), $this->price_range);
            })->when($this->tr_type === 'رهن و اجاره' && count($this->rahn_range) === 2, function ($query) {
                return $query->whereBetween(DB::raw('CAST(rahn AS SIGNED)'), $this->rahn_range);
            })->when($this->tr_type === 'رهن و اجاره' && count($this->rent_range) === 2, function ($query) {
                return $query->whereBetween(DB::raw('CAST(rent AS SIGNED)'), $this->rent_range);
            })->when(count($this->meter_range) === 2, function ($query, $meter_range) {
                return $query->whereBetween(
                    DB::raw('CAST(meter AS SIGNED)'),
                    $this->meter_range
                );
            })->when($this->bedroom, function ($query, $bedroom) {
                return $query->where('bedroom', $bedroom);
            })->when($this->code, function ($query, $code) {
                return $query->where('code', $this->code);
            })->when($this->doc, function ($query, $doc) {
                return $query->where('doc', $this->doc);
            })->when($this->features, function ($query) {
                foreach ($this->features as $featureId) {
                    $query->whereHas('features', function ($query) use ($featureId) {
                        $query->where('features.id', $featureId);
                    });
                }
                return $query;
            })->withCount('images')->latest()->paginate(10)->withQueryString();;

        return view('livewire.admin.pages.property.property-component', compact('properties'))
            ->extends('livewire.admin.layout.MasterAdmin')->section('Content');
    }
}
