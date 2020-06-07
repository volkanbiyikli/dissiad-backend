<?php

namespace App\Http\Controllers\Site;

use App\Authors;
use App\News;
use App\Rightcols;
use App\SocialMedias;
use App\Pages;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NewController extends Controller
{
    public function index()
    {
        $data['page'] = Pages::all()->sortBy('order');
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        $data['new'] = DB::table('news')
            ->orderBy('date', 'desc')
            ->paginate(10, ['*'], 'sayfa');
        return view('site.new', compact('data'));
    }

    public function detail($slug)
    {
        $data['page'] = Pages::all()->sortBy('order');
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        $page_detail = News::where('slug', $slug)->first();
        if (!$page_detail) {
            return abort(404);
        }
        if (!$page_detail->status) {
            return abort(404);
        }
        return view('site.new_detail', compact('page_detail', 'data'));
    }
}
