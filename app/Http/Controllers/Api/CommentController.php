<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Services\CommentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends AppBaseController
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, CommentService $service)
    {
        try {
            $comment = $service->create($request->all(), auth::user()->id);
            return $this->sendResponse(
                new CommentResource($comment),
                'Comment added successfully',
                true,
                201
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->sendError('An error occurred while saving the data', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, $id, CommentService $service)
    {
        try {
            $comment = $service->update($id, $request->all(), auth::user()->id);
            return $this->sendResponse(
                new CommentResource($comment),
                'Comment updated successfully'
            );
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            return $this->sendError($message, 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CommentService $service)
    {
        try {
            $comment = $service->delete($id, auth::user()->id);
            return $this->sendResponse(
                new CommentResource($comment),
                'Comment deleted successfully'
            );
        } catch (\Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
            return $this->sendError($message, 403);
        }
    }
}
