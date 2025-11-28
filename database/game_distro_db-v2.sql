!-- Adding a new column 'category' to the 'community_posts' table

ALTER TABLE `community_posts` ADD `category` ENUM('general','feedback','help','guide') NOT NULL DEFAULT 'general' AFTER `content`;
