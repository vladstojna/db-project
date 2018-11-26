<?php

function table_params($result, $title, $columns, $form=null) {
	return array(
		'r'=>$result,
		't'=>$title,
		'c'=>$columns,
		'f'=>$form
	);
}

function table($arg) {
	if (isset($arg['r']) && isset($arg['c']) && isset($arg['t'])) { ?>
	<h3> <?=$arg['t']?> </h3>
	<table border=1>
		<tr>
		<?php foreach($arg['c'] as $col) { ?>
			<th> <?=$col?> </th>
		<?php } ?>
		</tr>
		<?php foreach($arg['r'] as $row) { ?>
		<tr>
			<?php foreach($arg['c'] as $col) { ?>
				<td> <?=$row[$col]?> </td>
			<?php } ?>
			<?php if (isset($arg['f'])) { ?>
				<td>
				<form action="" method="GET">
					<?php foreach($arg['f'] as $in) { ?>
						<input type="hidden" name="<?=$in?>" value="<?=$row[$in]?>"/>
					<?php } ?>
					<input type="submit" value="Submit"/>
				</form>
				</td>
			<?php } ?>
		</tr>
		<?php } ?>
	</table>
	<?php }
} ?>

