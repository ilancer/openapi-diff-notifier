<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity=OpenApiUrl::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?OpenApiUrl $openApi = null;

    /**
     * @ORM\Column(type="json")
     */
    private array $data = [];

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?DateTimeImmutable $createdAt = null;

    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     */
    private bool $isNotified = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return OpenApiUrl|null
     */
    public function getOpenApi(): ?OpenApiUrl
    {
        return $this->openApi;
    }

    /**
     * @param OpenApiUrl|null $openApi
     * @return self
     */
    public function setOpenApi(?OpenApiUrl $openApi): self
    {
        $this->openApi = $openApi;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @return string
     * @throws \JsonException
     */
    public function getDataJson(): string
    {
        return json_encode($this->data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }

    /**
     * @param array $data
     * @return self
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     * @return self
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNotified(): bool
    {
        return $this->isNotified;
    }

    /**
     * @param bool $isNotified
     * @return self
     */
    public function setIsNotified(bool $isNotified): self
    {
        $this->isNotified = $isNotified;

        return $this;
    }
}
