<?php
namespace Database\DataAccess;

use Models\User;

interface UserDAO
{
    public function create(User $user, string $password): bool;
    public function getById(int $id): ?User;
    public function getByEmail(string $email): ?User;
    public function getHashedPasswordById(int $id): ?string;
    public function updateProfile(array $data): bool;
    public function getAll(): array;
    public function getPosts(int $userId, ?int $offset, ?int $count): ?array;
}