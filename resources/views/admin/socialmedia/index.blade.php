@extends('admin.layouts.app')
@section('title','Sosyal Medya Hesapları')

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
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('socialmedia.index')}}" class="kt-subheader__breadcrumbs-link">Sosyal Medya Hesapları</a>
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
            <div class="col-md-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    {{--                                        <div class="kt-portlet__head">
                                                                <div class="kt-portlet__head-label">
                                                                    <span class="kt-portlet__head-icon kt-hidden">
                                                                        <i class="la la-gear"></i>
                                                                    </span>
                                                                    <h3 class="kt-portlet__head-title">Başlık...</h3>
                                                                </div>
                                                            </div>--}}

                    <div class="kt-portlet__body">

                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Sosyal Medya Hesabı</th>
                                        <th class="kt-hidden-tablet-and-mobile">Adres</th>
                                        <th class="kt-align-center kt-hidden-mobile">Durumu</th>
                                        <th class="kt-align-right">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    @foreach($data['socialmedia'] as $socialmedia)
                                        <tr id="item-{{$socialmedia->id}}">
                                            <td class="sortable">
                                            <span>
                                                <div class="kt-user-card-v2">
                                                    <div class="kt-badge kt-badge--xl kt-badge--primary kt-margin-r-10"
                                                         style="max-width: 40px; max-height: 40px; background-color:{{$socialmedia['color']}}">
                                                        <i class="{{$socialmedia['icon']}}"></i>
                                                    </div>
                                                    <div class="kt-user-card-v2__details">
                                                        {{$socialmedia['name']}}
                                                    </div>
                                                </div>
                                            </span>
                                            </td>
                                            <td class="align-middle kt-hidden-tablet-and-mobile">
                                                {{$socialmedia['url']}}
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($socialmedia->status)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-right">
                                                <a href="{{route('socialmedia.edit',$socialmedia->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Düzenle">
                                                    <i class="la la-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if (!count($data['socialmedia']))
                                    <div class="col-xl-12 kt-align-center mt-5">Kayıt Bulunamadı</div>
                                @endif
                            </div>
                        </div>

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

        $('#sortable').sortable({
          revert: true,
          handle: ".sortable",
          stop  : function(event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
              type   : "POST",
              data   : data,
              url    : "{{route('socialmedia.sortable')}}",
              success: function(msg) {
                // console.log(msg);

                if(msg) {
                  toastr.success("Sosyal medya sıralama işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                } else {
                  toastr.error("Sosyal medya sıralama işlemi gerçekleştirilemedi.", "Başarısız");
                }
              }
            });
          }
        });

        $('table tbody').sortable({
          helper: fixWidthHelper
        }).disableSelection();

        function fixWidthHelper(e, ui) {
          ui.children().each(function() {
            $(this).width($(this).width());
          });
          return ui;
        }

      });
    </script>

@endsection
