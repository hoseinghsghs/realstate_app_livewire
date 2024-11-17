<?php

namespace App\Livewire\Admin\Property;

use App\Models\Feature;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Livewire\Forms\CreatPropertyForm;
use Livewire\WithPagination;

class PropertyComponent extends Component
{
    use  WithPagination;
    protected $paginationTheme = 'bootstrap';

    public CreatPropertyForm $form;
    public $tr_type;
    public $type;
    public $district;
    public $doc;
    public $floorsell;
    public $bedroom;
    public $search;
    public $code;
    public $features;
    public $price_range;
    public $rahn_range;
    public $meter_range;
    public $user_id;
    public $usertype;
    public $rent_range;
    public $featuresco;

    public function render()
    {

        $properties = Property::with('user')->when($this->user_id, function ($query, $user_id) {
            return $query->where('user_id', $this->user_id);
        })->when($this->tr_type, function ($query, $tr_type) {
            return $query->where('tr_type', $this->tr_type);
        })->when($this->usertype, function ($query, $usertype) {
            return $query->where('usertype', $this->usertype);
        })->when($this->type, function ($query, $type) {
            return $query->where('type', $this->type);
        })->when($this->district, function ($query, $district) {
            return $query->where('district', $this->district);
        })->when($this->search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $this->search . '%')->orWhere('address', 'like', '%' . $this->search . '%');
        })->when($this->tr_type === 'فروش' && $this->price_range, function ($query) {
            $this->price_range = array_map('intval', explode(';', $this->price_range));
            return $query->whereBetween('bidprice', $this->price_range);
        })->when($this->tr_type === 'رهن و اجاره' && $this->rahn_range, function ($query) {
            $rahn_range = array_map('intval', explode(';', $this->rahn_range));
            return $query->whereBetween('rahn', $this->rahn_range);
        })->when($this->tr_type === 'رهن و اجاره' && $this->rent_range, function ($query) {
            $rent_range = array_map('intval', explode(';', $this->rent_range));
            return $query->whereBetween('rent', $this->rent_range);
        })->when($this->meter_range, function ($query, $meter_range) {
            $this->meter_range = array_map(function ($value) {
                return (int) $value;
            }, explode(';', $this->meter_range));
            return $query->whereBetween('meter', $this->meter_range);
        })->when($this->bedroom, function ($query, $bedroom) {
            return $query->where('bedroom', $bedroom);
        })->when($this->floorsell, function ($query, $floorsell) {
            return $query->where('floorsell', $this->floorsell);
        })->when($this->code, function ($query, $code) {
            return $query->where('code', $this->code);
        })->when($this->doc, function ($query, $doc) {
            return $query->where('doc', $this->doc);
        })->when($this->features, function ($query, $features) {
            return $query->whereHas('features', function ($query) use ($features) {
                $query->whereIn('features.id', $this->featuresco->pluck('id'));
            });
        })->withCount('images')->latest()->paginate(10)->withQueryString();

        $this->featuresco = $featuresco = Feature::latest()->get();
        $propertyAgent = Property::where('user_id', Auth::user()->id)->latest()->paginate(10);
        $districts = Property::all()->unique('district')->pluck('district');
        return view('livewire.admin.property.property-component', compact('properties', 'featuresco', 'districts'))->extends('admin.layout.MasterAdmin')->section('Content');
    }
}
