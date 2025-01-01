<?php

namespace Models;

use DateTime;
use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Post implements Interfaces\Model
{
    use GenericModel;

    public function __construct(
        private int $userId,
        private string $content,
        private ?int $id = null,
        private ?string $mediaUrl = null,
        private ?bool $isScheduled = false,
        private ?string $scheduledAt = null,
        private ?DateTime $postDate = null,
    ){}

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getMediaUrl(): ?string {
        return $this->mediaUrl;
    }

    public function setMediaUrl(?string $mediaUrl): void {
        $this->mediaUrl = $mediaUrl;
    }

    public function getIsScheduled(): ?bool {
        return $this->isScheduled;
    }

    public function setIsScheduled(?bool $isScheduled): void {
        $this->isScheduled = $isScheduled;
    }

    public function getScheduledAt(): ?string {
        return $this->scheduledAt;
    }

    public function setScheduledAt(?string $scheduledAt): void {
        $this->scheduledAt = $scheduledAt;
    }

    public function getPostDate(): ?DateTime {
        return $this->postDate;
    }

    public function setPostDate(?DateTime $postDate): void {
        $this->postDate = $postDate;
    }
}