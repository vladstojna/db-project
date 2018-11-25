<?php

	/* Creates new PDO object */
	function new_db($host, $user, $pw, $dbname) {
		$db = new PDO("pgsql:host=$host; dbname=$dbname", $user, $pw);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return $db;
	}

	/* Free PDO */
	function free_db($db) {
		$db = null;
	}

	/* returns contents formatted as a table */
	function print_table($db, $query, $title, $columns, $link_target=null, $params=null, $link_name=null) {
		$result = $db->prepare($query);
		$result->execute();

		$table = "<h3>{$title}</h3>\n<table border=\"1\">\n<tr>";

		/* Prints column names */
		foreach($columns as $col_name) {
			$table .= "<th>{$col_name} </th>";
		}
		$table .= "</tr>\n";

		/* Iterates all rows and prints contents */
		foreach($result as $row) {
			$table .= "<tr>\n";

			/* Prints data columns */
			foreach($columns as $col_name) {
				$table .= "<td>{$row[$col_name]}</td>\n";
			}

			/* Appends new column with link if exists */
			if ($link_target != null && $params != null && $link_name != null) {
				$sep = "?";
				$table .= "<td><a href=\"{$link_target}";
				foreach($params as $p) {
					$table .= "{$sep}{$p}={$row[$p]}\"";
					$sep = "&";
				}
				$table .= ">${link_name}</a></td>\n";
			}

			$table .= "</tr>\n";
		}

		$table .= "</table>\n";

		$result = null;

		return $table;
	}

	/* Prints a link */
	function print_link($target, $name) {
		echo("<a href=\"{$target}\"> $name </a>\n");
	}
?>

