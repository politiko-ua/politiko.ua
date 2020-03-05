CREATE SEQUENCE public.comments_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 138
  CACHE 1;
ALTER TABLE public.comments_id_seq OWNER TO postgres;

CREATE TABLE public.comments
(
  id integer NOT NULL DEFAULT nextval('comments_id_seq'::regclass),
  oid integer,
  otype smallint,
  user_id integer,
  "text" text,
  created_ts integer,
  parent_id integer NOT NULL DEFAULT 0,
  childs text NOT NULL DEFAULT ''::text,
  rate integer NOT NULL DEFAULT 0,
  CONSTRAINT comments_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.comments OWNER TO postgres;

CREATE INDEX comments_parent_id
  ON public.comments
  USING btree
  (parent_id);

CREATE INDEX comments_oidid
  ON public.comments
  USING btree
  (otype, oid);