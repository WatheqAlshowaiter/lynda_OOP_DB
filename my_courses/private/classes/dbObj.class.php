<?php

class DbObj
{
    // --- Start Active Record --- 
    protected static $database;
    protected static $table_name = "chain_gangAr.courses";
    protected static $db_columns = [];

    public $errors = [];

    public static function set_database($database)
    {
        self::$database = $database;
    }

    public static function find_by_sql($sql)
    {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database Query Failed!");
        }
        $result->execute();

        // array to object
        $object_array  = [];
        while ($record = $result->fetch(PDO::FETCH_ASSOC)) {
            $object_array[] = static::instantiate($record);
        }
        $result->closeCursor();

        return $object_array;
    }

    public static function find_all()
    {
        $sql  = "SELECT * FROM " . static::$table_name . " ";
        return self::find_by_sql($sql);
    }

    protected  static function instantiate($record)
    {
        $object = new static;
        // we can assign properties manually 
        // but automatically is better  
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    public static function find_by_id($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id = " . self::$database->quote($id) . " ";

        $obj_arr = static::find_by_sql($sql);

        if (!empty($obj_arr)) {
            return array_shift($obj_arr);
        } else {
            return false;
        }
    }

    public function validate()
    {
        // it will be overrated
        $this->errors = [];
        return $this->errors;
    }

    protected function create()
    {
        // validation 
        $errors =  $this->validate();
        if (!empty($errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO ".static::$table_name."( ";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES (";
        $sql .= join(",", array_values($attributes));
        $sql .= ")";
        // die($sql); // for dubugging purposes 
        $result = self::$database->query($sql);
        if ($result) {
            $this->id = self::$database->lastInsertId(); // not like mysqli way
        }
        return $result;
    }

    protected function update()
    {

        // validation 
        $errors =  $this->validate();
        if (!empty($errors)) {
            return false;
        }

        $attributes = $this->sanitized_attributes();
        $attributes_pairs = [];

        foreach ($attributes as $key => $value) {
            $attributes_pairs[] = "{$key}={$value}";
        }
        $sql  = "UPDATE ".static::$table_name." SET ";
        $sql .= join(", ", $attributes_pairs);
        $sql .= "WHERE id = " . self::$database->quote($this->id) . "";
        $sql .= "LIMIT 1";

        // die($sql); // for debugging purposes
        $result = self::$database->query($sql);
        return $result;
    }

    public function delete()
    {
        $sql  = "DELETE FROM " . static::$table_name . " ";
        $sql .= "WHERE id =" . self::$database->quote($this->id) . " ";
        $sql .= "LIMIT 1 ";
        $result = self::$database->query($sql);
        return $result;

        // you can use some object data even 
        // it is deleted from DB like 
        // you delete record number: 5!
    }

    /**
     * return properties of the class without ID 
     *
     * @return array
     */
    public function attributes()
    {
        $attributes = [];
        foreach (static::$db_columns as $column) {
            $attributes[$column] = $this->$column;
        }
        array_shift($attributes); // delete the first item (ID)
        return $attributes;
    }

    protected function sanitized_attributes()
    {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->quote($value);
        }
        return $sanitized;
    }

    public function merge_attributes($args)
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function save()
    {
        // new record will not have ID yet
        if (isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    // --- End Active Record --- 
}
