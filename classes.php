<?php
class Question
{
    public $condition;
    public $a=array();
    public $corr=0;
    private static $keys=array();
    function __construct($c)
    {
        $this->condition=$c[0];
        for ($i=1;$i<6;$i++){
            $this->a[]=$c[$i];
        }
    }
    function Show($num)
    {
        echo ($num+1).') '.$this->condition.'<br>';
        echo '<select class="n" onclick="className=selectedIndex?\'y\':\'n\'" name=task'.($num+1).'>';
        echo '<option> ---------------------------------------------------------------</option>';
        for ($i=0;$i<5;$i++) {
            echo '<option value="'.$i.'">'." ";
            //if ($i==$this->corr) echo '*';
            echo $this->a[$i].'</option>';
        }
        echo '</select>';
        echo '<hr><br>';
    }
    function Shuf()
    {
        $tmp=$this->a[0];
        shuffle($this->a);
        for ($i=0;$i<5;$i++) {
            if ($this->a[$i]==$tmp) $this->corr=$i;
        }
    }
    static function Get_keys($obj)
    {
        for ($i=0;$i<count($obj);$i++){
            $keys[$i]=$obj[$i]->corr;
            //echo $obj[$i]->corr;
        }
        return $keys;
    }
}