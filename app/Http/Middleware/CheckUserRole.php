<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            abort(403, 'Unauthorized'); // User is not authenticated
        }

        // Get the user's role from the database
        $userRole = DB::table('users')->where('id', $request->user()->id)->value('role');

        // Check if the user's role is not "teacher"
        if ($userRole !== 'teacher') {
            abort(403, 'Unauthorized'); // User does not have the "teacher" role
        }

        return $next($request);
    }
}
