<?php
/**
 * Displays footer widgets if assigned
 *
 * @package AI Automation
 * @subpackage ai_automation
 */
?>
<?php

// Determine the number of columns dynamically for the footer (you can replace this with your logic).
$ai_automation_no_of_footer_col = get_theme_mod('ai_automation_footer_columns', 4); // Change this value as needed.

// Calculate the Bootstrap class for large screens (col-lg-X) for footer.
$ai_automation_col_lg_footer_class = 'col-lg-' . (12 / $ai_automation_no_of_footer_col);

// Calculate the Bootstrap class for medium screens (col-md-X) for footer.
$ai_automation_col_md_footer_class = 'col-md-' . (12 / $ai_automation_no_of_footer_col);
?>
<div class="container">
    <aside class="widget-area row py-2 pt-3" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'ai-automation' ); ?>">
        <div class="<?php echo esc_attr($ai_automation_col_lg_footer_class); ?> <?php echo esc_attr($ai_automation_col_md_footer_class); ?>">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <?php
        // Footer boxes 2 and onwards.
        for ($ai_automation_i = 2; $ai_automation_i <= $ai_automation_no_of_footer_col; $ai_automation_i++) :
            if ($ai_automation_i <= $ai_automation_no_of_footer_col) :
                ?>
               <div class="col-12 <?php echo esc_attr($ai_automation_col_lg_footer_class); ?> <?php echo esc_attr($ai_automation_col_md_footer_class); ?>">
                    <?php dynamic_sidebar('footer-' . $ai_automation_i); ?>
                </div><!-- .footer-one-box -->
                <?php
            endif;
        endfor;
        ?>
    </aside>
</div>