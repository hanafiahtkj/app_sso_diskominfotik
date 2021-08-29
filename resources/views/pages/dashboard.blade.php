<x-app-layout>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="#" class="btn btn-icon"><i class="fa fa-th" aria-hidden="true"></i></a>
        </div>

        <h1>{{ __('Dasbor') }}</h1>
      </div>

      <div class="section-body">
        <div class="bg-white overflow-hidden sm:rounded-lg">
            <div class="p-6 sm:px-10 bg-white">
                <div>
                    <img src="{{ asset('img/logo.png') }}" width="225" height="51" class="d-inline-block align-top" alt="">
                </div>

                <div class="mt-6 text-2xl">
                    {{ $settings['judul'] }}
                </div>

                <div class="mt-6 text-gray-500">
                    {{ $settings['keterangan'] }}
                </div>
                </div>
            </div>
      </div>

        <div class="row mt-4">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Admin</h4>
                  </div>
                  <div class="card-body">
                    10
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>News</h4>
                  </div>
                  <div class="card-body">
                    42
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Reports</h4>
                  </div>
                  <div class="card-body">
                    1,201
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Online Users</h4>
                  </div>
                  <div class="card-body">
                    47
                  </div>
                </div>
              </div>
            </div>                  
          </div>

    
    </section>
</div>

</x-app-layout>