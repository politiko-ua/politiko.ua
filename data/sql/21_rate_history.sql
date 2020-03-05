CREATE SEQUENCE public.rate_history_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE public.rate_history_id_seq OWNER TO postgres;

CREATE TABLE public.rate_history
(
  id integer NOT NULL DEFAULT nextval('rate_history_id_seq'::regclass),
  "type" smallint NOT NULL,
  object_id integer NOT NULL,
  user_id integer NOT NULL,
  rate smallint NOT NULL,
  CONSTRAINT rate_history_pkey PRIMARY KEY (id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.rate_history OWNER TO postgres;