@extends('admin.layouts.app')
@section('title','Sosyal Medya')

@section('pagelink')
    <a href="{{route('socialmedia.index')}}" class="btn btn-danger kt-subheader__btn-options">Sosyal Medya Hesapları</a>
@endsection

@section('pagestyles')
@endsection

@section('pagevendors')
@endsection

@section('pagescripts')
@endsection

@section('breadcrumbs')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('socialmedia.index')}}" class="kt-subheader__breadcrumbs-link">Sosyal Medya Hesapları</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Sosyal Medya Düzenle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{($socialmedia->name)}} Düzenle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('socialmedia.update',$socialmedia->id)}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
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

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Sosyal Medya Hesabı</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name" value="{{($socialmedia->name)}}" disabled>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Adres</label>
                                                <div class="col-9">
                                                    <input class="form-control" @if ($socialmedia->id==7) type="text" @else type="url" @endif name="url" value="{{($socialmedia->url)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Renk</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="color" name="color" value="{{($socialmedia->color)}}" id="example-color-input">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Durum</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" {{$socialmedia->status ? 'checked' : ''}} value="1" name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-align-right">
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
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
              url: {
                required: true,
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
    <script src="/admin/assets/js/pages/crud/file-upload/ktavatar.js" type="text/javascript"></script>
@endsection
