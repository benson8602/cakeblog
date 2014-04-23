<?php
class Post extends AppModel{
	
	public $name = 'Post';
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id')
	);
	
	public $validate = array(
            
            'title' => array(
                'title_must_not_be_blank'=> array(
                    'rule' => 'notEmpty',
                    'message' =>'This post is missing a title!'
                ),
                'title_must_be_unique'=> array(
                    'rule' => 'notEmpty',
                    'message' =>'A post with this title already exists!'
                )
            ),
            'body' => array(
                'body_must_not_be_blank' => array(
                    'rule' => 'notEmpty',
                    'message' =>'This post is missing a body!'
                    )
        )
    );

	public function isOwnedBy($post, $user) {
    	return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
	}
}
?>
