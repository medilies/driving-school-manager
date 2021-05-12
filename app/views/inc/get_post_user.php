<?php
function get_name($post)
{
    if ($post['lname'] === "admin") {
        return "ADMIN";
    }
    return $post['lname'] . ' ' . $post['fname'];
}
