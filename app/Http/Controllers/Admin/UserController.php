<?php

namespace App\Http\Controllers\Admin;

use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['user'] = Users::all()->sortBy('id');
        return view('admin.user.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        empty($request->status) ? $status = '0' : $status = '1';
        empty($request->role) ? $role = '0' : $role = '1';
//       dd($request->all());

        $messages = [
            'name.required' => 'Ad Soyad zorunludur!',
            'email.required' => 'E-posta zorunludur!',
            'password.required' => 'Parola zorunludur!',
            'password.confirmed' => 'Parolalar eşleşmiyor!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000'
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/users/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/users/temp/' . $filename);
            $image_resize->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/users/' . $filename));

            $image_thumb_resize = Image::make(public_path() . '/upload/users/temp/' . $filename);
            $image_thumb_resize->fit(50, 50);
            $image_thumb_resize->save(public_path('/upload/users/thumb/' . $filename), 100);

            @unlink(public_path('/upload/users/temp/' . $filename));

        } else {
            $filename = null;
        }

        $user = Users::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "image" => $filename,
            "status" => $status,
            "role" => $role
        ]);
        $user->save();

        if ($user) {
            return redirect(route('user.index'))->with('success', 'Kullanıcı ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Kullanıcı ekleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Users::where('id', $id)->first();
        return view('admin.user.edit')->with('user', $user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        empty($request->status) ? $status = '0' : $status = '1';
        empty($request->role) ? $role = '0' : $role = '1';
//      dd($request->all());

        $messages = [
            'name.required' => 'Ad Soyad zorunludur!',
            'email.required' => 'E-posta zorunludur!',
            'password.required' => 'Parola zorunludur!',
            'password.confirmed' => 'Parolalar eşleşmiyor!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed|min:6',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000'
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/users/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/users/temp/' . $filename);
            $image_resize->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/users/' . $filename));

            $image_thumb_resize = Image::make(public_path() . '/upload/users/temp/' . $filename);
            $image_thumb_resize->fit(50, 50);
            $image_thumb_resize->save(public_path('/upload/users/thumb/' . $filename), 100);

            @unlink(public_path('/upload/users/temp/' . $filename));

            $user = Users::Where('id', $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "image" => $filename,
                "status" => $status,
                "role" => $role
            ]);

            @unlink(public_path('/upload/users/' . $request->old_image));
            @unlink(public_path('/upload/users/thumb/' . $request->old_image));

        } else {
            $user = Users::Where('id', $id)->update([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "status" => $status,
                "role" => $role
            ]);
        }

        if ($user) {
            return redirect(route('user.index'))->with('success', 'Kullanıcı güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Kullanıcı güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Users::find(intval($id));
        @unlink(public_path('/upload/users/' . $user->image));
        @unlink(public_path('/upload/users/thumb/' . $user->image));

        if ($user->delete()) {
            echo 1;
        }
    }
}
