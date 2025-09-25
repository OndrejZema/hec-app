<?php

namespace App\Twig\Components\Home;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('home:FeatureCardSm')]
final class FeatureCardSm
{
    public string $label = '-';
    public string $value = '-';
}
