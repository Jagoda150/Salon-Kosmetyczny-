<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckHoliday
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Przepuszczanie żądań do stron logowania
        if ($request->is('login') || $request->is('logout') || $request->is('register')) {
            return $next($request);
        }

        if (Auth::check()) {
            \Log::info('Zalogowany użytkownik:', ['user' => Auth::user()]);
            if (Auth::user()->role_id == 1) {
                \Log::info('Admin ma dostęp do trasy: ' . $request->path());
                return $next($request); // Admin ma zawsze dostęp
            }
        } else {
            \Log::info('Niezalogowany użytkownik próbował uzyskać dostęp do: ' . $request->path());
        }
        

        // Sprawdź, czy dzisiejszy dzień jest dniem wolnym
        $today = now()->toDateString();
        $holiday = DB::table('holidays')->where('holiday_date', $today)->first();

        if ($holiday) {
            return response()->view('holidays.closed', [
                'message' => $holiday->description ?? 'Sklep jest dzisiaj nieczynny.',
            ]);
        }

        return $next($request);
    }
}
