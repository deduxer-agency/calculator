<?php

class Vorbezug_Berechnung {

	var $fehler_Vorbezug = false;
	var $fehler_datum = false;
	var $fehler_datumWEF = false;
	var $fehler_datumScheidung = false;
	var $fehler_datumVorbezug = false;
	var $fehler_VorbezugWert=false;
	var $fehler_fzl=false;
	
	public function istInputGueltig() {
		// Prüfen, ob numerische Werte eingegeben wurden
		if (isset($_POST["wahlVorbezug"]) && !(($_POST["wahlVorbezug"]=="WEF") or $_POST["wahlVorbezug"]==("Scheidung"))){
			$_POST["wahlVorbezug"]="error";
		}
		if (isset($_POST["fzl50"]) && !is_numeric($_POST["fzl50"])){
			$_POST["fzl50"]="error";
		}
		if (isset($_POST["vorbezug"]) && !is_numeric($_POST["vorbezug"])){
			$_POST["vorbezug"]="error";
		}
		if (isset($_POST["vorbezugmonat"]) && !is_numeric($_POST["vorbezugmonat"])){
			$_POST["vorbezugmonat"]="error";
		}
		if (isset($_POST["vorbezugjahr"]) && !is_numeric($_POST["vorbezugjahr"])){
			$_POST["vorbezugjahr"]="error";
		}

		// Neue Werte in die Session aufnehmen
		if(isset($_POST["vorbezug"])) {
			$_SESSION["vorbezug"] = $_POST["vorbezug"];
		}
		if(isset($_POST["wahlVorbezug"])) {
			$_SESSION["wahlVorbezug"] = $_POST["wahlVorbezug"];
		}
		if(isset($_POST["fzl50"])) {
			$_SESSION["fzl50"] = $_POST["fzl50"];
		}


		// Prüfen, ob alle Eingaben auch sinnvoll sind

		global $errors;

		// Validierung Vorbezugwert
		if (validiereBetrag($_SESSION["fzl50"], 0, $GLOBALS["maxFzl"])==-1){
			$errors["fzl50"]="class='markiertFehler'";
			$this->fehler_Vorbezug = true;
			$this->fehler_fzl = true;
		}

		if ($_SESSION["wahlVorbezug"]=="WEF"){
			$vorbezugMin=20000;   
		} else {
			$vorbezugMin=0;
		}    
		if (validiereVorbezug($_SESSION["vorbezug"], $vorbezugMin)==-1){
			$errors["vorbezug"]="class='markiertFehler'";
			$this->fehler_Vorbezug = true;
			$this->fehler_vorbezugWert = true;
		}

		if(isset($_POST["vorbezugmonat"]) || isset($_POST["vorbezugjahr"])) {
			$_SESSION["vorbezugdatum"] = validiereEinlageDatum(returnDatum($_POST["vorbezugmonat"], $_POST["vorbezugjahr"]));
		}

		if($_SESSION["vorbezugdatum"] == -1) {
			$errors["vorbezugmonat"]="class='markiertFehler'";
			$errors["vorbezugjahr"]="class='markiertFehler'";
			$this->fehler_datum = true;
			$this->fehler_Vorbezug = true;
		}

		
		// Überprüfen, ob Vorbezugdatum nach Stichdatum

		if (($_SESSION["vorbezugdatum"] != -1) && ($_SESSION["vorbezug"]>0)) {
			$diff_datum =(DateDiff("m", $_SESSION["stichdatum"], $_SESSION["vorbezugdatum"]))/12;
			if (($diff_datum < 0) ){
				$errors["vorbezugmonat"]="class='markiertFehler'";
				$errors["vorbezugjahr"]="class='markiertFehler'";
				$this->fehler_datumVorbezug = true;
				$this->fehler_Vorbezug = true;
			}
		}
		if (($_SESSION["vorbezugdatum"] != -1) && ($_SESSION["vorbezug"]>0)) {
			$diff_datum =(DateDiff("m", $_SESSION["stichdatum"], $_SESSION["vorbezugdatum"]))/12;
			if (($diff_datum > 62) && ($_SESSION["wahlVorbezug"]=="WEF")){
				$errors["vorbezugmonat"]="class='markiertFehler'";
				$errors["vorbezugjahr"]="class='markiertFehler'";
				$this->fehler_datumWEF = true;
				$this->fehler_Vorbezug = true;
			} 
			if (($diff_datum > 65) && ($_SESSION["wahlVorbezug"]=="Scheidung")){
				$errors["vorbezugmonat"]="class='markiertFehler'";
				$errors["vorbezugjahr"]="class='markiertFehler'";
				$this->fehler_datumScheidung = true;
				$this->fehler_Vorbezug = true;
			}
		}
		if( $this->fehler_Vorbezug ) {
			return false;
		} else {
			return true;
		}

	}
	
	var $vorbezug_ber;
	var $fzl50_berechnet;
	var $vorbezug_max;
	var $alter_vorbezug;
	var $AGH_vorbezug;
	var $AGH;
	var $AGH_gewaehlt;
    var $AGH_BVG_gewaehlt;
	var $AR;
	var $AR_gewaehlt;
	
	public function berechneAltersleistung(Basic_Berechnung $basic) {
		
		// Vorbezug beschränken
		$this->alter_vorbezug = (DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["vorbezugdatum"]))/12;
        for ($sk=1;$sk<=3;$sk++) {
            // Bei WEF FZL 50 berechnen
		    if ($_SESSION["wahlVorbezug"] == "WEF"){
			    if ($basic -> alter_stichdatum > 50){
				    $this->fzl50_berechnet[$sk] = $_SESSION["fzl50"];
			    } else {
				    $datum50 = returnDatum($res_geburtsdatum[1], $res_geburtsdatum[2]+50);
				    $AGH[50] = projektion_AGH(  $_SESSION["geburtsdatum"],
											    $_SESSION["stichdatum"],
											    $datum50,
											    $_SESSION["AGH"],
											    $basic -> Lohn,
											    $GLOBALS["sparBS"][$sk],
											    $GLOBALS["sparBS"][$sk],
											    $_SESSION["zins1"]/100,
											    $_SESSION["zins2"]/100,
											    0);
				    $AGH[50] = runden($AGH[50], $GLOBALS["rundung"]);
				    $this->fzl50_berechnet[$sk] = $AGH[50];
			    }
		    } else {
			    $this->fzl50_berechnet[$sk] = 0;
		    }



            $this->AGH_vorbezug[$sk] = projektion_AGH( 	$_SESSION["geburtsdatum"],
                                                    $_SESSION["stichdatum"],
                                                    $_SESSION["vorbezugdatum"],
                                                    $_SESSION["AGH"],
                                                    $basic -> Lohn,
                                                    $GLOBALS["sparBS"][$sk],
                                                    $GLOBALS["sparBS"][$sk],
                                                    $_SESSION["zins1"]/100,
                                                    $_SESSION["zins2"]/100,
                                                    0);
            $this->AGH_vorbezug[$sk] = runden($this->AGH_vorbezug[$sk], $GLOBALS["rundung"]);

            if (($this->alter_vorbezug > 50) && ($_SESSION["wahlVorbezug"] == "WEF")){
                $this->vorbezug_max[$sk] = min(max($this->AGH_vorbezug[$sk]/2, $this->fzl50_berechnet[$sk]), $this->AGH_vorbezug[$sk]);
            } else {
                $this->vorbezug_max[$sk] = $this->AGH_vorbezug[$sk];
            }
            $this->vorbezug_ber[$sk] = min($_SESSION["vorbezug"], $this->vorbezug_max[$sk]);


            // Vorbezug aufzinsen
            $alter = $GLOBALS["minPensalter"][$_SESSION["sex"]];
            for ($alter; $alter<=$GLOBALS["maxPensalter"][$_SESSION["sex"]]; $alter++){
                $rueckdatum = returnDatum($_SESSION["geburtsdatum"][1], $_SESSION["geburtsdatum"][2]+$alter);
                if ($_SESSION["vorbezugdatum"][2] == $_SESSION["stichdatum"][2]) {
                    $vorbezug_verzinst[$alter] = verzinsungEinlage($this->vorbezug_ber[$sk], $_SESSION["vorbezugdatum"], $rueckdatum, $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
                } else {
                    $vorbezug_verzinst[$alter] = verzinsungEinlage($this->vorbezug_ber[$sk], $_SESSION["vorbezugdatum"], $rueckdatum, $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
                }
            }
            if ($sk == $_SESSION["beitragsskala_alt"]) {
                if ($_SESSION["vorbezugdatum"][2] == $_SESSION["stichdatum"][2]) {
                    $vorbezug_verzinst_gewaehlt = verzinsungEinlage($this->vorbezug_ber[$sk], $_SESSION["vorbezugdatum"], $_SESSION["pensdatum"], $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
                } else {
                    $vorbezug_verzinst_gewaehlt = verzinsungEinlage($this->vorbezug_ber[$sk], $_SESSION["vorbezugdatum"], $_SESSION["pensdatum"], $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
                }
            }

            // Berechnung Altersleistung unter Berücksichtigung der Vorbezüge in allen Altern
            for ($alter=$GLOBALS["minPensalter"][$_SESSION["sex"]]; $alter<=$GLOBALS["maxPensalter"][$_SESSION["sex"]]; $alter++){
                $rueckdatum =returnDatum($_SESSION["geburtsdatum"][1], $_SESSION["geburtsdatum"][2]+$alter);
                $this->AGH["$alter"][$sk] = $basic->AGH["$alter"][$sk] - $vorbezug_verzinst["$alter"];
                $this->AGH["$alter"][$sk] = runden($this->AGH["$alter"][$sk],$GLOBALS["rundung"]);
                $this->AR["$alter"][$sk] = Altersrente($_SESSION["geburtsdatum"], $rueckdatum,$this->AGH["$alter"][$sk], $_SESSION["sex"]);
                $this->AR["$alter"][$sk] = runden($this->AR["$alter"][$sk], $GLOBALS["rundung"]);
            }
        }

		// Im gewaehlten Rücktrittsalter
		$this->AGH_gewaehlt = $basic -> AGH_gewaehlt - $vorbezug_verzinst_gewaehlt;
		$this->AGH_gewaehlt = runden($this->AGH_gewaehlt,$GLOBALS["rundung"]);
        $this->AGH_BVG_gewaehlt = $basic -> AGH_BVG_gewaehlt * ( 1 - $vorbezug_verzinst_gewaehlt / $basic->AGH_gewaehlt );
		$this->AGH_BVG_gewaehlt = runden($this->AGH_BVG_gewaehlt,$GLOBALS["rundung"]);
		$this->AR_gewaehlt = Altersrente($_SESSION["geburtsdatum"],$_SESSION["pensdatum"],$this->AGH_gewaehlt, $_SESSION["sex"]);
		$this->AR_gewaehlt = runden($this->AR_gewaehlt, $GLOBALS["rundung"]);
		
	}
	
}
?>