<?php
/**
 * SlideDeck Pointers Class
 * 
 * More information on this project:
 * http://www.slidedeck.com/
 * 
 * Full Usage Documentation: http://www.slidedeck.com/usage-documentation 
 * 
 * @package SlideDeck
 * @subpackage SlideDeck 3 Pro for WordPress
 * @author SlideDeck
 */

/*
Copyright 2012 HBWSL  (email : support@hbwsl.com)

This file is part of SlideDeck.

SlideDeck is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

SlideDeck is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with SlideDeck.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php
class SlideDeckPointers {
    // Pointers for the current admin page
    var $pointers = array();
    
    // Namespace for IDs and classes
    var $namespace = "slidedeck";
    
    /**
     * Add a pointer
     * 
     * Adds a pointer to the pointer array to queue it up for rendering on the page by the
     * SlideDeckPlugin::pointer_script() method.
     * 
     * @param string $pointer_id The ID to identify the pointer by
     * @param string $selector The jQuery JavaScript selector for the element to attach the pointer to
     * @param array $args Optional argument overrides (position and the like)
     * 
     * @uses is_rtl()
     * @uses wp_parse_args()
     */
    final function create( $pointer_id, $selector, $content, $args = array() ) {
        $pointer = array(
            'id' => "{$this->namespace}_{$pointer_id}",
            'selector' => $selector,
            'content' => $content,
            'position' => array(
                'edge' => ( is_rtl() ? "right" : "left" ),
                'align' => "left"
            )
        );
        
        $pointer = wp_parse_args( $args, $pointer );
        
        $this->pointers["{$this->namespace}_{$pointer_id}"] = $pointer;
    }
    
    function pointer_lens_management() {
        global $SlideDeckPlugin;
        
        $content = '<h3 class="' . $this->namespace . '">' . esc_js( __( "New Feature: Lens Management", $this->namespace ) ) . '</h3>';
        $content.= '<p>' . esc_js( __( "Skins are now Lenses and they're more powerful than ever! We've made managing, editing, uploading and creating your own lenses easier than ever! Now you can edit lenses right from the WordPress control panel, make copies of stock lenses and upload new lenses for all your SlideDecks.", $this->namespace ) ) . '</p>';
        
        $this->create( "lens-management", '#' . $SlideDeckPlugin->menu['manage'] . ' a[href$="' . SLIDEDECK2_BASENAME . '/lenses"]', $content );
    }
    
    function pointer_installation_discount() {
        global $SlideDeckPlugin;
        
        $install_args = array(
            'position' => array(
                'edge' => 'top',
                'align' => "left"
            )
        );
        $content = '<h3 class="' . $this->namespace . '">' . esc_js( __( "Subscribe & Win", $this->namespace ) ) . '</h3>';
        $content.= '<div class="more-info">';
        $content.= '<strong style="font-size:20px;text-align:center;">' . esc_js( __( "FREE DEVELOPER LICENSE", $this->namespace ) ) . '</strong><br />';
        
        $content.= '<p>' . esc_js( __( "Subscribe for the SlideDeck newsletter - in addition to bringing you the latest WordPress news & useful web design tips,", $this->namespace ) );
        $content.= '<strong>' . esc_js( __( " each month we give away a SlideDeck 3 Developer license (worth USD$99) to one of our lucky subscribers for free! ", $this->namespace ) ) . '</strong></p><br />';
        
        // $content.= '<div class="wrapper"><span class="the-offer no-margin">25% Off<span>&nbsp;</span></span><span class="the-offer">7 Days<span>&nbsp;</span></span></div>';
        $content.= '<em>' . esc_js( __( "We promise we’ll never sell your info to anyone.", $this->namespace ) ) . '</em>';
        $content.= '<a href="http://eepurl.com/cymx9f" target="_blank" class="button slidedeck-noisy-button"><span>Subscribe</span></a>';
        
        $content.= '</div>';
        
        /*
        $content = '<h3 class="' . $this->namespace . '">' . esc_js( __( "7 days, 25% discount on SlideDeck 3", $this->namespace ) ) . '</h3>';
        $content.= '<div class="more-info">';
        $content.= '<strong>' . esc_js( __( "Welcome, thanks for choosing SlideDeck Lite!", $this->namespace ) ) . '</strong>';
        $content.= '<p>' . esc_js( __( "You are free to use this plugin for life and as a token of our appreciation we would like to offer you a 25% discount for all versions of SlideDeck 3. ", $this->namespace ) );
        $content.= '<strong>' . esc_js( __( "This offer expires in 7 days.", $this->namespace ) ) . '</strong></p>';
        $content.= '<div class="wrapper"><span class="the-offer no-margin">25% Off<span>&nbsp;</span></span><span class="the-offer">7 Days<span>&nbsp;</span></span></div>';
        $content.= '<a href="' . $SlideDeckPlugin->action( '/upgrades' ) . '" class="button slidedeck-noisy-button"><span>Learn More</span></a>';
        $content.= '</div>';
        */
        
        $this->create( "installation-discount", '#discount-upgrade-notice', $content, $install_args );
    }
    
    /**
     * Output admin pointers
     * 
     * Loops through the pointer JavaScript set by admin panel pages in the footer of 
     * the admin page.
     * 
     * @uses get_user_meta()
     * @uses get_current_user_id()
     */
    final function render() {
        $pointers = $this->pointers;
        $namespace = "slidedeck";
        
        // Get dismissed pointers
        $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
        foreach( $dismissed as $dismiss )
            unset( $pointers[$dismiss] );
        
        if( empty( $pointers ) )
            return false;
        
        include( SLIDEDECK2_DIRNAME . '/views/elements/_pointers.php' );
    }
}
