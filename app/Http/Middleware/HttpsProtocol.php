<?php
namespace App\Http\Middleware;
use Closure;

class HttpsProtocol {
  public function handle($request, Closure $next) {
    if(env('APP_ENV') == 'production') {
      // Redirecciona al https
      if (!$request->secure()) {
        // return redirect()->secure($request->getRequestUri());
      }
    }
    return $next($request);



        // REDIRECCION A HTTPS SI EL SISTEMA ESTA EN PRODUCCIÓN
        if(config('app.env') === 'production') {
          \URL::forceScheme('https');
        }
        
  }
}