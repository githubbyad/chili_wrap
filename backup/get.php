<?php
$submittedData =  file_get_contents("wrapsdata.json");
$path = "wrapsdataAll.json";

$txt = "\n\n\n\n************************ " . date("Y-m-d h:i:sa") . " ************************\n\n\n\n";
$AllData = file_get_contents($path );

$merge = $AllData . $txt . $submittedData;

file_put_contents($path, $merge);
