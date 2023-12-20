<?php

// Takes raw data from the request
$json = file_get_contents('php://input');


$path = "wrapsdata.json";

file_put_contents($path, $json);

?>