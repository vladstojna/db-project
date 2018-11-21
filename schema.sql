/* database schema */

DROP TABLE IF EXISTS camera CASCADE;
DROP TABLE IF EXISTS  video CASCADE;
DROP TABLE IF EXISTS video_segment CASCADE;;

DROP TABLE IF EXISTS place CASCADE;
DROP TABLE IF EXISTS lookout CASCADE;

DROP TABLE IF EXISTS emergency_event CASCADE;;
DROP TABLE IF EXISTS rescue_process CASCADE;

DROP TABLE IF EXISTS medium_entity CASCADE;
DROP TABLE IF EXISTS medium CASCADE;
DROP TABLE IF EXISTS medium_combat CASCADE;
DROP TABLE IF EXISTS medium_support CASCADE;
DROP TABLE IF EXISTS medium_rescue CASCADE;

DROP TABLE IF EXISTS transports CASCADE;
DROP TABLE IF EXISTS allocated CASCADE;
DROP TABLE IF EXISTS triggers CASCADE;

DROP TABLE IF EXISTS coordinator CASCADE;
DROP TABLE IF EXISTS audits CASCADE;
DROP TABLE IF EXISTS requests CASCADE;

/* Table creation */

--------------------------------------------------------------------------

CREATE TABLE camera(
	camera_id INTEGER NOT NULL,

	PRIMARY KEY(camera_id)
);

CREATE TABLE video(
	date_time_start TIMESTAMP(0) NOT NULL,
	date_time_end   TIMESTAMP(0) NOT NULL,
	camera_id       INTEGER      NOT NULL,

	PRIMARY KEY(date_time_start, camera_id),
	FOREIGN KEY(camera_id) REFERENCES camera(camera_id)
);

CREATE TABLE video_segment(
	segment_number  INTEGER      NOT NULL,
	duration        TIME(0)      NOT NULL,
	date_time_start TIMESTAMP(0) NOT NULL,
	camera_id       INTEGER      NOT NULL,

	PRIMARY KEY(segment_number, date_time_start, camera_id),
	FOREIGN KEY(date_time_start, camera_id) REFERENCES video(date_time_start, camera_id)
);

--------------------------------------------------------------------------

CREATE TABLE place(
	place_address VARCHAR(255) NOT NULL,

	PRIMARY KEY(place_address)
);

CREATE TABLE lookout(
	place_address VARCHAR(100) NOT NULL,
	camera_id     INTEGER      NOT NULL,

	PRIMARY KEY(place_address, camera_id),
	FOREIGN KEY(place_address) REFERENCES place(place_address),
	FOREIGN KEY(camera_id)     REFERENCES camera(camera_id)
);

--------------------------------------------------------------------------

CREATE TABLE rescue_process(
	rescue_process_number INTEGER NOT NULL,

	PRIMARY KEY(rescue_process_number)
);

CREATE TABLE emergency_event(
	phone_number          NUMERIC(9, 0) NOT NULL,
	call_time             TIME(0)       NOT NULL,
	person_name           VARCHAR(80)   NOT NULL,
	place_address         VARCHAR(255)  NOT NULL,
	rescue_process_number INTEGER,

	PRIMARY KEY(phone_number, call_time),
	FOREIGN KEY(rescue_process_number) REFERENCES rescue_process(rescue_process_number),
	FOREIGN KEY(place_address) REFERENCES place(place_address),
	UNIQUE(phone_number, person_name)
);

--------------------------------------------------------------------------

CREATE TABLE medium_entity(
	entity_name VARCHAR(80) NOT NULL,

	PRIMARY KEY(entity_name)
);

CREATE TABLE medium(
	medium_number INTEGER     NOT NULL,
	medium_name   VARCHAR(80) NOT NULL,
	entity_name   VARCHAR(80) NOT NULL,

	PRIMARY KEY(medium_number, entity_name),
	FOREIGN KEY(entity_name) REFERENCES medium_entity(entity_name)
);

CREATE TABLE medium_combat(
	medium_number INTEGER     NOT NULL,
	entity_name   VARCHAR(80) NOT NULL,

	PRIMARY KEY(medium_number, entity_name),
	FOREIGN KEY(medium_number, entity_name) REFERENCES medium(medium_number, entity_name)
);

CREATE TABLE medium_support(
	medium_number INTEGER     NOT NULL,
	entity_name   VARCHAR(80) NOT NULL,

	PRIMARY KEY(medium_number, entity_name),
	FOREIGN KEY(medium_number, entity_name) REFERENCES medium(medium_number, entity_name)
);

CREATE TABLE medium_rescue(
	medium_number INTEGER     NOT NULL,
	entity_name   VARCHAR(80) NOT NULL,

	PRIMARY KEY(medium_number, entity_name),
	FOREIGN KEY(medium_number, entity_name) REFERENCES medium(medium_number, entity_name)
);

--------------------------------------------------------------------------

CREATE TABLE transports(
	medium_number         INTEGER     NOT NULL,
	entity_name           VARCHAR(80) NOT NULL,
	victim_number         INTEGER     NOT NULL,
	rescue_process_number INTEGER     NOT NULL,

	PRIMARY KEY(medium_number, entity_name, rescue_process_number),
	FOREIGN KEY(medium_number, entity_name) REFERENCES medium_rescue(medium_number, entity_name),
	FOREIGN KEY(rescue_process_number) REFERENCES rescue_process(rescue_process_number)
);

CREATE TABLE allocated(
	medium_number         INTEGER     NOT NULL,
	entity_name           VARCHAR(80) NOT NULL,
	hours_done            INTEGER     NOT NULL,
	rescue_process_number INTEGER     NOT NULL,

	PRIMARY KEY(medium_number, entity_name, rescue_process_number),
	FOREIGN KEY(medium_number, entity_name) REFERENCES medium_support(medium_number, entity_name),
	FOREIGN KEY(rescue_process_number) REFERENCES rescue_process(rescue_process_number)
);

CREATE TABLE triggers(
	medium_number         INTEGER     NOT NULL,
	entity_name           VARCHAR(80) NOT NULL,
	rescue_process_number INTEGER     NOT NULL,

	PRIMARY KEY(medium_number, entity_name, rescue_process_number),
	FOREIGN KEY(medium_number, entity_name) REFERENCES medium(medium_number, entity_name),
	FOREIGN KEY(rescue_process_number) REFERENCES rescue_process(rescue_process_number)
);

--------------------------------------------------------------------------

CREATE TABLE coordinator(
	coordinator_id INTEGER NOT NULL,

	PRIMARY KEY(coordinator_id)
);

CREATE TABLE audits(
	coordinator_id        INTEGER      NOT NULL,
	medium_number         INTEGER      NOT NULL,
	entity_name           VARCHAR(80)  NOT NULL,
	rescue_process_number INTEGER      NOT NULL,
	date_time_start       TIMESTAMP(0) NOT NULL,
	date_time_end         TIMESTAMP(0) NOT NULL,
	audition_date         DATE         NOT NULL,
	text                  TEXT         NOT NULL,

	PRIMARY KEY(coordinator_id, medium_number, entity_name, rescue_process_number),
	FOREIGN KEY(medium_number, entity_name, rescue_process_number)
		REFERENCES triggers(medium_number, entity_name, rescue_process_number),
	FOREIGN KEY(coordinator_id) REFERENCES coordinator(coordinator_id)
);

CREATE TABLE requests(
	coordinator_id        INTEGER      NOT NULL,
	video_date_time_start TIMESTAMP(0) NOT NULL,
	camera_id             INTEGER      NOT NULL,
	date_time_start       TIMESTAMP(0) NOT NULL,
	date_time_end         TIMESTAMP(0) NOT NULL,

	PRIMARY KEY(coordinator_id, video_date_time_start, camera_id),
	FOREIGN KEY(coordinator_id) REFERENCES coordinator(coordinator_id),
	FOREIGN KEY(video_date_time_start, camera_id) REFERENCES video(date_time_start, camera_id)
);
