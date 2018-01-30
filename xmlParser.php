<?php
/**
 * Created by PhpStorm.
 * User: gimmy
 * Date: 29-1-18
 * Time: 11:41
 */


error_reporting(E_ALL);
ini_set("display_errors", 1);


if (file_exists("")) {
    $xml = simplexml_load_file(" ");

    print_r($xml);
} else {
    exit('Failed to open test.xml.');
}









?>