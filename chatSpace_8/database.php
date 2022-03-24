<?php
function dbConnect()
{
    $link = new mysqli('localhost','root','','chatspace');
    if ($link->connect_error) {
        echo $link->connect_error;
        exit ();
    }
    return $link;
}
