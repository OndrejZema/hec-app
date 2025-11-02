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
            $selectedId = $this->houseService->getSelectedId($user);
            if($selectedId !== null) {
                $house = $this->houseService->getById($user, $selectedId);
                if($house !== null){
                    $this->selectedHouse = $house->name;
                }
            }

        }

    }

    public string $selectedHouse = '';
}
