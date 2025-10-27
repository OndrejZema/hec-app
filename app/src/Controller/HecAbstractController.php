<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HecAbstractController extends AbstractController
{
    public function getAppUser(): User{
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Musíš být přihlášen');
        }
        return $user;
    }
}
