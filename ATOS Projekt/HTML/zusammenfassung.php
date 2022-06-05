<?php 
    
    // Post Keys aus dem $_POST Array auslesen
    $post_keys = array_keys($_POST);

    // Post Values aus dem $_POST Array auslesen
    $post_values = array_values($_POST);

    for ($i = 0; $i < count($post_keys) -1; $i++) {
        $post_key = $post_keys[$i];
        $post_value = $post_values[$i];
        echo $post_key . ": " . $post_value . "<br>";
    }

    

?>