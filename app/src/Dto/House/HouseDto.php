<?php

namespace App\Dto\House;

class HouseDto
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public bool $isCurrent = false;
    public int $performanceProfileCount = 0;
    public int $consumptionProfileCount = 0;
}
