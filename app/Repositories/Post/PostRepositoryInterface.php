<?php

namespace App\Repositories\Post;

interface PostRepositoryInterface {
    public function getAllPosts();
    public function getAllComments($postId);
    public function getSomeComments($postId, $amount);
    public function getOnePost($postId);
}