<?php
define("DOCROOT",$_SERVER["DOCUMENT_ROOT"]."/");
define("APPPATH",DOCROOT."app/");
define("ROOTPATH",APPPATH."root/");
define("CONTROLLERPATH",APPPATH."controllers/");
define("VIEWPATH",APPPATH."views/");
define("TEMPLATEPATH",APPPATH."templates/");
define("FNSPATH",APPPATH."functions/");
define("DATAPATH",DOCROOT."data/");

include APPPATH."app_start.php";
$app = new AppStart();
$app->run();