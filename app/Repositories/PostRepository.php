<?php
namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function all(){
        return $this->post->all();
    }

    public function allOfUser($userId){
        return $this->post->where('user_id', $userId)->get();
    }

    public function find($id){
        return $this->post->find($id);
    }

    public function create($data){
        return $this->post->create($data);
    }

    public function delete($id){
        return $this->post->destroy($id);
    }
}