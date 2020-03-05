ALTER TABLE parties ADD COLUMN "state" CHAR(3) NOT NULL DEFAULT 'new';
UPDATE parties SET "state" = 'old';