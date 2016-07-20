<div id="site_content">
    <div id="content">
        <?php foreach ($query as $post) { ?>
            <?php if ($post['userfile'] && !empty($post['userfile'])) { ?>
                <img src="<?php echo base_url(); ?>uploads/<?php echo $post['userfile'] ?>" alt="" width="100px"
                     height="100px">
            <?php }
        ; ?>
            <h2><a style="color:black;"
                   href="<?php echo base_url(); ?>blog/post/<?php echo $post['post_id'] ?>"><?php echo $post['post_title']; ?></a>
            </h2>
            <?php if ($this->session->userdata('user_id') && $this->session->userdata('user_type') == 'admin' || ($this->session->userdata('user_id') == $post['user_id'] && $this->session->userdata('user_type') == 'author')) { ?>
                <p>
                    <a href="<?php echo base_url(); ?>blog/editpost/<?php echo $post['post_id'] ?>"><span
                            class="glyphicon glyphicon-edit" title="Edit post"></span></a> |
                    <a href="<?php echo base_url(); ?>blog/deletepost/<?php echo $post['post_id'] ?>"><span
                            style="color:#f77;" class="glyphicon glyphicon-remove-circle"
                            title="Delete post"></span></a>
                </p>
            <?php } ?>
            <p><?php echo substr(strip_tags($post['post']), 0, 200) . '...'; ?></p>
            <p><a href="<?php echo base_url(); ?>blog/post/<?php echo $post['post_id'] ?>">Read More</a></p>
            <hr>
        <?php } ?>
    </div>
</div>