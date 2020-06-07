<html lang="tr">
<head>
    <title>{{($settings->title)}} - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    @yield('pagestyles')
    <link href="/admin/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="/upload/admin/favicon.ico"/>
    <script src="/admin/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="/admin/assets/js/scripts.bundle.js" type="text/javascript"></script>
    @yield('pagevendors')
    @yield('pagescripts')
</head>
<body style="background-image: url(/admin/assets/media/bg-admin-header.jpg); background-position: center top; background-size: 100% 350px;"
      class="kt-page--loading-enabled kt-page--loading kt-page--fluid kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
<div class="kt-page-loader">
    <div class="kt-spinner kt-spinner--brand"></div>
</div>
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="{{route('admin.index')}}">
            <img alt="Logo" src="/upload/admin/admin-logo-sm.png"/>
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more-1"></i></button>
    </div>
</div>
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
                <div class="kt-container ">
                    <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                        <a class="kt-header__brand-logo" href="{{route('admin.index')}}">
                            <img alt="Logo" src="/upload/admin/admin-logo.png"
                                 class="kt-header__brand-logo-default"/>
                            <img alt="Logo" src="/upload/admin/admin-logo-sm.png"
                                 class="kt-header__brand-logo-sticky"/>
                        </a>
                    </div>
                    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i
                                class="la la-close"></i></button>
                    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
                        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                            <ul class="kt-menu__nav ">

                                <li class="kt-menu__item @if(Request::is('adminpanel/')) kt-menu__item--open @endif">
                                    <a href="/adminpanel/" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Başlangıç</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/page*')) kt-menu__item--open @endif">
                                    <a href="{{route('page.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Sayfalar</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/new*')) kt-menu__item--open @endif">
                                    <a href="{{route('new.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Haberler</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/reportage*')) kt-menu__item--open @endif">
                                    <a href="{{route('reportage.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Röportajlar</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/bulletin*')) kt-menu__item--open @endif">
                                    <a href="{{route('bulletin.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Bültenler</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/video*')) kt-menu__item--open @endif">
                                    <a href="{{route('video.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Videolar</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/member*')) kt-menu__item--open @endif">
                                    <a href="{{route('member.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Üyeler</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item @if(Request::is('adminpanel/slider*')) kt-menu__item--open @endif">
                                    <a href="{{route('slider.index')}}" class="kt-menu__link">
                                        <span class="kt-menu__link-text">Slider</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel kt-menu__item--open-dropdown" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                                    <a href="javascript:" class="kt-menu__link kt-menu__toggle">
                                        <span class="kt-menu__link-text">Ayarlar</span>
                                        <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                                    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
                                        <ul class="kt-menu__subnav">
                                            <li class="kt-menu__item" aria-haspopup="true">
                                                <a href="{{route('setting.edit')}}" class="kt-menu__link ">
                                                    <span class="kt-menu__link-text">Genel Ayarlar</span></a>
                                            </li>
                                            <li class="kt-menu__item" aria-haspopup="true">
                                                <a href="{{route('user.index')}}" class="kt-menu__link ">
                                                    <span class="kt-menu__link-text">Kullanıcılar</span></a>
                                            </li>
                                            <li class="kt-menu__item" aria-haspopup="true">
                                                <a href="{{route('file.index')}}" class="kt-menu__link ">
                                                    <span class="kt-menu__link-text">Dosyalar</span></a>
                                            </li>
                                            <li class="kt-menu__item" aria-haspopup="true">
                                                <a href="{{route('socialmedia.index')}}" class="kt-menu__link ">
                                                    <span class="kt-menu__link-text">Sosyal Medya Hesapları</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-header__topbar kt-grid__item">
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                <span class="kt-header__topbar-welcome">Hoşgeldin</span>
                                <span class="kt-header__topbar-username">{!! Str::words(Auth::user()->name, 1, ''); !!}</span>
                                @if (is_null(Auth::user()->image))
                                    <img src="/upload/users/blank.jpg" alt="{{Auth::user()->name}}">
                                @else
                                    <img src="/upload/users/{{Auth::user()->image}}" alt="{{Auth::user()->name}}">
                                @endif
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                     style="background-image: url(/admin/assets/media/bg-profile.jpg)">
                                    <div class="kt-user-card__avatar">
                                        @if (is_null(Auth::user()->image))
                                            <img src="/upload/users/blank.jpg" alt="{{Auth::user()->name}}">
                                        @else
                                            <img src="/upload/users/{{Auth::user()->image}}" alt="{{Auth::user()->name}}">
                                        @endif
                                    </div>
                                    <div class="kt-user-card__name">
                                        {{Auth::user()->name}}
                                    </div>
                                </div>
                                <div class="kt-notification">
                                    <a href="{{route('profile.edit')}}" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Profil Ayarları
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Profil bilgilerinizi düzenleyebilirsiniz
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{route('profilepassword.edit')}}" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-lock kt-font-danger"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Parola Değiştir
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Parolanızı değiştirebilirsiniz
                                            </div>
                                        </div>
                                    </a>
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="{{route('admin.logout')}}"
                                           class="btn btn-label btn-label-brand btn-sm btn-bold">Güvenli Çıkış</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                     id="kt_content">
                    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                        <div class="kt-container ">
                            <div class="kt-subheader__main">
                                <h3 class="kt-subheader__title">@yield('title')</h3>
                                <div class="kt-subheader__breadcrumbs">
                                    <a href="{{route('admin.index')}}" class="kt-subheader__breadcrumbs-home"><i
                                                class="flaticon2-shelter"></i></a>
                                    @yield('breadcrumbs')
                                </div>
                            </div>
                            <div class="kt-subheader__toolbar">
                                <div class="kt-subheader__wrapper">
                                    <div class="dropdown dropdown-inline" data-toggle="kt-tooltip"
                                         data-placement="top">
                                        <a href="#" class="btn kt-subheader__btn-secondary"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Hızlı Menü
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('admin.index')}}">Ana Sayfa</a>
                                            <a class="dropdown-item" href="{{route('new.create')}}">Haber Ekle</a>
                                            <a class="dropdown-item" href="{{route('new.index')}}">Haber Listesi</a>
                                            <a class="dropdown-item" href="{{route('page.create')}}">Sayfa Ekle</a>
                                            <a class="dropdown-item" href="{{route('page.index')}}">Sayfa Listesi</a>
                                        </div>
                                    </div>
                                    @yield('pagelink')
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
            <div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer"
                 style="background-image: url('/admin/assets/media/bg-admin-footer.jpg');">
                <div class="kt-footer__bottom">
                    <div class="kt-container ">
                        <div class="kt-footer__wrapper">
                            <div class="kt-footer__logo">
                                <div class="kt-footer__copyright">
                                    Copyright © {{now()->year}} - {{($settings->title)}}
                                </div>
                            </div>
                            <div class="kt-footer__menu">
                                <a href="https://www.100derece.com" target="_blank">Powered by <img height="32px" width="32px" alt="100 Derece" src="/upload/100derece.svg"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<script>
  var KTAppOptions = {
    "colors": {
      "state": {
        "brand"  : "#366cf3",
        "light"  : "#ffffff",
        "dark"   : "#282a3c",
        "primary": "#5867dd",
        "success": "#34bfa3",
        "info"   : "#36a3f7",
        "warning": "#ffb822",
        "danger" : "#fd3995"
      },
      "base" : {
        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
      }
    }
  };
</script>
<script type="text/javascript">
  $(function() {

    toastr.options = {
      "closeButton"      : false,
      "debug"            : false,
      "newestOnTop"      : true,
      "progressBar"      : true,
      "positionClass"    : "toast-bottom-right",
      "preventDuplicates": false,
      "onclick"          : null,
      "showDuration"     : "300",
      "hideDuration"     : "1000",
      "timeOut"          : "5000",
      "extendedTimeOut"  : "1000",
      "showEasing"       : "swing",
      "hideEasing"       : "linear",
      "showMethod"       : "fadeIn",
      "hideMethod"       : "fadeOut"
    };

      @if(session()->has('success'))
      toastr.success("{{session('success')}}", "Başarılı");
      @endif
      @if(session()->has('error'))
      toastr.error("{{session('error')}}", "Başarısız");
      @endif
  });
</script>
@yield('pagejs')
</body>
</html>
