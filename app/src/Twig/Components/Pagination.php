<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Pagination
{
    public string $routeName = '';
    public int $page = 1;
    public int $perPage = 10;
    public int $lastPage = 0;
}
