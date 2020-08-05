<?php
namespace test\formController\Controllers;

class EmptyString
{
    protected $errors = [];

    public function isEmpty($arr)
    {
        foreach ($arr as $key => $value) {
            if (empty($value)) {
                $this->errors[$key] = '';
            }
        }
        $this->isErrors($this->errors);
    }

    protected function isErrors($errors)
    {
        $errors;
        if($errors) {
            header('HTTP/1.1 500 Internal Empty Fields');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode($errors));
        } else {
            echo json_encode('ok');
        }
    }
}