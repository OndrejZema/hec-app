<?php

namespace App\Dto\BrokerProfile;

class CreateBrokerProfileDto
{
    public string $name;
    public ?string $description;
    /** @var array<int> */
    public array $purchaseProfileDay = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $purchaseProfileWeek = [10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $purchaseProfileMonth = [10, 10, 10, 10];
    /** @var array<int> */
    public array $purchaseProfileYear = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $saleProfileDay = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $saleProfileWeek = [10, 10, 10, 10, 10, 10, 10];
    /** @var array<int> */
    public array $saleProfileMonth = [10, 10, 10, 10];
    /** @var array<int> */
    public array $saleProfileYear = [10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10];
}
