<?php get_header(); ?>

<!-- Start of content wrapper -->
<div id="cr3ativstaff_contentwrapper">

    <!-- Start of content wrapper -->
    <div class="cr3ativstaff_content_wrapper"> 

        <!-- Start of employee image single -->
        <div class="cr3ativstaff_employee_image_single">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php
        $stafftitle = get_post_meta($post->ID, 'stafftitle', $single = true); 
        $stafffullwidthimage = get_post_meta($post->ID, 'stafffullwidthimage', $single = true); 
        ?>

        <?php echo wp_get_attachment_image($stafffullwidthimage, ''); ?>

        </div><!-- End of employee image single -->

        <h2><?php the_title (); ?></h2>

            <!-- Start of employee info -->
            <div class="cr3ativstaff_employee_info">

                <!-- Start of social icons -->
                <div class="cr3ativstaff_social_icons">

                    <?php $repeatable_fields = get_post_meta($post->ID, 'repeatable', true);
                    if ($repeatable_fields != ('')){ 
                    foreach ($repeatable_fields as $v) { ?>

                <a href="<?php echo $v['repeatable_socailurl']; ?>"><?php echo wp_get_attachment_image($v['repeatable_socailimage'], ''); ?></a>
                <?php } } else { }?>

                </div><!-- End of social icons -->

                <!-- Start of employee title -->
                <div class="cr3ativstaff_employee_title">
                <?php if ($stafftitle != ('')){ ?>
                <?php echo stripslashes($stafftitle); ?>
                <?php } else { } ?>

                </div><!-- End of employee title -->

            </div><!-- End of employee info -->

        <?php the_content('        '); ?> 

        <?php endwhile; ?> 

        <?php else: ?> 
        <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3atstaff' ); ?></p> 

        <?php endif; ?>

    </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativstaff_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>