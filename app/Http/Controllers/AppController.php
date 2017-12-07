<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactFormWasSubmitted;

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

    /**
     * Сменить язык.
     *
     * @param string $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function locale(string $locale)
    {
        if (in_array($locale, config('app.locales'))) {
            session(['locale' => $locale]);
        }

        return redirect('/#/articles');
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

        return response()->json([
            'message' => 'Contact was submitted!'
        ], 200);
    }
}
