<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:settings_read'])->only('index');
        $this->middleware(['permission:settings_create'])->only('create');
        $this->middleware(['permission:settings_update'])->only('edit');
        $this->middleware(['permission:settings_delete'])->only('destroy');
    }

    public function index()
    {
        $title = trans('site.settings');
        return view('dashboard.setting.index', compact('title'));
    }

    public function update(Request $request, Setting $setting)
    {
        $validation = Validator::make($request->all(), [
            'site_name_ar' => 'required',
            'site_name_en' => 'required',
            'email' => 'required|email',
            'logo' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif',
            'icon' => 'sometimes|nullable|image|mimes:png,jpg,jpeg,gif',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data = $request->except(['logo', 'icon']);

        if ($request->logo) {

            if ($setting->logo != 'logo.jpg') {
                Storage::disk('public_uploads')->delete('/setting_image/' . $setting->logo);
            }

            Image::make($request->logo)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/setting_image/' . $request->logo->getClientOriginalName()));

            $data['logo'] = $request->logo->getClientOriginalName();

        }

        if ($request->icon) {

            if ($setting->icon != 'icon.jpg') {
                Storage::disk('public_uploads')->delete('/setting_image/' . $setting->icon);
            }

            Image::make($request->icon)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/setting_image/' . $request->icon->getClientOriginalName()));

            $data['icon'] = $request->icon->getClientOriginalName();

        }

        $setting->update($data);

        session()->flash('success', trans('site.data_updated_successfully'));
        return redirect()->back();
    }
}
