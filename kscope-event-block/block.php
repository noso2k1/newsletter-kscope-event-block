<?php
/*
 * Name: Kscope event block
 * Section: content
 * Description: Kscope event block for the newsletter plugin
 */

/* @var $options array */

// The "block_*" options are reserved and could be processed directly by Newsletter. For example the
// "block_background" and "block_padding_*" are used to generated the wrapper of the block content.

$default_options = array(
    'title' => 'Card title',
    'text' => 'Text that goes in the description of the card.',
    'date' => 'Event date',

    'bg_color' => '#eeeeee',

    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'block_background' => '', // Leave empty to use the block background set on the newsletter settings
);

$options = array_merge($default_options, $options);

// Ok, this is a bit tricky and should be improved. $title_style and $text_style are object containing the merged font style between
// that is configured in the block and what is configured in the newsletter settings. When a block font option is set to "default" the
// global value is used.
// The methods ask for: the block options, the option prefix to identify the block font settings (if the prefix is "title" the method will
// look for options starting with "title_font_*". Then they need the $composer which contains the global options. The method "get_title_style"
// takes from the global options the general style for titles and the method get_text_style takes from the global options the 
// general style for text.

$title_style = TNP_Composer::get_title_style($options, 'title', $composer);
$text_style = TNP_Composer::get_text_style($options, 'text', $composer);


// Image preparation (again, that is a bit tricky...)
$media = null;
if (!empty($options['image']['id'])) {
    // The $media is an onject containing the image URL and the size to specify in the HTML tag. The image is resized at
    // 2x to be sharp on mobile devices.
    $media = tnp_resize_2x($options['image']['id'], [$composer['width'], 0]);
    // Should never happen but... it happens
    if (!$media) {
        // Do something...
    }
}

$button_options = $options;
$button_options["button_url"] = $options['url']

?>

<style>
    .title {
        <?php $title_style->echo_css() ?>
    }
    
    .text {
        <?php $text_style->echo_css() ?>
    }
</style>

<table width="100%" style="background:<?php echo $options['bg_color']?>;border-radius:18px;overflow:hidden;">
    <tr>
        <td width="38%">
            <a href="<?php echo $options['url']?>" target="_blank">
                <?php if ($media) echo TNP_Composer::image($media) ?>
            </a>
        </td>
        <td style="padding:16px;">
            <p style="margin:0 0 5px 0;font-weight:bold;font-size:14px;"><?php echo $options['date']?></p>
            <h2 style="margin:0;font-size:21px;"><?php echo $options['title']?></h2>
            <p style="margin:8px 0 12px 0;font-size:15px;line-height:21px;"><?php echo $options['text']?></p>
            <p><?php echo TNP_Composer::button($button_options, 'button', $composer); ?></p>
        </td>
    </tr>
</table>
