<?php
session_start();
include_once ('functions.php');
include_once ('classes.php');
echo '<style>
       body {
    -webkit-user-select: none;
    -webkit-touch-callout: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    color: #0d0c0c;
    background-color: lightblue;
    font-size: 24px;
    }
       .n {
            background-color: yellow;
       }
       .y {
            background-color: white;
       }
       select {
        
            font-size: 18px;
        }
       input {
            font-size: 32px;
            color: indigo;
            background-color: gold;
       }
       .co {
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
    }
    </style>
    
    ';
if ($_POST['username']=="" || !is_numeric($_POST['usergroup'])) {
    echo '
    <div class="co">
        <pre>
            Enter correctly name and group number!!!
            <a href="index.php">Back</a>
        </pre>
    </div>
    ';
}
else {
$_SESSION['name']=$_POST['username'];
$_SESSION['group']=$_POST['usergroup'];


echo 'You are welcome, '.$_POST["username"].'!<br><br>';
//write_name($_POST["username"]);
$counter=0;
echo '<form action="result.php" method="POST">';
$tasks=read_tasks();
$task=array();
for ($i=0;$i<count($tasks)/7;$i++) {

    $tmp=array();
    for ($j=0;$j<8;$j++){

        $tmp[]=$tasks[$i*7+$j];
    }
    $task[]=new Question($tmp);
    unset($tmp);

}
$keys=array();
shuffle($task);
$_SESSION['task_limit']=count($task);
//$task_limit=count($task);
if (count($task)>30) $_SESSION['task_limit']=30;
for ($i=0;$i<$_SESSION['task_limit'];$i++){
    $task[$i]->Shuf();
    $task[$i]->Show($i);
}
$keys=Question::Get_keys($task);
$_SESSION['keys']=$keys;
    echo '             <p><input type="submit" name="finish" value="Finish"></p>
            </form>';
}