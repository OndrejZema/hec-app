<?php

namespace App\Dto\BrokerProfile;

class BrokerProfileDto
{
    public int $id;
    public string $name;
    public ?string $description;
    /** @var array<int> */
    public array $purchaseProfileDay;
    /** @var array<int> */
    public array $purchaseProfileWeek;
    /** @var array<int> */
    public array $purchaseProfileMonth;
    /** @var array<int> */
    public array $purchaseProfileYear;
    /** @var array<int> */
    public array $saleProfileDay;
    /** @var array<int> */
    public array $saleProfileWeek;
    /** @var array<int> */
    public array $saleProfileMonth;
    /** @var array<int> */
    public array $saleProfileYear;
    public bool $isCurrent = false;
}
