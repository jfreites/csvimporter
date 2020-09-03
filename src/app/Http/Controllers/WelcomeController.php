<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landingPage()
    {
        return view('welcome');
    }
}
