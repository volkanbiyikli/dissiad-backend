@extends('admin.layouts.app')
@section('title','Videolar')

@section('pagelink')
    <a href="{{route('video.index')}}" class="btn btn-danger kt-subheader__btn-options">Videolar</a>
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
    <a href="{{route('video.index')}}" class="kt-subheader__breadcrumbs-link">Videolar</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Video Düzenle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Video Düzenle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('video.update',$video->id)}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Video Bilgileri</h3>
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
                                                <label class="col-3 col-form-label">Video Adı *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name" value="{{($video->name)}}">
                                                    <span class="form-text text-muted"></span>
                                                    <input class="form-control" type="hidden" name="old_name" value="{{($video->name)}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Tarih</label>
                                                <div class="col-9 input-group date">
                                                    <input type="text" class="form-control" name="date" readonly="" value="{{\Carbon\Carbon::parse($video->date)->format('d.m.Y H:i')}}"
                                                           id="form_datetime">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Video Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$video->status ? 'checked' : ''}} name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Youtube Video Kodu</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="url" value="{{($video->url)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-align-right">
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Video Güncelle</button>
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
              name       : {
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

      $('#summernote').summernote({
        lang   : 'tr-TR',
        tabsize: 2,
        height : 500,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview']]
        ]
      });
    </script>
    <script type="text/javascript" src="/admin/assets/js/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/admin/assets/js/datetimepicker/locales/bootstrap-datetimepicker.tr.js" charset="UTF-8"></script>
    <script type="text/javascript">
      $('#form_datetime').datetimepicker({
        language      : 'tr',
        weekStart     : 1,
        todayBtn      : 1,
        autoclose     : 1,
        todayHighlight: 1,
        startView     : 2,
        forceParse    : 0,
        showMeridian  : 1,
        format        : 'dd.mm.yyyy hh:ii'
      });
    </script>
    <style>
        .note-editor.note-airframe, .note-editor.note-frame {
            border: 1px solid #e2e5ec;
        }
    </style>
@endsection
