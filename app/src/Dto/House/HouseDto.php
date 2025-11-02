<?php

namespace App\Dto\House;

class HouseDto
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public bool $isSelected = false;
}
