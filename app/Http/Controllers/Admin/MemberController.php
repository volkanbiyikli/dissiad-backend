<?php

namespace App\Http\Controllers\Admin;

use App\Members;
use App\Authors;
use App\Categories;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['member'] = Members::all();
        $data['member'] = Members::orderBy('name')->paginate(10);
        return view('admin.member.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a member resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a memberly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

//        dd($request->all());

        empty($request->status) ? $status = '0' : $status = '1';
        empty($request->product) ? $product = '0' : $product = '1';
        empty($request->export) ? $export = '0' : $export = '1';
        empty($request->import) ? $import = '0' : $import = '1';

        $messages = [
            'name.required' => 'Başlık zorunludur!',
            'city.required' => 'Şehir zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();


        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/members/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_thumb_resize = Image::make(public_path() . '/upload/members/temp/' . $filename);
            $image_thumb_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/members/' . $filename), 100);

            $image_thumb_resize = Image::make(public_path() . '/upload/members/temp/' . $filename);
            $image_thumb_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/members/thumb/' . $filename), 100);

            @unlink(public_path('/upload/members/temp/' . $filename));

        } else {
            $filename = null;
        }

        $member = Members::create([
            "name" => $request->name,
            "license" => $request->license,
            "address" => $request->address,
            "city" => $request->city,
            "authorized" => $request->authorized,
            "authorized_email" => $request->authorized_email,
            "telephone" => $request->telephone,
            "fax" => $request->fax,
            "email" => $request->email,
            "url" => $request->url,
            "product" => $product,
            "export" => $export,
            "import" => $import,
            "profile" => $request->profile,
            "map" => $request->map,
            "image" => $filename,
            "status" => $status,
        ]);
        $member->save();

        if ($member) {
            return redirect(route('member.index'))->with('success', 'Üye ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Üye ekleme işlemi gerçekleştirilemedi.');
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
        $member = Members::where('id', $id)->first();
        return view('admin.member.edit')->with('member', $member);
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
        empty($request->product) ? $product = '0' : $product = '1';
        empty($request->export) ? $export = '0' : $export = '1';
        empty($request->import) ? $import = '0' : $import = '1';

        $messages = [
            'name.required' => 'Başlık zorunludur!',
            'city.required' => 'Şehir zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();


        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/members/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_thumb_resize = Image::make(public_path() . '/upload/members/temp/' . $filename);
            $image_thumb_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/members/' . $filename), 100);

            $image_thumb_resize = Image::make(public_path() . '/upload/members/temp/' . $filename);
            $image_thumb_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/members/thumb/' . $filename), 100);

            @unlink(public_path('/upload/members/temp/' . $filename));

            @unlink(public_path('/upload/members/' . $request->old_image));
            @unlink(public_path('/upload/members/thumb/' . $request->old_image));

            $member = Members::Where('id', $id)->update([
                "name" => $request->name,
                "license" => $request->license,
                "address" => $request->address,
                "city" => $request->city,
                "authorized" => $request->authorized,
                "authorized_email" => $request->authorized_email,
                "telephone" => $request->telephone,
                "fax" => $request->fax,
                "email" => $request->email,
                "url" => $request->url,
                "product" => $product,
                "export" => $export,
                "import" => $import,
                "profile" => $request->profile,
                "map" => $request->map,
                "image" => $filename,
                "status" => $status,
            ]);

        } else {
            $member = Members::Where('id', $id)->update([
                "name" => $request->name,
                "license" => $request->license,
                "address" => $request->address,
                "city" => $request->city,
                "authorized" => $request->authorized,
                "authorized_email" => $request->authorized_email,
                "telephone" => $request->telephone,
                "fax" => $request->fax,
                "email" => $request->email,
                "url" => $request->url,
                "product" => $product,
                "export" => $export,
                "import" => $import,
                "profile" => $request->profile,
                "map" => $request->map,
                "status" => $status,
            ]);
        }

        if ($request->old_name <> $request->name)
        {
            $member = Members::Where('id', $id)->update([
                "slug" => null,
                "slug" => SlugService::createSlug(Members::class, 'slug', $request->name),
            ]);
        }

        if ($member) {
            return redirect(route('member.index'))->with('success', 'Üye güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Üye güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $member = Members::find(intval($id));
        @unlink(public_path('/upload/members/' . $member->image));
        @unlink(public_path('/upload/members/thumb/' . $member->image));

        if ($member->delete()) {
            echo 1;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = Members::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
