<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class SectionHeader
{
    public string $title = '';
    public ?string $createRouteName = null;
}
