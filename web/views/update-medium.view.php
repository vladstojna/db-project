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
			<input type="text" name="<?=$m_name?>" form="<?=$index?>" placeholder="<?=$placeholder?>">
		</td>

		<td>
			<select name="<?=$name?>" form="<?=$index?>">
	<?php foreach($entity_filter[$index] as $entity_name): ?>
				<option value="<?=$entity_name?>"><?=$entity_name?></option>
	<?php endforeach ?>
			</select>
		</td>

		<td>
			<form id="<?=$index?>" action="" method="GET">
	<?php foreach($inputs as $in): ?>
				<input type="hidden" name="<?=$in?>" value="<?=$row[$in]?>"/>
	<?php endforeach ?>
				<input type="submit" value="Edit"/>
			</form>
		</td>

	</tr>
<?php endforeach ?>
</table>
</div>

</body>

</html>

