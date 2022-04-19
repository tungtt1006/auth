<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function callback(Request $request)
    {
        $response = Http::asForm()->post('http://localhost:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'redirect_uri' => 'http://localhost:8000/callback',
                'code' => $request->code
            ],
        ]);
        dd(json_decode((string) $response->getBody(), true));
        return json_decode((string) $response->getBody(), true);
    }
}
