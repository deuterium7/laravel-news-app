<?php

namespace App\Http\Controllers;

use App\Mail\ContactShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
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
     * @param ContactRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(ContactRequest $request)
    {
        Mail::to(env('MAIL_USERNAME'))->send(new ContactShipped((object) $request->all()));

        return redirect('/')->with('message', trans('catalog.thxForMessage'));
    }
}
