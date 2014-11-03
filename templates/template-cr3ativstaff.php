<?php  
/* 
Template Name: Cr3ativStaff
*/  
?>

<?php get_header(); ?>

<!-- Start of content wrapper -->
<div id="cr3ativstaff_contentwrapper">

    <!-- Start of content wrapper -->
    <div class="cr3ativstaff_content_wrapper">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

        <?php the_content('        '); ?> 

        <?php endwhile; ?> 

        <?php else: ?> 
        <p><?php _e( 'There are no posts to display. Try using the search.', 'cr3atstaff' ); ?></p> 

        <?php endif; ?>

        <div class="cr3ativstaff_clear"></div>
        
        <?php 
          $temp = $wp_query; 
          $wp_query = null; 
          $wp_query = new WP_Query(); 
          $wp_query->query('post_type=cr3ativstaff'.'&paged='.$paged); 
        ?>

        <?php while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

            <!-- Start of staff wrapper -->
            <div class="cr3ativstaff_staff_wrapper"> 

                <!-- Start of one third -->
                <div class="cr3ativstaff_one_third">
                <?php
                $stafftitle = get_post_meta($post->ID, 'stafftitle', $single = true); 
                $staffheadshot = get_post_meta($post->ID, 'staffheadshot', $single = true); 
                ?>

                    <!-- Start of employee image -->
                    <div class="cr3ativstaff_employee_image">
                    <a href="<?php the_permalink (); ?>"><?php echo wp_get_attachment_image($staffheadshot, ''); ?></a>

                    </div><!-- End of employee image -->

                    <!-- Start of employee name -->
                    <div class="cr3ativstaff_employee_name">
                    <a href="<?php the_permalink (); ?>"><?php the_title (); ?></a>

                    </div><!-- End of employee name -->

                    <!-- Start of employee title -->
                    <div class="cr3ativstaff_employee_title">
                    <?php if ($stafftitle != ('')){ ?>
                    <?php echo stripslashes($stafftitle); ?>
                    <?php } else { } ?>

                    </div><!-- End of employee title -->

                    <!-- Start of employee social -->
                    <div class="cr3ativstaff_employee_social">
                        <?php $repeatable_fields = get_post_meta($post->ID, 'repeatable', true);
                        if ($repeatable_fields != ('')){ 
                        foreach ($repeatable_fields as $v) { ?>

                    <a href="<?php echo $v['repeatable_socailurl']; ?>"><?php echo wp_get_attachment_image($v['repeatable_socailimage'], ''); ?></a>
                    <?php } } else { }?>

                    </div><!-- End of employee social -->

                </div><!-- End of one third -->

            </div><!-- end of staff wrapper -->

        <?php endwhile; ?> 
        
        <!-- Clear Fix --><div class="cr3ativstaff_clear"></div>
        
            <!-- Start of pagination -->
            <div id="cr3ativ_pagination">

            <!-- Start of next post -->
            <div class="cr3ativ_next_post">
                <?php next_posts_link(__('Next Page', 'cr3atstaff')); ?>

            </div>
            <!-- End of next post -->

            <!-- Start of prev post -->
            <div class="cr3ativ_prev_post">
                <?php previous_posts_link(__('Previous Page', 'cr3atstaff')); ?>

            </div>
            <!-- End of prev post -->

            </div><!-- End of pagination -->   

        <?php $wp_query = null; $wp_query = $temp;  // Reset ?>

    </div><!-- End of content wrapper -->

    <!-- Clear Fix --><div class="cr3ativstaff_clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>