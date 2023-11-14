<?php
	
	/*****************************************************************************************************
	/*						Defaultwerte für die Eingabefelder der Startseite
	/*****************************************************************************************************/
	
	if( !isset($_SESSION["bg"]) ) {
		$_SESSION["bg"]=0;
	}
	if( !isset($_SESSION["geburtsdatum"][0]) ) {
		$_SESSION["geburtsdatum"][0]=1;
	}
	if( !isset($_SESSION["geburtsdatum"][1]) ) {
		$_SESSION["geburtsdatum"][1]=1;
	}
	if( !isset($_SESSION["geburtsdatum"][2]) ) {
		$_SESSION["geburtsdatum"][2]=max(array(date("Y"),2023))-60;
	}
	if( !isset($_SESSION["eintrittsdatum"][1]) ) {
		$_SESSION["eintrittsdatum"][1]=1;
	}
	if( !isset($_SESSION["eintrittsdatum"][2]) ) {
		$_SESSION["eintrittsdatum"][2]=max(array(date("Y"),2023))-20;
	}
	if( !isset($_SESSION["sex"]) ) {
		$_SESSION["sex"]="Mann";
	}
	if( !isset($_SESSION["stichdatum"][1]) ) {
		$_SESSION["stichdatum"][1]=1;
	}
	if( !isset($_SESSION["stichdatum"][2]) ) {
		$_SESSION["stichdatum"][2]=max(array(date("Y"),2023));
	}
	if( !isset($_SESSION["beitragsskala"]) ) {
		$_SESSION["beitragsskala"]=1;
	}
	if( !isset($_SESSION["beitragsskala_alt"]) ) {
		$_SESSION["beitragsskala_alt"]=1;
	}
	if( !isset($_SESSION["pensdatum"][1]) ) {
		$_SESSION["pensdatum"][1]=1;
	}
	if( !isset($_SESSION["pensdatum"][2]) ) {
		$_SESSION["pensdatum"][2]=date("Y")+1;
	}
	if( !isset($_SESSION["zins1"]) ) {
		$_SESSION["zins1"]=100; // in Basispunkten
	}
	if( !isset($_SESSION["zins2"]) ) {
		$_SESSION["zins2"]=200; // in Basispunkten
	}
	if( !isset($_SESSION["vsLohn"]) ) {
		$_SESSION["vsLohn"]=0; 
	}
	if( !isset($_SESSION["jLohn"]) ) {
		$_SESSION["jLohn"]=0; 
	}
	if( !isset($_SESSION["bg"]) ) {
		$_SESSION["bg"]=100;
	}
	if( !isset($_SESSION["AGH"]) ) {
		$_SESSION["AGH"]=0;		// in CHF
	}
	if( !isset($_SESSION["AGH_BVG"]) ) {
		$_SESSION["AGH_BVG"]=0;		// in CHF
	}
	if( !isset($_SESSION["lohnErh"]) ) {
		$_SESSION["lohnErh"]=0;				// in Basispunkten
	}

?>
