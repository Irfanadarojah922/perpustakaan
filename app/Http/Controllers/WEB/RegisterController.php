<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anggotas\StoreRequest;
use App\Repositories\RegisterRepository;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }
}
