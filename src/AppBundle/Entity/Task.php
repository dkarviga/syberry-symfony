<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/3/2018
 * Time: 3:18 PM
 */

namespace AppBundle\Entity;

use AppBundle\Form\Validation\NotAbuse;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Task
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @Table(name="task")
 */
class Task
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=120)
     * @Assert\NotBlank(
     *     message="Title should not be blank"
     * )
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string", length=40)
     */
    private $slug;

    /**
     * @var string
     * @ORM\Column(name="content", type="text")
     * @NotAbuse()
     */
    private $content;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(name="duedate", type="datetime", nullable=true)
     * @Assert\Type(type="\DateTime")
     * @Assert\NotBlank(groups={"update-due-date"})
     */
    private $dueDate;

    /**
     * @var string
     * @ORM\Column(name="change_due_date_reason", type="text", nullable=true)
     * @Assert\NotBlank(groups={"update-due-date"})
     */
    private $changeDueDateReason;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    /**
     * @param \DateTimeInterface $dueDate
     */
    public function setDueDate(\DateTimeInterface $dueDate): void
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getChangeDueDateReason(): ?string
    {
        return $this->changeDueDateReason;
    }

    /**
     * @param string $changeDueDateReason
     */
    public function setChangeDueDateReason(?string $changeDueDateReason): void
    {
        $this->changeDueDateReason = $changeDueDateReason;
    }
}