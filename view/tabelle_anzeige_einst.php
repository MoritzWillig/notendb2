
<style>
td,th {padding-top: 10px;vertical-align:top}
</style>

<form action="<?= URL_PREFIX . $MethodURL ?>?datei=<?=$DID?>" method="post">

<table>

<tr><th colspan=2>Tabelle "Zuordnung"</th></tr>

<tr><td>
  Anzuzeigende Kurse:
</td><td>
  <input type="radio" name="zuordnung_filter_kurse" value="0"<?=$Config["zuordnung_filter_kurse"]?"":"checked"?>> Alle Kurse anzeigen<br>
  <input type="radio" name="zuordnung_filter_kurse" value="1"<?=$Config["zuordnung_filter_kurse"]?"checked":""?>> Nur Kurse anzeigen, bei denen ich als Lehrer eingetragen bin<br>
  
  
  <input type="radio" name="zuordnung_filter_kurse" value="2"<?=$Config["zuordnung_filter_kurse"]==2?"checked":""?>> Nur folgenden Kurs anzeigen:
  <select name="zuordnung_filter_kurse_kuid">
  <?php foreach($MeineKurse as $d): ?>
  <option value="<?= $d["kuid"] ?>" <?= ($d["kuid"] == $Config["zuordnung_filter_kurse_kuid"]) ? "selected" : "" ?>><?= $d["art"] ?> <?= $d["name"] ?> (<?= $d["lehrer_namen"] ?>)</option>
  <?php endforeach; ?>
  </select><br>
</td></tr>


<tr><th colspan=2>Tabelle "Notenvergabe"</th></tr>

<tr><td>
  Anzuzeigende Kurse:
</td><td>
  <input type="radio" name="noten_filter_kurse" value="0"<?=$Config["noten_filter_kurse"]==0?"checked":""?>> Alle Kurse anzeigen<br>
  <input type="radio" name="noten_filter_kurse" value="1"<?=$Config["noten_filter_kurse"]==1?"checked":""?>> Nur Kurse anzeigen, bei denen ich als Lehrer eingetragen bin<br>

  <input type="radio" name="noten_filter_kurse" value="2"<?=$Config["noten_filter_kurse"]==2?"checked":""?>> Nur folgenden Kurs anzeigen:
  <select name="noten_filter_kurse_kuid">
  <?php foreach($MeineKurse as $d): ?>
  <option value="<?= $d["kuid"] ?>" <?= ($d["kuid"] == $Config["noten_filter_kurse_kuid"]) ? "selected" : "" ?>><?= $d["art"] ?> <?= $d["name"] ?> (<?= $d["lehrer_namen"] ?>)</option>
  <?php endforeach; ?>
  </select><br>
</td></tr>


<tr><td>
  Anzuzeigende Schüler:
</td><td>
  <input type="radio" name="noten_filter_schueler" value="0"<?=$Config["noten_filter_schueler"]?"":"checked"?>> Alle Schüler anzeigen<br>
  <input type="radio" name="noten_filter_schueler" value="1"<?=$Config["noten_filter_schueler"]?"checked":""?>> Nur Schüler anzeigen, die in mindestens einem meiner Kurse sind<br>
</td></tr>


<tr><th colspan=2><input type="submit" name="ok" value="   Speichern und zurück   "></th></tr>

</table>

</form>

