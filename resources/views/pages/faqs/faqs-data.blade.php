<x-app-layout>

  <x-slot name="title">Data Faqs</x-slot>

  <div class="main-content">
    <section class="section">
      <div class="section-header">
    <div class="section-header-back">
      <a href="#" class="btn btn-icon"><i class="fa fa-th" aria-hidden="true"></i></a>
    </div>
    <h1>Faqs</h1>
    <div class="section-header-button">
      <a href="{{ route('faqs.new') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Faq</a>
    </div>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasbor</a></div>
      <div class="breadcrumb-item">Faqs</div>
    </div>
  </div>

  <div class="section-body">
    <div>
      <livewire:table.faqs name="faq" :model="$faq" />
    </div>
  </div>

  </section>
</div>

</x-app-layout>