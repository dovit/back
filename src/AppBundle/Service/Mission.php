<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Repository\MissionRepository;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class Mission
{
    private $missionRepository;
    private $authorizationChecker;

    public function __construct(AuthorizationChecker $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function setRepository(MissionRepository $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function getMissions(User $user)
    {
        return $this->missionRepository
                    ->myFindAllByUser($user, $this->authorizationChecker->isGranted('ROLE_ADMIN'));
    }
}
