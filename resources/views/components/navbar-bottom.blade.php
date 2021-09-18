@php
$user = auth()->user();
@endphp 

<div class="row mt-4 fixed-bottom-c">
    <div class="col-12">
        <div class="card mb-0">
        <div class="card-body">
            <ul class="nav nav-pills stts-tab">
                <li class="nav-item">
                    <a class="nav-link active" @click="changeRoute('/home')"><div class="text-center" style="
                        line-height: 13px;
                    "><i class="fas fa-home fa-2x"></i></div><span>Beranda</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="changeRoute('/login')"><div class="text-center" style="
                        line-height: 13px;
                    "><i class="fas fa-user fa-2x"></i></div><span>Akun</span></a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>