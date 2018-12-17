<?php
    
    namespace Autec\Http\Middleware;
    
    use Closure;
    use Illuminate\Auth\Access\AuthorizationException;
    
    class Admin
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \Closure $next
         * @return mixed
         * @throws AuthorizationException
         */
        public function handle($request, Closure $next)
        {
            
            // Si el usuario no es un administrator voy a mostrar la página de error 403, con su código 403
            // if (auth()->user()->kind != 'administrator') {
            // if (! auth()->user()->isAdmin()) {
            // if (! $request->user()->isAdmin()) {
            if (!optional($request->user())->isAdmin()) {
                // return response("You" . ' '." shall NOT pass!", 403); // Forbidden
                // return response('You' . ' ' . ' shall NOT pass!', Response::HTTP_FORBIDDEN); // Forbidden
                
                // dd(auth()->user()->kind);
                
                // Para mostrar una vista en lugar de un simple texto. Debo enviar el código http 403 para que funcionen bien las pruebas
                // return response()->view('errors.403', [], 403);
                
                // En vez de retornar una vista directamente podemos lanzar una excepción (y Laravel se encarga de mostrar la vista correspondiente)
                throw new AuthorizationException();
                
                
            }
            
            // De lo contrario dejamos que la aplicación siga su curso normal
            return $next($request);
        }
    }
