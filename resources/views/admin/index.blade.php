@extends('admin.layouts.app')
@section('title','Başlangıç')

@section('pagelink')
@endsection

@section('pagestyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sortable {
            cursor: grab;
        }
    </style>
@endsection

@section('pagevendors')
@endsection

@section('pagescripts')
    <script src="/admin/assets/plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">

        {{--        <div class="row">
                    <div class="col">
                        <div class="alert alert-light alert-elevate fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                            <div class="alert-text">
                                The largest database of free icons available in PNG, SVG, EPS, PSD and BASE 64 formats.
                                <br>
                                For more info please visit the plugin's
                                <a class="kt-link kt-font-bold" href="https://www.flaticon.com/" target="_blank">Demo Page</a>.
                            </div>
                        </div>
                    </div>
                </div>--}}


        <div class="row">

            <div class="col-xl-6 mb-4">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-2">
                            <h3 class="font-weight-bolder">Haberler</h3>
                            <div class="text-dark-50 font-size-lg mt-2">
                                <a href="{{ route('new.create') }}">Yeni Haber Ekle</a>
                            </div>
                        </div>
                        <a href="{{ route('new.index') }}" class="btn btn-primary font-weight-bold py-3 px-6">Haberleri Listele</a>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 mb-4">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-2">
                            <h3 class="font-weight-bolder">Yazarlar</h3>
                            <div class="text-dark-50 font-size-lg mt-2">
                                <a href="{{ route('new.create') }}">Yeni Yazar Ekle</a>
                            </div>
                        </div>
                        <a href="{{ route('new.index') }}" class="btn btn-primary font-weight-bold py-3 px-6">Yazarları Listele</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-2">
                            <h3 class="font-weight-bolder">Sayfalar</h3>
                            <div class="text-dark-50 font-size-lg mt-2">
                                <a href="{{ route('page.create') }}">Yeni Sayfa Ekle</a>
                            </div>
                        </div>
                        <a href="{{ route('page.index') }}" class="btn btn-primary font-weight-bold py-3 px-6">Sayfaları Listele</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 mb-4">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-2">
                            <h3 class="font-weight-bolder">Videolar</h3>
                            <div class="text-dark-50 font-size-lg mt-2">
                                <a href="video">Yeni Video Ekle</a>
                            </div>
                        </div>
                        <a href="video" class="btn btn-primary font-weight-bold py-3 px-6">Videoları Listele</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('pagejs')
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

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('.la-trash').click(function(e) {
          destroy_id = $(this).attr('id');
          swal.fire({
            title              : 'Haber Silinecek!',
            showCancelButton   : true,
            confirmButtonText  : 'Evet',
            cancelButtonText   : 'Hayır',
            text               : 'Bu işlemden emin misiniz?',
            type               : 'warning',
            confirmButtonColor : '#fd397a',
            showLoaderOnConfirm: true,
            preConfirm         : () => {
              $.ajax({
                url    : 'new/' + destroy_id,
                method : 'DELETE',
                success: function(msg) {
                  if(msg) {
                    $("#item-" + destroy_id).remove();
                    toastr.success("Haber silme işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                  } else {
                    toastr.error("Haber silme işlemi gerçekleştirilemedi.", "Başarısız");
                  }
                }
              })
            }
          })
        });

      });
    </script>

@endsection
