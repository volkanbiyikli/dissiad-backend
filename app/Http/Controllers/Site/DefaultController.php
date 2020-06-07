<?php

namespace App\Http\Controllers\Site;

use App\Authors;
use App\News;
use App\Bulletin;
use App\Settings;
use App\Videos;
use App\Reportage;
use App\Rightcols;
use App\SocialMedias;
use App\Categories;
use App\Sliders;
use App\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DefaultController extends Controller
{
    public function index()
    {
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        $data['page'] = Pages::all()->sortBy('order');
        $data['slider'] = Sliders::all()->sortBy('order')->take(10);
        $data['new'] = News::all()->sortByDesc('date')->take(8);
        $data['bulletin'] = Bulletin::all()->sortByDesc('date')->take(8);
        $data['video'] = Videos::all()->sortByDesc('date')->take(24);
        $data['roportage'] = Reportage::all()->sortByDesc('date')->take(8);
        return view('site.index',compact('data'));
    }

    public function contact()
    {
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        $data['page'] = Pages::all()->sortBy('order');
        return view('site.contact',compact('data'));
    }
}
