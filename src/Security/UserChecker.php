<?php
namespace App\Security;


use App\Entity\User;
use App\Entity\Utilisateur as AppUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class UserChecker implements UserCheckerInterface
{


    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.

    }

    public function checkPostAuth(UserInterface $user) :void
    {
        if (!$user instanceof User) {
            return;
        }


        // user account is expired, the user may be notified
        if (!$user->isVerified()) {


            throw new AccountExpiredException('verfier votre account');
        }

        $etat="desactiver";
        if ( hash_equals($user->getIsactive(), $etat))
        {
            $redirectResponse = new RedirectResponse('banned');
            $redirectResponse->send();
            throw new AccountExpiredException('you are banned');

        }




    }
}