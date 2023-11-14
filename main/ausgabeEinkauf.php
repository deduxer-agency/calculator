
<div class="positionContent">

	<a name="einkauf"></a>
		<table class="main2" cellspacing="0">
		<colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6" ></colgroup>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<tr>
				<td colspan = "6" class = "markiert" height="23px"><b><?php echo $languageDB["lBerechnungNachEinkauf"]; ?></b></td>
			</tr>
            <tr><td class="zwischenzeile"></td></tr>
        </table>
		
		<!--  Ausgabe Tabelle berücksichtigter Einkauf  -->
		<table class="main2" cellspacing="0">
			<colgroup>
				<col class="cola1">
				<col class="cola2">
				<col class="cola3">
				<col class="cola4">
				<col class="cola5">
				<col class="cola6">
				<col class="cola7">
				<col class="cola8">
				<col class="cola9">
				<col class="cola10">
			</colgroup>
			<tr>
				<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			</tr>
			<tr>
				<td colspan = "6"><b><font color="#ff0000"><?php echo $languageDB["lAltersleistungmitEinkauf"]; ?></font></b></td>
			</tr>
			<tr><td class="zwischenzeile"></td></tr>
			<tr>
				<td colspan = "6"><?php echo $languageDB["lberuecksichtigterEinkauf"]; ?></td>
			</tr>
			<tr><td class="zwischenzeile"></td></tr>
			<tr><td colspan = "6"><?php echo $languageDB["lBemerkungberuecksichtigteEinkaeufe"]; ?></td></tr>
			<tr><td class="zwischenzeile"></td></tr>

			<?php if (!(($_SESSION["einlage"][1]>0) || ($_SESSION["einlage"][2]>0) || ($_SESSION["einlage"][3]>0))){ ?>
				<tr><td colspan = "6"><?php echo $languageDB["lkeinEinkauf"]; ?></td></tr> 
			<?php } ?>
			<?php for ($i=1; $i<=3; $i++){ ?>
				<?php if ($_SESSION["einlage"][$i]>0){ ?>
					<tr>
						<td colspan="2"><?php echo $languageDB["leinkaufper"]; ?> &nbsp;<?php ausgabe_Datum($_SESSION["einlagedatum"][$i]);?></td>
						<td align ="right">CHF</td> 
						<td align="right"><?php ausgabe_Stellen($einlage -> einlage_ber[$i][$_SESSION["beitragsskala_alt"]],0);?></td>
						<td colspan="2"></td>
					</tr>
				<?php } ?>
			<?php }?>

			<tr><td class="zwischenzeile"></td></tr>
			<tr><td class="nurDruck"><small>&nbsp;</small></td></tr>
			
			<!--  Ausgabe Tabelle Altersleistung mit Einkauf -->
			<tr>
				<td colspan = "6">
					<b>
						<?php echo $languageDB["lgewaehltesRuecktrittsalter"];?>
						<font color="#ff0000">
							<?php echo $languageDB["lmitEinkauf"]?>
						</font>
					</b>&nbsp;<?php echo $languageDB["lmitskala"];?>&nbsp;<?php echo $languageDB[$lskala[$_SESSION["beitragsskala_alt"]]];?>
				</td>
			</tr>
			<tr>
				<td colspan = "6">
					<table class="main2-druck" cellspacing="0">
						<tr>
							<td class="nurDruck"><b><?php echo $languageDB["lweitereRuecktrittsalter"];?>&nbsp;
								<font color="#ff0000"><?php echo $languageDB["lmitEinkauf"]?></font></b>&nbsp;<?php echo $languageDB["lmitskala"];?>&nbsp;<?php echo $languageDB[$lskala[$_SESSION["beitragsskala_alt"]]];?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="10"><?php echo $languageDB["linCHF"];?></td></tr>
<?php /*		<tr><td>&nbsp;</td></tr> */ ?>
		</table>
<?php /*		
		<table class="main3_einkauf" cellspacing="0">
			<colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"></colgroup>
			<tr>
				<td class="linksoben"><b><?php echo $languageDB["lalter"];?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["lversLohn"];?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["laltersguthaben2"];?></b></td>
				<td align="right" class="linksoben"><b><?php echo $languageDB["lUWSkurz"];?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["laltersrente"];?></b></td>
				<td align="right" class="rechtsoben"><b><?php echo $languageDB["laltersrentejahr"];?></b></td>
			</tr>
			<tr>
				<td colspan="3" class="linksunten">&nbsp;</td>
				<td colspan="2" class="linksunten"><small><?php echo $languageDB["lumwandlungssatz"];?></small></td>
				<td colspan="1" class="rechtsunten">&nbsp;</td>
			</tr>
			<tr>
				<td class="linksunten"><?php ausgabe_Alter_Zeichen($basic -> alter);?></td>
				<td align="right" class="unten"><?php ausgabe_Stellen_pos($basic -> Lohn_gewaehlt,0);?></td>
				<td align="right" class="unten"><?php ausgabe_Stellen_pos($einlage -> AGH_gewaehlt,0);?></td>
				<td align="right" class="linksunten"><?php ausgabe_Prozent($basic -> UWS_gewaehlt*100,4);?></td>
				<td align="right" class="unten" ><?php ausgabe_Stellen_pos($einlage -> AR_gewaehlt,0);?></td>
				<td align="right" class="rechtsunten"><?php ausgabe_Stellen_pos(12 * $einlage -> AR_gewaehlt,0);?></td>
			</tr>
		</table>
		
		<br/>
        
		<div class="keinDruck">
		<table class="main2" cellspacing="0" >
            <colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"><col class="cola7"><col class="cola8"><col class="cola9"><col class="cola10"></colgroup>
            <tr><td class="zwischenzeile"></td></tr>
            <tr>
                <td colspan = "6" class="keinDruck"><b><?php echo $languageDB["lweitereRuecktrittsalter"];?>
                    <font color="#ff0000"><?php echo $languageDB["lmitEinkauf"]?></font></b>
					<a href="javascript:void(0)" onClick="einblenden('ausblenden9'); ausblenden('einblenden9'); return toggleMe('tabelleWeitereAlter2')" id = "einblenden9" ><?php echo $languageDB["leinblenden"];?></a>
					<a href="javascript:void(0)" onClick="einblenden('einblenden9'); ausblenden('ausblenden9'); return toggleMe('tabelleWeitereAlter2')" id = "ausblenden9" style="display:none;"><?php echo $languageDB["lausblenden"];?></a>
                </td>
            </tr>
			<tr><td class="zwischenzeile"></td></tr>
        </table>
		</div>

		<div id="tabelleWeitereAlter2">
		<table class="main2">
			<tr>
				<td colspan = "6">
					<table class="main2-druck" cellspacing="0">
						<tr>
							<td class="nurDruck"><b><?php echo $languageDB["lweitereRuecktrittsalter"];?>&nbsp;
								<font color="#ff0000"><?php echo $languageDB["lmitEinkauf"]?></font></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td colspan="6"><?php echo $languageDB["linCHF"];?></td></tr>
		</table>
*/ ?>
		<table class="main3_einkauf" cellspacing="0">
			<colgroup>
				<col class="cola1">
				<col class="cola2">
				<col class="cola3">
				<col class="cola4">
				<col class="cola5">
				<col class="cola6">
				<col class="cola7">
			</colgroup>
			<tr>
				<td class="cola1"></td>
				<td class="cola2"></td>
				<td class="cola3"></td>
				<td class="cola4"></td>
				<td class="cola5"></td>
				<td class="cola6"></td>
				<td class="cola7"></td>
			</tr>
			<tr>
				<td class="linksoben"><b><?php echo $languageDB["lalter"];?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["lJahr"]?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["lvl"];?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["laltersguthaben2"];?></b></td>
				<td align="right" class="linksoben"><b><?php echo $languageDB["lUWSkurz"];?></b></td>
				<td align="right" class="oben"><b><?php echo $languageDB["laltersrente"];?></b></td>
				<td align="right" class="rechtsoben"><b><?php echo $languageDB["laltersrentejahr"];?></b></td>
			</tr>
			
			<tr>
				<td colspan="4" class="linksunten"><small>&nbsp;</small></td>
				<td colspan="1" align="right"class="linksunten"><small><?php echo $languageDB["lumwandlungssatz"];?></small></td>
				<td colspan="1" align="right"class="unten"><small>&nbsp;</small></td>
				<td class="rechtsunten"><small>&nbsp;</small></td>
			</tr>
			<?php
				for ($alter=$GLOBALS["minPensalter"][$_SESSION["sex"]]; $alter<=$GLOBALS["maxPensalter"][$_SESSION["sex"]]; $alter++){ 
					if($basic -> alter["jahr"] != $alter || ($basic -> alter["jahr"] == $alter && $basic -> alter["monat"] != 0)) { ?>
						<tr>
							<td class="links"><?php echo $alter;?></td>
							<td align="right"><?php echo  $_SESSION["geburtsdatum"][2]+$alter;?></td>
							<td align="right"><?php ausgabe_Stellen_pos($basic -> Lohn["$alter"],0);?></td>
							<td align="right"><?php ausgabe_Stellen_pos($einlage -> AGH["$alter"][$_SESSION["beitragsskala_alt"]],0);?></td>
							<td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS["$alter"]*100,2);?></td>
							<td align="right"><?php ausgabe_Stellen_pos($einlage -> AR["$alter"][$_SESSION["beitragsskala_alt"]],0);?></td>
							<td align="right" class="rechts"><?php ausgabe_Stellen_pos(12 * $einlage -> AR["$alter"][$_SESSION["beitragsskala_alt"]],0);?></td>
						</tr>
					<?php 
					}
					if($basic -> alter["jahr"] == $alter ) { ?>
						<tr class="markiert2">
							<td class="markiert2links"><?php ausgabe_Alter_Zeichen($basic -> alter);?></td>
							<td class="markiert2"align="right"><?php echo $_SESSION["pensdatum"][2];?></td>
							<td class="markiert2" align="right"><?php ausgabe_Stellen_pos($basic -> Lohn_gewaehlt,0);?></td>
							<td class="markiert2" align="right"><?php ausgabe_Stellen_pos($einlage -> AGH_gewaehlt,0); ?></td>
							<td class="markiert2links" align="right"><?php ausgabe_Prozent($basic -> UWS_gewaehlt*100,2);?></td>
							<td class="markiert2" align="right"><?php ausgabe_Stellen_pos($einlage -> AR_gewaehlt,0);?></td>
							<td class="markiert2rechts"align="right" ><?php ausgabe_Stellen_pos(12*$einlage -> AR_gewaehlt,0);?></td>
						</tr>
				<?php } 
				}
			?>

            <tr>
                <td colspan="7" class="oben unten" style="background-color:#FFFFFF"><small>&nbsp;</small></td>
            </tr>
            <?php for( $i=1; $i<=3 ;$i++ ) {
                      $alter = 65;
            ?>
            <tr>
                <td class="links"><?php echo $alter;?></td>
                <td align="right"><?php echo  $_SESSION["geburtsdatum"][2]+$alter;?></td>
                <td align="right"><?php ausgabe_Stellen_pos($basic -> Lohn["$alter"],0);?></td>
                <td align="right"><?php ausgabe_Stellen_pos($einlage -> AGH["$alter"][$i],0); ?></td>
                <td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS["$alter"]*100,2);?></td>
                <td align="right"><?php ausgabe_Stellen_pos($einlage -> AR["$alter"][$i],0);?></td>
                <td align="right" class="rechts"><?php ausgabe_Stellen_pos(12*$einlage -> AR["$alter"][$i],0);?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="7" class="oben" style="background-color:#FFFFFF">
                    <small>&nbsp;</small>
                </td>
            </tr>
        </table>
		<?php  ?>
		</table>
        <table class="main2">
            <tr><td class="hinweis" align="justify"><?php echo $languageDB["lhinweis"];?></td></tr>
			<tr><td class="zwischenzeile"></td></tr>
        </table>
		
</div>
