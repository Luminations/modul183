<?php
Class Sql{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "modul183";
  private $connection = "";
  private $imageTable = "image";
  private $userTable = "user";


  //Open connection and safe it into connection variable
  public function __construct(){
    $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
  }

  public function insertImage($title, $uri){
    $values = $this->escapeString([$title, $uri]);
    $this->connection->query('INSERT INTO ' . $this->imageTable . '(title, imageuri, fk_uid) VALUES("' . $values[0] . '", "' . $values[1] . '", ' . $_SESSION['uid'] . ');');
  }

  public function uriIsUnique($uri){
    $escapedValue = $this->escapeString([$uri]);
    $dbValues = [];
    $result = $this->connection->query('SELECT imageuri FROM ' . $this->imageTable . ' WHERE fk_uid=' . $_SESSION['uid'] . ';');
    $isUnique = true;
    if($result->num_rows > 0){
      $dbValues = $this->resultToArray($result);
      foreach($dbValues as $image){
        if($image["imageuri"] === $escapedValue[0]){
          $isUnique = false;
        }
      }
    }
    return $isUnique;
  }

  public function lookForUser($mail, $password){
	$return = false;
    $user = $this->connection->query("SELECT uid FROM user WHERE mail='" . $mail ."' AND password='" . $password . "';");
    if($user->num_rows > 0){
      $user = intval($this->resultToArray($user)[0]['uid']);
      $return = $user;
    }
    return $return;
  }

    //Here all the sessions get set. (YET)
    public function setSession($session, $value){
		session_start();
        $_SESSION[$session] = $value;
    }

  public function resultToArray($result){
    $rows = array();
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }

  //Function for escaping user input
  public function escapeString($toBeEscaped){
    //Use the array we created earlyer to iterate through variable ammounts of user input
    foreach($toBeEscaped as $escape){
      $escape = $this->connection->real_escape_string($escape);
    }
    //Hand escaped input back to the function
    return $toBeEscaped;
  }
  
  //Display all images saved alongside your uid
  public function displayImages(){
    $result = $this->connection->query('SELECT imgid, title, imageuri FROM ' . $this->imageTable . ' WHERE fk_uid=' . $_SESSION['uid'] . ';');
    $dbValues = $this->resultToArray($result);
	return $dbValues;
  }
  
  //Delete an image
  public function deleteImage($imgid){
    $result = $this->connection->query('DELETE FROM ' . $this->imageTable . ' WHERE fk_uid=' . $_SESSION['uid'] . ' AND imgid=' . $imgid . ';');
	return $result;
  }

  //close connection
  public function connectionClose(){
    $this->connection->close();
  }











    public function register($username, $password, $mail){
//safe parameters into array for later use
        $escapeString = [$username, $password, $mail];
//Hand over user input into escape function [Line: ]
        $data = $this->escapeString($escapeString);
//Use escaped user input to check if the entered input matches any entry in the database
        $occupied = $this->connection->query("SELECT userid FROM users WHERE username = '" . $data[0] ."' AND email='" . $data[2] . "';");
        if($occupied->num_rows > 0){
            $this->setSession("ERROR", "The username or email adress is already taken");
        } else {
            $succ = $this->connection->query("INSERT INTO users(username, passwordhash, email) VALUES ('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "')");
        }
        if($succ){
            $a = true;
        } else{
            $a = false;
        }
        return $a;
    }

    public function getUsername($uid){
        $result = $this->connection->query("SELECT username FROM users WHERE userid =" . $uid .";");
        $result = $this->resultToArray($result);
        return $result;
    }

//User login form: index.php
    public function login($username, $password){
//safe parameters into array for later use
        $escapeString = [$username, $password];
//Hand over user input into escape function
        $data = $this->escapeString($escapeString);
//Use escaped user input to check if the entered input matches any entry in the database
        $result = $this->connection->query("SELECT userid FROM users WHERE username = '" . $data[0] ."' AND passwordhash = '" . md5($data[1]) . "';");
//If there where any matches the recieved user ID gets saved into the final variable
        if($result->num_rows > 0){
            $value = ["login", $result->fetch_assoc()["userid"]];
        } else {
//If there where no matches at all the final variable gets set to 0
            $value = ["ERROR", "You entered an invalid password or the given user does not exist."];;
        }
//Hand the result over to the setSession function
        $this->setSession($value[0], $value[1]);
    }

    public function saveMedia($type, $datatype, $path, $name, $description){
        $result = $this->connection->query("INSERT INTO `media`(`fk_media_users`, `type`, `datatype`, `path`, `name`, `description`) VALUES ('" . $_SESSION['login'] . "', '" . $type . "', '" . $datatype . "', '" . $path . "', '" . $name . "', '" . $description . "');");
        if($result){
            $a = true;
        } else{
            $a = false;
        }
        return $a;
    }


    public function getMedia($type){
        $result = $this->connection->query("SELECT * FROM `media` WHERE type='" . $type . "' AND fk_media_users = " . $_SESSION['login'] . " ORDER BY mediaid;");
        if($result->num_rows > 0){
            $result = $this->resultToArray($result);
            $result = json_encode($result);
        } else {
//If there where no matches at all the final variable gets set to 0
            $result = 0;
        }
        return $result;
    }

    public function getNotes(){
        $result = $this->connection->query("SELECT * FROM `notes` WHERE fk_note_users = " . $_SESSION['login'] . " ORDER BY noteid;");
        if($result->num_rows > 0){
            $result = $this->resultToArray($result);
            $result = json_encode($result);
        } else {
//If there where no matches at all the final variable gets set to 0
            $result = 0;
        }
        return $result;
    }

    public function saveNotes($title, $description){
        $result = $this->connection->query("INSERT INTO `notes`(`fk_note_users`, `title`, `content`) VALUES (" . $_SESSION['login'] . ", '" . $title . "' , '" . $description . "');");
        if($result){
            $a = true;
        } else{
            $a = false;
        }
        return $a;
    }

    public function deleteNote($id){
        $result = $this->connection->query("DELETE FROM `notes` WHERE fk_note_users = " . $_SESSION['login'] . " AND noteid='" . $id . "';");
    }

    public function deleteVideo($id){
        $result = $this->connection->query("DELETE FROM `media` WHERE fk_note_users = " . $_SESSION['login'] . " AND mediaid='" . $id . "';");
    }



    //Function that checks the connection to the database. If there where no Issues found it returns true.
    //Error messages get thrown into $_SESSION["ERROR"]
    public function connectionCheck (){
        $var = true;
        //check if there where any errors recordet
        if($this->connection->connect_error){
            //set the return value to false
            $var = false;
            //set the ERROR session to the error.
            $this->setSession("ERROR", $this->connection->connect_error);
        }
        //return if there where any errors
        return $var;
    }
}
?>