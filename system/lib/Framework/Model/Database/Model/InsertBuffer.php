<?php
namespace Model\Database\Model;

use Model\Database\IToSQL;
class InsertBuffer {
	private $table;
	private $data = array();
	
	function __construct(TableReferenceInstance $table){
		$this->table = $table;
	}
	
	function add(IToSQL $table){
		$this->data[] = $table->toSQL();
		if(count($this->data) > 10000){
			$this->insert();
		}
	}
	
	function insert(){
		if($this->data){
			$ret = $this->table->insert($this->data)->query();
			$this->data = array();
			return $ret;
		}
	}
}