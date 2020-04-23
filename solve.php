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
} else { ?>
    <div>
        <p>Welcome to the 1st Degree Equation Solver API</p>
        <a href="?equ=9x%2Bx-15%3D3x%2B9-x">example (9x+x-15=3x+9-x)</a>
        <p>Note: before sending the GET request you have to encode the special characters of the URI. Click on the example and see the query '?equ=...'</p>
        <p>The function encodeURIComponent() in JS is used to do that.</p>
        <a href="javascript:alert('soon! Just after making a documentation for this API :)')">DOWNLOAD the source code with practical demo (github)</a>
    </div>
<?php } ?>