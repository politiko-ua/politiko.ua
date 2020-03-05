CREATE TABLE public.candidates
(
  user_id integer NOT NULL,
  votes integer NOT NULL DEFAULT 0,
  CONSTRAINT candidate_user PRIMARY KEY (user_id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.candidates OWNER TO postgres;

ALTER TABLE public.candidates DROP COLUMN votes;
ALTER TABLE public.candidates ADD COLUMN program text;

CREATE TABLE public.candidates_votes
(
  user_id integer NOT NULL,
  candidate_id integer NOT NULL,
  ip character varying(16) NOT NULL,
  ts integer NOT NULL,
  CONSTRAINT candidate_vote PRIMARY KEY (user_id, candidate_id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.candidates_votes OWNER TO postgres;

CREATE INDEX candidate_vote_index
  ON public.candidates_votes
  USING btree
  (candidate_id);