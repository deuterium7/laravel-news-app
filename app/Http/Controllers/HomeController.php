<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormWasSubmitted;
use App\ValueObjects\Contact;

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
        $this->dispatch(new ContactFormWasSubmitted($request->all()));

        return redirect('/')->with('message', trans('catalog.thxForMessage'));
    }
}
