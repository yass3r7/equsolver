<?php

/*
**
** 1st degree Equation Solver
** By 'Yasser Boubani'
** 20-04-2020
**
*/

/*
-- Response Form:
    array(
        "msg"       => "solved" || "error",
        "equation"  => $equ,
        "solve"     => array(...), // if "msg" == "solved"
        "error"     => "error message here" // if "msg" == "error"
    )
*/

function check($equ) : Bool
{
    // [Check for illegal characters]
    $allowedList = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "x", "+", "-", "=", "."]; // The list of allowed chars
    $arrEqu = str_split($equ); // split the equ
    foreach ($arrEqu as $char) { // each char of the equ must be in the allowed chars list
        if (!in_array($char, $allowedList)) {
            return false;
        }
    }

    // [Check the equal sign (=)]
    if (strpos($equ, "=") === false || strpos($equ, "=") != strrpos($equ, "=")) { // the equ must have only one (=)
        return false;
    }
    if (strpos($equ, "=") === 0) {
        return false;
    }

    // [Check the UNKNOWN sign (x)]
    if (strpos($equ, "x") === false) { // the equ must have at least one x
        return false;
    }
    if (preg_match("/[0-9][x][0-9][x]/", $equ)) {
        return false;
    }

    // [Check the floating point sign (.)]
    // .= =. x. .x .. .num.num +. -. .- .+
    // /[.][0-9][.]/
    if (strpos($equ, ".=") != false ||
        strpos($equ, "=.") != false ||
        strpos($equ, "x.") != false ||
        strpos($equ, ".x") != false ||
        strpos($equ, "..") != false ||
        strpos($equ, "+.") != false ||
        strpos($equ, "+.") != false ||
        strpos($equ, "-.") != false ||
        strpos($equ, ".-") != false)
        {
            return false;
        }
    if (preg_match("/[.][0-9][.]/", $equ)) {
        return false;
    }

    // [Check the (-) and (+) signs]
    // ++ -- +- -+
    if (strpos($equ, "++") != false ||
        strpos($equ, "--") != false ||
        strpos($equ, "+-") != false ||
        strpos($equ, "-+") != false)
        {
            return false;
        }

    return true;
}

function solve($equ) : Array
{
    $response = array(
        "equation"  => $equ
    ); // the response array

    // The very first sanitize of the equation
    $equ = strtolower($equ); // to lower case
    $equ = str_replace(" ", "", $equ); // remove spaces

    // Check the equation
    if (!check($equ)) {
        $response["msg"] = "Error";
        $response["error"] = "Invalid equation!";
        return $response;
    }

    // Start solving
    $response["msg"] = "Solved";

    /* START STEP 1 */
    $splitted_equ = str_split($equ); // convert the squ from string into array each char in the equ is an element in that array
    $equ_left_side = array(); // prepare the left side of the equ
    $equ_right_side = array(); // prepare the right side of the equ

    $current_side = "equ_left_side"; // start with the left side. We will use dynamic  variables access
    $item = 0; // index of equ_items
    $ci = 0; // current index in $equ_...._side

    for (;;$ci++) { // loop on the $splitted_equ array elements
        if ($ci >= count($splitted_equ)) {
            break;
        }

        if ($ci == 0) { // push the first element of $splitted_equ array in the $current_side
            ${$current_side}[] = $splitted_equ[$ci];
            continue;
        }

        if ($splitted_equ[$ci] != "+" && $splitted_equ[$ci] != "-") { // if the current $splitted_equ char is not + nor - then:
            if ($splitted_equ[$ci] == "=") { // if we reach to (=) then:
                $splitted_equ = array_slice($splitted_equ, $ci+1); // slice the $splitted_equ arr from the next index of (=)
                $current_side = "equ_right_side"; // swap the side to the right side
                $item = 0; // init the index of $equ_...._side
                $ci = -1; // init the ci of $splitted_equ because now we have to deal with the new $splitted_equ (we slice it before)
                continue; // loop again on the new $splitted_equ
            }
            ${$current_side}[$item] .= $splitted_equ[$ci]; // concat the current char to the current side element
            continue;
        } else { // or if it is (+) or (-)
            ${$current_side}[] = $splitted_equ[$ci]; // make a new index and push the current char to it
            $item++; // increase the index item of the current side
            continue;
        }
    }

    if (count($equ_right_side) == 0) {
        $equ_right_side = [0];
    }

    $response["solve"] = array( // set the first equ statement to the response array as string inside the solve array
        implode($equ_left_side, "") . " = " . implode($equ_right_side, "")
    );
    /* END STEP 1 */

    /* START STEP 2 */
    /*
    ** After the (STEP 1) Now we have the equ_left_side and equ_right_side as arrays.
    ** We will continue with them:
    ** $equ_left_side
    ** $equ_right_side
    */

    // dealing with the left side
    for ($i = 0; $i < count($equ_left_side); $i++) {
        if (strpos($equ_left_side[$i], "x") === false) { // if the $equ_left_side[$i] does not contain 'x' then we should swap its sign (+ to -) or (- to +) and move it to the right side
            $temp_value = floatval($equ_left_side[$i])*(-1); // swap its sign
            if ($temp_value >= 0) {
                $equ_right_side[] = "+$temp_value";
            } else {
                $equ_right_side[] = $temp_value;
            }
            
            $equ_left_side[$i] = NULL; // make it null (don't remove it we need to keep the same number of elements)
        }
    }

    // Dealing with the right side
    for ($i = 0; $i < count($equ_right_side); $i++) {
        if (strpos($equ_right_side[$i], "x") !== false) { // if the $equ_right_side[$i] contains 'x' then we should swap its sign (+ to -) or (- to +) and move it to the left side
            // deal with value like (7x)
            // deal with value like (7x9)
            $temp_arr = explode("x", $equ_right_side[$i]);
            if ($temp_arr[0] == "-") {
                $temp_arr[0] = "-1";
            } elseif ($temp_arr[0] == "+") {
                $temp_arr[0] = "+1";
            } else {
                $temp_arr[0] = "+1";
            }

            if ($temp_arr[1] == NULL) { // 7x ==> [7, NULL] |BUT| 7x9 ==> [7, 9]
                $temp_value = floatval($temp_arr[0])*(-1); // swap the sign

                if ($temp_value >= 0 ) {
                    $equ_left_side[] =  "+{$temp_value}x";
                } else {
                    $equ_left_side[] =  "{$temp_value}x";
                }

                $equ_right_side[$i] = NULL;
            } else {
                $equ_left_side[] = ( floatval($temp_arr[0]) * floatval($temp_arr[1]) ) * -1 . "x";
                $equ_right_side[$i] = NULL;
            }
        }
    }

    for ($i = 0; $i < count($equ_left_side); $i++) {
        if ($equ_left_side[$i] == NULL) {
            unset($equ_left_side[$i]);
        }
    }
    for ($i = 0; $i < count($equ_right_side); $i++) {
        if ($equ_right_side[$i] == NULL) {
            unset($equ_right_side[$i]);
        }
    }

    $temp_left_side = array();
    $temp_right_side = array();
    foreach ($equ_left_side as $side_item) {
        $temp_left_side[] = $side_item;
    }
    $equ_left_side = $temp_left_side;

    foreach ($equ_right_side as $side_item) {
        $temp_right_side[] = $side_item;
    }
    $equ_right_side = $temp_right_side;
    unset($temp_left_side);
    unset($temp_right_side);

    if (count($equ_right_side) == 0) {
        $equ_right_side = [0];
    }

    $temp_solve_sentence = implode($equ_left_side, "") . " = " . implode($equ_right_side, "");
    if ($response["solve"][count($response["solve"])-1] != $temp_solve_sentence) {
        $response["solve"][] = $temp_solve_sentence;
    }
    /* END STEP 2 */

    /* START STEP 3 */
    for ($i = 0; $i < count($equ_left_side); $i++) {
        $temp_arr = explode("x", $equ_left_side[$i]);
        if ($temp_arr[0] == "-") {
            $equ_left_side[$i] = -1;
        } elseif ($temp_arr[0] == "+") {
            $equ_left_side[$i] = 1;
        } else {
            $equ_left_side[$i] = 1;
        }
        if ($temp_arr[1] == NULL) {
            $equ_left_side[$i] = str_replace("x", "", $equ_left_side[$i]);
        } else {
            $equ_left_side[$i] = $temp_arr[0] * $temp_arr[1];
        }
    }

    $sumLeft = 0;
    foreach ($equ_left_side as $side_item) {
        $sumLeft += floatval($side_item);
        // echo "<div>$side_item</div>";
    }

    $sumRight = 0;
    foreach ($equ_right_side as $side_item) {
        $sumRight += ($side_item);
    }

    $equ_left_side = ["{$sumLeft}x"];
    $equ_right_side = [$sumRight];

    $temp_solve_sentence = implode($equ_left_side, "") . " = " . implode($equ_right_side, "");
    if ($response["solve"][count($response["solve"])-1] != $temp_solve_sentence) {
        $response["solve"][] = $temp_solve_sentence;
    }
    /* END STEP 3 */

    /* START STEP 4 */
    $temp_solve_sentence = "x = {$sumRight}/{$sumLeft}";
    if ($response["solve"][count($response["solve"])-1] != $temp_solve_sentence) {
        $response["solve"][] = $temp_solve_sentence;
    }
    /* END STEP 4 */

    /* START STEP 5 */
    $result = ($sumRight/$sumLeft);
    $temp_solve_sentence = "x = $result";
    if ($response["solve"][count($response["solve"])-1] != $temp_solve_sentence) {
        $response["solve"][] = $temp_solve_sentence;
    }
    /* END STEP 5 */

    /* START STEP 6 */
    $result = round($result, 2);
    $temp_solve_sentence = "x = $result";
    if ($response["solve"][count($response["solve"])-1] != $temp_solve_sentence) {
        $response["solve"][] = $temp_solve_sentence;
    }
    /* END STEP 6 */

    // SOLVED
    return $response;
}