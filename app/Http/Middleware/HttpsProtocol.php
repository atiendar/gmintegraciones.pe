<?php
namespace App\Http\Middleware;
use Closure;

class HttpsProtocol {
  public function handle($request, Closure $next) {
    if(env('APP_ENV') == 'production') {
      // Redirecciona al https
      if (!$request->secure()) {
        // return redirect()->secure($request->getRequestUri());
        return redirect()->secure(\URL::forceScheme('https'));
      }
    }
    return $next($request);
  }
}