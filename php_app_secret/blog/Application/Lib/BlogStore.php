<?php
namespace Application\Lib;
interface BlogStore 
{
    public function create(Blog $blog) : Blog;
	public function update(Blog $blog) : int;
	public function delete(Blog $blog) : int;
	public function getById(string $id) : ?Blog;
    public function getAll() : iterable;
    public function getAllPublic() : iterable;
} 