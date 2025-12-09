CREATE TRIGGER `trg_reviews_after_update` AFTER UPDATE ON `reviews`
 FOR EACH ROW BEGIN
    -- Update average for the NEW game_id
    UPDATE games
    SET average_rating = (
        SELECT AVG(rating)
        FROM reviews
        WHERE game_id = NEW.game_id
    )
    WHERE game_id = NEW.game_id;

    -- If the review moved to a different game, recalc the old one too
    IF OLD.game_id <> NEW.game_id THEN
        UPDATE games
        SET average_rating = (
            SELECT AVG(rating)
            FROM reviews
            WHERE game_id = OLD.game_id
        )
        WHERE game_id = OLD.game_id;
    END IF;
END




CREATE TRIGGER `trg_reviews_after_insert` AFTER INSERT ON `reviews`
 FOR EACH ROW BEGIN
    UPDATE games
    SET average_rating = (
        SELECT COALESCE(AVG(rating), 0)
        FROM reviews
        WHERE game_id = NEW.game_id
    )
    WHERE game_id = NEW.game_id;
END



CREATE TRIGGER `trg_reviews_after_delete` AFTER DELETE ON `reviews`
 FOR EACH ROW BEGIN
    UPDATE games
    SET average_rating = (
        SELECT AVG(rating)
        FROM reviews
        WHERE game_id = OLD.game_id
    )
    WHERE game_id = OLD.game_id;
END


--for inserting screenhots 3 and 4 for games that have only 1 or 2 screenshots
INSERT INTO `game_media` (`game_id`, `media_url`, `media_type`) VALUES
(80, 'assets/images/games/Absolum/3.jpg', 'screenshot'),
(80, 'assets/images/games/Absolum/4.jpg', 'screenshot'),
(81, 'assets/images/games/Anno/3.jpg', 'screenshot'),
(81, 'assets/images/games/Anno/4.jpg', 'screenshot'),
(82, 'assets/images/games/Apex Legend/3.jpg', 'screenshot'),
(82, 'assets/images/games/Apex Legend/4.jpg', 'screenshot'),
(83, 'assets/images/games/Batman/3.jpg', 'screenshot'),
(83, 'assets/images/games/Batman/4.jpg', 'screenshot'),
(84, 'assets/images/games/Beam N.G/3.jpg', 'screenshot'),
(84, 'assets/images/games/Beam N.G/4.jpg', 'screenshot'),
(85, 'assets/images/games/Blood Sports/3.jpg', 'screenshot'),
(85, 'assets/images/games/Blood Sports/4.jpg', 'screenshot'),
(86, 'assets/images/games/Buckshot/3.jpg', 'screenshot'),
(86, 'assets/images/games/Buckshot/4.jpg', 'screenshot'),
(87, 'assets/images/games/Chained Together/3.jpg', 'screenshot'),
(87, 'assets/images/games/Chained Together/4.jpg', 'screenshot'),
(88, 'assets/images/games/Command and Conquere/3.jpg', 'screenshot'),
(88, 'assets/images/games/Command and Conquere/4.jpg', 'screenshot'),
(89, 'assets/images/games/Dark Souls III/3.jpg', 'screenshot'),
(89, 'assets/images/games/Dark Souls III/4.jpg', 'screenshot'),
(90, 'assets/images/games/Dark Tide/3.jpg', 'screenshot'),
(90, 'assets/images/games/Dark Tide/4.jpg', 'screenshot'),
(91, 'assets/images/games/Dawn of War/3.jpg', 'screenshot'),
(91, 'assets/images/games/Dawn of War/4.jpg', 'screenshot'),
(92, 'assets/images/games/Destiny 2/3.jpg', 'screenshot'),
(92, 'assets/images/games/Destiny 2/4.jpg', 'screenshot'),
(93, 'assets/images/games/Dispatch/3.jpg', 'screenshot'),
(93, 'assets/images/games/Dispatch/4.jpg', 'screenshot'),
(94, 'assets/images/games/Don\'t Scream/3.jpg', 'screenshot'),
(94, 'assets/images/games/Don\'t Scream/4.jpg', 'screenshot'),
(95, 'assets/images/games/EA Play/3.jpg', 'screenshot'),
(95, 'assets/images/games/EA Play/4.jpg', 'screenshot'),
(96, 'assets/images/games/Escape Simulator 2/3.jpg', 'screenshot'),
(96, 'assets/images/games/Escape Simulator 2/4.jpg', 'screenshot'),
(97, 'assets/images/games/Fallout/3.jpg', 'screenshot'),
(97, 'assets/images/games/Fallout/4.jpg', 'screenshot'),
(98, 'assets/images/games/FC25/3.jpg', 'screenshot'),
(98, 'assets/images/games/FC25/4.jpg', 'screenshot'),
(99, 'assets/images/games/Football Manager 26/3.jpg', 'screenshot'),
(99, 'assets/images/games/Football Manager 26/4.jpg', 'screenshot'),
(100, 'assets/images/games/For Honor/3.jpg', 'screenshot'),
(100, 'assets/images/games/For Honor/4.jpg', 'screenshot'),
(101, 'assets/images/games/Ghost/3.jpg', 'screenshot'),
(101, 'assets/images/games/Ghost/4.jpg', 'screenshot'),
(102, 'assets/images/games/GTA/3.jpg', 'screenshot'),
(102, 'assets/images/games/GTA/4.jpg', 'screenshot'),
(103, 'assets/images/games/Guilty Gear/3.jpg', 'screenshot'),
(103, 'assets/images/games/Guilty Gear/4.jpg', 'screenshot'),
(104, 'assets/images/games/Heart of Iron IV/3.jpg', 'screenshot'),
(104, 'assets/images/games/Heart of Iron IV/4.jpg', 'screenshot'),
(105, 'assets/images/games/Hogwarts Legacy/3.jpg', 'screenshot'),
(105, 'assets/images/games/Hogwarts Legacy/4.jpg', 'screenshot'),
(106, 'assets/images/games/iRacing/3.jpg', 'screenshot'),
(106, 'assets/images/games/iRacing/4.jpg', 'screenshot'),
(107, 'assets/images/games/It Takes 2/3.jpg', 'screenshot'),
(107, 'assets/images/games/It Takes 2/4.jpg', 'screenshot'),
(108, 'assets/images/games/Jedi/3.jpg', 'screenshot'),
(108, 'assets/images/games/Jedi/4.jpg', 'screenshot'),
(109, 'assets/images/games/Little Nightmare 3/3.jpg', 'screenshot'),
(109, 'assets/images/games/Little Nightmare 3/4.jpg', 'screenshot'),
(110, 'assets/images/games/Mortal Combat/3.jpg', 'screenshot'),
(110, 'assets/images/games/Mortal Combat/4.jpg', 'screenshot'),
(111, 'assets/images/games/Rematch/3.jpg', 'screenshot'),
(111, 'assets/images/games/Rematch/4.jpg', 'screenshot'),
(112, 'assets/images/games/REPO/3.jpg', 'screenshot'),
(112, 'assets/images/games/REPO/4.jpg', 'screenshot'),
(113, 'assets/images/games/Schedule/3.jpg', 'screenshot'),
(113, 'assets/images/games/Schedule/4.jpg', 'screenshot'),
(114, 'assets/images/games/Silent Hill/3.jpg', 'screenshot'),
(114, 'assets/images/games/Silent Hill/4.jpg', 'screenshot'),
(115, 'assets/images/games/Sky/3.jpg', 'screenshot'),
(115, 'assets/images/games/Sky/4.jpg', 'screenshot'),
(116, 'assets/images/games/Sonic Shadow/3.jpg', 'screenshot'),
(116, 'assets/images/games/Sonic Shadow/4.jpg', 'screenshot'),
(117, 'assets/images/games/Spiderman/3.jpg', 'screenshot'),
(117, 'assets/images/games/Spiderman/4.jpg', 'screenshot'),
(118, 'assets/images/games/Split Fiction/3.jpg', 'screenshot'),
(118, 'assets/images/games/Split Fiction/4.jpg', 'screenshot'),
(119, 'assets/images/games/Stellaris/3.jpg', 'screenshot'),
(119, 'assets/images/games/Stellaris/4.jpg', 'screenshot'),
(120, 'assets/images/games/Street Fighter/3.jpg', 'screenshot'),
(120, 'assets/images/games/Street Fighter/4.jpg', 'screenshot'),
(121, 'assets/images/games/Taken 8/3.jpg', 'screenshot'),
(121, 'assets/images/games/Taken 8/4.jpg', 'screenshot'),
(122, 'assets/images/games/VR Chat/3.jpg', 'screenshot'),
(122, 'assets/images/games/VR Chat/4.jpg', 'screenshot'),
(123, 'assets/images/games/War Rats/3.jpg', 'screenshot'),
(123, 'assets/images/games/War Rats/4.jpg', 'screenshot'),
(124, 'assets/images/games/Warborne/3.jpg', 'screenshot'),
(124, 'assets/images/games/Warborne/4.jpg', 'screenshot'),
(125, 'assets/images/games/Watch Dogs 2/3.jpg', 'screenshot'),
(125, 'assets/images/games/Watch Dogs 2/4.jpg', 'screenshot');