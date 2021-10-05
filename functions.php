<?php
function write_name ($name, $group, $result)
{
    $file=fopen('./results/'.date("d-m-Y").'users.txt','a+');
    $line=date("d-m-Y").' : '.(date("H")-1).':'.date("i").' ==> '.$group.' ==> '.$name.' ==> '.$result.PHP_EOL;
    fputs($file,$line);
    fclose($file);
}
function read_tasks()
{
    $all_msq=file_get_contents('mcq.txt');
    return explode(PHP_EOL,$all_msq);
}

function write_keys($keys)
{
    $file=fopen('keys.txt','a+');
    for ($i=0;$i<count($keys);$i++) {
        $line=$line.$i.'=>'.$keys[$i].PHP_EOL;
        }
    $line=$line.'--------------------------------------------------------------------------------------------'.PHP_EOL;
    fputs($file,$line);
    fclose($file);
}

function connect(
        $host='localhost',
        $user='root',
        $pass='root',
        $dbname='questions')
{
    $link=mysqli_connect($host,$user,$pass) or die ('connection error');
    mysqli_select_db($link,$dbname) or die ('DB open error');
    mysqli_query($link,"set names 'utf8'");
    return $link;

}

function init($link)
{
    $ct1='create table if not exists topics (
        id int not null auto_increment primary key,
        topic varchar(256) unique
        ) default charset="utf8"';
    $ct2='create table if not exists mcq (
        id int not null auto_increment primary key,
        topicid int,
        foreign key (topicid) references topics(id) on delete cascade,
        lang varchar(2),
        picture varchar(128),
        question varchar(10240)
        ) default charset="utf8"';
    mysqli_query($link, $ct1);
    $err=mysqli_errno($link);
    if ($err){
        echo 'Error code 1: '.$err.'<br>';
    }
    mysqli_query($link, $ct2);
    $err=mysqli_errno($link);
    if ($err){
        echo 'Error code 2: '.$err.'<br>';
    }
}
function renew()
{
    echo "<script>";
    echo "window.location=document.URL;";
    echo "</script>";
}


