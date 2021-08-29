<style>
    table{
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
    <a class="button" href="<?php echo add_query_arg(['action' => 'add'])?>" style="margin: 10px">
        ثبت داده جدید
    </a>

    <table class="widefat" dir="rtl">
        <thead>
        <tr>
            <th>id</th>
            <th>نام مرکز</th>
            <th>آدرس API</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($samples as $sample): ?>
        <tr>
            <td><?php echo $sample->id; ?></td>
            <td><?php echo $sample->name_office; ?></td>
            <td><?php echo $sample->api_address; ?></td>
            <td><a class="button" href="<?php echo add_query_arg(['action' => 'delete' , 'item' => $sample->id]) ?>">حذف کردن</a></td>

        </tr>
        <?php endforeach ; ?>
        </tbody>
    </table>
</div>