@extends('admin.layouts.app')
@section('title','Sliderlar')

@section('pagelink')
    <a href="{{route('slider.create')}}" class="btn btn-danger kt-subheader__btn-options">Slider Ekle</a>
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
    <a href="{{route('slider.index')}}" class="kt-subheader__breadcrumbs-link">Sliderlar</a>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">

                    <div class="kt-portlet__body">

                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Slider</th>
                                        <th class="kt-align-center kt-hidden-mobile">Slider Durumu</th>
                                        <th class="kt-align-center kt-hidden-mobile">Link</th>
                                        <th class="kt-align-right">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    @foreach($data['slider'] as $slider)
                                        <tr id="item-{{$slider->id}}">
                                            <td class="sortable align-middle">
                                                {{$slider['name']}}
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($slider->status)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="sortable kt-align-center align-middle">
                                                {{$slider['url']}}
                                            </td>
                                            <td class="align-middle kt-align-right">
                                                <a href="{{($slider->url)}}" target="_blank" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Görüntüle">
                                                    <i class="la la-chain"></i>
                                                </a>
                                                <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Düzenle">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Sil">
                                                    <i id="@php echo $slider->id @endphp" class="la la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if (!count($data['slider']))
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

        $('.la-trash').click(function(e) {
          destroy_id = $(this).attr('id');
          swal.fire({
            title              : 'Slider Silinecek!',
            showCancelButton   : true,
            confirmButtonText  : 'Evet',
            cancelButtonText   : 'Hayır',
            text               : 'Bu işlemden emin misiniz?',
            type               : 'warning',
            confirmButtonColor : '#fd397a',
            showLoaderOnConfirm: true,
            preConfirm         : () => {
              $.ajax({
                url    : 'slider/' + destroy_id,
                method : 'DELETE',
                success: function(msg) {
                  if(msg) {
                    $("#item-" + destroy_id).remove();
                    toastr.success("Slider silme işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                  } else {
                    toastr.error("Slider silme işlemi gerçekleştirilemedi.", "Başarısız");
                  }
                }
              })
            }
          })
        });

        $('#sortable').sortable({
          revert: true,
          handle: ".sortable",
          stop  : function(event, ui) {
            var data = $(this).sortable('serialize');
            $.ajax({
              type   : "POST",
              data   : data,
              url    : "{{route('slider.sortable')}}",
              success: function(msg) {
                // console.log(msg);

                if(msg) {
                  toastr.success("Slider sıralama işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                } else {
                  toastr.error("Slider sıralama işlemi gerçekleştirilemedi.", "Başarısız");
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
