<?php
include_once ('functions.php');
session_start();
$result=0;


$counter=0;
foreach ($_POST as $ee) {
    if (is_numeric($ee)) {
        if ($_SESSION['keys'][$counter] == $ee) $result++;
    }
    $counter++;
}
echo '<style>
       body {
    background-color: lightblue;
    font-size: 24px;
    }
    .center {
    position: absolute;
    width: 200px;
    height: 50px;
    top: 50%;
    left: 50%;
    margin-left: -50px; /* margin is -0.5 * dimension */
    margin-top: -25px;
}
    </style>';
echo '<div class="center">';
if (isset($_SESSION['keys'])) {
    //$percent = round($result / count($_SESSION['keys']) * 100, 2);
    $percent = round(($result / $_SESSION['task_limit']) * 100, 2);
    echo $_SESSION['name'] . ', your result is: ' . $percent . '%' . '<br>';
}
echo '</div>';

write_name($_SESSION['name'],$_SESSION['group'],$percent);
session_destroy();
?>
<a href="index.php">Back</a>
