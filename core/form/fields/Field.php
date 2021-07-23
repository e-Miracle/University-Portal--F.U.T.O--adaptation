<?php
/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

/**
 * Chibuzo Ebubechi Miracle
 * All right reserved.
 * Copyright (c) 2020.
 */

namespace core\form\fields;


use core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';
    public const TYPE_TEXT_AREA = 'textarea';
    public const TYPE_DATE = 'date';
    public const TYPE_TEL = 'tel';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPE_FILE = 'file';

    public string $type;
    public string $attr;
    public string $icon;
    public string $label;
    public string $value;
    public string $extraInputClass;
    public Model $model;
    public string $attribute;

    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->icon = '';
        $this->attr = '';
        $this->label = '';
        $this->value = '';
        $this->extraInputClass = '';
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <div class="form-group %s">
                <label>%s</label>
                <input type="%s" name="%s" id="%s" value="%s" class="%s form-control" %s>
                <i class="%s"></i>
                <div class="invalid-feedback">
                    %s    
                </div>
            </div>
        ',
            $this->class(),
            $this->label(),
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute)? 'is-invalid'.$this->extraInputClass: $this->extraInputClass,
            $this->attr,
            $this->icon,
            $this->model->getFirstError($this->attribute)
        );
    }

    public function password()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function email()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
    public function tel()
    {
        $this->type = self::TYPE_TEL;
        return $this;
    }
    public function date()
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }
    public function textarea()
    {
        $this->type = self::TYPE_TEXT_AREA;
        return $this;
    }
    public function number()
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }
    public function checkbox()
    {
        $this->type = self::TYPE_CHECKBOX;
        return $this;
    }
    public function file()
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }
    public function icon($icon)
    {
        $this->icon = $icon;
        return $this;
    }
    public function attribute($att = '')
    {
        if (is_array($att))
            foreach ($att as $a)
                $this->attr .= $a;
        else
            $this->attr = $att;
        return $this;
    }

    public function label()
    {
        $ignore = [self::TYPE_FILE];
        if (!in_array($this->type, $ignore)) {
            $this->label = $this->model->labels()[$this->attribute] ?? $this->attribute;
        }
        return $this->label;
    }

    private function class($class = null)
    {
        if ($class != null) {
            return $class;
        }
        return '';
    }

    public function extraInputClass($class = '')
    {
        $this->extraInputClass = $class;
        return $this;
    }

    public function value(string $value = '')
    {
        $ignore = [self::TYPE_PASSWORD];
        if ($value == '' && !in_array($this->type, $ignore)) {
            $this->value =  $this->model->{$this->attribute};
        }else{
            $this->value = $value;
        }
        return $this;
    }
}