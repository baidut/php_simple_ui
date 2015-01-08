<?php 
// localhost/GitHub/php_simple_ui/php_simple_ui.php
$ui = new dom('html');
$ui->append('body');
$ui->prepend('head');
echo $ui; // <html><head></head><body></body></html>

class dom{
    public $attr = array();
    public $children = array();
    public /*private*/ $ele = null;

    function __construct($ele) {
        $this->ele = $ele;
    }

    function __destruct() {
    	foreach($this->children as $child){
    		$child = null;
    	}
    }

    function __toString(){
    	$ret= '<'.$this->ele;
    	foreach($this->attr as $a){
			$ret.=' '.$a[0].'="'.$a[1].'"';
		}
		$ret.='>';
		foreach($this->children as $child){
			$ret.=$child;
		}
		return $ret.'</'.$this->ele.'>';
	}

	function append($node){ array_push($this->children,new dom($node));}
	function prepend($node){ array_unshift($this->children,new dom($node));}
}
