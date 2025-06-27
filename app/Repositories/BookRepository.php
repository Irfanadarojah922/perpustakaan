<?php
namespace App\Repositories;

use App\Http\Helpers\UploadFileHelper;
use App\Http\Requests\Books\StoreRequest;
use App\Http\Requests\Books\UpdateRequest;
use App\Models\Buku;
use Illuminate\Support\Arr;

class BookRepository extends BaseRepository
{
    // Method untuk menyimpan data buku baru
    public function store(StoreRequest $storeRequest)
    {
        // Menjalankan proses dalam transaksi database
        return $this->executeInTransaction(function () use ($storeRequest) {
            $data      = $storeRequest->validated();
            // Ambil file foto dari request
            $imageData = $storeRequest->file('foto');

            // Upload gambar dan simpan nama file yang dihasilkan
            $imageName = UploadFileHelper::upload("buku", $storeRequest->judul, $imageData);

            // Simpan data buku ke database, kecuali 'foto' (ditambahkan secara manual)
            $buku = Buku::create(array_merge(
                Arr::except($data, ["foto"]),
                ["foto" => $imageName]
            ));
            return $buku;
        });
    }

    // Method untuk mengupdate data buku berdasarkan ID
    public function update(UpdateRequest $updateRequest, string $id)
    {
        return $this->executeInTransaction(function() use ($updateRequest, $id) {
            $data = $updateRequest->validated();
            // Cari data buku berdasarkan ID
            $buku = Buku::find($id);
            

            // Jika tidak ditemukan, kembalikan null
            if(! $buku) {
                return null;
            }

            // Ambil file foto baru dari request (jika ada)
            $imageData = $updateRequest->file('foto');
            // Gunakan nama foto lama sebagai default
            $imageName = $buku->foto;

            // Jika ada foto baru, hapus foto lama dan upload yang baru
            if($imageData) {
                UploadFileHelper::delete("buku/{$imageName}");
                $imageName = UploadFileHelper::upload("buku", $updateRequest->judul, $imageData);
            }

            // Update data buku di database
            $buku = $buku->update(array_merge(
                Arr::except($data, "foto"),
                [
                    "foto" => $imageName
                ]
            ));
            return $buku;
        });
    }

    // Method untuk menghapus data buku
    public function delete(string $id)
    {
        return $this->executeInTransaction(function() use ($id) {
            $buku = Buku::find($id);
            // Jika tidak ditemukan, kembalikan null
            if(!$buku) {
                return null;
            }

            // Hapus file foto dari penyimpanan
            UploadFileHelper::delete("buku/{$buku->foto}");
            // Hapus data buku dari database
            return $buku->delete();
        });
    }
}
