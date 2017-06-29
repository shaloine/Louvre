<?php

namespace PW\LouvreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="PW\LouvreBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre", type="integer")
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="demi", type="boolean")
     */
    private $demi;

    /**
     * @var integer
     *
     * @ORM\Column(name="prixTotal", type="integer")
     */
    private $prixTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="PW\LouvreBundle\Entity\Visitor", mappedBy="reservation",cascade={"persist"})
     */
    protected $visitors;

    public function __construct()
    {
      $this->date = new \Datetime();
      $this->demi = true;
      $this->visitors = new ArrayCollection();
      $this->nombre = 1;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Reservation
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set demi
     *
     * @param boolean $demi
     *
     * @return Reservation
     */
    public function setDemi($demi)
    {
        $this->demi = $demi;

        return $this;
    }

    /**
     * Get demi
     *
     * @return bool
     */
    public function getDemi()
    {
        return $this->demi;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     *
     * @return Reservation
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return integer
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add visitor
     *
     * @param \PW\LouvreBundle\Entity\Visitor $visitor
     *
     * @return Reservation
     */
    public function addVisitor(\PW\LouvreBundle\Entity\Visitor $visitor)
    {
        $this->visitors[] = $visitor;

        $visitor->setReservation($this);

        return $this;
    }

    /**
     * Remove visitor
     *
     * @param \PW\LouvreBundle\Entity\Visitor $visitor
     */
    public function removeVisitor(\PW\LouvreBundle\Entity\Visitor $visitor)
    {
        $this->visitors->removeElement($visitor);
    }

    /**
     * Get visitors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitors()
    {
        return $this->visitors;
    }

    /**
     * Set prixTotal
     *
     * @param integer $prixTotal
     *
     * @return Reservation
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return integer
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Reservation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
