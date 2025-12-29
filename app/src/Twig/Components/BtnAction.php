<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class BtnAction
{
    public string $action = "";
    public string $csrf = "";
    public string $method = "POST";
    public string $iconName = "";
}
