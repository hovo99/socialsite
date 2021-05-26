<?php
set_time_limit(0);

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
require_once '../vendor/autoload.php';

include_once '../vendor/Database.php';

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $users;
    private $db;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->db = new Database();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        /* $this->users[$conn->resourceId] = json_encode($this->clients);*/
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
         unset($this->users[$conn->resourceId]);
    }

    public function onMessage(ConnectionInterface $from,  $data) {
        $from_id = $from->resourceId;
        $data = json_decode($data);
        $type = $data->type;

//        $this->db->query("INSERT INTO `chat_messages`( `chat_id`, `sender_id`, `message`) VALUES ( ".$data->chat_id.",".$data->sender.",".$data->chat_msg.")");

        switch ($type) {
            case 'chat':
                $user_id = $data->user_id;
                $chat_msg = $data->chat_msg;
             //   $this->db->query("INSERT INTO  chat_messages ( chat_id, sender_id, message) VALUES (1,2,3)");
                $this->db->insert('chat_messages',['chat_id'=>$data->chat_id,'sender_id'=>$data->sender,'message'=>$chat_msg]);
              //  $res = $this->db->select('chat', ['id'=>$data->chat_id]);
              //  $res  = $this->db->query("select * from chat where id=".$data->chat_id);
            //    $res_id = 0;
               // if(true) {
               //     $row = mysqli_fetch_assoc($res);
               //     $res_id = $row['first_user'] == $data->sender ? $row['second_user'] : $row['first_user'];
              //  }
               /* while ($row = mysqli_fetch_assoc($res)) {
                    $res_id = $row['first_user'] == $data->sender ? $row['second_user'] : $row['first_user'];
                }*/
                $query = $this->db->select('users', ['id'=>$data->sender]);
                $row = mysqli_fetch_assoc($query);

                $response_from = "<span style='color:#999'><b>".$user_id.":</b> ".$chat_msg."</span><br><br>";
                $response_to = $chat_msg."<br><br>";
                // Output
                    $from->send(json_encode(array("type"=>$type,"msg"=>$response_to, 'user' => $row)));
                foreach($this->clients as $client)
                {
                   // if($from!=$client)
                    if(false)
                    {
                        $client->send(json_encode(array("type"=>$type,"msg"=>implode(" ",$this->users))));
                    }
                    if($this->users[$data->reciever] == $client->resourceId) {

                        $client->send(json_encode(array("type"=>$type,"msg"=>$chat_msg, 'user' => $row)));
                     }
                }
                break;
            case 'socket':
                $this->users[$data->user_id] = $from_id;

        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}
$server = IoServer::factory(
    new HttpServer(new WsServer(new Chat())),
    8080
);
$server->run();
