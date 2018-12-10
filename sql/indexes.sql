/* indexes */

DROP INDEX IF EXISTS index_vid_cam;
DROP INDEX IF EXISTS index_lout_cam_place;
DROP INDEX IF EXISTS index_transports_rpn;
DROP INDEX IF EXISTS index_event_rpn;

CREATE INDEX index_vid_cam ON video USING hash (camera_id);
CREATE UNIQUE INDEX index_lout_cam_place ON lookout USING btree (place_address, camera_id);

CREATE INDEX index_transports_rpn ON transports USING hash (rescue_process_number);
CREATE INDEX index_event_rpn ON emergency_event USING hash (rescue_process_number);

