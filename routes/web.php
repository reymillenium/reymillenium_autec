<?php
    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Symfony\Component\HttpFoundation\Response;
    
    // Ruta de bienvenida
    Route::get('/', function () {
        return view('welcome');
    });
    
    // Rutas de autenticación
    Auth::routes();
    
    // Ruta del Home
    Route::get('/home', 'HomeController@show_home_page')->name('home_page');
    //Otra forma de usar el middleware Auth (OK)
    // Route::get('/home', 'HomeController@show_home_page')->name('home_page')->middleware('auth');
    
    // Route::get('/admin_dashboard_page', function () {
    //
    //     // if (auth()->user()->kind != 'administrator') {
    //     //     // return response("You" . ' '." shall NOT pass!", 403); // Forbidden
    //     //     // return response('You' . ' ' . ' shall NOT pass!', Response::HTTP_FORBIDDEN); // Forbidden
    //     //
    //     //     // Para mostrar una vista en lugar de un simple texto. De bo enviar el código http 403 para que funcionen bien las pruebas
    //     //     return response()->view('forbidden', [], 403);
    //     // }
    //
    //     // *** Movimos la lógica anterior al Middleware Admin ***
    //
    //     // En caso de que se desee enviar información extra hacia la vista admin_dashboard
    //     // $events = [];
    //     // $news = [];
    //     // $recentUsers = [];
    //
    //     // return view('admin.dashboard_page', compact('events', 'news', 'recentUsers'));
    //     return view('admin.admin_dashboard_page');
    //
    // })
    //     // Especificamos el nombre de la ruta y los alias de los middleware que usaremos para esta ruta
    //     // ->name('admin.admin_dashboard_page')->middleware(['auth', \Autec\Http\Middleware\Admin::class]);
    //     //    Podemos simplificar aun más con un alias (tenemos que agregar el alias 'admin' en app\Http\Kernel.php)
    //     ->name('admin.admin_dashboard_page')->middleware(['auth', 'admin']);
    
    // No funciona a no ser que se agregue el middleware admin al construct de HomeController (lo que me da explotes en otras áreas)
    // Route::get('/admin', 'HomeController@show_admin_dashboard_page')->name('admin.admin_dashboard_page');
    // Route::get('/admin_dashboard_page', 'HomeController@show_admin_dashboard_page')->name('admin.admin_dashboard_page')->middleware(['auth', 'admin']);
    
    // Módulo de noticias
    // Route::get('/admin_news_page', 'HomeController@show_admin_news_page')->name('admin.admin_news_page')->middleware(['auth', 'admin']);
    
    // Módulo de eventos
    // Route::get('/admin_events_page', 'HomeController@show_admin_events_page')->name('admin.admin_events_page')->middleware(['auth', 'admin']);
    
    // Módulo de usuarios
    // Route::get('/admin_users_page', 'HomeController@show_admin_users_page')->name('admin.admin_users_page')->middleware(['auth', 'admin']);
    
    // Laravel permite utilizar el grupo de rutas (Pasamos esta función hacia app\Providers\RouteServiceProvider.php)
    // Route::group(['middleware' => ['auth', 'admin']], function () {
    //
    //     require __DIR__ . '/admin_routes.php';
    // });
    
    // Se pueden concatenar métodos para definir una ruta en lugar de usar un array como en el ejemplo anterior
    // (Pasamos esta función hacia app\Providers\RouteServiceProvider.php)
    // Route::middleware(['auth', 'admin'])->group(function () {
    //     // Rutas
    //     require __DIR__ . '/admin_routes.php';
    // });
    
    Route::middleware(['auth', 'client'])->group(function () {
        // Rutas para los Clientes
        require __DIR__ . '/client_routes.php';
    });
    
    Route::middleware(['auth', 'vendor'])->group(function () {
        // Rutas para los Vendedores
        require __DIR__ . '/vendor_routes.php';
    });
    

