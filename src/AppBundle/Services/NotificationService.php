<?php

namespace AppBundle\Services;

use BackendBundle\Entity\Notification;

class NotificationService
{
    public $manager;

    public function __construct($manager)
    {
       $this->manager = $manager;
    }

    /**
     * Guarda los datos para una notificación de actividad
     *
     * @param User $user usuario receptor de la notificacion
     * @param string $type tipo de notificacion
     * @param int $typeId id de usuario que realiza la acción
     * @param string $extra otra informacion que puede ser un id
     * @return bool
     */
    public function set($user, $type, $typeId, $extra = null)
    {
        $em = $this->manager;

        $notification = new Notification();
        $notification->setUser($user);
        $notification->setType($type);
        $notification->setTypeId($typeId);
        $notification->setReaded(0);
        $notification->setCreatedAt(new \DateTime("now"));
        $notification->setExtra($extra);

        $em->persist($notification);
        $flush =  $em->flush();

        if($flush == null) {
            $status =  true;
        } else {
            $status = false;
        }

        return $status;
    }

}