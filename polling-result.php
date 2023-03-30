<?php
    $method=strtolower($_SERVER['REQUEST_METHOD']);
    switch($method){
        case 'post':
            print_r($_POST);
            echo('postitttttttttttt');
            break;
        case 'get':
            print_r($_GET);
            echo('gettttttttttttt');
            break;
    }


?>

