<?php

// variables for database connection
$db_name='mysql:host=localhost;dbname=lighten_up';
$db_user_name='root';
$db_password='';

// connect to the database
$conn = new PDO($db_name, $db_user_name, $db_password);

function create_unique_id() {
    $char="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $char_length=strlen($char);
    $rand_str="";
    for($i=0;$i<20;$i++){
        $rand_str.=$char[mt_rand(0,$char_length-1)];
    }
    return $rand_str;
}
?>