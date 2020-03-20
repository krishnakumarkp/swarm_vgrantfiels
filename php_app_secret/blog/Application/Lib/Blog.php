<?php
namespace Application\Lib;
class Blog 
{
    public $id;
    public $title;
    public $description;
    public $details;
    public $date_posted;
    public $time_posted;
    public $date_edited; 
    public $time_edited;
    public $public;

    public function __construct()
    {
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
}