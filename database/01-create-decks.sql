CREATE TABLE decks (
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NULL,
    language VARCHAR(10) NOT NULL,
    cefr_level VARCHAR(2) NOT NULL DEFAULT 'A1',
    status VARCHAR(20) NOT NULL DEFAULT 'published',
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT decks_language_check CHECK (language IN ('en', 'es', 'de', 'it', 'fr')),
    CONSTRAINT decks_cefr_level_check CHECK (cefr_level IN ('A1', 'A2', 'B1', 'B2', 'C1', 'C2')),
    CONSTRAINT decks_status_check CHECK (status IN ('draft', 'published', 'archived'))
);

CREATE INDEX decks_status_idx ON decks (status);
CREATE INDEX decks_language_cefr_idx ON decks (language, cefr_level);
CREATE INDEX decks_created_at_idx ON decks (created_at DESC);
