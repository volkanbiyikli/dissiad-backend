<?php

namespace App\Http\Controllers\Admin;

use App\Pages;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['page'] = Pages::all()->sortBy('order');
//        dd($data);
        return view('admin.page.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.page.create');
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
        empty($request->menu_status) ? $menu_status = '0' : $menu_status = '1';
        empty($request->left_status) ? $left_status = '0' : $left_status = '1';
        empty($request->blank_url) ? $blank_url = '0' : $blank_url = '1';

//        dd($request->all());

        $messages = [
            'name.required' => 'Sayfa adı zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/pages/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/pages/temp/' . $filename);
            $image_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/pages/' . $filename));

            $image_resize = Image::make(public_path() . '/upload/pages/temp/' . $filename);
            $image_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/pages/thumb/' . $filename));

            @unlink(public_path('/upload/pages/temp/' . $filename));

        } else {
            $filename = null;
        }

        $page = Pages::create([
            "name" => $request->name,
            "description" => $request->description,
            "category_id" => $request->category_id,
            "image" => $filename,
            "status" => $status,
            "menu_status" => $menu_status,
            "left_status" => $left_status,
            "url" => $request->url,
            "blank_url" => $blank_url,
            "order" => "0",
        ]);
        $page->save();

        if ($page) {
            return redirect(route('page.index'))->with('success', 'Sayfa ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Sayfa ekleme işlemi gerçekleştirilemedi.');
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
        $page = Pages::where('id', $id)->first();
        return view('admin.page.edit')->with('page', $page);
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
        empty($request->menu_status) ? $menu_status = '0' : $menu_status = '1';
        empty($request->left_status) ? $left_status = '0' : $left_status = '1';
        empty($request->blank_url) ? $blank_url = '0' : $blank_url = '1';

        $messages = [
            'name.required' => 'Sayfa adı zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/pages/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/pages/temp/' . $filename);
            $image_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/pages/' . $filename));

            $image_resize = Image::make(public_path() . '/upload/pages/temp/' . $filename);
            $image_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/pages/thumb/' . $filename));

            @unlink(public_path('/upload/pages/temp/' . $filename));

            $page = Pages::Where('id', $id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "image" => $filename,
                "category_id" => $request->category_id,
                "status" => $status,
                "menu_status" => $menu_status,
                "left_status" => $left_status,
                "url" => $request->url,
                "blank_url" => $blank_url,
            ]);

            @unlink(public_path('/upload/pages/' . $request->old_image));
            @unlink(public_path('/upload/pages/thumb/' . $request->old_image));

        } else {
            $page = Pages::Where('id', $id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "category_id" => $request->category_id,
                "status" => $status,
                "menu_status" => $menu_status,
                "left_status" => $left_status,
                "url" => $request->url,
                "blank_url" => $blank_url,
            ]);
        }


        if ($request->old_name <> $request->name) {
            $page = Pages::Where('id', $id)->update([
                "slug" => null,
                "slug" => SlugService::createSlug(Pages::class, 'slug', $request->name),
            ]);
        }

        if ($page) {
            return redirect(route('page.index'))->with('success', 'Sayfa güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Sayfa güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $page = Pages::find(intval($id));
        @unlink(public_path('/upload/pages/' . $page->image));
        @unlink(public_path('/upload/pages/thumb/' . $page->image));

        if ($page->delete()) {
            echo 1;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = Pages::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
