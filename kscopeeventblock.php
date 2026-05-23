<?php
/*
  Plugin Name: Newsletter - Kscope Event Block
  Plugin URI: https://kscope.ch
  Description: An event block for the Newsletter plugin
  Version: 1.0.0
  Author: Kaleidoscope
  Author URI: https://kscope.ch
  Disclaimer: 
  Text Domain: newsletter-kscope-event-block
  License: GPLv2 or later
  Requires PHP: 5.6
  Requires at least: 5.0.0
*/

// Please, register this action not limited to the admin side, since the block needs to be available even
// on frontend. 
// The action is fired only when Newsletter needs the blocks so there is no overhead.

add_action('newsletter_register_blocks', function () {
    // The registration function needs a folder where the block.php, the options.php the icon.png are located. 
    TNP_Composer::register_block(__DIR__ . '/kscope-event-block');
});


