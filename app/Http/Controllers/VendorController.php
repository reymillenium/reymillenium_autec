<?php
    
    namespace Autec\Http\Controllers;
    
    use Illuminate\Http\Request;
    
    class VendorController extends Controller
    {
        //
        
        /**
         * Shows the vendor vendor_dashboard_page.
         *
         * @return \Illuminate\Http\Response
         */
        public function show_vendor_dashboard_page()
        {
            return view('vendor.vendor_dashboard_page');
        }
        
    }
