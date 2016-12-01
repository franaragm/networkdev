<?php

namespace BackendBundle\Entity;

/**
 * Follow
 */
class Follow
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $user;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $followed;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return Follow
     */
    public function setUser(\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BackendBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set followed
     *
     * @param \BackendBundle\Entity\User $followed
     *
     * @return Follow
     */
    public function setFollowed(\BackendBundle\Entity\User $followed = null)
    {
        $this->followed = $followed;

        return $this;
    }

    /**
     * Get followed
     *
     * @return \BackendBundle\Entity\User
     */
    public function getFollowed()
    {
        return $this->followed;
    }
}

