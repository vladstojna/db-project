/* indexes */

DROP INDEX IF EXISTS index_vid_cam;
DROP INDEX IF EXISTS index_lout_cam_place;


CREATE INDEX index_vid_cam ON video USING btree (camera_id);
CLUSTER video USING index_vid_cam;

CREATE UNIQUE INDEX index_lout_cam_place ON lookout USING btree (place_address, camera_id);

