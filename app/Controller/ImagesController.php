<?Php

class ImagesController extends AppController {
    public $helpers = array('Html','Js', 'Imagesbox.Imagesbox'); 
       
  	
     public function index() {
   
    //finding all records in the post table and hading the response index.ctp in view 
        $this->set('images', $this->Image->find('all'));
    
    
    
}

}
    
    
?>
