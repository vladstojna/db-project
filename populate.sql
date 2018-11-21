/* populate */

--------------------------------------------------------------------------

INSERT INTO camera VALUES (1);
INSERT INTO camera VALUES (2);
INSERT INTO camera VALUES (3);
INSERT INTO camera VALUES (4);
INSERT INTO camera VALUES (5);
INSERT INTO camera VALUES (6);
INSERT INTO camera VALUES (7);
INSERT INTO camera VALUES (8);
INSERT INTO camera VALUES (9);

INSERT INTO video VALUES ('2018-11-01 01:15:20', '2018-11-01 01:20:20', 1);
INSERT INTO video VALUES ('2018-11-02 02:15:20', '2018-11-02 02:20:20', 2);
INSERT INTO video VALUES ('2018-11-03 03:15:20', '2018-11-03 03:20:20', 3);
INSERT INTO video VALUES ('2018-11-04 04:15:20', '2018-11-04 04:20:20', 4);
INSERT INTO video VALUES ('2018-11-05 05:15:20', '2018-11-05 05:20:20', 5);
INSERT INTO video VALUES ('2018-11-06 06:15:20', '2018-11-06 06:20:20', 6);
INSERT INTO video VALUES ('2018-11-07 07:15:20', '2018-11-07 07:20:20', 7);
INSERT INTO video VALUES ('2018-11-08 08:15:20', '2018-11-08 08:20:20', 8);
INSERT INTO video VALUES ('2018-11-09 09:15:20', '2018-11-09 09:20:20', 9);

INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-01 01:15:20', 1);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-02 02:15:20', 2);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-03 03:15:20', 3);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-04 04:15:20', 4);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-05 05:15:20', 5);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-06 06:15:20', 6);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-07 07:15:20', 7);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-08 08:15:20', 8);
INSERT INTO video_segment VALUES (1, '00:05:00', '2018-11-09 09:15:20', 9);

--------------------------------------------------------------------------

INSERT INTO place VALUES ('Place 1');
INSERT INTO place VALUES ('Place 2');
INSERT INTO place VALUES ('Place 3');
INSERT INTO place VALUES ('Place 4');
INSERT INTO place VALUES ('Place 5');
INSERT INTO place VALUES ('Place 6');
INSERT INTO place VALUES ('Place 7');
INSERT INTO place VALUES ('Place 8');
INSERT INTO place VALUES ('Place 9');

INSERT INTO lookout VALUES ('Place 1', 1);
INSERT INTO lookout VALUES ('Place 2', 2);
INSERT INTO lookout VALUES ('Place 3', 3);
INSERT INTO lookout VALUES ('Place 4', 4);
INSERT INTO lookout VALUES ('Place 5', 5);

--------------------------------------------------------------------------

INSERT INTO emergency_event VALUES (910123454, '2018-11-04 14:05:00', 'Person 4', 'Place 4', null);
INSERT INTO emergency_event VALUES (910123455, '2018-11-05 15:05:00', 'Person 5', 'Place 5', null);
INSERT INTO emergency_event VALUES (910123456, '2018-11-06 16:05:00', 'Person 6', 'Place 6', null);
INSERT INTO emergency_event VALUES (910123457, '2018-11-07 17:05:00', 'Person 7', 'Place 7', null);
INSERT INTO emergency_event VALUES (910123458, '2018-11-08 18:05:00', 'Person 8', 'Place 8', null);
INSERT INTO emergency_event VALUES (910123459, '2018-11-09 19:05:00', 'Person 9', 'Place 9', null);

INSERT INTO rescue_process VALUES (1);
INSERT INTO rescue_process VALUES (2);
INSERT INTO rescue_process VALUES (3);
INSERT INTO rescue_process VALUES (4);
INSERT INTO rescue_process VALUES (5);
INSERT INTO rescue_process VALUES (6);

--------------------------------------------------------------------------

INSERT INTO medium_entity VALUES ('Police Entity');
INSERT INTO medium_entity VALUES ('Army Entity');
INSERT INTO medium_entity VALUES ('Firefighter Entity');
INSERT INTO medium_entity VALUES ('Ambulance Entity');

INSERT INTO medium VALUES (1, 'Police Vehicle Type 1',      'Police Entity');
INSERT INTO medium VALUES (2, 'Police Vehicle Type 2',      'Police Entity');
INSERT INTO medium VALUES (3, 'Police Vehicle Type 3',      'Police Entity');
INSERT INTO medium VALUES (1, 'Army Vehicle Type 1',        'Army Entity');
INSERT INTO medium VALUES (2, 'Army Vehicle Type 2',        'Army Entity');
INSERT INTO medium VALUES (3, 'Army Vehicle Type 3',        'Army Entity');
INSERT INTO medium VALUES (1, 'Firefighter Vehicle Type 1', 'Firefighter Entity');
INSERT INTO medium VALUES (2, 'Firefighter Vehicle Type 2', 'Firefighter Entity');
INSERT INTO medium VALUES (3, 'Firefighter Vehicle Type 3', 'Firefighter Entity');
INSERT INTO medium VALUES (1, 'Ambulance Vehicle Type 1',   'Ambulance Entity');
INSERT INTO medium VALUES (2, 'Ambulance Vehicle Type 2',   'Ambulance Entity');
INSERT INTO medium VALUES (3, 'Ambulance Vehicle Type 3',   'Ambulance Entity');

INSERT INTO medium_combat VALUES (1, 'Police Entity');
INSERT INTO medium_combat VALUES (2, 'Police Entity');
INSERT INTO medium_combat VALUES (3, 'Police Entity');
INSERT INTO medium_combat VALUES (1, 'Army Entity');
INSERT INTO medium_combat VALUES (2, 'Army Entity');
INSERT INTO medium_combat VALUES (3, 'Army Entity');

INSERT INTO medium_support VALUES (1, 'Army Entity');
INSERT INTO medium_support VALUES (2, 'Army Entity');
INSERT INTO medium_support VALUES (3, 'Army Entity');
INSERT INTO medium_support VALUES (1, 'Firefighter Entity');
INSERT INTO medium_support VALUES (2, 'Firefighter Entity');
INSERT INTO medium_support VALUES (3, 'Firefighter Entity');

INSERT INTO medium_rescue VALUES (1, 'Firefighter Entity');
INSERT INTO medium_rescue VALUES (2, 'Firefighter Entity');
INSERT INTO medium_rescue VALUES (3, 'Firefighter Entity');
INSERT INTO medium_rescue VALUES (1, 'Ambulance Entity');
INSERT INTO medium_rescue VALUES (2, 'Ambulance Entity');
INSERT INTO medium_rescue VALUES (3, 'Ambulance Entity');

--------------------------------------------------------------------------

INSERT INTO transports VALUES (1, 'Ambulance Entity', 10, 3);
INSERT INTO transports VALUES (3, 'Ambulance Entity', 20, 5);

INSERT INTO allocated VALUES (1, 'Firefighter Entity', 5, 6);
INSERT INTO allocated VALUES (2, 'Firefighter Entity', 4, 6);
INSERT INTO allocated VALUES (2, 'Army Entity'       , 3, 4);

INSERT INTO triggers VALUES (1, 'Ambulance Entity',   3);
INSERT INTO triggers VALUES (1, 'Police Entity',      5);
INSERT INTO triggers VALUES (1, 'Firefighter Entity', 6);
INSERT INTO triggers VALUES (2, 'Ambulance Entity',   4);
INSERT INTO triggers VALUES (2, 'Army Entity',        4);
INSERT INTO triggers VALUES (2, 'Firefighter Entity', 6);
INSERT INTO triggers VALUES (3, 'Ambulance Entity',   5);
INSERT INTO triggers VALUES (3, 'Firefighter Entity', 6);

--------------------------------------------------------------------------

INSERT INTO coordinator VALUES (1);
INSERT INTO coordinator VALUES (2);
INSERT INTO coordinator VALUES (3);
INSERT INTO coordinator VALUES (4);

INSERT INTO audits VALUES (
	1, 1, 'Ambulance Entity', 3,
	'2018-11-01 00:00:00', '2018-12-01 23:59:59', '2018-12-02', 'audition1_text'
);
INSERT INTO audits VALUES (
	2, 2, 'Ambulance Entity', 4,
	'2018-11-15 00:00:00', '2018-12-15 23:59:59', '2018-12-16', 'audition2_text'
);

INSERT INTO requests
	VALUES (3, '2018-11-07 07:15:20', 7, '2018-11-12 16:15:20', '2018-11-12 16:20:20');
INSERT INTO requests
	VALUES (4, '2018-11-02 02:15:20', 2, '2018-11-07 18:15:20', '2018-11-07 18:20:20');
