<?php

class Course extends DbObj
{

    protected static $db_columns = [
        'id', 'course_name', 'organization', 'subject', 'teacher', 'level', 'length_in_hours',
        'language', 'my_rate', 'is_course_complete', 'date_of_completion', 'link', 'notes'
    ];
    protected static $table_name = "chain_gangAr.courses";

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

    public function validate()
    {
        $this->errors = [];
        // validation just a demo 
        // course name (not blank)
        if (is_blank($this->course_name)) {
            $this->errors[] = "لا يمكن أن يكون اسم الكورس فارغًا";
        }
        // organization (not blank)
        if (is_blank($this->organization)) {
            $this->errors[] = "لا يمكن أن يكون اسم المؤسسة فارغًا";
        }

        return $this->errors;
    }
}
