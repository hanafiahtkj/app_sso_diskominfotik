<x-app-layout>
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back">
            <a href="{{ route('faqs') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
  
          <h1>{{ __('Data Faqs') }}</h1>
  
          <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
              <div class="breadcrumb-item">Data Faqs</div>
          </div>
      </div>
  
      <div class="section-body">
        <div>
            <livewire:create-faqs action="updateFaq" :faqId="request()->faqId"/>
        </div>
      </div>
    </section>
  </div>
  </x-app-layout>