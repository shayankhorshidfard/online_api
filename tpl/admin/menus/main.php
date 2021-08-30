<style>
    table {
        border: 2px solid #dddd !important;
        border-bottom: none !important;
        font-size: 15px !important;
        font-weight: bold !important;
        border-radius: 5px !important;
    }
</style>

<div class="wrap">
    <h1>
        لیست اطلاعات
    </h1>
    <a class="button" href="<?php echo add_query_arg(['action' => 'add']) ?>" style="margin: 10px">
        ثبت داده جدید
    </a>

    <table class="widefat" dir="rtl">
        <thead>
        <tr>
            <th>id</th>
            <th>نام مرکز</th>
            <th>آدرس API</th>
            <th>قسمت</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($samples as $sample): ?>
            <tr>
                <td><?php echo $sample->id; ?></td>
                <td><?php echo $sample->name_office; ?></td>
                <td><?php echo $sample->api_address; ?></td>
                <td><?php echo $sample->categories; ?></td>
                <td>
                    <a class="button"
                       href="<?php echo add_query_arg(['action' => 'delete', 'item' => $sample->id]) ?>">حذف کردن</a>
                    <?php
                    the_content();
                    ?>
                    <button class="button" id="portpostbtn">
                        اعمال اطلاعات
                    </button>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
$response = wp_remote_get('https://qom.iastjd.ac.ir/wp-json/wp/v2/posts');
$posts = json_decode(wp_remote_retrieve_body($response));
echo '<div class="latest-posts">';
foreach ( $posts as $post ){
    echo " '<li><h2>'.$post->title->rendered.'</h2>'.$post->content->rendered.'</h2></li>' ";
}
    echo '</div>';
?>
    <script>
        const url = 'https://qom.iastjd.ac.ir/wp-json/wp/v2/posts';
        const postsContainer = document.querySelector('.latest-posts');
        fetch(url)
            .then(response => response.json())
            .then(data => {
                data.map(post => {
                    const innerContent =
                        `
            <li>
            <h2>${post.title.rendered}</h2>
            <h2>${post.content.rendered}</h2>
            </li> `
                    postsContainer.innerHTML  += innerContent;
                })
            });

    </script>

    <div id="portpostcontainer">

    </div>
</div>