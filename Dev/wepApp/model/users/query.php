<?php

// This class contain all the request possible for the API
class User{

    // Connection instance
    private $conn;

    // table name
    private $table_name = "users";

    // table columns
    public $id;
    public $firstName;
    public $name;
    public $username;
    public $email;
    public $password;


// init of constructor
    public function __construct($conn){
        $this->conn = $conn;
    }

    /**
     * Prepare the SQL request for the API, to get the informations of "user"
     *
     * @param none
     *
     * @return string
     */

    public function getOne(){
        // init of $query
        $query = null;

        // check if the user search an specific id
        if (isset ($_GET['id']) == true) {

            $idGet = $_GET['id'];
            $query = "SELECT first_name,name,username,username,email,password FROM " . $this->table_name . " WHERE id = '". $idGet."'";

            // check if the user search an specific username
        }   elseif (isset ($_GET['username']) == true) {

            $usernameGet = $_GET['username'];
            $query = "SELECT id,first_name,nom,username,mail,password FROM " . $this->table_name . " WHERE username = '". $usernameGet."'";

            // check if the user search an specific name
        }   elseif (isset ($_GET['nom']) == true) {

            $nomGet = $_GET['nom'];
            $query = "SELECT id,first_name,nom,username,mail,password FROM " . $this->table_name . " WHERE name = '". $nomGet."'";

        }
        // prepare the query
        $stmt = $this->conn->prepare($query);
        // execute the query
        $stmt->execute();
        // return the query
        return $stmt;
    }

    /**
     * Prepare the request in SQL for the API, to create a new "user"
     *
     * @param none
     *
     * @return string
     */

    public function post(){

        $query = "INSERT INTO " . $this->table_name . " SET name=:name, first_name=:first_name, username=:username, email=:email, password=:password";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":first_name", $this->firstName);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        $stmt->execute();

        return $stmt;
    }

    /**
     * Prepare the SQL request for the API, to update the informations of "user"
     *
     * @param none
     *
     * @return string
     */

    public function put(){
        $query = "UPDATE " . $this->table_name . " SET name=:name, first_name=:first_name, username=:username, email=:email, password=:password
              WHERE id=:id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':first_name', $this->firstName);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    /**
     * Prepare the SQL request for the API, to delete a "user"
     *
     * @param none
     *
     * @return string
     */

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = " .$this->id;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
