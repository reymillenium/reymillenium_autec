<?php
    
    namespace Autec\Http\Controllers;
    
    use Illuminate\Http\Request;
    
    class ClientController extends Controller
    {
        //
        
        /**
         * Shows the client client_dashboard_page.
         *
         * @return \Illuminate\Http\Response
         */
        public function show_client_dashboard_page()
        {
            return view('client.client_dashboard_page');
        }
        
    }
