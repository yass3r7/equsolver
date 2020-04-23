<?php

/*
**
** 1st Degree Equation Solver API
** BY 'Yasser Bouabni'
** (20 / 21)-04-2020
**
*/

header("Access-Control-Allow-Origin: *");

include "solver.php";

if (isset($_GET["equ"]) && $_GET["equ"] != NULL) {
    header("Content-Type: application/json");
    $equ = $_GET["equ"];
    $response = solve($equ);
    $json = json_encode($response);
    $json = str_replace("\/", "/", $json);
    echo $json;
}
