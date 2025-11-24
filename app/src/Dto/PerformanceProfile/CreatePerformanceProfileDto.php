<?php

namespace App\Dto\PerformanceProfile;

use App\Enum\ProfileTypeEnum;

class CreatePerformanceProfileDto
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public ProfileTypeEnum $type = ProfileTypeEnum::AI;
    public int $performanceIndex = 1;

    public int $houseId;

    /** @var array<int> */
    public array $profileDay = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $profileWeek = [10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $profileMonth = [10, 10, 10, 10];
    /** @var array<int> */
    public array $profileYear = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
}
