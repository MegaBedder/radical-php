<?php
namespace Model\Database\SQL\Parse\CreateTable\Internal;

abstract class CreateTableStatementBase {
	protected $name;
	protected $type;
	protected $attributes;
	private static $_attributes = array('UNSIGNED','NOT NULL','AUTO_INCREMENT');
	
	function __construct($name,$type,$attributes) {
		$this->name = $name;
		$this->type = $type;
		$aattributes = array();
		$attributes = strtoupper($attributes);
		foreach(self::$_attributes as $a){
			if(strpos($attributes,$a.' ')!==false || strpos($attributes,' '.$a)!==false){
				$aattributes[$a] = $a;
				$attributes = str_replace($a,'',$attributes);
			}
		}
		$this->attributes = $aattributes;
		if(is_object($type)){
			$type->canNull(!$this->hasAttribute('NOT NULL'));
		}
	}
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * @return the $attributes
	 */
	public function getAttributes() {
		return $this->attributes;
	}
	
	public function hasAttribute($attribute){
		$attribute = strtoupper($attribute);
		return isset($this->attributes[$attribute]);
	}
}