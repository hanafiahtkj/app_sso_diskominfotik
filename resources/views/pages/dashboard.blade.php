<x-app-layout>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ url('/') }}" class="btn btn-icon"><i class="fa fa-th" aria-hidden="true"></i></a>
        </div>

        <h1>{{ __('Dasbor') }}</h1>
      </div>

      <div class="section-body">

        <div class="row mt-4">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>User</h4>
                  </div>
                  <div class="card-body">
                    {{ $users }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>User Terverifikasi</h4>
                  </div>
                  <div class="card-body">
                    {{ $users_verified }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-align-left"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Kategori</h4>
                  </div>
                  <div class="card-body">
                    {{ $kategori }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-tablet-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Aplikasi</h4>
                  </div>
                  <div class="card-body">
                    {{ $apps }}
                  </div>
                </div>
              </div>
            </div>             
          </div>

    
    </section>
</div>

</x-app-layout>