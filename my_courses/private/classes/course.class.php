<?php

class Course
{

    // --- Start Active Record --- 
    protected static $database;
    protected static $db_columns = [
        'id', 'course_name', 'organization', 'subject', 'teacher', 'level', 'length_in_hours',
        'language', 'my_rate', 'is_course_complete', 'date_of_completion', 'link', 'notes'
    ];

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
            $object_array[] = self::instantiate($record);
        }
        $result->closeCursor();

        return $object_array;
    }

    public static function find_all()
    {
        $sql  = "SELECT * FROM chain_gangAr.courses";
        return self::find_by_sql($sql);
    }

    protected  static function instantiate($record)
    {
        $object = new self;
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
        $sql = "SELECT * FROM chain_gangAr.courses ";
        $sql .= "WHERE id = " . self::$database->quote($id) . " ";

        $obj_arr = self::find_by_sql($sql);

        if (!empty($obj_arr)) {
            return array_shift($obj_arr);
        } else {
            return false;
        }
    }

    public function create()
    {
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO chain_gangAr.courses(";
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

    /**
     * return properties of the class without ID 
     *
     * @return array
     */
    public function attributes()
    {
        $attributes = [];
        foreach (self::$db_columns as $column) {
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

    // --- End Active Record --- 
    public $id;
    public $course_name;
    public $organization;
    public $subject;
    public $teacher;
    public $level; // should be list to choose from (1-5)
    public $length_in_hours; // shoould be range from 0-999 hrs 
    public $language; // should be list countains only (Engllish or Arabic)
    public $my_rate; // should br ranged from 0-10
    public $is_course_complete; // yes or no 
    public $date_of_completion; // date picker 
    public $link;
    public $notes;

    public const LEVELS_OPTIONS = [
        1 => 'مبتدئ',
        2 => 'مبتدئ-متوسط',
        3 => 'متوسط',
        4 => 'متوسط-متقدم',
        5 => 'متقدم'
    ];
    public const LANGUAGES = ['عربي', 'English'];


    public function __construct($args = [])
    {
        $this->course_name = $args['course_name'] ?? '';
        $this->organization = $args['organization'] ?? '';
        $this->subject = $args['subject'] ?? '';
        $this->teacher = $args['teacher'] ?? '';
        $this->level = $args['level'] ?? '';
        $this->language = $args['language'] ?? '';
        $this->is_course_complete = $args['is_course_complete'] ?? 0;
        $this->length_in_hours = $args['length_in_hours'] ?? '';
        $this->my_rate = $args['my_rate'] ?? 5;
        $this->date_of_completion = $args['date_of_completion'] ?? '';
        $this->link = $args['link'] ?? '';
        $this->notes = $args['notes'] ?? '';
    }

    public function set_is_course_complete($value)
    {
        $this->is_course_complete = $value;
    }
    public function is_course_complete()
    {
        if ($this->is_course_complete == 1) {
            return "نعم";
        } else {
            return "لا";
        }
    }

    public function name()
    {
        if ($this->course_name && $this->organization && $this->teacher) {
            return "{$this->course_name} | {$this->organization} | {$this->teacher}";
        }
    }

    public function level()
    {
        foreach (Course::LEVELS_OPTIONS as $lvl_id => $lvl_name) {
            if ($this->level == $lvl_id) {
                return $lvl_name;
            }
        }
        return "غير محدد";
    }
}
