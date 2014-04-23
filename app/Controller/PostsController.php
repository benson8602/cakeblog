<?Php

class PostsController extends AppController {
    public $helpers = array('Html', 'Form');
  	public $components = array('Session');
  	
    public function index() {
    
   
    //finding all records in the post table and hading the response index.ctp in view 
        $this->set('posts', $this->Post->find('all'));
    }
    
    
     public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    
    //This function will allow us to add to the posts database //
    public function add() {
    //refers to type of http(get &post request) post here refers to http
    //checking if this http "post" request//
    //not allow people get in the database// 
        if ($this->request->is('post')) {
        
         $this->request->data['Post']['user_id'] = $this->Auth->user('id');
         
        if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been saved.'));
            return $this->redirect(array('action' => 'index'));
        }
        
        
        //prepare my model get ready (initialasing the post model) //
            $this->Post->create(); 
            
            //data that come through on the form. request object post data//hading the data from form to the model
            //post model job talk to the database. // save information,request obje ct send to model 
            //handing request object data to be saved by the post model
             
            if ($this->Post->save($this->request->data)) {
            
            //if this work set the flash and say that your post has been saved: confirmation message
               //i can type in any message when it set flash 
                $this->Session->setFlash(__('Your post has been saved.'));
                //redirect to the Posts index action//
                //list all the post 
                return $this->redirect(array('action' => 'index'));
            }
            
            //flash message saying we weren't able to do it. // 
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }
    
    // function will allow us to edit an existing post 
    public function edit($id = null) {
    if (!$id) {
        throw new NotFoundException(__('Invalid post'));
    }

    $post = $this->Post->findById($id);
    if (!$post) {
        throw new NotFoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post', 'put'))) {
        $this->Post->id = $id;
        if ($this->Post->save($this->request->data)) {
            $this->Session->setFlash(__('Your post has been updated.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to update your post.'));
    }

    if (!$this->request->data) {
        $this->request->data = $post;
    }
}

	public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Post->delete($id)) {
        $this->Session->setFlash(
            __('The post with id: %s has been deleted.', h($id))
        );
        return $this->redirect(array('action' => 'index'));
    }
}



public function isAuthorized($user) {  //it allow login add loggin and owns in posts 
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($postId, $user['id'])) {  //loggin and own edit/delete/view 
            return true;
        }
    }

    return parent::isAuthorized($user);
}
    
    
    
    
}
?>