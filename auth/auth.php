<?php 
require "../database/db_connection.php";
class Auth{
    private $name;
    private $email;
    private $role;
    function __construct($email) {
        $this->email = $email; 
        $sql = "SELECT * FROM users  WHERE email ='" . $email . "'";
        $result = $GLOBALS['conn']->query($sql)->fetch_assoc();
        $this->name = $result["name"];
        $this->role = $result["roles"];   
    }

    function name(){
        return $this->name;
    }

    function role(){
        return $this->role;
    }

    function roleName(){
        $sql = "SELECT * FROM roles WHERE id=".$this->role;
        $result = $GLOBALS['conn']->query($sql)->fetch_assoc();
        return $result["name"];
    }
}
?>