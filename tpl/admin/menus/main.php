<style>
    table {
        border: 2px solid #dddd !important;
        border-bottom: none !important;
        font-size: 15px !important;
        font-weight: bold !important;
        border-radius: 5px !important;
    }
</style>
<script>
    var portpostbtn = document.getElementById("portpostbtn");
    var portpostcontainer = document.getElementById("portpostcontainer");

    if (portpostbtn) {
        portpostbtn.addEventListener("click", function () {
            var ourRequest = new XMLHttpRequest();
            ourRequest = new XMLHttpRequest();
            ourRequest.open('GET', 'https://qom.iastjd.ac.ir/wp-json/wp/v2/posts?categories=9');
            ourRequest.onload = function () {
                if (ourRequest.status >= 200 && ourRequest.status < 400) {
                    var data = JSON.parse(ourRequest.responseText);
                    createHTML(data);
                } else {
                    console.log("RETURENED ERROR!");
                }
            };
            OurRequest.onerror = function () {
                console.log("connection error");
            };

            ourRequest.send();
        });
    }
    function CreateHTML(postData){
        var ourHTMLString = '';
        for(i = 0; i < postsData.length;i++)
        {
            ourHTMLString += '<h2>' + postsData[i].title.rendered + '</h2>';
            ourHTMLString += postData[i].content.rendered;
        }
        portpostcontainer.innerHTML = ourHTMLString;
    }
</script>
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
    <div id="portpostcontainer">

    </div>
</div>