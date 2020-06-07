<?php

namespace App\Http\Controllers\Admin;

use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class ProfileController extends Controller
{

    public function profile()
    {
        return view('admin.profile.edit');
    }

    public function profileupdate(Request $request)
    {

        $messages = [
            'name.required' => 'Ad Soyad zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000'
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/users/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/users/temp/' . $filename);
            $image_resize->fit(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/users/' . $filename));

            $image_thumb_resize = Image::make(public_path() . '/upload/users/temp/' . $filename);
            $image_thumb_resize->fit(50, 50);
            $image_thumb_resize->save(public_path('/upload/users/thumb/' . $filename), 100);

            @unlink(public_path('/upload/users/temp/' . $filename));

            $user = Users::Where('id', Auth::user()->id)->update([
                "name" => $request->name,
                "image" => $filename
            ]);

            @unlink(public_path('/upload/users/' . $request->old_image));
            @unlink(public_path('/upload/users/thumb/' . $request->old_image));

        } else {
            $user = Users::Where('id', Auth::user()->id)->update([
                "name" => $request->name,
            ]);
        }

        if ($user) {
            return back()->with('success', 'Profil güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Profil güncelleme işlemi gerçekleştirilemedi.');

    }

    public function profilepassword()
    {
        return view('admin.password.edit');
    }

    public function profilepasswordupdate(Request $request)
    {
        $messages = [
            'current_password' => 'Mevcut parolanız doğru değil!',
            'current_password.required' => 'Mevcut parola zorunludur!',
            'password' => 'Yeni parola zorunludur!',
            'password_confirmation' => 'Yeni parola tekrarı zorunludur!',
            'password.confirmed' => 'Parolalar eşleşmiyor!',
        ];

        $validator = Validator::make($request->all(), [
            'current_password' => 'current_password',
            'password' => 'required|confirmed|min:6'
        ], $messages)->validate();

        $user = Users::Where('id', Auth::user()->id)->update([
            "password" => Hash::make($request->password),
        ]);

        if ($user) {
            return back()->with('success', 'Parola güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Parola güncelleme işlemi gerçekleştirilemedi.');


    }

}
