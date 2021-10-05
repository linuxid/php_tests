<style>
    a.button {
        -webkit-appearance: button;
        -moz-appearance: button;
        background-color: aqua;

        text-decoration: none;
        color: initial;
    }
    .left, .right {
        height: 100%;
        width: 50%;
        position: fixed;
        overflow-x: hidden;
        padding-top: 20px;
        padding-left: 20px;
    }
    .left {
        left: 0;
        background-color: rgb(185, 240, 234);
    }
    .right {
        right: 0;
        background-color: rgb(56, 1, 44);
    }
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .centered img {
        width: 150px;
        border-radius: 50%;
    }
</style>
<?php
include_once ('functions.php');
$link=connect();
init($link);
$picpath="";
?>
<div class="left">
<?php
//------------------------------- button to add topics----------------------------------
echo '<a href="topics.php" class="button">Edit topics</a><br>';
//---------------------------------Topic choice menu------------------------------------
$sel='select * from topics order by id';
$res=mysqli_query($link,$sel);
echo 'Select topic to add question: <br>';
echo '<form action="" method="post" enctype="multipart/form-data" >';
echo '<select name="topicsel">';
while ($row=mysqli_fetch_array($res,MYSQLI_NUM)){
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}
echo '</select>';
//echo '</form>';
mysqli_free_result($res);
?>
<!---------------------------------Language choice menu-------------------------------->
<p>Select language: </p>
<select name="lang">
    <option value="u">UKR</option>
    <option value="e">ENG</option>
    <option value="r">RUS</option>
</select>
<br>
<!---------------------------------File choice menu------------------------------------->
<p>Choose picture:</p>
<input type='file' name='filename'  accept="image/*"/><br>
<!--<input type='submit' value='Save name' name='but_upload'><br>-->
<!---------------------------------Enter question------------------------------------->
<textarea name="question" cols="100" rows="10"></textarea><br>
<input type="submit" name="addquest" value="Add"><br>

</form>
</div>
<?php
//if(isset($_POST['file'])){

    // Upload file

//}
$link=connect();
if (isset($_POST['topicsel'])&isset($_POST['lang'])&isset($_POST['question'])){
    $name = $_FILES['filename']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["filename"]["name"]);

//    // Select file type
//    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//
//    // Valid file extensions
//    $extensions_arr = array("jpg","jpeg","png","gif");
//
//    // Check extension
//    if( in_array($imageFileType,$extensions_arr) ) {
        $picpath=$target_dir.$name;
        move_uploaded_file($_FILES['filename']['tmp_name'],$target_dir.$name);
//    }
    $ins='insert into mcq(topicid,lang,picture,question) values ('.$_POST['topicsel'].
        ', "'.$_POST['lang'].'", "'.$picpath.'", "'.$_POST['question'].'");';
    mysqli_query($link,$ins);

}
//mysqli_free_result($res);
//echo $_POST['topicsel'].$_POST['lang'].$_POST['question'].$picpath."---".$name;

