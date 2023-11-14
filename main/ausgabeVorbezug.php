
<div class="positionContent">
	
	<a name="vorbezug"></a>

   	<table class="main2" cellspacing="0">
		<colgroup>
			<col class="col5">
			<col class="col6">
		</colgroup>
        <tr>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td colspan = "2" class = "markiert" height="23px"><b>
				<?php 
				if ($_SESSION["wahlVorbezug"]=="WEF"){
					echo $languageDB["lBerechnungNachVorbezugWEF"];
				} else {
					echo $languageDB["lBerechnungNachVorbezugScheidung"];
				}
				?>
			</b></td>
		</tr>
	</table>
	
	
	
	<table class = "main2" cellspacing="0">
		<colgroup>
			<col class="cole1">
			<col class="cole2">
			<col class="cole3">
		</colgroup>
		<tr><td></td><td></td><td></td></tr>
		<tr>
			<td colspan="3" class="nurDruck"><b>&nbsp;</b></td>
		</tr>
		<tr>
			<td colspan="3" style="padding-left: 0px; padding-right: 0px; background-color:#FFFFFF;">
				<table cellspacing="0" class="nurDruck">
					<tr><td>
						<b><?php echo $languageDB["lAngabenzumVorbezug"]; ?></b>
					</td></tr>
				</table>
			</td>
		</tr>
		<?php if ($_SESSION["wahlVorbezug"] == "Scheidung") { ?>
			<tr>
				<td colspan="2">
					<?php echo $languageDB["lGuthabenper"]; ?>&nbsp;<?php ausgabe_Datum($_SESSION["vorbezugdatum"]); ?>
				</td>
				<td align="right"><?php ausgabe_CHF($vorbezug -> AGH_vorbezug[$_SESSION["beitragsskala_alt"]]); ?></td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo $languageDB["lvorbezugHoehe"]; ?>&nbsp;<?php echo $languageDB["lvorbezugper"]; ?>&nbsp;<?php ausgabe_Datum($_SESSION["vorbezugdatum"]); ?>
				</td>
				<td align="right"><?php ausgabe_CHF($_SESSION["vorbezug"]); ?></td>
			</tr>
			<tr>
				<td colspan="2" class="zwischenzeile"></td>
				<td align="right" class="zwischenzeile"></td>
			</tr>
			<tr>
				<td colspan="2"><b><?php echo $languageDB["lberuecksichtigterVorbezug"]; ?></b></td>
				<td align="right"><b><?php ausgabe_CHF($vorbezug -> vorbezug_ber[$_SESSION["beitragsskala_alt"]]); ?></b></td>
			</tr>
			<tr>
				<td colspan = "3" class="oben">
					<small>&nbsp;</small>
				</td>
			</tr>
		<?php 
		} else { ?>
			
			<tr>
				<td colspan="2">
					<?php echo $languageDB["lGuthabenper"]; ?>&nbsp;<?php ausgabe_Datum($_SESSION["vorbezugdatum"]); ?>
				</td>
				<td align="right"><?php ausgabe_CHF($vorbezug -> AGH_vorbezug[$_SESSION["beitragsskala_alt"]]); ?></td>
			</tr>
			<?php if ($basic-> alter_stichdatum >= 50) { ?>
				<tr>
					<td colspan="2"><?php echo $languageDB["lFZL50"]; ?></td>
					<td align="right"><?php ausgabe_CHF($vorbezug -> fzl50_berechnet[$_SESSION["beitragsskala_alt"]]); ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="3" class="zwischenzeile"></td>
			</tr>		
			<?php if ($vorbezug -> vorbezug_ber[$_SESSION["beitragsskala_alt"]] == $_SESSION["vorbezug"]) { ?>
				<tr>
					<td colspan="2"><b><?php echo $languageDB["lvorbezugHoehe"]; ?>&nbsp;<?php echo $languageDB["lvorbezugper"]; ?>&nbsp;<?php ausgabe_Datum($_SESSION["vorbezugdatum"]); ?></b></td>
					<td align="right"><b><?php ausgabe_CHF($_SESSION["vorbezug"]); ?></b></td>
				</tr>
			<?php } else {?>
				<tr>
					<td colspan="2"><?php echo $languageDB["lvorbezugHoehe"]; ?>&nbsp;<?php echo $languageDB["lvorbezugper"]; ?>&nbsp;<?php ausgabe_Datum($_SESSION["vorbezugdatum"]); ?></td>
					<td align="right"><?php ausgabe_CHF($_SESSION["vorbezug"]); ?></td>
				</tr>
				<tr>
					<td colspan="3" class="zwischenzeile"></td>
				</tr>
				<tr>
					<td colspan="2"><b><?php echo $languageDB["lBemerkungberuecksichtigteVorbezug"]; ?></b></td>
					<td align="right"><b><?php ausgabe_CHF($vorbezug -> vorbezug_ber[$_SESSION["beitragsskala_alt"]]); ?></b></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan = "3" class="oben">
					<small>&nbsp;</small>
				</td>
			</tr>
		<?php } ?>
		
		<tr><td class="nurDruck"><small>&nbsp;</small></td></tr>
			
		<!--  Ausgabe Tabelle Altersleistung mit Vorbezug -->
		<tr>
			<td colspan = "6">
				<b>
					<?php echo $languageDB["lgewaehltesRuecktrittsalter"];?>
					<font color="#ff0000">
						<?php echo $languageDB["lmitVorbezug"]?>
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
		<tr>
			<td colspan="10">
				<?php echo $languageDB["linCHF"];?>
			</td>
		</tr>
	</table>

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
					<td class="links"><?php echo $alter; ?></td>
					<td align="right"><?php echo  $_SESSION["geburtsdatum"][2]+$alter;?></td>
					<td align="right"><?php ausgabe_Stellen_pos($basic -> Lohn["$alter"], 0); ?></td>
					<td align="right"><?php ausgabe_Stellen_pos($vorbezug -> AGH["$alter"][$_SESSION["beitragsskala_alt"]], 0); ?></td>
					<td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS["$alter"]*100, 2); ?></td>
					<td align="right"><?php ausgabe_Stellen_pos($vorbezug -> AR["$alter"][$_SESSION["beitragsskala_alt"]], 0); ?></td>
					<td align="right" class="rechts"><?php ausgabe_Stellen_pos(12*$vorbezug -> AR["$alter"][$_SESSION["beitragsskala_alt"]], 0); ?></td>
				</tr>
			<?php 
			}
			if($basic -> alter["jahr"] == $alter ) { ?>
				<tr class="markiert2">
						<td class="markiert2links"><?php ausgabe_Alter_Zeichen($basic -> alter);?></td>
						<td class="markiert2"align="right"><?php echo $_SESSION["pensdatum"][2];?></td>
						<td class="markiert2" align="right"><?php ausgabe_Stellen_pos($basic -> Lohn_gewaehlt,0);?></td>
						<td class="markiert2" align="right"><?php ausgabe_Stellen_pos($vorbezug -> AGH_gewaehlt,0); ?></td>
						<td class="markiert2links" align="right"><?php ausgabe_Prozent($basic -> UWS_gewaehlt*100,2);?></td>
						<td class="markiert2" align="right"><?php ausgabe_Stellen_pos($vorbezug -> AR_gewaehlt,0);?></td>
						<td class="markiert2rechts"align="right" ><?php ausgabe_Stellen_pos(12*$vorbezug -> AR_gewaehlt,0);?></td>
					</tr>
			<?php } 
		} ?>
		
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
            <td align="right"><?php ausgabe_Stellen_pos($vorbezug -> AGH["$alter"][$i],0); ?></td>
            <td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS["$alter"]*100,2);?></td>
            <td align="right"><?php ausgabe_Stellen_pos($vorbezug -> AR["$alter"][$i],0);?></td>
            <td align="right" class="rechts"><?php ausgabe_Stellen_pos(12*$vorbezug -> AR["$alter"][$i],0);?></td>
        </tr>
        <?php } ?>
		<tr>
			<td colspan = "7" class="oben" style = "background-color:#FFFFFF">
				<small>&nbsp;</small>
			</td>
		</tr>
	</table>
		
	<?php  ?>
		
	<table class="main2">
		<tr><td class="hinweis" align="justify"><?php echo $languageDB["lhinweis"];?></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
	</table>
		
</div>
