<?php

class Pages extends Controller{
	public function __construct(){
		
	}

	public function index(){
		if(isLoggedIn()){
			redirect('posts');
		}
		
		$data = [
			'title' 		=> 'Welcome to Posts',
			'description'	=> 'Simple posting built on custom MVC framework'
			
		];
		$this->view('pages/index', $data);

		

	}

	public function about(){
		$data = [
			'title' => 'About Us',
			'description'	=> 'This is the About Us page'
		];
		$this->view('pages/about', $data);
	}
}