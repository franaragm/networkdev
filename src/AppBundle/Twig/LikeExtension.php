<?php

namespace AppBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;

class LikeExtension extends \Twig_Extension
{
    protected $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('islike', array($this, 'islikeFilter')),
            new \Twig_SimpleFilter('numlikes', array($this, 'numlikesFilter'))
        );
    }

    public function getName()
    {
        return 'like_extension';
    }


    /**
     * Permite comprobar si se ha marcado como me gusta a una publicación
     *
     * @param $user
     * @param $publication
     * @return bool
     */
    public function islikeFilter($user, $publication)
    {
        $like_repo = $this->doctrine->getRepository('BackendBundle:Like');
        $publication_liked = $like_repo->findOneBy(array(
            'user' => $user,
            'publication' => $publication
        ));

        if (!empty($publication_liked) && is_object($publication_liked)){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    /**
     * Obtención de número de likes de una publicación
     *
     * @param $publication
     * @return int
     */
    public function numlikesFilter($publication)
    {
        $like_repo = $this->doctrine->getRepository('BackendBundle:Like');
        $publication_likes = $like_repo->findBy(array(
            'publication' => $publication
        ));

        return count($publication_likes);
    }

}
