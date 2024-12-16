<?php

namespace Commands;

use Exception;

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
        $args = $GLOBALS['argv'];
        $startIndex = array_search($this->getAlias(), $args);

        if ($startIndex === false) throw new Exception("Command not found: " . $this->getAlias());
        else $startIndex++;

        $shellArgs = [];

        if (!isset($args[$startIndex]) || ($args[$startIndex][0] === "-")){
            if($this->isCommandValueRequired()){
                throw new Exception("Command value is required for command: " . $this->getAlias());
            }
        }
        else{
            $this->argsMap[$this->getAlias()] = $args[$startIndex];
            $startIndex++;
        }

        for ($i = $startIndex; $i < count($args); $i++){
            $arg = $args[$i];

            if ($arg[0].$arg[1] === "--") $key = substr($arg, 2);
            else if ($arg[0] === "-") $key = substr($arg, 1);
            else throw new Exception('Options must start with "--" or "-"');

            $shellArgs[$key] = true;
            if (isset($args[$i+1]) && $args[$i+1][0] !== "-"){
                $shellArgs[$key] = $args[$i+1];
                $i++;
            }
        }

        /** @var Argument $argument */
        foreach ($this->getArguments() as $argument){
            $argString = $argument->getArgument();
            $value = null;

            if ($argument->isShortAllowed() && isset($shellArgs[$argString[0]])) $value = $shellArgs[$argString[0]];
            else if (isset($shellArgs[$argString])) $value = $shellArgs[$argString];

            if ($value === null){
                if ($argument->isRequired()){
                    throw new Exception("Argument is required: " . $argString);
                }
                else $this->argsMap[$argString] = false;
            }
            else $this->argsMap[$argString] = $value;
        }
        $this->log(json_encode($this->argsMap));
    }

    public static function getAlias(): string
    {
        return static::$alias !== null ? static::$alias : static::class;
    }

    public static function getHelp(): string
    {
        $helpString = "Command: " . static::getAlias() . (static::isCommandValueRequired() ? "{value}": "") . PHP_EOL;

        $arguments = static::getArguments();
        if (empty($arguments)) return $helpString;

        $helpString .= "Arguments:" . PHP_EOL;

        /* @var Argument $argument */
        foreach ($arguments as $argument){
            $helpString .= " --" . $argument->getArgument();
            if ($argument->isShortAllowed()) {
                $helpString .= " (-" . $argument->getArgument()[0] . ")";
            }
            $helpString .= " : " . $argument->getDescription() . PHP_EOL;
            $helpString .= "Required: " . ($argument->isRequired() ? "Yes" : "No") . PHP_EOL;
            $helpString .= PHP_EOL;
        }

        return $helpString;
    }

    public static function isCommandValueRequired(): bool
    {
        return static::$requiredCommandValue;
    }

    public function getCommandValue(): string{
        return $this->argsMap[static::getAlias()]??"";
    }

    public function getArgumentValue(string $arg): bool|string
    {
        return $this->argsMap[$arg];
    }

    protected function log(string $info): void
    {
        fwrite(STDOUT , $info . PHP_EOL);
    }

    public abstract static function getArguments(): array;
    public abstract function execute(): int;
}