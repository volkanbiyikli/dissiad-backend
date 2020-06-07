@extends('site.layouts.app')
@section('title','İLETİŞİM - '.$settings->title)
@section('description'){!! Str::limit(strip_tags(html_entity_decode($settings->description)), 157) !!}@endsection
@section('url', Request::url())
@section('image',$settings->url.'/upload/dissiad.jpg')

@section('content')
    <div class="content">
        <div class="container">
            <div class="card page-box">
                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">ANA SAYFA</a></li>
                            <li class="breadcrumb-item active" aria-current="page">İLETİŞİM</li>
                        </ol>
                    </nav>
                    <div class="page__title">İLETİŞİM</div>
                    <div class="page__content">
                        <div class="-mx-8">
                            {!! $settings->map !!}
                        </div>
                        <div class="py-12">
                            <div class="row">
                                <div class="col-lg-8 mb-6 space-y-4">
                                    <div class="space-y-3">
                                        <div class="text-2xl text-primary">İletişim Formu</div>
                                        <div class="font-light">Aşağıdaki iletişim formu ile bizimle iletişime geçebilirsiniz.</div>
                                    </div>
                                    <form class="contact-form">
                                        <div class="row-lg">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-primary">Adınız Soyadınız</label>
                                                    <input class="form-control bg-none" type="text" placeholder="Adınız Soyadınız">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-primary">E-posta Adresiniz</label>
                                                    <input class="form-control bg-none" type="email" placeholder="E-posta Adresiniz">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="text-primary">Telefon</label>
                                                    <input class="form-control bg-none" type="text" placeholder="Telefon">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary">Konu</label>
                                            <input class="form-control bg-none" type="text">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-primary">Mesaj</label>
                                            <textarea class="form-control bg-none" rows="6"></textarea>
                                        </div>
                                        <button class="btn btn-primary px-12 text-white">GÖNDER</button>
                                    </form>
                                </div>
                                <div class="col-lg-4 mb-6 space-y-6">
                                    <div class="space-y-3">
                                        <div class="text-2xl text-primary">İletişim Bilgileri</div>
                                        <div class="space-y-3">
                                            <div class="space-y-1">
                                                <div class="text-primary">Adres</div>
                                                <div class="font-light">{{ $settings->address }}</div>
                                            </div>
                                            <div class="space-y-1">
                                                <div class="text-primary">Telefon</div>
                                                <div class="font-light">
                                                    <div><a href="tel:{{ $settings->telephone }}">{{ $settings->telephone }}</a></div>
                                                </div>
                                            </div>
                                            <div class="space-y-1">
                                                <div class="text-primary">Faks</div>
                                                <div class="font-light">
                                                    <div><a href="tel:{{ $settings->fax }}">{{ $settings->fax }}</a></div>
                                                </div>
                                            </div>
                                            <div class="space-y-1">
                                                <div class="text-primary">E-posta</div>
                                                <div class="font-light"><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('left')
@endsection

@section('right')
@endsection

@section('full')
@endsection
