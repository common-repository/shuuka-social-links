<?php
    /**
     * The template for the main content of the panel.
     * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
     *
     * @author      Redux Framework
     * @package     ReduxFramework/Templates
     * @version:    3.5.4.18
     */
?>
<!-- Header Block -->
<?php $this->get_template( 'header.tpl.php' ); ?>

<!-- Intro Text -->
<?php if ( isset( $this->parent->args['intro_text'] ) ) { ?>
    <div id="redux-intro-text"><?php echo wp_kses_post( $this->parent->args['intro_text'] ); ?></div>
<?php } ?>

<?php $this->get_template( 'menu_container.tpl.php' ); ?>

<div class="redux-main">
    <!-- Stickybar -->
    <?php $this->get_template( 'header_stickybar.tpl.php' ); ?>
    <div id="redux_ajax_overlay">&nbsp;</div>

    <!-- <tr>
	<th scope="row">
		<div class="redux_field_th">Secret Key</div>
	</th>
	<td>
        <fieldset id="shuuka_user_page_setting-secret-key" class="redux-field-container redux-field redux-field-init redux-container-password " data-id="secret-key" data-type="password">
            <input type="password" id="secret-key" name="shuuka_user_page_setting[secret-key]" value="dfdfdf" class="" data-keeper-lock-id="k-m0xxsznsgcm">
                <div class="description field-desc">Please enter the secret key</div>
                <keeper-lock id="k-m0xxsznsgcm" class="keeper-lock-disabled" style="top: 316.781px; left: 482px; z-index: 1; height: 16px !important; visibility: hidden;"></keeper-lock>
            </fieldset>
        </td>
    </tr> -->

    <?php
        foreach ($this->parent->sections as $k => $section) {
        if ( isset( $section['customizer_only'] ) && $section['customizer_only'] == true ) {
            continue;
        }

        //$active = ( ( is_numeric($this->parent->current_tab) && $this->parent->current_tab == $k ) || ( !is_numeric($this->parent->current_tab) && $this->parent->current_tab === $k )  ) ? ' style="display: block;"' : '';
        $section['class'] = isset( $section['class'] ) ? ' ' . $section['class'] : '';
        echo '<div id="' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr( $section['class'] ) . '" data-rel="' . $k . '">';
                
        //echo '<div id="' . $k . '_nav-bar' . '"';
        /*
    if ( !empty( $section['tab'] ) ) {

        echo '<div id="' . $k . '_section_tabs' . '" class="redux-section-tabs">';

        echo '<ul>';

        foreach ($section['tab'] as $subkey => $subsection) {
            //echo '-=' . $subkey . '=-';
            echo '<li style="display:inline;"><a href="#' . $k . '_section-tab-' . $subkey . '">' . $subsection['title'] . '</a></li>';
        }

        echo '</ul>';
        foreach ($section['tab'] as $subkey => $subsection) {
            echo '<div id="' . $k .'sub-'.$subkey. '_section_group' . '" class="redux-group-tab" style="display:block;">';
            echo '<div id="' . $k . '_section-tab-' . $subkey . '">';
            echo "hello ".$subkey;
            do_settings_sections( $this->parent->args['opt_name'] . $k . '_tab_' . $subkey . '_section_group' );
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        */

        // Don't display in the
        $display = true;
        if ( isset( $_GET['page'] ) && $_GET['page'] == $this->parent->args['page_slug'] ) {
            if ( isset( $section['panel'] ) && $section['panel'] == "false" ) {
                $display = false;
            }
        }

        if ( $display ) {
            do_action( "redux/page/{$this->parent->args['opt_name']}/section/before", $section );
            $this->output_section( $k );
            do_action( "redux/page/{$this->parent->args['opt_name']}/section/after", $section );
        }
        //}
    ?></div><?php
    //print '</div>';
    }

    /**
     * action 'redux/page-after-sections-{opt_name}'
     *
     * @deprecated
     *
     * @param object $this ReduxFramework
     */
    do_action( "redux/page-after-sections-{$this->parent->args['opt_name']}", $this ); // REMOVE LATER

    /**
     * action 'redux/page/{opt_name}/sections/after'
     *
     * @param object $this ReduxFramework
     */
    do_action( "redux/page/{$this->parent->args['opt_name']}/sections/after", $this );
?>
<div class="clear"></div>
<!-- Footer Block -->
<?php $this->get_template( 'footer.tpl.php' ); ?>
<div id="redux-sticky-padder" style="display: none;">&nbsp;</div>
</div>
<div class="clear"></div>