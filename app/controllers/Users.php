<?php 
class Users extends Controller {
  public function __construct(){
    $this->userModel = $this->model('User');
  }

  public function register(){
    //checking for POSt
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data =[
        'name'                  => trim($_POST['name']),
        'email'                 => trim($_POST['email']),
        'password'              => trim($_POST['password']),
        'confirm_password'      => trim($_POST['confirm_password']),
        'name_err'              => '',
        'email_err'             => '',
        'password_err'          => '',
        'confirm_password_err'  => ''
      ];
      // validate email
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter email';
      }else{
        if($this->userModel->findUserByEmail($data['email'])){
          $data['email_err'] = 'Email is already used';
        }
      }
      //validate name
      if(empty($data['name'])){
        $data['name_err'] = 'Please enter name';
      }
      //validate password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter password';
      }elseif(strlen($data['password'])< 6){
        $data['password_err'] = 'Please enter password';
      }
      //confirm password
      if(empty($data['confirm_password'])){
        $data['confirm_password_err'] = 'Please confirm password';
      }else{
        if($data['password']!= $data['confirm_password']){
          $data['confirm_password_err'] = 'Passwords do not match';
        }
      }

      //errors are empty
      if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        // register user
        if($this->userModel->register($data)){
          flash('register_success', 'You are registered and can log in');
            redirect('users/login');
        }else{
          die('not registered');
        }
      }else{
        //load view
        $this->view('users/register', $data);
      }

    }else{

      $data =[
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
        'confirm_password'      => '',
        'name_err'              => '',
        'email_err'             => '',
        'password_err'          => '',
        'confirm_password_err'  => ''
      ];

      $this->view('users/register', $data);
    }
  }

  public function login(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data =[
        'email'                 => trim($_POST['email']),
        'password'              => trim($_POST['password']),
        'email_err'             => '',
        'password_err'          => '',

      ];
       // validate email
      if(empty($data['email'])){
        $data['email_err'] = 'Please enter email';
      }
      //validate password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter password';
      }
      //checking for email
      if($this->userModel->findUserByEmail($data['email'])){

      }else{
        $data['email_err'] = 'No user found';
      }

      //errors are empty
      if(empty($data['email_err']) && empty($data['password_err'])){
        // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
      }else{
        //load view with errors
        $this->view('users/login', $data);
      }
    }else{
      $data =[
        'name'                  => '',
        'email'                 => '',
        'password'              => '',
      ];
      $this->view('users/login',$data);
    }
  }

  public function logout(){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    session_destroy();
    redirect('users/login');
  }

  public function createUserSession($user){
    $_SESSION['user_id']     = $user->id;
    $_SESSION['user_email']  = $user->email;
    $_SESSION['user_name']   = $user->name;

    redirect('posts');
  }


  public function index(){

  }
}