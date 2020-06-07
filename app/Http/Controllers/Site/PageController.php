<?php

namespace App\Http\Controllers\Site;

use App\Authors;
use App\News;
use App\Rightcols;
use App\SocialMedias;
use App\Categories;
use App\Pages;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class PageController extends Controller
{
    public function detail($slug)
    {
        $data['page'] = Pages::all()->sortBy('order');
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        $page_detail = Pages::where('slug', $slug)->first();
        if (!$page_detail) {
            return abort(404);
        }
        if (!$page_detail->status) {
            return abort(404);
        }
        return view('site.page', compact('page_detail', 'data'));
    }
}
