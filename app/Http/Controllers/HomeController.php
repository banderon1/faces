<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    /**
     * Show the home page
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('home');
    }
}
