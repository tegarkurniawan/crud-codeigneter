<?php


class Library {

public function __construct(){
	$this->db = new PDO('mysql:host=localhost;dbname=library','root','');
}
public function create(array $data){
	$value = implode("','",$data);
	$sql = "INSERT INTO books (kodeBuku, judulBuku, pengarang, penerbit) VALUES('" . $value."')";
	$query = $this->db->prepare($sql);
	$query->execute();
	if(!$query){
		return "Failed";
	}
	else{
		return "Success";
	}
}
public function read($id){
	if(@$id != null){
		$sql = "SELECT * FROM books WHERE kodeBuku='$id'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetch();
	}else{
		$sql = "SELECT * FROM books";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
	}
	return $result;
}
public function update($id, array $data){
	foreach ($data as $key => $value) {
		$arg[] = $key.'="'.$value.'"';
	}
	$set = implode(',', $arg);
	$sql = "UPDATE books SET ".$set." WHERE kodeBuku='$id'";
	$query = $this->db->prepare($sql);
	$query->execute();
	if(!$query){
		return "Failed";
	}
	else{
		return "Success";
	}
}
 
public function delete($id){
	$sql = "DELETE FROM books WHERE kodeBuku='$id'";
	$query = $this->db->prepare($sql);
	$query->execute();
}
}

?>