<?php

namespace Autec\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    
    /**
     * Shows the admin admin_dashboard_page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_admin_dashboard_page()
    {
        // NO FUNCIONAN!!!!!!
        // $this->middleware('admin');
        // $this->middleware('auth');
        // $this->middleware(['auth', 'admin']);
        // $this->middleware(['admin', 'auth']);
        
        return view('admin.admin_dashboard_page');
    }
    
    /**
     * Shows the admin_news_page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_admin_news_page()
    {
        return view('admin.admin_news_page');
    }
    
    /**
     * Shows the admin_events_page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_admin_events_page()
    {
        return view('admin.admin_events_page');
    }
    
    /**
     * Shows the admin_users_page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_admin_users_page()
    {
        return view('admin.admin_users_page');
    }
}
