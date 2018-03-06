<?php
	require("config.php");

	require("outils/Preferences.class.php");
	require("outils/Routeur.class.php");
	require("modeles/Modele.class.php");
	require("vues/Vue.class.php");

	spl_autoload_register(
	function($class) {
	if (file_exists("controleur/$class.class.php"))
		include("controleur/$class.class.php");
	});

	$prefs = new Preferences();
	$router = new Router($prefs);
	$prefs->router=$router;

	$prefs->script_name =$_SERVER['SCRIPT_NAME'];
	$prefs->hostname = $hostname;
	$prefs->dbname = $dbname;
	$prefs->username = $username;
	$prefs->password = $password;
	
	$router->setRoutes($routes);
	$router->setDefaultRoute($default_route);

	if(isset($_GET['action']))
		$route = $_GET['action'];
	else
		$route = "index";
	$router->route($route);

?>
