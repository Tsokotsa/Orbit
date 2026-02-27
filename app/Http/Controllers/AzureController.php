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
    public function callback(Request $request): RedirectResponse
    {
        try {

            // If behind load balancer, you may need ->stateless()
            $azureUser = Socialite::driver('azure')->user();

            if (!$azureUser->getEmail()) {
                Log::warning('Azure login failed: No email returned', [
                    'azure_id' => $azureUser->getId()
                ]);

                return redirect()->route('login')
                    ->withErrors('Unable to retrieve email from Microsoft account.');
            }

            // OPTIONAL: Restrict allowed domains I will implement the restrict domain Latter 
            // $allowedDomain = config('auth.allowed_domain'); // example: company.com

            // if ($allowedDomain && !str_ends_with($azureUser->getEmail(), '@' . $allowedDomain)) {
            //     Log::warning('Unauthorized domain attempted login', [
            //         'email' => $azureUser->getEmail()
            //     ]);

            //     return redirect()->route('login')
            //         ->withErrors('Unauthorized email domain.');
            // }

            // END OF RESTRICT DOMAIN 

            // Create or update user
            $user = User::updateOrCreate(
                ['email' => $azureUser->getEmail()],
                [
                    'name' => $azureUser->getName(),
                    'microsoft_id' => $azureUser->getId(),
                    'created_at' => now(),
                ]
            );

            // Log audit info
            Log::info('User logged in via Azure', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
            ]);

            Auth::login($user, true); // remember me

            return redirect()->intended('/land');

        } catch (Exception $e) {

            Log::error('Azure authentication failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->withErrors('Authentication failed. Please try again.');
        }
    }

    /**
     * Logout from application and Azure
     */
    // public function logout(Request $request)
    // {
    //     $tenant = config('services.azure.tenant');

    //     Auth::logout();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     $postLogoutRedirectUri = route('login');

    //     $azureLogoutUrl = sprintf(
    //         'https://login.microsoftonline.com/%s/oauth2/v2.0/logout?post_logout_redirect_uri=%s',
    //         $tenant,
    //         urlencode($postLogoutRedirectUri)
    //     );

    //     return redirect($azureLogoutUrl);
    // }

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
