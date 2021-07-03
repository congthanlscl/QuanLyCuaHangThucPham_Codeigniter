<?php 


if(!function_exists('cn')){
	function cn($slug = ""){
        $request = \Config\Services::request();
		$controllerName =  $request->uri->getSegment(1);
		return base_url($controllerName)."/".$slug;
	}
}

if(!function_exists('segment')){
	function segment($index){
        $request = \Config\Services::request();
		$segment =  $request->uri->getSegment($index);
		return $segment;
	}
}


if(!function_exists('response')){
	function response($array){
		print_r(json_encode($array));
		exit(0);
	}
}

if(!function_exists('userdata')){
	function userdata($key){

		$session = \Config\Services::session();
		$userdata = $session->get("userdata");

		return $userdata[$key];
	}
}

if(!function_exists('pagination')){
	function pagination($current, $perPage, $total) {

		$pager  = \Config\Services::pager();
		return $pager->makeLinks($current, $perPage, $total, 'posts_pagination');
	}
}

?>