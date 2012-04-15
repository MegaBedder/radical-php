<?php
namespace Database\Search\Adapter;

use Database\Model\TableReferenceInstance;
use Database\Model\ITable;
use Database\SQL\SelectStatement;

interface ISearchAdapter {
	function Filter($text, SelectStatement $sql);
	function Search($text, TableReferenceInstance $table);
}