<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SettingController extends Controller
{

    public function setting()
    {
        $settings = Settings::where('id', 1)->first();
        return view('admin.setting.edit')->with('settings', $settings);
    }

    public function settingupdate(Request $request)
    {
//        dd($request->all());

        empty($request->status) ? $status = '0' : $status = '1';
        empty($request->noindex) ? $noindex = '0' : $noindex = '1';

        $messages = [
            'url.required' => 'Web sitesi adresi zorunludur!',
            'title.required' => 'Site başlığı zorunludur!',
            'description.required' => 'Site açıklaması zorunludur!',
            'seo_description.required' => 'Seo açıklaması zorunludur!',
            'twitter.required' => 'Twitter kullanıcı adı zorunludur!',
            'facebook.required' => 'Facebook sayfa adı zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'url' => 'required',
            'title' => 'required',
            'description' => 'required',
            'seo_description' => 'required',
            'twitter' => 'required',
            'facebook' => 'required',
        ], $messages)->validate();

        $setting = Settings::Where('id', 1)->update([
            "url" => $request->url,
            "title" => $request->title,
            "status" => $status,
            "description" => $request->description,
            "address" => $request->address,
            "telephone" => $request->telephone,
            "fax" => $request->fax,
            "email" => $request->email,
            "map" => $request->map,
            "analytics" => $request->analytics,
            "noindex" => $noindex,
            "seo_description" => $request->seo_description,
            "twitter" => $request->twitter,
            "facebook" => $request->facebook
        ]);

        if ($setting) {
            return back()->with('success', 'Genel ayarlar başarılı olarak güncelleştirildi.');
        }
        return back()->with('error', 'Genel ayarlar güncelleştirilemedi.');
    }

}
