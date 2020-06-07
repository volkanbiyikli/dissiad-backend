@extends('admin.layouts.app')
@section('title','Kullanıcılar')

@section('pagelink')
    <a href="{{route('user.create')}}" class="btn btn-danger kt-subheader__btn-options">Kullanıcı Ekle</a>
@endsection

@section('pagestyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sortable {
            cursor: grab;php artisan route:clear
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
    <a href="{{route('user.index')}}" class="kt-subheader__breadcrumbs-link">Kullanıcılar</a>
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
                                        <th>Kullanıcı</th>
                                        <th class="kt-hidden-tablet-and-mobile">E-posta Adresi</th>
                                        <th class="kt-align-center kt-hidden-mobile">Durumu</th>
                                        <th class="kt-align-center kt-hidden-mobile">Rol</th>
                                        <th class="kt-align-right">İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sortable">
                                    @foreach($data['user'] as $user)
                                        <tr id="item-{{$user->id}}">
                                            <td>
                                            <span>
                                                <div class="kt-user-card-v2">
                                                    <div class="kt-user-card-v2__pic kt-margin-r-10">
                                                        @if (is_null($user->image))
                                                            <img src="/upload/users/thumb/blank.jpg" alt="{{$user['name']}}">
                                                        @else
                                                            <img src="/upload/users/thumb/{{$user['image']}}" alt="{{$user['name']}}">
                                                        @endif

                                                    </div>
                                                    <div class="kt-user-card-v2__details">
                                                        {{$user['name']}}
                                                    </div>
                                                </div>
                                            </span>
                                            </td>
                                            <td class="align-middle kt-hidden-tablet-and-mobile">
                                                {{$user['email']}}
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($user->status)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Açık</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kapalı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-center kt-hidden-mobile">
                                                @if ($user->role)
                                                    <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Yönetici</span>
                                                @else
                                                    <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill">Kullanıcı</span>
                                                @endif
                                            </td>
                                            <td class="align-middle kt-align-right">
                                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                   title="Düzenle">
                                                    <i class="la la-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Sil">
                                                    <i id="@php echo $user->id @endphp" class="la la-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @if (!count($data['user']))
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
            title              : 'Kullanıcı Silinecek!',
            showCancelButton   : true,
            confirmButtonText  : 'Evet',
            cancelButtonText   : 'Hayır',
            text               : 'Bu işlemden emin misiniz?',
            type               : 'warning',
            confirmButtonColor : '#fd397a',
            showLoaderOnConfirm: true,
            preConfirm         : () => {
              $.ajax({
                url    : 'user/' + destroy_id,
                method : 'DELETE',
                success: function(msg) {
                  if(msg) {
                    $("#item-" + destroy_id).remove();
                    toastr.success("Kullanıcı silme işlemi başarılı olarak gerçekleştirildi.", "Başarılı");
                  } else {
                    toastr.error("Kullanıcı silme işlemi gerçekleştirilemedi.", "Başarısız");
                  }
                }
              })
            }
          })
        });
      });
    </script>

@endsection
