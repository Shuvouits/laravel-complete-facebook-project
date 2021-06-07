<?php

$session_post_id = session()->get('session_post_id');
$get_like_data = "SELECT * FROM likedata WHERE post_id=$session_post_id ";
$run_like_data = DB::select($get_like_data);

$count = count($run_like_data);
$data_like = $run_like_data;

foreach($data_like as $item_like)
{
    $like_user_fname = $item_like->user_fname;
}

//echo $like_user_fname;

echo "<a href='#' data-toggle='modal' data-target='#likeShow' style='text-decoration:none; font-size:10px; font-weight:bold'>$count people's like</a>";




?>

<div class='modal' id='likeShow'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class="modal-header">
                All like user..
            </div>
            <div class='modal-body'>
                <?php

                    $session_post_id = session()->get('session_post_id');
                    $get_like_data_show = "SELECT * FROM likedata WHERE post_id = $session_post_id ";
                    $run_like_data_show = DB::select($get_like_data_show);
                    $data_like_show = $run_like_data_show;

                    foreach($data_like_show as $item_like_show)
                    {
                        $like_user_fname = $item_like_show->user_fname;
                        $like_user_lname = $item_like_show->user_lname;
                        $like_user_id = $item_like_show->user_id;

                        $get_like_user_image = "SELECT * FROM signup WHERE id=$like_user_id ";
                        $run_like_user_image = DB::select($get_like_user_image);
                        $data_like_user_image = $run_like_user_image;

                        foreach($data_like_user_image as $item_like_user_image)
                        {
                            $like_user_image = $item_like_user_image->image;

                            echo "

                            <a href='userprofile/$like_user_id' style='text-decoration:none'>

                            <img src='images/$like_user_image'  style='width:40px; height:40px; border-radius:100%; '>
                            <span>$like_user_fname $like_user_lname</span>
                            <br>
                            <br>
                            
                            
                            </a>

                            
                            ";
                        }

                    }
      
                
                ?>

            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
            </div>

        </div>

    </div>
</div>