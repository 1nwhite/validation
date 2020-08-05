<?php
//    require __DIR__."/../vendor/autoload.php";
    require_once "Controllers/ClearString.php";
    require_once "Controllers/Validate.php";

    use test\formController\Controllers\ClearString;
    use test\formController\Controllers\Validate;

    if ('application/json' == $_SERVER['CONTENT_TYPE'] && 'POST' == $_SERVER['REQUEST_METHOD']) {
        $_REQUEST['JSON'] = json_decode(file_get_contents('php://input'), true);

        $validate = new Validate();
        $clear_string = new ClearString();

        $clear_arr = $clear_string->clear($_REQUEST['JSON']);

        $first_name = $clear_arr['first_name'];
        $last_name = $clear_arr['last_name'];
        $email = $clear_arr['email'];
        $password = $clear_arr['password'];
        $phone = $clear_arr['phone'];
        $checkbox_terms = $clear_arr['terms'];

        $validate->checkRequire($first_name, 'errorFirstName')
                 ->checkLength($first_name, 2, 15, 'errorFirstName');

        $validate->checkRequire($last_name, 'errorLastName')
                 ->checkLength($last_name, 3, 20, 'errorLastName');

        $validate->checkRequire($email, 'errorEmail')
                 ->checkEmail($email, 'errorEmail');

        $validate->checkRequire($password, 'errorPassword')
                 ->checkPassword($password, 'errorPassword')
                 ->checkLength($password, 6, 12, 'errorPassword');

        $validate->checkRequire($phone, 'errorPhone')
                 ->checkPhone($phone, 'errorPhone');

        $validate->checkRequire($checkbox_terms, 'errorTerms');

        $validate->checkErrors();

    };