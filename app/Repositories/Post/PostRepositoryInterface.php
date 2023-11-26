<?php

namespace App\Repositories\Post;

interface PostRepositoryInterface {
    public function getAllPosts();
    public function getPostsByCategory($category_id);
    public function getAllComments($postId);
    public function getSomeComments($postId, $amount);
    public function getOnePost($postId);
    public function searchPosts($text);
}