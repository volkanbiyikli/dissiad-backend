@if(!$settings->status)
@include('errors.status')
@else
        <!DOCTYPE html>
<html lang="tr-TR">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <meta property="og:url" content="@yield('url')"/>
    <meta property="og:title" content="@yield('title')"/>
    <meta name="description" content="@yield('description')"/>
    <meta property="og:image" content="@yield('image')"/>
    <meta property="og:type" content="article"/>
    <meta property="og:site_name" content="{{ ($settings->title) }}"/>
    <meta property="og:locale" content="tr_TR"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:creator" content="{{ ($settings->twitter) }}"/>
    <meta name="twitter:site" content="{{ ($settings->twitter) }}"/>
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('image')"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="@yield('description')"/>
    @if ($settings->noindex)
        <meta name="robots" content="index,follow"/>
        <meta name="googlebot" content="index,follow"/>
    @else
        <meta name="robots" content="noindex,nofollow"/>
        <meta name="googlebot" content="noindex,nofollow"/>
    @endif
    <link rel="shortcut icon" href="/upload/dissiad-icon.png" type="image/x-icon"/>
    <link rel="icon" href="/upload/logo//upload/dissiad-icon.png" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="/upload/logo//upload/dissiad-icon.png"/>
    <link rel="mask-icon" href="/upload/logo//upload/dissiad-icon.png" color="#ffffff"/>
    <link rel="stylesheet" type="text/css" href="/asset/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="/asset/css/main.css">
</head>
<body>
<div class="wrapper">

    <div class="search-box">
        <div class="search-box__bg"></div>
        <form action="{{route('search.index')}}">
            <div class="flex position-relative">
                <button class="btn btn-primary btn-lg"><i class="fas fa-search"></i></button>
                <input class="text form-control form-control-lg" type="text" name="kelime" placeholder="Site İçi Arama..." required/>
                <a class="search-box__close" href="#"><i class="fas fa-times fa-big text-primary"></i></a>
            </div>
            <div class="text-white pl-lg-11 mt-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" id="haberlerdeAra" type="radio" name="kategori" value="haberler" checked/>
                    <label class="custom-control-label" for="haberlerdeAra">Haberlerde Ara</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" id="bultenlerdeAra" type="radio" name="kategori" value="bultenler"/>
                    <label class="custom-control-label" for="bultenlerdeAra">Bültenlerde Ara</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input class="custom-control-input" id="ropoprtajlardaAra" type="radio" name="kategori" value="roportajlar"/>
                    <label class="custom-control-label" for="ropoprtajlardaAra">Röportajlarda Ara</label>
                </div>
            </div>
        </form>
    </div>

    <header class="header">
        <div class="container">
            <div class="row justify-between items-center py-3">
                <div class="col-auto"><a class="navbar-brand" href="/"><img src="/upload/dissiad-logo.svg"></a></div>
                <div class="col-auto">
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                            aria-label="Toggle navigation"><span class="navbar-toggler__bar top"></span><span class="navbar-toggler__bar middle"></span><span class="navbar-toggler__bar bottom"></span>
                    </button>
                    <div class="socials space-x-2 d-lg-flex d-none">
                        @foreach($data['socialmedia'] as $socialmedia)
                            @if ($socialmedia->status)
                                @if ($socialmedia->name == "Email")
                                    <a class="socials-item" href="mailto:{{ $socialmedia->url }}" style="background-color: {{ $socialmedia->color }}" target="_blank">
                                        <i class="{{ $socialmedia->icon }} fa-fw"></i>
                                    </a>
                                @else
                                    <a class="socials-item" href="{{ $socialmedia->url }}" style="background-color: {{ $socialmedia->color }}" target="_blank">
                                        <i class="{{ $socialmedia->icon }} fa-fw"></i>
                                    </a>
                                @endif
                            @endif
                        @endforeach
                        <a class="socials-item bg-language" href="#">EN</a>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/">ANA SAYFA</a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DİŞSİAD</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-1">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "dissiad")
                                            <li>
                                                <a class="dropdown-item" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/uyeler">ÜYELER</a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BASIN</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-1">
                                <li><a class="dropdown-item" href="/haberler">HABERLER</a></li>
                                <li><a class="dropdown-item" href="/bultenler">BÜLTENLER</a></li>
                                <li><a class="dropdown-item" href="/roportajlar">RÖPORTAJLAR</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FUARLAR</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-1">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "fuarlar")
                                            <li>
                                                <a class="dropdown-item" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">YAYINLAR</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-1">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "yayinlar")
                                            <li>
                                                <a class="dropdown-item" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BİLGİ BANKASI</a>
                            <ul class="dropdown-menu" aria-labelledby="menu-1">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "bilgi-bankasi")
                                            <li>
                                                <a class="dropdown-item" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link active" href="/iletisim">İLETİŞİM</a></li>
                        <li class="nav-item search-btn lg:ml-auto"><a class="nav-link search-toggle" data-selector="header" href="#"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="navbar-search d-none">
                        <input placeholder="Ara">
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row -mb-6">
                <div class="col-md-3 col-sm-6 mb-6"><a href="#"><img src="/upload/dissiad-logo-white.svg"></a>
                    <div class="socials space-x-2 mt-8">
                        @foreach($data['socialmedia'] as $socialmedia)
                            @if ($socialmedia->status)
                                @if ($socialmedia->name == "Email")
                                    <a class="socials-item" href="mailto:{{ $socialmedia->url }}" style="background-color: {{ $socialmedia->color }}" target="_blank">
                                        <i class="{{ $socialmedia->icon }} fa-fw"></i>
                                    </a>
                                @else
                                    <a class="socials-item" href="{{ $socialmedia->url }}" style="background-color: {{ $socialmedia->color }}" target="_blank">
                                        <i class="{{ $socialmedia->icon }} fa-fw"></i>
                                    </a>
                                @endif
                            @endif
                        @endforeach
                        <a class="socials-item bg-language" href="#">EN</a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 space-y-5 mb-6">
                    <div class="footer-area"><a class="footer-area__title" href="#">ANA SAYFA</a></div>
                    <div class="footer-area">
                        <div class="footer-area__title">DİŞSİAD</div>
                        <div class="footer-area__content">
                            <ul class="footer-menu">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "dissiad")
                                            <li class="footer-menu__item">
                                                <a class="footer-menu__link" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="footer-area"><a class="footer-area__title" href="/uyeler">ÜYELER</a></div>
                </div>
                <div class="col-md-3 col-sm-6 space-y-5 mb-6">
                    <div class="footer-area">
                        <div class="footer-area__title">BASIN</div>
                        <div class="footer-area__content">
                            <ul class="footer-menu">
                                <li class="footer-menu__item"><a class="footer-menu__link" href="/haberler">HABERLER</a></li>
                                <li class="footer-menu__item"><a class="footer-menu__link" href="/bultenler">BÜLTENLER</a></li>
                                <li class="footer-menu__item"><a class="footer-menu__link" href="/roportajlar">RÖPORTAJLAR</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-area">
                        <div class="footer-area__title">BİLGİ BANKASI</div>
                        <div class="footer-area__content">
                            <ul class="footer-menu">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "bilgi-bankasi")
                                            <li class="footer-menu__item">
                                                <a class="footer-menu__link" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 space-y-5 mb-6">
                    <div class="footer-area">
                        <div class="footer-area__title">YAYINLAR</div>
                        <div class="footer-area__content">
                            <ul class="footer-menu">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "yayinlar")
                                            <li class="footer-menu__item">
                                                <a class="footer-menu__link" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="footer-area">
                        <div class="footer-area__title">FUARLAR</div>
                        <div class="footer-area__content">
                            <ul class="footer-menu">
                                @foreach($data['page'] as $page)
                                    @if ($page->status)
                                        @if ($page->category_id == "fuarlar")
                                            <li class="footer-menu__item">
                                                <a class="footer-menu__link" {{ $page->blank_url ? 'target="_blank"' : '' }}
                                                @if (!$page->url) href="/{{ $page->category_id }}/{{ $page->slug }}">@else href="{{ $page->url }}">@endif {{ $page->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="footer-area"><a class="footer-area__title" href="/iletisim">İLETİŞİM</a></div>
                    <div class="footer-area"><a class="footer-area__title" href="#">ENGLISH</a></div>
                </div>
                <div class="col-12 mb-6">
                    <div class="items-center text-xs font-light border-t border-gray-600 mt-5 pt-5">
                        <div class="row">
                            <div class="col">
                                Copyright© {{now()->year}} Tüm Hakları
                                &nbsp;<span class="font-bold">DİŞSİAD</span>’a aittir, içerikler izinsiz kullanılamaz.
                            </div>
                            <div class="col-auto">
                                <a class="block" target="_blank" href="http://www.100derece.com">
                                    <div class="row-sm items-center">
                                        <div class="col-auto">Powered by</div>
                                        <div class="col-auto">
                                            <img src="/upload/100derece.svg">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="btn btn-icon btn-lg btn-primary text-white" id="backToUp"><i class="fas fa-chevron-up"></i></div>
    <script src="/asset/js/vendors.js"></script>
    <script src="/asset/js/main.js"></script>
</div>
</body>
</html>
@endif
