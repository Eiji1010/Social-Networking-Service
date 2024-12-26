<?php

namespace Database;

use Database\Seeder;

abstract class AbstractSeeder implements Seeder
{
    protected MySQLWrapper $conn;
    protected ?string $tableName = null;

    protected array $tableColumns = [];
    const AVAILABLE_TYPES = [
        'int' => 'i',
        '?int' => 'i',
        'float' => 'd',
        '?float' => 'd',
        'string' => 's',
        '?string' => 's',
    ];

    public function __construct(MySQLWrapper $conn)
    {
        $this->conn = $conn;
    }
    public function seed(int $count=1): void
    {
        $data = $this->createRowData($count);

        if ($this->tableName === null) throw new \Exception("Table name not set");
        if (empty($this->tableColumns)) throw new \Exception("Table columns not set");

        foreach ($data as $row) {
            $this->validateRow($row);
            $this->insertRow($row);
        }
    }

    private function validateRow(array $row): void
    {
        if (count($row) !== count($this->tableColumns)) throw new \Exception("Column count mismatch");
            foreach ($row as $i => $value) {

                $columnDataType = $this->tableColumns[$i]['data_type'];
                if (str_contains($columnDataType, "?")) {
                    $columnDataType = str_replace("?", "", $columnDataType);
                }

                if ($this->tableColumns[$i]['data_type'] === '?int' && $value === null) continue;
                if (!isset(self::AVAILABLE_TYPES[$columnDataType])) throw new \InvalidArgumentException(sprintf("Invalid data type %s", $columnDataType));
                if ((get_debug_type($value) !== $columnDataType)) throw new \InvalidArgumentException(sprintf("Value for %s should be of type %s. Here is the current value: %s", $columnName, $columnDataType, json_encode($value)));
            }
    }

    private function insertRow(array $row): void
    {
        $columnNames = array_map(function($columnInfo){ return $columnInfo['column_name'];}, $this->tableColumns);

        $placeholders = str_repeat('?, ', count($row)-1) . '?';

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->tableName,
            implode(', ', $columnNames),
            $placeholders
        );

        $stmt = $this->conn->prepare($sql);

        $dataTypes = implode(array_map(function($columnInfo){ return static::AVAILABLE_TYPES[$columnInfo['data_type']];}, $this->tableColumns));
        $values = array_values($row);
        $stmt->bind_param($dataTypes, ...$values);
        $stmt->execute();
    }
}