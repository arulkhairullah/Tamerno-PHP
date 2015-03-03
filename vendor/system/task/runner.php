<?php


Loader::start();
	
//create registry object
$registry				= new Registry;

//create route object
$registry->route		= new BaseRouter($registry);

//create model object
$registry->model		= new BaseModel($registry);

//create view object
$registry->view			= new BaseView($registry);

//access load functionality
$registry->route->load();


?>