<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core;


use core\middlewares\Token;

abstract class Model
{
    //declaring rules
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_UNIQUE = 'unique';
    public const RULE_MATCH = 'match';
    public const RULE_UPPER_CASE = 'upper';
    public const RULE_LOWER_CASE = 'lower';
    public const RULE_SPEC_CHAR = 'spec';
    public const RULE_NUM = 'number';
    public const RULE_TEL = 'phone';
    public const RULE_FILE = 'file';

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this,$key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, $ruleName);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, $ruleName);
                }
                if ($ruleName === self::RULE_MIN && strlen($value)<$rule['min']) {
                    $this->addError($attribute, $ruleName, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value)>$rule['max']) {
                    $this->addError($attribute, $ruleName, $rule);
                }
                if ($ruleName == self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, $ruleName, ['match'=> $this->getLabel($rule['match'])]);
                }
                if ($ruleName == self::RULE_UPPER_CASE && !preg_match('@[A-Z]@', $value)) {
                    $this->addError($attribute, $ruleName);
                }
                if ($ruleName == self::RULE_LOWER_CASE && !preg_match('@[a-z]@', $value)) {
                    $this->addError($attribute, $ruleName);
                }
                if ($ruleName == self::RULE_NUM && !preg_match('@[0-9]@', $value)) {
                    $this->addError($attribute, $ruleName);
                }
                if ($ruleName == self::RULE_SPEC_CHAR && !preg_match('@[^\w]@', $value)) {
                    $this->addError($attribute, $ruleName);
                }
                if ($ruleName == self::RULE_UNIQUE) {
                    $tableName = $rule['table'];
                    $column = $rule['column'] ?? $attribute;
                    $check = DB::getInstance()->select($tableName, [$column, '=', $value]);
                    if ($check->count()) {
                        $this->addError($attribute, $ruleName, ['field' => $this->getLabel($attribute)]);
                    }
                }
                if ($ruleName == self::RULE_TEL && !preg_match("/^[+][0-9]+$/", $value))
                    $this->addError($attribute, $ruleName);
                if ($ruleName == self::RULE_FILE && empty($_FILES))
                    $this->addError($attribute, $ruleName);
            }
        }
        return empty($this->errors);
    }

    abstract public function rules(): array;

    abstract public function labels(): array;

    private function addError(string $attribute, string $rule, $params =[])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][]= $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED=> 'This field is required',
            self::RULE_NUM=> 'This field must contain a number',
            self::RULE_MATCH=> 'This field must be the same as {match}',
            self::RULE_SPEC_CHAR=> 'This field must contain a special character',
            self::RULE_MAX=> 'Max length of this field must me {max}',
            self::RULE_MIN=> 'Min length of this field must me {min}',
            self::RULE_UPPER_CASE=> 'This field must contain an uppercase',
            self::RULE_LOWER_CASE=> 'This field must contain a lowercase',
            self::RULE_UNIQUE=> 'Record with this {field} already exists',
            self::RULE_EMAIL=> 'This field must be a valid email address',
            self::RULE_TEL=>'Phone number must be in this format (+2348100000000)',
            self::RULE_FILE=>'Please upload an image(s)/file(s)'
        ];
    }

    public function hasError($attribute) {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute) {
        return $this->errors[$attribute][0] ?? false;
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function tokenIsValid()
    {
        return Token::validate($this->TOKEN);
    }
}