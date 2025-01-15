<?php

namespace App\Livewire\Home\Pages;

use App\Models\Feature;
use App\Models\Property;
use Livewire\Attributes\Url;
use Livewire\Component;

class PropertyList extends Component
{
    #[Url]
    public $user_id = '';
    #[Url]
    public $tr_type = '';
    #[Url]
    public $user_type = '';
    #[Url]
    public $type = '';
    #[Url]
    public $search = '';
    #[Url]
    public $district = '';
    #[Url]
    public $price_range = '';
    #[Url]
    public $rent_range = '';
    #[Url]
    public $rahn_range = '';
    #[Url]
    public $meter_range = '';
    #[Url]
    public $bedroom = '';
    #[Url]
    public $floorsell = '';
    #[Url]
    public $code = '';
    #[Url]
    public $doc = '';
    #[Url]
    public $features = '';

    public function render()
    {
        $properties = Property::with('user')->active()->when($this->user_id, function ($query, $user_id) {
            return $query->where('user_id', $user_id);
        })->when($this->tr_type, function ($query, $tr_type) {
            return $query->where('tr_type', $tr_type);
        })->when($this->user_type, function ($query, $usertype) {
            return $query->where('usertype', $usertype);
        })->when($this->type, function ($query, $type) {
            return $query->where('type', $type);
        })->when($this->district, function ($query, $district) {
            return $query->where('district', $district);
        })->when($this->search, function ($query, $search) {
            return $query->whereAny(['title', 'address'], 'like', '%' . $search . '%');
        })->when($this->tr_type === 'فروش' && $this->price_range, function ($query) {
            $price_range = array_map('intval', explode(';', $this->price_range));
            return $query->whereBetween('bidprice', $price_range);
        })->when($this->tr_type === 'رهن و اجاره' && $this->rahn_range, function ($query) {
            $rahn_range = array_map('intval', explode(';', $this->rahn_range));
            return $query->whereBetween('rahn', $rahn_range);
        })->when($this->tr_type === 'رهن و اجاره' && $this->rent_range, function ($query) {
            $rent_range = array_map('intval', explode(';', $this->rent_range));
            return $query->whereBetween('rent', $rent_range);
        })->when($this->meter_range, function ($query, $meter_range) {
            $meter_range = array_map(function ($value) {
                return (int)$value;
            }, explode(';', $meter_range));
            return $query->whereBetween('meter', $meter_range);
        })->when($this->bedroom, function ($query) {
            return $query->where('bedroom', $this->bedroom);
        })->when($this->floorsell, function ($query) {
            return $query->where('floorsell', $this->floorsell);
        })->when($this->code, function ($query) {
            return $query->where('code', $this->code);
        })->when($this->doc, function ($query) {
            return $query->where('doc', $this->doc);
        })->when($this->features, function ($query) {
            foreach ($this->features as $featureId) {
                $query->whereHas('features', function ($query) use ($featureId) {
                    $query->where('features.id', $featureId);
                });
            }
            return $query;
        })->withCount('images')->latest()->paginate(6);

        $all_features = Feature::all();
        $districts = Property::all()->unique('district')->pluck('district');

        return view('livewire.home.pages.properties-list',compact('properties','all_features','districts'))->extends('home.layout.HomeLayout');
    }
}
