<div class="next-prev-block next-prev-blog blog-section clearfix">
    <div class="prev-box float-left text-left">
        <?php
        $prevPost = get_previous_post(true);
        if ($prevPost) {
            ?>
            <div class="next-prev-block-content">
                <p><?php esc_html_e('Prev Post', 'houzez'); ?></p>
                <a href="<?php echo get_permalink($prevPost->ID); ?>"><strong><?php echo get_the_title($prevPost->ID); ?></strong></a>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="next-box float-right text-right">
        <?php
        $nextPost = get_next_post(true);
        if ($nextPost) {
            ?>
            <div class="next-prev-block-content">
                <p><?php esc_html_e('Next Post', 'houzez'); ?></p>
                <a href="<?php echo get_permalink($nextPost->ID); ?>"><strong><?php echo get_the_title($nextPost->ID); ?></strong></a>
            </div>
            <?php
        }
        ?>
    </div>
</div>