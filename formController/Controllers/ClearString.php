<?php
namespace test\formController\Controllers;

class ClearString
{
    protected $clear_data = [];

     public function clear($arr)
     {
         foreach ($arr as $key => $value) {
             $value = trim($value);
             $value = stripslashes($value);
             $value = strip_tags($value);
             $value = htmlspecialchars($value);

             $this->clear_data[$key] = $value;
         }
         return $this->clear_data;
     }
}