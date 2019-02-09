<?php

namespace App\StartUp\Middleware;

use App\Data\Entities\Models\User\User;
use Closure;

/**
 * Class EmailVerificationWarning
 * @package App\StartUp\Middleware
 */
class EmailVerificationWarning
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = $request->user();
        if ( !$user ) {
            return redirect()->route('auth.login');
        }

        if ( !$user->hasVerifiedEmail() ) {
            $isAllowed = $this->checkIfVerificationPeriodExpired($user);

            if ( $isAllowed ) {
                return redirect()->route('auth.verification.notice');
            }

            $resendUrl = route('auth.verification.resend');
            flash()->warning("Your account is not verified, please check your email for a verification link. If you did not receive the email, <a href='{$resendUrl}'>click here to request another</a>.");
        }

        return $next($request);
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    protected function checkIfVerificationPeriodExpired(User $user): bool
    {
        return $user->created_at->addDays(config('config.email_verification_period'))->isPast();
    }
}
