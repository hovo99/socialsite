<?php
include_once ('../layouts/header.php');
include_once '../vendor/Functions.php';
include_once '../vendor/Database.php';
$f->isSignedIn();
$session = mt_rand(1,999);




$query = $db->query("select * from chat where (first_user_id=".$id." AND  second_user_id = ".$_POST["userId"].") OR (first_user_id = ".$_POST["userId"]." AND second_user_id=".$id.") limit 1");
$chat = mysqli_fetch_assoc($query);
// var_dump($id);

// var_dump($_POST["userId"]);
if($chat == null)
{
    $res = $db->query("INSERT INTO `chat`(`first_user_id`, `second_user_id`) VALUES (".$id .",". $_POST["userId"]. ")");
    $chat = $db->query("Select * from chat where (first_user_id=".$id." AND  second_user_id = ".$_POST["userId"].") or (first_user_id = ".$_POST["userId"]." AND second_user_id=".$id.")  limit 1");
    $chat = mysqli_fetch_assoc($chat);
}

//$query = $db->select('chat_messages',['chat_id'=>$chat["id"]]);
$q = $db->query("select * from chat_messages where chat_id=" .$chat["id"]);
//$messages = mysqli_fetch_assoc($q);



$f_u = $db->select('users', ['id' => $_POST["userId"]]);
$s_u = $db->select('users', ['id' => $id]);
$f_u = mysqli_fetch_assoc($f_u);
$s_u = mysqli_fetch_assoc($s_u);
?>
<style type="text/css">
    * {margin:0;padding:0;box-sizing:border-box;font-family:arial,sans-serif;resize:none;}
    html,body {width:100%;height:100%;}
    #wrapper {position:relative;margin:auto;max-width:1000px;height:100%;}
    #chat_output {position:absolute;top:0;left:0;padding:20px;width:100%;height:calc(100% - 100px);}
    #chat_input {position:absolute;bottom:0;left:0;padding:10px;width:100%;height:100px;border:1px solid #ccc;}
</style>
<div id="wrapper">
    <div id="chat_output">
        <p style="text-align: center"><?=$f_u['first_name']. ' '. $f_u['last_name']. ' ' . '-i het haxordakcvel';?></p>
<!--       //while ($row = mysqli_fetch_assoc($q)) { -->
        <?php foreach ($q as $row) {
            $cl = '';
//            echo '<div class="'. $row['sender_id'] == $f_u['id'] ? "my" : "" .'">';
            if($row['sender_id'] == $f_u['id'])
            {
                $cl = "my";
            }
            echo '<div class="' .$cl .'">';
                echo $row['sender_id'] == $f_u['id'] ? $f_u['first_name'] . ' ' . $f_u['last_name'] . ":" : $s_u['first_name'] . " " . $s_u['last_name'] . ":";
                echo $row["message"];
                echo "<br>";
          echo "</div>";
       } ?>

    </div>
    <textarea id="chat_input" placeholder="Deine Nachricht..."></textarea>

</div>
<?php
include_once ('../layouts/footer.php');

?>
<script type="text/javascript">
    // Websocket
    var websocket_server = new WebSocket("ws://localhost:8080/");
    websocket_server.onopen = function(e) {
        websocket_server.send(
            JSON.stringify({
                'type':'socket',
                'user_id':<?php echo $id; ?>
            })
        );
    };
    websocket_server.onerror = function(e) {
        // Errorhandling
    }
    websocket_server.onmessage = function(e)
    {
        var json = JSON.parse(e.data);
        switch(json.type) {
            case 'chat':
                if(json.user && json.user.id == <?php echo $_POST["userId"];?>  || <?php echo $id;?> == json.user.id)
                   $('#chat_output').append( json.user.first_name + " " + json.user.last_name + ":" + json.msg + "<br>");

                console.log(json);
                break;
        }
    }
    // Events
    $('#chat_input').on('keyup',function(e){
        if(e.keyCode==13 && !e.shiftKey)
        {
            var chat_msg = $(this).val();
            websocket_server.send(
                JSON.stringify({
                    'type':'chat',
                    'user_id':<?php echo $session; ?>,
                    'sender': <?php echo $id; ?>,
                    'reciever': <?php echo $_POST["userId"];?>,
                    'chat_id': <?php echo $chat["id"];?>,
                    'chat_msg':chat_msg
                })
            );
            $(this).val('');
        }
    });
</script>
<style>
    .my{
      text-align: right ;
    }
</style>
