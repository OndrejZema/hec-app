<?php

namespace App\Dto\House;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateHouseDto
{

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $id;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public string $name;

    #[Assert\Length(max: 255)]
    public ?string $description = null;
}
