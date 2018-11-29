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

