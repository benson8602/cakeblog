<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
        //'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts', 
                'action' => 'index'
                ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
                ), 
        
            'authorize' => array('Controller'),
            // Added this line
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            )
               
        )
    );
	
	public function beforeFilter(){
		$this->Auth->allow('index','view','logout', 'display');
                $this->Auth->auhError = 'Please login to view that page.';
                $this->Auth->loginError = 'Incorrect username/password combination';
                $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'index');
                $this->Auth->logoutRedirect = array('controller' => 'posts', 'action' => 'index');
                
                $this->set('admin', $this->_isAdmin());
                $this->set('logged_in', $this->_loggedIn());
                //$this->set('user_username', $this->_userUsername());
	}
        function _isAdmin(){
            $admin = FALSE;
            if ($this->Auth->user('role')=='admin'){
                $admin = TRUE; 
        }
            return $admin;
        }
        
        function _loggedIn(){
            $logged_in = FALSE;
            if ($this->Auth->user()){
                $logged_in =TRUE;
            }
            return $logged_in;
        }
	
	public function isAuthorized($user) {
    // Admin can access every action
    if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }

    // Default deny
    return false;
	}
}
