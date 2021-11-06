<?php

namespace App\Entity;

use App\Repository\RecipientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RecipientRepository::class)
 *
 * @UniqueEntity(fields={"chatId"})
 */
class Recipient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private ?string $chatId = null;

    /**
     * @var Collection<int, OpenApiUrl>
     *
     * @ORM\ManyToMany(targetEntity=OpenApiUrl::class, mappedBy="recipientList")
     */
    private Collection $openApiList;

    /**
     *
     */
    public function __construct()
    {
        $this->openApiList = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChatId(): ?string
    {
        return $this->chatId;
    }

    /**
     * @param string $chatId
     * @return self
     */
    public function setChatId(string $chatId): self
    {
        $this->chatId = $chatId;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s (%s)', (string)$this->name, (string)$this->chatId);
    }

    /**
     * @return Collection<int, OpenApiUrl>
     */
    public function getOpenApiList(): Collection
    {
        return $this->openApiList;
    }

    /**
     * @param OpenApiUrl $openApiList
     * @return self
     */
    public function addOpenApiList(OpenApiUrl $openApiList): self
    {
        if (!$this->openApiList->contains($openApiList)) {
            $this->openApiList[] = $openApiList;
            $openApiList->addRecipientList($this);
        }

        return $this;
    }

    /**
     * @param OpenApiUrl $openApiList
     * @return self
     */
    public function removeOpenApiList(OpenApiUrl $openApiList): self
    {
        if ($this->openApiList->removeElement($openApiList)) {
            $openApiList->removeRecipientList($this);
        }

        return $this;
    }
}
