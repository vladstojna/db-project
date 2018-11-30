<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>

<style>
	.scrollable {
		height: 70%;
		width: 100%;
		overflow-y: auto;
		padding-right: 10pt;
	}
</style>

<body>

<a href="../../index.html"> ~ Back </a>

<p> <?=$status?> </p>

<form id="form" action="" method="POST">
	<label for="nameInput"> Medium Name </label>
	<input id="nameInput" type="text" name="medium_name" placeholder="Name..." required>

	<label for="entityInput"> Entity </label>
	<select id="entityInput" name="entity_name" form="form">
<?php foreach($select as $value): ?>
		<option value="<?=$value?>"> <?=$value?> </option>
<?php endforeach ?>
	</select>

	<input type="submit" value="Insert">
</form>

<h3> <?=$caption?> </h3>

<div class="scrollable">
<table>
	<tr>
<?php foreach($columns as $col): ?>
		<th> <?=$col?> </th>
<?php endforeach ?>
	</tr>
<?php foreach($result as $row): ?>
	<tr>
	<?php foreach($row as $value): ?>
		<td> <?=$value?> </td>
	<?php endforeach ?>
	</tr>
<?php endforeach ?>
</table>
</div>

</body>
</html>

