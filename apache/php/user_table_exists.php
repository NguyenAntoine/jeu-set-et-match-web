<?php
$link = mysqli_connect('db', 'root', 'root', 'ATP');
$result = 'false';
if ($link !== false){
    $query = mysqli_query($link, "SHOW TABLES LIKE 'user';");
    if (false !== $query && $query->num_rows == 1) {
        $result = 'true';
    }
    mysqli_close($link);
}
die($result);