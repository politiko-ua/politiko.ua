CREATE SEQUENCE public.feed_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE public.feed_id_seq OWNER TO postgres;

CREATE TABLE public.feed
(
  id integer NOT NULL DEFAULT nextval('feed_id_seq'::regclass),
  user_id integer NOT NULL,
  created_ts integer NOT NULL,
  actor integer NOT NULL,
  "action" smallint NOT NULL,
  section smallint NOT NULL DEFAULT 1,
  "text" text NOT NULL,
  CONSTRAINT feed_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.feed OWNER TO postgres;