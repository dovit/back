<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Repository\MissionRepository;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class Mission
{
    private $missionRepository;
    private $authorizationChecker;
    private $paginator;

    public function __construct(AuthorizationChecker $authorizationChecker,
                            Paginator $paginator)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->paginator = $paginator;
    }

    public function setRepository(MissionRepository $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function getMissions(User $user, $page, $limit)
    {
        $missionQuery = $this->missionRepository
                    ->myFindAllByUser($user, $this->authorizationChecker->isGranted('ROLE_ADMIN'));
        dump($missionQuery);
        return $this->paginator->paginate(
            $missionQuery,
            $page,
            $limit);
    }
}
