<?php
    $db_name= 'mysql:host=localhost;dbname=moonrise_academy';
    $user_name='root';
    $passwd="";

    $conn = new PDO($db_name, $user_name, $passwd);

    if(!$conn)
    {
        echo "Not connected";
    }

    function unique_id($length = 20) {
        return bin2hex(random_bytes($length / 2)); // Each byte produces 2 hex characters
    }
?>