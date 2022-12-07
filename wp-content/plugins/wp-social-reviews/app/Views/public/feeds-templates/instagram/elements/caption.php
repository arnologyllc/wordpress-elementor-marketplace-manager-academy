<?php
if ($caption && isset($template_meta['template']) && $template_meta['template'] === 'template2') { ?>
    <div class="wpsr-ig-post-caption">
        <p class="wpsr-ig-post-caption-text"><?php echo preg_replace("/#(\w+)/",
                '<a class="wpsr-ig-post-caption-tags" href="https://www.instagram.com/explore/tags/$1" target="_blank">#$1</a>', nl2br($caption)); ?></p>
    </div>
<?php } elseif ($caption) { ?>
    <div class="wpsr-ig-post-caption">
        <p class="wpsr-ig-post-caption-text"><?php echo isset($feed['caption']) ? nl2br($caption) : ''; ?></p>
    </div>
<?php }