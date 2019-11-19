<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ResumeMeRepository")
 * @Vich\Uploadable()
 */
class ResumeMe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filenameCv;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="resume_cv", fileNameProperty="filenameCv")
     */
    private $CvFile;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="resume_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $firstname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $available;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Works", mappedBy="resumeMe")
     */
    private $works;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formations", mappedBy="resumeMe")
     */
    private $formations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $introCarrer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $socialLinkedin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $socialGithub;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $interest;

    public function __toString()
    {
        return $this->firstname;
    }

    public function __construct()
    {
        $this->works = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return ResumeMe
     */
    public function setFilename(?string $filename): ResumeMe
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return ResumeMe
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): ResumeMe
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }


    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(?int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilenameCv(): ?string
    {
        return $this->filenameCv;
    }

    /**
     * @param string|null $filenameCv
     * @return ResumeMe
     */
    public function setFilenameCv(?string $filenameCv): ResumeMe
    {
        $this->filenameCv = $filenameCv;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getCvFile(): ?File
    {
        return $this->CvFile;
    }

    /**
     * @param File|null $CvFile
     * @return ResumeMe
     * @throws \Exception
     */
    public function setCvFile(?File $CvFile): ResumeMe
    {
        $this->CvFile = $CvFile;
        if($this->CvFile instanceof UploadedFile){
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return Collection|Works[]
     */
    public function getWorks(): Collection
    {
        return $this->works;
    }

    public function addWork(Works $work): self
    {
        if (!$this->works->contains($work)) {
            $this->works[] = $work;
            $work->setResumeMe($this);
        }

        return $this;
    }

    public function removeWork(Works $work): self
    {
        if ($this->works->contains($work)) {
            $this->works->removeElement($work);
            // set the owning side to null (unless already changed)
            if ($work->getResumeMe() === $this) {
                $work->setResumeMe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formations[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setResumeMe($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): self
    {
        if ($this->formations->contains($formation)) {
            $this->formations->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getResumeMe() === $this) {
                $formation->setResumeMe(null);
            }
        }

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getIntroCarrer(): ?string
    {
        return $this->introCarrer;
    }

    public function setIntroCarrer(?string $introCarrer): self
    {
        $this->introCarrer = $introCarrer;

        return $this;
    }


    public function getSocialLinkedin(): ?string
    {
        return $this->socialLinkedin;
    }

    public function setSocialLinkedin(?string $socialLinkedin): self
    {
        $this->socialLinkedin = $socialLinkedin;

        return $this;
    }

    public function getSocialGithub(): ?string
    {
        return $this->socialGithub;
    }

    public function setSocialGithub(?string $socialGithub): self
    {
        $this->socialGithub = $socialGithub;

        return $this;
    }

    public function getInterest(): ?string
    {
        return $this->interest;
    }

    public function setInterest(string $interest): self
    {
        $this->interest = $interest;

        return $this;
    }

}
