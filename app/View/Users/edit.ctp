<div class="users form">
    <!-- File: /app/View/Users/edit.ctp -->
	<?php echo $this->Form->create('User');?>
		<h3>Edit Users</h3>
		<fieldset>
			<?php 		
				echo $this->Form->hidden('id', array('value' => $this->data['User']['id']));
				echo $this->Form->input('username', array( 'readonly' => 'readonly', 'label' => 'Usernames cannot be changed!'));
				echo $this->Form->input('password', array( 'password' => 'New Password (leave empty if you do not want to change)', 'maxLength' => 255, 'type'=>'password','required' => 0));
				echo $this->Form->input('password_confirmation', array('password' => 'Confirm New Password *', 'maxLength' => 255, 'title' => 'Confirm New password', 'type'=>'password','required' => 0));
				echo $this->Form->input('role', array('options' => array( 'admin' => 'Admin', 'author' => 'Author', 'customer'=>'Customer')));
				echo $this->Form->submit('Edit', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
			?>	
		</fieldset>
	<?php echo $this->Form->end(); ?>
</div>

<div class="actions">	
	<ul>
		<li><?php echo $this->Html->link("Return to Users Index",array('action'=>'index')); ?></li>
		<li><?php echo $this->Html->link(__('Add Blog'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link('Logout',array('controller'=>'users', 'action'=>'logout')); ?></li>		
	</ul>	
</div>
	