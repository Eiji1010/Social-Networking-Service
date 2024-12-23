<?php
namespace Helpers;

use Type\ValueType;

class ValidationHelper
{
    public static function integer($value, float $min = INF, float $max = INF): int
    {
        $value = filter_var($value, FILTER_VALIDATE_INT, ['min_range' => $min, 'max_range' => $max]);
        if ($value === false) throw new \Exception("Invalid integer value");
        return $value;
    }

    public static function validateFields(array $fields, array $data): array
    {
        $validatedData = [];

        foreach ($fields as $field => $type){
            if (!isset($data[$field]) || $data[$field] === '') throw new \Exception("Field $field is required");
            $value = $data[$field];
            $validatedValue = match($type){
                ValueType::STRING => is_string($value) ? $value : throw new \Exception("Invalid string value"),
                ValueType::INT => self::integer($value),
                ValueType::FLOAT => filter_var($value, FILTER_VALIDATE_FLOAT),
                ValueType::DATE => self::validateDate($value),
                ValueType::EMAIL => filter_var($value, FILTER_VALIDATE_EMAIL),
                ValueType::TIME => preg_match('/^\d+$/', $value) ? $value : throw new \Exception("Invalid time value"),
                ValueType::PASSWORD =>
                    is_string($value) &&
                    strlen($value) >= 8 &&
                    preg_match('/[A-Z]/', $value) &&
                    preg_match('/[a-z]/', $value) &&
                    preg_match('/\d/', $value) &&
                    preg_match('/[\W_]/', $value)
                        ? $value : throw new \InvalidArgumentException("The provided value is not a valid password."),
                default => throw new \InvalidArgumentException(sprintf("Invalid type for field: %s, with type %s", $field, $type)),
            };

            if ($validatedValue === false) {
                throw new \InvalidArgumentException(sprintf("Invalid value for field: %s", $field));
            }
            $validatedData[$field] = $validatedValue;
        }
        return $validatedData;
    }

    private static function validateDate(string $date, string $format = 'Y-m-d'): string
    {
        $d = \DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) === $date) {
            return $date;
        }
        throw new \InvalidArgumentException(sprintf("Invalid date format for %s. Required format: %s", $date, $format));
    }
}