<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Deck;

/**
 * Persistence contract for Deck entities.
 */
interface DeckRepositoryInterface
{
    /** @return list<Deck> */
    public function findAll(): array;

    public function find(int $id): ?Deck;

    public function save(Deck $deck): void;

    public function update(Deck $deck): void;

    public function delete(int $id): void;
}
