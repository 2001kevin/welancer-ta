<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FreelancerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan guard yang digunakan adalah 'pegawai'
        $pegawai = auth()->guard('pegawai')->user();

        if ($pegawai && $pegawai->role == 'freelancer') {
            return $next($request);
        }

        // Jika tidak sesuai, bisa return 403 forbidden atau redirect ke halaman lain
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
