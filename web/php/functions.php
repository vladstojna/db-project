<?php

	/* Prints relation contents as a table */
	function print_table($db, $query, $title, $columns, $links=null, $link_targets=null) {
		$result = $db->prepare($query);
		$result->execute();

		/* Prints title */
		echo("<h3>{$title}</h3>\n");

		echo("<table border=\"1\">\n");
		echo("<tr>");

		/* Prints column names */
		foreach($columns as $col_name) {
			echo("<th> {$col_name} </th>");
		}
		echo("</tr>\n");

		/* Iterates all rows and prints contents */
		foreach($result as $row) {
			echo("<tr>\n");

			/* Prints data columns */
			foreach($columns as $col_name) {
				echo("<td>{$row[$col_name]}</td>\n");
				if ($links != null) {
					echo("<td><a href=${cell[1]}={$cell[0][$col_name]}></a></td>\n");
				}
			}

			/* TODO Appends new columns with links if they exist */
			if ($links != null) {
			}

			echo("</tr>\n");
		}

		echo("</table>\n");

		$result = null;
	}
?>

