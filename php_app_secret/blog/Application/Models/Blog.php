<?php
namespace Application\Models;
class Blog extends \Application\Core\Model
{
    public $db;
    public $id;
    public $title;
    public $description;
    public $details;
    public $date_posted;
    public $time_posted;
    public $date_edited; 
    public $time_edited;
    public $public;
    public function __construct($db)
    {
        $this->db = $db;
        $this->id = "";
        $this->title = "";
        $this->description = "";
        $this->details = "";
        $this->date_posted = "";
        $this->time_posted = "";
        $this->date_edited = "";
        $this->time_edited = "";
        $this->public = "";
    }

    public function create()
    {

        $blogStore = new \Application\Lib\MysqlStore\BlogStore($this->db); 
        $blog = new \Application\Lib\Blog();
        $blog->title =  $this->title;
        $blog->description = $this->description;
        $blog->details = $this->details;
        $blog->date_posted =  $this->date_posted;
        $blog->time_posted =  $this->time_posted;
        $blog->date_edited =  $this->date_edited;
        $blog->time_edited =  $this->time_edited;
        $blog->public =  $this->public;

        $blog = $blogStore->create($blog);
        
        return $blog->id;
    }

    public function update()
    {
        $blogStore = new \Application\Lib\MysqlStore\BlogStore($this->db);
        $blog =  $blogStore->getById($this->id);

        $blog->title =  $this->title;
        $blog->description = $this->description;
        $blog->details = $this->details;
        $blog->date_edited =  $this->date_edited;
        $blog->time_edited =  $this->time_edited;
        $blog->public =  $this->public;
        return $blogStore->update($blog);
    }

    public function delete()
    {
        $blogStore = new \Application\Lib\MysqlStore\BlogStore($this->db);
        $blog =  $blogStore->getById($this->id);
        return $blogStore->delete($blog);
    }

    public function getById( string $id)
    {
        $blogStore = new \Application\Lib\MysqlStore\BlogStore($this->db);
        return $blogStore->getById($id);
    }

    public function getAllPublic() : iterable
    {
        $blogStore = new \Application\Lib\MysqlStore\BlogStore($this->db);
        return $blogStore->getAllPublic();
    }
    public function getAll() : iterable
    {
        $blogStore = new \Application\Lib\MysqlStore\BlogStore($this->db);
        return $blogStore->getAll();
    }
}