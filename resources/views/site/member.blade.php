@extends('site.layouts.app')
@section('title','ÜYELER - '.$settings->title)
@section('description'){!! Str::limit(strip_tags(html_entity_decode($settings->description)), 157) !!}@endsection
@section('url', Request::url())
@section('image',$settings->url.'/upload/logo/'.$settings->logo)

@section('content')
    <div class="content">
        <div class="container">
            <div class="row -mb-4 flex-lg-row-reverse">
                <div class="col-lg-12 mb-4">
                    <div class="card page-box">
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">ANA SAYFA</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ÜYELER</li>
                                </ol>
                            </nav>
                            @php
                                $keywords = strip_tags(html_entity_decode(Request::get('firma')));
                                $city = strip_tags(html_entity_decode(Request::get('il')));
                            @endphp
                            <div class="page__title">ÜYELER @if($keywords) {{ '- Aranan Firma Adı: '.$keywords }} @endif</div>

                            <div class="page__content">
                                <div class="space-y-6">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body space-y-3">
                                            <div class="text-lg font-bold">ÜYE ARAMA</div>
                                            <div>
                                                <form action="{{route('memberlist.index')}}">
                                                    <div class="row-md items-center -mb-4">
                                                        <div class="col-lg col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="firma" value="{{ $keywords }}" placeholder="FİRMA ADI">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-auto col-12">
                                                            <div class="form-group">
                                                                <select name="il" class="form-control">
                                                                    <option value="">Tüm İller</option>
                                                                    <option value="1" {{$city==1 ? 'selected' : ''}}>Adana</option>
                                                                    <option value="2" {{$city==2 ? 'selected' : ''}}>Adıyaman</option>
                                                                    <option value="3" {{$city==3 ? 'selected' : ''}}>Afyonkarahisar</option>
                                                                    <option value="4" {{$city==4 ? 'selected' : ''}}>Ağrı</option>
                                                                    <option value="5" {{$city==5 ? 'selected' : ''}}>Amasya</option>
                                                                    <option value="6" {{$city==6 ? 'selected' : ''}}>Ankara</option>
                                                                    <option value="7" {{$city==7 ? 'selected' : ''}}>Antalya</option>
                                                                    <option value="8" {{$city==8 ? 'selected' : ''}}>Artvin</option>
                                                                    <option value="9" {{$city==9 ? 'selected' : ''}}>Aydın</option>
                                                                    <option value="10" {{$city==10 ? 'selected' : ''}}>Balıkesir</option>
                                                                    <option value="11" {{$city==11 ? 'selected' : ''}}>Bilecik</option>
                                                                    <option value="12" {{$city==12 ? 'selected' : ''}}>Bingöl</option>
                                                                    <option value="13" {{$city==13 ? 'selected' : ''}}>Bitlis</option>
                                                                    <option value="14" {{$city==14 ? 'selected' : ''}}>Bolu</option>
                                                                    <option value="15" {{$city==15 ? 'selected' : ''}}>Burdur</option>
                                                                    <option value="16" {{$city==16 ? 'selected' : ''}}>Bursa</option>
                                                                    <option value="17" {{$city==17 ? 'selected' : ''}}>Çanakkale</option>
                                                                    <option value="18" {{$city==18 ? 'selected' : ''}}>Çankırı</option>
                                                                    <option value="19" {{$city==19 ? 'selected' : ''}}>Çorum</option>
                                                                    <option value="20" {{$city==20 ? 'selected' : ''}}>Denizli</option>
                                                                    <option value="21" {{$city==21 ? 'selected' : ''}}>Diyarbakır</option>
                                                                    <option value="22" {{$city==22 ? 'selected' : ''}}>Edirne</option>
                                                                    <option value="23" {{$city==23 ? 'selected' : ''}}>Elazığ</option>
                                                                    <option value="24" {{$city==24 ? 'selected' : ''}}>Erzincan</option>
                                                                    <option value="25" {{$city==25 ? 'selected' : ''}}>Erzurum</option>
                                                                    <option value="26" {{$city==26 ? 'selected' : ''}}>Eskişehir</option>
                                                                    <option value="27" {{$city==27 ? 'selected' : ''}}>Gaziantep</option>
                                                                    <option value="28" {{$city==28 ? 'selected' : ''}}>Giresun</option>
                                                                    <option value="29" {{$city==29 ? 'selected' : ''}}>Gümüşhane</option>
                                                                    <option value="30" {{$city==30 ? 'selected' : ''}}>Hakkâri</option>
                                                                    <option value="31" {{$city==31 ? 'selected' : ''}}>Hatay</option>
                                                                    <option value="32" {{$city==32 ? 'selected' : ''}}>Isparta</option>
                                                                    <option value="33" {{$city==33 ? 'selected' : ''}}>Mersin</option>
                                                                    <option value="34" {{$city==34 ? 'selected' : ''}}>İstanbul</option>
                                                                    <option value="35" {{$city==35 ? 'selected' : ''}}>İzmir</option>
                                                                    <option value="36" {{$city==36 ? 'selected' : ''}}>Kars</option>
                                                                    <option value="37" {{$city==37 ? 'selected' : ''}}>Kastamonu</option>
                                                                    <option value="38" {{$city==38 ? 'selected' : ''}}>Kayseri</option>
                                                                    <option value="39" {{$city==39 ? 'selected' : ''}}>Kırklareli</option>
                                                                    <option value="40" {{$city==40 ? 'selected' : ''}}>Kırşehir</option>
                                                                    <option value="41" {{$city==41 ? 'selected' : ''}}>Kocaeli</option>
                                                                    <option value="42" {{$city==42 ? 'selected' : ''}}>Konya</option>
                                                                    <option value="43" {{$city==43 ? 'selected' : ''}}>Kütahya</option>
                                                                    <option value="44" {{$city==44 ? 'selected' : ''}}>Malatya</option>
                                                                    <option value="45" {{$city==45 ? 'selected' : ''}}>Manisa</option>
                                                                    <option value="46" {{$city==46 ? 'selected' : ''}}>Kahramanmaraş</option>
                                                                    <option value="47" {{$city==47 ? 'selected' : ''}}>Mardin</option>
                                                                    <option value="48" {{$city==48 ? 'selected' : ''}}>Muğla</option>
                                                                    <option value="49" {{$city==49 ? 'selected' : ''}}>Muş</option>
                                                                    <option value="50" {{$city==50 ? 'selected' : ''}}>Nevşehir</option>
                                                                    <option value="51" {{$city==51 ? 'selected' : ''}}>Niğde</option>
                                                                    <option value="52" {{$city==52 ? 'selected' : ''}}>Ordu</option>
                                                                    <option value="53" {{$city==53 ? 'selected' : ''}}>Rize</option>
                                                                    <option value="54" {{$city==54 ? 'selected' : ''}}>Sakarya</option>
                                                                    <option value="55" {{$city==55 ? 'selected' : ''}}>Samsun</option>
                                                                    <option value="56" {{$city==56 ? 'selected' : ''}}>Siirt</option>
                                                                    <option value="57" {{$city==57 ? 'selected' : ''}}>Sinop</option>
                                                                    <option value="58" {{$city==58 ? 'selected' : ''}}>Sivas</option>
                                                                    <option value="59" {{$city==59 ? 'selected' : ''}}>Tekirdağ</option>
                                                                    <option value="60" {{$city==60 ? 'selected' : ''}}>Tokat</option>
                                                                    <option value="61" {{$city==61 ? 'selected' : ''}}>Trabzon</option>
                                                                    <option value="62" {{$city==62 ? 'selected' : ''}}>Tunceli</option>
                                                                    <option value="63" {{$city==63 ? 'selected' : ''}}>Şanlıurfa</option>
                                                                    <option value="64" {{$city==64 ? 'selected' : ''}}>Uşak</option>
                                                                    <option value="65" {{$city==65 ? 'selected' : ''}}>Van</option>
                                                                    <option value="66" {{$city==66 ? 'selected' : ''}}>Yozgat</option>
                                                                    <option value="67" {{$city==67 ? 'selected' : ''}}>Zonguldak</option>
                                                                    <option value="68" {{$city==68 ? 'selected' : ''}}>Aksaray</option>
                                                                    <option value="69" {{$city==69 ? 'selected' : ''}}>Bayburt</option>
                                                                    <option value="70" {{$city==70 ? 'selected' : ''}}>Karaman</option>
                                                                    <option value="71" {{$city==71 ? 'selected' : ''}}>Kırıkkale</option>
                                                                    <option value="72" {{$city==72 ? 'selected' : ''}}>Batman</option>
                                                                    <option value="73" {{$city==73 ? 'selected' : ''}}>Şırnak</option>
                                                                    <option value="74" {{$city==74 ? 'selected' : ''}}>Bartın</option>
                                                                    <option value="75" {{$city==75 ? 'selected' : ''}}>Ardahan</option>
                                                                    <option value="76" {{$city==76 ? 'selected' : ''}}>Iğdır</option>
                                                                    <option value="77" {{$city==77 ? 'selected' : ''}}>Yalova</option>
                                                                    <option value="78" {{$city==78 ? 'selected' : ''}}>Karabük</option>
                                                                    <option value="79" {{$city==79 ? 'selected' : ''}}>Kilis</option>
                                                                    <option value="80" {{$city==80 ? 'selected' : ''}}>Osmaniye</option>
                                                                    <option value="81" {{$city==81 ? 'selected' : ''}}>Düzce</option>>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-auto col-12">
                                                            <div class="form-group">
                                                                <button class="btn btn-light btn-block font-bold px-8">ARA</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row-lg -mb-6">

                                        @foreach($data['new'] as $db)
                                            @if ($db->status)
                                                <div class="col-lg-4 col-md-6 mb-6">
                                                    <div class="members-item card">
                                                        <div class="card-header">
                                                            <div class="members-item__title">{{ $db->name }}</div>
                                                        </div>
                                                        <div class="card-body members-item__content space-y-3">
                                                            <div><b>Faaliyet Kategorisi</b>
                                                                <div class="row-sm mt-1">
                                                                    <div class="col-auto"><i class="fas {{$db->product ? 'fa-check' : 'fa-times'}}"></i> İmalat</div>
                                                                    <div class="col-auto"><i class="fas {{$db->export ? 'fa-check' : 'fa-times'}}"></i> İhracat</div>
                                                                    <div class="col-auto"><i class="fas {{$db->import ? 'fa-check' : 'fa-times'}}"></i> İthalat</div>
                                                                </div>
                                                            </div>
                                                            <div><b>Firma Telefonu:&nbsp;&nbsp;</b>{{ $db->telephone }}</div>
                                                            <div><b>Firma Yetkilisi:&nbsp;&nbsp;</b>{{ $db->authorized }}</div>
                                                            <div><b>Ruhsat Numarası:&nbsp;&nbsp;</b>{{ $db->license }}</div>
                                                        </div>
                                                        <a class="members-item__btn btn btn-light" href="/uye/{{ $db->slug }}">İNCELE</a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @if (!count($data['new']))
                                        <div>Üye Bulunamadı!</div>
                                    @endif
                                    {{  $data['new']->appends(request()->query())->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
