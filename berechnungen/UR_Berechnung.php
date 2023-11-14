<?php

class UR_Berechnung {
	
	var $fehler_Pens = false;
	var $fehler_UeRgewuenscht = false;
	var $fehler_Kapitalgewuenscht = false;
	var $fehler_Monatsrentegewuenscht = false;
	
	public function istInputGueltig($altersleistung, $basic) {

		// Prüfen, ob numerische Werte eingegeben wurden
		if (isset($_POST["beschaeftigungsgrad"]) && !is_numeric($_POST["beschaeftigungsgrad"])){
			$_POST["beschaeftigungsgrad"]="error";
		}
		if (isset($_POST["UeRgewuenscht"]) && !is_numeric($_POST["UeRgewuenscht"])){
			$_POST["UeRgewuenscht"]="error";
		}
		if (isset($_POST["Kapitalgewuenscht"]) && !is_numeric($_POST["Kapitalgewuenscht"])){
			$_POST["Kapitalgewuenscht"]="error";
		}
		if (isset($_POST["Monatsrentegewuenscht"]) && !is_numeric($_POST["Monatsrentegewuenscht"])){
			$_POST["Monatsrentegewuenscht"]="error";
		}
		if (isset($_POST["wahl"]) && (!(($_POST["wahl"]=="Kapitalbezug") or $_POST["wahl"]==("Altersrente")))){
			$_POST["wahl"]="error";
		}

        if (isset($_POST["beschaeftigungsgrad"])) {
		    $_SESSION["beschaeftigungsgrad"] = $_POST["beschaeftigungsgrad"];
        }
        if (isset($_POST["UeRgewuenscht"])) {
            $_SESSION["UeRgewuenscht"] = $_POST["UeRgewuenscht"];
        }
        if (isset($_POST["wahl"])) {
            $_SESSION["wahl"] = $_POST["wahl"];
        }
        if (isset($_POST["Kapitalgewuenscht"])) {
            $_SESSION["Kapitalgewuenscht"] = $_POST["Kapitalgewuenscht"];
        }
        if (isset($_POST["Monatsrentegewuenscht"])) {
		    $_SESSION["Monatsrentegewuenscht"] = $_POST["Monatsrentegewuenscht"];
        }
		
		if (isset($_POST["wahl"])) {
            if ($_SESSION["wahl"] == "Kapitalbezug") {
                $_SESSION["Kapitalgewuenscht"] = $_POST["Kapitalgewuenscht"];
                $_SESSION["Monatsrentegewuenscht"] = 0;
            } else {
                $_SESSION["Kapitalgewuenscht"] = 0;
                $_SESSION["Monatsrentegewuenscht"] = $_POST["Monatsrentegewuenscht"];
            }
        }

		global $errors;
		
		// prüfen, ob alle Eingaben auch sinnvoll sind
		$gekuerzteAR = GekuerzteAltersrente($_SESSION["UeRgewuenscht"], $basic->beitragsjahre_gewaehlt, $basic->bezugdauer_gewaehlt, $altersleistung->AGH_gewaehlt, $basic->UWS_gewaehlt);
		$AGHgekürzt = 12*$gekuerzteAR / $basic->UWS_gewaehlt;
		$AGHkürzung = $AGHgekürzt-$altersleistung->AGH_gewaehlt;
		$kapitalmax = Max($altersleistung->AGH_gewaehlt/2 , $altersleistung->AGH_gewaehlt - $basic->AGH_BVG_gewaehlt*0.75,0)+$AGHkürzung ;
		$gekuerzteARmin = ($altersleistung->AGH_gewaehlt-Max($altersleistung->AGH_gewaehlt/2 , $altersleistung->AGH_gewaehlt - $basic->AGH_BVG_gewaehlt*0.75,0))*$basic->UWS_gewaehlt/12;
		//echo $gekuerzteAR;
		//echo "&nbsp";
		//echo $gekuerzteARmin ;
		if(validiereUeRgewuenscht($_SESSION["UeRgewuenscht"], $_SESSION["beschaeftigungsgrad"]) == -1 || $gekuerzteAR < $gekuerzteARmin) {//, $gekuerzteAR
			$errors["UeRgewuenscht"]="class='markiertFehler'";
			$this->fehler_Pens=true;
			$this->fehler_UeRgewuenscht = true;
		}
		
		if(validiereBetrag($_SESSION["Kapitalgewuenscht"], 0, $kapitalmax+1) == -1) {
			$errors["Kapitalgewuenscht"]="class='markiertFehler'";
			$this->fehler_Pens=true;
			$this->fehler_Kapitalgewuenscht = true;
		}
		if ($_SESSION["wahl"] == "Kapitalbezug") {
		if(validiereBetrag($_SESSION["Monatsrentegewuenscht"], 0, max(0, runden($gekuerzteAR,1)+1)) == -1) {//max(0, runden($gekuerzteAR / 2,1))
			$errors["Monatsrentegewuenscht"]="class='markiertFehler'";
			$this->fehler_Pens=true;
			$this->fehler_Monatsrentegewuenscht = true;
		}
		}else{
		if(validiereBetrag($_SESSION["Monatsrentegewuenscht"], $gekuerzteARmin-1, max(0, runden($gekuerzteAR,1)+1)) == -1) {//max(0, runden($gekuerzteAR / 2,1))max(0, runden($gekuerzteARmin,1))
			$errors["Monatsrentegewuenscht"]="class='markiertFehler'";
			$this->fehler_Pens=true;
			$this->fehler_Monatsrentegewuenscht = true;
		}
		}
		if( $this->fehler_Pens ) {
			return false;
		} else {
			return true;
		}
	}
	
	
	var $Kapital_beruecksichtigt;
	var $AR_ungekuerzt;
	var $AR_kuerzung;
	var $AR_gekuerzt;
	
	public function berechneUR($altersleistung, $basic) {

		if ($_SESSION["wahl"] == "Kapitalbezug"){ // Kapital gewählt
			$this->Kapital_beruecksichtigt = $_SESSION["Kapitalgewuenscht"];
			$this->AR_ungekuerzt = Altersrente($_SESSION["geburtsdatum"], $_SESSION["pensdatum"], $altersleistung->AGH_gewaehlt-$_SESSION["Kapitalgewuenscht"], $_SESSION["sex"]);
			$this->AR_gekuerzt = GekuerzteAltersrente($_SESSION["UeRgewuenscht"], $basic->beitragsjahre_gewaehlt, $basic->bezugdauer_gewaehlt, $altersleistung->AGH_gewaehlt-$_SESSION["Kapitalgewuenscht"], $basic->UWS_gewaehlt);
			$this->AR_kuerzung = $this->AR_ungekuerzt - $this->AR_gekuerzt;
		} else {
			$this->AR_gekuerzt = $_SESSION["Monatsrentegewuenscht"];
			$KapitalFuerUR = runden(12 * getKuerzungAR($_SESSION["UeRgewuenscht"], $basic->beitragsjahre_gewaehlt, $basic->bezugdauer_gewaehlt, $basic->UWS_gewaehlt) / $basic->UWS_gewaehlt, 1);
			$KapitalFuerAR = runden(12 * $_SESSION["Monatsrentegewuenscht"] / $basic->UWS_gewaehlt, 1);
			$this->Kapital_beruecksichtigt = $altersleistung->AGH_gewaehlt - $KapitalFuerUR - $KapitalFuerAR;

			//$this->AR_ungekuerzt = Altersrente($_SESSION["geburtsdatum"], $_SESSION["pensdatum"], $altersleistung->AGH_gewaehlt - $this->Kapital_beruecksichtigt, $_SESSION["sex"]);
			//$this->AR_kuerzung = $this->AR_ungekuerzt - $this->AR_gekuerzt;
			$this->AR_ungekuerzt = $this->AR_gekuerzt;
		}
		
	}
	
}
?>