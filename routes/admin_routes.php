<?php
    /**
     * Created by PhpStorm.
     * User: Reinier
     * Date: 6/8/2018
     * Time: 6:17 PM
     */
    
    // Admin Dashboard
    use Illuminate\Support\Facades\Route;
    use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
    
    Route::get('/admin_dashboard_page', 'AdminController@show_admin_dashboard_page')->name('admin.admin_dashboard_page');
    
    // Módulo de noticias
    Route::get('/admin_news_page', 'AdminController@show_admin_news_page')->name('admin.admin_news_page');
    
    // Módulo de eventos
    Route::get('/admin_events_page', 'AdminController@show_admin_events_page')->name('admin.admin_events_page');
    
    Route::post('create_event', function () {
        return 'Event created';
    });
    
    // Módulo de usuarios
    Route::get('/admin_users_page', 'AdminController@show_admin_users_page')->name('admin.admin_users_page');
    
    // Ruta para capturar todas las posibles urls (Solo peticiones de tipo GET, con el método fallback a partir de Laravel 5.5)
    // Permite que no se muestre el error 404 (página que no existe) sino que sea redireccionado al login con un código 302
    Route::fallback(function () {
    
        // Permite que los admins conectados observen un error 404 al acceder a páginas que no existen
        #
        # Con un texto simple
        // return response('Página no encontrada', 404);
        #
        # Con una vista
        // return response()->view('errors.404', [], 404);
        #
        # Otra opción (como está personalizado el error, Laravel va a cargar la vista de error en lugar de mostrar el mensaje)
        throw new NotFoundHttpException('Página no encontrada');
        #
    
    });
    
    // En vez de utilizar fallback voy a crear un método de ruta más personalizado, utilizando el método any
    // Atrapa cualquier petición sin importar del tipo que sea (post, delete, etc)
    // NO ME FUNCIONA!!!
    // Route::any('{all}', function () {
    //     throw new NotFoundHttpException('Página no encontrada');
    // })->where('all', '.*');











    
    
    