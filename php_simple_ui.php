<?php 
// localhost/GitHub/php_simple_ui/php_simple_ui.php
// 方案1：输出jQuery语句在客户端创建
// 方案2：服务器端生成ui，需要消耗计算资源，如果便捷性大于速度牺牲的话有意义，用简短的代码，整洁的结构控制ui输出

$ui = new dom('html');
$body = $ui->append('body');
$head = $ui->prepend('head');
$head->html('<title>php_simple_ui</title>');
$body->bgcolor = 'yellow';
// 链式
$body->append('input')->attr('type','button')->val('hello world');
// text('hello world');

echo $ui;

class dom{
    public $attr = array(); // 'value'=>3 关联数组形式
    public $children = array();
    private $ele = null;
    private $innertext = '';

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
		foreach ($this->attr as $key => $value) {
			$ret.=' '.$key.'="'.$value.'"';
		}
		$ret.='>';
		foreach($this->children as $child){
			$ret.=$child;
		}
		return $ret.$this->innertext.'</'.$this->ele.'>';
	}

	function append($node){$ret = new dom($node); array_push($this->children,$ret); return $ret;}
	function prepend($node){$ret = new dom($node); array_unshift($this->children,$ret); return $ret;}
	function after($node){}
	function before($node){}
	function text($t){$this->innertext = $t;return $this;}
	function html($t){}
	function val($v){$this->attr['value']=$v;return $this;}
	function attr($name,$value){$this->attr[$name]=$value;return $this;}
	function __get($name) { return $this->attr[$name]; }
    function __set($name, $value) { $this->attr[$name] = $value; }
}
