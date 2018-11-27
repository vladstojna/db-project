CREATE OR REPLACE FUNCTION autoFill() RETURNS trigger AS $$
DECLARE x INTEGER;
BEGIN

	SELECT COALESCE(max(segment_number), 0) INTO x
	FROM video_segment
	WHERE camera_id=NEW.camera_id AND date_time_start=NEW.date_time_start;

	NEW.segment_number := x + 1;
	RETURN NEW;

END $$ LANGUAGE plpgsql;

CREATE TRIGGER autoFillSeg BEFORE INSERT ON video_segment FOR EACH ROW EXECUTE PROCEDURE autoFill();
