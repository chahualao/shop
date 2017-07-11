<?php
namespace Mobile\Controller;
use Think\Controller;
class ErrorController extends Controller{
	public function error404(){
		$this->display('/Public/404');
	}
}