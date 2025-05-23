<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Anggotas\StoreRequest;
use App\Repositories\RegisterRepository;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    protected $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(StoreRequest $storeRequest): RedirectResponse
    {
    
        $data = $this->registerRepository->store($storeRequest);
        try {
            // dd($data);

            return redirect()->route('login')->with('success', "Registration Successfully!");
        } catch (\Throwable $th) {
            return back()->withInput()->with("error", "Oops! Something went wrong: " . $th->getMessage());
        }
    }
}
