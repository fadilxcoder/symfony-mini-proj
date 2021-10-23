<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class VehiculesVoter extends Voter
{
    private const SHOW_DRIVER = 'show_drivers';
    private const UNUSED_DRIVER = 'unused_drivers';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::SHOW_DRIVER, self::UNUSED_DRIVER])
            && $subject instanceof \App\Entity\Vehicules;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::SHOW_DRIVER:
                return $this->hasRoleSupport();
                break;
            case self::UNUSED_DRIVER:
                // return true or false
                break;
        }

        return false;
    }

    private function hasRoleSupport()
    {
        return $this->security->isGranted('ROLE_SUPPORT');
    }
}
