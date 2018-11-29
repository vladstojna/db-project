<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>

<style>
	div {
		height: 50%;
		width: 60%;
		overflow-y: auto;
		padding-right: 10pt;
	}
</style>

<body>

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)): ?>
<p> <?=$status?> </p>
<?php endif ?>

<h3> <?=$title?> </h3>

<div>
<table>
	<caption> <?=$caption?> </caption>
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

		<td>
			<form action="" method="GET">
	<?php foreach($inputs as $in): ?>
				<input type="hidden" name="<?=$in?>" value="<?=$row[$in]?>"/>
	<?php endforeach ?>
				<input type="submit" value="<?=$prompt?>"/>
			</form>
		</td>

	</tr>
<?php endforeach ?>
</table>
</div>

</body>

</html>

