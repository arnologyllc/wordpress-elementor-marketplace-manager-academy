<div class="wpsr-yt-header-logo">
    <a class="wpsr-yt-header-logo-url" target="_blank"
       rel="noopener noreferrer"
       href="<?php echo esc_url('https://www.youtube.com/channel/' . $header['items'][0]['id']); ?>">
        <img class="wpsr-yt-header-img-render" src="<?php echo esc_url($header['items'][0]['snippet']['thumbnails']['high']['url']); ?>"
             :alt="<?php echo esc_attr($header['items'][0]['snippet']['title']); ?>">
    </a>
</div>