<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Pasien
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role !='pasien'){
            if(Auth::user()->role =='admin') return redirect('/admin/dashboard');
            if(Auth::user()->role =='dokter') return redirect('/dokter/dashboard');
            if(Auth::user()->role =='karyawan') return redirect('/karyawan/dashboard');
        }
        return $next($request);
    }
}
