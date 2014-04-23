<?php
// app/Controller/UsersController.php
class UsersController extends AppController {   

	
	public function beforeFilter() {
        parent::beforeFilter();
	//this.auth(component:class of cake php) Auth has method called allow. (we can find the function of add)
        //allow people access to function of add
        //allow people access to add,index,edit 
        //allow execute of code that there are functions here.
        $this->Auth->allow('add','edit','delete','logout');
	$this->set('authUser',$this->user);
        
        //if ($this->action == 'add' || $this->action == edit){
        //    $this->Auth->authenticate = $this->User;
        //}
    }
	
	public $paginate = array(
		'limit' => 25,
		'condition' => array('status'=>'1'),
		'order' => array('User.username' => 'asc')
	);	

	public function isAuthorized($user){
		if ($this ->action ==='add'){
			return true;
		}
		if(in_array($this->action,array('view','edit','delete'))){
			$userId = $this->request->param['pass'][0];
			if ($this->Auth->user('id')=== $user){
		//	if ($this->User-isOwnedBy($user['id'])){
			return true;
		}else{		
			$this->Session->setFlash(_('Sorry only Admin users may modify, view or delete other users'));
			}
		}
		return parent::isAuthorized($user);
	}
	
	
	public function login() {
                    if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
			}
	}

	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}	
	
 /**    public function index() {
		//model is related with User 
		//recursive is similar with find all but different method
        $this->User->recursive = 0;
		//passing the result from recursive to users(variable) to the view(index.ctp) 
        //this.paginate 
        $this->set('users', $this->paginate());
    }*/
	 public function index() {
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

/**	public function activate($id = null) {
         
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
         
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }*/
	

	//find the user id
	// model go to find id in database then give back to the view
    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
		// if find user read user that has id 
        //in view has a variable of user 
        //this is current class. 
        //this is a hand over to us.
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
	//HTTP post request (not get not add request) Post request always go to form 
    //it only post request to form
        if ($this->request->is('post')){
		//we prepare a model to do something
        //initialising in model
            $this->User->create();
			//request object is a bag (data is in here) : request.data wrap a data 
            //request object is a holder data in our place.
            if ($this->User->save($this->request->data)){
			//if you add in database (successful) then setFlash of message. 
                $this->Session->setFlash(__('The user has been saved'));
				//we return redirect method to the location that we want to direct to
                //for example go to 'controller' => 'posts': tell it that go to controller>post 
                //in this case if it successful then go to index function to execute code. 
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        }
	
    }
	
	public function posts(){
	 return $this->redirect($this->Auth->redirect(array('controller' => 'posts', 'action'=>'index')));
	 }

	public function edit($id = null){
	//inform particular user by id
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
		 //only allowing 2 particular of post or put , but not get request.
        if ($this->request->is('post') || $this->request->is('put')){
		//save data in the request object
            if ($this->User->save($this->request->data)){
			//display message
                $this->Session->setFlash(__('The user has been saved'));
				//redirect to execute code in the index function
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        } else {
			//if get request from URL then do this stage. 
			//unset the password. 
			//request data in that form then we have to match data
            $this->request->data = $this->User->read(null, $id);
			//but it doesn't set any user and password 
            unset($this->request->data['User']['password']);
			//if user click to edit without login then page will bring to login page
			}
    }
		
 
    public function delete($id = null){
	//only accept HTTP post request
        $this->request->onlyAllow('post');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
		//if it doesn't work , display the message user was not deleted.
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}

?>