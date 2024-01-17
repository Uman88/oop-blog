<?php

function check_input($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    $data = strip_tags($data);
    return $data;
}

define("CSS", "../../public/assets/css/");
define("JS", "../../public/assets/js/");
define("IMAGES", "../../public/assets/images/");
define("UPLOADS", "../public/assets/uploads/");

const ROLE_ADMIN = 1;
const ADMIN = 'admin@gmail.com';