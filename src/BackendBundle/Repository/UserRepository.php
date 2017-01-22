<?php

namespace BackendBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * Provee de consulta custom para poder obtener los usuarios sigue el usuario logueado
     *
     * @param $user
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getFollowingUsers($user)
    {
        $em = $this->getEntityManager();
        $follow_repo = $em->getRepository('BackendBundle:Follow');
        $following = $follow_repo->findBy(array(
            'user' => $user
        ));

        $following_array = array();

        foreach($following as $follow){
            $following_array[] = $follow->getFollowed();
        }

        $user_repo = $em->getRepository('BackendBundle:User');
        $users = $user_repo->createQueryBuilder('u')
            ->where("u.id != :user AND u.id IN (:following)")
            ->setParameter('user', $user->getId())
            ->setParameter('following', $following_array)
            ->orderBy('u.id', 'DESC');

        return $users;
    }

}