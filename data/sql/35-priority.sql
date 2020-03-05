ALTER TABLE blogs_posts ADD COLUMN sort_ts integer NOT NULL DEFAULT 0;
UPDATE blogs_posts SET sort_ts = created_ts;