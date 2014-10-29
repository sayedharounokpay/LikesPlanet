<?php
include('header.php');


if(!isset($data->login)){
include('index_v2.php');
} else {
include('index_v1.php');
}


include('footer.php');?>
