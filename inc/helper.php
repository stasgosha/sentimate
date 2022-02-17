<?php
//Reading time
function estimated_reading_time($post_id){
    $post = get_post($post_id);
    $postcnt = strip_tags( $post->post_content);
    $words = count(preg_split('/\s+/', $postcnt));
    $minutes = floor( $words / 120 );
    $seconds = floor( $words % 120 / ( 120 / 60 ) );
    if (1 <= $minutes){$estimated_time = $minutes . ' min read';}
    else{$estimated_time = $seconds . ' sec read';}
    return $estimated_time;
}
//Get page by template
function getPageByTemplate($template){
    $args = [
        'post_type' => 'page',
        'fields' => 'ids',
        'nopaging' => true,
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ];
    $pages = get_posts( $args );
    return $pages[0];
}
function text_preview($phrase, $max_words) {
    $phrase = strip_shortcodes($phrase);
    $phrase = strip_tags($phrase);
    $phrase_array = explode(' ',$phrase);
    if(count($phrase_array) > $max_words && $max_words > 0)
        $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
    return $phrase;
}
?>

