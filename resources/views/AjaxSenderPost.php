<?php

$ajax_chat_receiver_id = session()->get('chat_receiver_id');

$get_data = "SELECT * FROM chat WHERE sender_id=$ajax_chat_receiver_id OR receiver_id=$ajax_chat_receiver_id";
$run_data = DB::select($get_data);
$data = $run_data;

foreach($data as $item)
{
    $sender_id = $item->sender_id;
    $receiver_id = $item->receiver_id;
    $sender_data = $item->sender_data;

   
}

$get_image = "SELECT * FROM signup WHERE id=$sender_id";
$run_image = DB::select($get_image);
$data_image = $run_image;

foreach($data_image as $item_image)
{
    $target_image = $item_image->image;

    echo "

    <img src='images/$target_image' class='img-thumbnail' style='width:50px; height:50px;'>
    <span style='font-weight:bold; font-size:12px'>$sender_data</span>
    
    ";
}

//echo "Virhat Kholi";

?>