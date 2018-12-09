/* indexes */

DROP INDEX IF EXISTS index_vid_cam;
DROP INDEX IF EXISTS index_lout_cam_place;

CREATE INDEX index_vid_cam ON video (camera_id) USING hash;
CREATE INDEX index_lout_cam_place ON lookout (camera_id, place_address) USING hash;

