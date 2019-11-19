<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Ramsey\Uuid\Uuid;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverImageName;


    /**
     * @var File|null
     * @Vich\UploadableField(mapping="articles", fileNameProperty="coverImageName")
     */
    private $coverImageFile;

    /**
     * @ORM\Column(type="string")
     */
    public $uuid;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;




    /**
     * Articles constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->created_at = new \DateTime;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCoverImageName(): ?string
    {
        return $this->coverImageName;
    }

    public function setCoverImageName(?string $coverImageName): self
    {
        $this->coverImageName = $coverImageName;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getCoverImageFile(): ?File
    {
        return $this->coverImageFile;
    }

    /**
     * @param File|null $coverImageFile
     * @return Articles
     */
    public function setCoverImageFile(?File $coverImageFile): Articles
    {
        $this->coverImageFile = $coverImageFile;
        if($this->coverImageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid( string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getSlug():string
    {
        return (new Slugify())->slugify($this->title);
    }



    /**
     * @ORM\PreUpdate
     * @throws \Exception
     */
    public function saveUpdate(){
        $this->updated_at = new \DateTime;
    }




}
