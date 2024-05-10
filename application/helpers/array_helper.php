<?php
function printr($array){
    echo "<pre>".print_r($array,true)."</pre>";
    exit();
}