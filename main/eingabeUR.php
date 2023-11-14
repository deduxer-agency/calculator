
<div class="positionContent"> 

	<a name="wahlUR"></a>

	<form name = "WeiterUR" action = "?language=<?php sprache()?>#wahlUR" method = "post" >
		<input type="hidden" name="page" id="page" value="ur<?php echo $_POST["page"]; ?>">
		
		<div class="keinDruck">
			<table class="main2" cellspacing="0">
				<colgroup><col class="col21"><col class="col22"><col class="col23"><col class="col24"><col class="col25"><col class="col26"><col class="col27"><col class="col28"><col class="col29"></colgroup>
				<tr><td class="col21"></td><td class="col22"></td><td class="col23"></td><td class="col24"></td><td class="col25"></td><td class="col26"></td><td class="col27"></td><td class="col28"></td><td class="col29"></td></tr>
				<tr>
					<td colspan="9" class="markiert2OhneDruck" height="23px">
						<b><?php echo $languageDB["lweitereBerechnungen"]; ?>&nbsp;<font color="#dc582c">
							<?php
								if($_POST["page"]=="einkauf") {
									echo $languageDB["lmitEinkauf"];
								} else if($_POST["page"]=="vorbezug") {
									echo $languageDB["lmitVorbezug"];
								} else {
									echo $languageDB["lohneEinkauf"];
								}
							?>
						</font></b>
					</td>
				</tr>
				<tr><td class="zwischenzeile"></td></tr>
				<tr>
					<td colspan = "9" class="markiert2OhneDruck">
						<b> <?php echo $languageDB["lfreiwaehlbarUR"]; ?>&nbsp;<font color="#dc582c">
							<?php
								if($_POST["page"]=="einkauf") {
									echo $languageDB["lmitEinkauf"];
								} else if($_POST["page"]=="vorbezug") {
									echo $languageDB["lmitVorbezug"];
								} else {
									echo $languageDB["lohneEinkauf"];
								}
							?>
						</font></b>
					</td>
				</tr>
			</table>
			
			<?php if(isset($fehler2) && $fehler2){; ?>
				<table class="main2" cellspacing="0" >
					<tr>
						<td colspan = "9" class="keinDruck"> <small>
							<a href="javascript:void(0)" onClick="einblenden('ausblenden5b'); ausblenden('einblenden5b'); return toggleMe('tabelleEingabeUR')" id = "einblenden5b" ><?php echo $languageDB["lwahlUREin"]; ?></a>
							<a href="javascript:void(0)" onClick="einblenden('einblenden5b'); ausblenden('ausblenden5b'); return toggleMe('tabelleEingabeUR')" id = "ausblenden5b" style="display:none;"><?php echo $languageDB["lwahlURAus"]; ?></a>
						</small></td>
					</tr>
				</table>
			<?php } else { ?>
				<table class="main2" cellspacing="0" >
					<tr>
						<td colspan = "9" class="keinDruck"> <small>
							<a href="javascript:void(0)" onClick="einblenden('ausblenden5b'); ausblenden('einblenden5b'); return toggleMe('tabelleEingabeUR')" id = "einblenden5b" style="display:none;"><?php echo $languageDB["lwahlUREin"]; ?></a>
							<a href="javascript:void(0)" onClick="einblenden('einblenden5b'); ausblenden('ausblenden5b'); return toggleMe('tabelleEingabeUR')" id = "ausblenden5b" ><?php echo $languageDB["lwahlURAus"]; ?></a>
						</small></td>
					</tr>
				</table>			
			<?php } ?>
		</div>

		<div id ="tabelleEingabeUR" style="display:block;">
		
			<?php include("shared/tabelleEingabeUR.php"); ?>
			
		</div>
	</form>

</div>
