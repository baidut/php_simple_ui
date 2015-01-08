<?php 
// localhost/GitHub/php_simple_ui/php_simple_ui.php
// 方案1：输出jQuery语句在客户端创建
// 方案2：服务器端生成ui，需要消耗计算资源，如果便捷性大于速度牺牲的话有意义，用简短的代码，整洁的结构控制ui输出

// 相关项目
// phpQuery—基于jQuery的PHP实现http://www.cnblogs.com/in-loading/archive/2012/04/11/2442697.html

/*ui_Dom的使用
$ui = new ui_Dom('html');
$body = $ui->append('body');
$head = $ui->prepend('head');
$head->html('<title>php_simple_ui</title>');
$body->bgcolor = 'yellow';
// 链式
$body->append('input')->attr('type','button')->val('hello world');
// text('hello world');
echo $ui;
*/

$ui = new ui_jQueryMobile();
echo $ui;

// <html><head><script src="http://code.jquery.com/jquery-1.8.3.min.js"></script><link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css"><script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></head><body></body></html>

class ui_Dom{
    public $attr = array(); // 'value'=>3 关联数组形式
    public $children = array();
    private $ele = null;
    private $innertext = '';  // 是否需要识别html标签的能力？可以解析出内容——html_simple_dom 选择性分析比较高效

    function __construct($ele,$content='') {
        if($ele!='')$this->ele = $ele;
        else $this->ele = 'div';

        if($content!='')$this->innertext = $content;
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

	function append($node,$content=''){
		$ret = new ui_Dom($node,$content); 
		array_push($this->children,$ret); 
		return $ret;
	}
	function prepend($node){$ret = new ui_Dom($node); array_unshift($this->children,$ret); return $ret;}
	function after($node){}
	function before($node){}
	function text($t){$this->innertext = $t;return $this;}
	function html($t){}
	function val($v){$this->attr['value']=$v;return $this;}
	function attr($name,$value){$this->attr[$name]=$value;return $this;}
	function __get($name) { return $this->attr[$name]; }
    function __set($name, $value) { $this->attr[$name] = $value; }

    function appendText($text) { $this->innertext .=$text; }
}

// jQuery Mobile UI 建模

class ui_jQuery extends ui_Dom{
	public $head;
	public $body;
	function __construct() {
        parent::__construct('html');
        $this->head = $this->append('head','<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>');
        $this->body = $this->append('body');
    }
}

class ui_jQueryMobile extends ui_jQuery{

	function __construct() {
        parent::__construct();
        $script = new ui_Dom('script');
        $script->src='';
        $this->head->appendText('<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css"><script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js">');
    }
}