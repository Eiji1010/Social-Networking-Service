<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class User implements Model
{
    use GenericModel;

    public function __construct(
        private string $username,
        private string $email,
        private ?int $id = null,
        private ?DateTimeStamp $timeStamp = null,
        private ?string $place = null,
        private ?int $age = null,
        private ?string $handle = null,
        private ?string $biography = null,
    ){}

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getTimeStamp(): ?DateTimeStamp {
        return $this->timeStamp;
    }

    public function setTimeStamp(?DateTimeStamp $timeStamp): void {
        $this->timeStamp = $timeStamp;
    }

    public function getAge(): ?int {
        return $this->age;
    }

    public function setAge(?int $age): void {
        $this->age = $age;
    }

    public function getHandle(): ?string{
        return $this->handle;
    }

    public function setHandle(?string $handle): void{
        $this->handle = $handle;
    }

    public function getBiography(): ?string{
        return $this->biography;
    }

    public function setBiography(?string $biography): void{
        $this->biography = $biography;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): void
    {
        $this->place = $place;
    }
}