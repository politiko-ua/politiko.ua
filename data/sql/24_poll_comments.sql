CREATE SEQUENCE polls_comments_id_seq
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

CREATE TABLE polls_comments (
    id integer NOT NULL DEFAULT nextval('polls_comments_id_seq'::regclass),
    poll_id integer,
    user_id integer,
    text text,
    created_ts integer,
    parent_id integer DEFAULT 0 NOT NULL,
    childs text DEFAULT ''::text NOT NULL,
    rate integer DEFAULT 0 NOT NULL,
	CONSTRAINT polls_comments_pk PRIMARY KEY (id)
) WITH (OIDS=FALSE);
ALTER TABLE public.polls_comments OWNER TO postgres;

ALTER SEQUENCE polls_comments_id_seq OWNED BY polls_comments.id;

CREATE INDEX polls_comments_parent_id
  ON public.polls_comments
  USING btree
  (parent_id);

CREATE INDEX polls_comments_poll_id
  ON public.polls_comments
  USING btree
  (poll_id);