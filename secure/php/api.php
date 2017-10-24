<?php
include("sql.php");
if(isset($_POST["title"]) && isset($_POST["imgUri"])){
    $api = new Api($_POST["title"], $_POST["imgUri"]);
}

Class Api {
	private $imgUri;
	private $title;
	
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
	
	private function prepareInsertImage(){
		$MySql = new Sql();
		if($this->validateParam()){
			if($MySql->uriIsUnique($this->imgUri)){
                $MySql->insertImage($this->title, $this->imgUri);
                $result = [true, "Image was saved."];
			} else {
				$result = [false, "This image already exists."];
			}
		} else {
		    $result = [false, "There was an error while saving your file, please retry."];
        }
		return $result;
	}
}

?>