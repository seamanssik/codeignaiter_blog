<div id="site_content">
    <div id="content">
        <h1>New Post</h1>
        <form action="<?php echo base_url(); ?>blog/new_post/" method="post" enctype="multipart/form-data">
          <div class="form_settings">
            <p><span>Title</span><input required class="" type="text" name="post_title" value="" /></p>
            <p><span>Description</span><textarea required class="textarea" rows="15" cols="50" name="post"></textarea></p>
              <input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" name="user_id">
              <?php
              $data_form = array(
                  'name' => 'userfile',
                  'required' => 'true'
              ); ?>
              <?php echo form_upload($data_form); ?>
              <p style="padding-top: 15px"><input class="submit" type="submit" name="add" value="Publish" /></p>
          </div>
        </form>
    </div>
</div>