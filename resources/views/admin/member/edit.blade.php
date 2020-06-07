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
    <span class="kt-subheader__breadcrumbs-link">Üye Düzenle</span>
@endsection

@section('content')
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="kt-portlet kt-portlet--tab">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">Üye Düzenle</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <form action="{{route('member.update',$member->id)}}" method="post" enctype="multipart/form-data" class="kt-form" id="kt_form" novalidate="novalidate">
                            @csrf
                            @method('PUT')
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
                                                    <input class="form-control" type="text" name="name" value="{{ ($member->name) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yetki Belgesi</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="license" value="{{ ($member->license) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Adres</label>
                                                <div class="col-9">
                                                    <textarea name="address" rows="5" class="form-control">{{ ($member->address) }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Kategori</label>
                                                <div class="col-9">
                                                    <select name="city" class="form-control">
                                                        <option value="0">Lütfen Bir İl Seçiniz!</option>
                                                        <option value="1" {{$member->city==1 ? 'selected' : ''}}>Adana</option>
                                                        <option value="2" {{$member->city==2 ? 'selected' : ''}}>Adıyaman</option>
                                                        <option value="3" {{$member->city==3 ? 'selected' : ''}}>Afyonkarahisar</option>
                                                        <option value="4" {{$member->city==4 ? 'selected' : ''}}>Ağrı</option>
                                                        <option value="5" {{$member->city==5 ? 'selected' : ''}}>Amasya</option>
                                                        <option value="6" {{$member->city==6 ? 'selected' : ''}}>Ankara</option>
                                                        <option value="7" {{$member->city==7 ? 'selected' : ''}}>Antalya</option>
                                                        <option value="8" {{$member->city==8 ? 'selected' : ''}}>Artvin</option>
                                                        <option value="9" {{$member->city==9 ? 'selected' : ''}}>Aydın</option>
                                                        <option value="10" {{$member->city==10 ? 'selected' : ''}}>Balıkesir</option>
                                                        <option value="11" {{$member->city==11 ? 'selected' : ''}}>Bilecik</option>
                                                        <option value="12" {{$member->city==12 ? 'selected' : ''}}>Bingöl</option>
                                                        <option value="13" {{$member->city==13 ? 'selected' : ''}}>Bitlis</option>
                                                        <option value="14" {{$member->city==14 ? 'selected' : ''}}>Bolu</option>
                                                        <option value="15" {{$member->city==15 ? 'selected' : ''}}>Burdur</option>
                                                        <option value="16" {{$member->city==16 ? 'selected' : ''}}>Bursa</option>
                                                        <option value="17" {{$member->city==17 ? 'selected' : ''}}>Çanakkale</option>
                                                        <option value="18" {{$member->city==18 ? 'selected' : ''}}>Çankırı</option>
                                                        <option value="19" {{$member->city==19 ? 'selected' : ''}}>Çorum</option>
                                                        <option value="20" {{$member->city==20 ? 'selected' : ''}}>Denizli</option>
                                                        <option value="21" {{$member->city==21 ? 'selected' : ''}}>Diyarbakır</option>
                                                        <option value="22" {{$member->city==22 ? 'selected' : ''}}>Edirne</option>
                                                        <option value="23" {{$member->city==23 ? 'selected' : ''}}>Elazığ</option>
                                                        <option value="24" {{$member->city==24 ? 'selected' : ''}}>Erzincan</option>
                                                        <option value="25" {{$member->city==25 ? 'selected' : ''}}>Erzurum</option>
                                                        <option value="26" {{$member->city==26 ? 'selected' : ''}}>Eskişehir</option>
                                                        <option value="27" {{$member->city==27 ? 'selected' : ''}}>Gaziantep</option>
                                                        <option value="28" {{$member->city==28 ? 'selected' : ''}}>Giresun</option>
                                                        <option value="29" {{$member->city==29 ? 'selected' : ''}}>Gümüşhane</option>
                                                        <option value="30" {{$member->city==30 ? 'selected' : ''}}>Hakkâri</option>
                                                        <option value="31" {{$member->city==31 ? 'selected' : ''}}>Hatay</option>
                                                        <option value="32" {{$member->city==32 ? 'selected' : ''}}>Isparta</option>
                                                        <option value="33" {{$member->city==33 ? 'selected' : ''}}>Mersin</option>
                                                        <option value="34" {{$member->city==34 ? 'selected' : ''}}>İstanbul</option>
                                                        <option value="35" {{$member->city==35 ? 'selected' : ''}}>İzmir</option>
                                                        <option value="36" {{$member->city==36 ? 'selected' : ''}}>Kars</option>
                                                        <option value="37" {{$member->city==37 ? 'selected' : ''}}>Kastamonu</option>
                                                        <option value="38" {{$member->city==38 ? 'selected' : ''}}>Kayseri</option>
                                                        <option value="39" {{$member->city==39 ? 'selected' : ''}}>Kırklareli</option>
                                                        <option value="40" {{$member->city==40 ? 'selected' : ''}}>Kırşehir</option>
                                                        <option value="41" {{$member->city==41 ? 'selected' : ''}}>Kocaeli</option>
                                                        <option value="42" {{$member->city==42 ? 'selected' : ''}}>Konya</option>
                                                        <option value="43" {{$member->city==43 ? 'selected' : ''}}>Kütahya</option>
                                                        <option value="44" {{$member->city==44 ? 'selected' : ''}}>Malatya</option>
                                                        <option value="45" {{$member->city==45 ? 'selected' : ''}}>Manisa</option>
                                                        <option value="46" {{$member->city==46 ? 'selected' : ''}}>Kahramanmaraş</option>
                                                        <option value="47" {{$member->city==47 ? 'selected' : ''}}>Mardin</option>
                                                        <option value="48" {{$member->city==48 ? 'selected' : ''}}>Muğla</option>
                                                        <option value="49" {{$member->city==49 ? 'selected' : ''}}>Muş</option>
                                                        <option value="50" {{$member->city==50 ? 'selected' : ''}}>Nevşehir</option>
                                                        <option value="51" {{$member->city==51 ? 'selected' : ''}}>Niğde</option>
                                                        <option value="52" {{$member->city==52 ? 'selected' : ''}}>Ordu</option>
                                                        <option value="53" {{$member->city==53 ? 'selected' : ''}}>Rize</option>
                                                        <option value="54" {{$member->city==54 ? 'selected' : ''}}>Sakarya</option>
                                                        <option value="55" {{$member->city==55 ? 'selected' : ''}}>Samsun</option>
                                                        <option value="56" {{$member->city==56 ? 'selected' : ''}}>Siirt</option>
                                                        <option value="57" {{$member->city==57 ? 'selected' : ''}}>Sinop</option>
                                                        <option value="58" {{$member->city==58 ? 'selected' : ''}}>Sivas</option>
                                                        <option value="59" {{$member->city==59 ? 'selected' : ''}}>Tekirdağ</option>
                                                        <option value="60" {{$member->city==60 ? 'selected' : ''}}>Tokat</option>
                                                        <option value="61" {{$member->city==61 ? 'selected' : ''}}>Trabzon</option>
                                                        <option value="62" {{$member->city==62 ? 'selected' : ''}}>Tunceli</option>
                                                        <option value="63" {{$member->city==63 ? 'selected' : ''}}>Şanlıurfa</option>
                                                        <option value="64" {{$member->city==64 ? 'selected' : ''}}>Uşak</option>
                                                        <option value="65" {{$member->city==65 ? 'selected' : ''}}>Van</option>
                                                        <option value="66" {{$member->city==66 ? 'selected' : ''}}>Yozgat</option>
                                                        <option value="67" {{$member->city==67 ? 'selected' : ''}}>Zonguldak</option>
                                                        <option value="68" {{$member->city==68 ? 'selected' : ''}}>Aksaray</option>
                                                        <option value="69" {{$member->city==69 ? 'selected' : ''}}>Bayburt</option>
                                                        <option value="70" {{$member->city==70 ? 'selected' : ''}}>Karaman</option>
                                                        <option value="71" {{$member->city==71 ? 'selected' : ''}}>Kırıkkale</option>
                                                        <option value="72" {{$member->city==72 ? 'selected' : ''}}>Batman</option>
                                                        <option value="73" {{$member->city==73 ? 'selected' : ''}}>Şırnak</option>
                                                        <option value="74" {{$member->city==74 ? 'selected' : ''}}>Bartın</option>
                                                        <option value="75" {{$member->city==75 ? 'selected' : ''}}>Ardahan</option>
                                                        <option value="76" {{$member->city==76 ? 'selected' : ''}}>Iğdır</option>
                                                        <option value="77" {{$member->city==77 ? 'selected' : ''}}>Yalova</option>
                                                        <option value="78" {{$member->city==78 ? 'selected' : ''}}>Karabük</option>
                                                        <option value="79" {{$member->city==79 ? 'selected' : ''}}>Kilis</option>
                                                        <option value="80" {{$member->city==80 ? 'selected' : ''}}>Osmaniye</option>
                                                        <option value="81" {{$member->city==81 ? 'selected' : ''}}>Düzce</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yetkili</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="authorized" value="{{ ($member->authorized) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Yetkili E-posta</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="authorized_email" value="{{ ($member->authorized_email) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Telefon</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="telephone" value="{{ ($member->telephone) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Faks</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="fax" value="{{ ($member->fax) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">E-posta</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" name="email" value="{{ ($member->email) }}">
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Web Sitesi</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="url" name="url" value="{{ ($member->url) }}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İmalat</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$member->product ? 'checked' : ''}} name="product"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İhracat</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$member->export ? 'checked' : ''}} name="export"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">İthalat</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$member->import ? 'checked' : ''}} name="import"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Şirket Profili</label>
                                                <div class="col-9">
                                                    <textarea id="summernote" name="profile">{{ ($member->profile) }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Harita Kodu</label>
                                                <div class="col-9">
                                                    <textarea name="map" rows="5" class="form-control">{{ ($member->map) }}</textarea>
                                                    <span class="form-text text-muted"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Logo</label>
                                                <div class="col-9">
                                                    @if ($member->image)
                                                    <div style="background-color: #f9f9f9; padding: 20px; border-radius: 3px" class="kt-valign-middle kt-align-center mb-3">
                                                        <img src="/upload/members/{{($member->image)}}" height="80px">
                                                    </div>
                                                    @endif
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="customFile">
                                                        <label class="custom-file-label" for="customFile">Dosya Seçiniz</label>
                                                    </div>
                                                    <input type="hidden" name="old_image" value="{{($member->image)}}">
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen dosya türleri:  jpg, jpeg, png, gif</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum boyut: 25 MB</span>
                                                    <span class="form-text text-muted kt-mt-10">Kabul edilen maksimum ebat: 4000 x 4000px</span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Üye Durumu</label>
                                                <div class="col-9">
                                                    <span class="kt-switch kt-switch--icon">
								                        <label><input type="checkbox" value="1" {{$member->status ? 'checked' : ''}} name="status"><span></span></label>
							                        </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                            <div class="kt-align-right">
                                <div class="kt-form__actions">
                                    <button type="submit" class="btn btn-primary">Üye Güncelle</button>
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
