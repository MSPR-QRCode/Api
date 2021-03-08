<?php

namespace App\Entity;

use App\Repository\QrCodeRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QrCodeRepository::class)
 */
class QrCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("jsonPromotions")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     * @Groups("jsonGetIdAndMy")
     */
    private $idQRCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"jsonGetIdAndMy","jsonPromotions"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"jsonGetIdAndMy","jsonPromotions"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"jsonGetIdAndMy","jsonPromotions"})
     */
    private $image;

    /**
     * @ORM\Column(type="integer", length=255)
     * @Groups({"jsonGetIdAndMy","jsonPromotions"})
     */
    private $dateCrea;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     * @Groups({"jsonGetIdAndMy","jsonPromotions"})
     */
    private $dateExp;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("jsonGetIdAndMy")
     */
    private $codePromo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdQRCode(): ?string
    {
        return $this->idQRCode;
    }

    public function setIdQRCode(string $idQRCode): self
    {
        $this->idQRCode = $idQRCode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateCrea(): ?int
    {
        return $this->dateCrea;
    }

    public function setDateCrea(int $dateCrea): self
    {
        $this->dateCrea = $dateCrea;

        return $this;
    }

    public function getDateExp(): ?int
    {
        return $this->dateExp;
    }

    public function setDateExp(int $dateExp): self
    {
        $this->dateExp = $dateExp;

        return $this;
    }

    public function getCodePromo(): ?string
    {
        return $this->codePromo;
    }

    public function setCodePromo(string $codePromo): self
    {
        $this->codePromo = $codePromo;

        return $this;
    }


}
