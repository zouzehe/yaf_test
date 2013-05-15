<?php

class V_page{

	private $total;//总行数
	private $num;  //每页显示行数
	public $page; //总页数
	public $nPage; //当前页码
	//private $prePage; //上一页
	//private $nextPage;//下一页
	private $limit;
	public $uri;
	private $info=array("head"=>"条记录", "first"=>"首页", "next"=>"下一页", "prev"=>"上一页", "last"=>"末页");


	public function __construct($total,$num,$page=1){
	    $this->total = $total;
		$this->num   = $num;
		$this->nPage = $page?$page:1;
		$this->page  = ceil(($this->total)/($this->num));
		if($this->nPage<1){
			$this->nPage = 1;
		}
		if($this->nPage>$this->page){
			$this->nPage = $this->page;
		}

		$this->limit = $this->getLimit();
		$this->uri=$this->geturi();
	}

	function __get($proName){
			if($proName=="limit"){
				return $this->limit;
			}
		}

	//组合limit条件
	public	function getLimit(){

	    $str="Limit ";
	    if($this->nPage<1){
			$this->nPage = 1;
		}
		$offset = ($this->nPage-1)*$this->num;
		$str.="{$offset},{$this->num}";
		return $str;
	}	
	//offset
	public	function getOffset(){

		if($this->nPage<1){
			$this->nPage = 1;
		}
		$offset = ($this->nPage-1)*$this->num;
		$str ="{$offset}";
		return $str;
	}	
	//url添加?及分页参数
	 function geturi(){
		$url = $_SERVER['REQUEST_URI'];
		$arr = parse_url($url);
		$arr_url=preg_replace("/\/page\/(\d)*/", "", $arr['path']);

		if($arr_url =="/"){
			$arr_url="index/index/index";
		}
		return ltrim($arr_url,"/");
	}

	private function first(){  //首页和向前
		$str='';
		if($this->nPage!=1){
			$prev = ($this->nPage>1)?($this->nPage-1):1;
			$str.='<a class="first paginate_button" onclick="page(\''.$this->uri.'\',1)" href="javaScript:void(0)">'.$this->info['first'].'</a>';
			$str.='<a class="previous paginate_button" onclick="page(\''.$this->uri.'\','.$prev.')" href="javaScript:void(0)">'.$this->info["prev"].'</a>';
		}else{
			$str.='<a class="first paginate_button paginate_button_disabled" href="javaScript:void(0)">'.$this->info['first'].'</a>';
			$str.='<a class="previous paginate_button paginate_button_disabled" href="javaScript:void(0)">'.$this->info["prev"].'</a>';
		}
		return $str;
	}
	private function last(){ //末页和向后
		$str="";
		if($this->nPage!=$this->page && $this->page!=0){

			$next=($this->nPage < $this->page) ? $this->nPage+1 : $this->page; 
			$str.='<a class="next paginate_button" onclick="page(\''.$this->uri.'\','.$next.')" href="javaScript:void(0)">'.$this->info["next"].'</a>';
			$str.='<a class="last paginate_button" onclick="page(\''.$this->uri.'\','.$this->page.')" href="javaScript:void(0)">'.$this->info['last'].'</a>';
 		}else{
			$str.='<a class="next paginate_button paginate_button_disabled" href="javaScript:void(0)">'.$this->info["next"].'</a>';
			$str.='<a class="last paginate_button paginate_button_disabled" href="javaScript:void(0)">'.$this->info["last"].'</a>';
		}
		return $str;
	}
	private function list1(){
			$str="";

			for($i=4; $i > 0; $i--){
				$page=$this->nPage-$i;
				if($page > 0)
					$str.='<a class="paginate_button" onclick="page(\''.$this->uri.'\','.$page.')" href="javaScript:void(0)">'.$page.'</a>';
				}

			if($this->page > 1)
				$str.='<a class="paginate_active" href="javaScript:void(0)">'.$this->nPage.'</a>';


			for($i=1; $i < 5; $i++){
				$page=$this->nPage+$i;

				if($page <= $this->page)
					$str.='<a class="paginate_button" onclick="page(\''.$this->uri.'\','.$page.')" href="javaScript:void(0)">'.$page.'</a>';
			}

			return $str;

        }

		private function start(){
			if($this->total == 0){
				return 0;
			}
			return ($this->nPage-1)*$this->num+1;
		}

		private function stop(){
			if($this->nPage==$this->page){
				return $this->total;
			}else if($this->total==0){
				return 0;
			}else{
				return $this->nPage*$this->num;
			}
		}

		private function  npage() {
			if($this->total == 0){
				return 0;
			}else{
				return $this->nPage;
			}
		}

		private function num(){
			if($this->total==0)
				return 0;
			else
				return($this->stop()-$this->start()+1);
		}

		function fpage(){
			$p="<div id='DataTables_Table_1_info' class='dataTables_info'>显示{$this->start()}到{$this->stop()}条&nbsp;&nbsp;共 {$this->total} 条</div>";
			$p.='<div id="DataTables_Table_1_paginate" class="dataTables_paginate paging_full_numbers">'.$this->first();
			$p.="<span>".$this->list1()."</span>";
			$p.= $this->last();
			$p.="</div>";
			return $p;

		}

}

?>
