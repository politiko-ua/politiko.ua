CREATE TABLE public.candidates_forecast
(
  user_id integer NOT NULL,
  candidate_id integer NOT NULL DEFAULT 0,
  place integer NOT NULL DEFAULT 0,
  votes integer NOT NULL DEFAULT 0,
  CONSTRAINT candidate_forecast_user PRIMARY KEY (user_id, candidate_id)
)
WITH (OIDS=FALSE);
ALTER TABLE public.candidates OWNER TO postgres;