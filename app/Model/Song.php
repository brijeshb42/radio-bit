<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class Song extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'song' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'This field cannot be empty.',
                'required' => true
            )
        ),
        'album' => array(
        ),     
        'dedicate_to' => array(
        ),
        'ip' => array(
            'rule' => array('ip'),
        )
    );
    
    public $belongsTo = array(
        'User' => array(
            'className' => 'User'
        )
    );
    
    /*public function beforeSave($options = array()) {
        $this->data['Song']['ip'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }*/
}
