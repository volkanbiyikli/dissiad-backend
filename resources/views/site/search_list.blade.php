@extends('site.layouts.app')
@section('title','HABERLER - '.$settings->title)
@section('description'){!! Str::limit(strip_tags(html_entity_decode($settings->description)), 157) !!}@endsection
@section('url', Request::url())
@section('image',$settings->url.'/upload/logo/'.$settings->logo)

@section('content')
    @php
        $keywords = strip_tags(html_entity_decode(Request::get('kelime')));
        $category = strip_tags(html_entity_decode(Request::get('kategori')))
    @endphp
    <div class="content">
        <div class="container">
            <div class="row -mb-4 flex-lg-row-reverse">
                <div class="col-lg-9 mb-4">
                    <div class="card page-box">
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">ANA SAYFA</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">SİTE İÇİ ARAMA</li>
                                </ol>
                            </nav>
                            @if ($category=="haberler")
                                <div class="page__title">HABERLER @if($keywords) {{ '- Aranan Kelime: '.$keywords }} @endif</div>
                                <div class="page__content">
                                    <div class="space-y-6">
                                        @foreach($data['new'] as $db)
                                            @if ($db->status)
                                                <a class="card news-item news-item--vertical" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/haber/{{ $db->slug }}">@else
                                                        href="{{ $db->url }}">@endif
                                                    <div class="news-item__picture"><img src="/upload/news/thumb/{{ $db->image }}"></div>
                                                    <div class="card-body news-item__content">
                                                        <div class="news-item__title news-item__title-lg">{{ $db->name }}</div>
                                                        <div class="news-item__date mt-2"><i class="fal fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($db->date)->isoFormat('DD MMMM YYYY') }}</div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                    @elseif ($category=="bultenler")
                                        <div class="page__title">BÜLTENLER @if($keywords) {{ '- Aranan Kelime: '.$keywords }} @endif</div>
                                        <div class="page__content">
                                            <div class="space-y-6">
                                                @foreach($data['new'] as $db)
                                                    @if ($db->status)
                                                        <a class="newsletters-item card" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/bulten/{{ $db->slug }}">@else
                                                                href="{{ $db->url }}">@endif
                                                            <div class="newsletters-item__date">
                                                                <big>{{ \Carbon\Carbon::parse($db->date)->isoFormat('d') }}</big><span>{{ \Carbon\Carbon::parse($db->date)->isoFormat('MMMM')
                                                    }}</span><span>{{ \Carbon\Carbon::parse($db->date)->isoFormat('YYYY') }}</span>
                                                            </div>
                                                            <div class="newsletters-item__content card-body">{{ $db->name }}</div>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @elseif($category=="roportajlar")
                                                <div class="page__title">RÖPORTAJLAR @if($keywords) {{ '- Aranan Kelime: '.$keywords }} @endif</div>
                                                <div class="page__content">
                                                    <div class="space-y-6">
                                                        @foreach($data['new'] as $db)
                                                            @if ($db->status)
                                                                <a class="card news-item news-item--vertical" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/roportaj/{{ $db->slug }}">@else
                                                                        href="{{ $db->url }}">@endif
                                                                    <div class="news-item__picture"><img src="/upload/reportages/thumb/{{ $db->image }}"></div>
                                                                    <div class="card-body news-item__content">
                                                                        <div class="news-item__title news-item__title-lg">{{ $db->name }}</div>
                                                                        <div class="news-item__date mt-2"><i class="fal fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($db->date)->isoFormat('DD MMMM YYYY') }}</div>
                                                                    </div>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                            @endif
                                            @if (!count($data['new']))
                                                <div>İçerik Bulunamadı!</div>
                                            @endif
                                            {{  $data['new']->appends(request()->query())->links() }}
                                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <div class="sidebar">
                            <div class="sidebar-box card">
                                <div class="card-header">SİTE İÇİ ARAMA<i class="fal fa-chevron-down ml-2"></i></div>
                                <div class="card-body">
                                    <ul class="sidebar-menu">
                                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="/arama?kelime={{ $keywords }}&kategori=haberler">HABERLER</a></li>
                                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="/arama?kelime={{ $keywords }}&kategori=bultenler">BÜLTENLER</a></li>
                                        <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="/arama?kelime={{ $keywords }}&kategori=roportajlar">RÖPORTAJLAR</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
