<?php
namespace Application\Controllers;
class HelloController extends \Application\Core\Controller
{
    function index()
    {
        $this->template->setLayout('default');
        $this->template->render("index");
    }
    function greet($name)
    {

        $hello = new \Application\Models\Hello();

        $data['greeting'] = $hello->getGreetings($name);
        $this->template->setData($data);
        //$this->template->setLayout('default');
        $this->template->render("greet");
    }
}