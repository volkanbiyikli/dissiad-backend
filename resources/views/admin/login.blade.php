<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <title>{{($settings->title)}} - Yönetici Panel Girişi</title>
    <meta name="description" content="Yönetici Panel Girişi">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link href="/admin/assets/css/pages/login/login.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="/upload/admin/favicon.ico"/>
    <script src="/admin/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="/admin/assets/js/scripts.bundle.js" type="text/javascript"></script>
</head>

<body style="background-image: url(/admin/assets/media/demos/demo4/header.jpg); background-position: center top; background-size: 100% 350px;"
      class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
            <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                <div class="kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__body">
                            <div class="kt-login__logo">
                                <a href="#">
                                    <img src="/upload/admin/admin-logo-login.png">
                                </a>
                            </div>

                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">{{ $settings->title }}</h3>
                                    <h3 class="kt-login__title">YÖNETİCİ PANEL GİRİŞİ</h3>
                                </div>
                                <div class="kt-login__form">

                                    @if (Session::has('error'))
                                        <div class="alert alert-danger fade show" role="alert">
                                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                            <div class="alert-text">{{session('error')}}</div>
                                            <div class="alert-close">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Session::has('success'))
                                        <div class="alert alert-success fade show" role="alert">
                                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                            <div class="alert-text">{{session('success')}}</div>
                                            <div class="alert-close">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <form class="kt-form" action="{{route('admin.authenticate')}}" class="kt-form" id="kt_form" method="post">
                                        @CSRF

                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="E-posta Adresiniz" name="email" value="{{old('email')}}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-last" type="password" placeholder="Parolanız" name="password">
                                        </div>
                                        <div class="kt-login__extra">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember_me" {{old('remember_me') ? 'checked': ''}}> Beni Hatırla
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_signin_submit" class="btn btn-brand btn-pill btn-elevate">Giriş Yap</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-login__account">
                    <span class="kt-login__account-msg">
                        COPYRIGHT © {{ now()->year }} - {{ $settings->title }}
                    </span>&nbsp;&nbsp;
                    </div>
                </div>
            </div>

            <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url(/admin/assets/media/bg-login.jpg);">
            </div>
        </div>
    </div>
</div>

<script>
  var KTAppOptions = {"colors": {"state": {"brand": "#366cf3", "light": "#ffffff", "dark": "#282a3c", "primary": "#5867dd", "success": "#34bfa3", "info": "#36a3f7", "warning": "#ffb822", "danger": "#fd3995"}, "base": {"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"], "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]}}};
</script>
<script>
  var KTFormControls = function() {

    var form = function() {
      $("#kt_form").validate({
        rules: {
          email   : {
            required: true,
          },
          password: {
            required: true
          }
        },

        invalidHandler: function(event, validator) {
          KTUtil.scrollTop();
        },

        submitHandler: function(form) {
          form[0].submit();
        }
      });
    };

    return {
      init: function() {
        form();
      }
    };
  }();

  jQuery(document).ready(function() {
    KTFormControls.init();
  });
</script>
</body>
</html>
