<?php


namespace App\Security;


use App\Entity\Profile;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ProfileVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Profile) {
            return false;
        }

        return true;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        /** @var Profile $profile */
        $profile = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($profile, $user);
            case self::EDIT:
                return $this->canEdit($profile, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Profile $profile, User $user)
    {
        return $profile->isCompleted();
    }

    private function canEdit(Profile $profile, User $user)
    {
        return $profile->getUser() === $user;
    }
}