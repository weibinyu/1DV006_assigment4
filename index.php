<?php
 /**
  * Solution for assignment 2
  * @author Daniel Toll
  */
require_once("Settings.php");
require_once("controller/LoginController.php");
require_once("view/DateTimeView.php");
require_once("view/LayoutView.php");
require_once("view/RegisterView.php");


if (Settings::DISPLAY_ERRORS) {
	error_reporting(-1);
	ini_set('display_errors', 'ON');
}

//session must be started before LoginModel is created
session_start(); 

//Dependency injection
$m = new LoginModel();
$v = new LoginView($m);
$rv = new RegisterView();
$c = new LoginController($m, $v);


//Controller must be run first since state is changed
$c->doControl();


//Generate output
$dtv = new DateTimeView();
$lv = new LayoutView();
$lv->render($m->isLoggedIn($v->getUserClient()), $v, $dtv,$rv);

