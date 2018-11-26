<?php

function table($result, $title, $columns, $form=null) {
	if (isset($result) && isset($columns) && isset($title)) { ?>
	<h3> <?=$title?> </h3>
	<table border=1>
		<tr>
		<?php foreach($columns as $col) { ?>
			<th> <?=$col?> </th>
		<?php } ?>
		</tr>
		<?php foreach($result as $row) { ?>
		<tr>
			<?php foreach($columns as $col) { ?>
				<td> <?=$row[$col]?> </td>
			<?php } ?>
			<?php if (isset($form)) { ?>
				<td>
				<form action="" method="GET">
					<?php foreach($form as $in) ?>
						<input type="hidden" name="<?=$in?>" value="<?=$row[$in]?>"/>
					<input type="submit" value="Submit"/>
				</form>
				</td>
			<?php } ?>
		</tr>
		<?php } ?>
	</table>
	<?php }
} ?>

