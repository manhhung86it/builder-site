<?php
/**
 * The template for displaying the main nav bar on main page or archive page
 *
 * Override this template by copying it to yourtheme/portfolio/navbar/main-navbar.php
 *
 * @author 		A3 Rev
 * @version     1.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div style="clear:both"></div>

<div class="a3-portfolio-navigation-mobile">
    <i class="a3-portfolio-navigation-mobile-icon a3-portfolio-icon-list"></i>
    <span><?php echo a3_portfolio_ei_ict_t__('Mobile Navigation', __('Navigation', 'a3_portfolios')); ?></span>
</div>

<div style="clear:both"></div>

<div class="a3-portfolio-menus-container">

    <div style="clear:both"></div>

    <ul class="filter">

        <li>
            <a rel="*" href="#" class="filter-m active"><?php echo a3_portfolio_ei_ict_t__('All Filter', __('All', 'a3_portfolios')); ?></a>
        </li>

        <?php
        if (is_array($menus) && count($menus) > 0) :

            foreach ($menus as $menu_slug => $menu_name):
                ?>
                <li class="_<?php echo $menu_slug; ?>">
                    <a rel="<?php echo $menu_slug; ?>" class="filter-m" href="#"><?php echo $menu_name; ?></a>
                </li>
                <?php
            endforeach;

        endif;
        ?>

        <li style="display: none" class="_uncategorized">
            <a rel="uncategorized" class="filter-m" href="#"><?php echo __('Uncategorized', 'a3_portfolios'); ?></a>
        </li>

    </ul>

    <div style="clear:both"></div>

</div>

<div style="clear:both"></div>