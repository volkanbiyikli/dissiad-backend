<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Files;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Image;
use Cviebrock\EloquentSluggable\Services\SlugService;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['file'] = Files::all()->sortBy('order');
        return view('admin.file.index', ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'Slider adı zorunludur!',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'file|mimes:doc,docx,pdf,xls,xlsx,zip,rar,jpg,jpeg,png,gif|max:25600',
        ], $messages)->validate();

            $file = $request->file;
            $file->move(public_path() . '/upload/files/', $filename = uniqid() . '.' . $request->file->getClientOriginalExtension());

        $file = Files::create([
            "name" => $request->name,
            "file" => $filename,
        ]);
        $file->save();

        if ($file) {
            return redirect(route('file.index'))->with('success', 'Dosya ekleme işlemi başarılı olarak gerçekleştirildi.');
        }
        return back()->with('error', 'Dosya ekleme işlemi gerçekleştirilemedi.');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $file = Files::find(intval($id));
        @unlink(public_path('/upload/files/' . $file->file));

        if ($file->delete()) {
            echo 1;
        }
    }
}
