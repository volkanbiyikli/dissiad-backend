@extends('admin.layouts.app')
@section('title','Kullanıcılar')

@section('pagelink')
    <a href="{{route('user.index')}}" class="btn btn-danger kt-subheader__btn-options">Kullanıcılar</a>
@endsection

@section('pagestyles')
@endsection

@section('pagevendors')
@endsection

@section('pagescripts')
@endsection

@section('breadcrumbs')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('user.index')}}" class="kt-subheader__breadcrumbs-link">Kullanıcılar</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Kullanıcı Düzenle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Kullanıcı Düzenle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                    <div class="alert alert-solid-danger" role="alert">
                                                        <div class="alert-text">{{$error}}</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="la la-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                            <h3 class="kt-section__title kt-section__title-lg">Kullanıcı Bilgileri</h3>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Ad Soyad *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name" value="{{($user->name)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">E-posta *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="email" name="email" value="{{($user->email)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Parola *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="password" name="password">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Parola Tekrar *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="password" name="password_confirmation">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Fotoğraf</label>
                                                <div class="col-9">
                                                    <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_user_avatar_3">
                                                        @if (is_null($user->image))
                                                            <div class="kt-avatar__holder" style="background-image: url(/upload/users/thumb/blank.jpg)"></div>
                                                        @else
                                                            <div class="kt-avatar__holder" style="background-image: url(/upload/users/{{($user->image)}})"></div>
                                                        @endif
                                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Fotoğraf Seç">
                                                            <i class="fa fa-pen"></i>
                                                            <input type="file" name="image" accept="image/*">
                                                        </label>
                                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Fotoğraf Sil">
                                                            <i class="fa fa-times"></i>
                                                        </span>
                                                        <input type="hidden" name="old_image" value="{{($user->image)}}">
                                                    </div>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen dosya türleri:  jpg, jpeg, png, gif</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum boyut: 25 MB</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum ebat: 4000 x 4000px</span>
                                                </div>
                                            </div>

                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                            <h3 class="kt-section__title kt-section__title-lg">Kullanıcı Ayarları</h3>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Kullanıcı Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$user->status ? 'checked' : ''}} name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yönetici</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" {{$user->role ? 'checked' : ''}} value="1" name="role"><span></span></label>
							                        </span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-align-right">
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Kullanıcı Güncelle</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-2"></div>
                            </div>
                        </form>


                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script>
      var KTFormControls = function() {

        var form = function() {
          $("#kt_form").validate({
            rules: {
              name                 : {
                required: true,
              },
              email                : {
                required: true,
                email   : true
              },
              password             : {
                required : true,
                minlength: 6
              },
              password_confirmation: {
                required : true,
                minlength: 6
              },
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
    <script src="/admin/assets/js/pages/crud/file-upload/ktavatar.js" type="text/javascript"></script>
@endsection
