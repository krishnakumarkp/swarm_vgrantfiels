<?php
namespace Application\Core;
class Router
{
    static public function parse($request)
    {
        $url = $request->url;

        $explode_url = explode('/', $url);
		
        $explode_url = array_slice($explode_url, 1);
        if(isset($explode_url[0]) && $explode_url[0]) {
            $request->controller = ucfirst($explode_url[0]);
            if(isset($explode_url[1]) && $explode_url[1]) {
                $request->action = strtolower($explode_url[1]);
                $request->params = array_slice($explode_url, 2);
            }
        }
    }
}
?>