<?php

namespace App\Http\Services;

use App\Http\Requests\Api\FileRequest;
use App\Models\File;
use Illuminate\Support\Facades\DB;

class FileService
{
    public function create(FileRequest $request, string $type)
    {
        try {
            $name = $request->file->getClientOriginalName();
            $fileName = time() . '_' . $name;
            $filePath = $request->file('file')->storeAs('', $fileName, 'public');

            $file = new File;
            $file->user_id = auth()->id();
            $file->original_name = $name;
            $file->file_name = $fileName;
            $file->file_path = 'storage/' . $filePath;
            $file->type = $type;

            $file->save();

            return $file;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
