@extends('admin.layouts.app')
@section('title','Üyeler')

@section('pagelink')
    <a href="{{route('member.index')}}" class="btn btn-danger kt-subheader__btn-options">Üyeler</a>
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
    <a href="{{route('member.index')}}" class="kt-subheader__breadcrumbs-link">Üyeler</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span class="kt-subheader__breadcrumbs-link">Üye Ekle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Üye Ekle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('member.store')}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Üye Bilgileri</h3>
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
                                                <label class="col-3 col-form-label">Üye Adı *</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yetki Belgesi</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="license" value="{{ old('license') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Adres</label>
                                                <div class="col-9">
                                                    <textarea name="address" rows="5" class="form-control">{{ old('address') }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Kategori</label>
                                                <div class="col-9">
                                                    <select name="city" class="form-control">
                                                        <option value="0">Lütfen Bir İl Seçiniz!</option>
                                                        <option value="1">Adana</option>
                                                        <option value="2">Adıyaman</option>
                                                        <option value="3">Afyonkarahisar</option>
                                                        <option value="4">Ağrı</option>
                                                        <option value="5">Amasya</option>
                                                        <option value="6">Ankara</option>
                                                        <option value="7">Antalya</option>
                                                        <option value="8">Artvin</option>
                                                        <option value="9">Aydın</option>
                                                        <option value="10">Balıkesir</option>
                                                        <option value="11">Bilecik</option>
                                                        <option value="12">Bingöl</option>
                                                        <option value="13">Bitlis</option>
                                                        <option value="14">Bolu</option>
                                                        <option value="15">Burdur</option>
                                                        <option value="16">Bursa</option>
                                                        <option value="17">Çanakkale</option>
                                                        <option value="18">Çankırı</option>
                                                        <option value="19">Çorum</option>
                                                        <option value="20">Denizli</option>
                                                        <option value="21">Diyarbakır</option>
                                                        <option value="22">Edirne</option>
                                                        <option value="23">Elazığ</option>
                                                        <option value="24">Erzincan</option>
                                                        <option value="25">Erzurum</option>
                                                        <option value="26">Eskişehir</option>
                                                        <option value="27">Gaziantep</option>
                                                        <option value="28">Giresun</option>
                                                        <option value="29">Gümüşhane</option>
                                                        <option value="30">Hakkâri</option>
                                                        <option value="31">Hatay</option>
                                                        <option value="32">Isparta</option>
                                                        <option value="33">Mersin</option>
                                                        <option value="34">İstanbul</option>
                                                        <option value="35">İzmir</option>
                                                        <option value="36">Kars</option>
                                                        <option value="37">Kastamonu</option>
                                                        <option value="38">Kayseri</option>
                                                        <option value="39">Kırklareli</option>
                                                        <option value="40">Kırşehir</option>
                                                        <option value="41">Kocaeli</option>
                                                        <option value="42">Konya</option>
                                                        <option value="43">Kütahya</option>
                                                        <option value="44">Malatya</option>
                                                        <option value="45">Manisa</option>
                                                        <option value="46">Kahramanmaraş</option>
                                                        <option value="47">Mardin</option>
                                                        <option value="48">Muğla</option>
                                                        <option value="49">Muş</option>
                                                        <option value="50">Nevşehir</option>
                                                        <option value="51">Niğde</option>
                                                        <option value="52">Ordu</option>
                                                        <option value="53">Rize</option>
                                                        <option value="54">Sakarya</option>
                                                        <option value="55">Samsun</option>
                                                        <option value="56">Siirt</option>
                                                        <option value="57">Sinop</option>
                                                        <option value="58">Sivas</option>
                                                        <option value="59">Tekirdağ</option>
                                                        <option value="60">Tokat</option>
                                                        <option value="61">Trabzon</option>
                                                        <option value="62">Tunceli</option>
                                                        <option value="63">Şanlıurfa</option>
                                                        <option value="64">Uşak</option>
                                                        <option value="65">Van</option>
                                                        <option value="66">Yozgat</option>
                                                        <option value="67">Zonguldak</option>
                                                        <option value="68">Aksaray</option>
                                                        <option value="69">Bayburt</option>
                                                        <option value="70">Karaman</option>
                                                        <option value="71">Kırıkkale</option>
                                                        <option value="72">Batman</option>
                                                        <option value="73">Şırnak</option>
                                                        <option value="74">Bartın</option>
                                                        <option value="75">Ardahan</option>
                                                        <option value="76">Iğdır</option>
                                                        <option value="77">Yalova</option>
                                                        <option value="78">Karabük</option>
                                                        <option value="79">Kilis</option>
                                                        <option value="80">Osmaniye</option>
                                                        <option value="81">Düzce</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yetkili</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="authorized" value="{{ old('authorized') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yetkili E-posta</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="authorized_email" value="{{ old('authorized_email') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Telefon</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="telephone" value="{{ old('telephone') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Faks</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="fax" value="{{ old('fax') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">E-posta</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="email" value="{{ old('email') }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Web Sitesi</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="url" name="url" value="{{old('url')}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İmalat</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" name="product"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İhracat</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" name="export"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İthalat</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" name="import"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Şirket Profili</label>
                                                <div class="col-9">
                                                    <textarea id="summernote" name="profile">{{ old('profile') }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Harita Kodu</label>
                                                <div class="col-9">
                                                    <textarea name="map" rows="5" class="form-control">{{ old('map') }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Logo</label>
                                                <div class="col-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Dosya Seçiniz</label>
                                                    </div>
                                                    <span class="form-text text-muted kt-mt-10">
                                                        Kabul edilen dosya türleri:  jpg, jpeg, png, gif<br>
                                                        Kabul edilen maksimum boyut: 25 MB <br>
                                                        Kabul edilen maksimum ebat: 4000 x 4000px
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Üye Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" checked="checked" name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="kt-align-right">
                                        <div class="kt-form__actions">
                                            <button type="submit" class="btn btn-primary">Üye Ekle</button>
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
