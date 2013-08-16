<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
		'AutoLogin',
		'Auth' => array(
			'loginRedirect' => array('controller'=>'songs','action'=>'index'),
			'logoutRedirect' => array('controller' => 'songs', 'action' => 'index'),
			'authorize' => array('Controller'),
            'userScope' => array('User.status' => 1)
			),
		'Session',
		'Cookie'
		);
	var $helpers = array('Html', 'Form', 'Js' => array('Jquery'), 'Session', 'Time');

	public function beforeFilter(){
		$this->Auth->allow('index');
		$this -> Auth -> autoRedirect = false;
        if ($this -> Auth -> user('id')) {
            $this -> set('loggedIn', true);
        } else {
            $this -> set('loggedIn', false);
        }
	}

	public function beforeRender(){
		if($this->Auth->user('id')){
            $this->set('loggedIn',array(true,$this->Auth->user('username'),$this->Auth->user('role'),$this->Auth->user('name')));
        }
        else{
            $this->set('loggedIn',array(false,'guest','user','Guest'));
        }
	}

	public function isAuthorized($user) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }

    public function _autologin() {
        $this -> set('loggedIn', 'true');
    }
}
