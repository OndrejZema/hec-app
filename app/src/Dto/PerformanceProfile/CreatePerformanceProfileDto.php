<?php

namespace App\Dto\PerformanceProfile;

use App\Dto\House\HouseDto;
use App\Enum\ProfileTypeEnum;

class CreatePerformanceProfileDto
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public ProfileTypeEnum $type;
    public int $performanceIndex;

    public int $houseId;

    /** @var array<int> */
    public array $profileDay;
    /** @var array<int> */
    public array $profileWeek;
    /** @var array<int> */
    public array $profileMonth;
    /** @var array<int> */
    public array $profileYear;
}
