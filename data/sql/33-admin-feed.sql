CREATE SEQUENCE admin_feed_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

CREATE TABLE admin_feed (
    id integer NOT NULL DEFAULT nextval('admin_feed_id_seq'::regclass),
    user_id integer NOT NULL,
    type smallint NOT NULL,
	created_ts integer NOT NULL,
    text text NOT NULL,
	CONSTRAINT admin_feed_pk PRIMARY KEY (id)
) WITH (OIDS=FALSE);
ALTER TABLE public.admin_feed OWNER TO postgres;

ALTER SEQUENCE admin_feed_id_seq OWNED BY admin_feed.id;