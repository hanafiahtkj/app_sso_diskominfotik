@php
$user = auth()->user();
@endphp 

<div class="row mt-4 fixed-bottom-c d-sm-block d-lg-none">
    <div class="col-12">
        <div class="card mb-0">
        <div class="card-body">
            <ul class="nav nav-pills stts-tab">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}"><div class="text-center" style="
                        line-height: 13px;
                    "><i class="fas fa-home fa-2x"></i></div><span>Beranda</span></a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/user/profile') }}" ><div class="text-center" style="
                        line-height: 13px;
                    "><i class="fas fa-user fa-2x"></i></div><span>Profil</span></a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}"><div class="text-center" style="
                        line-height: 13px;
                    "><i class="fas fa-user fa-2x"></i></div><span>Akun</span></a>
                </li>
                @endauth   
            </ul>
        </div>
        </div>
    </div>
</div>