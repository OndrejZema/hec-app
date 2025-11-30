<?php

namespace App\Dto\PerformanceProfile;

use App\Enum\ProfileTypeEnum;

class PerformanceProfileDto
{
    public int $id;
    public string $name;
    public ?string $description;
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
