<?php
namespace test\formController\Controllers;

class Validate
{
    protected $errors = [
        'errorFirstName' => '',
        'errorLastName' => '',
        'errorEmail' => '',
        'errorPassword' => '',
        'errorPhone' => '',
        'errorTerms' => '',
    ];

    public function checkErrors()
    {
        if(!empty(array_filter($this->errors))) {
            header('HTTP/1.1 400 Validate Error');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode($this->errors));
        } else {
            echo json_encode('Thank you!');
        }
    }

    public function checkRequire($reqField, $keyError)
    {
        if (empty($reqField)) {
            $this->errors[$keyError] = 'This field is require';
        }
        return $this;
    }

    public function checkLength($value = "", $min, $max, $keyError)
    {
        if (empty($this->errors[$keyError])) {
            if(mb_strlen($value) < $min || mb_strlen($value) > $max) {
                $field_name = mb_substr($keyError, 5, mb_strlen($keyError));
                $field_name = preg_split("#([A-Z][^A-Z]*)#", $field_name, null, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                $field_name = implode(" ", $field_name);

                $this->errors[$keyError] = "$field_name $min-$max character";
            }
        }
        return $this;
    }

    public function checkEmail($email, $keyError)
    {
        if (empty($this->errors[$keyError])) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->errors[$keyError] = 'Email invalid';
            }
        }
        return $this;
    }

    public function checkPassword($password, $keyError)
    {
        if (empty($this->errors[$keyError])) {
            if(!preg_match("/^[0-9a-zA-Z]+$/", $password) ) {
                $this->errors[$keyError] = 'Password invalid';
            }
        }
        return $this;
    }

    public function checkPhone($phone, $keyError)
    {
        if (empty($this->errors[$keyError])) {
            if(!preg_match("/^\d{10}$/", $phone)) {
                $this->errors[$keyError] = 'Phone invalid';
            }
        }
        return $this;
    }
}