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
                                                <li class="breadcrumb-item"><a href="/uyeler">ÜYELER</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">{{ $page_detail->name }}</li>
                                            </ol>
                                        </nav>
                                        <div class="page__title">{{ $page_detail->name }}</div>
                                        <div class="page__content">
                                            <div class="border-b border-gray-200 pb-3 mb-3">
                                                @if ($page_detail->image)
                                                    <img class="mb-3" width="300px" src="/upload/members/{{ $page_detail->image }}">
                                                @endif
                                            </div>
                                            <div class="single-details">
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FİRMA ADI</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->name }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">RUHSAT NUMARASI</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->license }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FİRMA ADRESİ</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->address }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">YETKİLİ KİŞİ</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->authorized }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">YETKİLİ E-POSTA ADRESİ</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->authorized_email }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FİRMA TELEFON</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->telephone }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FİRMA FAKS</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->fax }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FİRMA E-POSTA ADRESİ</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->email }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FİRMA WEB SİTESİ</div>
                                                        <div class="col-md-9 single-details-item__desc">{{ $page_detail->web }}</div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">FAALİYET KATEGORİSİ</div>
                                                        <div class="col-md-9 single-details-item__desc">
                                                            <div class="row-sm mt-1">
                                                                <div class="col-auto"><i class="fas {{$page_detail->product ? 'fa-check' : 'fa-times'}}"></i> İmalat</div>
                                                                <div class="col-auto"><i class="fas {{$page_detail->export ? 'fa-check' : 'fa-times'}}"></i> İhracat</div>
                                                                <div class="col-auto"><i class="fas {{$page_detail->import ? 'fa-check' : 'fa-times'}}"></i> İthalat</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">ŞİRKET PROFİLİ</div>
                                                        <div class="col-md-9 single-details-item__desc">
                                                            {{ $page_detail->profile }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-details-item">
                                                    <div class="row-sm">
                                                        <div class="col-md-3 single-details-item__title">HARİTA</div>
                                                        <div class="col-md-9 single-details-item__desc">
                                                            {!! $page_detail->map !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
