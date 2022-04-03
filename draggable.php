<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./js/jquery-ui.min.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
</head>
<link rel="stylesheet" href="./main.css">

<script>
    function toFixedLength(num, len) {
        return num.toString().padStart(len, '0')
    }
</script>

<body>
    <!-- 查看PHP -->
    <?php
    include('./link.php');
    $sql = $db->prepare('select * from works');
    $sql->execute();

    $query = $sql->fetchAll();
    ?>


    <div class="remove"></div>
    <div class="title">
        <div class="timer">時間</div>
        <div class="worker">
            工作
            <button onclick="but()">新增</button>

            <button onclick="but_modify()">修改</button>

        </div>
    </div>
    <div class="any"></div>

    <!-- 彈跳視窗 -->
    <form action="./dialog_insert.php" class="fm" method="post" title="a工作編輯">
        <div class="row">
            <div class="txt" style="width: 125px;text-align: left;">b工作名稱：</div>
            <input type="text" name="name" autocomplete="off" style="width: 100%;">
        </div>

        <p></p>
        <div class="row">
            <div class="txt">c處理情形：</div>
            <select name="DealWith" id="st">
                <option value="未處理">未處理</option>
                <option value="處理中">處理中</option>
                <option value="已完成">已完成</option>
            </select>

            <div class="txt">d優先情形：</div>
            <select name="TimeNow" id="st">
                <option value="普通件">普通件</option>
                <option value="速件">速件</option>
                <option value="最速件">最速件</option>
            </select>
        </div>

        <p></p>
        <div class="row">
            <div class="txt">e開始時間：</div>

            <select name="StartTime" id="st1">

                <script>
                    for (let i = 0; i < 24; i++) {
                        // console.log(toFixedLength(i, 2))
                        $('#st1').append('<option value="' + toFixedLength(i, 2) + '" id="op1">' + toFixedLength(i, 2) + '</option>')
                    }
                </script>

            </select>
            <!-- <input type="time" autocomplete="off"> -->

            <div class="txt">f結束時間：</div>
            <select name="EndTime" id="st2">

                <script>
                    for (let i = 0; i < 24; i++) {
                        $('#st2').append('<option value="' + toFixedLength(i, 2) + '" id="op1">' + toFixedLength(i, 2) + '</option>')
                    }
                </script>

            </select>

        </div>

        <div class="row">g工作內容：</div>
        <textarea name="TextBox" cols="30" rows="10" style="width: 100%;"></textarea>

        <div class="but" style="display: flex; justify-content: center;">
            <input type="submit">
            <input type="reset">
        </div>
    </form>

    <!-- 修改視窗 -->
    <div class="tab" title="修改視窗" style="display: flex;justify-content: center;">
        <table>
            <tr>
                <td>工作名稱</td>
                <td>處理情形</td>
                <td>優先情形</td>
                <td>開始時間</td>
                <td>結束時間</td>
                <td>修改/刪除</td>
            </tr>

            <?php
            foreach ($query as $data) {
            ?>
                <tr>
                    <td><?php echo $data['Name'] ?></td>
                    <td><?php echo $data['DealWith'] ?></td>
                    <td><?php echo $data['TimeNow'] ?></td>
                    <td><?php echo $data['StartTime'] ?></td>
                    <td><?php echo $data['EndTime'] ?></td>
                    <td style="width: 102px;">
                        <!-- <button onclick="modify()">查看</button> -->
                        <a href="./modify.php?value=<?php echo $data['Name'] ?>">查看</a>
                        <!-- <button onclick="remove()" id="<?php echo $data['Name'] ?>">刪除</button> -->
                        <a href="./remove.php?value=<?php echo $data['Name'] ?>">刪除</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>



</body>

<script>
    // 彈跳視窗
    $('.fm').dialog({
        width: 450,
        autoOpen: false,
        modal: true
    })

    function but() {
        $('.fm').dialog('open')
    }

    // 查看視窗
    $('.tab').dialog({
        width: 510,
        autoOpen: false,
        modal: true
    })

    function but_modify() {
        $('.tab').dialog('open')
    }

    // 時間調整
    $(function() {
        for (let i = 0; i < 24; i += 2) {
            let dv = $('<div class="items"><div class="time">' + toFixedLength(i, 2) + '-' + toFixedLength(i + 2, 2) + '</div><div class="work" id="w' + (i) + '"></div></div>')
            $('.any').append(dv)
        }

        <?php
        include('./link.php');

        $sql = $db->prepare('select * from works');

        $sql->execute();
        $query = $sql->fetchAll();


        foreach ($query as $data) {
        ?>


            $('.work:eq(0)').append($('<div class="content"><div class="content_item"><?php echo $data['StartTime']; ?>-<?php echo $data['EndTime']; ?></div><div class="content_item"><?php echo $data['Name']; ?></div><div class="content_item"><?php echo $data['DealWith']; ?></div><div class="content_item"><?php echo $data['TimeNow']; ?></div></div>'))


        <?php
        }
        ?>


        $('.items').droppable({
            accept: '.content',
            tolerance: 'pointer',
            drop: function(event, ui) {

                $(ui.draggable).css({
                    top: 0,
                    left: 0,

                })
                $(event.target).find(".work").append(ui.draggable)
                // console.log($(ui.helper[0].children[1]).text())
                $(ui.helper[0].children[0]).text($(event.target.childNodes[0]).text())


                location.href = './ChangeTime.php?value=' + ($(ui.helper[0].children[1]).text()) + ',' + ($(ui.helper[0].children[0]).text().split('-'))

            }


        })

        $('.content').draggable({
            containment: '.any',

        })


        // 刪除
        $('.remove').droppable({
            accept: '.content',
            tolerance: 'pointer',

            drop: function(event, ui) {
                location.href = './remove.php?value=' + $(ui.draggable[0].childNodes[1]).text()
            }
        })

        $('.content').draggable({

        })
        $('.remove').draggable()
    })
</script>


</html>