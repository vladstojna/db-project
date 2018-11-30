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

<form action=""  method="POST">
	<label for="in"> Entity </label>
	<input id="in" type="text" name="entity_name" placeholder="Name..." required>
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

