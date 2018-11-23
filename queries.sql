/* queries */

-- #1
SELECT DISTINCT rescue_process_number FROM triggers
GROUP BY rescue_process_number HAVING count(*) >= ALL (
	SELECT count(*) FROM triggers
	GROUP BY rescue_process_number
);

-- #2
WITH parameters(number, name) AS (
	SELECT rescue_process_number, entity_name FROM triggers 
	NATURAL INNER JOIN emergency_event
	WHERE call_time BETWEEN '2018-06-21 00:00:00' AND '2018-09-23 23:59:59')

SELECT name FROM parameters GROUP BY name HAVING count(number) >= ALL (
	SELECT count(number) FROM parameters GROUP BY name
);

-- #3
SELECT DISTINCT rescue_process_number FROM emergency_event NARUAL INNER JOIN (
	SELECT * FROM triggers 
	EXCEPT
	SELECT medium_number; entity_name, rescue_process_number FROM audits)
) AS foo 
WHERE call_time BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:59:59'
AND place_address='Oliveira do Hospital';

-- #4
SELECT count(*) FROM video
NATURAL INNER JOIN video_segment
NATURAL INNER JOIN lookout
WHERE place_address='Monchique'
	AND duration > '00:01:00'
	AND date_time_start >= '2018-08-01 00:00:00'
	AND date_time_end <= '2018-08-31 23:59:59';

-- #5
SELECT * FROM medium_combat 
EXCEPT
SELECT medium_number, entity_name FROM medium_support 
NATURAL INNER JOIN allocated;

-- #6
SELECT DISTINCT entity_name FROM medium_combat m1
WHERE NOT EXISTS (
	SELECT DISTINCT rescue_process_number
	FROM triggers 
	EXCEPT
	SELECT DISTINCT rescue_process_number
	FROM (triggers NATURAL INNER JOIN medium_combat) m2
	WHERE m1.entity_name = m2.entity_name
);