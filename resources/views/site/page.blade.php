@extends('site.layouts.app')
@section('title',$page_detail->name.' - '.$settings->title)
@section('description'){!! Str::limit(strip_tags(html_entity_decode($settings->description)), 157) !!}@endsection
@section('url', Request::url())
@if ($page_detail->name)
    @section('image',$settings->url.'/upload/news/'.$page_detail->image)
@else
    @section('image',$settings->url.'/upload/logo/'.$settings->logo)
@endif
@section('content')
    <div class="content">
        <div class="container">
            <div class="row -mb-4 flex-lg-row-reverse">
                @if ($page_detail->left_status)
                    <div class="col-lg-9 mb-4">
                        @else
                            <div class="col-lg-12 mb-4">
                                @endif
                                <div class="card page-box">
                                    <div class="card-body">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="/">ANA SAYFA</a></li>
                                                @if ($page_detail->category_id == "dissiad")
                                                    <li class="breadcrumb-item active">
                                                        DİŞSİAD
                                                    </li>
                                                @elseif ($page_detail->category_id == "fuarlar")
                                                    <li class="breadcrumb-item active">
                                                        FUARLAR
                                                    </li>
                                                @elseif ($page_detail->category_id == "yayinlar")
                                                    <li class="breadcrumb-item active">
                                                        YAYINLAR
                                                    </li>
                                                @elseif ($page_detail->category_id == "bilgi-bankasi")
                                                    <li class="breadcrumb-item active">
                                                        BİLGİ BANKASI
                                                    </li>
                                                @else
                                                @endif
                                                <li class="breadcrumb-item active" aria-current="page">{{ $page_detail->name }}</li>
                                            </ol>
                                        </nav>
                                        <div class="page__title">{{ $page_detail->name }}</div>
                                        <div class="page__content">
                                            @if ($page_detail->image)
                                            <div class="mb-5">
                                                    <img src="/upload/pages/{{ $page_detail->image }}">
                                            </div>
                                            @endif
                                            {!! $page_detail->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($page_detail->left_status)
                                <div class="col-lg-3 mb-4">
                                    <div class="sidebar">
                                        <div class="sidebar-box card">
                                            @if ($page_detail->category_id)
                                                <div class="card-header">
                                                    @if ($page_detail->category_id == "dissiad")
                                                        DİŞSİAD
                                                    @elseif ($page_detail->category_id == "fuarlar")
                                                        FUARLAR
                                                    @elseif ($page_detail->category_id == "yayinlar")
                                                        YAYINLAR
                                                    @elseif ($page_detail->category_id == "bilgi-bankasi")
                                                        BİLGİ BANKASI
                                                    @else
                                                    @endif
                                                    <i class="fal fa-chevron-down ml-2"></i>
                                                </div>
                                            @endif
                                            <div class="card-body">
                                                <ul class="sidebar-menu">
                                                    @foreach($data['page'] as $page)
                                                        @if ($page->status)
                                                            @if ($page->category_id == $page_detail->category_id)
                                                                <li class="sidebar-menu__item"><a class="sidebar-menu__link" {{ $page->blank_url ? 'target="_blank"' : '' }} h
                                                                                                  @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}
                                                                        ">@endif {{ $page->name }}</a></li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
            </div>
        </div>

@endsection
