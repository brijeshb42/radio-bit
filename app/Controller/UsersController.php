<?php
class UsersController extends AppController{
	public $name = 'Users';
	public $components = array('Auth','Session','Cookie');

	public function beforeFilter() {
        parent::beforeFilter();
        //if(!$this->Auth->user('id'))
        $this -> Auth -> allow('login','register','forgot');
        $this -> Auth -> userScope = array('User.status' => 1);
        $this -> Auth -> logoutRedirect = array('controller' => 'songs', 'action' => 'index');
        $this -> Auth -> authError = 'Did you really think you are allowed to see that?';
    }

	public function login(){
		if($this->request->is('post')){
            $this->request->data['User']['username']=$this->request->data['User']['login_username'];
            $this->request->data['User']['password']=$this->request->data['User']['login_password'];
            $this->layout = 'ajax';
            $this->response->type(array('json'=>'application/json'));
            $this->response->type('json');
			if($this->Auth->login()){
                $msg['type']='success';
                $this->set('msg',$msg);
				$this->redirect($this->Auth->redirect());
			}
			else{
				$msg['type']='error';
                $this->set('msg',$msg);
			}
		}elseif ($this -> Auth -> user('id')) {
            $this -> Session -> setFlash(__('You are already logged in.'), 'flash_info');
            $this -> redirect($this -> Auth -> redirect());
        }
	}

	public function register() {
        if ($this -> request -> is('post')){
            $this->layout = 'ajax';
            $this->response->type(array('json'=>'application/json'));
            $this->response->type('json');
            $this->User->set($this->request->data);
            if($this->User->validates()){
                $this->User->create();
                $this->request->data['User']['ip']=$this->request->clientIp();
                if($this->User->save($this->request->data)){
                    $msg['type']='success';
                    $msg['message']='You have been successfully registered';
                    $this->set('msg',$msg);
                }
            }
            else{
                $msg['type']='error';
                $msg['message']=$this->User->validationErrors;
                $this->set('msg',$msg);
            }
        }
        else{
            $this -> Session -> setFlash('You cannot access that page directly.', 'flash_error');
            $this -> redirect('/');
        }
    }

    public function forgot(){
        
    }

    public function logout() {
        if (!$this -> Auth -> user('id')) {
            $this -> Session -> setFlash('You need to login to logout.', 'flash_info');
            $this -> redirect('/');
        }
        $cookie = $this -> Cookie -> read('User');
        if ($cookie) {
            $this -> Cookie -> delete('User');
        }
        $this -> Session -> setFlash('You have been successfully logged out.', 'flash_success');
        $this -> redirect($this -> Auth -> logout());
    }

    public function my_account(){
        if($this->Auth->user('id')){
            if($this->Auth->user('role')=='admin'){
                $this->set('data',$this->User->find('all'));
                $this->render('/Elements/my_account_admin');
            }else{
                $this->render('/Elements/my_account_user');
            }
        }
    }
}/*
$this -> User -> create();
            if ($this -> User -> save($this -> request -> data)) {
                $this -> Session -> setFlash('You have been registered.', 'flash_success');
                $this -> redirect('/');
            } else {
                $this -> Session -> setFlash('There was an error. Please try again.', 'flash_error');
                unset($this -> request -> data['User']['password']);
                unset($this -> request -> data['User']['cpassword']);
            }*/