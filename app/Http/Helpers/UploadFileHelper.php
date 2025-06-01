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
     * @param string $prefix
     * @param string $name
     * @param UploadedFile|null $uploadedFile
     * @param string $disk
     * @param string $visibility
     * @return string|null
     */
    public static function upload(
        string $prefix,
        string $name,
        ?UploadedFile $uploadedFile,
        string $disk = 'public',
        string $visibility = 'public'
    ): ?string {
        try {
            if (! $uploadedFile) {
                throw new \Exception("Uploaded file is null.");
            }

            if (! $uploadedFile->isValid()) {
                throw new \Exception("Uploaded file is not valid.");
            }

            $baseDirectory = trim($prefix, '/');
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename  = Str::slug($name) . '-' . Str::random(6) . '-' . time() . '.' . $extension;

            $uploadedFile->storeAs($baseDirectory, $filename, [
                'disk'       => $disk,
                'visibility' => $visibility,
            ]);

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
            return Storage::disk($disk)->exists($filePath)
            ? Storage::disk($disk)->delete($filePath)
            : false;
        } catch (\Exception $e) {
            Log::error("Delete file error: " . $e->getMessage());
            return null;
        }
    }
}
