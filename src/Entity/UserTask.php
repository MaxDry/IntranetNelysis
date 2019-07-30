<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserTaskRepository")
 */
class UserTask
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="userTasks")
     */
    private $idTask;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userTasks")
     */
    private $idUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTask(): ?Task
    {
        return $this->idTask;
    }

    public function setIdTask(?Task $idTask): self
    {
        $this->idTask = $idTask;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
