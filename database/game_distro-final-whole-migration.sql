-- --------------------------------------------------------
-- Assign Existing Games to Genres (Target: 7 per Genre)
-- --------------------------------------------------------

-- 1. FIGHTING (ID: 8)
-- Current: 5 | Adding: 2
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(85, 8),  -- Blood Sports (Action Sports -> Fighting context)
(111, 8); -- Rematch (Sports Action -> Fighting context)

-- 2. MOBA (ID: 10)
-- Current: 1 | Adding: 6
-- Assigned 'Online Team/Arena' games as nearest relatives
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(82, 10),  -- Apex Legend (Competitive Team Arena)
(22, 10),  -- PUBG BATTLEGROUNDS (Competitive Survival)
(31, 10),  -- World Of Warships (Team Battle Arena)
(92, 10),  -- Destiny 2 (Team PvP Elements)
(124, 10), -- Warborne (Strategy/Tactical)
(123, 10); -- War Rats (Strategy/Team)

-- 3. PLATFORMER (ID: 13)
-- Current: 4 | Adding: 3
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(18, 13),  -- Hollow Knight (Metroidvania/Platformer)
(27, 13),  -- Terraria (2D Platforming elements)
(115, 13); -- Sky (Traversal/Platforming)

-- 4. PUZZLE (ID: 7)
-- Current: 2 | Adding: 5
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(7, 7),    -- Celeste (Puzzle Platformer)
(107, 7),  -- It Takes 2 (Co-op Puzzle)
(112, 7),  -- REPO (Simulation/Task Management Puzzle)
(113, 7),  -- Schedule (Utility/Logic)
(93, 7);   -- Dispatch (Management Puzzle)

-- 5. SANDBOX (ID: 12)
-- Current: 1 | Adding: 6
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(12, 12),  -- Don't Starve (Survival Sandbox)
(24, 12),  -- RUST (Open Sandbox)
(26, 12),  -- Stardew Valley (Farming Sandbox)
(29, 12),  -- Trailmakers (Building Sandbox)
(81, 12),  -- Anno (City Building Sandbox)
(102, 12); -- GTA (Open World Sandbox)

-- 6. SPORTS (ID: 6)
-- Current: 5 | Adding: 2
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(84, 6),   -- Beam N.G (Vehicle/Motorsport)
(15, 6);   -- Euro Truck Simulator 2 (Driving)

-- 7. STEALTH (ID: 14)
-- Current: 0 found in dump | Adding: 7
INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(11, 14),  -- Deus Ex Mankind Divided (Stealth RPG)
(125, 14), -- Watch Dogs 2 (Hacker/Stealth)
(10, 14),  -- Dead by Daylight (Hide and Seek Stealth)
(109, 14), -- Little Nightmare 3 (Horror Stealth)
(2, 14),   -- Among Us (Social Stealth)
(101, 14), -- Ghost (Mystery/Stealth)
(114, 14); -- Silent Hill (Horror/Evasion)

-- --------------------------------------------------------
-- Assign Existing Games to Survival Genre (Target: 7+)
-- Genre ID: 11
-- --------------------------------------------------------

INSERT INTO `game_genre` (`game_id`, `genre_id`) VALUES
(24, 11),  -- RUST (The quintessential survival game)
(12, 11),  -- Don't Starve (Wilderness survival)
(27, 11),  -- Terraria (Survival/Sandbox adventure)
(10, 11),  -- Dead by Daylight (Survival Horror)
(19, 11),  -- Left 4 Dead 2 (Co-op Zombie Survival)
(20, 11),  -- Phasmophobia (Ghost hunting survival)
(23, 11),  -- Resident Evil Village (Survival Horror)
(30, 11),  -- Vampire Survivors (Action Survival)
(94, 11),  -- Don't Scream (Microphone-enabled survival horror)
(114, 11); -- Silent Hill (Psychological survival horror)