<?php
include("sql.php");
$api = new Api($_POST["title"], $_POST["imgUri"]);

Class Api {
    private $username;
    private $password;

    function __construct($title, $imgUri){
        $this->title = $title;
        $this->imgUri = $imgUri;
        $answer = $this->prepareInsertImage();
        var_dump($answer);
    }

    private function validateParam(){
        $title = $this->title;
        $imgUri = $this->imgUri;
        $result = false;
        if(isset($title) && isset($imgUri)){
            if($title !== "" && $imgUri !== ""){
                $subString = substr($imgUri, 0, 22);
                $startingString = "data:image/png;base64,";
                if($subString === $startingString){
                    $result = true;
                }
            }
        }
        return $result;
    }
}

?>