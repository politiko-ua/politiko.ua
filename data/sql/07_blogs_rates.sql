ALTER TABLE public.blogs_posts RENAME rate  TO "for";
ALTER TABLE public.blogs_posts ADD COLUMN against integer NOT NULL DEFAULT 0;
UPDATE blogs_posts SET "for" = 0, against = "for" WHERE "for" < 0;
UPDATE blogs_posts SET against = -against WHERE against < 0;