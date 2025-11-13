<?php

namespace App\Dto\ConsumptionProfile;

use App\Enum\ProfileTypeEnum;

class ConsumptionProfileDto
{
    public int $id;
    public string $name;
    public ?string $description;
    public ProfileTypeEnum $type;
    /** @var array<int> */
    public array $profileDay;
    /** @var array<int> */
    public array $profileWeek;
    /** @var array<int> */
    public array $profileMonth;
    /** @var array<int> */
    public array $profileYear;
}
