CREATE TABLE public.blogs_mentions
(
  post_id integer NOT NULL,
  user_id integer NOT NULL,
  CONSTRAINT blogs_mentions_pkey PRIMARY KEY (post_id, user_id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.blogs_mentions OWNER TO postgres;