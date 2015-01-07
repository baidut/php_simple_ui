
<?php
// ======================================================= //

// http://localhost/Github/baidut/wap/dlut/_ui.php

// 创建：		2014-3-27 11:18:50
// 最后修改：	2014-3-27 11:33:40
// 作者：		YZQ

// 对jQuery Mobile的ui显示建模，以方便数据显示

// 使用实例:
// $html=new ui_html;
// $html->title="hello";//"我的图书馆";
// $html->content='<h1>hello world</h1>';//$content;
// $html->footer="world";
// $html->disp();

// ======================================================= //


function ui_li_group($title,$ui_li_array){
	$d = new ui_li_divider;
	$d->title=$title;
	$d->count=count($ui_li_array);

	$u = new ui_li_group;
	$u->ui_li_divider=$d;
	$u->ui_li_array=$ui_li_array;

	return $u;
}
function ui_ul($array){
	// ui_li_group->ui_li_divider->title=$array_keys($ul);
	$u = new ui_ul;
	$u->ui_li_group_array = $array;
	return $u;
}

// ------------------------------------------------------- //

class ui_li_divider{
	var $title;
	var $count;

	function disp(){
		echo  '<li data-role="list-divider">'.
				$this->title.
				'<span class="ui-li-count">'.
				$this->count.
				'</span></li>';
	}
}
class ui_li{
	var $aside;
	var $head;
	var $bold;
	var $content;
	var $link;

	function disp(){
		echo '<li><a href="'.$this->link.'">'.
				'<h2>'.$this->head.'</h2>'.
				'<p><b>'.$this->bold.'</b></p>'.
				'<p>'.$this->content.'</p>'.
				'<p class="ui-li-aside">'.$this->aside.'</p></a></li>';
	}
}
class ui_li_group{
	var $ui_li_divider;
	var $ui_li_array;

	function disp(){
		
		$this->ui_li_divider->disp();
		foreach($this->ui_li_array as $ui_li) {
			$ui_li->disp();
		}
	}
}
class ui_ul{
	var $ui_li_group_array;

	function disp(){
		echo '<ul data-role="listview" data-filter="true" >'; // 边框 data-inset="true"
		foreach($this->ui_li_group_array as $ui_li_group) {
			$ui_li_group->disp();
		}
		echo "</ul>";
	}
}

class ui_html{
	var $title;
	var $content;
	var $footer;

	function disp(){
?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css">
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>

</head>
<body>

<div data-role="page" >
  <div data-role="header" data-position="fixed">
    <a data-role="button" href="index.php" data-icon="back" data-iconpos="left"
        class="ui-btn-left">返回</a>
    <h1><?php echo $this->title; ?></h1>
  </div>

  <div data-role="content">
	<?php
	// echo $this->content;
	$this->content->disp();
	?>
  </div>

 <div data-role="footer" data-position="fixed">
    <?php
	echo $this->footer;
	?>
 </div>

</body>
</html>
<?php
	}
}
?>