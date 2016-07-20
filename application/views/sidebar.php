<div id="sidebar_container">
    <div class="sidebar">
        <h3>Latest</h3>
        <h4><?php echo $posts[0]["post_title"];?></h4>
        <h5><?php echo date('d-m-Y h:i A',strtotime($posts[0]['date_added']))?></h5>
        <p><?php echo substr(strip_tags($posts[0]['post']), 0, 200).'...';?></p>
        <p><a href="<?php echo base_url();?>blog/post/<?php echo $posts[0]['post_id']?>">More</a></p>
    </div>
</div>

