/* multidimensional database schema */

DROP TABLE IF EXISTS company CASCADE;

DROP TABLE IF EXISTS dimension_event  CASCADE;
DROP TABLE IF EXISTS dimension_medium CASCADE;
DROP TABLE IF EXISTS dimension_time   CASCADE;

/* table creation */

CREATE TABLE dimension_event(
	event_id     SERIAL       NOT NULL,
	phone_number NUMERIC(9)   NOT NULL,
	call_time    TIMESTAMP(0) NOT NULL,

	PRIMARY KEY (event_id)
);

CREATE TABLE dimension_medium(
	medium_id     SERIAL      NOT NULL,
	medium_number INTEGER     NOT NULL,
	medium_name   VARCHAR(80) NOT NULL,
	entity_name   VARCHAR(80) NOT NULL,
	medium_type   VARCHAR(10),

	PRIMARY KEY (medium_id)
);

CREATE TABLE dimension_time(
	time_id INTEGER NOT NULL,
	day     INTEGER NOT NULL,
	month   INTEGER NOT NULL,
	year    INTEGER NOT NULL,

	PRIMARY KEY (time_id)
);

CREATE TABLE company(
	event_id  INTEGER NOT NULL,
	medium_id INTEGER NOT NULL,
	time_id   INTEGER NOT NULL,

	PRIMARY KEY (event_id, medium_id, time_id),

	FOREIGN KEY (event_id)  REFERENCES dimension_event(event_id),
	FOREIGN KEY (medium_id) REFERENCES dimension_medium(medium_id),
	FOREIGN KEY (time_id)   REFERENCES dimension_time(time_id)
);

/* surrogate key stored procedure */

CREATE OR REPLACE FUNCTION date_convert(d TIMESTAMP) RETURNS INTEGER AS $$
DECLARE sk INTEGER;
BEGIN

	sk :=
		EXTRACT(YEAR  FROM d) * 10000 +
		EXTRACT(MONTH FROM d) * 100 +
		EXTRACT(DAY   FROM d);
	RETURN CAST(sk AS INTEGER);

END $$ LANGUAGE plpgsql;

-- insert emergency events
INSERT INTO dimension_event
	(phone_number, call_time)
SELECT phone_number, call_time FROM emergency_event;

-- insert combat mediums
INSERT INTO dimension_medium (medium_number, medium_name, entity_name, medium_type)
SELECT medium_number, medium_name, entity_name, 'Combat'
FROM medium_combat
	NATURAL INNER JOIN medium;

-- insert support mediums
INSERT INTO dimension_medium (medium_number, medium_name, entity_name, medium_type)
SELECT medium_number, medium_name, entity_name, 'Support'
FROM medium_support
	NATURAL INNER JOIN medium;

-- insert rescue mediums
INSERT INTO dimension_medium (medium_number, medium_name, entity_name, medium_type)
SELECT medium_number, medium_name, entity_name, 'Rescue'
FROM medium_rescue
	NATURAL INNER JOIN medium;

-- insert unspecified mediums
WITH ms AS (
	SELECT * FROM medium_combat
	UNION
	SELECT * FROM medium_rescue
	UNION
	SELECT * FROM medium_support
)
INSERT INTO dimension_medium (medium_number, medium_name, entity_name)
SELECT medium_number, medium_name, entity_name
FROM medium m
WHERE NOT EXISTS (
	SELECT * FROM ms
	WHERE ms.medium_number = m.medium_number AND ms.entity_name = m.entity_name
);

-- insert dates
INSERT INTO dimension_time
SELECT date_convert(d), EXTRACT(year FROM d), EXTRACT(month FROM d), EXTRACT(day FROM d)
FROM generate_series(TIMESTAMP '2018-01-01', TIMESTAMP '2030-12-31', INTERVAL '1 day') d;

-- insert into facts table

-- insert rescue mediums that have transported victims
INSERT INTO company
SELECT event_id, medium_id, date_convert(ev.call_time)
FROM dimension_medium
	NATURAL INNER JOIN dimension_event
	NATURAL INNER JOIN emergency_event ev
	NATURAL INNER JOIN transports
WHERE medium_type = 'Rescue';

-- insert support mediums that have been allocated
INSERT INTO company
SELECT event_id, medium_id, date_convert(ev.call_time)
FROM dimension_medium
	NATURAL INNER JOIN dimension_event
	NATURAL INNER JOIN emergency_event ev
	NATURAL INNER JOIN allocated
WHERE medium_type = 'Support';

/* Assuming all triggered mediums not in allocated or transports are of type 'Combat' */
WITH ms(medium_number, entity_name, rescue_process_number) AS (
	SELECT medium_number, entity_name, rescue_process_number
	FROM transports
	UNION
	SELECT medium_number, entity_name, rescue_process_number
	FROM allocated
)
INSERT INTO company
SELECT event_id, medium_id, date_convert(ev.call_time)
FROM dimension_medium
	NATURAL INNER JOIN dimension_event
	NATURAL INNER JOIN emergency_event ev
	NATURAL INNER JOIN (
		SELECT * FROM triggers t
		WHERE NOT EXISTS (
			SELECT * FROM ms
			WHERE ms.medium_number = t.medium_number
				AND ms.entity_name = t.entity_name
				AND ms.rescue_process_number = t.rescue_process_number
		)
	) AS medium_combat
WHERE medium_type = 'Combat';

