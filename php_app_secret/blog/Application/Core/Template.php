<?php
namespace Application\Core;
class Template
{
    public $data = [];
    public $layout ;

    function setData($d)
    {
        $this->data = array_merge($this->data, $d);
    }

    function setLayout($layout)
    {
        $this->layout = $layout;
    }

    function render($filename)
    {
        extract($this->data);
        $controllerName = $this->get_calling_class();

         //get class name without name sapace
        $path = explode('\\',  $controllerName);
        $controllerName = array_pop($path);

        $templateFileName = ROOT . "Application/Views/" . ucfirst(str_replace('Controller', '', $controllerName)) . '/' . $filename . '.php';

        if(!file_exists($templateFileName)) {
            http_response_code(404);
            echo "Page Not Found!2", $templateFileName;// provide your own HTML for the error page
            die();
        }
        ob_start();
        require($templateFileName);
        $content_for_layout = ob_get_clean();

        if (!$this->layout)
        {
            echo "$content_for_layout";
            exit();
        }
        else
        {
            require(ROOT . "Application/Views/Layouts/" . $this->layout . '.php');
            exit();
        }
    }

    function get_calling_class() {

        //get the trace
        $trace = debug_backtrace();
        
        // Get the class that is asking for who awoke it
        $class = ( isset( $trace[1]['class'] ) ? $trace[1]['class'] : NULL );
        // +1 to i cos we have to account for calling this function
        for ( $i=1; $i<count( $trace ); $i++ ) {
            if ( isset( $trace[$i] ) && isset( $trace[$i]['class'] ) ) // is it set?
                    if ( $class != $trace[$i]['class'] ) // is it a different class
                        return $trace[$i]['class'];
        }
    }
}
?>