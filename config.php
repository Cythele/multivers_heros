<?php

	$hostname="127.0.0.1";
	$dbname="livre_hero2";
	$username="root";
	$password="";

	$routes=[
		"index"=>"IndexController",
		"newGame"=>"HistoryController",
		"createPerso"=>"CreatePersoController",
		"histoireEnCours"=>"HistoryActualController",
		"options"=>"OptionsController",
		"chargerPartie"=>"ChargerPartieController",
		"inventaire"=>"InventaireController",
    ];

$default_route="error";

?>
