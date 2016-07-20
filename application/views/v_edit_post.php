<div id="site_content">
    <div id="content">
        <div class="success-message" style="color: green;">
            <?php if ($success == 1) {
                echo "This post has been updated";
            } ?>
        </div>
        <h1>Edit</h1>
        <form action="<?php echo base_url(); ?>blog/editpost/<?php echo $post['post_id'] ?>" method="post" enctype="multipart/form-data">
            <div class="form_settings">
                <p>
                    <span>Title</span>
                    <input class="" type="text" name="post_title" value="<?php echo $post['post_title']; ?>"/>
                </p>
                <p>
                    <span>Description</span>
                    <textarea class="textarea" rows="8" cols="50" name="post"><?php echo $post['post']; ?></textarea>
                </p>
                <input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" name="user_id">
                <?php
                if(isset($error)){ echo $error; }else{ echo ''; };
                echo form_open_multipart('blog/editpost');
                $data_form = array(
                    'name' => 'userfile',
                    'required' => 'true'
                ); ?>
                <?php echo form_upload($data_form); ?>
                <p style="padding-top: 15px">
                    <input class="submit" type="submit" name="add" value="Update"/>
                </p>
            </div>
        </form>
    </div>
</div>
