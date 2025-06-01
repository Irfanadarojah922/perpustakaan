<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository
{
    public function executeInTransaction(callable $callback) 
    {
        try {
            DB::beginTransaction();
            
            $result = $callback();
            
            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Repository Error: " . $th->getMessage(), [
                'trace' => $th->getTraceAsString()
            ]);
            return null;
        }
    }
}