<?php

namespace Commands;

abstract class AbstractCommand implements Command
{
    protected ?string $value = null;
    protected array $argsMap = [];
    protected static ?string $alias = null;
    protected static bool $requiredCommandValue = false;

    public function __construct()
    {
        $this->setUpArgsMap();
    }

    private function setUpArgsMap()
    {
    }

    public static function getAlias(): string
    {
        return static::$alias !== null ? static::$alias : static::class;
    }

    public static function getHelp(): string
    {
        // TODO: Implement getHelp() method.
    }

    public static function isCommandValueRequired(): bool
    {
        // TODO: Implement isCommandValueRequired() method.
    }

    public function getArgumentValue(string $arg): bool|string
    {
        return $this->argsMap[$arg];
    }
    public abstract static function getArguments(): array;
    public abstract function execute(): int;
}