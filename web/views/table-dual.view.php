<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>

<style>
	.row {
		display: flex;
		height: 50%;
		width: 100%;
	}

	.column {
		flex: 50%;
		margin-left: 50pt;
		margin-right: 50pt;
	}

	.scrollable {
		overflow-y: auto;
		padding-right: 10pt;
	}
</style>

<body>

<a href="../../index.html"> ~ Back </a>

<h3> <?=$caption_helper?> </h3>

<div class="row">

	<div class="scrollable column">
	<table>
		<tr>
	<?php foreach($helpercols as $col): ?>
			<th> <?=$col?> </th>
	<?php endforeach ?>
		</tr>
	<?php foreach($helper as $index => $row): ?>
		<tr>
		<?php foreach($row as $key => $value): ?>
			<td> <?=$value?> </td>
		<?php endforeach ?>

			<td>
				<form id="<?=$index?>" action="" method="POST">
		<?php foreach($inputs as $in): ?>
					<input type="hidden" name="<?=$in?>" value="<?=$row[$in]?>"/>
		<?php endforeach ?>
					<input type="submit" value="Get mediums"/>
				</form>
			</td>
		</tr>
	<?php endforeach ?>
	</table>
	</div>

	<div class="scrollable column">
	<?php if (isset($status)): ?>
		<p> <?=$status?> </p>
	<?php endif ?>

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
		</tr>
	<?php endforeach ?>
	</table>
	</div>

</div>

</body>
</html>

