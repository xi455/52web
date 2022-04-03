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
    <link rel="stylesheet" href="./main.css">
</head>
<script>
    function toFixedLength(num, len) {
        return num.toString().padStart(len, '0')
    }
</script>

<body>
    <?php
    include('./link.php');
    $sql = $db->prepare('select * from works');
    $sql->execute();

    $query = $sql->fetchAll();
    ?>


    <div class="change">
        <button onclick="but()">修改</button>
    </div>

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
    $('.tab').dialog({
        width: 510,
        // autoOpen: false,
        modal: true
    })
    
    function but() {
        $('.tab').dialog('open')
    }
    $('.fm').dialog({
        width: 480,
        autoOpen: false,
        modal: true
    })


    function modify() {
        $('.fm').dialog('open')
        $('.tab').dialog('close')
        console.log(this)
    }

    // function remove() {
    //     // location.href = './remove.php?value=<?php echo $data['Name'] ?>'
    //     location.href = './remove.php?value='
    // }
</script>

</html>