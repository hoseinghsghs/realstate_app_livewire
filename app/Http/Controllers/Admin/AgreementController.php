<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agreement;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgreementRequest;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Storage;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agreements = Agreement::latest()->paginate(10);
        return view('admin.page.agreements.index', compact('agreements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.agreements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAgreementRequest $request, ToastrFactory $flasher)
    {
        $data = $request->safe()->except(['images']);
        $images = $request->safe()->only(['images']);

        $agreement = Agreement::create($data);
        //upload images
        if (count($images) > 0) {
            $paths = [];
            foreach ($images['images'] as $image) {
                $path = $image->store('agreement');
                $paths[] = ['url' => $path];
            }
            $agreement->images()->createMany($paths);
        }

        $flasher->addSuccess('قرارداد با موفقیت ثبت شد');
        return redirect()->route('admin.agreements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function show(Agreement $agreement)
    {
        $images = $agreement->images;
        return view('admin.page.agreements.show', compact('agreement','images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit(Agreement $agreement)
    {
        $images = $agreement->images;
        return view('admin.page.agreements.edit', compact('agreement', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAgreementRequest $request, Agreement $agreement, ToastrFactory $flasher)
    {
        $images = $request->safe()->only(['images']);
        $data = $request->safe()->except(['images']);
        if ($data['agreement_type'] === 'sale') {
            $data['start_date'] = null;
            $data['end_date'] = null;
            $data['rent_term'] = null;
            $data['mortgage_price'] = null;
            $data['rent_price'] = null;
        } else {
            $data['sell_price'] = null;
        }
        $agreement->update($data);
        //upload images
        if (count($images) > 0) {
            $paths = [];
            foreach ($images['images'] as $image) {
                $path = $image->store('agreement');
                $paths[] = ['url' => $path];
            }
            $agreement->images()->createMany($paths);
        }

        $flasher->addSuccess('تغییرات با موفقیت ذخیره شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agreement  $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agreement $agreement, ToastrFactory $flasher)
    {   
        //delete images
        $images = $agreement->images;
        if (count($images) > 0) {
            foreach ($images as $image) {
                Storage::delete($image->url);
            }
            $agreement->images()->delete();
        }

        $agreement->delete();
        $flasher->addSuccess('قولنامه با موفقیت حذف شد');
        return redirect()->route('admin.agreements.index');
    }
}