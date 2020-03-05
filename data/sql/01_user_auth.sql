CREATE TABLE user_auth
(
  id serial NOT NULL,
  email character varying(64) NOT NULL,
  "password" character varying(32) NOT NULL,
  politics character varying(64),
  CONSTRAINT id PRIMARY KEY (id)
)
WITH (OIDS=FALSE);