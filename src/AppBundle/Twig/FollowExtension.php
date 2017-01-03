<?php

namespace AppBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;

class FollowExtension extends \Twig_Extension
{
    protected $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('isfollow', array($this, 'isfollowFilter'))
        );
    }

    public function getName()
    {
        return 'follow_extension';
    }

    /**
     * Método comprueba si se sigue o no a un usuario
     *
     * @param $user
     * @param $followed_id
     * @return bool
     */
    public function isfollowFilter($user, $followed_id)
    {
        $follow_repo = $this->doctrine->getRepository('BackendBundle:Follow');
        $followed = $follow_repo->findOneBy(array(
            'user' => $user,
            'followed' => $followed_id
        ));

        if (!empty($followed) && is_object($followed)){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

}
