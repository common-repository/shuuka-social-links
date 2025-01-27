<?php
    /**
     * The template for the header sticky bar.
     * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
     *
     * @author        Redux Framework
     * @package       ReduxFramework/Templates
     * @version:      3.6.10
     */
?>
<div id="redux-sticky">
    <div id="info_bar">

        <a href="javascript:void(0);" class="expand_options<?php echo esc_attr(($this->parent->args['open_expanded']) ? ' expanded' : ''); ?>"<?php echo $this->parent->args['hide_expand'] ? ' style="display: none;"' : '' ?>>
            <?php esc_attr_e('Expand', 'redux-framework'); ?>
        </a>

        <div class="redux-ajax-loading" alt="<?php esc_attr_e('Working...', 'redux-framework') ?>">&nbsp;</div>
        <div class="clear"></div>
    </div>

    <!-- Notification bar -->
    <div id="redux_notification_bar">
        <?php $this->notification_bar(); ?>
    </div>


</div>