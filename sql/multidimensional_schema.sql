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

	PRIMARY KEY (medium_id)
);

CREATE TABLE dimension_time(
	day   INTEGER NOT NULL,
	month INTEGER NOT NULL,
	year  INTEGER NOT NULL,
);


/* insertion */

INSERT INTO dimension_event
	(event_id, phone_number, call_time)
(DEFAULT, SELECT phone_number, call_time FROM emergency_event)

INSERT INTO dimension_medium
	(medium_id, medium_number, medium_name, entity_name)
(DEFAULT, SELECT * FROM medium)

