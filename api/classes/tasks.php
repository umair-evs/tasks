<?php
class Tasks{   
    
    private $entityTable = "tasks";      
    public $id;
    public $title;
    public $description;
    public $status;
    public $createdAt; 
	public $updatedAt; 
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	public function list(){
		$data =[];
		$task = $this->conn->prepare("SELECT * FROM ".$this->entityTable);
		$task->execute();			
		$result = $task->get_result();
		return $result;	
	}


	public function details(){	
		$task = $this->conn->prepare("SELECT * FROM ".$this->entityTable." WHERE id = ?");
		$task->bind_param("i", $this->id);
		$task->execute();			
		$result = $task->get_result();
		return $result;	
	}	
	
	public function add(){
		$task = $this->conn->prepare("
			INSERT INTO ".$this->entityTable." (`title`, `description`, `status`,  `updatedAt`, `createdAt`)
			VALUES(?,?,?,?,?)");
		
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->description = htmlspecialchars(strip_tags($this->description));
		$this->status = htmlspecialchars(strip_tags($this->status));
		$this->createdAt = htmlspecialchars(strip_tags($this->createdAt));
		$this->updatedAt = htmlspecialchars(strip_tags($this->updatedAt));

		$task->bind_param("sssss", $this->title, $this->description, $this->status, $this->updatedAt, $this->createdAt);
		if($task->execute()){
			return true;
		}
		return false;		 
	}
		
	public function update(){
	 
		$task = $this->conn->prepare("UPDATE ".$this->entityTable."  SET title= ?, description = ?, status = ? WHERE id = ?");

		$this->id 			= (int)htmlspecialchars(strip_tags($this->id));
		$this->title 		= (string)htmlspecialchars(strip_tags($this->title));
		$this->status 		= (string)htmlspecialchars(strip_tags($this->status));
		$this->description 	= (string)htmlspecialchars(strip_tags($this->description));
		$task->bind_param("sssi", $this->title, $this->description, $this->status, $this->id);

		if($task->execute()){
			return true;
		}
		return false;
	}
	
	public function remove(){
		
		$task = $this->conn->prepare("DELETE FROM ".$this->entityTable." WHERE id = ?");			
		$this->id = htmlspecialchars(strip_tags($this->id));
		$task->bind_param("i", $this->id);
		if($task->execute()){
			return true;
		}
		return false;		 
	}
}