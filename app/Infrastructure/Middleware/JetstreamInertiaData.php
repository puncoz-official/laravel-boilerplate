<?php

namespace App\Infrastructure\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

/**
 * Class JetstreamInertiaData
 *
 * @package App\Infrastructure\Middleware
 */
class JetstreamInertiaData
{
    /**
     * Handle the incoming request.
     *
     * @param Request  $request
     * @param callable $next
     *
     * @return Response
     */
    public function handle(Request $request, $next)
    {
        Inertia::share(
            array_filter([
                'jetstream' => function () use ($request) {
                    return [
                        'canManageTwoFactorAuthentication' => Features::canManageTwoFactorAuthentication(),
                        'canUpdatePassword'                => Features::enabled(Features::updatePasswords()),
                        'canUpdateProfileInformation'      => Features::canUpdateProfileInformation(),
                        'hasAccountDeletionFeatures'       => Jetstream::hasAccountDeletionFeatures(),
                        'hasTermsAndPrivacyPolicyFeature'  => Jetstream::hasTermsAndPrivacyPolicyFeature(),
                        'managesProfilePhotos'             => Jetstream::managesProfilePhotos(),
                    ];
                },

                'errorBags' => function () {
                    return collect(optional(Session::get('errors'))->getBags() ?: [])->mapWithKeys(
                        function ($bag, $key) {
                            return [$key => $bag->messages()];
                        }
                    )->all();
                },
            ])
        );

        return $next($request);
    }
}
