<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $prix = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Ville $ville = null;

    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'produit', orphanRemoval: true)]
    private Collection $commentaires;

    #[ORM\ManyToMany(targetEntity: MotCles::class, inversedBy: 'produits')]
    private Collection $motsCles;

    #[ORM\Column(length: 255)]
    private ?string $nbrNuit = null;

    #[ORM\Column(length: 255)]
    private ?string $photo2 = null;

    #[ORM\Column(length: 255)]
    private ?string $photo3 = null;

    #[ORM\Column(length: 255)]
    private ?string $photo4 = null;

    #[ORM\Column(length: 255)]
    private ?string $photo5 = null;

    #[ORM\Column(length: 255)]
    private ?string $photo6 = null;

    #[ORM\ManyToMany(targetEntity: DecouvrirSurPlace::class, inversedBy: 'produits')]
    private Collection $decouvrirSurPlace;

    #[ORM\ManyToMany(targetEntity: DecouvrirAProximiter::class, inversedBy: 'produits')]
    private Collection $decouvrirAProximiter;



    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?InformationsHorraireArv $informationsHorraireArv = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?InformationsHorraireDeaprt $informationsHorraireDepart = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?InformationsAnnimaux $informationsAnnimaux = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Region $region = null;

    #[ORM\OneToMany(targetEntity: Panier::class, mappedBy: 'produit')]
    private Collection $paniers;







    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->motsCles = new ArrayCollection();
        $this->decouvrirSurPlace = new ArrayCollection();
        $this->decouvrirAProximiter = new ArrayCollection();
        $this->paniers = new ArrayCollection();


    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setProduit($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getProduit() === $this) {
                $commentaire->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MotCles>
     */
    public function getMotsCles(): Collection
    {
        return $this->motsCles;
    }

    public function addMotsCle(MotCles $motsCle): static
    {
        if (!$this->motsCles->contains($motsCle)) {
            $this->motsCles->add($motsCle);
        }

        return $this;
    }

    public function removeMotsCle(MotCles $motsCle): static
    {
        $this->motsCles->removeElement($motsCle);

        return $this;
    }

    public function getNbrNuit(): ?string
    {
        return $this->nbrNuit;
    }

    public function setNbrNuit(string $nbrNuit): static
    {
        $this->nbrNuit = $nbrNuit;

        return $this;
    }

    public function getPhoto2(): ?string
    {
        return $this->photo2;
    }

    public function setPhoto2(string $photo2): static
    {
        $this->photo2 = $photo2;

        return $this;
    }

    public function getPhoto3(): ?string
    {
        return $this->photo3;
    }

    public function setPhoto3(string $photo3): static
    {
        $this->photo3 = $photo3;

        return $this;
    }

    public function getPhoto4(): ?string
    {
        return $this->photo4;
    }

    public function setPhoto4(string $photo4): static
    {
        $this->photo4 = $photo4;

        return $this;
    }

    public function getPhoto5(): ?string
    {
        return $this->photo5;
    }

    public function setPhoto5(string $photo5): static
    {
        $this->photo5 = $photo5;

        return $this;
    }

    public function getPhoto6(): ?string
    {
        return $this->photo6;
    }

    public function setPhoto6(string $photo6): static
    {
        $this->photo6 = $photo6;

        return $this;
    }

    /**
     * @return Collection<int, DecouvrirSurPlace>
     */
    public function getDecouvrirSurPlace(): Collection
    {
        return $this->decouvrirSurPlace;
    }

    public function addDecouvrirSurPlace(DecouvrirSurPlace $decouvrirSurPlace): static
    {
        if (!$this->decouvrirSurPlace->contains($decouvrirSurPlace)) {
            $this->decouvrirSurPlace->add($decouvrirSurPlace);
        }

        return $this;
    }

    public function removeDecouvrirSurPlace(DecouvrirSurPlace $decouvrirSurPlace): static
    {
        $this->decouvrirSurPlace->removeElement($decouvrirSurPlace);

        return $this;
    }

    /**
     * @return Collection<int, DecouvrirAProximiter>
     */
    public function getDecouvrirAProximiter(): Collection
    {
        return $this->decouvrirAProximiter;
    }

    public function addDecouvrirAProximiter(DecouvrirAProximiter $decouvrirAProximiter): static
    {
        if (!$this->decouvrirAProximiter->contains($decouvrirAProximiter)) {
            $this->decouvrirAProximiter->add($decouvrirAProximiter);
        }

        return $this;
    }

    public function removeDecouvrirAProximiter(DecouvrirAProximiter $decouvrirAProximiter): static
    {
        $this->decouvrirAProximiter->removeElement($decouvrirAProximiter);

        return $this;
    }



    public function getInformationsHorraireArv(): ?InformationsHorraireArv
    {
        return $this->informationsHorraireArv;
    }

    public function setInformationsHorraireArv(?InformationsHorraireArv $informationsHorraireArv): static
    {
        $this->informationsHorraireArv = $informationsHorraireArv;

        return $this;
    }

    public function getInformationsHorraireDepart(): ?InformationsHorraireDeaprt
    {
        return $this->informationsHorraireDepart;
    }

    public function setInformationsHorraireDepart(?InformationsHorraireDeaprt $informationsHorraireDepart): static
    {
        $this->informationsHorraireDepart = $informationsHorraireDepart;

        return $this;
    }

    public function getInformationsAnnimaux(): ?InformationsAnnimaux
    {
        return $this->informationsAnnimaux;
    }

    public function setInformationsAnnimaux(?InformationsAnnimaux $informationsAnnimaux): static
    {
        $this->informationsAnnimaux = $informationsAnnimaux;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection<int, Panier>
     */
    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): static
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->setProduit($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): static
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getProduit() === $this) {
                $panier->setProduit(null);
            }
        }

        return $this;
    }



    
}
