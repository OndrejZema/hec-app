<?php

namespace App\Dto\ConsumptionProfile;

use App\Enum\ProfileTypeEnum;

class CreateConsumptionProfileDto
{
    public int $id;
    public string $name;
    public ?string $description = null;
    public ProfileTypeEnum $type = ProfileTypeEnum::AI;
    public int $houseId;
    public int $consumptionIndex = 1;
    /** @var array<int> */
    public array $profileDay = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $profileWeek = [10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $profileMonth = [10, 10, 10, 10];
    /** @var array<int> */
    public array $profileYear = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
}
