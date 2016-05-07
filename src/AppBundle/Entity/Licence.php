<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dunglas\ApiBundle\Annotation\Iri;
use JMS\Payment\CoreBundle\Entity\PaymentInstruction;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="licence")
 * @ORM\Entity()
 * @UniqueEntity(fields={"licenceNumber"})
 * @UniqueEntity(fields={"activationHash"})
 * @HasLifecycleCallbacks
 */
class Licence
{
    /**
     * @ORM\Column(name="licence_number", type="string", unique = true)
     * @ORM\Id
     */
    private $licenceNumber = null;

    /**
     * @ORM\Column(name="activation_hash", type="string", unique = true, nullable=true)
     * @Groups({"licence_activation"})
     */
    private $activationHash = null;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="Order", cascade={"persist"}, inversedBy="licences")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order = 0;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"}, inversedBy="licences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getLicenceNumber()
    {
        return $this->licenceNumber;
    }

    /**
     * @param mixed $licenceNumber
     */
    public function setLicenceNumber($licenceNumber)
    {
        $this->licenceNumber = $licenceNumber;
    }

    /**
     * @return mixed
     */
    public function getActivationHash()
    {
        return $this->activationHash;
    }

    /**
     * @param mixed $activationHash
     */
    public function setActivationHash($activationHash)
    {
        $this->activationHash = $activationHash;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $orderNumber
     * PrePersist
     */
    public function generateOrderNumber($orderNumber)
    {
        $this->licenceNumber = "";
    }
}
