<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Contracts\VerifyEmailViewResponse;
use Illuminate\Support\Facades\Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                if ($request->input('redirect')) {
                    return redirect($request->input('redirect'));
                }
                
                if ($request->input('is_sso')) {
                    return response()->json([
                        'status' => true,
                    ]);
                }

                if (Auth::user()->hasRole(['Admin'])) {
                    return redirect('/admin-dashboard');
                }

                return redirect('/');
            }
        });

        $this->app->instance(LogoutResponse::class, new class implements LogoutResponse {
            public function toResponse($request)
            {
                return redirect('/');
            }
        });

        $this->app->instance(VerifyEmailViewResponse::class, new class implements VerifyEmailViewResponse {
            public function toResponse($request)
            {
                if ($request->user()->hasVerifiedEmail()) {
                    return $request->wantsJson()
                        ? new JsonResponse('', 204)
                        : redirect()->intended(Fortify::redirects('email-verification').'?verified=1');
                }
        
                if ($request->user()->markEmailAsVerified()) {
                    return response()->json([
                        'status' => true,
                    ]);
                    //event(new Verified($request->user()));
                }
        
                return $request->wantsJson()
                    ? new JsonResponse('', 202)
                    : redirect()->intended(Fortify::redirects('email-verification').'?verified=1');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
    }
}
