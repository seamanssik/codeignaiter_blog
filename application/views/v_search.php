<?=form_open('blog/search');?>
<?php $search = array('name'=> 'search' , 'id'=> 'search', 'value'=>'');?>
<?=form_input($search);?><input type=submit value='Search' /></p>
<?=form_close();?>