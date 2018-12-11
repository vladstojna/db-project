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
	day   INTEGER NOT NULL,
	month INTEGER NOT NULL,
	year  INTEGER NOT NULL
);

/* insertion */

INSERT INTO dimension_event
	(phone_number, call_time)
SELECT phone_number, call_time FROM emergency_event;

INSERT INTO dimension_medium
	(medium_number, medium_name, entity_name)
SELECT medium_number, medium_name, entity_name FROM medium_combat NATURAL INNER JOIN medium;

UPDATE dimension_medium SET medium_type = 'Combat' WHERE medium_type IS NULL;

INSERT INTO dimension_medium
	(medium_number, medium_name, entity_name)
SELECT medium_number, medium_name, entity_name FROM medium_support NATURAL INNER JOIN medium;

UPDATE dimension_medium SET medium_type = 'Support' WHERE medium_type IS NULL;

INSERT INTO dimension_medium
	(medium_number, medium_name, entity_name)
SELECT medium_number, medium_name, entity_name FROM medium_rescue NATURAL INNER JOIN medium;

UPDATE dimension_medium SET medium_type = 'Rescue' WHERE medium_type IS NULL;


WITH ms(medium_number, entity_name) AS (
	SELECT * FROM medium_combat
	UNION
	SELECT * FROM medium_rescue
	UNION
	SELECT * FROM medium_support)

INSERT INTO dimension_medium
	(medium_number, medium_name, entity_name)
SELECT medium_number, medium_name, entity_name FROM medium m
WHERE NOT EXISTS (
	SELECT * FROM ms
	WHERE ms.medium_number = m.medium_number AND ms.entity_name = m.entity_name
);

