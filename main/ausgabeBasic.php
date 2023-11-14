<script type="text/javascript" language="JavaScript">
    function beitragsskala_altChanged() {
        document.getElementById("beitragsskala_form").submit();
	}
</script>

    <div align="left">
    <img src="bilder/logo.jpg" alt="Logo" >
    
	</div>
    <div class="keinDruck">
	<table class="main2" cellspacing="0">
		<colgroup><col class="col5"><col class="col6"></colgroup>
			<tr><td class="col5"></td><td class="col6"></td></tr>
			<tr>
				<td colspan="2" class="markiertOhneDruck" height="23px"><b><?php echo $languageDB["lversicherter"];?></b></td>
			</tr>
			<tr><td class="keinDruck">
				<small>
				<a href="javascript:void(0)" onClick="einblenden('ausblenden1'); ausblenden('einblenden1'); return toggleMe('tabelleAngabenVersicherter')" id = "einblenden1" style="display:none;"><?php echo $languageDB["langabenVersicherterEin"];?></a>
				<a href="javascript:void(0)" onClick="einblenden('einblenden1'); ausblenden('ausblenden1'); return toggleMe('tabelleAngabenVersicherter')" id = "ausblenden1"><?php echo $languageDB["langabenVersicherterAus"];?></a>
				</small></td>
			</tr>
    </table>
	</div>

	<div id="tabelleAngabenVersicherter">
    <table class="main2" cellspacing="0">
		<colgroup><col class="col5"><col class="col6"></colgroup>
	     <tr><td class="col5"></td><td class="col6"></td></tr>
         <tr><td colspan="2">
                 <table class="main2-druck" cellspacing="0" >
                     <tr>
                        <td class="nurDruck" height= "23px"><b><?php echo $languageDB["lversicherter"];?></b></td>
                     </tr>
                 </table>
             </td>
         </tr>
        <tr>
            <td><?php echo $languageDB["lgeburtsdatum"]; ?></td>
            <td align="right"><?php ausgabe_Datum($_SESSION["geburtsdatum"]);?></td>
		</tr>
		<tr>
            <td><?php echo $languageDB["lEintrittsdatum"]; ?></td>
            <td align="right"><?php ausgabe_Datum($_SESSION["eintrittsdatum"]);?></td>
		</tr>
		<tr>
            <td><?php echo $languageDB["lsex"]; ?></td>
            <td align="right">
					<?php if ($_SESSION["sex"]=="Mann"){
						echo $languageDB["lmaennlich"];
					}else {
						echo $languageDB["lweiblich"];
					}?>
			</td>
		</tr>
		<tr>
            <td><?php echo $languageDB["lvorsorgeausweisper"]; ?></td>
            <td align="right"><?php ausgabe_Datum($_SESSION["stichdatum"]);?></td>
		</tr>
        <tr><td class="zwischenzeile"></td></tr>
		<?php if($_SESSION["bg"]>0) { ?>
			<tr>
				<td><?php echo $languageDB["lBG"]; ?></td>
				<td align="right"><?php ausgabe_Prozent($_SESSION["bg"],0);?></td>
			</tr>
		<?php } ?>
		<tr>
            <td><?php echo $languageDB["lvl"]; ?></td>
            <td align="right"><?php ausgabe_CHF($_SESSION["vsLohn"]);?></td>
		</tr>
		<tr>
            <td><?php  echo $languageDB["laltersguthaben2"]." ";?><nobr><?php echo $languageDB["lAGHvorsorgeausweis2"];  ?></nobr></td>
            <td align="right"><?php ausgabe_CHF($_SESSION["AGH"]);?></td>
		</tr>
        <tr>
            <td><?php echo $languageDB["lBeitragsskala"]; ?></td>
            <td>
                <form id="beitragsskala_form" action="index.php?language=<?php sprache() ?>" method="post">
                    <input type="hidden" name="page" value="<?php echo $_POST["page"]; ?>" />
                    <div align="right">
                        <select size="1" onchange="beitragsskala_altChanged();" name="beitragsskala_alt" id="beitragsskala_alt" <?php echo errors("beitragsskala_alt"); ?>><?php
                            for( $i=1; $i<=3 ;$i++ ) { ?>
                                <option value=<?php echo $i; ?> <?php echo ($i==$_SESSION["beitragsskala_alt"]?"selected":""); ?>><?php echo $languageDB[$lskala[$i]]; ?></option><?php 
                            }?>
                        </select>
                    </div>
                </form>
            </td>
        </tr>
        <tr><td class="zwischenzeile"></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
		<tr>
            <td><?php echo $languageDB["lZinserstesjahr"]; ?></td>
            <td align="right"><?php echo sprintf("%01.2f",$_SESSION["zins1"]/100);?>%</td>
		</tr>
		<tr>
            <td><?php echo $languageDB["lZinsfolgejahr"]; ?></td>
            <td align="right"><?php echo sprintf("%01.2f",$_SESSION["zins2"]/100);?>%</td>
		</tr>
		<tr>
            <td><?php echo $languageDB["llohnentwicklung"]; ?></td>
            <td align="right"><?php echo sprintf("%01.2f",$_SESSION["lohnErh"]/100);?>%</td>
		</tr>
        <tr><td class="zwischenzeile"></td></tr>
		<tr>
            <td><?php echo $languageDB["lpensionierungper"]; ?></td>
            <td align="right"><?php ausgabe_Datum($_SESSION["pensdatum"]);?></td>
		</tr>
		<tr>
            <td><?php echo $languageDB["lruecktrittsalter"]; ?></td>
            <td align="right"><?php ausgabe_Alter_Worte($basic -> alter);?></td>
		</tr>
        <tr><td class="nurDruck"> &nbsp;  </td></tr>
    </table>
	</div>
	
    <!--  Ausgabe Beiträge  -->
    <form name= "infoBeiträge" action="infoseiten/Info_Beitraege.php?language=<?php sprache() ?>" method="post" target="_blank">
		<div class="keinDruck">
			<table class="main2" cellspacing="0">
				<colgroup><col class="col5"><col class="col6"></colgroup>
					<tr><td></td><td></td></tr>	
					<tr>
						<td colspan="1" class="markiertOhneDruck"><b><?php echo $languageDB["lbeitraege"];?> <?php echo $_SESSION["stichdatum"][2];?> <?php echo $languageDB["lArbeitnehmerArbeitgeber"];?></b></td>
						<td colspan="1" class="markiertOhneDruck"><div align="right">
							<input type="submit" class="pushbuttoninfo" name="" value="<?php echo $languageDB['lweitereInfos'];?>" title="<?php echo $languageDB['lInfoBeitraege'];?>">
						</div></td>
					</tr>
				 
					<tr>
						<td colspan="2" class="keinDruck"><small>
							<a href="javascript:void(0)" onClick="einblenden('ausblenden2'); ausblenden('einblenden2'); return toggleMe('tabelleBeitraege')" id = "einblenden2" style="display:none;"><?php echo $languageDB["lbeitraegeEin"];?></a>
							<a href="javascript:void(0)" onClick="einblenden('einblenden2'); ausblenden('ausblenden2'); return toggleMe('tabelleBeitraege')" id = "ausblenden2"><?php echo $languageDB["lbeitraegeAus"];?></a>
						</small></td>
					</tr>
			</table>
		</div>
        
		<div id ="tabelleBeitraege">
			<table class="main2" cellspacing="0" border="0">
				<colgroup><col class="colb1"><col class="colb2"><col class="colb3"><col class="colb4"><col class="colb5"><col class="colb6"></colgroup>
				<tr>
					<td colspan="6" style="padding-left: 0px; padding-right: 0px;">
						<table cellspacing="0" class="nurDruck"><tr><td>
							<b><?php echo $languageDB["lbeitraege"];?> <?php echo $_SESSION["stichdatum"][2];?> <?php echo $languageDB["lArbeitnehmerArbeitgeber"];?></b>
						</td></tr></table>
					</td>
				</tr>
				<tr><td colspan="6"><?php echo $languageDB["linCHF"];?></td></tr>
				<tr>
					<td class="linksoben"><b>&nbsp;</b></td>
					<td colspan="3" class="linksoben" align="center"><b><?php echo $languageDB["lAN"];?></b></td>
					<td colspan="2" class="linksrechtsoben" align="center"><b><?php echo $languageDB["lAG"];?></b></td>
				</tr>
				<tr align="center">
					<td class="linksunten">&nbsp;</td>
					<td class="linksunten" align="right"><?php echo $languageDB["linprozentenvomLohn"];?></td>
					<td class="unten" align="right"><?php echo $languageDB["lmonatlich"];?></td>
					<td class="unten" align="right"><?php echo $languageDB["ljaehrlich"];?></td>
					<td class="linksunten" align="right"><?php echo $languageDB["linprozentenvomLohn"];?></td>
					<td class="rechtsunten" align="right"><?php echo $languageDB["ljaehrlich"];?></td>
				</tr>
				
				<!-- laufendes Jahr -->
                <?php for( $i=1; $i<=3 ;$i++ ) { ?>
				<tr align="right" <?php echo ($i == $_SESSION["beitragsskala_alt"] ? 'class="markiert2"':'');?> >
					<td align="left" valign="top" class="links"><?php echo $languageDB["lsparbeitrag"]." ".$languageDB[$lskala[$i]];?></td>
					<td class="links"> <?php ausgabe_Stellen($basic -> beitrag_AN[$i]["prozent"],2);?>%</td>
					<td> <?php ausgabe_Stellen($basic -> beitrag_AN[$i]["monat"],2);?></td>
					<td> <?php ausgabe_Stellen($basic -> beitrag_AN[$i]["jahr"],2);?></td>
					<td class="links"> <?php ausgabe_Stellen($basic -> beitrag_AG["prozent"],2);?>%</td>
					<td class="rechts"> <?php ausgabe_Stellen($basic -> beitrag_AG["jahr"],2);?></td>
				</tr>
                <?php } ?>
				<tr align="right" >
					<td align="left" valign="top" class="linksunten"><?php echo $languageDB["lrisikobeitrag"];?></td>
					<td class="linksunten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AN["prozent"],2);?>%</td>
					<td class="unten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AN["monat"],2);?></td>
					<td class="unten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AN["jahr"],2);?></td>
					<td class="linksunten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AG["prozent"],2);?>%</td>
					<td class="rechtsunten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AG["jahr"],2);?></td>
				</tr>
                <tr align="right">
                    <td align="left" valign="top" class="linksunten"><?php echo $languageDB["ltotal"];?></td>
                    <td class="linksunten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AN["prozent"]+$basic -> beitrag_AN[$_SESSION["beitragsskala_alt"]]["prozent"],2);?>%</td>
                    <td class="unten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AN["monat"]+$basic -> beitrag_AN[$_SESSION["beitragsskala_alt"]]["monat"],2);?></td>
                    <td class="unten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AN["jahr"]+$basic -> beitrag_AN[$_SESSION["beitragsskala_alt"]]["jahr"],2);?></td>
                    <td class="linksunten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AG["prozent"]+$basic -> beitrag_AG["prozent"],2);?>%</td>
                    <td class="rechtsunten"> <?php ausgabe_Stellen($basic -> beitrag_risiko_AG["jahr"]+$basic -> beitrag_AG["jahr"],2);?></td>
                </tr>
			</table>
		</div>
    </form>
	

    <!--  Ausgabe Tabelle Altersleistung  -->
    <form name= "infoAltersleistung" action="infoseiten/Info_Altersleistung.php?language=<?php sprache()?>" method="post" target="_blank">
		<div class="keinDruck">
		<table class="main2" cellspacing="0">
			<colgroup><col class="col5"><col class="col6"></colgroup>
			<tr>
				<td colspan = "1" class = "markiertOhneDruck" height="23px"><b><?php echo $languageDB["lAGHRuecktritt"];?></b></td>
				<td colspan="1" align="right" class = "markiertOhneDruck" height="23px">
					<input type="submit" class="pushbuttoninfo" name="" value="<?php echo $languageDB['lweitereInfos'];?>" title="<?php echo $languageDB['lInfoAltersleistung'];?>">
				</td>
			</tr>
        </table>
		</div>
        
        <table class="main2" cellspacing="0">
			<colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"></colgroup>
			<tr><td class="cola1"></td><td class="cola2"></td><td class="cola3"></td><td class="cola4"></td><td class="cola5"></td><td class="cola6"></td></tr>
            <tr><td class="zwischenzeile"></td></tr>
            <tr>
                <td colspan = "6"><b><?php echo $languageDB["lgewaehltesRuecktrittsalter"];?></b>&nbsp;<?php echo $languageDB["lmitskala"];?>&nbsp;<?php echo $languageDB[$lskala[$_SESSION["beitragsskala_alt"]]];?></td>
            </tr>
            <tr><td colspan="6"><?php echo $languageDB["linCHF"];?></td></tr>
        </table>   
        
        <table class="main2" cellspacing="0">
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
						<td align="right"><?php ausgabe_Stellen_pos($basic -> AGH["$alter"][$_SESSION["beitragsskala_alt"]],0); ?></td>
						<td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS["$alter"]*100,2);?></td>
						<td align="right"><?php ausgabe_Stellen_pos($basic -> AR["$alter"][$_SESSION["beitragsskala_alt"]],0);?></td>
						<td align="right" class="rechts"><?php ausgabe_Stellen_pos(12*$basic -> AR["$alter"][$_SESSION["beitragsskala_alt"]],0);?></td>
					</tr>
					<?php 
					}
					if($basic -> alter["jahr"] == $alter ) { ?>
						<tr class="markiert2">
							<td class="links"><?php ausgabe_Alter_Zeichen($basic -> alter);?></td>
							<td align="right"><?php echo $_SESSION["pensdatum"][2];?></td>
							<td align="right"><?php ausgabe_Stellen_pos($basic -> Lohn_gewaehlt,0);?></td>
							<td align="right"><?php ausgabe_Stellen_pos($basic -> AGH_gewaehlt,0); ?></td>
							<td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS_gewaehlt*100,2);?></td>
							<td align="right"><?php ausgabe_Stellen_pos($basic -> AR_gewaehlt,0);?></td>
							<td align="right" class="rechts"><?php ausgabe_Stellen_pos(12*$basic -> AR_gewaehlt,0);?></td>
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
                <td align="right"><?php ausgabe_Stellen_pos($basic -> AGH["$alter"][$i],0); ?></td>
                <td align="right" class="links"><?php ausgabe_Prozent($basic -> UWS["$alter"]*100,2);?></td>
                <td align="right"><?php ausgabe_Stellen_pos($basic -> AR["$alter"][$i],0);?></td>
                <td align="right" class="rechts"><?php ausgabe_Stellen_pos(12*$basic -> AR["$alter"][$i],0);?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="7" class="oben" style="background-color:#FFFFFF"><small>&nbsp;</small></td>
            </tr>
		</table>
		<?php  ?>

		
        <table class="main2">
            <tr><td class="hinweis" align="justify"><?php echo $languageDB["lhinweis"];?></td></tr>
        </table>
        
    </form>


	<!--  Ausgabe mögliche Einlage-->
    <form name= "infoEinlage" action="infoseiten/Info_Einlage.php?language=<?php sprache()?>" method="post" target="_blank">
		<div class="keinDruck">
		<table class = "main2" cellspacing="0" >
			<colgroup><col class="col5"><col class="col6"></colgroup>
			<tr><td class="col5"></td><td class="col6"></td></tr>
            <tr>
                <td colspan="1" class="markiertOhneDruck" height="23px"><b><?php echo $languageDB["lAngabenzurEinlage"];?></b></td>
                <td colspan="1" align="right" class = "markiertOhneDruck" height="23px">
                    <input type="submit" class="pushbuttoninfo" name="" value="<?php echo $languageDB['lweitereInfos'];?>" title="<?php echo $languageDB['lInfoEinlage'];?>">
                </td>
            </tr>
		</table>
		</div>

		<div class="keinDruck">		
        <table class="main2" cellspacing="0">
            <colgroup><col class="cole1"><col class="cole2"><col class="cole3"></colgroup>
            <tr><td class="cole1"></td><td class="cole2"></td><td class="cole3"></td></tr>
            <tr>
                <td colspan = "3" class="keinDruck"> <small>
					<a href="javascript:void(0)" onClick="einblenden('ausblenden4'); ausblenden('einblenden4'); return toggleMe('tabelleEinkaufspotential')" id = "einblenden4" style="display:none;"><?php echo $languageDB["leinkaufspotentialEin"];?></a>
					<a href="javascript:void(0)" onClick="einblenden('einblenden4'); ausblenden('ausblenden4'); return toggleMe('tabelleEinkaufspotential')" id = "ausblenden4" ><?php echo $languageDB["leinkaufspotentialAus"];?></a>
				</small></td>
            </tr>
        </table>
		</div>
		
		<div id="tabelleEinkaufspotential">
        <table class = "main2" cellspacing="0">
            <colgroup>
				<col class="cole1">
				<col class="cole2">
				<col class="cole3">
                <col class="cole4">
			</colgroup>
			<tr>
				<td class="cole1"></td>
				<td class="cole2"></td>
                <td class="cole3"></td>
                <td class="cole4"></td>
			</tr>
            <tr>
				<td colspan = "4">
                    <table class="main2-druck" cellspacing="0">
                        <tr>
                            <td class="nurDruck" ><b>&nbsp;</b></td>
                        </tr>
                        <tr>
                            <td class="nurDruck" ><b><?php echo $languageDB["lAngabenzurEinlage"];?></b></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td ></td>
                <?php for ($i=1;$i<=3;$i++) {?>
                <td align="right"><?php echo $languageDB[$lskala[$i]]; ?></td>
                <?php } ?>
            </tr>      
            <tr>
				<td><?php echo $languageDB["lmaxGuthaben"];?></td>
                <?php for ($i=1;$i<=3;$i++) {?>
                <td align="right" class="<?php echo ($i==$_SESSION["beitragsskala_alt"]?"markiert2":""); ?>"><?php ausgabe_CHF($basic -> max_einkauf[$i],0);?></td>
                <?php } ?>
            </tr>
            <tr>
				<td><b><?php echo $languageDB["lmaxEinkauf"];?></b></td>
                <?php for ($i=1;$i<=3;$i++) {?>
                <td align="right" class="<?php echo ($i==$_SESSION["beitragsskala_alt"]?"markiert2":""); ?>"><b><?php ausgabe_CHF($basic -> max_moegl_einkauf[$i],0);?></b></td>
                <?php } ?>
            </tr>
			
            <tr><td colspan="4" class="zwischenzeile"></td></tr>
			
            <tr><td colspan="4" class="hinweis"><?php echo $languageDB["lbemerkungEinkaufEinleitung"];?></td></tr>
            <tr><td colspan="4" class="zwischenzeile keinDruck"></td></tr>
			<tr>
                <td colspan = "4" class="keinDruck"> <small class="keinDruck">
						<a href="javascript:void(0)" onClick="einblenden('ausblendenBemEinkauf'); ausblenden('einblendenBemEinkauf'); return toggleMe('tabelleBemerkungEinkauf')" id = "einblendenBemEinkauf" ><?php echo $languageDB["leinkaufBemerkungEin"];?></a>
						<a href="javascript:void(0)" onClick="einblenden('einblendenBemEinkauf'); ausblenden('ausblendenBemEinkauf'); return toggleMe('tabelleBemerkungEinkauf')" id = "ausblendenBemEinkauf" style="display:none;"><?php echo $languageDB["leinkaufBemerkungAus"];?></a>
                </small></td>
            </tr>
		</table>
		</div>
		
		<div id="tabelleBemerkungEinkauf" style="display:none">
		<table class="main2" cellspacing="0">
			<colgroup><col class="cole1"><col class="cole2"><col class="cole3"></colgroup>
			<tr><td class="cole1"></td><td class="cole2"></td><td class="cole3"></td></tr>
			<tr>
				<td colspan="3"><small><?php echo $languageDB["lbemerkungEinkauf"];?></small></td>
			</tr>
			<tr>
				<td valign="top">&bull;</td>
				<td colspan ="2"><small><?php echo $languageDB["lbemerkungEinkauf1"];?></small></td>
			</tr>
			<tr>
				<td valign="top">&bull;</td>
				<td colspan ="2"><small><?php echo $languageDB["lbemerkungEinkauf2"];?></small></td>
			</tr>
			<tr>
				<td valign="top">&bull;</td>
				<td colspan ="2"><small><?php echo $languageDB["lbemerkungEinkauf3"];?></small></td>
			</tr>
			<tr>
				<td valign="top">&bull;</td>
				<td colspan ="2"><small><?php echo $languageDB["lbemerkungEinkauf4"];?></small></td>
			</tr>
		</table>
		</div>
		
    </form>

