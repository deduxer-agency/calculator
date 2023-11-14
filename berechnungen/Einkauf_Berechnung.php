<?php

class Einkauf_Berechnung {

	var $fehler_Einlage = false;
	var $fehler_datum = false;
	var $fehler_datumEinlageKGH = false;
	var $fehler_datumEinlage = false;
	var $fehler_datumEinlage2 = false;
	var $fehler_EinlageWert = false;
	
	public function istInputGueltig() {

		// Prüfen, ob numerische Werte eingegeben wurden

		if (isset($_POST["AGHeinlage1"]) && !is_numeric($_POST["AGHeinlage1"])){
			$_POST["AGHeinlage1"]="error";
		}
		
		if (isset($_POST["AGHeinlagemonat1"]) && !is_numeric($_POST["AGHeinlagemonat1"])){
			$_POST["AGHeinlagemonat1"]="error";
		}
		if (isset($_POST["AGHeinlagejahr1"]) && !is_numeric($_POST["AGHeinlagejahr1"])){
			$_POST["AGHeinlagejahr1"]="error";
		}

		if (isset($_POST["AGHeinlage2"]) && !is_numeric($_POST["AGHeinlage2"])){
			$_POST["AGHeinlage2"]="error";
		}
		
		if (isset($_POST["AGHeinlagemonat2"]) && !is_numeric($_POST["AGHeinlagemonat2"])){
			$_POST["AGHeinlagemonat2"]="error";
		}
		if (isset($_POST["AGHeinlagejahr2"]) && !is_numeric($_POST["AGHeinlagejahr2"])){
			$_POST["AGHeinlagejahr2"]="error";
		}
		
		if (isset($_POST["AGHeinlage3"]) && !is_numeric($_POST["AGHeinlage3"])){
			$_POST["AGHeinlage3"]="error";
		}
		
		if (isset($_POST["AGHeinlagemonat3"]) && !is_numeric($_POST["AGHeinlagemonat3"])){
			$_POST["AGHeinlagemonat3"]="error";
		}
		if (isset($_POST["AGHeinlagejahr3"]) && !is_numeric($_POST["AGHeinlagejahr3"])){
			$_POST["AGHeinlagejahr3"]="error";
		}


		// Neue Werte in die Session aufnehmen
		if(isset($_POST["AGHeinlage1"])) {
			$_SESSION["einlage"][1] = $_POST["AGHeinlage1"];
			$_SESSION["einlage"][2] = $_POST["AGHeinlage2"];
			$_SESSION["einlage"][3] = $_POST["AGHeinlage3"];
		}

		if(isset($_POST["AGHeinlagemonat1"]) || isset($_POST["AGHeinlagejahr1"])) {
			$_SESSION["einlagedatum"][1] = validiereEinlageDatum(returnDatum($_POST["AGHeinlagemonat1"],$_POST["AGHeinlagejahr1"]));
		}
		if(isset($_POST["AGHeinlagemonat2"]) || isset($_POST["AGHeinlagejahr2"])) {
			$_SESSION["einlagedatum"][2] = validiereEinlageDatum(returnDatum($_POST["AGHeinlagemonat2"],$_POST["AGHeinlagejahr2"]));
		}
		if(isset($_POST["AGHeinlagemonat3"]) || isset($_POST["AGHeinlagejahr3"])) {
			$_SESSION["einlagedatum"][3] = validiereEinlageDatum(returnDatum($_POST["AGHeinlagemonat3"],$_POST["AGHeinlagejahr3"]));
		}
		
		// Prüfen, ob alle Eingaben auch sinnvoll sind

		global $errors;
	
		// Validierung Einlagenwert
		for ($i=1; $i <= 3; $i++){
			if (validiereEinlage($_SESSION["einlage"][$i]) == -1){
				$errors["einlage[$i]"]="class='markiertFehler'";
				$this->fehler_einlageWert = true;
				$this->fehler_Einlage = true;
			}
		}

		for ($i=1; $i <= 3; $i++){
			if($_SESSION["einlagedatum"][$i] == -1) {
				$errors["einlagetag[$i]"]="class='markiertFehler'";
				$errors["einlagemonat[$i]"]="class='markiertFehler'";
				$errors["einlagejahr[$i]"]="class='markiertFehler'";
				$this->fehler_datum = true;
				$this->fehler_Einlage = true;
			}
		}

		// Überprüfen, ob alle Einlagedaten nach Stichdatum und vor Pensionierungsalter
		for ($i=1; $i<=3; $i++){
			if (($_SESSION["einlagedatum"][$i] != -1) && ($_SESSION["einlage"][$i] > 0)) {
				$diff_datum =(DateDiff("m", $_SESSION["stichdatum"], $_SESSION["einlagedatum"][$i]));
				if ($diff_datum < 0) {
					$errors["einlagetag[$i]"]="class='markiertFehler'";
					$errors["einlagemonat[$i]"]="class='markiertFehler'";
					$errors["einlagejahr[$i]"]="class='markiertFehler'";
					$this->fehler_datumEinlage = true;
					$this->fehler_Einlage = true;
				}
				$diff_datum =(DateDiff("m", $_SESSION["geburtsdatum"], $_SESSION["einlagedatum"][$i]))/12;
				if ($diff_datum > $GLOBALS["maxPensalter"][$_SESSION["sex"]]) {
					$errors["einlagetag[$i]"]="class='markiertFehler'";
					$errors["einlagemonat[$i]"]="class='markiertFehler'";
					$errors["einlagejahr[$i]"]="class='markiertFehler'";
					$this->fehler_datumEinlageAGH = true;
					$this->fehler_Einlage = true;
				}
			}
		}

		// Prüfen, ob Einlagen in zeitlicher Reihenfolge

		if (($_SESSION["einlagedatum"][1] !=-1) && ($_SESSION["einlagedatum"][2] != -1) && ($_SESSION["einlage"][2]>0)) {
			$diff_datum =(DateDiff("m", $_SESSION["einlagedatum"][1], $_SESSION["einlagedatum"][2]));
			 if ($diff_datum < 0) {
				$errors["einlagetag[1]"]="class='markiertFehler'";
				$errors["einlagemonat[1]"]="class='markiertFehler'";
				$errors["einlagejahr[1]"]="class='markiertFehler'";
				$errors["einlagetag[2]"]="class='markiertFehler'";
				$errors["einlagemonat[2]"]="class='markiertFehler'";
				$errors["einlagejahr[2]"]="class='markiertFehler'";
				$this->fehler_datumEinlage2 = true;
				$this->fehler_Einlage = true;
			}
		}

		if (($_SESSION["einlagedatum"][1] !=-1) && ($_SESSION["einlagedatum"][3] != -1) && ($_SESSION["einlage"][3]>0)) {
			$diff_datum =(DateDiff("m", $_SESSION["einlagedatum"][1], $_SESSION["einlagedatum"][3]));
			if ($diff_datum < 0) {
				$errors["einlagetag[1]"]="class='markiertFehler'";
				$errors["einlagemonat[1]"]="class='markiertFehler'";
				$errors["einlagejahr[1]"]="class='markiertFehler'";
				$errors["einlagetag[3]"]="class='markiertFehler'";
				$errors["einlagemonat[3]"]="class='markiertFehler'";
				$errors["einlagejahr[3]"]="class='markiertFehler'";
				$this->fehler_datumEinlage2 = true;
				$this->fehler_Einlage = true;
			}
		}

		if (($_SESSION["einlagedatum"][2] !=-1) && ($_SESSION["einlagedatum"][3] != -1) && ($_SESSION["einlage"][3]>0)) {
			$diff_datum =(DateDiff("m", $_SESSION["einlagedatum"][2], $_SESSION["einlagedatum"][3]));
			if ($diff_datum < 0) {
				$errors["einlagetag[2]"]="class='markiertFehler'";
				$errors["einlagemonat[2]"]="class='markiertFehler'";
				$errors["einlagejahr[2]"]="class='markiertFehler'";
				$errors["einlagetag[3]"]="class='markiertFehler'";
				$errors["einlagemonat[3]"]="class='markiertFehler'";
				$errors["einlagejahr[3]"]="class='markiertFehler'";
				$this->fehler_datumEinlage2 = true;
				$this->fehler_Einlage = true;
			}
		}
		

		if( $this->fehler_Einlage ) {
			return false;
		} else {
			return true;
		}

	}

	

	var $einlage_ber;
	var $AGH;
	var $AGH_gewaehlt;
	var $AR;
	var $AR_gewaehlt;
	
	public function berechneAltersleistung(Basic_Berechnung $basic) {
		$this->bezugdauer_gewaehlt = $basic -> bezugdauer_gewaehlt;
		$this->beitragsjahre_gewaehlt = $basic -> beitragsjahre_gewaehlt;
		
        for ($sk=1;$sk<=3;$sk++) {
            // Einlagen begrenzen
            for($i=1; $i<=3; $i++){
                $alterEinlage_arr = alter($_SESSION["geburtsdatum"],$_SESSION["einlagedatum"][$i]);
                $alterEinlage[$i] = $alterEinlage_arr["jahr"] + $alterEinlage_arr["monat"]/12;
                $maxEinkauf[$i] = maximalerEinkauf($_SESSION["geburtsdatum"], $_SESSION["einlagedatum"][$i], $_SESSION["vsLohn"], $GLOBALS["sparBS_AG"][$sk],$GLOBALS["einkauf"][$sk]);
            }

            for($i=1; $i<=3; $i++){
                if ($_SESSION["einlagedatum"][$i]==$_SESSION["stichdatum"]) {
                    $AGH_einkauf[$i] = $_SESSION["AGH"];
                    $einlage_datum_ber[$i] = $_SESSION["stichdatum"];
                } else {
                    // Falls der 1. des Monats gewählt wird, wird das Einlagedatum per Ende des Vormonats berücksichtigt
                    if ($_SESSION["einlagedatum"][$i][0]==1) {
                        if ($_SESSION["einlagedatum"][$i][1]==1) {
                            $einlage_datum_ber[$i] = returnDatum(12, $_SESSION["einlagedatum"][$i][2]-1);
                        } else {
                            $einlage_datum_ber[$i] = returnDatum($_SESSION["einlagedatum"][$i][1]-1, $_SESSION["einlagedatum"][$i][2]);
                        }
                    } else {
                        $einlage_datum_ber[$i] = $_SESSION["einlagedatum"][$i];
                    }
                    
                    $AGH_einkauf[$i] = projektion_AGH( 	$_SESSION["geburtsdatum"],
                                                        $_SESSION["stichdatum"],
                                                        $einlage_datum_ber[$i],
                                                        $_SESSION["AGH"],
                                                        $basic->Lohn,
                                                        $GLOBALS["sparBS"][$sk], 
                                                        $GLOBALS["sparBS"][$sk],
                                                        $_SESSION["zins1"]/100,
                                                        $_SESSION["zins2"]/100,
                                                        0);
                }
            }
            
            $AGH_einkauf_mit[1] = $AGH_einkauf[1];
            $this->einlage_ber[1][$sk] = max(min($_SESSION["einlage"][1], $maxEinkauf[1] - $AGH_einkauf[1]), 0);


            if ($_SESSION["einlagedatum"][1][2] == $_SESSION["stichdatum"][2]){
                $einlage1_bis2 = verzinsungEinlage($this->einlage_ber[1][$sk], $_SESSION["einlagedatum"][1], $einlage_datum_ber[2], $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
                $einlage1_bis3 = verzinsungEinlage($this->einlage_ber[1][$sk], $_SESSION["einlagedatum"][1], $einlage_datum_ber[3], $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
            } else {
                $einlage1_bis2 = verzinsungEinlage($this->einlage_ber[1][$sk], $_SESSION["einlagedatum"][1], $einlage_datum_ber[2], $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
                $einlage1_bis3 = verzinsungEinlage($this->einlage_ber[1][$sk], $_SESSION["einlagedatum"][1], $einlage_datum_ber[3], $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
            }
            $AGH_einkauf_mit[2] = $AGH_einkauf[2] + $einlage1_bis2;
            $this->einlage_ber[2][$sk] = max(min($_SESSION["einlage"][2], $maxEinkauf[2] - $AGH_einkauf_mit[2]), 0);
            
            if ($_SESSION["einlagedatum"][2][2] == $_SESSION["stichdatum"][2]){
                $einlage2_bis3 = verzinsungEinlage($this->einlage_ber[2][$sk], $_SESSION["einlagedatum"][2], $einlage_datum_ber[3], $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
            } else {
                $einlage2_bis3 = verzinsungEinlage($this->einlage_ber[2][$sk], $_SESSION["einlagedatum"][2], $einlage_datum_ber[3], $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
            }
            $AGH_einkauf_mit[3] = $AGH_einkauf[3]+$einlage1_bis3 + $einlage2_bis3;
            $this->einlage_ber[3][$sk] = max(min($_SESSION["einlage"][3], $maxEinkauf[3] - $AGH_einkauf_mit[3]),0);

            // Einlagen aufzinsen
            $alter = $GLOBALS["minPensalter"][$_SESSION["sex"]];
            for ($alter; $alter<=$GLOBALS["maxPensalter"][$_SESSION["sex"]]; $alter++) {
                $rueckdatum = returnDatum($_SESSION["geburtsdatum"][1], $_SESSION["geburtsdatum"][2]+$alter);
                for ($i=1; $i<=3; $i++) {
                    if ($_SESSION["einlagedatum"][$i][2]==$_SESSION["stichdatum"][2]) {
                        $einlage_verzinst[$i][$alter] = verzinsungEinlage($this->einlage_ber[$i][$sk], $_SESSION["einlagedatum"][$i], $rueckdatum, $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
                    } else {
                        $einlage_verzinst[$i][$alter] = verzinsungEinlage($this->einlage_ber[$i][$sk], $_SESSION["einlagedatum"][$i], $rueckdatum, $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
                    }
                }
            }

            for ($i=1; $i<=3; $i++) {
                if ($_SESSION["einlagedatum"][$i][2] == $_SESSION["stichdatum"][2]) {
                    $einlage_verzinst_gewaehlt[$i] = verzinsungEinlage($this->einlage_ber[$i][$sk], $_SESSION["einlagedatum"][$i], $_SESSION["pensdatum"], $_SESSION["zins1"]/100, $_SESSION["zins2"]/100);
                } else {
                    $einlage_verzinst_gewaehlt[$i] = verzinsungEinlage($this->einlage_ber[$i][$sk], $_SESSION["einlagedatum"][$i], $_SESSION["pensdatum"], $_SESSION["zins2"]/100, $_SESSION["zins2"]/100);
                }
            }


            // Berechnung Altersleistung unter Berücksichtigung der Einlagen in allen Altern
            for ($alter=$GLOBALS["minPensalter"][$_SESSION["sex"]]; $alter<=$GLOBALS["maxPensalter"][$_SESSION["sex"]]; $alter++) {
                $rueckdatum = returnDatum($_SESSION["geburtsdatum"][1], $_SESSION["geburtsdatum"][2]+$alter);
                $summe_einlagen["$alter"] = $einlage_verzinst[1]["$alter"] + $einlage_verzinst[2]["$alter"] + $einlage_verzinst[3]["$alter"];
                $this->AGH["$alter"][$sk] = $summe_einlagen["$alter"] + $basic->AGH["$alter"][$sk];
                $this->AGH["$alter"][$sk] = runden($this->AGH["$alter"][$sk], $GLOBALS["rundung"]);
                $this->AR["$alter"][$sk] = Altersrente($_SESSION["geburtsdatum"], $rueckdatum, $this->AGH["$alter"][$sk], $_SESSION["sex"]);
                $this->AR["$alter"][$sk] = runden($this->AR["$alter"][$sk], $GLOBALS["rundung"]);
            }

            if ($sk == $_SESSION["beitragsskala_alt"]) {
                //Im gewaehlten Rücktrittsalter
                $summe_einlagen_gewaehlt = $einlage_verzinst_gewaehlt[1] + $einlage_verzinst_gewaehlt[2] + $einlage_verzinst_gewaehlt[3];
            }
        }

		// Im gewaehlten Rücktrittsalter
		$this->AGH_gewaehlt = $basic->AGH_gewaehlt + $summe_einlagen_gewaehlt;
		$this->AGH_gewaehlt = runden($this->AGH_gewaehlt, $GLOBALS["rundung"]);
		$this->AR_gewaehlt = Altersrente($_SESSION["geburtsdatum"], $_SESSION["pensdatum"], $this->AGH_gewaehlt, $_SESSION["sex"]);
		$this->AR_gewaehlt = runden($this->AR_gewaehlt, $GLOBALS["rundung"]);
		
	}
	
}
?>