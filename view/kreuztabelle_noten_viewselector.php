<div style="float:right;background:#afa;padding: 2px 8px;margin-left: 10px;">
Anzeigen: 
<select onchange="location.search='?datei='+ScriptInfo.Datei.did+'&viewMode='+this.value">
  <option value="meine_Kurse" <?= $_GET["viewMode"] == "meine_Kurse" ? "selected" : "" ?>>Eigene Kurse</option>
  
  <option value="Tutorengruppe" <?= $_GET["viewMode"] == "Tutorengruppe" ? "selected" : "" ?>>Meine Tutorengruppe</option>
  <option value="alle_Kurse" <?= $_GET["viewMode"] == "alle_Kurse" ? "selected" : "" ?>>Alle Kurse</option>
</select>

<?php if($_GET["viewMode"] == "Tutorengruppe"): ?>

<select onchange="location.search='?datei='+ScriptInfo.Datei.did+'&viewMode=Tutorengruppe&t_grp='+this.value">
<?php foreach($TutorengruppenListe as $d) echo "<option value=\"$d[kuid]\">$d[name]</option>"; ?>
</select>

<?php endif; ?>

</div>