<?php
namespace Types;

enum ValueType: string
{
    case STRING = 'string';
    case INT = 'int';
    case FLOAT = 'float';
    case DATE = 'date';
    case EMAIL = 'email';
    case PASSWORD = 'password';
    case TIME= 'time';
}