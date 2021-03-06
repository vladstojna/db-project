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

<h3> <?=$title?> </h3>

<div class="scrollable">
<table>
	<tr>
<?php foreach($columns as $col): ?>
		<th> <?=$col?> </th>
<?php endforeach ?>
	</tr>
<?php foreach($result as $index => $row): ?>
	<tr>
	<?php foreach($row as $key => $value): ?>
		<td> <?=$value?> </td>
	<?php endforeach ?>

		<td>
			<select name="<?=$name?>" form="<?=$index?>">
	<?php foreach($process as $p): ?>
				<option value="<?=$p[$name]?>">Process <?=$p[$name]?></option>
	<?php endforeach ?>
			</select>
		</td>

		<td>
			<form id="<?=$index?>" action="" method="POST">
	<?php foreach($inputs as $in): ?>
				<input type="hidden" name="<?=$in?>" value="<?=$row[$in]?>"/>
	<?php endforeach ?>
				<input type="submit" value="Associate"/>
			</form>
		</td>

	</tr>
<?php endforeach ?>
</table>
</div>

</body>

</html>

