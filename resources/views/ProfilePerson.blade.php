<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <div class="container jumbotron">

        <div class="row">
            <div class="col-md-12">
                <?php
                $email = session()->get('email');
                $get_data = "SELECT * FROM signup WHERE email = '$email' ";
                $run_data = DB::select($get_data);
                $data = $run_data;

                foreach ($data as $item) {
                    $fname = $item->fname;
                    $lname = $item->lname;
                    $image = $item->image;

                    echo "
                   <span>
                      <a href='/profile' style='text-decoration:none'>
                        <img src = 'images/$image' width='50px' height='50px' style='' class='img-thumbnail'>
                      </a>
                      
                   </span>
                   <span style='margin-left:900px'>
                      <a href='/logout' class='btn btn-primary'>Logout</a>
                   </span>
                   <br>
                   <span style='font-weight:bold; font-size:11px'>
                      $fname $lname
                   </span>
                   
                   
                   ";
                }

                ?>

            </div>

            <div class="col-md-12">
                <?php
                $session_id = session()->get('id');

                $get_data = "SELECT * FROM signup WHERE id=$session_id ";
                $run_data = DB::select($get_data);
                $data = $run_data;

                foreach ($data as $item) {
                    $fname = $item->fname;
                    $lname = $item->lname;
                    $image = $item->image;



                    echo "

                    <div class='text-center'>
                        <img src='images/$image' class='img-thumbnail' width='200px' height='200px' style=''>
                    ";

                    //friend status checkcode
                    $session_email = session()->get('email');
                    $get_friend_data = "SELECT * FROM userlist WHERE f_id = $session_id AND user_email = '$session_email'  ";
                    $run_friend_data = DB::select($get_friend_data);
                    $count = count($run_friend_data);

                    //session email avoid friend data request
                    $find_session_data = "SELECT * FROM signup WHERE id=$session_id ";
                    $run_find_session_data = DB::select($find_session_data);
                    $data_find_session = $run_find_session_data;

                    foreach ($data_find_session as $item_find_session) {
                        $find_session_email = $item_find_session->email;
                        if ($session_email == $find_session_email) {
                            $count = 1;
                        }
                    }

                    //end

                    //opponent friend Data
                    $opponent_data = "SELECT * FROM userlist WHERE user_id = $session_id AND f_email = '$session_email' ";
                    $run_opponent_data = DB::select($opponent_data);
                    $count_opponent = count($run_opponent_data);
                    //echo $count_opponent;

                    $opponent_data_list = $run_opponent_data;

                    foreach ($opponent_data_list as $opponent_item) {
                        $status = $opponent_item->status;

                        if ($status == 'friend') {
                            echo "

                                <span style='margin-left:10px'>
                                    <button class='btn btn-primary'>Friend</button>
                                </span>
                            
                            ";
                        } elseif ($status == 'requestsent') {
                            echo "

                            <span style='margin-left:10px'>
                                <button class='btn btn-danger'>Accept</button>
                            </span>

                            
                            ";
                        } elseif ($status == 'decline') {
                            echo "

                            <span style='margin-left:10px'>
                                <a href='declinesent/$session_id' class='btn btn-dark'>Decline</a>
                            </span>
                            
                            ";
                        }
                    }







                    if ($count == 0 && $count_opponent == 0) {
                        echo "

                        <span style='margin-left:10px'>
                                <a href='addfriend/$session_id' class='btn btn-warning'>AddFriend</a>
                        </span>
                        
                        
                        ";
                    } else {

                        $userlistData = $run_friend_data;

                        foreach ($userlistData as $item) {
                            $status = $item->status;


                            if ($status == 'friend') {
                                echo "
    
                                <span style='margin-left:10px'>
                                    <button class='btn btn-primary'>Friend</button>
                                </span>
                                
                                ";
                            } elseif ($status == 'decline') {
                                echo "
    
                                <span style='margin-left:10px'>
                                    <a href='declinesent/$session_id' class='btn btn-dark'>Decline</a>
                                </span>
                                
                                ";
                            } else {
                                echo "
                                
                                <span style='margin-left:10px'>
                                    <button class='btn btn-danger'>RequestSent</button>
                                </span>
                                
                                ";
                            }
                        }
                    }






                    echo "
                        
                       
                        <div style='font-weight:bold; font-size:11px'>$fname $lname</div>
                    </div>
                    <hr>
                    ";

                    

                    


                   
                }

                ?>

                <?php
                //User Post SHoW Procedure
                $session_email = session()->get('email');
                
                $get_data = "SELECT * FROM signup WHERE id ='$session_id' ";
                $run_data = DB::select($get_data);
                $data = $run_data;

                foreach($data as $item)
                {
                    $user_image = $item->image;
                    $user_fname = $item->fname;
                    $user_lname = $item->lname;
                    $user_email = $item->email;

                    $get_post_data = "SELECT * FROM userpost WHERE user_email ='$user_email' ORDER BY id DESC ";
                    $run_post_data = DB::select($get_post_data);
                    $data_post = $run_post_data;

                    foreach($data_post as $item_post)
                    {
                        $time = $item_post->time;
                        $message = $item_post->message;
                        $post_image = $item_post->image;
                        $post_id = $item_post->id;

                        echo "

                        <div class='col-md-6 offset-md-3'>
                            <span>
                                <img src='images/$user_image' class='img-thumbnail' width='50px' height='50px' style=''>
                                <span style='font-weight:bold; font-size:12px'>
                                    $user_fname $user_lname
                                </span>
                                ";

                                if($session_email==$user_email){
                                    echo "

                                    <span style='margin-left:300px; font-size:30px'>
                                        <a href='#' style='text-decoration:none' data-toggle='modal' data-target='#post$post_id'>...</a>
                                    </span>
                                    
                                    ";
                                }

                                //post delete modal

                                echo "
                                <div class='modal' id='post$post_id'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                               <span>Are you want to delete Your Post??</span>
                                            </div>
                                            <div class='modal-header'>
                                              <a href='delete-post/$post_id' class='btn btn-danger'>Delete</a>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                ";

                                //End post delete modal

                                echo "
                               
                                <br>
                                <span style='margin-left:40px; font-size:10px; font-weight:bold; color:blue;'>
                                ";
    
                                //Time set
                                $date = date("M d, Y", strtotime($time));
                                echo $date;
    
                                echo "
                            </span>
                            <br>
                            <span>
                            <br>
                            <span style='margin-left:30px;'>
                                $message
                            </span>
                            ";

                            if($post_image==''){
                                echo "<hr>";
                            }else{
                                echo "
                                
                                <img src='images/$post_image' class='img-thumbnail' style='width:400px; height:400px; margin-left:30px; margin-top:10px'>
                                <hr>
                                
                                ";
                            }

                            echo "
                            </span>
                            <span>
                            ";

                            //Like data count

                            $get_like_data = "SELECT * FROM likedata WHERE post_id=$post_id";
                            $run_like_data = DB::select($get_like_data);
                            $count = count($run_like_data);

                            if($count == 0)
                            {

                                echo "

                                <a href='#' data-toggle='modal' data-target='' style='text-decoration:none; font-weight:bold; font-size:10px'>
                                   No people's like
                                </a>
                             
                             ";

                            }else{

                                echo "

                                <a href='#' data-toggle='modal' data-target='#like$post_id' style='text-decoration:none; font-weight:bold; font-size:10px'>
                                   $count people's like
                                </a>
                             
                             ";

                            }

                           

        

                            //End like data count

                            //start like modal
                             echo "

                             <div class='modal' id='like$post_id'>
                                <div class='modal-dialog'>
                                   <div class='modal-content'>
                                       <div class='modal-header'>
                                          <span style='font-weight:bold; font-size:10px'>people's like</span>
                                       </div>
                                       <div class='modal-body'>
                                          ";

                                          $get_like_history = "SELECT * FROM likedata WHERE post_id=$post_id";
                                          $run_like_history = DB::select($get_like_history);
                                          $data_like_history = $run_like_history;

                                          foreach($data_like_history as $item_like_history)
                                          {
                                              $like_user_id = $item_like_history->user_id;

                                              $collect_like_all_data = "SELECT * FROM signup WHERE id=$like_user_id";
                                              $run_collect_like_all_data = DB::select($collect_like_all_data);
                                              $data_collect_like = $run_collect_like_all_data;

                                              foreach($data_collect_like as $item_collect_like)
                                              {
                                                  $collect_like_image = $item_collect_like->image;
                                                  $collect_like_fname = $item_collect_like->fname;
                                                  $collect_like_lname = $item_collect_like->lname;

                                                  echo "

                                                  <div style='margin-bottom:5px'>
                                                     <img src='images/$collect_like_image' style='width:50px; height:50px' class='img-thumbnail'>
                                                     <span style='font-weight:bold; font-size:10px'>$collect_like_fname $collect_like_lname</span>
                                                  </div>

                                                   
                                                   

                                                  
                                                  ";

                                              }

                                              
                                          }

                                          echo "
                                       </div>
                                       <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Close</button>
                                       </div>
                                   </div>
                                </div>
                             </div>
                             
                             ";
                            //end like modal


                            //Start comment data
                            $get_comment_data = "SELECT * FROM comment WHERE post_id=$post_id";
                            $run_comment_data = DB::select($get_comment_data);
                            $comment_count = count($run_comment_data);
                            

                            if($comment_count ==0)
                            {

                                echo "

                                <a href='#' data-toggle='modal' data-target='' style='text-decoration:none; font-weight:bold; font-size:10px; margin-left:180px; color:red'>
                                      No comment yet..
                                   </a>
                                
                                ";

                            }else{

                                echo "

                                <a href='#' data-toggle='modal' data-target='#comment$post_id' style='text-decoration:none; font-weight:bold; font-size:10px; margin-left:180px; color:red'>
                                      $comment_count people's comment..
                                   </a>
                                
                                ";
                                
                            }

                           

                           
                            //End comment data

                            //start comment modal
                            echo "

                            <div class='modal' id='comment$post_id'>
                               <div class='modal-dialog'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                         <span style='font-weight:bold; font-size:10px'>people's comment</span>
                                      </div>
                                      <div class='modal-body'>
                                         ";

                                         $get_comment_history = "SELECT * FROM comment WHERE post_id=$post_id";
                                         $run_comment_history = DB::select($get_comment_history);
                                         
                                         $data_comment_history = $run_comment_history;
                                         

                                         foreach($data_comment_history as $item_comment_history)
                                         {
                                             $comment_user_id = $item_comment_history->user_id;
                                             $comment_data = $item_comment_history->comment_data;

                                             $collect_comment_all_data = "SELECT * FROM signup WHERE id=$comment_user_id";
                                             $run_collect_comment_all_data = DB::select($collect_comment_all_data);
                                             $data_collect_comment = $run_collect_comment_all_data;

                                             foreach($data_collect_comment as $item_collect_comment)
                                             {
                                                 $collect_comment_image = $item_collect_comment->image;
                                                 $collect_comment_fname = $item_collect_comment->fname;
                                                 $collect_comment_lname = $item_collect_comment->lname;

                                                 echo "

                                                 <div style='margin-bottom:5px'>
                                                    <img src='images/$collect_comment_image' style='width:50px; height:50px' class='img-thumbnail'>
                                                    <span>$comment_data</span>
                                                    <br>
                                                    <span style='font-weight:bold; margin-top:5px; font-size:10px'>$collect_comment_fname $collect_comment_lname</span>
                                                 </div>

                                                  
                                                  

                                                 
                                                 ";

                                             }

                                             
                                         }

                                         echo "
                                      </div>
                                      <div class='modal-footer'>
                                           <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Close</button>
                                      </div>
                                  </div>
                               </div>
                            </div>
                            
                            ";
                            //End comment modal

                            

                            

                            
                            

                            echo "
                            
                            </span>
                            <span>
                                

                            
                            ";

                            
                            echo "

                            </span>
                        </div>
                        <br>
                        
                        ";
                        

                    }

                   

                }
                
                ?>





            </div>

        </div>
        <!--End row-->

    </div>
    <!--End Container--->


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</body>

</html>