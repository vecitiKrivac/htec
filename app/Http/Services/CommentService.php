<?php

namespace App\Http\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Exception;

class CommentService
{
    public function create($request, $userId)
    {
        return Comment::create([
            'user_id' => $userId,
            'city_id' => $request['city_id'],
            'comment' => $request['comment']
        ]);
    }

    public function update($id, $request, $userId)
    {
        $comment = $this->getComment($id);

        if (empty($comment) || ($comment->user_id != $userId)) {
            throw new Exception('Comment does not exist or user not have the permissions to perform an action');
        }

        $comment->comment = $request['comment'];
        $comment->save();

        return $comment;
    }

    public function delete($id, $userId)
    {
        $comment = $this->getComment($id);

        if (empty($comment) || ($comment->user_id != $userId)) {
            throw new Exception('Comment does not exist or user not have the permissions to perform an action');
        }

        $comment->delete();

        return $comment;
    }

    public function getComment($id)
    {
        return Comment::find($id);
    }
}
