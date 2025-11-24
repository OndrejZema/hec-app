<?php

namespace App\Service\Interface;

interface IDateRangeService
{
    /**
     * @return array<string>
     */
    public function hours(): array;

    /**
     * @return array<string>
     */
    public function days(): array;

    /**
     * @return array<string>
     */
    public function weeks(): array;

    /**
     * @return array<string>
     */
    public function months(): array;
}
