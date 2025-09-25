<?php

namespace App\Twig\Components\Home;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('home:FeatureCardLg')]
final class FeatureCardLg
{
    public string $title = '-';
    public string $text = '-';
    public string $icon = '';

}
