<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>

<a href="../../index.html"> ~ Back </a>

<?php if (isset($status)): ?>
<p> <?=$status?> </p>
<?php endif ?>

<h3> <?=$title?> </h3>

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
	<?php foreach($entity as $i => $entity_name): ?>
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

</body>

</html>

