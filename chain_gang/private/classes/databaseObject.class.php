<?php

class DatabaseObject
{
    // --- START OF ACTVICE RECORD ----
    static protected $database;
    static protected $table_name = "";
    static protected $db_columns = [];

    public $errors = [];

    static public function set_database($database)
    {
        self::$database = $database;
    }

    static public function find_by_sql($sql)
    {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database Query Failed.");
        }
        // results into objects
        $object_array = [];

        while ($record  = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }
        $result->free();

        return $object_array;
    }

    static public function find_all()
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        return static::find_by_sql($sql);
    }
    static protected function instantiate($record)
    {
        $object = new static;
        // Could make assign manually 
        // but automatically assignment is easier and re-usable 
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }

        return $object;
    }

    static public function find_by_id($id)
    {
        $sql  = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id = '" . self::$database->escape_string($id) . "' ";

        $obj_array = static::find_by_sql($sql);

        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    /**
     * normal validation to inhertied to every class and do 
     * whatever we want in it 
     *
     * @return array
     */
    protected function validate()
    {
        $this->errors = [];
        return $this->errors;
    }

    protected function create()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }
        $attributes = $this->sanitize_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        $result = self::$database->query($sql);
        if ($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }

    protected function update()
    {
        $this->validate();
        if (!empty($this->errors)) {
            return false;
        }
        $attributes = $this->sanitize_attributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql  = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id ='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        // die($sql); 
        $result = self::$database->query($sql);
        return $result;
    }
    public function delete()
    {
        $sql = "DELETE FROM " . static::$table_name . "  ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1 ";
        $result = self::$database->query($sql);
        return $result;

        // After deleting, the instance of the object will still
        // exist, even though the database record does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted.";
        // but, for example, we can't call $user->update() after
        // calling $user->delete().
    }

    /**
     * properties which have database db_columns excluding ID
     *
     * @return array attributes
     */
    public function attributes()
    {
        $attributes = [];

        // if (is_array(static::$db_columns) || is_object(static::$db_columns)) {
            foreach (static::$db_columns as $column) {
                if ($column == "id") {
                    continue;
                }
                $attributes[$column] = $this->$column;
            }
        // }else {
            // var_dump(static::$db_db_columns);die();
        // }

        return $attributes;
    }

    protected function sanitize_attributes()
    {
        $sanitize = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitize[$key] = self::$database->escape_string($value);
        }
        return $sanitize;
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
}
