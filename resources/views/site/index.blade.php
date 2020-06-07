@extends('site.layouts.app')
@section('title',$settings->title.' - '.$settings->description)
@section('description'){!! Str::limit(strip_tags(html_entity_decode($settings->description)), 157) !!}@endsection
@section('url', $settings->url)
@section('image',$settings->url.'/upload/dissiad.jpg')

@section('content')
    <div class="content">
        <div class="slider sl-home">
            <div class="container">
                <div class="swiper-container">
                    <div class="slider-button-next sl-home__btn next"></div>
                    <div class="slider-button-prev sl-home__btn prev"></div>
                    <div class="swiper-wrapper">
                        @foreach($data['slider'] as $db)
                            @if ($db->status)
                                <div class="swiper-slide sl-home-item">
                                    <div class="sl-home-item__picture"><img src="/upload/sliders/{{ $db->image }}"></div>
                                    <div class="sl-home-item__content space-y-4">
                                        <div class="sl-home-item__title">{{ $db->name }}</div>
                                        <div class="sl-home-item__desc">{{ $db->description }}</div>
                                        <a class="sl-home-item__btn sl-home__btn" @if ($db->blank_url) target="_blank" @endif href="{{ $db->url }}">DEVAMI</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="section se-news sl-news py-12">
            <div class="container">
                <div class="section__head">
                    <div class="row items-center">
                        <div class="col">
                            <div class="section__title">HABERLER</div>
                        </div>
                        <div class="col-auto">
                            <div class="row-sm items-center">
                                <div class="col-auto"><a class="show-all-btn" href="/haberler"><span class="d-sm-inline d-none">TÜM HABERLER</span><span class="d-sm-none">HEPSİ</span></a></div>
                                <div class="col-auto">
                                    <div class="slider-button-prev"></div>
                                    <div class="slider-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($data['new'] as $db)
                                @if ($db->status)
                                    <a class="swiper-slide news-item card" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/haber/{{ $db->slug }}">@else
                                            href="{{ $db->url }}">@endif
                                        <div class="news-item__picture">
                                            <img src="/upload/news/thumb/{{ $db->image }}">
                                        </div>
                                        <div class="card-body news-item__content">
                                            <div class="news-item__date mb-2"><i class="fal fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($db['date'])->isoFormat('DD MMMM YYYY') }}</span></div>
                                            <div class="news-item__title">{{ $db->name }}</div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section se-newsletters sl-newsletters py-12 bg-white">
            <div class="container">
                <div class="section__head">
                    <div class="row items-center">
                        <div class="col">
                            <div class="section__title">BÜLTENLER</div>
                        </div>
                        <div class="col-auto">
                            <div class="row-sm items-center">
                                <div class="col-auto"><a class="show-all-btn" href="/bultenler"><span class="d-sm-inline d-none">TÜM BÜLTENLER</span><span class="d-sm-none">HEPSİ</span></a></div>
                                <div class="col-auto">
                                    <div class="slider-button-prev"></div>
                                    <div class="slider-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($data['bulletin'] as $db)
                                @if ($db->status)
                                    <a class="swiper-slide newsletters-item card" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/bulten/{{ $db->slug }}">@else
                                            href="{{ $db->url }}">@endif
                                        <div class="newsletters-item__date">
                                            <big>{{ \Carbon\Carbon::parse($db['date'])->isoFormat('DD') }}</big><span>{{ \Carbon\Carbon::parse($db['date'])->isoFormat('MMMM') }}</span>
                                        </div>
                                        <div class="newsletters-item__content card-body">{{ $db->name }}</div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="container">
                <div class="section se-videos -mx-5 card">
                    <div class="card-body">
                        <div class="section__head">
                            <div class="row items-center">
                                <div class="col">
                                    <div class="section__title">VİDEOLAR</div>
                                </div>
                                <div class="col-auto"><a class="show-all-btn" href="https://www.youtube.com/channel/UCQ1mdqdE8PRd463Ikv4r5yw"><span
                                                class="d-sm-inline d-none">BÜTÜN VİDEOLAR</span><span class="d-sm-none">HEPSİ</span></a></div>
                            </div>
                        </div>
                        <div class="section__content">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="videos-item">
                                        <iframe class="videos-active__iframe mb-3" type="text/html" height="400" src="" frameborder="0"></iframe>
                                        <div class="videos-active__date videos-item__date mb-2"><i class="fal fa-calendar-alt"></i><span></span></div>
                                        <div class="videos-active__title videos-item__title videos-item__title-lg"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-6 mt-lg-0">
                                    <div class="space-y-4 se-videos-items">
                                        @foreach($data['video'] as $db)
                                            @if ($db->status)
                                                <a class="videos-item" href="http://www.youtube.com/embed/{{ $db->url }}">
                                                    <div class="row-md">
                                                        <div class="col-auto">
                                                            <div class="videos-item__picture"><img src="http://i3.ytimg.com/vi/{{ $db->url }}/maxresdefault.jpg"></div>
                                                        </div>
                                                        <div class="col videos-item__content">
                                                            <div class="videos-item__title videos-item__title-sm">{{ $db->name }}</div>
                                                            <div class="videos-item__date mt-1"><i
                                                                        class="fal fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($db['date'])->isoFormat('DD MMMM YYYY') }}</span></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section se-interviews sl-interviews py-12 bg-white">
            <div class="container">
                <div class="section__head">
                    <div class="row items-center">
                        <div class="col">
                            <div class="section__title">RÖPORTAJLAR</div>
                        </div>
                        <div class="col-auto">
                            <div class="row-sm items-center">
                                <div class="col-auto"><a class="show-all-btn" href="/roportajlar"><span class="d-sm-inline d-none">BÜTÜN RÖPORTAJLAR</span><span
                                                class="d-sm-none">HEPSİ</span></a></div>
                                <div class="col-auto">
                                    <div class="slider-button-prev"></div>
                                    <div class="slider-button-next"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($data['roportage'] as $db)
                                @if ($db->status)
                                    <a class="swiper-slide news-item card news-item--vertical" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/roportaj/{{ $db->slug }}">@else
                                            href="{{ $db->url }}">@endif
                                        <div class="news-item__picture"><img src="/upload/reportages/thumb/{{ $db->image }}"></div>
                                        <div class="card-body news-item__content">
                                            <div class="news-item__title">{{ $db->name }}</div>
                                            <div class="news-item__date mt-2"><i class="fal fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($db['date'])->isoFormat('DD MMMM YYYY') }}</span></div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('left')
@endsection

@section('right')
@endsection

@section('full')
@endsection
