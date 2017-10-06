<?php
include("sql.php");
$api = new Api($_POST["title"], $_POST["imgUri"]);

Class Api {
	private $imgUri;
	private $title;
	
	function __construct($title, $imgUri){
		$this->title = $title;
		$this->imgUri = $imgUri;
		$this->prepareInsertImage();
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
		$MySql = new Sql("localhost", "root", "", "modul183");
		if($this->validateParam()){
			if($MySql->uriIsUnique($this->imgUri)){
				$MySql->insertImage($this->title, $this->imgUri);
			} else {
				return;
			}
		}
	}
}

?>