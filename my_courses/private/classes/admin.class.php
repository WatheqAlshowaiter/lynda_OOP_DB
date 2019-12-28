<?php

class Admin extends DbObj
{

    protected static $table_name = "chain_gangAr.admins";
    protected static $db_columns = ['id', 'first_name', 'last_name', 'email', 'username', 'hashed_password'];

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $username;
    protected $hashed_password;
    public $password;
    public $confirm_password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->password  = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
    }
    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }
}
