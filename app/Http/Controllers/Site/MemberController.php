<?php

namespace App\Http\Controllers\Site;

use App\Authors;
use App\Members;
use App\News;
use App\Rightcols;
use App\SocialMedias;
use App\Pages;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $keywords = strip_tags(html_entity_decode($request->get('firma')));
        $city = strip_tags(html_entity_decode($request->get('il')));

        if (!$city)
        {
            $data['page'] = Pages::all()->sortBy('order');
            $data['socialmedia'] = SocialMedias::all()->sortBy('order');
            $data['new'] = DB::table('members')
                ->orderBy('name', 'asc')
                ->where('status', '1')
                ->where('name', 'LIKE', '%' . ($keywords) . '%')
                ->paginate(12, ['*'], 'sayfa');
            return view('site.member', compact('data'));
        }

        if ($city)
        {
            $data['page'] = Pages::all()->sortBy('order');
            $data['socialmedia'] = SocialMedias::all()->sortBy('order');
            $data['new'] = DB::table('members')
                ->orderBy('name', 'asc')
                ->where('status', '1')
                ->where( 'city', $city)
                ->where('name', 'LIKE', '%' . ($keywords) . '%')
                ->paginate(12, ['*'], 'sayfa');
            return view('site.member', compact('data'));
        }

    }

    public function detail($slug)
    {
        $data['page'] = Pages::all()->sortBy('order');
        $data['socialmedia'] = SocialMedias::all()->sortBy('order');
        $page_detail = Members::where('slug', $slug)->first();
        if (!$page_detail) {
            return abort(404);
        }
        if (!$page_detail->status) {
            return abort(404);
        }
        return view('site.member_detail', compact('page_detail', 'data'));
    }
}
