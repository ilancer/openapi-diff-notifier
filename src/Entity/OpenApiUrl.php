<?php

namespace App\Entity;

use App\Repository\OpenApiUrlRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OpenApiUrlRepository::class)
 *
 * @UniqueEntity(fields={"url"})
 */
class OpenApiUrl
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     *
     * @Assert\NotBlank()
     * @Assert\Url()
     * @Assert\Length(max=255)
     */
    private ?string $url = null;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private ?string $title = null;

    /**
     * @var Collection<int, Recipient>
     *
     * @ORM\ManyToMany(targetEntity=Recipient::class, inversedBy="openApiList")
     */
    private Collection $recipientList;

    /**
     *
     */
    public function __construct()
    {
        $this->recipientList = new ArrayCollection();
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
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function __toString()
    {
        return (string)$this->title;
    }

    /**
     * @return Collection<int, Recipient>
     */
    public function getRecipientList(): Collection
    {
        return $this->recipientList;
    }

    /**
     * @param Recipient $recipientList
     * @return $this
     */
    public function addRecipientList(Recipient $recipientList): self
    {
        if (!$this->recipientList->contains($recipientList)) {
            $this->recipientList[] = $recipientList;
        }

        return $this;
    }

    /**
     * @param Recipient $recipientList
     * @return self
     */
    public function removeRecipientList(Recipient $recipientList): self
    {
        $this->recipientList->removeElement($recipientList);

        return $this;
    }
}
