DROP TRIGGER IF EXISTS auto_fill_seg ON video_segment;
DROP TRIGGER IF EXISTS auto_fill_med ON medium;
DROP TRIGGER IF EXISTS validate_proc ON rescue_process;
DROP TRIGGER IF EXISTS del_proc ON emergency_event;

/* auto_fill: implements auto incrementing id to video segments per video and media per entity */

CREATE OR REPLACE FUNCTION auto_fill() RETURNS TRIGGER AS $$
DECLARE x INTEGER;
BEGIN

	IF (TG_TABLE_NAME = 'video_segment') THEN
		SELECT COALESCE(max(segment_number), 0) INTO x
		FROM video_segment
		WHERE camera_id=NEW.camera_id AND date_time_start=NEW.date_time_start;

		NEW.segment_number := x + 1;
		RETURN NEW;
	
	ELSIF (TG_TABLE_NAME = 'medium') THEN
		SELECT COALESCE(max(medium_number), 0) INTO x
		FROM medium
		WHERE entity_name=NEW.entity_name;

		NEW.medium_number := x + 1;
		RETURN NEW;

	END IF;

END $$ LANGUAGE plpgsql;

/* process_validity: does not allow more processes than emergency events */

CREATE OR REPLACE FUNCTION process_validity() RETURNS TRIGGER AS $$
DECLARE p INTEGER;
DECLARE e INTEGER;
BEGIN

	p := COUNT(*) FROM rescue_process;
	e := COUNT(*) FROM emergency_event;

	IF p >= e THEN
		RAISE EXCEPTION 'There cannot be more Rescue Processes than Emergency Events';
	END IF;

	RETURN NEW;

END $$ LANGUAGE plpgsql;

/* del_procs:
	deletes rescue_processes in the event they were
	associated with a single, previously deleted, emergency event */

CREATE OR REPLACE FUNCTION delete_process() RETURNS TRIGGER AS $$
BEGIN

	IF NOT EXISTS (SELECT * FROM emergency_event WHERE rescue_process_number=OLD.rescue_process_number) THEN

		DELETE FROM rescue_process WHERE rescue_process_number=OLD.rescue_process_number;

	END IF;

	RETURN NULL;

END $$ LANGUAGE plpgsql;

/* allocated_validation:
	a support medium can only be allocated by a process if it was triggered by said process */

CREATE OR REPLACE FUNCTION allocated_validity() RETURNS TRIGGER AS $$
BEGIN

	IF NOT EXISTS (
		SELECT * FROM triggers
		WHERE medium_number = NEW.medium_number
			AND entity_name = NEW.entity_name
			AND rescue_process_number = NEW.rescue_process_number)
	THEN
		RAISE EXCEPTION 'Support medium can only be allocated by a process
			if triggered by said process';
	END IF;
	RETURN NEW;

END $$ LANGUAGE plpgsql;

/* coord_request_validity:
	a coordinator can only request videos from places he/she has/had audited */

CREATE OR REPLACE FUNCTION coord_request_validity() RETURNS TRIGGER AS $$
DECLARE place VARCHAR(255);
BEGIN

	SELECT place_address INTO place FROM lookout WHERE camera_id = NEW.camera_id;

	IF place NOT IN (SELECT place_address FROM emergency_event NATURAL INNER JOIN audits
		WHERE coordinator_id = NEW.coordinator_id)
	THEN
		RAISE EXCEPTION 'Coordinator cannot request a video from a camera which place of lookout has
		not been audited by said coordinator';
	END IF;

	RETURN NEW;

END $$ LANGUAGE plpgsql;

/* Create triggers */

CREATE TRIGGER auto_fill_seg BEFORE INSERT ON video_segment
	FOR EACH ROW EXECUTE PROCEDURE auto_fill();

CREATE TRIGGER auto_fill_med BEFORE INSERT OR UPDATE ON medium
	FOR EACH ROW EXECUTE PROCEDURE auto_fill();

CREATE TRIGGER validate_proc BEFORE INSERT ON rescue_process
	FOR EACH ROW EXECUTE PROCEDURE process_validity();

CREATE TRIGGER del_proc AFTER DELETE ON emergency_event
	FOR EACH ROW EXECUTE PROCEDURE delete_process();

--CREATE TRIGGER allocation_valid BEFORE INSERT ON allocated
--	FOR EACH ROW EXECUTE PROCEDURE allocated_validity();

