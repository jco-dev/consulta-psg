<?php
class Validation
{
    public static function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $key => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;
                $value = $data[$key] ?? null;
                $error = self::$ruleName($key, $value, $ruleValue);
                if ($error) {
                    $errors[$key] = $error;
                }
            }
        }
        return $errors;
    }
    public static function required($key, $value)
    {
        if (empty($value)) {
            return "El campo $key es requerido";
        }
    }
    public static function email($key, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "El campo $key debe ser un email";
        }
    }
    public static function min($key, $value, $min)
    {
        if (strlen($value) < $min) {
            return "El campo $key debe tener al menos $min caracteres";
        }
    }
    public static function max($key, $value, $max)
    {
        if (strlen($value) > $max) {
            return "El campo $key debe tener como máximo $max caracteres";
        }
    }
    public static function unique($key, $value, $table)
    {
        $query = "SELECT * FROM $table WHERE $key = '$value'";
        $result = Conexion::conectar()->prepare($query);
        $result->execute();
        $result = $result->fetch();
        if ($result) {
            return "El campo $key ya existe";
        }
    }
    public static function exists($key, $value, $table)
    {
        $query = "SELECT * FROM $table WHERE $key = '$value'";
        $result = Conexion::conectar()->prepare($query);
        $result->execute();
        $result = $result->fetch();
        if (!$result) {
            return "El campo $key no existe";
        }
    }
    public static function password($key, $value)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $value)) {
            return "El campo $key debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número";
        }
    }
}