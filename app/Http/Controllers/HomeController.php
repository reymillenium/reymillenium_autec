<?php
    
    namespace Autec\Http\Controllers;
    
    use Illuminate\Auth\Middleware\Authenticate;
    use Illuminate\Http\Request;
    
    class HomeController extends Controller
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
            // $this->middleware(['auth', 'admin']);
            // Otra forma de usar el middleware Auth (OK)
            // $this->middleware(Authenticate::class);
        }
        
        /**
         * Shows the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function show_home_page()
        {
            return view('home_page');
        }
        
    }
