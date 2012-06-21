
<form action="<?= URL_PREFIX ?>admin/lehrer/new?datei=<?= $DID ?>" method="post" style="float:right;margin-top:10px">
<input type="submit" name="create" value="Erstellen"></form>



<h3>Lehrerliste</h3>

<hr>

<table width=700>
<tr><th>Kürzel</th><th>Name</th><th>Aktion</th></tr>
<?php foreach($Lehrer as $d): ?>
<tr>
<td><?= $d["kuerzel"] ?></td>
<td><?= $d["anrede"] ?> <?= $d["vorname"] ?> <?= $d["name"] ?></td>
<td><a href="<?= URL_PREFIX ?>admin/lehrer/<?= $d["lid"] ?>?datei=<?= $DID ?>">Bearbeiten</a></td>
<td><a href="<?= URL_PREFIX ?>admin/set_password/<?= $d["lid"] ?>?datei=<?= $DID ?>">Passwort setzen</a></td>
<td><a href="<?= URL_PREFIX ?>admin/su/<?= $d["lid"] ?>">S.U.</a></td>
</tr>
<?php endforeach; ?>
</table>

<hr>


<?php if ($IsAdmin) { ?>
<h3>Lehrer Importieren</h3>
<form action="<?= URL_PREFIX ?>admin/lehrer_import?datei=<?= $DID ?>" enctype="multipart/form-data" method="post">
<input type="file" name="file"></input>
<input type="submit" name="create" value="Importieren"></form>
<?php } ?><br>


