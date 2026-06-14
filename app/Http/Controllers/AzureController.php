<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AzureController extends Controller
{
    /**
     * Redirect user to Microsoft Azure login
     */
    public function redirect()
    {
        Log::info("====================           Microsoft Login Started         ===================");
        return Socialite::driver('azure')->redirect();

    }

    /**
     * Handle Azure callback
     */
    // public function callback(Request $request): RedirectResponse
    // {
    //     try {

    //         // If behind load balancer, you may need ->stateless()
    //         $azureUser = Socialite::driver('azure')->user();

    //         if (!$azureUser->getEmail()) {
    //             Log::warning('Azure login failed: No email returned', [
    //                 'azure_id' => $azureUser->getId()
    //             ]);

    //             return redirect()->route('login')
    //                 ->withErrors('Unable to retrieve email from Microsoft account.');
    //         }

    //         // OPTIONAL: Restrict allowed domains I will implement the restrict domain Latter 
    //         // $allowedDomain = config('auth.allowed_domain'); // example: company.com

    //         // if ($allowedDomain && !str_ends_with($azureUser->getEmail(), '@' . $allowedDomain)) {
    //         //     Log::warning('Unauthorized domain attempted login', [
    //         //         'email' => $azureUser->getEmail()
    //         //     ]);

    //         //     return redirect()->route('login')
    //         //         ->withErrors('Unauthorized email domain.');
    //         // }

    //         // END OF RESTRICT DOMAIN 

    //         // Create or update user
    //         $user = User::updateOrCreate(
    //             ['email' => $azureUser->getEmail()],
    //             [
    //                 'name' => $azureUser->getName(),
    //                 'microsoft_id' => $azureUser->getId(),
    //                 'created_at' => now(),
    //             ]
    //         );

    //         // Log audit info
    //         Log::info('User logged in via Azure', [
    //             'user_id' => $user->id,
    //             'email' => $user->email,
    //             'ip' => $request->ip(),
    //         ]);

    //         Auth::login($user, true); // remember me

    //         return redirect()->intended('/land');

    //     } catch (Exception $e) {

    //         Log::error('Azure authentication failed', [
    //             'message' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString(),
    //         ]);

    //         return redirect()->route('login')
    //             ->withErrors('Authentication failed. Please try again.');
    //     }
    // }

    public function callback(Request $request): RedirectResponse
    {
        try {

            Log::info('Azure callback received', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            /**
             * Azure may return an error before Socialite processes the user
             */
            if ($request->has('error')) {

                Log::warning('Azure returned authentication error', [
                    'error' => $request->get('error'),
                    'error_description' => $request->get('error_description'),
                    'ip' => $request->ip(),
                ]);

                return redirect()
                    ->route('login')
                    ->with('error', 'Microsoft sign-in was cancelled or failed.');
            }

            /**
             * Retrieve user from Azure
             */
            $azureUser = Socialite::driver('azure')->user();

            Log::info('Azure user retrieved', [
                'azure_id' => $azureUser->getId(),
                'email' => $azureUser->getEmail(),
            ]);

            /**
             * Email validation
             */
            if (!$azureUser->getEmail()) {

                Log::warning('Azure login failed - email missing', [
                    'azure_id' => $azureUser->getId(),
                    'ip' => $request->ip(),
                ]);

                return redirect()
                    ->route('login')
                    ->with('error', 'Unable to retrieve your email address from Microsoft.');
            }

            /**
             * Optional domain restriction
             */
            // $allowedDomain = 'company.com';
            //
            // if (!str_ends_with(strtolower($azureUser->getEmail()), '@' . strtolower($allowedDomain))) {
            //
            //     Log::warning('Unauthorized Azure domain', [
            //         'email' => $azureUser->getEmail(),
            //         'ip' => $request->ip(),
            //     ]);
            //
            //     return redirect()
            //         ->route('login')
            //         ->with('error', 'Your Microsoft account is not authorized.');
            // }

            /**
             * Create or update user
             */
            $user = User::updateOrCreate(
                [
                    'email' => $azureUser->getEmail()
                ],
                [
                    'name' => $azureUser->getName(),
                    'microsoft_id' => $azureUser->getId(),
                ]
            );

            /**
             * Audit log
             */
            Log::info('Azure login successful', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            /**
             * Login user
             */
            Auth::login($user, true);

            return redirect()
                ->intended('/land')
                ->with('success', 'Successfully signed in with Microsoft.');

        } catch (\Exception $e) {

            $userMessage = 'Microsoft authentication failed. Please try again later.';

            /**
             * Common Azure errors
             */
            if (str_contains($e->getMessage(), 'AADSTS7000215')) {
                $userMessage = 'Microsoft authentication service is currently unavailable. Please contact the administrator.';
            }

            if (str_contains($e->getMessage(), 'AADSTS50011')) {
                $userMessage = 'Microsoft authentication configuration error detected.';
            }

            if (str_contains($e->getMessage(), 'access_denied')) {
                $userMessage = 'Microsoft sign-in request was denied.';
            }

            Log::error('Azure authentication failed', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('login')
                ->with('error', $userMessage);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        // Determine if user logged in via Microsoft (no password stored)
        $isMicrosoftUser = empty($user->password);

        $tenant = config('services.azure.tenant');

        // Destroy Laravel session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // $postLogoutRedirectUri = route('genesis');
        $postLogoutRedirectUri = url('/');

        // If Microsoft authenticated user → redirect to Azure logout
        if ($isMicrosoftUser) {

            $azureLogoutUrl = sprintf(
                'https://login.microsoftonline.com/%s/oauth2/v2.0/logout?post_logout_redirect_uri=%s',
                $tenant,
                urlencode($postLogoutRedirectUri)
            );

            return redirect($azureLogoutUrl);
        }

        // If local authenticated user → normal redirect
        // return redirect()->route('genesis');
        return redirect('/')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 1990 00:00:00 GMT',
        ]);
    }

}
