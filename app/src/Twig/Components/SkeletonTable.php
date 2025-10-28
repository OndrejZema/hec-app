<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class SkeletonTable
{
    public int $colsCount = 5;
    public int $rowsCount = 5;
}
