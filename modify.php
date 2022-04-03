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
    // echo $_GET['value']
    $sql = $db->prepare('select * from works where Name=:name');

    $sql->bindValue('name', $_GET['value']);
    $sql->execute();

    $query = $sql->fetch();
    ?>

    <form action="./dialog_update.php" class="fm" method="post" title="a工作編輯">
        <div class="row">
            <div class="txt" style="width: 125px;text-align: left;">b工作名稱：</div>
            <input type="text" name="name" autocomplete="off" style="width: 100%;" value="<?php echo $query['Name'] ?>">
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
        <textarea name="TextBox" cols="30" rows="10" style="width: 100%;"><?php echo $query['TextBox'] ?></textarea>

        <div class="but" style="display: flex; justify-content: center;">
            <input type="submit">
            <input type="reset">
        </div>
    </form>
</body>

<script>
    $('.fm').dialog({
        width: 480,
        // autoOpen: false,
        modal: true,
        close: function() {
            location.href = './draggable.php'
        }
    })
</script>

</html>