<?php

class Basic_Berechnung {
	
	var $fehler = false;
	var $fehler_vsLohn = false;
	var $fehler_agh = false;
	var $fehler_aghbvg = false;
	var $fehler_kgh = false;
	var $fehler_datum = false;
	var $fehler_datum1 = false;
	var $fehler_datum2 = false;
	var $fehler_datum3 = false;
	var $fehler_stichdatum = false;
	
	public function istInputGueltig() {

		//prüfen, ob numerische Werte eingegeben wurden
		if (isset($_POST["geburtstag"]) && !is_numeric($_POST["geburtstag"])){
			$_POST["geburtstag"]="error";
		}
		if (isset($_POST["geburtsmonat"]) && !is_numeric($_POST["geburtsmonat"])){
			$_POST["geburtsmonat"]="error";
		}
		if (isset($_POST["geburtsjahr"]) && !is_numeric($_POST["geburtsjahr"])){
			$_POST["geburtsjahr"]="error";
		}
		if (isset($_POST["stichmonat"]) && !is_numeric($_POST["stichmonat"])){
			$_POST["stichmonat"]="error";
		}
		if (isset($_POST["stichjahr"]) && !is_numeric($_POST["stichjahr"])){
			$_POST["stichjahr"]="error";
		}
		if (isset($_POST["pensionierungsmonat"]) && !is_numeric($_POST["pensionierungsmonat"])){
			$_POST["pensionierungsmonat"]="error";
		}
		if (isset($_POST["pensionierungsjahr"]) && !is_numeric($_POST["pensionierungsjahr"])){
			$_POST["pensionierungsjahr"]="error";
		}
		if (isset($_POST["jahresLohn"]) && !is_numeric($_POST["jahresLohn"])){
			$_POST["jahresLohn"]="error";
		}
		if (isset($_POST["bg"]) && (!is_numeric($_POST["bg"]) || ($_POST["bg"] < 1 || $_POST["bg"]>100))){
			$_POST["bg"]="error";
		}
		if (isset($_POST["altersguthaben"]) && !is_numeric($_POST["altersguthaben"])){
			$_POST["altersguthaben"]="error";
		}
		if (isset($_POST["altersguthabenBVG"]) && !is_numeric($_POST["altersguthabenBVG"])){
			$_POST["altersguthabenBVG"]="error";
		}
		if (isset($_POST["zins1"]) && !is_numeric($_POST["zins1"])){
			$_POST["zins1"]="error";
		}
		if (isset($_POST["zins2"]) && !is_numeric($_POST["zins2"])){
			$_POST["zins2"]="error";
		}
		if (isset($_POST["lohnErh"]) && !is_numeric($_POST["lohnErh"])){
			$_POST["lohnErh"]="error";
		}
		if (isset($_POST["sex"]) && !(($_POST["sex"]=="Mann") or $_POST["sex"]==("Frau"))){
			$_POST["sex"]="error";
		}

		
		global $errors;

		if(isset($_POST["sex"])) {
			$_SESSION["sex"] = $_POST["sex"];
		}
		
		// prüfen, ob Eingaben möglich sind
		if(isset($_POST["jahresLohn"]) && isset($_POST["bg"])) {
            $_SESSION["bg"]=$_POST["bg"];
            $_SESSION["jLohn"]=$_POST["jahresLohn"];
			$_SESSION["vsLohn"]=$_SESSION["jLohn"]-($GLOBALS["KoordAbzugPK"]*($_SESSION["bg"]/100));
			if(validiereVL()==-1) {
				$errors["versicherterlohn"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_vsLohn = true;
			}
		}

		if(isset($_POST["altersguthaben"])) {
			$_SESSION["AGH"]=$_POST["altersguthaben"];
			if(validiereAGH()==-1) {
				$errors["altersguthaben"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_agh = true;
			}
		}
        if(isset($_POST["altersguthabenBVG"])) {
			$_SESSION["AGH_BVG"]=$_POST["altersguthabenBVG"];
			if(validiereAGHBVG()==-1) {
				$errors["altersguthabenBVG"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_aghbvg = true;
			}
		}
		
		$_SESSION["geburtsdatum"]=returnGeburtsDatum();
		if(validiereGeburtsDatum() ==-1) {
			$errors["geburtsjahr"]="class='markiertFehler'";
			$errors["geburtstag"]="class='markiertFehler'";
			$errors["geburtsmonat"]="class='markiertFehler'";
			$this->fehler = true;
			$this->fehler_datum = true;
		}
		
		$_SESSION["eintrittsdatum"]=returnEintrittsDatum();
		if(validiereEintrittsDatum() ==-1) {
			$errors["eintrittsjahr"]="class='markiertFehler'";
			$errors["eintrittsmonat"]="class='markiertFehler'";
			$this->fehler = true;
			$this->fehler_eintrittsdatum = true;
		}
		
		$_SESSION["stichdatum"]=returnStichdatum();
		if(validiereStichdatum() ==-1) {
			$errors["stichjahr"]="class='markiertFehler'";
			$this->fehler = true;
			$this->fehler_stichdatum = true;
		}

		$_SESSION["pensdatum"]=validierePensionierungsDatum();
		if(validierePensionierungsdatum() ==-1) {
			$errors["pensionierungsjahr"]="class='markiertFehler'";
			$this->fehler = true;
			$this->fehler_datum = true;
		}
		
		// Geburtsdatum nach Stichdatum
		if ((validiereGeburtsDatum() !=-1) && (validiereStichdatum() != -1)) {
			$alter_stichdatum =(DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["stichdatum"])-1)/12;
			if (($alter_stichdatum < $GLOBALS["minimumAlter"]) || ($alter_stichdatum > $GLOBALS["maximumAlter"])) {
				$errors["geburtsjahr"]="class='markiertFehler'";
				$errors["geburtstag"]="class='markiertFehler'";
				$errors["geburtsmonat"]="class='markiertFehler'";
				$errors["stichjahr"]="class='markiertFehler'";
				$errors["stichmonat"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_datum1 = true;
			}
		}
		
		// Eintrittsdatum vor Stichdatum
		if ((validiereEintrittsDatum() !=-1) && (validiereStichdatum() != -1)) {
			$diff_datum = DateDiff("m", $_SESSION["eintrittsdatum"], $_SESSION["stichdatum"])/12;
			if ($diff_datum < 0) {
				$errors["eintrittsjahr"]="class='markiertFehler'";
				$errors["eintrittsmonat"]="class='markiertFehler'";
				$errors["stichjahr"]="class='markiertFehler'";
				$errors["stichmonat"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_eintrittsdatum1 = true;
			}
		}
		
		// Eintrittsdatum im korrekten Alter
		if ((validiereEintrittsDatum() != -1) && (validiereGeburtsDatum() != -1)) {
			$alter_eintrittsdatum =(DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["eintrittsdatum"])) / 12;
			if ($alter_eintrittsdatum < $GLOBALS["minimumAlter"] || $alter_eintrittsdatum > $GLOBALS["maximumAlter"]) {
				$errors["geburtsjahr"]="class='markiertFehler'";
				$errors["geburtstag"]="class='markiertFehler'";
				$errors["geburtsmonat"]="class='markiertFehler'";
				$errors["eintrittsjahr"]="class='markiertFehler'";
				$errors["eintrittsmonat"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_eintrittsdatum2 = true;
			}
		}
		
		// Pensionierungsdatum im korrekten Alter
		if ((validiereGeburtsDatum() !=-1) && (validierePensionierungsdatum() != -1)) {
			$alter_pensdatum =(DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["pensdatum"]))/12;
			if ($alter_pensdatum < $GLOBALS["minPensalter"][$_SESSION["sex"]] || $alter_pensdatum > $GLOBALS["maxPensalter"][$_SESSION["sex"]]) {
				$errors["geburtsjahr"]="class='markiertFehler'";
				$errors["geburtstag"]="class='markiertFehler'";
				$errors["geburtsmonat"]="class='markiertFehler'";
				$errors["pensionierungsjahr"]="class='markiertFehler'";
				$errors["pensionierungsmonat"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_datum2 = true;
			}
		}
		
		// Pensionierungsdatum nach Stichdatum
		if ((validiereStichdatum() !=-1) && (validierePensionierungsdatum() != -1)) {
			$diff_datum =(DateDiff("m", $_SESSION["stichdatum"], $_SESSION["pensdatum"])+1);
			if ( $diff_datum<0){
				$errors["stichjahr"]="class='markiertFehler'";
				$errors["stichmonat"]="class='markiertFehler'";
				$errors["pensionierungsjahr"]="class='markiertFehler'";
				$errors["pensionierungsmonat"]="class='markiertFehler'";
				$this->fehler = true;
				$this->fehler_datum3 = true;
			}
		}
		
		// Restliche Werte werden ohne Überprüfung in die Session aufgenommen
        $this->validateSkala();
		if(isset($_POST["zins1"])) {
			$_SESSION["zins1"] = $_POST["zins1"];
		}
		if(isset($_POST["zins2"])) {
			$_SESSION["zins2"] = $_POST["zins2"];
		}
		if(isset($_POST["lohnErh"])) {
			$_SESSION["lohnErh"] = $_POST["lohnErh"];
		}

		if( $this->fehler ) {
			return false;
		} else {
			return true;
		}
	}
	
	function validateSkala() {
		if (isset($_POST["beitragsskala_alt"]) && !is_numeric($_POST["beitragsskala_alt"])){
			$_POST["beitragsskala_alt"]="error";
		}
		if (isset($_POST["beitragsskala"]) && !is_numeric($_POST["beitragsskala"])){
			$_POST["beitragsskala"]="error";
		}
		if(isset($_POST["beitragsskala_alt"])) {
			$_SESSION["beitragsskala_alt"] = $_POST["beitragsskala_alt"];
            $_SESSION["beitragsskala"] = $_POST["beitragsskala_alt"];
		}
    }
	
	var $alter;
	var $alter_pensdatum;
	var $alter_stichdatum;
	var $bvgalter;
	var $beitrag_AN_laufendesJahr;
	var $beitrag_AN;
	var $beitrag_AG;
	var $beitrag_risiko_AN;
	var $beitrag_risiko_AG;
	var $beitrag_risiko_total;
	var $beitrag_total_AN;
	var $beitrag_total_AG;
	var $beitrag_total;
	var $UWS;
	var $UWS_gewaehlt;
	var $AGH;
	var $AGH_gewaehlt;
	var $AGH_BVG_gewaehlt;
	var $AR;
	var $AR_gewaehlt;
	var $Lohn;
	var $LohnBVG;
	var $Lohn_gewaehlt;
	var $max_einkauf;
	var $max_moegl_einkauf;
	var $bezugdauer_gewaehlt;
	var $beitragsjahre_gewaehlt;
	
	public function berechneAltersleistung() {
	    $this->validateSkala();
		$maxBeitragsalter = $GLOBALS["maxBeitragsalterSpar"];

		$this->alter = alter($_SESSION["geburtsdatum"], $_SESSION["pensdatum"]);
		$this->alter_stichdatum =(DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["stichdatum"])-1)/12;
		$this->bvgalter = dateDiff("y", $_SESSION["geburtsdatum"], $_SESSION["stichdatum"]);
		$this->Lohn = entwicklung_Lohn($_SESSION["geburtsdatum"], $_SESSION["stichdatum"], $_SESSION["vsLohn"], $_SESSION["lohnErh"]/10000,0);
		
		$this->LohnBVG = entwicklung_LohnBVG($_SESSION["geburtsdatum"], $_SESSION["stichdatum"], $_SESSION["vsLohn"], $_SESSION["lohnErh"]/10000,0);
		
		// Sparbeiträge AN
        $this->beitrag_AN = array();
        for( $i=1; $i<=3 ;$i++ ) {
            $this->beitrag_AN[$i] = beitraege($this->bvgalter, $this->Lohn[$this->bvgalter], $GLOBALS["sparBS_AN"][$i]);
            $this->beitrag_AN[$i]["monat"] = runden($this->beitrag_AN[$i]["monat"], $GLOBALS["rundung"]);

            if ($this->bvgalter==$maxBeitragsalter) {
                $this->beitrag_AN[$i]["jahr"] = $this->beitrag_AN[$i]["monat"]*$_SESSION["geburtsdatum"][1];
            }
            else {
                $this->beitrag_AN[$i]["jahr"] = $this->beitrag_AN[$i]["monat"]*12;
            }
        }
		// Sparbeiträge AG
		$this->beitrag_AG = beitraege($this->bvgalter, $this->Lohn[$this->bvgalter], $GLOBALS["sparBS_AG"][$_SESSION["beitragsskala_alt"]]);
		$this->beitrag_AG["monat"] = runden($this->beitrag_AG["monat"], $GLOBALS["rundung"]);

		if ($this->bvgalter==$maxBeitragsalter) {
			$this->beitrag_AG["jahr"] = $this->beitrag_AG["monat"]*$_SESSION["geburtsdatum"][1];
		} 
		else {
			$this->beitrag_AG["jahr"] = $this->beitrag_AG["monat"]*12;
		}
		
		// Sparbeiträge Total
		$this->beitrag_total_AN = $this->beitrag_AN[1]["jahr"];       
		$this->beitrag_total_AG = $this->beitrag_AG["jahr"];
		$this->beitrag_total    = $this->beitrag_total_AN + $this->beitrag_total_AG;

		
		// Risikobeiträge AN
		$this->beitrag_risiko_AN = beitraege($this->bvgalter, $this->Lohn[$this->bvgalter], $GLOBALS["risikoBS_AN"]);
		$this->beitrag_risiko_AN["monat"] = runden($this->beitrag_risiko_AN["monat"], $GLOBALS["rundung"]);

		if ($this->bvgalter==$GLOBALS["maxBeitragsalterRisiko"]) {  //Risikobeiträge werden bei der Weiterversicherung keine mehr bezahlt
			$this->beitrag_risiko_AN["jahr"] = $this->beitrag_risiko_AN["monat"]*$_SESSION["geburtsdatum"][1];
		} else {
			$this->beitrag_risiko_AN["jahr"] = $this->beitrag_risiko_AN["monat"]*12;
		}

		// Risikobeiträge AG
		$this->beitrag_risiko_AG = beitraege($this->bvgalter, $this->Lohn[$this->bvgalter], $GLOBALS["risikoBS_AG"]);
		$this->beitrag_risiko_AG["monat"] = runden($this->beitrag_risiko_AG["monat"], $GLOBALS["rundung"]);

		if ($this->bvgalter==$GLOBALS["maxBeitragsalterRisiko"]) {  //Risikobeiträge werden bei der Weiterversicherung keine mehr bezahlt
			$this->beitrag_risiko_AG["jahr"] = $this->beitrag_risiko_AG["monat"]*$_SESSION["geburtsdatum"][1];
		} else {
			$this->beitrag_risiko_AG["jahr"] = $this->beitrag_risiko_AG["monat"]*12;
		}

		// Risikobeiträge Total
		$this->beitrag_risiko_total["prozent"] = $this->beitrag_risiko_AN["prozent"] + $this->beitrag_risiko_AG["prozent"];
		$this->beitrag_risiko_total["jahr"] = $this->beitrag_risiko_AN["jahr"] + $this->beitrag_risiko_AG["jahr"];

		
		//------------------- Altersguthaben, Umwandlungssatz und Altersrente für ganze Jahre---------------------------

		$alter = $GLOBALS["minPensalter"][$_SESSION["sex"]];
		for ($alter; $alter<=$GLOBALS["maxPensalter"][$_SESSION["sex"]]; $alter++){
			$rueckdatum = returnDatum($_SESSION["geburtsdatum"][1], $_SESSION["geburtsdatum"][2]+$alter);
            $this->AGH["$alter"] = array();
            $this->AR["$alter"] = array();
            for( $i=1; $i<=3 ;$i++ ) {
                $this->AGH["$alter"][$i] = projektion_AGH( $_SESSION["geburtsdatum"], 
                                                        $_SESSION["stichdatum"], 
                                                        $rueckdatum, 
                                                        $_SESSION["AGH"], 
                                                        $this->Lohn, 
                                                        $GLOBALS["sparBS"][$i], 
                                                        $GLOBALS["sparBS"][$i], 
                                                        $_SESSION["zins1"]/100, 
                                                        $_SESSION["zins2"]/100, 
                                                        0);
                
                $this->AGH["$alter"][$i] = runden($this->AGH["$alter"][$i], $GLOBALS["rundung"]);
                $this->AR["$alter"][$i] = Altersrente($_SESSION["geburtsdatum"], $rueckdatum, $this->AGH["$alter"][$i], $_SESSION["sex"]);
                $this->AR["$alter"][$i] = runden($this->AR["$alter"][$i], $GLOBALS["rundung"]);
            }
			$this->UWS["$alter"] = Umwandlungssatz($_SESSION["geburtsdatum"], $rueckdatum, $_SESSION["sex"]);
		} 


		//------------------- Altersguthaben, Umwandlungssatz und Altersrente für gewählten Rücktritt---------------------------
		
		$this->bvgalter_gewaehlt = $_SESSION["pensdatum"][2] - $_SESSION["geburtsdatum"][2];
		$this->alter_pensdatum = DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["pensdatum"]) / 12;
		$this->Lohn_gewaehlt = $this->Lohn["$this->bvgalter_gewaehlt"];
		
		$this->AGH_gewaehlt = projektion_AGH(	$_SESSION["geburtsdatum"],
												$_SESSION["stichdatum"],
												$_SESSION["pensdatum"],
												$_SESSION["AGH"], 
												$this->Lohn,
												$GLOBALS["sparBS"][$_SESSION["beitragsskala_alt"]], 
												$GLOBALS["sparBS"][$_SESSION["beitragsskala"]], 
												$_SESSION["zins1"]/100,
												$_SESSION["zins2"]/100,
												0);
		$this->AGH_gewaehlt = runden($this->AGH_gewaehlt, $GLOBALS["rundung"]);

		//-----------------BVG Guthaben nur im Gewählten Alter----------------------
		$this->AGH_BVG_gewaehlt = projektion_BVG(	$_SESSION["geburtsdatum"],
												$_SESSION["stichdatum"],
												$_SESSION["pensdatum"],
												$_SESSION["AGH_BVG"], 
												$this->LohnBVG,
												$GLOBALS["beitragTotal_BVG"], 
												$GLOBALS["beitragTotal_BVG"], 
												$_SESSION["zins1"]/100,
												$_SESSION["zins1"]/100,
												0);
		
		
		$this->AR_gewaehlt = Altersrente($_SESSION["geburtsdatum"], $_SESSION["pensdatum"], $this->AGH_gewaehlt, $_SESSION["sex"]);
		$this->AR_gewaehlt = runden($this->AR_gewaehlt, $GLOBALS["rundung"]);
		
		$this->UWS_gewaehlt = Umwandlungssatz($_SESSION["geburtsdatum"], $_SESSION["pensdatum"], $_SESSION["sex"]);
		
		$this->bezugdauer_gewaehlt = max(0, $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]-$this->alter_pensdatum);
		$this->beitragsjahre_gewaehlt = min(20, aufrunden((DateDiff("m", $_SESSION["eintrittsdatum"], $_SESSION["pensdatum"])+1) / 12));

		
		//------------------- Möglicher Einkauf-----------------------------
        $this->max_einkauf = array();
        $this->max_moegl_einkauf = array();
		for( $i=1; $i<=3 ;$i++ ) {
            $this->max_einkauf[$i] = maximalerEinkauf($_SESSION["geburtsdatum"], $_SESSION["stichdatum"], $_SESSION["vsLohn"], $GLOBALS["sparBS_AG"][$i], $GLOBALS["einkauf"][$i]);
            $this->max_moegl_einkauf[$i] = max($this->max_einkauf[$i] - $_SESSION["AGH"], 0);
            $this->max_moegl_einkauf[$i] = runden($this->max_moegl_einkauf[$i], $GLOBALS["rundung"]);
        }
	}
	
	
	
	public function setDefaultsWeitereBerechnungen() {
		
		// Wahl Überbrückungsrente
		if (!isset($_SESSION["beschaeftigungsgrad"])){
			$_SESSION["beschaeftigungsgrad"] = $_SESSION["bg"];
		}
		if (!isset($_SESSION["UeRgewuenscht"])){
			$_SESSION["UeRgewuenscht"] = 0;
		}
		if (!isset($_SESSION["wahl"])){
			$_SESSION["wahl"] = "Kapitalbezug";
		}
		if (!isset($_SESSION["Kapitalgewuenscht"])){
			$_SESSION["Kapitalgewuenscht"] = 0;
		}
		if (!isset($_SESSION["Monatsrentegewuenscht"])){
			$_SESSION["Monatsrentegewuenscht"] = 0;
		}
		
		
		// Einlage AGH 
		if (!isset($_SESSION["mehrereEinlagen"])){
			$_SESSION["mehrereEinlagen"] = false;
		}
		
		for($i=1; $i<=3; $i++) {
			// Beträge
			if (!isset($_SESSION["einlage"][$i])){
				$_SESSION["einlage"][$i] = 0;
			}
			// Tage
			if (!isset($_SESSION["einlagedatum"][$i][0])){
				$_SESSION["einlagedatum"][$i][0] = 1;
			}
			// Monate
			if (!isset($_SESSION["einlagedatum"][$i][1])){
				$_SESSION["einlagedatum"][$i][1] = $_SESSION["stichdatum"][1];
			}
			// Jahre
			if (!isset($_SESSION["einlagedatum"][$i][2])){
				$_SESSION["einlagedatum"][$i][2] = $_SESSION["stichdatum"][2];
			} 
		}
		
		
		// Vorbezug
		if (!isset($_SESSION["wahlVorbezug"])){
			$_SESSION["wahlVorbezug"] = "WEF";
		}
		if (!isset($_SESSION["vorbezug"])){
			$_SESSION["vorbezug"] = 0;
		}
		if (!isset($_SESSION["fzl50"])){
			$_SESSION["fzl50"] = 0;
		}
		if (!isset($_SESSION["vorbezugdatum"][0])){
			$_SESSION["vorbezugdatum"][0] = 1;
		}
		if (!isset($_SESSION["vorbezugdatum"][1])){
			$_SESSION["vorbezugdatum"][1] = $_SESSION["stichdatum"][1];
		}
		if (!isset($_SESSION["vorbezugdatum"][2])){
			$_SESSION["vorbezugdatum"][2] = $_SESSION["stichdatum"][2];
		}
	}
}
?>