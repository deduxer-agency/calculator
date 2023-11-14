<?php

	/************************************************************************
	 * Einlesen der Sprachdatenbanken
	************************************************************************/
	$row = 0;
	$line = array();
	
	$languageDBpath = dirname(__FILE__)."/languageDB.csv";
	if(!file_exists($languageDBpath)) {
		echo "Konnte Sprachdatenbank-Datei nicht finden.";
		exit;
	}

	$handle = fopen($languageDBpath, "r");
	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		array_shift($data);        // Das erste Element aus $data entfernen
		$line[$row] = $data;       // im array $line zwischenspeichern
		$row++;
	}
	fclose($handle);

	$line[0] = array_map("trim", $line[0]);  // trim (entferne Leerzeichen vorne und hinten) wird in jedem Element von $line[0] ausgeführt
	$line[1] = array_map("htmlspecialchars_decode", array_map("htmlentities", array_map("trim", $line[1]), array_fill(0, count($line[1]), 0), array_fill(0, count($line[1]), 'UTF-8')) );
	//$line[2] = array_map("htmlspecialchars_decode", array_map("htmlentities", array_map("trim", $line[2]), array_fill(0, count($line[2]), 0), array_fill(0, count($line[2]), 'UTF-8')) );
	$line[3] = array_map("htmlspecialchars_decode", array_map("htmlentities", array_map("trim", $line[3]), array_fill(0, count($line[3]), 0), array_fill(0, count($line[3]), 'UTF-8')) );
	$line[4] = array_map("htmlspecialchars_decode", array_map("htmlentities", array_map("trim", $line[4]), array_fill(0, count($line[4]), 0), array_fill(0, count($line[4]), 'UTF-8')) );

	$DB_de = array_combine($line[0],$line[1]);
	//$DB_en = array_combine($line[0],$line[2]);
	$DB_fr = array_combine($line[0],$line[3]);
	$DB_it = array_combine($line[0],$line[4]);
	

	

	
	



	if( false) {
		echo "<table><tr><td>Schlüssel</td><td>Wert</td></tr>\n";
		foreach( $DB_de as $key => $value) {
			echo "<tr><td>&laquo;".$key."&raquo;</td><td>&laquo;".$value."&raquo;</td></tr>\n";
		}
		echo "</table>\n";
	}
	/***********************************************************************/


	if( isset($_GET["language"]) ) {
		$language =$_GET["language"];
	} else {
		$_GET["language"] = "de";
		$language="de";
	}

	switch($_GET["language"]) {
	case "code":
		$languageDB = $DB_code;
		break;
	case "de":
		$languageDB = $DB_de;
		break;
	case "fr":
		$languageDB = $DB_fr;
		break;
	case "en":
		$languageDB = $DB_en;
		break;
	case "it":
		$languageDB = $DB_it;
		break;
	default:
		$keys = array_keys($DB_de);
		$languageDB = array_fill_keys_construct($keys, "ERR!");
			
	}

	function array_fill_keys_construct($array,$values) {
		if(is_array($array)) {
			foreach($array as $key => $value) {
				$arraydisplay[$array[$key]] = $values;
			}
		}
		return $arraydisplay;
	}

// Hier alle Schlüssel eintragen, die im Glossar Erscheinen sollen und falls sie im Text vorkommen verlinkt sind

	$glosKey = array("lvl","lProjektionszinssatz","lbeitr","laltersguthaben2","lEinlageUWS","lLeistungen","lUWSkurz","lpensionierungper","lgewuenschteAltersleistung2","lir","ler","lkr","ltl","lFZL","lWEF","lregl","lPK","lglVorb","lglEink","lUR");//);//
// "Vernünftig" sortieren ä = aumlaut
	foreach( $glosKey as  $value){
	$glos_sortiert [$value]= ltrim($languageDB[$value],"&");
	}
	asort($glos_sortiert);
//Die Languagevariable mit den Links füllen 

	foreach ($glos_sortiert as $key => $value){
	if (basename(realpath('.'))=="infoseiten")
	{$glospath="Info_Glossar.php?language=".$language."&keyword=".$key;}
	else{
	$glospath="infoseiten/Info_Glossar.php?language=".$language."&keyword=".$key." target=_blank";}
	$glosText[$key] =$languageDB[$key];
	$glosLink[$key] = "<a href= $glospath >".$glosText[$key]."</a>";
	
	}
	
	foreach ($glosLink as $key => $value){
	$languageDB[$key] = $glosLink[$key];
	}
		if( false) {
		echo "<table><tr><td>Schlüssel</td><td>Wert</td></tr>\n";
		foreach( $glosLink  as $key => $value) {
			echo "<tr><td>&laquo;".$key."&raquo;</td><td>&laquo;".$value."&raquo;</td><td>&laquo;".$languageDB[$key]."&raquo;</td></tr>\n";
		}
		echo "</table>\n";
	}

	$sprachArr = array(
		"XXahvruecktrittsalter_mXX" => $GLOBALS["ahvruecktrittsalter"]["Mann"],
		"XXahvruecktrittsalter_wXX" => $GLOBALS["ahvruecktrittsalter"]["Frau"],
		"XXmaxAHVRenteXX" => number_format($GLOBALS["maxAHVRente"],0,".","'"),
		"XXmaxAHVRenteMonatXX" => number_format($GLOBALS["maxAHVRente"]/12,0,".","'"),
		"XXminLohnXX" => number_format($GLOBALS["minimumVersicherterLohn"],0,".","'"),
		"XXmaxLohnXX" => number_format($GLOBALS["maximumVersicherterLohn"],0,".","'"),
		"XXminAghXX" => number_format($GLOBALS["minAgh"],0,".","'"),
		"XXmaxAghXX" =>number_format($GLOBALS["maxAgh"],0,".","'"),
		"XXmaxEinlageXX" =>number_format($GLOBALS["maxEinlage"],0,".","'"),
		"XXminAlterXX" => $GLOBALS["minimumAlter"],
		"XXmaxAlterXX" => $GLOBALS["maximumAlter"],
		"XXminPensAlter_wXX" => $GLOBALS["minPensalter"]["Frau"],
		"XXminPensAlter_mXX" => $GLOBALS["minPensalter"]["Mann"],
		"XXmaxPensAlter_wXX" => $GLOBALS["maxPensalter"]["Frau"],
		"XXmaxPensAlter_mXX" => $GLOBALS["maxPensalter"]["Mann"],
		"XXminStichdatumXX" => $GLOBALS["fruehestesStichdatum"],
		"XXminUwsXX" => number_format($GLOBALS["minUws"],2,".","'"),
		"XXmaxUwsXX" =>number_format($GLOBALS["maxUws"],2,".","'"),
		"XXminARXX" =>number_format(0.05*$GLOBALS["maxAHVRente"],0,".","'"),
		"XXjahrAktuellXX"=>$GLOBALS["jahrAktuell"],
	);

?>