<?php

namespace App\Http\Controllers\Admin;

use App\Bulletin;
use App\Authors;
use App\Categories;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;


class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['bulletin'] = Bulletin::all();
        $data['bulletin'] = Bulletin::orderByDesc('date')->paginate(10);
        return view('admin.bulletin.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a bulletin resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.bulletin.create');
    }

    /**
     * Store a bulletinly created resource in storage.
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
            'name_id' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=4000,max_height=4000',
        ], $messages)->validate();


        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/bulletins/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_thumb_resize = Image::make(public_path() . '/upload/bulletins/temp/' . $filename);
            $image_thumb_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/bulletins/' . $filename), 100);

            $image_thumb_resize = Image::make(public_path() . '/upload/bulletins/temp/' . $filename);
            $image_thumb_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/bulletins/thumb/' . $filename), 100);

            @unlink(public_path('/upload/bulletins/temp/' . $filename));

        } else {
            $filename = null;
        }

        $bulletin = Bulletin::create([
            "name" => $request->name,
            "name_id" => $request->name_id,
            "description" => $request->description,
            "image" => $filename,
            "status" => $status,
            "date" => $date,
            "tag" => $tag,
            "bigimage" => $bigimage,
            "url" => $request->url,
            "blank_url" => $blank_url,
        ]);
        $bulletin->save();

        if ($bulletin) {
            return redirect(route('bulletin.index'))->with('success', 'Bülten ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Bülten ekleme işlemi gerçekleştirilemedi.');
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
        $bulletin = Bulletin::where('id', $id)->first();
        return view('admin.bulletin.edit')->with('bulletin', $bulletin);
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
            'name_id.required' => 'Başlık zorunludur!',
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
            'name_id' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:25600|dimensions:max_width=5000,max_height=5000'
        ], $messages)->validate();


        if ($request->image) {
            $image = $request->image;
            $image->move(public_path() . '/upload/bulletins/temp/', $filename = uniqid() . '.' . $request->image->getClientOriginalExtension());

            $image_thumb_resize = Image::make(public_path() . '/upload/bulletins/temp/' . $filename);
            $image_thumb_resize->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/bulletins/' . $filename), 100);

            $image_thumb_resize = Image::make(public_path() . '/upload/bulletins/temp/' . $filename);
            $image_thumb_resize->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_thumb_resize->save(public_path('/upload/bulletins/thumb/' . $filename), 100);

            @unlink(public_path('/upload/bulletins/temp/' . $filename));

            @unlink(public_path('/upload/bulletins/' . $request->old_image));
            @unlink(public_path('/upload/bulletins/thumb/' . $request->old_image));

            $bulletin = Bulletin::Where('id', $id)->update([
                "name" => $request->name,
                "name_id" => $request->name_id,
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
            $bulletin = Bulletin::Where('id', $id)->update([
                "name" => $request->name,
                "name_id" => $request->name_id,
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
            $bulletin = Bulletin::Where('id', $id)->update([
                "slug" => null,
                "slug" => SlugService::createSlug(Bulletin::class, 'slug', $request->name),
            ]);
        }

        if ($bulletin) {
            return redirect(route('bulletin.index'))->with('success', 'Bülten güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Bülten güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $bulletin = Bulletin::find(intval($id));
        @unlink(public_path('/upload/bulletins/' . $bulletin->image));
        @unlink(public_path('/upload/bulletins/thumb/' . $bulletin->image));

        if ($bulletin->delete()) {
            echo 1;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = Bulletin::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
