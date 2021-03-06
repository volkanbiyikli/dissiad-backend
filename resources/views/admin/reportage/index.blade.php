@extends('admin.layouts.app')
@section('title','Röportajlar')

@section('pagelink')
    <a href="{{route('reportage.create')}}" class="btn btn-danger kt-subheader__btn-options">Röportaj Ekle</a>
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
    <a href="{{route('reportage.index')}}" class="kt-subheader__breadcrumbs-link">Röportajlar</a>
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
                                        <th>Röportaj</th>
                                        <th class="kt-align-center kt-hidden-mobile">Tarih</th>
                                        <th class="kt-align-center kt-hidden-mobile">Durum</th>
                                        <th class="kt-align-right">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    @foreach($data['reportage'] as $reportage)
                                        <tr id="item-{{$reportage->id}}">
                                            <td class="sortable align-middle">
                                                {{$reportage['name']}}
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                {{\Carbon\Carbon::parse($reportage['date'])->isoFormat('DD MMMM YYYY')}}
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($reportage->status)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-right">
                                                <a href="{{($settings->url)}}/roportaj/{{($reportage->slug)}}" target="_blank" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Görüntüle">
                                                    <i class="la la-chain"></i>
                                                </a>
                                                <a href="{{route('reportage.edit',$reportage->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Düzenle">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Sil">
                                                    <i id="@php echo $reportage->id @endphp" class="la la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if (!count($data['reportage']))
                                    <div class="col-xl-12 kt-align-center mt-5">Kayıt Bulunamadı</div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-center">
                                {{  $data['reportage']->links() }}
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
          "reportageestOnTop"      : true,
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
            title              : 'Röportaj Silinecek!',
            showCancelButton   : true,
            confirmButtonText  : 'Evet',
            cancelButtonText   : 'Hayır',
            text               : 'Bu işlemden emin misiniz?',
            type               : 'warning',
            confirmButtonColor : '#fd397a',
            showLoaderOnConfirm: true,
            preConfirm         : () => {
              $.ajax({
                url    : 'reportage/' + destroy_id,
                method : 'DELETE',
                success: function(msg) {
                  if(msg) {
                    $("#item-" + destroy_id).remove();
                    toastr.success("Röportaj silme işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                  } else {
                    toastr.error("Röportaj silme işlemi gerçekleştirilemedi.", "Başarısız");
                  }
                }
              })
            }
          })
        });

      });
    </script>

@endsection
