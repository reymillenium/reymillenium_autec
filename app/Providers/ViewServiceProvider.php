<?php
    
    namespace Autec\Providers;
    
    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\ServiceProvider;
    
    class ViewServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {
            // Colocamos la lógica del Provider en este método
            Blade::if('admin', function () {
                // Será verdadero si el usuario está conectado y si es un administrador
                return auth()->check() && auth()->user()->isAdmin();
                #
                # Otro método. Llama al método isAdmin solo si tenems un usuario (si al llamar a user retorna un usuario en lugar de null)
                // No funciona bien
                // return optional(auth()->user())->isAdmin();
                
            });
        }
        
        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {
            //
        }
    }
