CREATE SEQUENCE public.groups_photo_comments_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 138
  CACHE 1;
ALTER TABLE public.groups_photo_comments_id_seq OWNER TO postgres;

CREATE TABLE public.groups_photo_comments
(
  id integer NOT NULL DEFAULT nextval('groups_photo_comments_id_seq'::regclass),
  photo_id integer,
  user_id integer,
  "text" text,
  created_ts integer,
  parent_id integer NOT NULL DEFAULT 0,
  childs text NOT NULL DEFAULT ''::text,
  rate integer NOT NULL DEFAULT 0,
  CONSTRAINT groups_photo_comments_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.groups_photo_comments OWNER TO postgres;

CREATE INDEX groups_photo_comments_parent_id
  ON public.groups_photo_comments
  USING btree
  (parent_id);

CREATE INDEX groups_photo_comments_photo_id
  ON public.groups_photo_comments
  USING btree
  (photo_id);