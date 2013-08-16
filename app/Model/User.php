<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'username' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'A username is required.',
                //'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'message' => 'Only alphanumeric characters are allowed for username.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'minlength' => array(
                'rule' => array('minlength',5),
                'message' => 'Username should be of minimum 5 characters.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'isUnique' => array(
                'rule' => array('checkUnique','username'),
                'message' => 'Username taken. Try another'
            )
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'You have to provide your name.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'alphanumeric' => array(
                'rule' => array('alphanumeric'),
                'message' => 'Only alphabetic characters are allowed for name.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
        ),
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Email is required in case you forget your password.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'This is not a valid email id.'
            ),
            'isUnique' => array(
                'rule' => array('checkUnique','email'),
                'message' => 'Email already registered. Try another'
            )
        ),     
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Password cannot be empty.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'minlength' => array(
                'rule' => array('minlength',5),
                'message' => 'Password should be of minimum 5 characters.',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'ismatching' => array(
                'rule' => array('isMatching'),
                'message' => 'Passwords do not match.'
            )
        ),
        'ip' => array(
            'rule' => array('ip'),
        )
    );
    
    public $hasMany = array(
        'Song' => array(
            'className' => 'Song'
        )
    );
    
    function isMatching($data){
        if($data['password']==$this->data[$this->alias]['confirm_password'])
            return true;
        return false;
    }
    
    public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
    
    function checkUnique($data, $fieldName){
        $valid = false;
        if(isset($fieldName) && $this->hasField($fieldName)){
            $valid = $this->isUnique(array($fieldName=>$data));
            return $valid;
        }
    }
}
