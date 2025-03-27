<?php
function getImagePath($imageName)
{
    $current_path = $_SERVER['PHP_SELF'];
    $base_path = '';

    if (strpos($current_path, '/pages/') !== false) {
        $base_path = '../upload/';
    } else {
        $base_path = './upload/';
    }

    return $base_path . $imageName;
}

function getPageUrl($path)
{
    return '/php_shop/pages/' . $path;
}
