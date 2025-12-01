-- Add system requirements columns to games table
ALTER TABLE `games` 
ADD `min_os` VARCHAR(100) DEFAULT 'Windows 10 or later 64-bit' AFTER `is_recommended`,
ADD `min_processor` VARCHAR(150) DEFAULT 'Intel Core i5-6600K / AMD Ryzen R5 1600' AFTER `min_os`,
ADD `min_memory` VARCHAR(50) DEFAULT '12 GB RAM' AFTER `min_processor`,
ADD `min_graphics` VARCHAR(150) DEFAULT 'GTX 1050 Ti / RX 580 / Arc A380' AFTER `min_memory`,
ADD `min_directx` VARCHAR(50) DEFAULT 'Version 12' AFTER `min_graphics`,
ADD `min_storage` VARCHAR(50) DEFAULT '50 GB available space' AFTER `min_directx`,
ADD `rec_os` VARCHAR(100) DEFAULT 'Windows 10 or later 64-bit' AFTER `min_storage`,
ADD `rec_processor` VARCHAR(150) DEFAULT 'Intel Core i5-9600K / AMD Ryzen 5 3600' AFTER `rec_os`,
ADD `rec_memory` VARCHAR(50) DEFAULT '16 GB RAM' AFTER `rec_processor`,
ADD `rec_graphics` VARCHAR(150) DEFAULT 'RTX 2070 / RX 5700 XT / Arc B570' AFTER `rec_memory`,
ADD `rec_directx` VARCHAR(50) DEFAULT 'Version 12' AFTER `rec_graphics`,
ADD `rec_storage` VARCHAR(50) DEFAULT '50 GB available space' AFTER `rec_directx`;

-- Update games with random system requirements
UPDATE games SET 
    min_os = CASE 
        WHEN game_id % 3 = 0 THEN 'Windows 10 64-bit'
        WHEN game_id % 3 = 1 THEN 'Windows 10 or later 64-bit'
        ELSE 'Windows 11 64-bit'
    END,
    min_processor = CASE 
        WHEN game_id % 4 = 0 THEN 'Intel Core i3-4340 / AMD FX-6300'
        WHEN game_id % 4 = 1 THEN 'Intel Core i5-6600K / AMD Ryzen R5 1600'
        WHEN game_id % 4 = 2 THEN 'Intel Core i5-4460 / AMD Ryzen 3 1200'
        ELSE 'Intel Core i5-2500K / AMD FX-8350'
    END,
    min_memory = CASE 
        WHEN game_id % 5 = 0 THEN '8 GB RAM'
        WHEN game_id % 5 = 1 THEN '12 GB RAM'
        WHEN game_id % 5 = 2 THEN '16 GB RAM'
        WHEN game_id % 5 = 3 THEN '6 GB RAM'
        ELSE '10 GB RAM'
    END,
    min_graphics = CASE 
        WHEN game_id % 6 = 0 THEN 'GTX 960 / RX 560 / Arc A380'
        WHEN game_id % 6 = 1 THEN 'GTX 1050 Ti / RX 580 / Arc A380'
        WHEN game_id % 6 = 2 THEN 'GTX 1060 / RX 580 / Arc A750'
        WHEN game_id % 6 = 3 THEN 'GTX 970 / RX 470'
        WHEN game_id % 6 = 4 THEN 'GTX 1650 / RX 5500 XT'
        ELSE 'GTX 750 Ti / R7 370'
    END,
    min_directx = CASE 
        WHEN game_id % 2 = 0 THEN 'Version 11'
        ELSE 'Version 12'
    END,
    min_storage = CASE 
        WHEN game_id % 7 = 0 THEN '30 GB available space'
        WHEN game_id % 7 = 1 THEN '50 GB available space'
        WHEN game_id % 7 = 2 THEN '70 GB available space'
        WHEN game_id % 7 = 3 THEN '100 GB available space'
        WHEN game_id % 7 = 4 THEN '25 GB available space'
        WHEN game_id % 7 = 5 THEN '40 GB available space'
        ELSE '60 GB available space'
    END,
    rec_os = CASE 
        WHEN game_id % 3 = 0 THEN 'Windows 10 64-bit'
        WHEN game_id % 3 = 1 THEN 'Windows 11 64-bit'
        ELSE 'Windows 10 or later 64-bit'
    END,
    rec_processor = CASE 
        WHEN game_id % 4 = 0 THEN 'Intel Core i5-9600K / AMD Ryzen 5 3600'
        WHEN game_id % 4 = 1 THEN 'Intel Core i7-8700K / AMD Ryzen 5 5600X'
        WHEN game_id % 4 = 2 THEN 'Intel Core i5-10600K / AMD Ryzen 5 5600'
        ELSE 'Intel Core i7-6700K / AMD Ryzen 7 2700X'
    END,
    rec_memory = CASE 
        WHEN game_id % 4 = 0 THEN '16 GB RAM'
        WHEN game_id % 4 = 1 THEN '20 GB RAM'
        WHEN game_id % 4 = 2 THEN '24 GB RAM'
        ELSE '32 GB RAM'
    END,
    rec_graphics = CASE 
        WHEN game_id % 6 = 0 THEN 'RTX 2070 / RX 5700 XT / Arc B570'
        WHEN game_id % 6 = 1 THEN 'RTX 3060 Ti / RX 6700 XT / Arc A770'
        WHEN game_id % 6 = 2 THEN 'RTX 3070 / RX 6800 / Arc A770'
        WHEN game_id % 6 = 3 THEN 'RTX 2060 Super / RX 5700'
        WHEN game_id % 6 = 4 THEN 'RTX 4060 / RX 7600 / Arc B580'
        ELSE 'GTX 1080 Ti / RX Vega 64'
    END,
    rec_directx = 'Version 12',
    rec_storage = CASE 
        WHEN game_id % 7 = 0 THEN '50 GB available space'
        WHEN game_id % 7 = 1 THEN '70 GB available space'
        WHEN game_id % 7 = 2 THEN '100 GB available space'
        WHEN game_id % 7 = 3 THEN '125 GB available space'
        WHEN game_id % 7 = 4 THEN '40 GB available space'
        WHEN game_id % 7 = 5 THEN '60 GB available space'
        ELSE '80 GB available space'
    END
WHERE is_published = 1;
