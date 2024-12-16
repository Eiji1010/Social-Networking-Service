<?php
namespace Commands;

interface Command
{
    public static function getAlias(): string;
    public static function getArguments(): array;
    public static function getHelp(): string;
    public static function isCommandValueRequired(): bool;

    public function getArgumentValue(string $arg): bool|string;
    public function execute(): int;
}