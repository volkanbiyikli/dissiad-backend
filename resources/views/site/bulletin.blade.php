@extends('site.layouts.app')
@section('title','BÜLTENLER - '.$settings->title)
@section('description'){!! Str::limit(strip_tags(html_entity_decode($settings->description)), 157) !!}@endsection
@section('url', Request::url())
@section('image',$settings->url.'/upload/logo/'.$settings->logo)

@section('content')
    <div class="content">
        <div class="container">
            <div class="row -mb-4 flex-lg-row-reverse">
                <div class="col-lg-9 mb-4">
                    <div class="card page-box">
                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">ANA SAYFA</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">BÜLTENLER</li>
                                </ol>
                            </nav>
                            <div class="page__title">BÜLTENLER</div>

                            <div class="page__content">
                                <div class="space-y-6">
                                    @foreach($data['new'] as $db)
                                        @if ($db->status)
                                            <a class="newsletters-item card" @if ($db->blank_url) target="_blank" @endif  @if (!$db->url) href="/bulten/{{ $db->slug }}">@else
                                                    href="{{ $db->url }}">@endif
                                                <div class="newsletters-item__date">
                                                    <big>{{ \Carbon\Carbon::parse($db->date)->isoFormat('d') }}</big><span>{{ \Carbon\Carbon::parse($db->date)->isoFormat('MMMM')
                                                    }}</span><span>{{ \Carbon\Carbon::parse($db->date)->isoFormat('YYYY') }}</span>
                                                </div>
                                                <div class="newsletters-item__content card-body">{{ $db->name }}</div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>

                                {{  $data['new']->links() }}

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="sidebar">
                        <div class="sidebar-box card">
                            <div class="card-header">BASIN<i class="fal fa-chevron-down ml-2"></i></div>
                            <div class="card-body">
                                <ul class="sidebar-menu">
                                    <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="/haberler">HABERLER</a></li>
                                    <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="/bultenler">BÜLTENLER</a></li>
                                    <li class="sidebar-menu__item"><a class="sidebar-menu__link" href="/roportajlar">RÖPORTAJLAR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
