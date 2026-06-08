<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // se l'utente non è loggato o l'utente loggato non è un admin...
        if (!$user || !$user->is_admin) {
            // blocca la richiesta e lancia un errore 403 --> Forbidden
            abort(403, 'Questa area è riservata agli amministratori. Azione non autorizzata!');
        }

        // altrimenti lo faccio passare alla rotta successiva
        return $next($request);
    }
}
