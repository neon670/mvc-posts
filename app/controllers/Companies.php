<?php

class Companies extends Controller{

	public function __construct(){

		if(!isLoggedIn()){
        redirect('users/login');
      }
      $this->companyModel = $this->model('Company');
      $this->userModel = $this->model('User');
	}

	public function index(){
		$company = $this->companyModel->getCompanies();
		$data = [
			'company' => $company,
		];
		
		$this->view('companies/index', $data);
	}
}