<div class="wrap">
    <header>تنظیمات عمومی</header>

</div>

<div class="latest-posts">
    <?php

    $response = wp_remote_get( 'https://qom.iastjd.ac.ir/wp-json/wp/v2/posts' );
    $posts = json_decode( wp_remote_retrieve_body( $response ) );

    echo '<div class="latest-posts">';
    foreach( $posts as $post ) {
        echo '<li><h2>'.$post->title->rendered.'</h2>'.$post->excerpt->rendered.'<a href="' . $post->link . '">
  بیشتر بخوانید

</a></li>';
    }
    echo '</div>';


    ?>
</div>
