@extends('admin.layouts.app')
@section('title','Genel Ayarlar')

@section('pagelink')
@endsection

@section('pagestyles')
@endsection

@section('pagevendors')
@endsection

@section('pagescripts')
@endsection

@section('breadcrumbs')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Genel Ayarlar</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Genel Ayarlar</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('setting.update')}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
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

                                            <h3 class="kt-section__title kt-section__title-lg">Web Sitesi Bilgileri</h3>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Web Sitesi Adresi *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="url" name="url" value="{{($settings->url)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Site Başlığı *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="title" value="{{($settings->title)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Site Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$settings->status ? 'checked' : ''}} name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Site Açıklaması *</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="description" rows="5">{{($settings->description)}}</textarea>
                                                </div>
                                            </div>

                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                            <h3 class="kt-section__title kt-section__title-lg">İletişim Bilgileri</h3>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Adres</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="address" rows="5">{{($settings->address)}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Telefon</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="telephone" value="{{($settings->telephone)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Faks</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="fax" value="{{($settings->fax)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">E-posta</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="email" value="{{($settings->email)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Harita Kodu</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="map" rows="5">{{($settings->map)}}</textarea>
                                                </div>
                                            </div>

                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                            <h3 class="kt-section__title kt-section__title-lg">Arama Motoru Bilgileri</h3>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Google Analytics Kodu</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="analytics" rows="5">{{($settings->analytics)}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Arama Motorları İndekslemesin</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$settings->noindex ? 'checked' : ''}} name="noindex"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Seo Açıklaması *</label>
                                                <div class="col-9">
                                                    <textarea class="form-control" name="seo_description" rows="5">{{($settings->seo_description)}}</textarea>
                                                </div>
                                            </div>

                                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Twitter Kullanıcı Adı*</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="twitter" value="{{($settings->twitter)}}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Facebook Sayfa Adı*</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="url" name="facebook" value="{{($settings->facebook)}}">
                                                    <span class="form-text text-muted"></span>
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
              url            : {
                required: true,
              },
              title          : {
                required: true
              },
              description    : {
                required: true,
              },
              seo_description: {
                required: true
              },
              twitter        : {
                required: true
              },
              facebook       : {
                required: true
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
@endsection
