<x-app-layout>
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="http://sso.banjarmasinkota.test:8000/user" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>

        <h1>{{ __('Profile') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard')  }}">Dasbor</a></div>
            <div class="breadcrumb-item">{{ __('Profile') }}</div>
        </div>
      </div>
                                              
    <div class="section-body">
        <div>
            <div class="max-w-7xl mx-auto py-0 sm:px-0 lg:px-0">
                @livewire('profile.update-profile-information-form')

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <x-jet-section-border />
                
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <x-jet-section-border />

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
                @endif

                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    </section>
</div>

</x-app-layout>
