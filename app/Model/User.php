<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	public $hasMany = array(
		'Post'=>array(
			'className' => 'Post',
                        'foreignKey' => 'user_id',
                        'dependent' => false,
                        'conditions'=> '',
                        'fields' => '',
                        'order' => '',
                        'limit' => '',
                        'offset' => '',
                        'exclusive' => '',
                        'finderQuery' => '',
                        'counterQuery' => ''
                    
                    )
	);
    
	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('between', 3, 15),
                'message' => 'The username must be between 3 and 15 characters.'
            ),
            'That username has already been taken' => array(
                'rule' => 'isUnique',
                'message' => 'The username has already been taken.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('between', 4,15 ),
                'message' => 'The password must be between 4 and 15 characters.'
            ),
            /*'The password do not match' => array(
                'rule' => 'matchPasswords',
                'message' => 'The passwords do not match.'
            )*/
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
    
    /*function matchPasswords($data){
        if($data['password'] == $this->data['User']['password_comfirmation']){
            return TRUE;
        }
        $this->invalidate('password_comfirmation', 'The password do not match');
        return FALSE;
    }*/
        
    function  hashPasswords($data){
        if(isset($this->data['User']['password'])){
            $this->data['User']['password'] = Security::hash($this->data['User']['password '],NULL, TRUE);
                return $data;
    }
    return $data;
}


    	public function beforeSave($options = array()) {
    	if (isset($this->data[$this->alias]['password'])) {
        	$passwordHasher = new SimplePasswordHasher();
        	$this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
        	);
    	}
    return true;
	}
	
}