<?php
	//phpinfo();

	ini_set('session.cache_limiter', 'private');
	session_start();
	
	include("includes/functions.php");
	include("includes/data.php");
	include("includes/language.php");

	include("includes/Mobile_Detect.php");
	$detect = new Mobile_Detect();
	$isMobile = $detect -> isMobile();
	$isMobile = false; // kann auch von mobilen Geräten besucht werden
	
	if(!isset($_POST["page"])) {
		session_unset();
		include("berechnungen/start_Berechnung.php");
		
		if ($isMobile) {
     
		} else { 
			include ("main/eingabenVersicherter.php");
		}
	}

	else if($_POST["page"]=="eingabe") {
		if ($isMobile) {
     
		} else { 
			include ("main/eingabenVersicherter.php");
		}
	}

	
	else if($_POST["page"]=="altersleistung") {
		include("berechnungen/Basic_Berechnung.php");
		$basic = new Basic_Berechnung();
		
		if($basic -> istInputGueltig()) {
			if ($isMobile) {

			} else {
				include ("main/header.php");
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$basic -> setDefaultsWeitereBerechnungen();
				$altersleistung = $basic;
				include ("main/eingabeWeitereBerechnungen.php");
				include ("main/footer.php");
			}
		} else {
			if ($isMobile) {

			} else {
				include ("main/eingabenVersicherter.php");
			}
		}
	}
	
	
	else if($_POST["page"]=="ur") {
		include("berechnungen/Basic_Berechnung.php");	
		include("berechnungen/UR_Berechnung.php");
		$basic = new Basic_Berechnung();
		$basic -> berechneAltersleistung();
		$ur = new UR_Berechnung();
		
		if($ur -> istInputGueltig($basic, $basic)) {
			if ($isMobile) {
    
			} else { 
				include ("main/header.php");
				include ("main/ausgabeBasic.php");
				$altersleistung = $basic;
				$ur -> berechneUR($basic, $basic);
				include ("main/ausgabeUR.php");
				include ("main/footer.php");
			}
		} else {
			if ($isMobile) {
    
			} else { 
				$_POST["page"]="altersleistung";
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/header.php");
				include ("main/ausgabeBasic.php");
				$altersleistung = $basic;
				include ("main/eingabeWeitereBerechnungen.php");
				include ("main/footer.php");
			}
		}
	}
	
	
	else if($_POST["page"]=="einkauf") {
		include("berechnungen/Basic_Berechnung.php");	
		include("berechnungen/Einkauf_Berechnung.php");
		$einlage = new Einkauf_Berechnung();
		if($einlage -> istInputGueltig()) {
			if ($isMobile) {

			} else {
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$einlage -> berechneAltersleistung($basic);
				$altersleistung = $einlage;
				include ("main/ausgabeEinkauf.php");
				include ("main/eingabeUR.php");
				include ("main/footer.php");
			}
		} else {
			if ($isMobile) {
  
			} else { 
				$_POST["page"]="altersleistung";
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$altersleistung = $basic;
				include ("main/eingabeWeitereBerechnungen.php");
				include ("main/footer.php");
			}
		}
	}
	
	
	else if($_POST["page"]=="vorbezug") {
		include("berechnungen/Basic_Berechnung.php");
		include("berechnungen/Vorbezug_Berechnung.php");
		$vorbezug = new Vorbezug_Berechnung();
		if($vorbezug -> istInputGueltig()) {
			if ($isMobile) {

			} else {
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$vorbezug -> berechneAltersleistung($basic);
				$altersleistung = $vorbezug;
				include ("main/ausgabeVorbezug.php");
				include ("main/eingabeUR.php");
				include ("main/footer.php");
			}
		} else { 
			if ($isMobile) {
  
			} else { 
				$_POST["page"]="altersleistung";
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$altersleistung = $basic;
				include ("main/eingabeWeitereBerechnungen.php");
				include ("main/footer.php");
			}
		}
	}

	
	else if($_POST["page"]=="ureinkauf") {
		include("berechnungen/Basic_Berechnung.php");
		include("berechnungen/Einkauf_Berechnung.php");
		include("berechnungen/UR_Berechnung.php");
		$basic = new Basic_Berechnung();
		$basic -> berechneAltersleistung();
		// ACHTUNG: Die Variable $einkauf wird bereits für die Einkaufstabelle verwendet!
		$einlage = new Einkauf_Berechnung();
		$einlage -> berechneAltersleistung($basic);
		$ur = new UR_Berechnung();
		if($ur -> istInputGueltig($einlage, $basic)) {
			if ($isMobile) {
    
			} else { 
				include ("main/header.php");
				include ("main/ausgabeBasic.php");
				include ("main/ausgabeEinkauf.php");
				$altersleistung = $einlage;
				$ur -> berechneUR($altersleistung, $basic);
				include ("main/ausgabeUR.php");
				include ("main/footer.php");
			}
		} else {
			if ($isMobile) {
   
			} else { 
				$_POST["page"]="einkauf";
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$altersleistung = $einlage;
				include ("main/ausgabeEinkauf.php");
				include ("main/eingabeUR.php");
				include ("main/footer.php");
			}
		}
	}
	
	
	else if($_POST["page"]=="urvorbezug") {
		include("berechnungen/Basic_Berechnung.php");
		include("berechnungen/Vorbezug_Berechnung.php");
		include("berechnungen/UR_Berechnung.php");
		$basic = new Basic_Berechnung();
		$basic -> berechneAltersleistung();
		$vorbezug = new Vorbezug_Berechnung();
		$vorbezug -> berechneAltersleistung($basic);
		$ur = new UR_Berechnung();
		
		if($ur -> istInputGueltig($vorbezug, $basic)) {
			if ($isMobile) {
				
			} else { 
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				include ("main/ausgabeVorbezug.php");
				$altersleistung = $vorbezug;
				$ur -> berechneUR($altersleistung, $basic);
				include ("main/ausgabeUR.php");
				include ("main/footer.php");
			}
		} else {
			if ($isMobile) {
     
			} else { 
				$_POST["page"]="vorbezug";
				include ("main/header.php");
				$basic = new Basic_Berechnung();
				$basic -> berechneAltersleistung();
				include ("main/ausgabeBasic.php");
				$altersleistung = $vorbezug;
				include ("main/ausgabeVorbezug.php");
				include ("main/eingabeUR.php");
				include ("main/footer.php");
			}
		}
	}
	
	else {
		session_unset();
		include("berechnungen/start_Berechnung.php");
		
		if ($isMobile) {
     
		} else { 
			include ("main/eingabenVersicherter.php");
		}
	}
	
?>