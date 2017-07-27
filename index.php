<?php
require 'common.php';

$action = i($QUERY, 'action');

$directors = new Crud("App_Director");
$directors->setTitle("Director", "Directors");
$directors->addField("image", "Image", 'text');
$directors->addField("user_id", "", 'int', array(), '', 'hidden');

$directors->setListingFields("name","role",'email','image','sort','status');
$directors->render();
//render();
