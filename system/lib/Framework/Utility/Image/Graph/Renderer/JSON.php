<?php
namespace Utility\Image\Graph\Renderer;
use Utility\Image\Graph\pChart\pChart;
use Utility\Image\Graph\Renderer\IRenderable;

class JSON extends ImageGraph implements IRenderable {
	function output(\Utility\Image\Graph\Schema\Graph $schema){
		return $schema;
	}
}