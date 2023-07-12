<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;

#[Entity]
#[Table(name: 'tasks')]
class Task
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: Types::BIGINT)]
    private int $id;
    #[Column(length: 255)]
    private ?string $username;
    #[Column(length: 255)]
    private ?string $email;
    #[Column(name: 'task_text', length: 255)]
    private ?string $taskText;
    #[Column(name: 'is_complete', type: Types::BOOLEAN)]
    private bool $isComplete;
    #[Column(name: 'is_text_edited_by_admin', type: Types::BOOLEAN)]
    private bool $isTextEditedByAdmin;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTaskText(): string
    {
        return $this->taskText;
    }

    public function setTaskText(string $taskText): void
    {
        $this->taskText = $taskText;
    }

    public function isComplete(): bool
    {
        return $this->isComplete;
    }

    public function setIsComplete(bool $isComplete): void
    {
        $this->isComplete = $isComplete;
    }

    public function isTextEditedByAdmin(): bool
    {
        return $this->isTextEditedByAdmin;
    }

    public function setIsTextEditedByAdmin(bool $isTextEditedByAdmin): void
    {
        $this->isTextEditedByAdmin = $isTextEditedByAdmin;
    }
}
