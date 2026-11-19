<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Deck;
use DateTimeImmutable;
use InvalidArgumentException;
use PDO;

/**
 * PostgreSQL PDO repository responsible for Deck CRUD operations.
 */
final class DeckRepository implements DeckRepositoryInterface
{
    public function __construct(private PDO $database)
    {
    }

    /** @return list<Deck> */
    public function findAll(): array
    {
        $statement = $this->database->query(
            'SELECT id, title, description, language, cefr_level, status, created_at, updated_at
             FROM decks
             ORDER BY created_at DESC, id DESC'
        );

        $decks = [];
        foreach ($statement->fetchAll() as $row) {
            $decks[] = $this->mapRowToDeck($row);
        }

        return $decks;
    }

    public function find(int $id): ?Deck
    {
        $statement = $this->database->prepare(
            'SELECT id, title, description, language, cefr_level, status, created_at, updated_at
             FROM decks
             WHERE id = :id'
        );
        $statement->execute(['id' => $id]);

        $row = $statement->fetch();

        return $row === false ? null : $this->mapRowToDeck($row);
    }

    public function save(Deck $deck): void
    {
        $statement = $this->database->prepare(
            'INSERT INTO decks (title, description, language, cefr_level, status)
             VALUES (:title, :description, :language, :cefr_level, :status)
             RETURNING id'
        );
        $statement->execute([
            'title' => $deck->getTitle(),
            'description' => $deck->getDescription(),
            'language' => $deck->getLanguage(),
            'cefr_level' => $deck->getCefrLevel(),
            'status' => $deck->getStatus(),
        ]);

        $deck->setId((int) $statement->fetchColumn());
    }

    public function update(Deck $deck): void
    {
        if ($deck->getId() === null) {
            throw new InvalidArgumentException('Nie można zaktualizować talii bez identyfikatora.');
        }

        $statement = $this->database->prepare(
            'UPDATE decks
             SET title = :title,
                 description = :description,
                 language = :language,
                 cefr_level = :cefr_level,
                 status = :status,
                 updated_at = CURRENT_TIMESTAMP
             WHERE id = :id'
        );
        $statement->execute([
            'id' => $deck->getId(),
            'title' => $deck->getTitle(),
            'description' => $deck->getDescription(),
            'language' => $deck->getLanguage(),
            'cefr_level' => $deck->getCefrLevel(),
            'status' => $deck->getStatus(),
        ]);
    }

    public function delete(int $id): void
    {
        $statement = $this->database->prepare(
            'DELETE FROM decks WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
    }

    /** @param array<string, mixed> $row */
    private function mapRowToDeck(array $row): Deck
    {
        return new Deck(
            (int) $row['id'],
            (string) $row['title'],
            $row['description'] === null ? null : (string) $row['description'],
            (string) $row['language'],
            (string) $row['cefr_level'],
            (string) $row['status'],
            new DateTimeImmutable((string) $row['created_at']),
            new DateTimeImmutable((string) $row['updated_at']),
        );
    }
}
