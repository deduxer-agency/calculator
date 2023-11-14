
	<a name="wahlUR"></a>

	<div class="positionContent">

	<table class="main2" cellspacing="0" >
        <colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"></colgroup>
		<tr><td class="cola1"></td><td class="cola2"></td><td class="cola3"></td><td class="cola4"></td><td class="cola5"></td><td class="cola6"></td></tr>
		<tr>
			<td colspan = "6" class = "markiert" height="23px">
				<b><?php echo $languageDB["lBerechnungPens"]; ?>&nbsp;<font color="#dc582c">
					<?php
						if($_POST["page"]=="ureinkauf") {
							echo $languageDB["lmitEinkauf"];
						} else if($_POST["page"]=="urvorbezug") {
							echo $languageDB["lmitVorbezug"];
						} else {
							echo $languageDB["lohneEinkauf"];
						}
					?>
				</font></b>
			</td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
		
		<!--  Ausgabe Tabelle Altersleistung mit gewählter Überbrückungsrente, Kapital, Monatsrente  -->
		<?php if ($basic -> alter_pensdatum < $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]) {?>
			<tr>
				<td colspan="4"><?php echo $languageDB["lURgewuenscht"]; ?></td> 
				<td align="right">CHF</td>
				<td align="right"><?php ausgabe_Stellen($_SESSION["UeRgewuenscht"], 0) ;?></td>
			</tr>
		<?php } ?>    
		<?php if ($_SESSION["wahl"]=="Kapitalbezug"){ ?>
			<tr>
				<td colspan="4"><?php echo $languageDB["lgewuenschterKapitalbezug"]; ?></td> 
				<td align="right">CHF</td>
				<td align="right"><?php ausgabe_Stellen($_SESSION["Kapitalgewuenscht"], 0) ;?></td>
			</tr>
		<?php } else { ?>
			<tr>
				<td colspan="4"><?php echo $languageDB["lgewuenschteAltersrente"]; ?></td> 
				<td align="right">CHF</td>
				<td align="right"><?php ausgabe_Stellen($_SESSION["Monatsrentegewuenscht"], 0) ;?></td>
			</tr>
		<?php } ?>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan = "6">
				<b><?php echo $languageDB["lLeistungPens"]; ?>&nbsp;<font color="#ff0000">
					<?php
						if($_POST["page"]=="ureinkauf") {
							echo $languageDB["lmitEinkauf"];
						} else if($_POST["page"]=="urvorbezug") {
							echo $languageDB["lmitVorbezug"];
						} else {
							echo $languageDB["lohneEinkauf"];
						}
					?>
				</font></b>
			</td>
		</tr>
		<tr><td colspan="6"><?php echo $languageDB["linCHF"];?></td></tr>
	</table>
	
	
	<!-- Leistung bei Pensionierung -->
    <table class="main3_wahl" cellspacing="0">
		<colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"></colgroup>
		<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
		<tr>
			<td colspan="5" class="linksoben"><b><?php echo $languageDB["lberuecksichtigterKapitalbezug"]; ?></b></td>
			<td align="right" class="rechtsoben"><b><?php ausgabe_Stellen($ur->Kapital_beruecksichtigt, 2); ?></b></td>
		</tr>
		<tr>
			<td colspan="6" class="linksrechts">&nbsp;</td>
		</tr>
		<!-- Kopfzeile pro Monat/Jahr -->
		<tr>
			<td colspan="4" align="left" class="linksunten">&nbsp;</td>
			<td align="right" class="linksunten"><?php echo $languageDB['lmonatlich']; ?></td>
			<td align="right" class="linksrechtsunten"><?php echo $languageDB['ljaehrlich']; ?></td>
		</tr>
		<!-- Altersrente -->
		<tr>
			<td colspan="4" align="left" class="links"><?php echo $languageDB["lARlebenslang"]; ?></td>
			<td align="right" class="links"><?php ausgabe_Stellen($ur->AR_ungekuerzt, 0); ?></td>
			<td align="right" class="linksrechts"><?php ausgabe_Stellen(round($ur->AR_ungekuerzt)*12, 0); ?></td>
		</tr>
		<?php if ($basic->alter_pensdatum < $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]) {
			if($_SESSION["wahl"]=="Kapitalbezug") { ?>
				<!-- Kürzung -->
				<tr>
					<td colspan="4" align="left" class="linksunten"><?php echo $languageDB["lKuerzung"];?></td>
					<td align="right" class="linksunten"><?php if($ur->AR_kuerzung>0){echo "-";} ausgabe_Stellen($ur->AR_kuerzung, 0) ;?></td>
					<td align="right" class="linksrechtsunten"><?php if($ur->AR_kuerzung>0){echo "-";} ausgabe_Stellen(round($ur->AR_kuerzung)*12, 0) ;?></td>
				</tr>
				<!-- Gekürzte Altersrente -->
				<tr>
					<td colspan="4" align="left" class="links"><?php echo $languageDB["lARlebenslangGekuerzt"];?></td>
					<td align="right" class="links"><?php ausgabe_Stellen($ur->AR_gekuerzt, 0) ;?></td>
					<td align="right" class="linksrechts"><?php ausgabe_Stellen(round($ur->AR_gekuerzt)*12, 0) ;?></td>
				</tr>
			<?php } ?>
			<!-- Überbrückungsrente -->
			<tr>
				<td colspan="4" align="left" class="links">
					<?php if($_SESSION["sex"] == "Mann") {
						echo strtr($languageDB['lURbisAHV_m'],$GLOBALS["sprachArr"]);
					} else {
						echo strtr($languageDB['lURbisAHV_w'],$GLOBALS["sprachArr"]);
					}
					?>
				</td>
				<td align="right" class="links"><?php ausgabe_Stellen($_SESSION["UeRgewuenscht"], 0) ;?></td>
				<td align="right" class="linksrechts"><?php ausgabe_Stellen(round($_SESSION["UeRgewuenscht"])*12, 0) ;?></td>
			</tr>
		<?php } ?>
		<!-- Total -->
		<tr>
			<td colspan="4" align="left" class="linksunten"><b><?php if($_SESSION["sex"] == "Mann") {
						echo strtr($languageDB['lTotalRenten_m'],$GLOBALS["sprachArr"]);
					} else {
						echo strtr($languageDB['lTotalRenten_w'],$GLOBALS["sprachArr"]);
					}
					?></b></td>
			<td align="right" class="linksunten"><b><?php ausgabe_Stellen($ur->AR_gekuerzt+$_SESSION["UeRgewuenscht"], 0); ?></b></td>
			<td align="right" class="linksrechtsunten"><b><?php ausgabe_Stellen(round($ur->AR_gekuerzt+$_SESSION["UeRgewuenscht"])*12, 0); ?></b></td>
		</tr>
		<tr><td colspan="6"></td></tr>
    
    </table>
	
	
	<!-- Darstellung mit eingesetztem Guthaben
        <?php /* 
	<table class="main3_wahl" cellspacing="0">
        <colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"><col class="cola7"><col class="cola8"><col class="cola9"><col class="cola10"></colgroup>
        <tr><td class="cola1"></td><td class="cola2"></td><td class="cola3"></td><td class="cola4"></td><td class="cola5"></td><td class="cola6"></td><td class="cola7"></td><td class="cola8"></td><td class="cola9"></td><td class="cola10"></td></tr>
		<tr >
				<td class="linksoben" colspan="7"><?php echo $languageDB["laltersguthaben2"];?></td>
				<td align="right" colspan ="3" class="rechtsoben"><?php echo ausgabe_Stellen($altersleistung -> AGH_gewaehlt, 2) ;?></td>
		</tr>
		<tr >
				<td class="links" colspan="7"><b><?php echo $languageDB["lTotalGuthaben"];?></b></td>
				<td align="right" colspan ="3" class="rechts"><b><?php echo ausgabe_Stellen($altersleistung -> AGH_gewaehlt, 2) ;?></b></td>
		</tr>
		<tr><td colspan="10" class="linksrechts">&nbsp;</td></tr>
		<tr>
			<td colspan="4" align="left" class="links">&nbsp;</td>
			<td colspan="2" align="right" class="links"><b><?php echo $languageDB["lmonatlich"];?></b></td>
			<td colspan="2" align="right" ><b><?php echo $languageDB["ljaehrlich"];?></b></td>
			<td colspan="2" align="right" class="linksrechts"><b><?php echo $languageDB["leingesetztesGuthaben"];?></b></td>
		</tr>
		<tr>
			<td colspan="4" align="left" class="links"><?php echo $languageDB["lARlebenslang"];?></td>
			<td colspan="2" align="right" class="links"><?php echo ausgabe_Stellen($ur -> AR_beruecksichtigt, 0) ;?></td>
			<td colspan="2" align="right" ><?php echo ausgabe_Stellen(round($ur -> AR_beruecksichtigt)*12, 0) ;?></td>
			<td colspan="2" align="right" class="linksrechts"><?php echo ausgabe_Stellen($ur -> AGH_beruecksichtigt, 2) ;?></td>
		</tr>
		<?php if ($basic -> alter_pensdatum < $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]) {?>
			<?php if ($_SESSION["sex"] =="Mann") {?>
			<tr>
				<td colspan="4" align="left" class="links"><?php echo strtr($languageDB['lURbisAHV_m'],$GLOBALS["sprachArr"]);?></td>
				<td colspan="2" align="right" class="links"><?php echo ausgabe_Stellen($_SESSION["UeRgewuenscht"], 0) ;?></td>
				<td colspan="2" align="right" ><?php echo ausgabe_Stellen(round($_SESSION["UeRgewuenscht"])*12, 0) ;?></td>
				<td colspan="2" align="right" class="linksrechts"><?php echo ausgabe_Stellen($ur -> KapitalFuerUR, 2) ;?></td>
			</tr>
			<?php } else {?>
			<tr>
				<td colspan="4" align="left" class="links"><?php echo strtr($languageDB['lURbisAHV_w'],$GLOBALS["sprachArr"]);?></td>
				<td colspan="2" align="right" class="links"><?php echo ausgabe_Stellen($_SESSION["UeRgewuenscht"], 0) ;?></td>
				<td colspan="2" align="right" ><?php echo ausgabe_Stellen(round($_SESSION["UeRgewuenscht"])*12, 0) ;?></td>
				<td colspan="2" align="right" class="linksrechts"><?php echo ausgabe_Stellen($ur -> KapitalFuerUR, 2) ;?></td>
			</tr>
			<?php } ?>
		<?php } ?>
		<tr>
			<td colspan="4" align="left" class="links"><?php echo $languageDB["lKapitalauszahlung"];?></td>
			<td colspan="2" align="right" class="links">&nbsp;</td>
			<td colspan="2" align="right" >&nbsp;</td>
			<td colspan="2" align="right" class="linksrechts"><?php echo ausgabe_Stellen($ur -> KGH_beruecksichtigt, 2) ;?></td>
		</tr>
		<tr><td colspan="4" align="left" class="linksunten"><b><?php echo $languageDB["lTotaleingesetztesGuthaben"];?></b></td>
			<td colspan="2" align="right" class="linksunten">&nbsp;</td>
			<td colspan="2" align="right" class="unten">&nbsp;</td>
			<td colspan="2" align="right" class="linksrechtsunten"><b><?php echo ausgabe_Stellen($ur -> KapitalEingesetzt, 2) ;?></b></td>
		</tr>
		<tr><td colspan="10"></td></tr>

	</table>
        */ ?>
	-->