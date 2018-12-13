/* OLAP query */

/* Get number of mediums of each type used during event 15
 * rollup by year and month
 */

-- most specific grouping: by year and month
SELECT medium_type, year, month, COUNT(medium_id)
FROM company
	NATURAL INNER JOIN dimension_event  E
	NATURAL INNER JOIN dimension_medium M
	NATURAL INNER JOIN dimension_time   T
WHERE E.event_id = 15
GROUP BY M.medium_type, T.year, T.month

UNION

-- grouping by year
SELECT medium_type, year, NULL, COUNT(medium_id)
FROM company
	NATURAL INNER JOIN dimension_event  E
	NATURAL INNER JOIN dimension_medium M
	NATURAL INNER JOIN dimension_time   T
WHERE E.event_id = 15
GROUP BY M.medium_type, T.year

UNION

-- no time grouping
SELECT medium_type, NULL, NULL, COUNT(medium_id)
FROM company
	NATURAL INNER JOIN dimension_event  E
	NATURAL INNER JOIN dimension_medium M
WHERE E.event_id = 15
GROUP BY M.medium_type;


/* Using ROLLUP
SELECT year, month, medium_type, COUNT(medium_id)
FROM company
	NATURAL INNER JOIN dimension_event  E
	NATURAL INNER JOIN dimension_medium M
	NATURAL INNER JOIN dimension_time   T
WHERE E.event_id = 15
GROUP BY M.medium_type, ROLLUP(T.year, T.month);
*/

