@extends('admin.layouts.app')
@section('title','Sliderlar')

@section('pagelink')
    <a href="{{route('slider.index')}}" class="btn btn-danger kt-subheader__btn-options">Sliderlar</a>
@endsection

@section('pagestyles')
@endsection

@section('pagevendors')
@endsection

@section('pagescripts')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/lang/summernote-tr-TR.js"></script>
@endsection

@section('breadcrumbs')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route('slider.index')}}" class="kt-subheader__breadcrumbs-link">Sliderlar</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Slider Ekle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Slider Ekle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Slider Bilgileri</h3>
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
                                                <label class="col-3 col-form-label">Slider Adı *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Açıklama *</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="description" rows="5">{{old('description')}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Fotoğraf *</label>
                                                <div class="col-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Dosya Seçiniz</label>
                                                    </div>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen dosya türleri:  jpg, jpeg, png, gif</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum boyut: 25 MB</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum ebat: 4000 x 4000px</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Slider Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" checked="checked" name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yönlendirme Linki *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="url" name="url" value="{{old('url')}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yeni Pencerede Aç</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" name="blank_url"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-align-right">
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Slider Ekle</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>
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
              name: {
                required: true,
              },
              description: {
                required: true,
              },
              image: {
                required: true,
              },
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
    <style>
        .note-editor.note-airframe, .note-editor.note-frame {
            border: 1px solid #e2e5ec;
        }
    </style>
    <script src="/admin/assets/js/summernote-cleaner.js"></script>
    <script src="/admin/assets/js/summernote.js"></script>
@endsection
