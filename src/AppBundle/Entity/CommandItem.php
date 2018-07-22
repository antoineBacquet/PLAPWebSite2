<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandItem
 *
 * @ORM\Table(name="command_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommandItemRepository")
 */
class CommandItem
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $item;

    /**
     * @var int
     *
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @ORM\ManyToOne(targetEntity="Command", inversedBy="items")
     */
    private $command;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer")
     */
    private $quantity;


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
     * Set item
     *
     * @param Item $item
     *
     * @return CommandItem
     */
    public function setItem($item)
    {
        $this->item = $item;
    
        return $this;
    }

    /**
     * Get item
     *
     * @return Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set command
     *
     * @param Command $command
     *
     * @return CommandItem
     */
    public function setCommand($command)
    {
        $this->command = $command;
    
        return $this;
    }

    /**
     * Get command
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CommandItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
