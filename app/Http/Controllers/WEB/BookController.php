<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(protected BookRepository $bookRepository)
    {

    }

    public function store(StoreRequest $storeRequest)
    {
        $buku = $this->bookRepository->store($storeRequest);
        
        if(!$buku) {
            return redirect()->back()->withInput()->with("error", "Something Error!");
        }

        return redirect()->route("katalog.index")->with("success", "Katalog Created Successfully!");
    }

    public function create()
    {
        return view("katalog.create");
    }

    public function update(UpdateRequest $updateRequest, string $id)
    {
        $buku = $this->bookRepository->update($updateRequest, $id);
        if(!$buku) {
            return redirect()->back()->withInput()->with("error", "Something Error!");
        }

        return redirect()->route("katalog.index")->with("success", "Katalog update Successfully!");
    }

    public function delete(string $id)
    {
        $buku = $this->bookRepository->delete($id);
        
    }
}
