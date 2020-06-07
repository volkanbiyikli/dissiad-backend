<?php

namespace App\Http\Controllers\Admin;

use App\Reportage;
use App\Authors;
use App\Categories;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;


class ReportageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['reportage'] = Reportage::all();
        $data['reportage'] = Reportage::orderByDesc('date')->paginate(10);
        return view('admin.reportage.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a reportage resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.reportage.create');
    }

    /**
     * Store a reportagely created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

//        dd($request->all());

        empty($request->status) ? $status = '0' : $status = '1';
        empty($request->bigimage) ? $bigimage = '0' : $bigimage = '1';
        empty($request->blank_url) ? $blank_url = '0' : $blank_url = '1';

        $messages = [
            'name.required' => 'Başlık zorunludur!',
            'description.required' => 'İçerik zorunludur!',
        ];

        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');

        echo $request->tag;
        if(is_null($request->tag))
        {
            $tag=null;
        }
        else {
            $removetag = array('[', '{"value":"', '"}', ']');
            $tag = str_replace($removetag, "", $request->tag);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();


        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/reportages/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_thumb_resize = Image::make(public_path() . '/upload/reportages/temp/' . $filename);
            $image_thumb_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/reportages/' . $filename), 100);

            $image_thumb_resize = Image::make(public_path() . '/upload/reportages/temp/' . $filename);
            $image_thumb_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/reportages/thumb/' . $filename), 100);

            @unlink(public_path('/upload/reportages/temp/' . $filename));

        } else {
            $filename = null;
        }

        $reportage = Reportage::create([
            "name" => $request->name,
            "description" => $request->description,
            "image" => $filename,
            "status" => $status,
            "date" => $date,
            "tag" => $tag,
            "bigimage" => $bigimage,
            "url" => $request->url,
            "blank_url" => $blank_url,
        ]);
        $reportage->save();

        if ($reportage) {
            return redirect(route('reportage.index'))->with('success', 'Röportaj ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Röportaj ekleme işlemi gerçekleştirilemedi.');
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
        $reportage = Reportage::where('id', $id)->first();
        return view('admin.reportage.edit')->with('reportage', $reportage);
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
        empty($request->bigimage) ? $bigimage = '0' : $bigimage = '1';
        empty($request->blank_url) ? $blank_url = '0' : $blank_url = '1';

        $messages = [
            'name.required' => 'Başlık zorunludur!',
            'description.required' => 'İçerik zorunludur!',
        ];

        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');

        echo $request->tag;
        if(is_null($request->tag))
        {
            $tag=null;
        }
        else {
            $removetag = array('[', '{"value":"', '"}', ']');
            $tag = str_replace($removetag, "", $request->tag);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=5000,max_height=5000'
        ], $messages)->validate();


        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/reportages/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_thumb_resize = Image::make(public_path() . '/upload/reportages/temp/' . $filename);
            $image_thumb_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/reportages/' . $filename), 100);

            $image_thumb_resize = Image::make(public_path() . '/upload/reportages/temp/' . $filename);
            $image_thumb_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/reportages/thumb/' . $filename), 100);

            @unlink(public_path('/upload/reportages/temp/' . $filename));

            @unlink(public_path('/upload/reportages/' . $request->old_image));
            @unlink(public_path('/upload/reportages/thumb/' . $request->old_image));

            $reportage = Reportage::Where('id', $id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "image" => $filename,
                "status" => $status,
                "date" => $date,
                "tag" => $tag,
                "bigimage" => $bigimage,
                "url" => $request->url,
                "blank_url" => $blank_url,
            ]);

        } else {
            $reportage = Reportage::Where('id', $id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "status" => $status,
                "date" => $date,
                "tag" => $tag,
                "bigimage" => $bigimage,
                "url" => $request->url,
                "blank_url" => $blank_url,
            ]);
        }

        if ($request->old_name <> $request->name)
        {
            $reportage = Reportage::Where('id', $id)->update([
                "slug" => null,
                "slug" => SlugService::createSlug(Reportage::class, 'slug', $request->name),
            ]);
        }

        if ($reportage) {
            return redirect(route('reportage.index'))->with('success', 'Röportaj güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Röportaj güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $reportage = Reportage::find(intval($id));
        @unlink(public_path('/upload/reportages/' . $reportage->image));
        @unlink(public_path('/upload/reportages/thumb/' . $reportage->image));

        if ($reportage->delete()) {
            echo 1;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = Reportage::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
