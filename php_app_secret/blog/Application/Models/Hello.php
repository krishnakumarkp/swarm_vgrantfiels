<?php
namespace Application\Models;
class Hello extends \Application\Core\Model
{
    public function getGreetings($name)
    {
        return "Hello ". $name;
    }
}