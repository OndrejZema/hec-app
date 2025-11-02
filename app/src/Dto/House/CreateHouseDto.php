<?php

namespace App\Dto\House;
use Symfony\Component\Validator\Constraints as Assert;
class CreateHouseDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public string $name;

    #[Assert\Length(max: 255)]
    public ?string $description = null;
}
