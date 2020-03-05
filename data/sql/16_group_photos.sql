CREATE SEQUENCE public.groups_photos_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE public.groups_photos_id_seq OWNER TO postgres;

CREATE TABLE public.groups_photos
(
  id integer NOT NULL DEFAULT nextval('groups_photos_id_seq'::regclass),
  album_id integer NOT NULL DEFAULT 0,
  group_id integer NOT NULL,
  salt integer NOT NULL,
  CONSTRAINT groups_photos_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.groups_photos OWNER TO postgres;

CREATE SEQUENCE public.groups_photos_albums_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE public.groups_photos_albums_id_seq OWNER TO postgres;

CREATE TABLE public.groups_photos_albums
(
  id integer NOT NULL DEFAULT nextval('groups_photos_albums_id_seq'::regclass),
  group_id integer NOT NULL,
  title character varying NOT NULL,
  CONSTRAINT groups_photos_albums_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.groups_photos_albums OWNER TO postgres;