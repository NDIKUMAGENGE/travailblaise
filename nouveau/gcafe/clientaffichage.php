<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and object files
include_once 'config/database.php';

include_once 'objects/client.php';
 include_once 'index.html';
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 

 $client= new Agriculteur($db);
 
$page_title = "LISTES DES CAFEICULTEURS";
include_once "layout_header.php";
 
// query products
$stmt = $client->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "clientaffichage.php?";
 
// count total rows - used for pagination
$total_rows=$client->countAll();
 
// read_template.php controls how the product list will be rendered
include_once "readtemplateclient.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>