<?php
namespace Application\Core;
class Request
{
    public $url;
    public $controller;
    public $action;
    public $params;

    public function __construct()
    {
        $this->url = $_SERVER["REQUEST_URI"];
        $this->controller = "Index";
        $this->action = "Index";
        $this->params = array();
    }
}

?>