<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    /**
     * Display the application resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function app()
    {
        return view('app');
    }


    /**
     * Display the login resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('login');
    }
}
