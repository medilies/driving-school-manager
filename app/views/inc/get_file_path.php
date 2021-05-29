<?php
function get_file_path($file_name, $client_email)
{
    $png = "/public/assets/uploads/$client_email/$file_name.png";
    $jpg = "/public/assets/uploads/$client_email/$file_name.jpg";
    $jpeg = "/public/assets/uploads/$client_email/$file_name.jpeg";
    $pdf = "/public/assets/uploads/$client_email/$file_name.pdf";

    if (file_exists(PROJECT_ROOT . $png)) {
        return $png;
    } else if (file_exists(PROJECT_ROOT . $jpg)) {
        return $jpg;
    } else if (file_exists(PROJECT_ROOT . $jpeg)) {
        return $jpeg;
    } else if (file_exists(PROJECT_ROOT . $pdf)) {
        return $pdf;
    }
}
?>