<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Contracts\ResponseBuilder;
use Illuminate\Http\Response as HttpResponse;

class LanguageMiddleware
{
    public function __construct(protected ResponseBuilder $response)
    {
        //
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->route('lang');
        $supported = config('app.supported_locales');

        if (!in_array($lang, $supported)) {
            return $this->response->error(
                title: 'Language not supported',
                detail: "The language '$lang' is not supported.",
                code: HttpResponse::HTTP_NOT_FOUND,
            )->build(HttpResponse::HTTP_NOT_FOUND);
        }

        app()->setLocale($lang);

        return $next($request);
    }
}
