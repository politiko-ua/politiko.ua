CREATE SEQUENCE public.ideas_comments_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 108
  CACHE 1;
ALTER TABLE public.ideas_comments_id_seq OWNER TO postgres;

CREATE TABLE public.ideas_comments
(
  id integer NOT NULL DEFAULT nextval('ideas_comments_id_seq'::regclass),
  ideas_id integer,
  user_id integer,
  "text" text,
  created_ts integer,
  parent_id integer NOT NULL DEFAULT 0,
  childs text NOT NULL DEFAULT ''::text,
  rate integer NOT NULL DEFAULT 0,
  CONSTRAINT ideas_comments_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.ideas_comments OWNER TO postgres;

CREATE INDEX ideas_comments_parent_id
  ON public.ideas_comments
  USING btree
  (parent_id);

CREATE INDEX ideas_comments_id
  ON public.ideas_comments
  USING btree
  (ideas_id);

ALTER TABLE public.ideas_comments RENAME ideas_id  TO idea_id;