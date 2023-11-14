
<div class="positionContent"> 

	<table class="main2" cellspacing="0">
		<colgroup><col class="col21"><col class="col22"><col class="col23"><col class="col24"><col class="col25"><col class="col26"><col class="col27"><col class="col28"><col class="col29"></colgroup>
		<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9" class="markiert2OhneDruck" height="23px"><div class="keinDruck"><b><?php echo $languageDB["lTitelWeitereBerechnungen"]; ?></b></div></td>
		</tr>
		<tr>
			<td colspan="9">
				<table class="main2-druck" cellspacing="0" >
					<tr>
						<td class="nurDruck" height="23px"><b><?php echo $languageDB["lTitelWeitereBerechnungen"];?></b></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<div class="keinDruck">
	<table class="main2" cellspacing="0">
		<colgroup><col class="col21"><col class="col22"><col class="col23"><col class="col24"><col class="col25"><col class="col26"><col class="col27"><col class="col28"><col class="col29"></colgroup>
		<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9"><?php echo $languageDB["lTextWeitereBerechnungen"]; ?></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="9">
				<input type="button" class="pushbuttontab" id="buttonUR" onClick="activateUR()" value="<?php echo $languageDB["lButtonPensionierung"];?>">
				<input type="button" class="pushbuttontab" id="buttonEinkauf" onClick="activateEinkauf()" value="<?php echo $languageDB["lButtonEinkauf"];?>">
				<input type="button" class="pushbuttontab" id="buttonVorbezug" onClick="activateVorbezug()" value="<?php echo $languageDB["lButtonVorbezug"];?>">
			</td>
		</tr>
	</table>
	</div>


		<!----------------------------------------------------------------------------------------------------------------------
		<													Modul Überbrückungsrente
		<----------------------------------------------------------------------------------------------------------------------->

		<a name="wahlUR"></a>
		
		<form name = "WeiterUR" id = "WeiterUR" style="display:none;" action = "?language=<?php sprache()?>#wahlUR" method = "post" >
			<input type="hidden" name="page" id="page" value="ur">
			
			<div class="keinDruck">
			<table class="main2" cellspacing="0">
				<colgroup><col class="col21"><col class="col22"><col class="col23"><col class="col24"><col class="col25"><col class="col26"><col class="col27"><col class="col28"><col class="col29"></colgroup>
				<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr>
					<td colspan = "9" class="markiert2OhneDruck"><b> <?php echo $languageDB["lfreiwaehlbarUR"]; ?></b></td>
				</tr>
			</table>
			</div>
			
			<?php include("shared/tabelleEingabeUR.php"); ?>
			
        </form>

		
		
		<!----------------------------------------------------------------------------------------------------------------------
		<														Modul Einkauf
		<----------------------------------------------------------------------------------------------------------------------->

		<a name="einkauf"></a>
		
		<form name = "WeiterEinkauf" id = "WeiterEinkauf" style="display:none;" action = "?language=<?php sprache()?>#einkauf" method = "post" >
			<input type="hidden" name="page" id="page" value="einkauf">
			
			<div class="keinDruck">
			<table class="main2" cellspacing="0">
				<colgroup><col class="col21a"><col class="col22a"><col class="col23a"><col class="col24a"><col class="col25a"><col class="col26a"><col class="col27a"><col class="col28a"></colgroup>
				<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr>
					<td colspan = "8" class="markiert2OhneDruck"><b><?php echo $languageDB["lfreiwilligerEinkauf"]; ?></b></td>
				</tr>
			</table> 
			</div>
			
			<table class="main3_einkauf" cellspacing="0" id ="tabelleEingabeEinkauf" border="1">
				<colgroup><col class="col21a"><col class="col22a"><col class="col23a"><col class="col24a"><col class="col25a"><col class="col26a"><col class="col27a"><col class="col28a"></colgroup>
				<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr>
					<td colspan="8" style="padding-left: 0px; padding-right: 0px; background-color:#FFFFFF;">
						<table cellspacing="0" class="nurDruck">
							<tr><td><b><?php echo $languageDB["lfreiwilligerEinkauf"]; ?></b></td></tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan = "8"><b><?php echo $languageDB["lBemerkungEinkauf"]; ?></b></td>
				</tr>
				<tr><td colspan = "8"><?php echo $languageDB["lEinkaufEinleitung1"]; ?></td></tr>
				<tr><td colspan = "8" class="zwischenzeile"></td></tr>
				<tr><td colspan = "8" class="title"><?php echo $languageDB["lgewuenschterEinkauf"]; ?></td></tr>

				<tr><td colspan = "8" >
					
					<table class="main3_einkauf_weiter" cellspacing="0">
						<colgroup><col class="col21a"><col class="col22a"><col class="col23a"><col class="col24a"><col class="col25a"><col class="col26a"><col class="col27a"><col class="col28a"></colgroup>
						<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
					
						<!-- AGH Einlage 1 -->
						<tr>
							<td colspan="2">1. <?php echo $languageDB["leinkaufAGH"]; ?></td>
							<td align="right">CHF</td>
							<td colspan="1"><div align="right">
								<input type="text" name="AGHeinlage1" id="AGHeinlage1" size="10" maxlength="11" 
									title="<?php echo strtr($languageDB['leinkauf'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["einlage"][1];?>" <?php echo errors("einlage[1]");?>>
							</div></td>
							<td align="right"><?php echo $languageDB["leinkaufper"]; ?></td>
							<td>
								<div align="right"> <?php echo $languageDB["lendepensionierung"]; ?></div>
							</td>
							<td><div align="right">
								<select size="1" name="AGHeinlagemonat1" id="AGHeinlagemonat1">
									<?php
										for( $i=1; $i<=12; $i++ ) {
											if( $i==$_SESSION["einlagedatum"][1][1]) { ?>
												<option selected value = "<?php echo $i;?>" <?php echo errors("einlagemonat[1]") ; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
											<?php } else { ?>
												<option value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
											<?php }
										}
									?>
								</select></div>
							</td>
							<td><div align="right">
								<input type="text" name="AGHeinlagejahr1" id="AGHeinlagejahr1" size = "3" maxlength="4" 
									title="<?php echo strtr($languageDB['leinlagenach'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["einlagedatum"][1][2];?>" <?php echo errors("einlagejahr[1]") ?>>
							</div></td>
						</tr>
						
						<!-- AGH Einlage 2 -->
						<tr>
							<td colspan="2">2. <?php echo $languageDB["leinkaufAGH"]; ?></td>
							<td align="right">CHF</td>
							<td colspan="1"><div align="right">
								<input type="text" name="AGHeinlage2" id="AGHeinlage2" size="10" maxlength="11" 
									title="<?php echo strtr($languageDB['leinkauf'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["einlage"][2];?>" <?php echo errors("einlage[2]");?>>
							</div></td>
							<td align="right"><?php echo $languageDB["leinkaufper"]; ?></td>
							<td>
								<div align="right"><?php echo $languageDB["lendepensionierung"]; ?></div>
							</td>
							<td><div align="right">
								<select size="1" name="AGHeinlagemonat2" id="AGHeinlagemonat2">
									<?php
										for( $i=1; $i<=12; $i++ ) {
											if( $i==$_SESSION["einlagedatum"][2][1]) { ?>
												<option selected value = "<?php echo $i;?>" <?php echo errors("einlagemonat[2]") ; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
											<?php } else { ?>
												<option value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
											<?php }
										}
									?>
								</select></div>
							</td>
							<td><div align="right">
								<input type="text" name="AGHeinlagejahr2" id="AGHeinlagejahr2" size = "3" maxlength="4" 
									title="<?php echo strtr($languageDB['leinlagenach'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["einlagedatum"][2][2];?>" <?php echo errors("einlagejahr[2]") ?>>
							</div></td>
						</tr>
						
						<!-- AGH Einlage 3 -->
						<tr>
							<td colspan="2">3. <?php echo $languageDB["leinkaufAGH"]; ?></td>
							<td align="right">CHF</td>
							<td colspan="1"><div align="right">
								<input type="text" name="AGHeinlage3" id="AGHeinlage3" size="10" maxlength="11" 
									title="<?php echo strtr($languageDB['leinkauf'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["einlage"][3];?>" <?php echo errors("einlage[3]");?>>
							</div></td>
							<td align="right"><?php echo $languageDB["leinkaufper"]; ?></td>
							<td>
								<div align="right"><?php echo $languageDB["lendepensionierung"]; ?></div>
							</td>
							<td><div align="right">
								<select size="1" name="AGHeinlagemonat3" id="AGHeinlagemonat3">
									<?php
										for( $i=1; $i<=12; $i++ ) {
											if( $i==$_SESSION["einlagedatum"][3][1]) { ?>
												<option selected value = "<?php echo $i;?>" <?php echo errors("einlagemonat[3]") ; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
											<?php } else { ?>
												<option value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
											<?php }
										}
									?>
								</select></div>
							</td>
							<td><div align="right">
								<input type="text" name="AGHeinlagejahr3" id="AGHeinlagejahr3" size = "3" maxlength="4" 
									title="<?php echo strtr($languageDB['leinlagenach'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["einlagedatum"][3][2];?>" <?php echo errors("einlagejahr[3]") ?>>
							</div></td>
						</tr>
						<tr><td colspan = "8" class="zwischenzeile"></td></tr>
					</table>
				</td></tr>
                
				<tr><td class="zwischenzeile" colspan = "8"></td></tr>

				<tr><td colspan ="8"><small><?php echo $languageDB["lbemerkungEinkauf2Kontakt"];?></small></td></tr>

				<?php if(isset($einlage -> fehler_Einlage) && $einlage -> fehler_Einlage){; ?>
					<tr>
						<td colspan = "5" id = "HinweisFelder"><div class="markiertFehler"><?php echo strtr($languageDB['lcheck'],$GLOBALS["sprachArr"]);?></div></td>
						<td colspan = "3">&nbsp;</td>
					</tr>
				<?php } ?>
				
				<?php if(isset($einlage -> fehler_datum) && $einlage -> fehler_datum){ ?>
					<tr>
						<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerdatum'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($einlage -> fehler_einlageWert) && $einlage -> fehler_einlageWert){ ?>
					<tr>
						<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerEinkauf'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($einlage -> fehler_datumEinlage) && $einlage -> fehler_datumEinlage){ ?>
					<tr>
						<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerEinkaufDatum'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($einlage -> fehler_datumEinlageAGH) && $einlage -> fehler_datumEinlageAGH){ ?>
					<tr>
						<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerEinkaufAGH'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($einlage -> fehler_datumEinlage2) && $einlage -> fehler_datumEinlage2){ ?>
					<tr>
						<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerEinkaufReihenfolge'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<tr><td class="zwischenzeile" colspan = "8"></td></tr>

				<tr>
					<td colspan="8">						
						<div align="left" class="keinDruck">
							<input type="submit" class="pushbuttonlong" value="<?php echo $languageDB['ldweiterEinkauf']?>">
						</div>
					</td>
				</tr>			
			</table> 
		</form>

		

		<!----------------------------------------------------------------------------------------------------------------------
		<														Modul Vorbezug
		<----------------------------------------------------------------------------------------------------------------------->

		<a name="vorbezug"></a>
		
 		<form name = "WeiterVorbezug" id = "WeiterVorbezug" style="display:none;" action = "?language=<?php sprache()?>#vorbezug" method = "post" >
			<input type="hidden" name="page" id="page" value="vorbezug">
			
			<div class="keinDruck">
			<table class="main2" cellspacing="0">
				<colgroup><col class="col21a"><col class="col22a"><col class="col23a"><col class="col24a"><col class="col25a"><col class="col26a"><col class="col27a"><col class="col28a"></colgroup>
				<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr><td colspan = "8" class="markiert2OhneDruck"><b><?php echo $languageDB["lVorbezug"]; ?></b></td>
				</tr>
            </table> 
			</div>
			
			<table class="main3_einkauf" cellspacing="0" id ="tabelleEingabeVorbezug" border="1" style="display:block;">
				<colgroup><col class="col21a"><col class="col22a"><col class="col23a"><col class="col24a"><col class="col25a"><col class="col26a"><col class="col27a"><col class="col28a"></colgroup>
				<tr><td class="col21a"></td><td class="col22a"></td><td class="col23a"></td><td class="col24a"></td><td class="col25a"></td><td class="col26a"></td><td class="col27a"></td><td class="col28a"></td></tr>
				<tr><td colspan = "8" >
					<table class="main2-druck" cellspacing="0">
						<tr>
							<td class="nurDruck"><b><?php echo $languageDB["lVorbezug"]; ?></b></td>
						</tr>
					</table></td>
				</tr>
				<tr>
					<td colspan = "8"><b><?php echo $languageDB["lBemerkungVorbezug"]; ?></b></td>
				</tr>
				
				<?php if ( ($_SESSION["sex"] == "Mann" && $basic->alter_stichdatum >= $GLOBALS["maxAlterVorbezugMann"])
						|| ($_SESSION["sex"] == "Frau" && $basic->alter_stichdatum >= $GLOBALS["maxAlterVorbezugFrau"]) ){ ?>
					
					<tr><td colspan = "8"><?php echo $languageDB["lvorbezugNichtMoeglich"]; ?></tr>
				
				<?php } else { ?>
				
					<?php if ($basic -> alter_stichdatum >= 50){ ?>
						<tr><td colspan = "8"><?php echo $languageDB["lbemerkungVorbezug50"]; ?></tr>
					<?php } ?>
					
					<tr><td colspan="8" class="zwischenzeile"></td></tr>
					
					<tr>
						<td colspan="8"><div class="radio_WahlVorbezug"><label>
							<?php if ($_SESSION["wahlVorbezug"] == "WEF"){ ?>
								<input type="radio" name="wahlVorbezug" value = "WEF" class="radio_WahlVorbezug2" checked > 
							<?php } else { ?>
								<input type="radio" name="wahlVorbezug" value = "WEF" class="radio_WahlVorbezug2" >
							<?php } 
							echo $languageDB["lvorbezugWEF"]; ?>
						</label></div></td>
					</tr>
					<?php if ($basic -> alter_stichdatum >= 50){?>
						<tr>
							<td align="right">&nbsp;</td>
							<td colspan="1"><?php echo $languageDB["lFZL"]." ".$languageDB["lFZL50"]; ?></td>
							<td align="right">CHF</td>
							<td><div align="right"><input type="text" name="fzl50" id="fzl50" maxlength="11" title="<?php echo strtr($languageDB['lfzl'],$GLOBALS["sprachArr"]);?>" value="<?php echo $_SESSION["fzl50"];?>" <?php echo errors("fzl50");?>></div></td>
							<td colspan="3"><?php echo $languageDB["lamStichtag"]; ?></td>
							<td colspan="1" align="right"><div class="keinDruck">
									<input type="button" class="pushbuttoninfo"  onclick="javascript:window.open('infoseiten/Versicherungsausweis_FZL50_<?php sprache()?>.pdf#zoom=100', 'NeuesFenster', 'fullscreen=yes,status=yes,scrollbars=yes,resizable=yes');" title="<?php echo $languageDB['lMusterausweis'];?>" value="<?php echo $languageDB['lweitereInfos'];?>" > 
							</div></td>
						</tr>
					<?php } else { ?>
							<input type='hidden' name='fzl50' value='0' >
					<?php } ?>
					
					<tr><td colspan="8" class="zwischenzeile"></td></tr>
					
					<tr>
						<td colspan = "8"><div class="radio_WahlVorbezug"><label>
							<?php if ($_SESSION["wahlVorbezug"] == "Scheidung"){ ?>
								<input type="radio" name="wahlVorbezug" value = "Scheidung" class="radio_WahlVorbezug2" checked > 
							<?php } else { ?> 
								<input type="radio" name="wahlVorbezug" value = "Scheidung" class="radio_WahlVorbezug2" >
							<?php } 
							echo $languageDB["lvorbezugScheidung"]; ?>
						</label></div></td>
					</tr>
					
					<tr><td colspan="8" class="zwischenzeile"></td></tr>              
					
					<!-- Vorbezug Betrag -->               
					<tr><td colspan = "8" class="title"><b><?php echo $languageDB["lgewuenschterVorbezug"];?></b></td></tr>
					<tr>
						<td colspan="2"><?php echo $languageDB["lvorbezugHoehe"]; ?></td>
						<td align="right">CHF</td>
						<td colspan="1"><div align="right"><input type="text" name="vorbezug" id="vorbezug" maxlength="11" title="<?php echo strtr($languageDB['lvorbezugEingabe'],$GLOBALS["sprachArr"]);?>" value="<?php echo $_SESSION["vorbezug"];?>" <?php echo errors("vorbezug");?>></div></td>
						<td align="right"><?php echo $languageDB["lvorbezugper"]; ?></td>
						<td align="right">
							<div align="right"><?php echo $languageDB["lendepensionierung"]; ?></div>
						</td>
						<td align="right">
							<select name="vorbezugmonat" id="vorbezugmonat">
							<?php
								for( $i=1; $i<=12 ;$i++ ) {
									if( $i==$_SESSION["vorbezugdatum"][1]) { ?>
										<option selected value = "<?php echo $i;?>" <?php echo errors("vorbezugmonat") ; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
									<?php } else { ?>
										<option value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
									<?php }
								}
							?>
							</select>
						</td>
						<td>
							<div align="right">
								<input type="text" name="vorbezugjahr" id="vorbezugjahr" maxlength="4" 
									title="<?php echo strtr($languageDB['lvorbezugnach'],$GLOBALS["sprachArr"]);?>" 
									value="<?php echo $_SESSION["vorbezugdatum"][2]; ?>" <?php echo errors("vorbezugjahr") ?>>
							</div>
						</td>
					</tr>
					<tr><td colspan ="8" class="zwischenzeile"></td></tr>
					<tr><td colspan ="8"><small><?php echo $languageDB["lbemerkungVorbezugKontakt"]; ?></small></td></tr>
					
					<tr><td class="zwischenzeile" colspan = "8"></td></tr>
					
					<?php if(isset($vorbezug -> fehler_Vorbezug) && $vorbezug -> fehler_Vorbezug){ ?>
						<tr>
							<td colspan = "5" id = "HinweisFelder"><div class="markiertFehler"><?php echo strtr($languageDB['lcheck'],$GLOBALS["sprachArr"]);?></div></td>
							<td colspan = "3">&nbsp;</td>
						</tr>
					<?php } ?>
					
					<?php if(isset($vorbezug -> fehler_fzl) && $vorbezug -> fehler_fzl){ ?>
						<tr>
							<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerFZL'],$GLOBALS["sprachArr"]);?></small></div></td>
						</tr>
					<?php } ?>
					<?php if(isset($vorbezug -> fehler_datum) && $vorbezug -> fehler_datum){ ?>
						<tr>
							<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerdatum'],$GLOBALS["sprachArr"]);?></small></div></td>
						</tr>
					<?php } ?>
					<?php if(isset($vorbezug -> fehler_vorbezugWert) && $vorbezug -> fehler_vorbezugWert){ ?>
						<tr>
							<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small>
								<?php if ($_SESSION["wahlVorbezug"]=="WEF"){
									echo strtr($languageDB['lfehlerVorbezugWertWEF'],$GLOBALS["sprachArr"]);
								} else {
									echo strtr($languageDB['lfehlerVorbezugWertScheidung'],$GLOBALS["sprachArr"]);
								} ?>
							</small></div></td>
						</tr>
					<?php } ?>
					<?php if(isset($vorbezug -> fehler_datumVorbezug) && $vorbezug -> fehler_datumVorbezug){ ?>
						<tr>
							<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerVorbezugDatum'],$GLOBALS["sprachArr"]);?></small></div></td>
						</tr>
					<?php } ?>
					<?php if(isset($vorbezug -> fehler_datumWEF) && $vorbezug -> fehler_datumWEF){; ?>
						<tr>
							<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerVorbezugWEF'],$GLOBALS["sprachArr"]);?></small></div></td>
						</tr>
					<?php } ?>
					<?php if(isset($vorbezug -> fehler_datumScheidung) && $vorbezug -> fehler_datumScheidung){; ?>
						<tr>
							<td colspan = "8" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerVorbezugScheidung'],$GLOBALS["sprachArr"]);?></small></div></td>
						</tr>
					<?php } ?>			
					<tr><td class="zwischenzeile" colspan = "8"></td></tr>

					<tr><td colspan="8">
						<div align="left" class="keinDruck">
							<input type="submit" class="pushbuttonlong" value="<?php echo $languageDB['ldweiterVorbezug']?>">
						</div>
					</td></tr>
				<?php } ?>
            </table>

     	</form>

		<script type="text/javascript" language="JavaScript">
			<?php if(isset($ur -> fehler_Pens) && $ur -> fehler_Pens){ ?>
				activateUR();
			<?php } else if(isset($ur -> fehler_Einlage) && $ur -> fehler_Einlage){ ?>
				activateEinkauf();
			<?php } else if(isset($ur -> fehler_Vorbezug) && $ur -> fehler_Vorbezug){ ?>
				activateVorbezug();
			<?php } else { ?>
				if(window.location.hash=='#wahlUR') {
					activateUR();
				} else if(window.location.hash=='#einkauf') {
					activateEinkauf();
				} else if(window.location.hash=='#vorbezug') {
					activateVorbezug();
				} else {
					//nop
				}
			<?php } ?>	
			// function refreshMaxValues(){
			// var UeRgewuenscht = 0;
					

				// }
				// refreshMaxValues();
		</script>

</div>
