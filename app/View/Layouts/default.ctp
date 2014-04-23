<?php
/**
 *
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
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap');
                echo $this->Html->css('font-awesome');
                echo $this->Html->css('font-awesome.min');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>

<body>
	<div id="container">
            <nav class="navbar navbar-inverse" role="navigation">

		<div id="nav-bar-header navbar-inverse navbar-fixed-top">
			<ul class="nav navbar-nav">
                                <li>
                                    <?php 
                                    if(!isset($username)) { //  if users not login, it will bring tologin page when users click on button of POST           
                                    echo  $this->Html->link('Blog Post', array('controller' => 'posts', 'action' => 'index'));            
                                    } 
                                    else 
                                        {
                                        echo $this->Html->link('Post', array('controller' => 'posts', 'action' => 'index'));}
                                        ?> 
                                </li>	
                                <li>
                                    <?php 
                                   
                                    if(!isset($username)) { //  if users not login, it will bring to login page when users click on button of USER           
                                    echo $this->Html->link('User', array('controller' => 'users', 'action' => 'index'));            
                                    } 
                                    else 
                                        {
                                        echo $this->Html->link('User', array('controller' => 'users', 'action' => 'login'));}
                                    
                                        ?> 
                                </li>
                                
                                <li><?php if(AuthComponent::user()){
					echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
					}else {
                                            echo $this->Html->link('Login', array('controller'=>'users','action'=>'login'));}
                                        ?>
                                </li>
                                <li>
                                    <?php 
                                    echo $this->Html->link('Signup', array('controller' => 'users', 'action' => 'add'));
                                    ?>
                                </li>
			</ul>			
                    
		</div>
            </nav>
		<div id="content">
                    <div class="userlogout .col-md-3 .col-md-offset-3">
			
			<?php if(AuthComponent::user()){
				echo 'Welcome '.AuthComponent::user('username');
				echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
			}
			else{
                                echo $this->Html->link('Register', 
				array('controller'=>'users', 'action' => 'add')); 
                                
				echo $this->Html->link('Login',
				array('controller'=>'users', 'action' => 'login'));
			}
			?>
                    </div>	
                    
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" class = "navbar navbar-default navbar-fixed-bottom navbar-inverse">
                    <div class = "container">
                    
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                            <?php 
                            echo $this->Html->link(
                		$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				'http://www.cakephp.org/',
				array('target' => '_blank', 'escape' => false)
				);
                            ?> 
                            </li>
                            <li> 
                            <?php
                            echo $this->Form->button('<i class="fa fa-facebook fa-1x"></i>', array(
                                'type' => 'button',
                                'onclick' => 'location.href=\'https://www.facebook.com/ctcBenson\';',
                                'class' => 'navbar-btn btn-primary btn pull-right',
                                'escape' => false
                                ));
                            ?> 
                            </li>
                            <li> 
                            <?php
                            echo $this->Form->button('<i class="fa fa-google-plus-square fa-x"></i>', array(
                                'type' => 'button',
                                'onclick' => 'location.href=\'https://plus.google.com/u/0/+BensonChanCT/about\';',
                                'class' => 'navbar-btn btn-danger btn pull-right',
                                'escape' => false
                                ));
                            ?>
                            </li>
                            <li> 
                            <?php
                            echo $this->Form->button('<i class="fa fa-linkedin-square fa-1x"></i>', array(
                                'type' => 'button',
                                'onclick' => 'location.href=\'ie.linkedin.com/pub/benson-chan/78/78a/170/\';',
                                'class' => 'navbar-btn btn-warning btn pull-right',
                                'escape' => false
                                ));
                            ?>                            
                            </li>
                            <li> 
                            <?php
                            echo $this->Form->button('<i class="fa fa-flickr fa-1x"></i>', array(
                                'type' => 'button',
                                'onclick' => 'location.href=\'http://www.flickr.com/photos/ctcbenson/\';',
                                'class' => 'navbar-btn btn-success btn pull-right',
                                'escape' => false
                                ));
                            ?>                            
                            </li>
                            <li> 
                            <?php
                            echo $this->Form->button('<i class="fa fa-twitter fa-1x"></i>', array(
                                'type' => 'button',
                                'onclick' => 'location.href=\'https://twitter.com/benson8602\';',
                                'class' => 'navbar-btn btn btn-info btn pull-right',
                                'escape' => false
                                ));
                            ?>                            
                            </li>
                        </ul>
                    
                   
                    <h5 class="navbar-text pull-left"><?php echo $this->Html->image('spiro-7xs.jpg');?> &copy; Chan Coin Tai 2013</h5>
                    </div>
		</div>
	</div>

</body>
</html>
