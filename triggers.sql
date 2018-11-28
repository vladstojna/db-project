
/* autoFill: implements auto incrementing id to video segments per video and media per entity */

CREATE OR REPLACE FUNCTION autoFill() RETURNS trigger AS $$
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


/* processValidity: does not allow more processes than emergency events */

CREATE OR REPLACE FUNCTION processValidity() RETURNS trigger AS $$
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


/* Create triggers */

CREATE TRIGGER autoFillSeg BEFORE INSERT ON video_segment FOR EACH ROW EXECUTE PROCEDURE autoFill();

CREATE TRIGGER autoFillMed BEFORE INSERT ON medium FOR EACH ROW EXECUTE PROCEDURE autoFill();

CREATE TRIGGER validateProc BEFORE INSERT ON rescue_process FOR EACH ROW EXECUTE PROCEDURE processValidity();
