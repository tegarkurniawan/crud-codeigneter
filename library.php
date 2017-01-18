<?php
include "CrudAble.php";
use CrudAble\CrudAble As CrudAble;

class Library implements CrudAble {

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

$library = new Library();
$table = $library->read(null);
foreach($table as $row){
    echo "<li>{$row['judulBuku']}</li>";
}

$edit = $library->read(123);
echo $edit['judulBuku'];

$data = array(
		'judulBuku' => 'Titanics',
		'pengarang' => 'Tegar',
		'penerbit' => 'PT.CIpta'

	);
// $insert = $library->create($data);
// var_dump($insert);
$update = $library->update(145, $data);
var_dump($update);
?>