<?php
namespace Application\Lib\MysqlStore;
class BlogStore implements \Application\Lib\BlogStore
{
	public $db;
	public function __construct($db)
    {
        $this->db = $db;
        
    }
	public function create(\Application\Lib\Blog $blog) : \Application\Lib\Blog
	{
		$query = "INSERT INTO list(title, description, details, date_posted, time_posted, date_edited, time_edited, public) VALUES (?,?,?,?,?,?,?,?)";

        $blog->id = $this->db->insert($query, array(
            $blog->title,
            $blog->description,
            $blog->details,
            $blog->date_posted,
            $blog->time_posted,
            $blog->date_edited,
            $blog->time_edited,
            $blog->public
        ));
        return $blog;
	}
	public function update(\Application\Lib\Blog $blog) : int
	{
		$query = "UPDATE list SET title=?, description=?, details=?, public=?, date_edited=?, time_edited=? WHERE id=?";

        $affectedRows = $this->db->update($query, array(
            $blog->title,
            $blog->description,
            $blog->details,
            $blog->public,
            $blog->date_edited,
            $blog->time_edited,
            $blog->id
        ));
        return $affectedRows;	
	}
	public function delete(\Application\Lib\Blog $blog) : int
	{
		$query = "DELETE FROM list WHERE id = ?";
        $affectedRows = $this->db->update($query, array(
            $blog->id
        ));
        return $affectedRows;
	}
	public function getById(string $id) : ?\Application\Lib\Blog
	{
		$blog = null;
        $query = "SELECT id,title, description, details, date_posted, time_posted, date_edited, time_edited, public from list where id = ?";
        $result = $this->db->select($query, array($id));
        if(count($result) > 0) {
            $blog = new \Application\Lib\Blog();
            $blog->id = $result[0]['id'];
            $blog->title = $result[0]['title'];
            $blog->description =$result[0]['description'];
            $blog->details = $result[0]['details'];
            $blog->date_posted =  $result[0]['date_posted'];
            $blog->time_posted =  $result[0]['time_posted'];
            $blog->date_edited =  $result[0]['date_edited'];
            $blog->date_edited =  $result[0]['time_edited'];
            $blog->public =  $result[0]['public'];
        }
        return $blog;
	}
	public function getAll() : iterable
	{
		$query = 'SELECT id,title,description,details, date_posted, time_posted, date_edited, time_edited, public from list';
        $result = $this->db->select($query);
        $blogs = array();

        if(count($result) > 0) {
            foreach ($result as $row) {
                $blog = new \Application\Lib\Blog();
                $blog->id = $row['id'];
                $blog->title = $row['title'];
                $blog->description = $row['description'];
                $blog->details = $row['details'];
                $blog->date_posted =  $row['date_posted'];
                $blog->time_posted =  $row['time_posted'];
                $blog->date_edited =  $row['date_edited'];
                $blog->time_edited =  $row['time_edited'];
                $blog->public =  $row['public'];

                $blogs[] = $blog;

            } 
        }
        return $blogs;
	}

	public function getAllPublic() : iterable
    {
        $query = 'SELECT id,title,description,details, date_posted, time_posted, date_edited, time_edited, public from list where public=?';
        $result = $this->db->select($query, array("yes"));
        $blogs = array();

        if(count($result) > 0) {
            foreach ($result as $row) {
                $blog = new \Application\Lib\Blog();
                $blog->id = $row['id'];
                $blog->title = $row['title'];
                $blog->description = $row['description'];
                $blog->details = $row['details'];
                $blog->date_posted =  $row['date_posted'];
                $blog->time_posted =  $row['time_posted'];
                $blog->date_edited =  $row['date_edited'];
                $blog->date_edited =  $row['time_edited'];
                $blog->public =  $row['public'];

                $blogs[] = $blog;

            } 
        }

        return $blogs;
    }
} 