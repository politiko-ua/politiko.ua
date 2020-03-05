CREATE SEQUENCE public.bookmarks_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE public.bookmarks_id_seq OWNER TO postgres;

CREATE TABLE public.bookmarks
(
  id integer NOT NULL DEFAULT nextval('bookmarks_id_seq'::regclass),
  user_id integer NOT NULL,
  "type" smallint NOT NULL,
  oid integer NOT NULL,
  CONSTRAINT bookmarks_pkey PRIMARY KEY (id),
  CONSTRAINT bookmarks_unique UNIQUE (user_id, type, oid)
)
WITH (OIDS=FALSE);
ALTER TABLE public.bookmarks OWNER TO postgres;