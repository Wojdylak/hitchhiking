<?php


namespace App\Security;


use App\Entity\Picture;
use App\Entity\User;
use App\Service\NoticeService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;

class PictureVoter
{
    const EDIT = 'edit';

    /**
     * @var Security
     */
    private $security;
    /**
     * @var NoticeService
     */
    private $noticeService;

    public function __construct(Security $security, NoticeService $noticeService)
    {
        $this->security = $security;
        $this->noticeService = $noticeService;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::EDIT])) {
            return false;
        }

        if (!$subject instanceof Picture) {
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

        /** @var Picture $picture */
        $picture = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($picture, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit(Picture $picture, User $user)
    {
        return $picture->getOwner() === $user;
    }
}