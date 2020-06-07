@extends('admin.layouts.app')
@section('title','Bültenler')

@section('pagelink')
    <a href="{{route('bulletin.index')}}" class="btn btn-danger kt-subheader__btn-options">Bültenler</a>
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
    <a href="{{route('bulletin.index')}}" class="kt-subheader__breadcrumbs-link">Bültenler</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Bülten Düzenle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Bülten Düzenle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('bulletin.update',$bulletin->id)}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Bülten Bilgileri</h3>
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
                                                <label class="col-3 col-form-label">Bülten Başlık *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name" value="{{ ($bulletin->name) }}">
                                                    <span class="form-text text-muted"></span>
                                                    <input class="form-control" type="hidden" name="old_name" value="{{ ($bulletin->name) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Bülten No *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name_id" value="{{ ($bulletin->name_id) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İçerik *</label>
                                                <div class="col-9">
                                                    <textarea id="summernote" name="description" required>{{ ($bulletin->description) }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Tarih</label>
                                                <div class="col-9 input-group date">
                                                    <input type="text" class="form-control" name="date" readonly="" value="{{\Carbon\Carbon::parse($bulletin->date)->format('d.m.Y H:i')}}"
                                                           id="form_datetime">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="la la-calendar-check-o glyphicon-th"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Etiketler</label>
                                                <div class="col-9">
                                                    <input type="text" name="tag" value="{{ ($bulletin->tag) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Fotoğraf</label>
                                                <div class="col-9">
                                                    @if ($bulletin->image)
                                                    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 3px" class="kt-valign-middle kt-align-center mb-3">
                                                        <img src="/upload/bulletins/{{($bulletin->image)}}" width="100%">
                                                    </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Dosya Seçiniz</label>
                                                    </div>
                                                    <input type="hidden" name="old_image" value="{{($bulletin->image)}}">
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen dosya türleri:  jpg, jpeg, png, gif</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum boyut: 25 MB</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum ebat: 4000 x 4000px</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Bülten Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$bulletin->status ? 'checked' : ''}} name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Büyük Fotoğraf Gösterimi</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$bulletin->bigimage ? 'checked' : ''}} name="bigimage"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Başka Siteye Yönlendirme</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="url" name="url" value="{{ ($bulletin->url) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yeni Pencerede Aç</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" {{$bulletin->blank_url ? 'checked' : ''}} value="1" name="blank_url"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-align-right">
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Bülten Güncelle</button>
                                        </div>
                                    </div>

                                </div>
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
              name: {
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

      $(document).ready(function() {
        $('.author').select2();
      });

      $(document).ready(function() {
        $('.category').select2();
      });

      var input = document.querySelector('input[name=tag]');
      new Tagify(input).val();
    </script>
    <style>
        .note-editor.note-airframe, .note-editor.note-frame {
            border: 1px solid #e2e5ec;
        }
    </style>
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
    <script src="/admin/assets/js/summernote-cleaner.js"></script>
    <script src="/admin/assets/js/summernote.js"></script>
@endsection
