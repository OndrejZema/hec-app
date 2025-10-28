<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class DeleteDialog
{
    public string $routeName = "";
    public int $id;
}
