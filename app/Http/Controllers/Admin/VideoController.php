<?php

namespace App\Http\Controllers\Admin;

use App\Videos;
use App\Settings;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['video'] = Videos::all()->sortBy('order');
//        dd($data);
        return view('admin.video.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.video.create');
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

        $messages = [
            'name.required' => 'Video adı zorunludur!',
        ];

        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages)->validate();

        $video = Videos::create([
            "name" => $request->name,
            "status" => $status,
            "url" => $request->url,
            "date" => $date,
            "order" => "0",
        ]);
        $video->save();


        if ($video) {
            return redirect(route('video.index'))->with('success', 'Video ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Video ekleme işlemi gerçekleştirilemedi.');
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
        $video = Videos::where('id', $id)->first();
        return view('admin.video.edit')->with('video', $video);
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

        $messages = [
            'name.required' => 'Video adı zorunludur!',
        ];

        $date = Carbon::parse($request->date)->format('Y-m-d H:i:s');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages)->validate();

        $video = Videos::Where('id', $id)->update([
            "name" => $request->name,
            "status" => $status,
            "date" => $date,
            "url" => $request->url,
        ]);

        if ($video) {
            return redirect(route('video.index'))->with('success', 'Video güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Video güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $video = Videos::find(intval($id));

        if ($video->delete()) {
            echo 1;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = Videos::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
