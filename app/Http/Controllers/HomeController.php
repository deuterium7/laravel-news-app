<?php

namespace App\Http\Controllers;

use App\Mail\ContactShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Показать контактную форму.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Отправить письмо.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function send(Request $request)
    {
        $request->validate([
            'title'                => 'required|string|max:255',
            'message'              => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        Mail::to(env('MAIL_USERNAME'))->send(new ContactShipped((object) $request->all()));

        return redirect('/')->with('message', trans('catalog.thxForMessage'));
    }
}
