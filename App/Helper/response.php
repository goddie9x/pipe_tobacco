<?php

class Response
{
    public $data = null;
    public $status = null;
    public $header = null;
    public function __construct($data='', $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }
    public function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    public function header($header)
    {
        $this->header = $header;
        
    }
}

function response($data='', $status = 200)
{
   return new Response($data, $status);
}