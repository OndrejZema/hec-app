<?php

namespace App\Dto\ConsumptionProfile;

use App\Enum\ProfileTypeEnum;

class UpdateConsumptionProfileDto
{
    public int $id;
    public string $name;
    public ?string $description;
    public ProfileTypeEnum $type;
    public int $houseId;
    public int $consumptionIndex;
    /** @var array<int> */
    public array $profileDay;
    /** @var array<int> */
    public array $profileWeek;
    /** @var array<int> */
    public array $profileMonth;
    /** @var array<int> */
    public array $profileYear;
}
