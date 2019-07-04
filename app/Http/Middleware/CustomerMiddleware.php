<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $status = Auth::user()->id_role;
        $active = Auth::user()->active;
        if ($active==2) {
            return redirect('banned');
        }
        else{

            if ($status == 1) {
                return redirect('admin/dashboard');
            }
            else if($status == 2){
                return redirect('waiter/dashboard');
            }
            else if($status == 3){
                return redirect('cashier/dashboard');
            }
            else if($status == 4){
                return redirect('owner/dashboard');
            }
            else if($status == 5){
                return $next($request);
            }
            else{
                return redirect('home');
            }
        }
    }
}
