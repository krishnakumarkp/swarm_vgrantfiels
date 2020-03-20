<?php
namespace Application\Controllers;

class AdminController extends \Application\Core\Controller
{
    function index()
    {
        $this->checkIsLoggedIn();

        $blogModel = new \Application\Models\Blog($this->db); 
        
        $data['blogs'] = $blogModel->getAll();
        $data['errorMessage'] = $this->session->getErrorMessage();
        $data['successMessage'] = $this->session->getSuccessMessage();
        //$data['homeUrl'] = $this->getUrl('index');
        $data['logoutUrl'] = $this->getUrl('auth/logout');
        $this->template->setData($data);
        $this->template->setLayout('admin');
        $this->template->render("index");
    }

    function add()
    {
        $this->checkIsLoggedIn();
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $details = $_POST['details'] ?? null;
        $time = strftime("%X"); //time
        $date = strftime("%B %d, %Y"); //date
        $public = $_POST['public'][0] ?? "no";

        if(empty($title) || empty($description) || empty($details) || empty($public)) {
            $this->session->setErrorMessage("All fields are mandatory");
        }
        else {
            $blogModel = new \Application\Models\Blog($this->db); 
            $blogModel->title =  $title;
            $blogModel->description = $description;
            $blogModel->details = $details;
            $blogModel->date_posted =  $date;
            $blogModel->time_posted =  $time;
            $blogModel->date_edited =  $date;
            $blogModel->time_edited =  $time;
            $blogModel->public =  $public;

            if($blogModel->create()) {
                $this->session->setSuccessMessage("Blog added");
            }
            else {
                $this->session->setErrorMessage("Blog could not be added");
            }
        }
        header("location: ".  $this->getUrl("admin"));
    }

    function delete($id)
    {
        $this->checkIsLoggedIn();
        $blogModel = new \Application\Models\Blog($this->db); 
        $blogModel->id = $id;
        if($blogModel->delete()) {
            $this->session->setSuccessMessage("Blog deleted");
        } else {
            $this->session->setErrorMessage("Couldnot Delte blog");
        }
        header("location: ".  $this->getUrl("admin"));
    }

    function edit($id)
    {
        $this->checkIsLoggedIn();
        $blogModel = new \Application\Models\Blog($this->db); 
        if(isset($id)) {
            $this->session->set('id', $id);
            $data['blog'] = $blogModel->getById($id);
        }
        $data['blogs'] = $blogModel->getAll();
        $data['homeUrl'] = $this->getUrl('admin');
        $data['logoutUrl'] = $this->getUrl('auth/logout');
       
        $this->template->setData($data);
        $this->template->setLayout('admin');
        $this->template->render("edit");
    }

    function update()
    {
        $this->checkIsLoggedIn();
        $title = $_POST['title'] ?? null;
        $description = $_POST['description'] ?? null;
        $details = $_POST['details'] ?? null;
        $time = strftime("%X"); //time
        $date = strftime("%B %d, %Y"); //date
        $public = $_POST['public'][0] ?? "no";
        $id = $this->session->get('id');
        $this->session->delete('id');

        if(empty($title) || empty($description) || empty($details) || empty($public)) {
            $this->session->setErrorMessage("All fields are mandatory");
        } else {
            $blogModel = new \Application\Models\Blog($this->db); 
            $time = strftime("%X"); //time
            $date = strftime("%B %d, %Y"); //date
            $blogModel->id =  $id;
            $blogModel->title =  $title;
            $blogModel->description = $description;
            $blogModel->details = $details;
            $blogModel->date_edited =  $date;
            $blogModel->time_edited =  $time;
            $blogModel->public =  $public;

            if($blogModel->update()) {
                $this->session->setSuccessMessage("Blog updated");
            } else {
                $this->session->setErrorMessage("Blog could not be updated");
            }

        }
        header("location: ".  $this->getUrl("admin"));
    }

}