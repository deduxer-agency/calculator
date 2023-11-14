<?php

	function sprache() {
		if (($GLOBALS["language"]=="de")or($GLOBALS["language"]=="fr")or($GLOBALS["language"]=="en")or($GLOBALS["language"]=="it")){
			echo $GLOBALS["language"];
		} else {
			echo "error"  ;
		}
	}

	if(!isset($errors)) {
		$errors = array();
	}

	function errors( $wert ) {
		global $errors;
		if( isset($errors[$wert]) ) {
			return $errors[$wert];
		} else {
			return "";
		}
	}



	// Validierungen--Beträge---------------------------------------------------------------------------------

	function validiereVL(){
		if( isset($_SESSION["vsLohn"]) ) {
			$vl = $_SESSION["vsLohn"];
		} else {
			return(-1);
		}
		if(validiereBetrag($vl, $GLOBALS["minimumVersicherterLohn"], $GLOBALS["maximumVersicherterLohn"])!= -1)
			return($vl);
		else
			return(-1);
	}



	function validiereAGH(){
		if( isset($_POST["altersguthaben"]) ) {
			$AGH = $_POST["altersguthaben"];
		} else {
			return(-1);
		}
		if(validiereBetrag($AGH,$GLOBALS["minAgh"],$GLOBALS["maxAgh"])!= -1)
			return($AGH);
		else
			return(-1);
	}

		function validiereAGHBVG(){
		if( isset($_POST["altersguthabenBVG"]) ) {
			$AGH = $_POST["altersguthabenBVG"];
		} else {
			return(-1);
		}
		if(validiereBetrag($AGH,$GLOBALS["minAgh"],$GLOBALS["maxAgh"])!= -1)
			return($AGH);
		else
			return(-1);
	}

	function validiereBG(){
		if( isset($_POST["bg"]) ) {
			$BG = $_POST["bg"];
		} else {
			return(-1);
		}
		if(validiereBetrag($BG,0,100)!= -1)
			return($BG);
		else
			return(-1);
	}

	function validiereBetrag($betrag, $min, $max){
		if(!Is_Numeric($betrag)) {
			return(-1);
		}
		$wert = doubleval($betrag);
		if($wert <= $max && $wert >= $min) {
			return $wert;
		} else {
			return(-1);
		}
	}

	function validiereUeRgewuenscht($UeRgewuenscht, $beschaeftigungsgrad) {
		if(!(isset($UeRgewuenscht) && Is_Numeric($UeRgewuenscht) && isset($beschaeftigungsgrad) && Is_Numeric($beschaeftigungsgrad))) {
			return(-1);
		}
		
		$UeRmax = $GLOBALS["maxAHVRente"]/12 * $beschaeftigungsgrad/100;
		/*if($beschaeftigungsgrad<99.5){
		$UeRmax -=1.0;
		$UeRmax =max(0.0,$UeRmax);
		}*/

		if(validiereBetrag($UeRgewuenscht, 0, $UeRmax) != -1)
			return($UeRgewuenscht);
		else
			return(-1);
	}
	
	function validiereKapitalgewuenscht($Kapitalgewuenscht, $UWS, $gekuerzteAR) {
		if(!(isset($Kapitalgewuenscht) && Is_Numeric($Kapitalgewuenscht))) {
			return(-1);
		}
		
		$maxKapital = runden(12 * $gekuerzteAR / $UWS, 1);  
		if(validiereBetrag($Kapitalgewuenscht, 0, $maxKapital) != -1)
			return($Kapitalgewuenscht);
		else
			return(-1);
	}


	function validiereEinlage($Einlagegewuenscht){
		if(!isset($Einlagegewuenscht)) {
			return(-1);
		}
		if(!Is_Numeric($Einlagegewuenscht)) {
			return(-1);
		}
		if($Einlagegewuenscht>=0){
			return($Einlagegewuenscht);
		}
		else
			return(-1);
	}

	function validiereVorbezug($Vorbezuggewuenscht, $VorbezugMin){
		if(!isset($Vorbezuggewuenscht)) {
			return(-1);
		}
		if(!Is_Numeric($Vorbezuggewuenscht)) {
			return(-1);
		}
		if(($Vorbezuggewuenscht>=$VorbezugMin)||($Vorbezuggewuenscht==0)){
			return($Vorbezuggewuenscht);
			}
		else
			return(-1);
	}


	// Validierungen-Datum -und Datumsfunktionen----------------------------------------------------------------------


	// Gibt das Datum als array aus
	function returnGeburtsDatum(){
		if(isset($_POST["geburtstag"]) || isset($_POST["geburtsmonat"]) || isset($_POST["geburtsjahr"])) {
			$gebutsdatum[0] = $_POST["geburtstag"];
			$gebutsdatum[1] = $_POST["geburtsmonat"];
			$gebutsdatum[2] = $_POST["geburtsjahr"];
			return $gebutsdatum;
		} else {
			return $_SESSION["geburtsdatum"];
		}
	}

	function validiereGeburtsDatum(){
		// Validiert und formatiert das Geburtsdatum
		$uebergabeDatum = returnGeburtsDatum();
		if(is_numeric($uebergabeDatum[2])){
			if(checkdate($uebergabeDatum[1],$uebergabeDatum[0],$uebergabeDatum[2])) {
				return $uebergabeDatum;
			} else {
				return(-1);
			}
		} else {
			return(-1);
		}
	}
	
	function returnEintrittsDatum(){
		if(isset($_POST["eintrittsmonat"]) || isset($_POST["eintrittsjahr"])) {
			$gebutsdatum[0] = 1;
			$gebutsdatum[1] = $_POST["eintrittsmonat"];
			$gebutsdatum[2] = $_POST["eintrittsjahr"];
			return $gebutsdatum;
		} else {
			return $_SESSION["eintrittsdatum"];
		}
	}

	function validiereEintrittsDatum(){
		// Validiert und formatiert das Eintrittsdatum
		$uebergabeDatum = returnEintrittsDatum();
		if(is_numeric($uebergabeDatum[2])){
			if(checkdate($uebergabeDatum[1],$uebergabeDatum[0],$uebergabeDatum[2])) {
				return $uebergabeDatum;
			} else {
				return(-1);
			}
		} else {
			return(-1);
		}
	}

	// Gibt das Datum als array aus. Tag muss später berechnet werden, hier vorerst 31!!
	function returnStichDatum(){
		if(isset($_POST["stichmonat"]) || isset($_POST["stichjahr"])) {
			$stichdatum[0] = 1;
			$stichdatum[1] = $_POST["stichmonat"];
			$stichdatum[2] = $_POST["stichjahr"];
			return $stichdatum;
		} else {
			return $_SESSION["stichdatum"];
		}
	}

	function validiereStichDatum(){
		// Validiert und formatiert das Stichdatum. Muss nach 2013 sein
		$uebergabeDatum = returnStichDatum();
		if(!is_numeric($uebergabeDatum[2])){
			return(-1);
		}
			if(!is_numeric($uebergabeDatum[1])){
			return(-1);
		}
		if($uebergabeDatum[2]< $GLOBALS["fruehestesStichdatum"]) {
			return (-1);
		}
		if(checkdate($uebergabeDatum[1],$uebergabeDatum[0],$uebergabeDatum[2])) {
			return $uebergabeDatum;
		} else {
			return (-1);
		}
	} // end function validiereStichDatum

	function DateDiff($interval, $frueheresDatum, $spaeteresDatum){
	/* -Gibt die Differenz zweier Daten zurück,
	 * -ein Datum ist als Array einzugeben:( [0] = Tag, [1] = Monat, [2] = Jahr)
	 * -$interval = "m": Differenz wird in Monaten ausgegeben
	 * -$interval = "y": Differenz wird in Jahren ausgegeben
	 * -Bei der Differenz in Jahren werden einfach die Jahre subtrahiert.
	 *
	 * Tage werden nicht berücksichtigt???  Testen!! Vergleiche DateDiff unter w3schools!!!
	*/
		if ($interval == "m"){
			return $spaeteresDatum[2] * 12 + $spaeteresDatum[1]
				- ($frueheresDatum[2] * 12 + $frueheresDatum[1]);
		} elseif ($interval == "y") {
			return $spaeteresDatum[2] - $frueheresDatum[2];
		} else {
			return false;
		}
	}

	// Gibt das Datum als array aus
	function returnPensionierungsDatum(){
		if(isset($_POST["pensionierungsmonat"]) || isset($_POST["pensionierungsjahr"])) {
			$pensdatum[0] = 31;
			$pensdatum[1] = $_POST["pensionierungsmonat"];
			$pensdatum[2] = $_POST["pensionierungsjahr"];
			return $pensdatum;
		} else {
			return $_SESSION["pensdatum"];
		}
	}

	// Gibt das Datum als array aus
	function returnEinlageDatum(){
		$einlagedatum[0] = $_POST["einlagetag"];
		$einlagedatum[1] = $_POST["einlagemonat"];
		$einlagedatum[2] = $_POST["einlagejahr"];
		return $einlagedatum;
	}

	// Gibt das Datum Ende Monat als array aus
	function returnDatum($monat,$jahr){
		$datum[0] = 31;
		$datum[1] = $monat;
		$datum[2] = $jahr;
		if ($datum[1] == 0){
			$datum[1] = 12;
			$datum[2] = $datum[2]-1;
		}
		// Suche, welcher Tag richtig ist. Vorgabe nur "Ende Monat"
		$uebergabeDatum[0]=31;
		for($datum[0]=31; $datum[0]>27;$datum[0]--){
			if(checkdate($datum[1],$datum[0],$datum[2])) {
				break;
			}
		}
		if(checkdate($datum[1],$datum[0],$datum[2])){
			return $datum;
		} else {
			return (-1);
		}
	}

	function validierePensionierungsDatum(){
		// Validiert und formatiert das Pensionierungsdatum
		$uebergabeDatum = returnPensionierungsDatum();
		if (!is_numeric($uebergabeDatum[2])){
			return (-1);
		}
		$uebergabeDatum = returnDatum($uebergabeDatum[1],$uebergabeDatum[2]);   // Bestimme Datum Ende Monat
		if(!checkdate($uebergabeDatum[1],$uebergabeDatum[0],$uebergabeDatum[2])){
			return(-1);
		}
		return($uebergabeDatum);
	}

	
	// Validiert ein Datum
	function validiereEinlageDatum($uebergabeDatum){
		
		if(is_numeric($uebergabeDatum[2])){
			if(checkdate($uebergabeDatum[1],$uebergabeDatum[0],$uebergabeDatum[2])) {
				return $uebergabeDatum;
			} else {
				return(-1);
			}
		} else {
			return(-1);
		}
	}


	// Gibt Alter als Array in Jahren und Monaten im Pensdatum aus
	function alter($geburtsdatum, $pensdatum){
		$alterinmonaten = DateDiff("m",$geburtsdatum,$pensdatum);
		if ($alterinmonaten < 0) {
			return(-1);
		}
		$alter["jahr"]= intval($alterinmonaten / 12 );
		$alter["monat"]= $alterinmonaten - $alter["jahr"]* 12;
			 return $alter;
	}


	// Funktionen zur Rundung und Darstellung

	function runden($betrag, $einheit){
		$wert = $betrag;
		if (($einheit == 0)){
			return($wert);
		}
		return doubleval(round($wert/ $einheit,0)*$einheit);
	}

	function aufrunden($betrag){
		$wert = $betrag;
		if (($wert - intval($wert))< 0.01){
			$wert = intval($wert)+0.;
		}
		else {
			$wert = intval($wert)+1;
		}

		return($wert);
	}

	function ausgabe_CHF($betrag){
		$wert=$betrag;
		if($wert >= 0){
			$wert=number_format($wert,0,".","'");
			echo "CHF ";
			echo $wert;
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_CHF_pos($betrag){
		$wert=$betrag;
		if($wert > 0){
			$wert=number_format($wert,0,".","'");
			echo "CHF ";
			echo $wert;
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Ganzzahlig($betrag){
		$wert=$betrag;
		if($wert >= 0){
			$wert=number_format($wert,0,".","'");
			echo $wert;
			echo ".-";
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Ganzzahlig_pos($betrag){
		$wert=$betrag;
		if($wert > 0){
			$wert=number_format($wert,0,".","'");
			echo $wert;
			echo ".-";
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Stellen($betrag, $stellen){
		$wert=$betrag;
		if($wert >= 0 ){
			$wert=number_format($wert,$stellen,".","'");
			echo $wert;
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Stellen_pos($betrag,$stellen){
		$wert=$betrag;
		if($wert > 0 ){
			$wert=number_format($wert,$stellen,".","'");
			echo $wert;
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Prozent($betrag,$stellen){
		$wert=$betrag;
		if($wert >= 0 ){
			$wert=number_format($wert,$stellen,".","'");
			echo $wert;
			echo ("%");
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Prozent_pos($betrag,$stellen){
		$wert=$betrag;
		if($wert > 0 ){
			$wert=number_format($wert,$stellen,".","'");
			echo $wert;
			echo ("%");
		}
		else {
			if ($wert == -1){
				$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			} else {
				$wert=$GLOBALS["languageDB"]["lfehlerkeinAgh"];
			}
			echo $wert;
		}
	}

	function ausgabe_Datum($datum){
		echo $datum[0];
		echo (". ");
		echo $datum[1];
		echo (". ");
		echo $datum[2];
	}

	function ausgabe_Alter_Worte($alter){
		if ($alter != -1) {
			echo $alter['jahr'];
			echo " ";
			echo $GLOBALS["languageDB"]["lijahre"];
			echo " ";
			echo $alter["monat"];
			echo " ";
			echo $GLOBALS["languageDB"]["lmonate"];
		}
		else {
			$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			echo $wert;
		}
	}

	function ausgabe_Alter_Zeichen($alter) {
		if ($alter != -1) {
			echo $alter["jahr"];
			echo (" / ");
			echo $alter["monat"];
		}
		else {
			$wert=$GLOBALS["languageDB"]["lfehlerausrechnung"];
			echo $wert;
		}
	}

	
	// Berechnungen Beiträge

	function beitraege($bvgalter, $vsLohn, $skala){
		if (($bvgalter != -1) && ($vsLohn !=-1) && ($skala != -1)){
			$beitrag["prozent"] = $skala["$bvgalter"]*100;
			$beitrag["jahr"] = $vsLohn * $skala["$bvgalter"];
			$beitrag["monat"] = $beitrag["jahr"]/12;
			if ($bvgalter==$GLOBALS["maxBeitragsalterSpar"]) {
				$beitrag["jahr"] = $beitrag["monat"]*$_POST["geburtsmonat"];
			}
			return $beitrag;
		}
		return(-1);
	}

	function altersgutschriften($spar_AN, $spar_AG){
        $AGS = array();
		for ($alter=$GLOBALS["minimumAlter"]; $alter<=$GLOBALS["maximumAlter"]; $alter++){
			$AGS["$alter"]=$spar_AN["$alter"]+$spar_AG["$alter"];
		}
		return $AGS;
	}

	
	// Berechnungen maximaler Einkauf

	function maximalerEinkauf($geburtsdatum, $datum, $vsLohn, $sparbs_ag, $einkaufsskala){
		$alter_in_Monaten = DateDiff("m", $geburtsdatum, $datum);
		if ($datum[0] == 1) {   // Korrekturfaktor, wenn $datum am Monatsbeginn
			$alter_in_Monaten--;
		}

		$einkauf = $einkaufsskala[intval($alter_in_Monaten/12)];
		
		$monate = $alter_in_Monaten - intval($alter_in_Monaten/12)*12;

		if ($monate > 0) {
			$einkauf += $monate/12 * ($einkaufsskala[intval($alter_in_Monaten/12)+1] - $einkaufsskala[intval($alter_in_Monaten/12)]);
		}
		$einkauf = runden($vsLohn * $einkauf/100, 0.05);
		return $einkauf;
	}

	
	// Lohnentwicklung
	
	function entwicklung_Lohn($geburtsdatum, $stichdatum, $versLohn, $lohnErh, $rundung){
		for ($alter=0; $alter<=70; $alter++){
			$entw_Lohn["$alter"]=0;
		}
		$maxLohn = $GLOBALS["maximumVersicherterLohn"]; //Beschränkung des vers. Lohnes

		$alter = $stichdatum[2]-$geburtsdatum[2];
		$entw_Lohn["$alter"] = $versLohn;

		$alter = $alter + 1;

		for ($alter; $alter<=70; $alter++){
			$entw_Lohn["$alter"] = $entw_Lohn["$alter"-1] * (1+$lohnErh);
			
			// Beschränkung vers. Lohn auch nach Lohnerhöhung
			if ($entw_Lohn["$alter"] > $maxLohn){
				$entw_Lohn["$alter"]=$maxLohn;
			}
		}

		return ($entw_Lohn);
	}

    function entwicklung_LohnBVG($geburtsdatum, $stichdatum, $versLohn, $lohnErh, $rundung){ //Achtung nicht der AHV-Lohn wird Entwickelt!
		$vsLohnPK = entwicklung_Lohn($geburtsdatum, $stichdatum, $versLohn, $lohnErh, $rundung);
		for ($alter=0; $alter<=70; $alter++){
			$entw_Lohn["$alter"]=0;
		}
		$maxLohn = $GLOBALS["maxAHVRente"]*17/8; //Beschränkung des Koord. Lohnes

		$alter = $stichdatum[2]-$geburtsdatum[2];
		$entw_Lohn["$alter"] = Max($GLOBALS["maxAHVRente"]/8, $vsLohnPK["$alter"]+$GLOBALS["KoordAbzugPK"]-7/8*$GLOBALS["maxAHVRente"]);
		if ($entw_Lohn["$alter"] > $maxLohn){
			$entw_Lohn["$alter"]=$maxLohn;
		}
		$alter = $alter + 1;

		for ($alter; $alter<=70; $alter++){
			$entw_Lohn["$alter"] = Max($GLOBALS["maxAHVRente"]/8, $vsLohnPK["$alter"]+$GLOBALS["KoordAbzugPK"]-7/8*$GLOBALS["maxAHVRente"]);
			
			// Beschränkung vers. Lohn auch nach Lohnerhöhung
			if ($entw_Lohn["$alter"] > $maxLohn){
				$entw_Lohn["$alter"]=$maxLohn;
			}
		}

		return ($entw_Lohn);
	}


	function entwicklung_AHVRente($geburtsdatum, $stichdatum, $lohnErh, $rundung){
		for ($alter=0; $alter<=70; $alter++){
			$entw_AHVRente["$alter"]=0;
		}

		$alter = $stichdatum[2]-$geburtsdatum[2];
		$entw_AHVRente["$alter"]=$GLOBALS["maxAHVRente"];
		$alter = $alter + 1;

		for ($alter;$alter<=70;$alter++){
			$entw_AHVRente["$alter"]=$entw_AHVRente["$alter"-1]*(1+$GLOBALS["entwicklungGrenzwerte"]*$lohnErh);
		}

		return ($entw_AHVRente);
	}

	
	// Verzinsung Einlage

	function verzinsungEinlage($Einlage, $einlagedatum, $pensdatum, $zins1, $zins2){
		// Die Verzinsung einer Einlage ist dasselbe wie eine AGH Projektion ohne Altersgutschriften!
		if(dateDiff("m", $einlagedatum, $pensdatum) >= 0) {
			$versLohn = array_fill(0, $GLOBALS["maximumAlter"], 0);
			$BS_alt = array_fill(0, $GLOBALS["maximumAlter"], 0);
			$BS = array_fill(0, $GLOBALS["maximumAlter"], 0);
			
			// Einlage/Vorbezug erfolgt per Ende Monat, Stichtag ist somit der 1. Tag des Folgemonats
			if($einlagedatum[1] == 12) {
				$einlagedatum[1] = 1;
				$einlagedatum[2] = $einlagedatum[2] + 1;
			} else {
				$einlagedatum[1] = $einlagedatum[1] + 1;
			}
			
			return projektion_BVG($einlagedatum, $einlagedatum, $pensdatum, $Einlage, $versLohn, $BS_alt, $BS, $zins1, $zins2, $GLOBALS["rundung"]);
			
		} else {
			return 0;
		}
	}


	// Berechnungen Altersguthaben

	function projektion_AGH($geburtsdatum, $stichdatum, $pensdatum, $AGH, $versLohn, $BS_alt, $BS, $zins1, $zins2, $rundung){
		$projAgh = $AGH;
		$dauer_projektion_inMonaten = dateDiff("m", $stichdatum, $pensdatum)+1;
			
		if ($dauer_projektion_inMonaten > 0 ) {
			if ($stichdatum[2] == $pensdatum[2]){
				$dauer_projektion_erstesJahr = $dauer_projektion_inMonaten;
			} else {
				$dauer_projektion_erstesJahr = 13-$stichdatum[1];
			}
			$dauer_projektion_ganzeJahre = intval(($dauer_projektion_inMonaten-$dauer_projektion_erstesJahr)/12);
			$dauer_projektion_letztesJahr = $dauer_projektion_inMonaten - $dauer_projektion_erstesJahr - 12*$dauer_projektion_ganzeJahre;

			$BVG_Alter = intval(DateDiff("y", $geburtsdatum, $stichdatum));
			
			// Projektion im ersten Jahr

			$projAgh = $AGH;
            $projAgh = runden($projAgh*(1+$dauer_projektion_erstesJahr/12 * $zins1/100), $rundung);  // Verzinsung
			$projAgh+= $dauer_projektion_erstesJahr/12 * runden($BS_alt[$BVG_Alter]*$versLohn[$BVG_Alter], $rundung*12);  // Gutschrift der Beiträge


			// Projektion ganze Jahre
			if ($dauer_projektion_ganzeJahre > 0 ) {
				for ($i=1; $i<=$dauer_projektion_ganzeJahre; $i++) {
					

                    $AGH = $projAgh;
				   
					$projAgh = runden($projAgh*(1+$zins2/100), $rundung);  // Verzinsung
					$projAgh +=runden($BS[$BVG_Alter+$i] * $versLohn[$BVG_Alter+$i], $rundung*12);  // Gutschrift der Beiträge
					
					
				};
			}

			// Projektion letztes Jahr
			if ($dauer_projektion_letztesJahr > 0 ) {
				

				$projAgh = runden($projAgh * (1 + $dauer_projektion_letztesJahr/12 * $zins2/100), $rundung);  // Verzinsung
				$projAgh+= $dauer_projektion_letztesJahr/12 * runden($BS[$BVG_Alter+$dauer_projektion_ganzeJahre+1] * $versLohn[$BVG_Alter+$dauer_projektion_ganzeJahre+1], $rundung*12);  // Gutschrift der Beiträge
				
			}
			
		} elseif ($dauer_projektion_inMonaten == 0){
			// Pensionierung genau beim Stichdatum
			
		} else {
			$projAgh = -2;   //da Pensdatum überschritten wird "---" ausgegeben
		}
		return $projAgh;
	}

	function projektion_BVG($geburtsdatum, $stichdatum, $pensdatum, $AGH, $versLohn, $BS_alt, $BS, $zins1, $zins2, $rundung){
		$projAgh = $AGH;
		$dauer_projektion_inMonaten = dateDiff("m", $stichdatum, $pensdatum)+1;
			
		if ($dauer_projektion_inMonaten > 0 ) {
			if ($stichdatum[2] == $pensdatum[2]){
				$dauer_projektion_erstesJahr = $dauer_projektion_inMonaten;
			} else {
				$dauer_projektion_erstesJahr = 13-$stichdatum[1];
			}
			$dauer_projektion_ganzeJahre = intval(($dauer_projektion_inMonaten-$dauer_projektion_erstesJahr)/12);
			$dauer_projektion_letztesJahr = $dauer_projektion_inMonaten - $dauer_projektion_erstesJahr - 12*$dauer_projektion_ganzeJahre;

			$BVG_Alter = intval(DateDiff("y", $geburtsdatum, $stichdatum));
			
			// Projektion im ersten Jahr
			$projAgh = runden($projAgh*(1+$dauer_projektion_erstesJahr/12 * $zins1/100), $rundung);  // Verzinsung
			$projAgh+= $dauer_projektion_erstesJahr/12 * runden($BS_alt[$BVG_Alter]*$versLohn[$BVG_Alter], $rundung*12);  // Gutschrift der Beiträge

			// Projektion ganze Jahre
			if ($dauer_projektion_ganzeJahre > 0 ) {
				for ($i=1; $i<=$dauer_projektion_ganzeJahre; $i++) {

					$projAgh = runden($projAgh*(1+$zins2/100), $rundung);  // Verzinsung
					$projAgh +=runden($BS[$BVG_Alter+$i] * $versLohn[$BVG_Alter+$i], $rundung*12);  // Gutschrift der Beiträge
					
				};
			}

			// Projektion letztes Jahr
			if ($dauer_projektion_letztesJahr > 0 ) {

				$projAgh = runden($projAgh * (1 + $dauer_projektion_letztesJahr/12 * $zins2/100), $rundung);  // Verzinsung
				$projAgh+= $dauer_projektion_letztesJahr/12 * runden($BS[$BVG_Alter+$dauer_projektion_ganzeJahre+1] * $versLohn[$BVG_Alter+$dauer_projektion_ganzeJahre+1], $rundung*12);  // Gutschrift der Beiträge
			}
			
		} elseif ($dauer_projektion_inMonaten == 0){
			// Pensionierung genau beim Stichdatum
			
		} else {
			$projAgh = -2;   //da Pensdatum überschritten wird "---" ausgegeben
		}
		return $projAgh;
	}
	// Berechnungen Rente

	function Altersrente($geburtsdatum, $pensdatum, $projAgh, $sex){
		$AR = 0;
		$uws = 0;
		if($projAgh >= 0){
			$uws = Umwandlungssatz($geburtsdatum, $pensdatum, $sex);
			$AR = $projAgh * $uws/12;
		}
		else{
			$AR = $projAgh;
		}
		return $AR;	
	}
	
	function GekuerzteAltersrente($UeRgewuenscht, $beitragsjahre, $vorbezugsdauer, $AGH, $UWS) {
		$kuerzungAR = getKuerzungAR($UeRgewuenscht, $beitragsjahre, $vorbezugsdauer, $UWS);
		$maxAR = ($AGH * $UWS) / 12 - $kuerzungAR;
		return $maxAR;
	}
	
	function getKuerzungAR($UeRgewuenscht, $beitragsjahre, $vorbezugsdauer, $UWS) {
		return $UeRgewuenscht * $vorbezugsdauer * (1-0.04*$beitragsjahre)*$UWS;//$UeRgewuenscht * (((20-$beitragsjahre) * 0.2 * $vorbezugsdauer) + $vorbezugsdauer)/100;
	}


	// Bestimmen des Umwandlungssatzes

	function Umwandlungssatz($geburtsdatum, $pensdatum, $sex){
		$umwandlungssatz = 0;
		$Alter_in_Monaten = DateDiff("m", $geburtsdatum, $pensdatum);
		if (($_SESSION["eintrittsdatum"][2] >= 2018)) {
			// Kein Übergangsfrist
			$uws=$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][$GLOBALS["Anzahl_UWS_Stufen"]]][$sex];
        } else if ($pensdatum[2] > $GLOBALS["jahr_UWS"][$GLOBALS["Anzahl_UWS_Stufen"]]) {  
			// Pensionierung nach vollständiger UWS-Reduktion: UWS im letzten Jahr
			$uws=$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][$GLOBALS["Anzahl_UWS_Stufen"]]][$sex];
		} else {
			if ($pensdatum[2] <= $GLOBALS["jahr_UWS"][1]) {
				// Pensionierung vor Beginn der UWS-Reduktion: UWS im ersten Jahr
				$uws=$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][1]][$sex];
			}
			else {
				// Pensionierung während der UWS-Reduktion: UWS im betreffenden Jahr, in Abh. vom Monat der UWS Reduktion
				if ($pensdatum[1]>=$GLOBALS["Monat_Wechsel_UWS"]){
					$uws=$GLOBALS["UWS_stufe"][$pensdatum[2]][$sex];
				}
				else {
					$uws=$GLOBALS["UWS_stufe"][$pensdatum[2]-1][$sex];
				}
			}
		}
		
		$umwandlungssatz = $uws[intval($Alter_in_Monaten/12)];
		$monate = $Alter_in_Monaten - intval($Alter_in_Monaten/12)*12;

		if ($monate > 0) {
			$umwandlungssatz += $monate / 12 *($uws[intval($Alter_in_Monaten/12)+1]-$uws[intval($Alter_in_Monaten/12)]);
		}
		
		$umwandlungssatz = runden($umwandlungssatz, 0.000001);
		
		if ((DateDiff("m",validiereStichDatum() , $pensdatum)+1)<0) {
			$umwandlungssatz = -2;
		}
		
		return $umwandlungssatz;
	}

	
	function Faktor_Ueberbrueckungsrente($bezugsdauer){
		$ganzeJahre=intval($bezugsdauer);
		$v=1/1.025;
		$wert1=(1-pow($v,$ganzeJahre))/(1-$v)-11/24*(1-pow($v,$ganzeJahre));
		$wert2=(1-pow($v,$ganzeJahre+1))/(1-$v)-11/24*(1-pow($v,$ganzeJahre+1));
		//$faktor=$GLOBALS["faktor_UR"][$ganzeJahre] + ($bezugsdauer - $ganzeJahre)*($GLOBALS["faktor_UR"][$ganzeJahre+1]-$GLOBALS["faktor_UR"][$ganzeJahre]);
		$faktor=$wert1 + ($bezugsdauer - $ganzeJahre)*($wert2-$wert1); // in der aktuellen Tabelle von Syngenta wird ausgehend von den exakten Werten interpoliert
		$faktor=runden($faktor,0.001);
		return $faktor;
	}
	function ArraySort($tArray) {
		$aOriginal = $tArray;
		if (count($aOriginal) == 0) { return $aOriginal; }
		$aModified = array();
		$aReturn   = array();
		$aSearch   = array("Ä","ä","Ö","ö","Ü","ü","ß","-");
		$aReplace  = array("Ae","ae","Oe","oe","Ue","ue","ss"," ");
		foreach($aOriginal as $key => $val) {
			$aModified[$key] = str_replace($aSearch, $aReplace, $val);
		}
		natcasesort($aModified);
		foreach($aModified as $key => $val) {
			$aReturn[$key] = $aOriginal[$key];
		}
		return $aReturn;
}
