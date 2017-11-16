<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class IsUserAdmin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(\Auth::user()) {
            if(Auth::user()->user_role_id != 1) {
                $page_id = Auth::user()->page_id;
                if($page_id) {
                    return redirect()->route('page.edit',[$page_id]);
                } else {
                    // return custom error page
                    return abort(403);
                }
            }
        }
        return $next($request);
    }
}