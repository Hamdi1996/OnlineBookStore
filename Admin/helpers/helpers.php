<?php
function validate($input, $flag, $length = 6)
{
    $status = true;

    switch ($flag) {
        case 1:
            # code...
            if (empty($input)) {
                $status = false;
            }
            break;

        case 2:
            if (!preg_match('/^[a-zA-Z\s]*$/', $input)) {
                $status = false;
            }
            break;

        case 3:
            # code 
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                $status = false;
            }
            break;


        case 4:
            $allowedExt = ['png', 'jpg', 'jpeg'];
            $extArray = explode('/', $input);
            if (!in_array($extArray[1], $allowedExt)) {
                $status = false;
            }
            break;

        case 5:
            if (strlen($input) < $length) {
                $status = false;
            }
            break;


        case 6:
            # code 
            if (!filter_var($input, FILTER_VALIDATE_INT)) {
                $status = false;
            }
            break;


        case 7:
            # code 
            if (!preg_match('/^01[0-2,5][0-9]{8}$/', $input)) {
                $status = false;
            }
            break;
        case 8:
            # code 
            if(strlen($input) != 13 || !preg_match("/^[0-9]*$/", $input)) {
                $status = false;
            }
            break;
        case 9:
            # code 
            if (!preg_match('#[0-9]{5}#', $input)) {
                $status = false;
            }
            break;
    }

    return $status;
}


function CleanInputs($input)
{

    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}



function sanitize($input, $flag)
{

    switch ($flag) {
        case 1:
            # code...
            $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            break;
    }

    return $input;
}


function PrintMessages($txt = null, $del_flag = 0)
{
       $errors =''; 
       $message =''; 
    if (isset($_SESSION['Errors'])) {

        foreach ($_SESSION['Errors'] as $data) {
            $errors .= $data."<br>";
        }

        echo '<ol class="alert alert-danger" role="alert"><li class="breadcrumb-item active">'. $errors .'</li></ol>';
        if ($del_flag == 0) {
            unset($_SESSION['Errors']);
        }
    }
      elseif(isset($_SESSION['Message'])) {

        foreach ($_SESSION['Message'] as $data) {
            $message .= $data."<br>";
        }

        echo '<ol class="alert alert-primary" role="alert"><li class="breadcrumb-item active">'. $message .'</li></ol>';
    
        if ($del_flag == 0) {
            unset($_SESSION['Message']);
        }
    }
        else {
        echo '<ol class="breadcrumb mb-4"><li class="breadcrumb-item active">'.$txt .'</li></ol>'; 
    }
}

/*******************Get Base Url For current page**** */
function url($input)
{
    return "http://" . $_SERVER['HTTP_HOST'] . "/libsystem/Admin/" . $input;
}
/**********************Get base Url For User************ */
function Furl($input)
{
    return "http://" . $_SERVER['HTTP_HOST'] . "/libsystem/User/" . $input;
}



