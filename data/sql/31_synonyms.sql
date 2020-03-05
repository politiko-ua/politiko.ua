CREATE TABLE public.user_dictionary
(
  user_id integer NOT NULL,
  names TEXT NOT NULL,
  CONSTRAINT user_dictionaty_user PRIMARY KEY (user_id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.user_dictionary OWNER TO postgres;
