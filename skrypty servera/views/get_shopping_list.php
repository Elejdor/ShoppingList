<?php
ini_set('default_charset', 'utf-8');

if (isset($_GET['id'])) {
   
    $id = $_GET['id'];
    
    
    $sl = slQueries::GetList($id);
    echo $sl->getAndroidString();
    
}