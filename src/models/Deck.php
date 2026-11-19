<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

/**
 * Domain entity representing a flashcard deck stored in PostgreSQL.
 */
final class Deck
{
    /** @var array<string, string> */
    public const array ALLOWED_LANGUAGES = [
        'en' => 'Angielski',
        'es' => 'Hiszpański',
        'de' => 'Niemiecki',
        'it' => 'Włoski',
        'fr' => 'Francuski',
    ];

    /** @var list<string> */
    public const array ALLOWED_CEFR_LEVELS = [
        'A1',
        'A2',
        'B1',
        'B2',
        'C1',
        'C2',
    ];

    /** @var array<string, string> */
    public const array ALLOWED_STATUSES = [
        'published' => 'Opublikowana',
        'draft' => 'Szkic',
        'archived' => 'Zarchiwizowana',
    ];

    public function __construct(
        private ?int $id,
        private string $title,
        private ?string $description,
        private string $language,
        private string $cefrLevel,
        private string $status,
        private ?DateTimeImmutable $createdAt = null,
        private ?DateTimeImmutable $updatedAt = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getCefrLevel(): string
    {
        return $this->cefrLevel;
    }

    public function setCefrLevel(string $cefrLevel): void
    {
        $this->cefrLevel = $cefrLevel;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
