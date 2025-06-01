<?php
namespace App\Repositories;

use App\Http\Helpers\UploadFileHelper;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Buku;
use Illuminate\Support\Arr;

class BookRepository extends BaseRepository
{
    public function store(StoreRequest $storeRequest)
    {
        return $this->executeInTransaction(function () use ($storeRequest) {
            $data      = $storeRequest->validated();
            $imageData = $storeRequest->file('foto');

            $imageName = UploadFileHelper::upload("buku", $storeRequest->judul, $imageData);

            $buku = Buku::create(array_merge(
                Arr::except($data, ["foto"]),
                ["foto" => $imageName]
            ));
            return $buku;
        });
    }

    public function update(UpdateRequest $updateRequest, string $id)
    {
        return $this->executeInTransaction(function() use ($updateRequest, $id) {
            $data = $updateRequest->validated();
            $buku = Buku::find($id);
            
            if(! $buku) {
                return null;
            }

            $imageData = $updateRequest->file('foto');
            $imageName = $buku->foto;
            if($imageData) {
                UploadFileHelper::delete("buku/{$imageName}");
                $imageName = UploadFileHelper::upload("buku", $updateRequest->judul, $imageData);
            }

            $buku = $buku->update(array_merge(
                Arr::except($data, "foto"),
                [
                    "foto" => $imageName
                ]
            ));
            return $buku;
        });
    }


    public function delete(string $id)
    {
        return $this->executeInTransaction(function() use ($id) {
            $buku = Buku::find($id);
            if(!$buku) {
                return null;
            }

            UploadFileHelper::delete("buku/{$buku->foto}");
            return $buku->delete();
        });
    }
}
