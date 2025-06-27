<?php
namespace App\Http\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileHelper
{
    /**
     * Upload file ke penyimpanan.
     *
     * @param string $prefix        //Folder tujuan penyimpanan (misalnya: 'buku', 'anggota')
     * @param string $name          //Nama dasar file (digunakan sebagai nama file setelah di-slug)
     * @param UploadedFile|null $uploadedFile       //File yang akan diupload (biasanya dari form input)
     * @param string $disk              //Disk penyimpanan (default: 'public')
     * @param string $visibility        //Tingkat akses file (default: 'public')
     * @return string|null              //Nama file yang telah diupload atau null jika gagal
     */
    public static function upload(
        string $prefix,
        string $name,
        ?UploadedFile $uploadedFile,
        string $disk = 'public',
        string $visibility = 'public'
    ): ?string {
        try {
            // Validasi jika file tidak ada
            if (! $uploadedFile) {
                throw new \Exception("Uploaded file is null.");
            }

            // Validasi jika file rusak atau tidak valid
            if (! $uploadedFile->isValid()) {
                throw new \Exception("Uploaded file is not valid.");
            }

            // Buat path folder berdasarkan prefix (tanpa karakter '/')
            $baseDirectory = trim($prefix, '/');

            // Ambil ekstensi file (misalnya jpg, png)
            $extension = $uploadedFile->getClientOriginalExtension();

            // Buat nama file unik menggunakan slug nama, random string, dan timestamp
            $filename  = Str::slug($name) . '-' . Str::random(6) . '-' . time() . '.' . $extension;

            // Simpan file ke storage sesuai folder dan nama file
            $uploadedFile->storeAs($baseDirectory, $filename, [
                'disk'       => $disk,
                'visibility' => $visibility,
            ]);

            // Kembalikan nama file yang telah disimpan
            return $filename;
        } catch (\Throwable $e) {
            \Log::error("File upload error: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Hapus file.
     */
    public static function delete(string $filePath, string $disk = 'public')
    {
        try {
            // Cek apakah file ada di storage
            return Storage::disk($disk)->exists($filePath)
            ? Storage::disk($disk)->delete($filePath)      // Jika ada, hapus
            : false;    // Jika tidak ada, kembalikan false
        } catch (\Exception $e) {
            Log::error("Delete file error: " . $e->getMessage());
            return null;
        }
    }
}
