<?php
include_once ('functions.php');
$link=connect();

$sel='select * from topics order by id';
$res=mysqli_query($link,$sel);
echo '<form action="topics.php" method="post">';
echo '<table>';
while ($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    echo '<tr>';
    echo '<td>'.$row[0].'</td>';
    echo '<td>'.$row[1].'</td>';
    echo '<td><input type="checkbox" name="cd'.$row[0].'"></td>';
    echo '</tr>';
}
echo '</table>';
mysqli_free_result($res);
echo '<input type="text" name="topic" placeholder="New topic">';
echo '<input type="submit" name="addtop" value="Add">';
echo '<input type="submit" name="deltop" value="Delete">';
echo '</form>';

if (isset ($_POST['addtop'])){
    $topic=trim(htmlspecialchars($_POST['topic']));
    if ($topic=="") exit();
    $ins='insert into topics(topic) values("'.$topic.'")';
    mysqli_query($link,$ins);
    renew();
}
if (isset($_POST['deltop'])){
    foreach ($_POST as $k=>$v){
        if (substr($k,0,2)=="cd"){
            $idc=substr($k,2);
            $del='delete from topics where id='.$idc;
            mysqli_query($link,$del);
        }
        $result = mysqli_query($link,"SELECT COUNT(*) AS `count` FROM `topics`");
        $rw = mysqli_fetch_assoc($result);
        $lines = $rw['count'];
        if ($lines==0) {
            $alt='alter table topics auto_increment=1';
            mysqli_query($link,$alt);
        }
        elseif ($lines>0){
            $result="select *from topics ORDER BY id DESC LIMIT 1;";
            $id=mysqli_fetch_array(mysqli_query($link,$result),MYSQLI_NUM);
            mysqli_query($link,"alter table topics auto_increment=".($id[0]));
        }
    }
    renew();
}
?>
<a href="admin.php" class="button">Back</a>
