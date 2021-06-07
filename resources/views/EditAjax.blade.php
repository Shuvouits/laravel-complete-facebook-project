<?php
    $session_comment_id = session()->get('comment_id');
    $get_edit_data = "SELECT * FROM comment WHERE id=$session_comment_id";
    $run_edit_data = DB::select($get_edit_data);
    $data_edit = $run_edit_data;

    foreach($data_edit as $item_edit)
    {
        $edit_comment_data = $item_edit->comment_data;

        echo $edit_comment_data;
    }

?>