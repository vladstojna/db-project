<?php

	/* Prints relation contents as a table */
	function print_table($db, $query, $title, $columns, $link=null, $parameter=null, $link_name=null) {
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
			}

			/* Appends new column with link if exists */
			if ($link != null && $parameter != null && $link_name != null) {
				echo("<td><a href=\"{$link}?{$parameter}={$row[$parameter]}\">${link_name}</a></td>\n");
			}

			echo("</tr>\n");
		}

		echo("</table>\n");

		$result = null;
	}

	/* Prints a link */
	function print_link($target, $name) {
		echo("<a href=\"{$target}\"> $name </a>\n");
	}
?>

