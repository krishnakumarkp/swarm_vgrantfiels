<?php
namespace Application\Controllers;
class IndexController extends \Application\Core\Controller
{
    function index()
    {
        $blog = new \Application\Models\Blog($this->db);
        $data['blogs'] = $blog->getAllPublic();
        $this->template->setData($data);
        $this->template->setLayout('default');
        $this->template->render("index");
    }
}