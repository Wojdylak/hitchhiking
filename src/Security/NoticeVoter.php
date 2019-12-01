<?php


namespace App\Security;


use App\Entity\Notice;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class NoticeVoter extends Voter
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

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Notice) {
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

        /** @var Notice $notice */
        $notice = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($notice, $user);
            case self::EDIT:
                return $this->canEdit($notice, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Notice $notice, User $user)
    {
        return $user->getProfile()->isCompleted();
    }

    private function canEdit(Notice $notice, User $user)
    {
        return $notice->getUser() === $user;
    }
}