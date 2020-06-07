@extends('admin.layouts.app')
@section('title','Sayfalar')

@section('pagelink')
    <a href="{{route('page.create')}}" class="btn btn-danger kt-subheader__btn-options">Sayfa Ekle</a>
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
    <a href="{{route('page.index')}}" class="kt-subheader__breadcrumbs-link">Sayfalar</a>
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
                                        <th>Sayfa</th>
                                        <th class="kt-align-center kt-hidden-mobile">Kategori</th>
                                        <th class="kt-align-center kt-hidden-mobile">Sayfa Durumu</th>
                                        <th class="kt-align-center kt-hidden-mobile">Menü Gösterimi</th>
                                        <th class="kt-align-center kt-hidden-mobile">Yönlendirme</th>
                                        <th class="kt-align-right">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    @foreach($data['page'] as $page)
                                        <tr id="item-{{$page->id}}">
                                            <td class="sortable align-middle">
                                                @if ($page['category_id'] == "dissiad")
                                                    DİŞSİAD
                                                @elseif ($page['category_id'] == "fuarlar")
                                                    FUARLAR
                                                @elseif ($page['category_id'] == "yayinlar")
                                                    YAYINLAR
                                                @elseif ($page['category_id'] == "bilgi-bankasi")
                                                    BİLGİ BANKASI
                                                @else
                                                    -
                                                @endif
                                                 / {{$page['name']}}
                                            </td>
                                            <td class="sortable align-middle kt-align-center kt-hidden-mobile">
                                                @if ($page['category_id'] == "dissiad")
                                                    DİŞSİAD
                                                @elseif ($page['category_id'] == "fuarlar")
                                                    FUARLAR
                                                @elseif ($page['category_id'] == "yayinlar")
                                                    YAYINLAR
                                                @elseif ($page['category_id'] == "bilgi-bankasi")
                                                    BİLGİ BANKASI
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($page->status)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($page->menu_status)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($page->url)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-right">
                                                <a href="{{($settings->url)}}/sayfa/{{($page->slug)}}" target="_blank" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Görüntüle">
                                                    <i class="la la-chain"></i>
                                                </a>
                                                <a href="{{route('page.edit',$page->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Düzenle">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Sil">
                                                    <i id="@php echo $page->id @endphp" class="la la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if (!count($data['page']))
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
            title              : 'Sayfa Silinecek!',
            showCancelButton   : true,
            confirmButtonText  : 'Evet',
            cancelButtonText   : 'Hayır',
            text               : 'Bu işlemden emin misiniz?',
            type               : 'warning',
            confirmButtonColor : '#fd397a',
            showLoaderOnConfirm: true,
            preConfirm         : () => {
              $.ajax({
                url    : 'page/' + destroy_id,
                method : 'DELETE',
                success: function(msg) {
                  if(msg) {
                    $("#item-" + destroy_id).remove();
                    toastr.success("Sayfa silme işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                  } else {
                    toastr.error("Sayfa silme işlemi gerçekleştirilemedi.", "Başarısız");
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
              url    : "{{route('page.sortable')}}",
              success: function(msg) {
                // console.log(msg);

                if(msg) {
                  toastr.success("Sayfa sıralama işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                } else {
                  toastr.error("Sayfa sıralama işlemi gerçekleştirilemedi.", "Başarısız");
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
