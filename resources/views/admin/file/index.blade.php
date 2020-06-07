@extends('admin.layouts.app')
@section('title','Dosyalar')

@section('pagelink')
    <a href="{{route('file.create')}}" class="btn btn-danger kt-subheader__btn-options">Dosya Ekle</a>
@endsection

@section('pagestyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('pagevendors')
@endsection

@section('pagescripts')
    <script src="/admin/assets/plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('file.index')}}" class="kt-subheader__breadcrumbs-link">Dosyalar</a>
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
                                        <th>Dosya</th>
                                        <th class="kt-align-center kt-hidden-mobile">Link</th>
                                        <th class="kt-align-right">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    @foreach($data['file'] as $file)
                                        <tr id="item-{{$file->id}}">
                                            <td class="sortable align-middle">
                                                {{$file['name']}}
                                            </td>
                                            <td class="sortable kt-align-center align-middle">
                                                {{($settings->url)}}/upload/files/{{($file->file)}}
                                            </td>
                                            <td class="align-middle kt-align-right">
                                                <a href="{{($settings->url)}}/upload/files/{{($file->file)}}" target="_blank" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Görüntüle">
                                                    <i class="la la-chain"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Sil">
                                                    <i id="@php echo $file->id @endphp" class="la la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if (!count($data['file']))
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
            title              : 'Dosya Silinecek!',
            showCancelButton   : true,
            confirmButtonText  : 'Evet',
            cancelButtonText   : 'Hayır',
            text               : 'Bu işlemden emin misiniz?',
            type               : 'warning',
            confirmButtonColor : '#fd397a',
            showLoaderOnConfirm: true,
            preConfirm         : () => {
              $.ajax({
                url    : 'file/' + destroy_id,
                method : 'DELETE',
                success: function(msg) {
                  if(msg) {
                    $("#item-" + destroy_id).remove();
                    toastr.success("Dosya silme işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                  } else {
                    toastr.error("Dosya silme işlemi gerçekleştirilemedi.", "Başarısız");
                  }
                }
              })
            }
          })
        });

      });
    </script>
@endsection
