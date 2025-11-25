<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Service\Interface\IHouseService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class SelectedHouse
{
    public function __construct(
        protected Security      $security,
        protected IHouseService $houseService,
    )
    {
        $user = $this->security->getUser();
        if ($user instanceof User) {
            $this->selectedHouse = $this->houseService->getCurrentForUser($user)?->name;
        }

    }

    public string $selectedHouse = '';
}
