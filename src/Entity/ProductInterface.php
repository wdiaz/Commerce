<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;

interface ProductInterface
{
    public function getName(): ?string;

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection;

    public function getMainImage(): ?string;

    public function hasVariants(): bool;

    public function getPrice(): ?string;

    public function getLongDescription(): ?string;
}
