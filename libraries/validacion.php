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
                $error = self::$ruleName($key, $value, $ruleValue, $data);
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
            return "<p class='text-danger'>El campo $key es requerido</p>";
        }
    }
    public static function email($key, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "<p class='text-danger'>El campo $key debe ser un email</p>";
        }
    }
    public static function min($key, $value, $min)
    {
        if (strlen($value) < $min) {
            return "<p class='text-danger'>El campo $key debe tener al menos $min caracteres</p>";
        }
    }
    public static function max($key, $value, $max)
    {
        if (strlen($value) > $max) {
            return "<p class='text-danger'>El campo $key debe tener como máximo $max caracteres</p>";
        }
    }
    public static function unique($key, $value, $table)
    {
        $query = "SELECT * FROM $table WHERE $key = '$value'";
        $result = Conexion::conectar()->prepare($query);
        $result->execute();
        $result = $result->fetch();
        if ($result) {
            return "<p class='text-danger'>El $key <b>'$value'</b> ya se Encuentra Registrado.</p>";
        }
    }
    public static function exists($key, $value, $table)
    {
        $query = "SELECT * FROM $table WHERE $key = '$value'";
        $result = Conexion::conectar()->prepare($query);
        $result->execute();
        $result = $result->fetch();
        if (!$result) {
            return "<p class='text-danger'>El campo $key no existe</p>";
        }
    }
    public static function password($key, $value)
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $value)) {
            return "<p class='text-danger'>El campo $key debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número</p>";
        }
    }
    public static function passwordConfirm($key, $value, $password,$data)
    {
        if ($value != $data[$password]) {
            
            return "<p class='text-danger'>La Contraseña no coincide con la Confirmacion de Contraseña</p>";
        }
    }
}