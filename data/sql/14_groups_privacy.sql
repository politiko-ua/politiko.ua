ALTER TABLE public.groups ADD COLUMN privacy smallint NOT NULL DEFAULT 1;

CREATE TABLE public.groups_applicants
(
  group_id integer NOT NULL,
  user_id integer NOT NULL,
  CONSTRAINT groups_applicants_pkey PRIMARY KEY (group_id, user_id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.groups_applicants OWNER TO postgres;