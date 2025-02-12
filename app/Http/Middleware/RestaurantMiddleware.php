<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Uri;

class RestaurantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain = Uri::of($request->getUri())->host();
        $subdomain = explode('.', $domain)[0];

        $restaurant = Restaurant::where('slug', $subdomain)->firstOrFail();

        session()->put('restaurant', $restaurant);

        return $next($request);
    }
}
