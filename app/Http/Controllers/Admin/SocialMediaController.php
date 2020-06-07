<?php

namespace App\Http\Controllers\Admin;

use App\SocialMedias;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        return view('admin.socialmedia.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public
    function edit($id)
    {
        $socialmedia = SocialMedias::where('id', $id)->first();
        return view('admin.socialmedia.edit')->with('socialmedia', $socialmedia);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public
    function update(Request $request, $id)
    {

        empty($request->status) ? $status = '0' : $status = '1';

        $messages = [
            'url.required' => 'Ad Soyad zorunludur!',
            'url.required' => 'Renk zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'url' => 'required',
            'color' => 'required',
        ], $messages)->validate();


        $socialmedia = SocialMedias::Where('id', $id)->update([
            "url" => $request->url,
            "color" => $request->color,
            "status" => $status
        ]);

        if ($socialmedia) {
            return redirect(route('socialmedia.index'))->with('success', 'Sosyal medya güncelleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Sosyal medya güncelleme işlemi gerçekleştirilemedi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public
    function destroy()
    {
        //
    }

    public
    function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $sortable = SocialMedias::find(intval($value));
            $sortable->order = intval($key);
            $sortable->save();
        }

        echo true;
    }
}
