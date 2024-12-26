<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Message implements Interfaces\Model
{
    use GenericModel;
    public function __construct(
        private ?int $id,
        private int $senderId,
        private ?int $receiverId,
        private string $content,
        private string $type
    ){}

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getSenderId(): int {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void {
        $this->senderId = $senderId;
    }

    public function getReceiverId(): ?int {
        return $this->receiverId;
    }

    public function setReceiverId(?int $receiverId): void {
        $this->receiverId = $receiverId;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }
}