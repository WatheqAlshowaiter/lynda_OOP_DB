<?php

class Course
{

    // --- Start Active Record --- 
    protected static $database;

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
    // --- End Active Record --- 
    public $id;
    public $course_name;
    public $organization;
    public $subject;
    public $teacher;
    public $level;
    public $length_in_hours;
    public $language;
    public $my_rate;
    public $is_course_complete;
    public $date_of_completion;
    public $link;
    public $notes;


    public function __construct($args = [])
    {
        // maybe we will delete $args[]
        $this->course_name = $args['name'] ?? '';
        $this->organization = $args['organization'] ?? '';
        $this->subject = $args['subject'] ?? '';
        $this->teacher = $args['teacher'] ?? '';
        $this->level = $args['level'] ?? '';
        $this->language = $args['language'] ?? '';
        $this->is_course_complete = $args['is_complete'] ?? 0;
        $this->length_in_hours = $args['long_in_hours'] ?? '';
        $this->rating = $args['rating'] ?? 5;
        $this->date_of_completion = $args['date_complete'] ?? '';
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
        return "{$this->course_name} | {$this->organization} | {$this->teacher}";
    }

}
