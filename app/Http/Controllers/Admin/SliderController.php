<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sliders;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['slider'] = Sliders::all()->sortBy('order');
//        dd($data);
        return view('admin.slider.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
        empty($request->blank_url) ? $blank_url = '0' : $blank_url = '1';

//        dd($request->all());

        $messages = [
            'name.required' => 'Slider adı zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/sliders/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/sliders/temp/' . $filename);
            $image_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/sliders/' . $filename));

            $image_resize = Image::make(public_path() . '/upload/sliders/temp/' . $filename);
            $image_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/sliders/thumb/' . $filename));

            @unlink(public_path('/upload/sliders/temp/' . $filename));

        } else {
            $filename = null;
        }

        $slider = Sliders::create([
            "name" => $request->name,
            "description" => $request->description,
            "image" => $filename,
            "status" => $status,
            "url" => $request->url,
            "blank_url" => $blank_url,
            "order" => "0",
        ]);
        $slider->save();

        if ($slider) {
            return redirect(route('slider.index'))->with('success', 'Slider ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Slider ekleme işlemi gerçekleştirilemedi.');
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
        $slider = Sliders::where('id', $id)->first();
        return view('admin.slider.edit')->with('slider', $slider);
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
        empty($request->blank_url) ? $blank_url = '0' : $blank_url = '1';

        $messages = [
            'name.required' => 'Slider adı zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();

        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/sliders/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_resize = Image::make(public_path() . '/upload/sliders/temp/' . $filename);
            $image_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/sliders/' . $filename));

            $image_resize = Image::make(public_path() . '/upload/sliders/temp/' . $filename);
            $image_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save(public_path('/upload/sliders/thumb/' . $filename));

            @unlink(public_path('/upload/sliders/temp/' . $filename));

            $slider = Sliders::Where('id', $id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "image" => $filename,
                "status" => $status,
                "url" => $request->url,
                "blank_url" => $blank_url,
            ]);

            @unlink(public_path('/upload/sliders/' . $request->old_image));
            @unlink(public_path('/upload/sliders/thumb/' . $request->old_image));

        } else {
            $slider = Sliders::Where('id', $id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "status" => $status,
                "url" => $request->url,
                "blank_url" => $blank_url,
            ]);
        }

        if ($slider) {
            return redirect(route('slider.index'))->with('success', 'Slider güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Slider güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $slider = Sliders::find(intval($id));
        @unlink(public_path('/upload/sliders/' . $slider->image));
        @unlink(public_path('/upload/sliders/thumb/' . $slider->image));


        if ($slider->delete()) {
            echo 1;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = Sliders::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
