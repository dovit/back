<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Mission
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MissionRepository")
 */
class Mission
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="serviceDate", type="datetime")
     *
     * @Assert\NotBlank()
     * @Assert\Date()
     * @Assert\GreaterThan("+2 day")
     */
    private $serviceDate;

    /**
     * @var string
     *
     * @ORM\Column(name="productName", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $productName;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="countryDestination", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $countryDestination;

    /**
     * @var string
     *
     * @ORM\Column(name="vendorName", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $vendorName;

    /**
     * @var string
     *
     * @ORM\Column(name="vendorEmail", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $vendorEmail;


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
     * Set client
     *
     * @param integer $client
     *
     * @return Mission
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return int
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set serviceDate
     *
     * @param \DateTime $serviceDate
     *
     * @return Mission
     */
    public function setServiceDate($serviceDate)
    {
        $this->serviceDate = $serviceDate;

        return $this;
    }

    /**
     * Get serviceDate
     *
     * @return \DateTime
     */
    public function getServiceDate()
    {
        return $this->serviceDate;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return Mission
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Mission
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set countryDestination
     *
     * @param string $countryDestination
     *
     * @return Mission
     */
    public function setCountryDestination($countryDestination)
    {
        $this->countryDestination = $countryDestination;

        return $this;
    }

    /**
     * Get countryDestination
     *
     * @return string
     */
    public function getCountryDestination()
    {
        return $this->countryDestination;
    }

    /**
     * Set vendorName
     *
     * @param string $vendorName
     *
     * @return Mission
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;

        return $this;
    }

    /**
     * Get vendorName
     *
     * @return string
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }

    /**
     * Set vendorEmail
     *
     * @param string $vendorEmail
     *
     * @return Mission
     */
    public function setVendorEmail($vendorEmail)
    {
        $this->vendorEmail = $vendorEmail;

        return $this;
    }

    /**
     * Get vendorEmail
     *
     * @return string
     */
    public function getVendorEmail()
    {
        return $this->vendorEmail;
    }
}

