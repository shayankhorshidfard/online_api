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
            <th style="text-align: center">عملیات</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($samples as $sample): ?>
            <tr>
                <td><?php echo $sample->id; ?></td>
                <td><?php echo $sample->name_office; ?></td>
                <td><?php echo $sample->api_address; ?></td>
                <td><?php echo $sample->categories; ?></td>
                <td style="text-align: center">
                    <a class="button" style="width: 120px;text-align: center;margin-bottom: 5px"
                       href="<?php echo add_query_arg(['action' => 'delete', 'item' => $sample->id]) ?>">حذف کردن</a>

                    <a  class="button" href="<?php echo add_query_arg(['action' => 'edit','id' => $sample->id]) ?>" style="display: none;width: 120px;border: 2px solid #e1ba00;color: #e1ba00">
                        ویرایش
                    </a>
                    <?php
                    the_content();
                    ?>
                    <form action="" method="post">
                        <input type="hidden" value="<?php echo $sample->api_address; ?>" name="apiUrl">
                        <input  type="hidden" value="<?php echo $sample->categories; ?>" name="cat">
                    <button class="button" type="submit" id="portpostbtn" name="getNews" style="width: 120px;border: 2px solid green;color: green">
                        دریافت اطلاعات
                    </button>
                        <button class="button" type="submit" id="portpostbtn" name="savesetting" style="width: 120px;border: 2px solid #4579c3;color: #4579c3">
                            ثبت اطلاعات
                        </button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
///GET API
    if (isset($_POST['savesetting']))
    {

        $response = wp_remote_get( $_POST['apiUrl'] );
    $posts = json_decode( wp_remote_retrieve_body( $response ) );

    echo '<div class="latest-posts">';
    if($posts !=null)
    {
        global $wpdb;
        foreach( $posts as $post ) {
            $title = $post->title->rendered;
            $apipost = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts");

            if(is_array($apipost))
            {

                $wpdb->insert($wpdb->prefix . 'posts', [
                    'post_title' => $post->title->rendered,
                    'post_content' => $post->content->rendered,

                ]);
                $wpdb->insert($wpdb->prefix . 'postmeta', [
                    'post_id' => $post->id,
                    'meta_key' => $post->guid->rendered,
                ]);

            }


        }
        echo '</div>';
    }

    }
// GET NEWS AND SHOW THEM
    if (isset($_POST['getNews']))
    {

        $res = wp_remote_get( $_POST['apiUrl'] );
        $ps = json_decode( wp_remote_retrieve_body( $res ) );

        echo '<div class="latest-posts">';
        if($ps !=null)
        {
            global $wpdb;
            foreach( $ps as $pst ) {
                $title = $pst->title->rendered;
                $apost = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts");
                echo '<li><h2>'.$pst->date.'</h2>';
                echo '<h2>'.$pst->title->rendered.'</h2>'.$pst->content->rendered.'</h2></li>';

            }
            echo '</div>';
        }

    }
    ?>

</div>