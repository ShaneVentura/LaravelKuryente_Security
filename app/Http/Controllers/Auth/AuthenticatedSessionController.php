<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // Add this line
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\IpUtils;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
        $recaptcha_response = $request->input('g-recaptcha-response');

        // validate recaptcha
        if (is_null($recaptcha_response)) {
            // with message
            return redirect()->back()->with('status', 'Please Complete the Recaptcha to proceed');
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $recaptcha_response,
        ]);
        
        $result = json_decode($response);

        if ($response->successful() && $result->success == true) {
            $request->authenticate();
            
            $request->session()->regenerate();

            if ($request->user()->role === 'admin') {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            } else if ($request->user()->role === 'user') {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } else {
            return redirect()->back()->with('status', 'Please Complete the Recaptcha Again to proceed');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
