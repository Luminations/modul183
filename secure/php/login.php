<?php
include("sql.php");
if(isset($_POST["mail"]) && isset($_POST["password"])){
    $login = new Login();
    $login->prepareLogin($_POST["mail"], $_POST["password"]);
}

Class Login {
  private $mail;
  private $password;

  function prepareLogin ($mail, $pw){
    $toBeEscaped = [$mail, $pw];
    $MySql = new Sql();
    $escaped = $MySql->escapeString($toBeEscaped);
    $this->mail = $escaped[0];
    $this->password = $this->secureHash($escaped[1]);
	$queryResult = $MySql->lookForUser($this->mail, $this->password);
	if($queryResult !== false){
		$MySql->setSession('uid', $queryResult);
		$returnValue = 1;
	} else {
		$returnValue = 0;
	}
    print $returnValue;
  }

  function secureHash($password){
    $encodedPassword = urlencode($password);
    $passwordSalt = substr($encodedPassword, 2, 4);
    $mailSalt = substr($this->mail, 2, 4);
    $salt = crypt($mailSalt . $passwordSalt, '$1$RS..GE2.$F9ORrsXapAlaej4S9oaYn/');
    $hash = crypt($password, $salt);
    return $hash;
  }
}

?>