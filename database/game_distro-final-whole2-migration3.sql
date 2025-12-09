-- Migration: Add played_on column to reviews table
-- Date: December 9, 2025
-- Description: Adds a column to store the device/platform the user played the game on

ALTER TABLE reviews
ADD COLUMN played_on VARCHAR(100) DEFAULT NULL COMMENT 'Device/platform the user played the game on (e.g., PC, PS5, Xbox Series X)';

-- Optional: Add index for better query performance if needed
-- CREATE INDEX idx_played_on ON reviews(played_on);
