<!-- File: /app/View/Posts/index.ctp -->

<div class="posts index">




<div class="panel panel-default">
<div class="panel-heading"> Blog posts</div>

<div class="table-responsive">
  <table class="table">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>User_ID</th>
        <th>Username</th>
    </tr>
    

    
		
    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
      
    
        <td><?php echo $post['Post']['id']; ?></td>
        
        
        <td>
            <?php echo $this->Html->link(
            $post['Post']['title'],
			array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td>
        
        <?php echo $post['Post']['created']; ?></td>
        
          <td>
        <?php
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $post['Post']['id'])
                );
            ?>
            </td>
            <td>
            
             <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            
            <td>
                    <?php echo $post['Post']['user_id']; ?>  <!--create anothe column or table data-->
                   <!-- and pass user_id from post database-->
                   
                   
                  <td>
					<p><?php echo h($post['User']['username']); ?></p>
				  </td>
                   
                   
                   
                   
                   
            </td>
               
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>

</div>
</div>	
</div>

<div class="actions"> 

	<div id = "addpost">   <!--It is used in  css div#addpost -->
	<?php echo $this->Html->link( 'New Post',
                array('controller' => 'posts', 'action' => 'add')); 
        ?>
	</div>

</div>
