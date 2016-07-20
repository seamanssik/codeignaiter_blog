<div id="site_content">
    <div id="content">
        <?php if (!isset($post)) {
            echo "This page was accessed incorrectly";
        } else {
            ?>
            <h2><?php echo $post['post_title'] ?></h2>
            <p><?php echo $post['post'] ?></p>
            <?php if($post['userfile'] && !empty($post['userfile'])){ ?>
                <img src="<?php echo base_url(); ?>uploads/<?php echo $post['userfile'] ?>" alt="" width="400px" height="400px">
            <?php }; ?>
            <hr>
            <h3>Comments</h3>
            <?php
            if (count($comments) > 0) {
                foreach ($comments as $row) { ?>
                    <p><strong><?php echo $row['username'] ?></strong> said
                        at <?php echo date('d-m-Y h:i A', strtotime($row['date_added'])) ?><br>
                        <?php echo $row['comment']; ?></p>
                    <hr>
                <?php }
            } else {
                echo "<p>There are no comment.</p>";
            } ?>
            <?php if ($this->session->userdata('user_id')) {?>
                <form action="<?php echo base_url(); ?>comments/add_comment/<?php echo $post['post_id'] ?>"
                      method="post">
                    <div class="form_settings">
                        <p>
                            <span>Comment</span>
                            <textarea class="textarea" rows="8" cols="100" name="comment"></textarea>
                        </p>
                        <p style="padding-top: 15px">
                            <span>&nbsp;</span>
                            <input class="submit" type="submit" name="add" value="Add comment"/>
                        </p>
                    </div>
                </form>
            <?php } else { ?>
                <a href="<?php echo base_url(); ?>users/login">Login to comment</a>
            <?php }
        } ?>
    </div>
</div>