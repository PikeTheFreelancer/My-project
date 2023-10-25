<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface{
    public function getModel()
    {
        return Comment::class;
    }

    public function compareEqual($param1, $param2)
    {
        return $this->model->where($param1, $param2);
    }
}