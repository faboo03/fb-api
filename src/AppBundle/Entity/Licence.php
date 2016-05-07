<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dunglas\ApiBundle\Annotation\Iri;
use JMS\Payment\CoreBundle\Entity\PaymentInstruction;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\PrePersist;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Table(name="licence")
 * @ORM\Entity()
 * @HasLifecycleCallbacks
 */
class Licence
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="licence_number", type="string", unique = true)
     * @Groups({"order_read"})
     */
    private $licenceNumber = null;

    /**
     * @ORM\Column(name="activation_hash", type="string", unique = true, nullable=true)
     * @Groups({"order_read"})
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
