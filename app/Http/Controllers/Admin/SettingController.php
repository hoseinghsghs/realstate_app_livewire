<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $settings = Setting::findOrNew(1);
        $settings['phone'] = json_decode($settings->phone);
        $settings['email'] = json_decode($settings->email);
        $settings['links'] = json_decode($settings->links);
        return view('admin.page.settings.setting', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, ToastrFactory $flasher)
    {
        if ($request->has('email')) {
            $request['email'] = json_encode($request->email);
        }
        if ($request->has('phone')) {
            $request['phone'] = json_encode($request->phone);
        }
        if ($request->has('links')) {
            $links = array_map(function ($value) {
                return array_merge(...$value);
            }, array_chunk($request->get('links'), 2));
            $request['links'] = json_encode($links);
        }
        $data = $request->except('_token');
        $request->mergeIfMissing(['email' => null, 'phone' => null, 'links' => null]);

        if ($request->hasFile('icon')) {
            Storage::deleteDirectory('icon');
            $path = $request->icon->store('icon');
            $data['icon'] = $path;
        }
        Setting::updateOrCreate(['id' => 1], $data);
        $flasher->addSuccess('تغییرات با موفقیت ذخیره شد');
        return back();
    }
}
