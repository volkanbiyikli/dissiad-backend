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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function index(Request $request)
    {

        $keywords = strip_tags(html_entity_decode($request->get('kelime')));
        $category = strip_tags(html_entity_decode($request->get('kategori')));

        if($category=="haberler")
        {
            $db = "news";
        }
        elseif($category=="bultenler")
        {
            $db = "bulletins";
        }
        elseif($category=="roportajlar")
        {
            $db = "reportages";
        }
        else
        {
            return redirect('/');
        }

        if(!$keywords)
        {
            return redirect('/');
        }
        else
        {
            $data['page'] = Pages::all()->sortBy('order');
            $data['socialmedia'] = SocialMedias::all()->sortBy('order');
            $data['search'] = $keywords;
            $data['new'] = DB::table($db)
                ->where('name', 'LIKE', '%' . ($keywords) . '%')
                ->orWhere('description', 'LIKE', '%' . ($keywords) . '%')
                ->orderBy('date', 'desc')
                ->paginate(10, ['*'], 'sayfa');
            return view('site.search_list', compact('data'));
        }
    }
}
