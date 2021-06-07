<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style type="text/css">
        .box {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>


    <div class='jumbotron container'>
        <div class='row'>
            <div class='col-md-3 col-sm-3 col-xs-3'>
                <!--profile code-->
                <?php

                $session_email = session()->get('email');
                $get_data = "SELECT * FROM signup WHERE email = '$session_email' ";
                $run_data = DB::select($get_data);
                $data = $run_data;

                foreach ($data as $item) {
                    $fname = $item->fname;
                    $lname = $item->lname;
                    $image = $item->image;
                    $user_id = $item->id;

                    session()->put('fname', $fname);
                    $session_fname = session()->get('fname');

                    echo "
                       <a href='userprofile/$user_id' style='text-decoration:none'>

                           <img src='images/$image' class='img-thumbnail'  style=' width:80px; height:80px'>
                           <span style='font-weight:bold; font-size:11px'>$fname $lname</span>
                       
                       </a>
                       
                    
                       <div class='friends'>
                            <br>
                            
                            <a href='#' style='text-decoration:none; color:black' data-target='#friends' data-toggle='modal'>
                                <i style='color:#154076 ;  font-size:30px' class='fa fa-user'></i>
                                <span style='font-weight:bold; font-size:10px'>Friends</span>
                            </a>
                            
                       </div>

                       <div class='change-profile'>
                            <br>
                            
                            <a href='#' data-toggle='modal' data-target='#profilepic' style='text-decoration:none; color:black'>
                                <i style='color:#154076; font-size:30px' class='fa fa-picture-o'></i>
                                <span style='font-weight:bold; font-size:10px'>changeProfile</span>
                            </a>
                            
                       </div>

                       <div class='password-change'>
                            <br>
                            <a href='#' style='text-decoration:none' data-toggle='modal' data-target='#passwordChange'>
                                 <i class='fa fa-key' aria-hidden='true' style='color:#154076; font-size:30px'>
                                     <span style='font-weight:bold; font-size:10px; color:black'>Change password</span>
                                 </i>
                            </a>
                       </div>

                       ";

                    //Password change modal

                    echo "

                       <div class='modal' id='passwordChange'>
                           <div class='modal-dialog'>
                               <div class='modal-content'>
                                   <div class='modal-header'>
                                       <span style='font-weight:bold; font-size:12px'>Change your password</span>
                                   </div>
                                   <div class='modal-body'>
                                     
                                            <form method='post' class='passwordChange' action='PasswordChange'>
                                            ";

                                                 echo csrf_field();

                                                  echo "
                                               <div class='form-group'>
                                                  <label>Current password</label>
                                                  
                                                  <input type='password' name='current_password' class='form-control' placeholder='Put your Current password' required>
                                                  <div id='currentPassword' class='alert alert-danger' style='display:none; margin-top:10px'>Your current password is wrong.!!!</div>
                                               </div>
                                               <div class='form-group'> 
                                                   <label>New password</label>
                                                   <input type='password'  name='new_password' class='form-control' placeholder='Create your New password' required>
                                                   
                                                   <div id='newPassword' class='alert alert-danger' style='display:none; margin-top:10px'>password length at least 5 character</div>
                                               </div>
                                               <div class='form-group'>
                                                   <label>Confirm password</label>
                                                   <input type='password' name='confirm_password' class='form-control' placeholder='Confirm your new password' required>
                                                   <div id='confirmPassword' class='alert alert-danger' style='display:none; margin-top:10px'>ConfirmPassword isn't correct..</div>
                                               </div>
                                               <input type='submit' class='btn btn-primary' value='submit'>
                                           </form>
                                       

                                    </div>
                                   <div class='modal-footer'>
                                         <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                       
                       ";

                       //New Suggested Friend

                      

                   
                }

                ?>
                <!--End Profile Code-->

                <!--Add Friend Modal--->

                <div class="modal" id="friends">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Friend List</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php
                                $get_data = "SELECT * FROM userlist WHERE f_email ='$session_email' ";
                                $run_data = DB::select($get_data);
                                $data = $run_data;
                                $count = count($data);

                                //opoonent friend list show
                                $get_opponent_data = "SELECT * FROM userlist WHERE user_email ='$session_email' ";
                                $run_opponent_data = DB::select($get_opponent_data);
                                $count_opponent = count($run_opponent_data);
                                $opponent_data = $run_opponent_data;

                                foreach ($opponent_data as $item_opponent) {
                                    $status = $item_opponent->status;
                                    $f_image = $item_opponent->f_image;
                                    $f_f_name = $item_opponent->f_f_name;
                                    $f_l_name = $item_opponent->f_l_name;
                                    $f_id = $item_opponent->f_id;

                                    if ($status == 'requestsent') {
                                        echo "
                                        

                                        <img src='images/$f_image' width='100px' height='100px' class='img-thumbnail'>
                                            <span style='margin-left: 10px;'>
                                                <a href='friendlist/$f_id' class='btn btn-primary'>RequestSent</a>
                                            </span>
                                            <span style='margin-left:10px'>
                                                <a href='cancel/$f_id' class='btn btn-danger btn-sm'>Cancel</a>
                                            </span>
                                            <div style='font-weight:bold; font-size:11px'>
                                                <span>$f_f_name </span>
                                                <span>$f_l_name</span>
                                            </div>
                                            <br>
                                            
                                        
                                        
                                        ";
                                    } elseif ($status == 'friend') {

                                        echo "

                                        <img src='images/$f_image' width='100px' height='100px' class='img-thumbnail'>
                                        <span style='margin-left: 10px;'>
                                            <a href='friendlist/$f_id' class='btn btn-info btn-sm'>friend</a>
                                        </span>
                                        <span style='margin-left:10px'>
                                            <a href='dec/$f_id' class='btn btn-warning btn-sm'>Decline</a>
                                        </span>
                                        <div style='font-weight:bold; font-size:11px'>
                                            <span>$f_f_name </span>
                                            <span>$f_l_name</span>
                                        </div>
                                        <br>
                                        
                                        
                                        ";
                                    }
                                }



                                if ($count == 0 && $count_opponent == 0) {
                                    echo "
                                         <span style='font-weight:bold'>
                                            You Have no Friends.
                                         </span>
                                    ";
                                }

                                foreach ($data as $item) {
                                    $status = $item->status;
                                    $user_image = $item->user_image;
                                    $user_f_name = $item->user_f_name;
                                    $user_l_name = $item->user_l_name;
                                    $user_id = $item->user_id;

                                    if ($status == 'requestsent') {
                                        echo "
                                        

                                        <img src='images/$user_image' width='100px' height='100px' class='img-thumnail'>
                                            <span style='margin-left: 10px;'>
                                                <a href='friendlist/$user_id' class='btn btn-primary btn-sm'>Accept</a>
                                            </span>
                                            <span style='margin-left:10px'>
                                                <a href='dec/$user_id' class='btn btn-danger btn-sm'>Decline</a>
                                            </span>
                                            <div style='font-weight:bold; font-size:11px'>
                                                <span>$user_f_name </span>
                                                <span>$user_l_name</span>
                                            </div>
                                            <br>
                                            
                                        
                                        
                                        ";
                                    } elseif ($status == 'friend') {
                                        echo "

                                        <img src='images/$user_image' width='100px' height='100px' class='img-thumbnail'>
                                        <span style='margin-left: 10px;'>
                                            <a href='friendlist/$user_id' class='btn btn-info btn-sm'>Friend</a>
                                        </span>
                                        <span style='margin-left:10px'>
                                            <a href='block/$user_id' class='btn btn-warning btn-sm'>Block</a>
                                        </span>
                                        <div style='font-weight:bold; font-size:11px'>
                                            <span>$user_f_name </span>
                                            <span>$user_l_name</span>
                                        </div>
                                        <br>
                                        
                                        
                                        ";
                                    }
                                }
                                ?>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>



            </div>

            <div class='col-md-7 col-sm-7 col-xs-7'>
                <h6 class="text-center col-md-12 col-sm-12 col-xs-12">Search the People</h6>
                <div class="search box col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>

                        </div>
                        <input type="text" class="form-control" placeholder="Search the People" data-toggle='modal' data-target='#search' />

                        <!--Searchmodal-->
                        <div class="modal" id="search">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Available People</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="country_name" id="country_name" class="form-control input-lg" placeholder="Search the People" />
                                        <div id="countryList">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}

                </div>
                <br>
                <!---Post Data---->

                <div class="post">
                    <h6 class="text-center col-md-12 col-sm-12 col-xs-12">Create Your Post</h6>

                    <div class="input-group input-group-lg col-md-12 col-sm-12 col-xs-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-pencil"></i>
                            </span>

                        </div>
                        <input type="text" class="form-control" placeholder="What's your mind, <?php echo $session_fname; ?>" data-toggle="modal" data-target='#post'>
                    </div>

                </div>

                <!--post modal data--->

                <div class="modal" id="post">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Create your post</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <?php
                                $session_email = session()->get('email');
                                $get_data = "SELECT * FROM signup WHERE email ='$session_email' ";
                                $run_data = DB::select($get_data);
                                $data = $run_data;

                                foreach ($data as $item) {
                                    $fname = $item->fname;
                                    $lname = $item->lname;
                                    $image = $item->image;
                                    $user_id = $item->id;

                                    echo "

                                    <form action='postdata' method='post' enctype='multipart/form-data'>
                                    ";

                                    echo  csrf_field();

                                    echo "
                                    <div class='form-group'>
                                        <label for='comment'>Write to something</label>
                                        <textarea class='form-control' rows='5' id='comment' name='message' required></textarea>
                                    </div>
                                    <div class='form-group'>
                                        <input type='file' class='form-control' name='image'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='select'>Select</label>
                                        <select class='form-control' id='select' name='choose'>
                                            <option>Public</option>
                                            <option>Friend</option>

                                        </select>
                                    </div>
                                    <input type='hidden' value='$session_email' name='email'>
                                    <input type='hidden' value='$fname' name='fname' >
                                    <input type = 'hidden' value='$lname' name='lname'>
                                    <input type= 'hidden' value='$image' name='user_image'>
                                    <input type='hidden' value='$user_id' name='user_id'>
                                    <input type='submit' class='btn btn-warning'>
                                </form>
                                    
                                    
                                    ";
                                }

                                ?>

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <br>
                <hr>

                <!---userPost--->
                <div class="post col-md-12 col-sm-12 col-xs-12 " style="margin-left:0px">
                    <?php
                    //session_post

                    $session_email  = session()->get('email');

                    $get_session_post = "SELECT * FROM userpost WHERE user_email ='$session_email' AND choose!='Public' ORDER BY id DESC ";
                    $run_session_post = DB::select($get_session_post);
                    $data_session_post = $run_session_post;

                    foreach ($data_session_post as $run_session_post) {
                        $post_message = $run_session_post->message;
                        $post_image = $run_session_post->image;
                        $user_image = $run_session_post->user_image;
                        $time = $run_session_post->time;
                        $user_id = $run_session_post->user_id;
                        $post_id = $run_session_post->id;
                        $user_fname = $run_session_post->user_fname;
                        $user_lname = $run_session_post->user_lname;
                        $current_time = time();


                        echo "

                        <div class='col-md-12 col-sm-12 col-xs-12'>

                            <a href='userprofile/$user_id' style='text-decoration:none'>
                                <img src='images/$user_image' width=50px height=50px style='' class='img-thumbnail'>
                            </a>
                            <span style='font-weight:bold; font-size:10px'>
                                $user_fname $user_lname
                            </span>
                            <span style='margin-left:150px; font-weight:bold; font-size:10px'>
                        


                        
                      
                      ";


                        //time function

                        date_default_timezone_set('Asia/Dhaka');
                        $database_time = strtotime($time);
                        $difference_time = $current_time - $database_time;

                        $minute = floor($difference_time / 60);

                        if ($minute == 0) {
                            echo "just few second's ago";
                        } elseif ($minute > 0 && $minute <= 60) {
                            echo "$minute minute's ago";
                        } elseif ($minute >= 61 && $minute <= 1440) {
                            $hour = floor($minute / 60);
                            echo "$hour hour's ago";
                        } elseif ($minute >= 1441 && $minute <= 10080) {
                            $day = floor($minute / 1440);
                            echo "$day day's ago";
                        } elseif ($minute >= 10081 && $minute <= 43200) {
                            $week = floor($minute / 10080);
                            echo "$week week's ago";
                        } elseif ($minute >= 43201 && $minute <= 518400) {
                            $month = floor($minute / 43200);
                            echo "$month month's ago";;
                        } elseif ($minute >= 518401) {
                            $year = floor($minute / 518400);
                            echo "$year years ago";
                        }

                        echo "

                        </span>
                        <br>
                        <span>
                        <br>

                        <p style='width:400px'>
                            $post_message

                        </p>

                        </span>
                                 
                        ";

                        if ($post_image == '') {
                            echo "";
                        } else {
                            echo "

                            <span>
                                <img src='images/$post_image' class='img-thumbnail'>
                            </span>
                            <br>
                            <br>

                            
                            
                            ";
                        }

                        //Comment data show

                        $get_comment_data = "SELECT * FROM comment WHERE post_id=$post_id  ORDER BY id DESC ";
                        $run_comment_data = DB::select($get_comment_data);
                        $data_comment = $run_comment_data;

                        $count = count($run_comment_data);
                        $update_count = $count - 1;


                        foreach ($data_comment as $item_comment) {
                            $comment_user_id = $item_comment->user_id;
                            $comment_user_fname = $item_comment->user_fname;
                            $comment_user_lname = $item_comment->user_lname;
                            $comment_data = $item_comment->comment_data;


                            //Comment user Image Catch

                            $get_comment_image = "SELECT * FROM signup WHERE id =$comment_user_id ";
                            $run_comment_image = DB::select($get_comment_image);
                            $data_comment_image = $run_comment_image;

                            foreach ($data_comment_image as $item_comment_image) {
                                $comment_image = $item_comment_image->image;

                                echo "

                                    <hr>

                                    <a href='#' id='comment$post_id' style='text-decoration:none; color:black'>
                                            <span>
                                               <img src='images/$comment_image' width='20px' height='20px' style='border-radius:100%'>
                                           </span>
       
                                           <span>
                                               <span style='font-size:10px; font-weight:bold'>$comment_user_fname $comment_user_lname</span>
                                               <span style='margin-left:10px'>$comment_data</span>
                                               <br>
                                               <br>
                                           </span>
                                    </a>
                                    
                                    
                                    ";
                            }

                            if ($count > 1) {

                                echo "

                                         <span style='font-size:10px; font-weight:bold;'>
                                             <a href='$post_id' id='commentLink$post_id' data-toggle='modal' data-target='#commentshow$post_id' style='text-decoration:none; color:red'>Show $update_count more's comment</a>
                                
                                        </span>
                                
                                     ";
                            }

                            //Comment shows Modal

                            echo "
                                   <div class='modal' id='commentshow$post_id'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>

                                                <div class='modal-body'>
                                                      
                                                       ";

                            //first part

                            $get_comment_post_data = "SELECT * FROM userpost WHERE id=$post_id";
                            $run_comment_post_data = DB::select($get_comment_post_data);
                            $data_comment_post = $run_comment_post_data;

                            foreach ($data_comment_post as $item_comment_post) {
                                $comment_post_image = $item_comment_post->image;
                                $comment_post_message = $item_comment_post->message;

                                echo "
                                                                <span>$comment_post_message</span>
                                                                <br>
                                                                <br>

                                                                ";

                                if ($comment_post_image == '') {
                                    echo "
                                                                    
                                                                    ";
                                } else {

                                    echo "

                                                                    <span><br><img src='images/$comment_post_image' class='img-thumbnail' style='margin-bottom:30px'></span>
                                                                    
                                                                    ";
                                }
                            }


                            //Second part

                            $get_comment_modal_data = "SELECT * FROM comment WHERE post_id=$post_id ";
                            $run_comment_modal_data = DB::select($get_comment_modal_data);
                            $data_comment_modal = $run_comment_modal_data;

                            foreach ($data_comment_modal as $item_comment_modal) {
                                $comment_user_id = $item_comment_modal->user_id;
                                $comment_user_fname = $item_comment_modal->user_fname;
                                $comment_user_lname = $item_comment_modal->user_lname;
                                $comment_data = $item_comment_modal->comment_data;
                                $comment_id = $item_comment_modal->id;

                                //Bring Image

                                $get_comment_image_data = "SELECT * FROM signup WHERE id=$comment_user_id";
                                $run_comment_image_data  = DB::select($get_comment_image_data);
                                $data_comment_image = $run_comment_image_data;

                                foreach ($data_comment_image as $item_comment_image) {
                                    $comment_image = $item_comment_image->image;

                                    echo "

                                                                    <span>
                                                                         
                                    
                                                                         
                                                                         ";

                                    $session_email = session()->get('email');
                                    $get_session_data = "SELECT * FROM signup WHERE email ='$session_email' ";
                                    $run_session_data = DB::select($get_session_data);
                                    $data_session = $run_session_data;

                                    foreach ($data_session as $item_session) {
                                        $session_id = $item_session->id;
                                    }

                                    if ($session_id != $comment_user_id) {

                                        echo "
                                                                                     <img src='images/$comment_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%;'>
                                                                                     <span>$comment_user_fname $comment_user_lname <br></span>
                                                                                     <span style='margin-left:80px; font-weight:bold; font-size:11px'>$comment_data</span>
                                                                            
                                                                            ";
                                    }

                                    if ($session_id == $comment_user_id) {
                                        echo "
                                                                                     <img src='images/$comment_image' class='img-thumbnail  $comment_id' style='width:50px; height:50px; border-radius:100%;'>
                                                                                     <span  class='$comment_id'>$comment_user_fname $comment_user_lname <br></span>
                                                                                     <span style='margin-left:80px; font-weight:bold; font-size:11px' class='$comment_id edit$comment_id'>$comment_data </span>
                                                                                     <span id='editShow$comment_id' style='font-weight:bold; font-size:12px; margin-left:80px; color:blue;'></span>

                                                                                    <span style='margin-left:90px;  font-weight:bold; color:red; font-size:25px'>
                                                                                         <a href='$comment_id' class='$comment_id edit$comment_id'  data-toggle='modal' data-target='#specificComment$comment_id'  style='text-decoration:none'>....</a>
                                                                                    </span>
                                                                                    <br>

                                                                                    ";

                                        //specific Comment Modal

                                        echo "

                                                                                        <div class='modal' id='specificComment$comment_id'>
                                                                                           <div class='modal-dialog modal-dialog-centered'>
                                                                                               <div class='modal-content'>
                                                                                                    <div class='modal-body'>
                                                                                                        ";

                                        $get_comment_data_editOrDelete = "SELECT * FROM comment WHERE id=$comment_id";
                                        $run_comment_data_editOrDelete = DB::select($get_comment_data_editOrDelete);
                                        $data_comment_editOrDelete = $run_comment_data_editOrDelete;

                                        foreach ($data_comment_editOrDelete as $item_comment_editOrDelete) {
                                            $comment_user_fname_editOrDelete = $item_comment_editOrDelete->user_fname;
                                            $comment_user_lname_editOrDelete = $item_comment_editOrDelete->user_lname;
                                            $comment_user_data_editOrDelete = $item_comment_editOrDelete->comment_data;

                                            $comment_user_id_editOrDelete = $item_comment_editOrDelete->user_id;

                                            //Bring Image
                                            $get_comment_image_editOrDelete = "SELECT * FROM signup WHERE id = $comment_user_id_editOrDelete";
                                            $run_comment_image_editOrDelete = DB::select($get_comment_image_editOrDelete);
                                            $data_comment_image_editOrDelete = $run_comment_image_editOrDelete;

                                            foreach ($data_comment_image_editOrDelete as $item_comment_image_editOrDelete) {
                                                $comment_image_editOrDelete = $item_comment_image_editOrDelete->image;
                                            }




                                            echo "
                                                                                                                <span><img src='images/$comment_image_editOrDelete' style='width:50px; height:50px; border-radius:100%'></span>
                                                                                                                <span style='font-weight:bold; font-size:10px'>$comment_user_fname_editOrDelete $comment_user_lname_editOrDelete</span>
                                                                                                                <br>
                                                                                                                <span style='color:blue; margin-left:90px'>$comment_user_data_editOrDelete</span>
                                                                                                                <br>
                                                                                                                <hr>
                                                                                                                <span>
                                                                                                                     <form method='post' class='commentDelete'>
                                                                                                                         ";

                                            echo csrf_field();

                                            echo "
                                                                                                                         <input type='hidden' name='comment_id' value='$comment_id'>
                                                                                                                         <input type='submit' class='btn btn-danger' value='Delete'>
                                                                                                                         
                                                                                                                     </form>
                                                                                                                     <a href='#' style='margin-left:100px; margin-top:-52px'  data-toggle='modal' data-target='#commentEdit$comment_id' class='btn btn-warning'>Update</a>

                                                                                                                     
                                                                                                                
                                                                                                                </span>

                                                                                                                ";

                                            //comment Edit modal start
                                            echo "
                                                                                                                          <div class='modal' id='commentEdit$comment_id'>
                                                                                                                              <div class='modal-dialog'>
                                                                                                                                   <div class='modal-content'>
                                                                                                                                       <div class='modal-body'>
                                                                                                                                           ";

                                            $get_update_comment_data = "SELECT * FROM comment WHERE id=$comment_id";
                                            $run_update_comment_data = DB::select($get_update_comment_data);
                                            $data_update_comment = $run_update_comment_data;

                                            foreach ($data_update_comment as $item_update_comment) {
                                                $comment_update_fname = $item_update_comment->user_fname;
                                                $comment_update_lname = $item_update_comment->user_lname;
                                                $comment_update_data = $item_update_comment->comment_data;
                                                $comment_update_user_id = $item_update_comment->user_id;

                                                //bring image
                                                $get_comment_update_image = "SELECT * FROM signup WHERE id =$comment_update_user_id ";
                                                $run_comment_update_image = DB::select($get_comment_update_image);
                                                $data_comment_update = $run_comment_update_image;

                                                foreach ($data_comment_update as $item_comment_update) {
                                                    $comment_update_image = $item_comment_update->image;

                                                    echo "

                                                                                                                                                        <form method='post' class='commentEdit'> 
                                                                                                                                                             ";

                                                    echo csrf_field();

                                                    echo "
                                                                                                                                                             <div class='input-group input-group-lg'>
                                                                                                                                                                 <div class='input-group-prepend'>
                                                                                                                                                                      <span><img src='images/$comment_update_image' class='img-thumbnail' style='width:49px; height:49px;'></span>
                                                                                                                                                                 </div>
                                                                                                                                                                 <input type='hidden' name='comment-id' value='$comment_id'>
                                                                                                                                                                 <input type='hidden' name='user-id' value='$comment_update_user_id'>
                                                                                                                                                                 <input type='text' class='form-control' name='comment-data' value='$comment_update_data'>
                                                                                                                                                                 <input type='submit' value='send' class='btn btn-primary'>
                                                                                                                                                             </div>
                                                                                                                                                        </form>
                                                                                                                                                   
                                                                                                                                                   ";
                                                }
                                            }

                                            echo "
                                                                                                                                       </div>
                                                                                                                                       
                                                                                                                                   </div>
                                                                                                                              </div>
                                                                                                                          </div>
                                                                                                                     
                                                                                                                     ";
                                            //End comment Edit Modal

                                            echo "
                                                                                                                
                                                                                                            ";
                                        }


                                        echo "
                                                                                                          
                                                                                                    </div>
                                                                                                   
                                                                                                   
                                                                                               </div>
                                                                                           </div>
                                                                                        </div>
                                                                                    
                                                                                    
                                                                                    ";

                                        //End specific Comment Modal

                                        echo "
                                                                             
                                                                             ";
                                    } else {
                                        echo "<br>";
                                    }



                                    echo "
                                                                        
                                                                    </span>
                                                               
                                                               
                                                                 ";
                                }
                            }

                            echo "
                                                </div>
                                                <div class='modal-footer'>
                                                     <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                
                                
                                ";

                            //End comment show modal

                            //Ajax comment show
                            echo "
                                     <span id='$post_id'></span>
                                
                                ";



                            break;
                        }




                        //End comment data Show process


                        echo "

                             
                        <hr>

                        
                        <span>
                            <form class='frmrecord' method='post'>
                            ";
                        echo csrf_field();

                        echo "
                               <input type='hidden' name='post_id' id='post_id$post_id' value='$post_id'>
                               <button type='submit' class='btn btn-primary'><i style='color:White' class='fa fa-thumbs-up'></i></button>

                                <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#commentModal$post_id' style='text-decoration:none; margin-left:100px'>
                                     <i style='color:white' class='fa fa-comment'></i>
                                </a>


                            </form>
                               
                            
                        </span>

                        

                        <span>

                        


                         ";

                        //Like data fetch
                        $get_like_data = "SELECT * FROM likedata WHERE post_id = $post_id ";
                        $run_like_data = DB::select($get_like_data);
                        $count = count($run_like_data);
                        $data_like = $run_like_data;

                        if ($count > 0) {
                            echo "
                                <a href='#' id='show$post_id' data-toggle='modal' data-target='#likeData$post_id' style='text-decoration:none; font-weight:bold; font-size:10px'>$count people's like</a>
                                
                                ";
                        }

                        //Like Data Modal

                        echo "
                        <div class='modal' id='likeData$post_id'>
                           <div class='modal-dialog'>
                               <div class='modal-content'>
                                   <div class='modal-header'>
                                       <span style='font-weight:bold; font-size:10px'>List of people's like</span>
                                   </div>
                                   <div class='modal-body'>
                                       ";

                        $get_modal_like_data = "SELECT * FROM likedata WHERE post_id=$post_id ";
                        $run_modal_like_data = DB::select($get_modal_like_data);
                        $data_modal_like = $run_modal_like_data;

                        foreach ($data_modal_like as $item_modal_like) {
                            $user_fname = $item_modal_like->user_fname;
                            $user_lname = $item_modal_like->user_lname;
                            $user_id = $item_modal_like->user_id;

                            //Bring like list image

                            $get_like_collect_image = "SELECT * FROM signup WHERE id=$user_id";
                            $run_like_collect_image = DB::select($get_like_collect_image);
                            $data_like_collect_image = $run_like_collect_image;

                            foreach ($data_like_collect_image as $item_like_collect_image) {
                                $like_collect_image = $item_like_collect_image->image;

                                echo "

                                               <a href='userprofile/$user_id' style='text-decoration:none'>

                                                   <span><img src='images/$like_collect_image' style='width:40px; height:40px; border-radius:100%'></span>
                                                   <span style='font-size:10px; font-weight:bold'>$user_fname $user_lname <br></span>
                                                   <br>
                                               
                                               </a>
                                               
                                               ";
                            }
                        }

                        echo "
                                   </div>
                                   <div class='modal-footer'>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                   </div>
                               </div>
                           </div>
                        </div>
                        
                        
                        ";

                        //End Like Data Modal



                        echo "
                            <span id='$post_id'>
                            ";



                        echo "
                               
                            </span>
                            ";


                        echo "

                         
                        
                        
                        

                        </div>
                        <br>
                        <br>

                        
                        

                        ";

                        //Comment Post modal

                        echo "

                        <div  class='modal' id='commentModal$post_id' class='commentModal'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                       Comment Your Post
                                    </div>
                                    <div class='modal-body'>
                                       ";

                        $session_email = session()->get('email');
                        $get_session_data_for_comment = "SELECT * FROM signup WHERE email ='$session_email' ";
                        $run_session_data_for_comment = DB::select($get_session_data_for_comment);
                        $data_session_comment = $run_session_data_for_comment;

                        foreach ($data_session_comment as $item_session_comment) {
                            $comment_image = $item_session_comment->image;
                            $comment_user_id = $item_session_comment->id;
                            $comment_user_fname = $item_session_comment->fname;
                            $comment_user_lname = $item_session_comment->lname;

                            echo "

                                           <span>
                                                
                                           </span>
                                           <form method='post'  class='commentAjax'>
                                            ";

                            echo csrf_field();


                            echo "
                                                <div class='input-group mb-3 input-group-lg'>
                                                    <div class='input-group-prepend'>
                                                         <span class='input-group-text'><img src='images/$comment_image'  style='width:30px; height:30px'></span>
                                                    </div>
                                                    <input type='text' name='comment' class='form-control' placeholder='Enter Your Comment'>
                                                    <input type='hidden' name='post_id' value='$post_id'>
                                                    <input type='hidden' name='comment_user_id' value='$comment_user_id'>
                                                    <input type='hidden' name='comment_user_fname' value='$comment_user_fname'>
                                                    <input type='hidden' name='comment_user_lname' value='$comment_user_lname'>
                                                    <input type='submit' class='btn btn-primary' value='send'>
                                                </div>
                                              
                                           
                                           </form>
                                           
                                           ";
                        }

                        echo "
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        ";

                        //End Comment Modal
                    }

                    ?>


                    <!--friend_post-->

                    <?php
                    $session_email = session()->get('email');
                    $get_data = "SELECT * FROM signup WHERE email= '$session_email' ";
                    $run_data = DB::select($get_data);
                    $data = $run_data;

                    foreach ($data as $item) {
                        $session_id = $item->id;

                        $get_friend = "SELECT * FROM userlist WHERE user_id =$session_id AND status='friend' ORDER BY id DESC";
                        $run_friend = DB::select($get_friend);
                        $data_friend = $run_friend;

                        foreach ($data_friend as $item_friend) {
                            $f_email = $item_friend->f_email;

                            $target_post = "SELECT * FROM userpost WHERE user_email= '$f_email' AND choose!='Public'  ORDER BY id DESC ";
                            $run_post = DB::select($target_post);
                            $data_post = $run_post;

                            foreach ($data_post as $item_post) {
                                $post_message = $item_post->message;
                                $post_image = $item_post->image;
                                $user_image = $item_post->user_image;
                                $time = $item_post->time;
                                $user_id = $item_post->user_id;
                                $post_id = $item_post->id;
                                $user_fname = $item_post->user_fname;
                                $user_lname = $item_post->user_lname;
                                $current_time = time();

                                echo "

                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                    <a href='userprofile/$user_id' style='text-decoration:none'>
                                         <img src='images/$user_image' width=50px height=50px style='' class='img-thumbnail'>
                                    </a>
                                    <span style='font-weight:bold; font-size:10px'>
                                        $user_fname $user_lname
                                    </span>
                                    <span style='margin-left:150px; font-weight:bold; font-size:10px'>
                            
                            
                                 ";

                                //time function

                                date_default_timezone_set('Asia/Dhaka');
                                $database_time = strtotime($time);
                                $difference_time = $current_time - $database_time;

                                $minute = floor($difference_time / 60);

                                if ($minute == 0) {
                                    echo "just few second's ago";
                                } elseif ($minute > 0 && $minute <= 60) {
                                    echo "$minute minute's ago";
                                } elseif ($minute >= 61 && $minute <= 1440) {
                                    $hour = floor($minute / 60);
                                    echo "$hour hour's ago";
                                } elseif ($minute >= 1441 && $minute <= 10080) {
                                    $day = floor($minute / 1440);
                                    echo "$day day's ago";
                                } elseif ($minute >= 10081 && $minute <= 43200) {
                                    $week = floor($minute / 10080);
                                    echo "$week week's ago";
                                } elseif ($minute >= 43201 && $minute <= 518400) {
                                    $month = floor($minute / 43200);
                                    echo "$month month's ago";;
                                } elseif ($minute >= 518401) {
                                    $year = floor($minute / 518400);
                                    echo "$year years ago";
                                }

                                echo "

                                </span>
                                <br>
                                <span>
                                <br>

                                 <p style='width:400px'>
                                    $post_message
     
                                 </p>

                                 </span>

                                
                                 
                                 ";

                                if ($post_image == '') {
                                    echo "";
                                } else {
                                    echo "

                                 <span>
                                    <img src='images/$post_image' class='img-thumbnail'>
                                 </span>
                                 <br>
                                 <br>

                                 
                                 
                                 ";
                                }


                                //Comment data show

                                $get_comment_data = "SELECT * FROM comment WHERE post_id=$post_id ";
                                $run_comment_data = DB::select($get_comment_data);
                                $data_comment = $run_comment_data;

                                $count = count($run_comment_data);
                                $update_count = $count - 1;

                                foreach ($data_comment as $item_comment) {
                                    $comment_user_id = $item_comment->user_id;
                                    $comment_user_fname = $item_comment->user_fname;
                                    $comment_user_lname = $item_comment->user_lname;
                                    $comment_data = $item_comment->comment_data;

                                    //Comment user Image Catch

                                    $get_comment_image = "SELECT * FROM signup WHERE id =$comment_user_id ";
                                    $run_comment_image = DB::select($get_comment_image);
                                    $data_comment_image = $run_comment_image;

                                    foreach ($data_comment_image as $item_comment_image) {
                                        $comment_image = $item_comment_image->image;

                                        echo "

                                        <hr>

                                     <a href='#' id='comment$post_id' style='text-decoration:none; color:black'>
                                        <span>
                                            <img src='images/$comment_image' width='20px' height='20px' style='border-radius:100%'>
                                        </span>
                                        <span>
                                            <span style='font-size:10px; font-weight:bold'>$comment_user_fname $comment_user_lname</span>
                                            <span style='margin-left:10px'>$comment_data</span>
                                            <br>
                                            <br>
                                        </span>
                                     </a>

                                     
                                     ";
                                    }

                                    if ($count > 1) {

                                        echo "
    
                                             <span style='font-size:10px; font-weight:bold;'>
                                                 <a href='$post_id' id='commentLink$post_id' data-toggle='modal' data-target='#commentshow$post_id' style='text-decoration:none'>Show $update_count more's comment</a>
                                    
                                            </span>
                                    
                                         ";
                                    }


                                    //Comment shows Modal

                                    echo "
                                <div class='modal' id='commentshow$post_id'>
                                     <div class='modal-dialog'>
                                         <div class='modal-content'>

                                             <div class='modal-body'>
                                                   
                                                    ";

                                    //first part

                                    $get_comment_post_data = "SELECT * FROM userpost WHERE id=$post_id";
                                    $run_comment_post_data = DB::select($get_comment_post_data);
                                    $data_comment_post = $run_comment_post_data;

                                    foreach ($data_comment_post as $item_comment_post) {
                                        $comment_post_image = $item_comment_post->image;
                                        $comment_post_message = $item_comment_post->message;

                                        echo "
                                                             <span>$comment_post_message</span>
                                                             <br>
                                                             <br>

                                                             ";

                                        if ($comment_post_image == '') {
                                            echo "
                                                                 
                                                                 ";
                                        } else {

                                            echo "

                                                                 <span><br><img src='images/$comment_post_image' class='img-thumbnail' style='margin-bottom:30px'></span>
                                                                 
                                                                 ";
                                        }
                                    }


                                    //Second part

                                    $get_comment_modal_data = "SELECT * FROM comment WHERE post_id=$post_id ";
                                    $run_comment_modal_data = DB::select($get_comment_modal_data);
                                    $data_comment_modal = $run_comment_modal_data;

                                    foreach ($data_comment_modal as $item_comment_modal) {
                                        $comment_user_id = $item_comment_modal->user_id;
                                        $comment_user_fname = $item_comment_modal->user_fname;
                                        $comment_user_lname = $item_comment_modal->user_lname;
                                        $comment_data = $item_comment_modal->comment_data;
                                        $comment_id = $item_comment_modal->id;

                                        //Bring Image

                                        $get_comment_image_data = "SELECT * FROM signup WHERE id=$comment_user_id";
                                        $run_comment_image_data  = DB::select($get_comment_image_data);
                                        $data_comment_image = $run_comment_image_data;

                                        foreach ($data_comment_image as $item_comment_image) {
                                            $comment_image = $item_comment_image->image;

                                            echo "

                                                                 <span>
                                                                      
                                                                      
                                                                      
                                                                      ";

                                            $session_email = session()->get('email');
                                            $get_session_data = "SELECT * FROM signup WHERE email ='$session_email' ";
                                            $run_session_data = DB::select($get_session_data);
                                            $data_session = $run_session_data;

                                            foreach ($data_session as $item_session) {
                                                $session_id = $item_session->id;
                                            }

                                            if ($session_id != $comment_user_id) {
                                                echo "
                                                                                 
                                                                                 <img src='images/$comment_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%;'>
                                                                                 <span>$comment_user_fname $comment_user_lname <br></span>
                                                                                 <span style='margin-left:80px; font-weight:bold; font-size:11px'>$comment_data</span>
                                                                                 <br>
                                                                          
                                                                          ";
                                            }

                                            if ($session_id == $comment_user_id) {
                                                echo "

                                                                                    <img src='images/$comment_image' class='img-thumbnail  $comment_id' style='width:50px; height:50px; border-radius:100%;'>
                                                                                     <span  class='$comment_id'>$comment_user_fname $comment_user_lname <br></span>
                                                                                     <span style='margin-left:80px; font-weight:bold; font-size:11px' class='$comment_id edit$comment_id'>$comment_data </span>
                                                                                     <span id='editShow$comment_id' style='font-weight:bold; font-size:12px; margin-left:80px; color:blue;'></span>

                                                                                    <span style='margin-left:90px;  font-weight:bold; color:red; font-size:25px'>
                                                                                         <a href='$comment_id' class='$comment_id edit$comment_id'  data-toggle='modal' data-target='#specificComment$comment_id'  style='text-decoration:none'>....</a>
                                                                                    </span>
                                                                                    <br>

                                                                                 
                                                                                ";

                                                //specific Comment Modal

                                                echo "

                                                                                     <div class='modal' id='specificComment$comment_id'>
                                                                                        <div class='modal-dialog modal-dialog-centered'>
                                                                                            <div class='modal-content'>
                                                                                                 <div class='modal-body'>
                                                                                                     ";

                                                $get_comment_data_editOrDelete = "SELECT * FROM comment WHERE id=$comment_id";
                                                $run_comment_data_editOrDelete = DB::select($get_comment_data_editOrDelete);
                                                $data_comment_editOrDelete = $run_comment_data_editOrDelete;

                                                foreach ($data_comment_editOrDelete as $item_comment_editOrDelete) {
                                                    $comment_user_fname_editOrDelete = $item_comment_editOrDelete->user_fname;
                                                    $comment_user_lname_editOrDelete = $item_comment_editOrDelete->user_lname;
                                                    $comment_user_data_editOrDelete = $item_comment_editOrDelete->comment_data;

                                                    $comment_user_id_editOrDelete = $item_comment_editOrDelete->user_id;

                                                    //Bring Image
                                                    $get_comment_image_editOrDelete = "SELECT * FROM signup WHERE id = $comment_user_id_editOrDelete";
                                                    $run_comment_image_editOrDelete = DB::select($get_comment_image_editOrDelete);
                                                    $data_comment_image_editOrDelete = $run_comment_image_editOrDelete;

                                                    foreach ($data_comment_image_editOrDelete as $item_comment_image_editOrDelete) {
                                                        $comment_image_editOrDelete = $item_comment_image_editOrDelete->image;
                                                    }




                                                    echo "
                                                                                                             <span><img src='images/$comment_image_editOrDelete' style='width:50px; height:50px; border-radius:100%'></span>
                                                                                                             <span style='font-weight:bold; font-size:10px'>$comment_user_fname_editOrDelete $comment_user_lname_editOrDelete</span>
                                                                                                             <br>
                                                                                                             <span style='color:blue; margin-left:90px'>$comment_user_data_editOrDelete</span>
                                                                                                             <br>
                                                                                                             <hr>
                                                                                                             <span>
                                                                                                                   <form method='post' class='commentDelete'>
                                                                                                                     ";

                                                    echo csrf_field();

                                                    echo "
                                                                                                                       <input type='hidden' name='comment_id' value='$comment_id'>
                                                                                                                       <input type='submit' class='btn btn-danger' value='Delete'>
                                                                                                                   </form>
                                                                                        
                                                                                                                  <a href='#' style='margin-left:100px; margin-top:-52px;'  data-toggle='modal' data-target='#commentEdit$comment_id' class='btn btn-warning'>Update</a>
                                                                                                             
                                                                                                             </span>

                                                                                                             ";

                                                    //comment Edit modal start
                                                    echo "
                                                                                                                       <div class='modal' id='commentEdit$comment_id'>
                                                                                                                           <div class='modal-dialog'>
                                                                                                                                <div class='modal-content'>
                                                                                                                                    <div class='modal-body'>
                                                                                                                                        ";

                                                    $get_update_comment_data = "SELECT * FROM comment WHERE id=$comment_id";
                                                    $run_update_comment_data = DB::select($get_update_comment_data);
                                                    $data_update_comment = $run_update_comment_data;

                                                    foreach ($data_update_comment as $item_update_comment) {
                                                        $comment_update_fname = $item_update_comment->user_fname;
                                                        $comment_update_lname = $item_update_comment->user_lname;
                                                        $comment_update_data = $item_update_comment->comment_data;
                                                        $comment_update_user_id = $item_update_comment->user_id;

                                                        //bring image
                                                        $get_comment_update_image = "SELECT * FROM signup WHERE id =$comment_update_user_id ";
                                                        $run_comment_update_image = DB::select($get_comment_update_image);
                                                        $data_comment_update = $run_comment_update_image;

                                                        foreach ($data_comment_update as $item_comment_update) {
                                                            $comment_update_image = $item_comment_update->image;

                                                            echo "

                                                                                                                                                     <form method='post' class='commentEdit'> 
                                                                                                                                                          ";

                                                            echo csrf_field();

                                                            echo "
                                                                                                                                                          <div class='input-group input-group-lg'>
                                                                                                                                                              <div class='input-group-prepend'>
                                                                                                                                                                   <span><img src='images/$comment_update_image' class='img-thumbnail' style='width:49px; height:49px;'></span>
                                                                                                                                                              </div>
                                                                                                                                                              <input type='hidden' name='comment-id' value='$comment_id'>
                                                                                                                                                              <input type='hidden' name='user-id' value='$comment_update_user_id'>
                                                                                                                                                              <input type='text' class='form-control' name='comment-data' value='$comment_update_data'>
                                                                                                                                                              <input type='submit' value='send' class='btn btn-primary'>
                                                                                                                                                          </div>
                                                                                                                                                     </form>
                                                                                                                                                
                                                                                                                                                ";
                                                        }
                                                    }

                                                    echo "
                                                                                                                                    </div>
                                                                                                                                    
                                                                                                                                </div>
                                                                                                                           </div>
                                                                                                                       </div>
                                                                                                                  
                                                                                                                  ";
                                                    //End comment Edit Modal

                                                    echo "
                                                                                                             
                                                                                                         ";
                                                }


                                                echo "
                                                                                                       
                                                                                                 </div>
                                                                                                
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                     </div>
                                                                                 
                                                                                 
                                                                                 ";

                                                //End specific Comment Modal

                                                echo "
                                                                          
                                                                          ";
                                            } else {
                                                echo "<br>";
                                            }



                                            echo "
                                                                     
                                                                 </span>
                                                            
                                                            
                                                              ";
                                        }
                                    }

                                    echo "
                                             </div>
                                             <div class='modal-footer'>
                                                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                             
                             
                             ";

                                    //End comment show modal

                                    //Ajax comment show
                                    echo "
                                     <span id='$post_id'></span>
                         
                                 ";



                                    break;
                                }

                                //Like part start

                                echo "

                             
                                <hr>
                                <span>
                                    <form class='frmrecord' method='post'>
                                    ";
                                echo csrf_field();

                                echo "
                                       <input type='hidden' name='post_id' id='post_id$post_id' value='$post_id'>
                                       <button type='submit' class='btn btn-primary'><i style='color:White' class='fa fa-thumbs-up'></i></button>

                                        <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#commentModal$post_id' style='text-decoration:none; margin-left:100px'>
                                            <i style='color:white' class='fa fa-comment'></i>
                                        </a>
                                    </form>

                                    
                                       
                                    
                                </span>
        
                                <span>
                                 ";


                                //Like data fetch
                                $get_like_data = "SELECT * FROM likedata WHERE post_id = $post_id ";
                                $run_like_data = DB::select($get_like_data);
                                $data_like = $run_like_data;

                                $count = count($run_like_data);



                                if ($count > 0) {
                                    echo "
                                        <a href='#' id='show$post_id' data-toggle='modal' data-target='#likeData$post_id' style='text-decoration:none; font-weight:bold; font-size:10px'>$count people's like</a>

                                        
                                        ";
                                }


                                //Like Data Modal

                                echo "
                                <div class='modal' id='likeData$post_id'>
                                     <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <span style='font-weight:bold; font-size:10px'>List of people's like</span>
                                            </div>
                                        <div class='modal-body'>
                                       ";

                                $get_modal_like_data = "SELECT * FROM likedata WHERE post_id=$post_id ";
                                $run_modal_like_data = DB::select($get_modal_like_data);
                                $data_modal_like = $run_modal_like_data;

                                foreach ($data_modal_like as $item_modal_like) {
                                    $user_fname = $item_modal_like->user_fname;
                                    $user_lname = $item_modal_like->user_lname;
                                    $user_id = $item_modal_like->user_id;

                                    //Bring like list image

                                    $get_like_collect_image = "SELECT * FROM signup WHERE id=$user_id";
                                    $run_like_collect_image = DB::select($get_like_collect_image);
                                    $data_like_collect_image = $run_like_collect_image;

                                    foreach ($data_like_collect_image as $item_like_collect_image) {
                                        $like_collect_image = $item_like_collect_image->image;

                                        echo "

                                                        <a href='userprofile/$user_id' style='text-decoration:none'>

                                                            <span><img src='images/$like_collect_image' style='width:40px; height:40px; border-radius:100%'></span>
                                                            <span style='font-size:10px; font-weight:bold'>$user_fname $user_lname <br></span>
                                                            <br>
                                               
                                                        </a>
                                               
                                                         ";
                                    }
                                }

                                echo "
                                             </div>
                                             <div class='modal-footer'>
                                                 <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                             </div>
                                        </div>
                                     </div>
                                </div>
                        
                        
                                 ";

                                //End Like Data Modal



                                echo "

                                 <span id='$post_id'></span>
                                 
                                 ";

                                echo "

                                  <br>
                                  <br>

                                  </div>
                                  
                                  ";

                                //Comment data post Modal


                                echo "

                                    <div  class='modal' id='commentModal$post_id'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    Comment Your Post
                                                </div>
                                                <div class='modal-body'>
                                                 ";

                                $session_email = session()->get('email');
                                $get_session_data_for_comment = "SELECT * FROM signup WHERE email ='$session_email' ";
                                $run_session_data_for_comment = DB::select($get_session_data_for_comment);
                                $data_session_comment = $run_session_data_for_comment;

                                foreach ($data_session_comment as $item_session_comment) {
                                    $comment_image = $item_session_comment->image;
                                    $comment_user_id = $item_session_comment->id;
                                    $comment_user_fname = $item_session_comment->fname;
                                    $comment_user_lname = $item_session_comment->lname;

                                    echo "
      
                                                     <span>
                                                      
                                                     </span>
                                                     <form method='post' class='commentAjax'>
                                                     ";

                                    echo csrf_field();


                                    echo "
                                                        <div class='input-group mb-3 input-group-lg'>
                                                            <div class='input-group-prepend'>
                                                               <span class='input-group-text'><img src='images/$comment_image'  style='width:30px; height:30px'></span>
                                                            </div>
                                                             <input type='text' name='comment' class='form-control' placeholder='Enter Your Comment'>
                                                             <input type='hidden' name='post_id' value='$post_id'>
                                                             <input type='hidden' name='comment_user_id' value='$comment_user_id'>
                                                             <input type='hidden' name='comment_user_fname' value='$comment_user_fname'>
                                                             <input type='hidden' name='comment_user_lname' value='$comment_user_lname'>
                                                             <input type='submit' class='btn btn-primary' value='send'>
                                                        </div>
                                                    
                                                    </form>
                                                 
                                                     ";
                                }

                                echo "
                                                 </div>
                                                 <div class='modal-footer'>
                                                    <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                  
                                  
                                     ";

                                //End Comment data post modal


                            }
                        }
                    }

                    ?>

                    <!---opposite friend post--->

                    <?php
                    $session_email = session()->get('email');
                    $get_data = "SELECT * FROM signup WHERE email= '$session_email' ";
                    $run_data = DB::select($get_data);
                    $data = $run_data;

                    foreach ($data as $item) {
                        $session_id = $item->id;

                        $get_friend = "SELECT * FROM userlist WHERE f_id =$session_id AND status='friend' ORDER BY id DESC ";
                        $run_friend = DB::select($get_friend);
                        $data_friend = $run_friend;

                        foreach ($data_friend as $item_friend) {
                            $user_email = $item_friend->user_email;

                            $target_post = "SELECT * FROM userpost WHERE user_email= '$user_email' AND choose!='Public' ";
                            $run_post = DB::select($target_post);
                            $data_post = $run_post;

                            foreach ($data_post as $item_post) {
                                $post_message = $item_post->message;
                                $post_image = $item_post->image;
                                $user_image = $item_post->user_image;
                                $time = $item_post->time;
                                $user_id = $item_post->user_id;
                                $post_id = $item_post->id;
                                $user_fname = $item_post->user_fname;
                                $user_lname = $item_post->user_lname;
                                $choose = $item_post->choose;
                                $current_time = time();



                                echo "

                                <div class='col-md-12 col-sm-12 col-xs-12'>

                                <a href='userprofile/$user_id' style='text-decoration:none'>
                                    <img src='images/$user_image' width=50px height=50px style='' class='img-thumbnail'>
                                </a>
                                <span style='font-weight:bold; font-size:10px'>
                                    $user_fname $user_lname
                                </span>
                                <span style='margin-left:150px; font-weight:bold; font-size:10px'>
                                
                                
                            
                            
                                 ";

                                //time function

                                date_default_timezone_set('Asia/Dhaka');
                                $database_time = strtotime($time);
                                $difference_time = $current_time - $database_time;

                                $minute = floor($difference_time / 60);

                                if ($minute == 0) {
                                    echo "just few second's ago";
                                } elseif ($minute > 0 && $minute <= 60) {
                                    echo "$minute minute's ago";
                                } elseif ($minute >= 61 && $minute <= 1440) {
                                    $hour = floor($minute / 60);
                                    echo "$hour hour's ago";
                                } elseif ($minute >= 1441 && $minute <= 10080) {
                                    $day = floor($minute / 1440);
                                    echo "$day day's ago";
                                } elseif ($minute >= 10081 && $minute <= 43200) {
                                    $week = floor($minute / 10080);
                                    echo "$week week's ago";
                                } elseif ($minute >= 43201 && $minute <= 518400) {
                                    $month = floor($minute / 43200);
                                    echo "$month month's ago";;
                                } elseif ($minute >= 518401) {
                                    $year = floor($minute / 518400);
                                    echo "$year years ago";
                                }

                                echo "

                                
                                 
                             </span>
                             <br>
                             <span>
                             <br>
                                 <p style='width:400px'>
                                    $post_message
     
                                 </p>
     
                             </span>

                             ";

                                if ($post_image == '') {
                                    echo "";
                                } else {
                                    echo "
                                 <span>
                                   <img src='images/$post_image' class='img-thumbnail'>
                                 </span>
                                 <br>
                                 <br>

                                 
                                 
                                 ";
                                }

                                //Comment data show

                                $get_comment_data = "SELECT * FROM comment WHERE post_id=$post_id  ORDER BY id DESC";
                                $run_comment_data = DB::select($get_comment_data);
                                $data_comment = $run_comment_data;

                                $count = count($run_comment_data);
                                $update_count = $count - 1;

                                foreach ($data_comment as $item_comment) {
                                    $comment_user_id = $item_comment->user_id;
                                    $comment_user_fname = $item_comment->user_fname;
                                    $comment_user_lname = $item_comment->user_lname;
                                    $comment_data = $item_comment->comment_data;

                                    //Comment user Image Catch

                                    $get_comment_image = "SELECT * FROM signup WHERE id =$comment_user_id ";
                                    $run_comment_image = DB::select($get_comment_image);
                                    $data_comment_image = $run_comment_image;

                                    foreach ($data_comment_image as $item_comment_image) {
                                        $comment_image = $item_comment_image->image;

                                        echo "

                                        <hr>
 
                                      <a href='#'  id='comment$post_id' style='text-decoration:none; color:black'>
                                         <span>
                                             <img src='images/$comment_image' width='20px' height='20px' style='border-radius:100%'>
                                         </span>
                                         <span>
                                             <span style='font-size:10px; font-weight:bold'>$comment_user_fname $comment_user_lname</span>
                                             <span style='margin-left:10px'>$comment_data</span>
                                             <br>
                                             <br>
                                         </span>
                                      </a>
 
                                      
                                      ";
                                    }


                                    if ($count > 1) {

                                        echo "
    
                                             <span style='font-size:10px; font-weight:bold;'>
                                                 <a href='$post_id' id='commentLink$post_id' data-toggle='modal' data-target='#commentshow$post_id' style='text-decoration:none'>Show $update_count more's comment</a>
                                    
                                            </span>
                                    
                                         ";
                                    }

                                    //Comment shows Modal

                                    echo "
                                <div class='modal' id='commentshow$post_id'>
                                     <div class='modal-dialog'>
                                         <div class='modal-content'>

                                             <div class='modal-body'>
                                                   
                                                    ";

                                    //first part

                                    $get_comment_post_data = "SELECT * FROM userpost WHERE id=$post_id";
                                    $run_comment_post_data = DB::select($get_comment_post_data);
                                    $data_comment_post = $run_comment_post_data;

                                    foreach ($data_comment_post as $item_comment_post) {
                                        $comment_post_image = $item_comment_post->image;
                                        $comment_post_message = $item_comment_post->message;

                                        echo "
                                                             <span>$comment_post_message</span>
                                                             <br>
                                                             <br>

                                                             ";

                                        if ($comment_post_image == '') {
                                            echo "
                                                                 
                                                                 ";
                                        } else {

                                            echo "

                                                                 <span><br><img src='images/$comment_post_image' class='img-thumbnail' style='margin-bottom:30px'></span>
                                                                 
                                                                 ";
                                        }
                                    }


                                    //Second part

                                    $get_comment_modal_data = "SELECT * FROM comment WHERE post_id=$post_id";
                                    $run_comment_modal_data = DB::select($get_comment_modal_data);
                                    $data_comment_modal = $run_comment_modal_data;

                                    foreach ($data_comment_modal as $item_comment_modal) {
                                        $comment_user_id = $item_comment_modal->user_id;
                                        $comment_user_fname = $item_comment_modal->user_fname;
                                        $comment_user_lname = $item_comment_modal->user_lname;
                                        $comment_data = $item_comment_modal->comment_data;
                                        $comment_id = $item_comment_modal->id;

                                        //Bring Image

                                        $get_comment_image_data = "SELECT * FROM signup WHERE id=$comment_user_id";
                                        $run_comment_image_data  = DB::select($get_comment_image_data);
                                        $data_comment_image = $run_comment_image_data;

                                        foreach ($data_comment_image as $item_comment_image) {
                                            $comment_image = $item_comment_image->image;

                                            echo "

                                                                 <span>
                                                                      
                                                                      
                                                                      
                                                                      ";

                                            $session_email = session()->get('email');
                                            $get_session_data = "SELECT * FROM signup WHERE email ='$session_email' ";
                                            $run_session_data = DB::select($get_session_data);
                                            $data_session = $run_session_data;

                                            foreach ($data_session as $item_session) {
                                                $session_id = $item_session->id;
                                            }

                                            if ($session_id != $comment_user_id) {
                                                echo "

                                                                                <img src='images/$comment_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%;'>
                                                                                <span>$comment_user_fname $comment_user_lname <br></span>
                                                                                <span style='margin-left:80px; font-weight:bold; font-size:11px'>$comment_data</span>
                                                                                <br>
                                                                          ";
                                            }

                                            if ($session_id == $comment_user_id) {
                                                echo "

                                                                               <img src='images/$comment_image' class='img-thumbnail  $comment_id' style='width:50px; height:50px; border-radius:100%;'>
                                                                               <span  class='$comment_id'>$comment_user_fname $comment_user_lname <br></span>
                                                                               <span style='margin-left:80px; font-weight:bold; font-size:11px' class='$comment_id edit$comment_id'>$comment_data </span>
                                                                               <span id='editShow$comment_id' style='font-weight:bold; font-size:12px; margin-left:80px; color:blue;'></span>

                                                                                <span style='margin-left:90px;  font-weight:bold; color:red; font-size:25px'>
                                                                                  <a href='$comment_id' class='$comment_id edit$comment_id'  data-toggle='modal' data-target='#specificComment$comment_id'  style='text-decoration:none'>....</a>
                                                                                </span>
                                                                                <br>

                                                                                 ";

                                                //specific Comment Modal

                                                echo "

                                                                                     <div class='modal' id='specificComment$comment_id'>
                                                                                        <div class='modal-dialog modal-dialog-centered'>
                                                                                            <div class='modal-content'>
                                                                                                 <div class='modal-body'>
                                                                                                     ";

                                                $get_comment_data_editOrDelete = "SELECT * FROM comment WHERE id=$comment_id";
                                                $run_comment_data_editOrDelete = DB::select($get_comment_data_editOrDelete);
                                                $data_comment_editOrDelete = $run_comment_data_editOrDelete;

                                                foreach ($data_comment_editOrDelete as $item_comment_editOrDelete) {
                                                    $comment_user_fname_editOrDelete = $item_comment_editOrDelete->user_fname;
                                                    $comment_user_lname_editOrDelete = $item_comment_editOrDelete->user_lname;
                                                    $comment_user_data_editOrDelete = $item_comment_editOrDelete->comment_data;

                                                    $comment_user_id_editOrDelete = $item_comment_editOrDelete->user_id;

                                                    //Bring Image
                                                    $get_comment_image_editOrDelete = "SELECT * FROM signup WHERE id = $comment_user_id_editOrDelete";
                                                    $run_comment_image_editOrDelete = DB::select($get_comment_image_editOrDelete);
                                                    $data_comment_image_editOrDelete = $run_comment_image_editOrDelete;

                                                    foreach ($data_comment_image_editOrDelete as $item_comment_image_editOrDelete) {
                                                        $comment_image_editOrDelete = $item_comment_image_editOrDelete->image;
                                                    }




                                                    echo "
                                                                                                             <span><img src='images/$comment_image_editOrDelete' style='width:50px; height:50px; border-radius:100%'></span>
                                                                                                             <span style='font-weight:bold; font-size:10px'>$comment_user_fname_editOrDelete $comment_user_lname_editOrDelete</span>
                                                                                                             <br>
                                                                                                             <span style='color:blue; margin-left:90px'>$comment_user_data_editOrDelete</span>
                                                                                                             <br>
                                                                                                             <hr>
                                                                                                             <span>
                                                                                                                    <form method='post' class='commentDelete'>
                                                                                                                          ";

                                                    echo csrf_field();

                                                    echo "
                                                                                                                         <input type='hidden' name='comment_id' value='$comment_id'>
                                                                                                                         <input type='submit' class='btn btn-danger' value='Delete'>
                                                                                                                    </form>
                                                                                                                  
                                                                                                                  <a href='#' style='margin-left:100px; margin-top:-52px'  data-toggle='modal' data-target='#commentEdit$comment_id' class='btn btn-warning '>Update</a>
                                                                                                             
                                                                                                             </span>

                                                                                                             ";

                                                    //comment Edit modal start
                                                    echo "
                                                                                                                       <div class='modal' id='commentEdit$comment_id'>
                                                                                                                           <div class='modal-dialog'>
                                                                                                                                <div class='modal-content'>
                                                                                                                                    <div class='modal-body'>
                                                                                                                                        ";

                                                    $get_update_comment_data = "SELECT * FROM comment WHERE id=$comment_id";
                                                    $run_update_comment_data = DB::select($get_update_comment_data);
                                                    $data_update_comment = $run_update_comment_data;

                                                    foreach ($data_update_comment as $item_update_comment) {
                                                        $comment_update_fname = $item_update_comment->user_fname;
                                                        $comment_update_lname = $item_update_comment->user_lname;
                                                        $comment_update_data = $item_update_comment->comment_data;
                                                        $comment_update_user_id = $item_update_comment->user_id;

                                                        //bring image
                                                        $get_comment_update_image = "SELECT * FROM signup WHERE id =$comment_update_user_id ";
                                                        $run_comment_update_image = DB::select($get_comment_update_image);
                                                        $data_comment_update = $run_comment_update_image;

                                                        foreach ($data_comment_update as $item_comment_update) {
                                                            $comment_update_image = $item_comment_update->image;

                                                            echo "

                                                                                                                                                     <form method='post' class='commentEdit'> 
                                                                                                                                                          ";

                                                            echo csrf_field();

                                                            echo "
                                                                                                                                                          <div class='input-group input-group-lg'>
                                                                                                                                                              <div class='input-group-prepend'>
                                                                                                                                                                   <span><img src='images/$comment_update_image' class='img-thumbnail' style='width:49px; height:49px;'></span>
                                                                                                                                                              </div>
                                                                                                                                                              <input type='hidden' name='comment-id' value='$comment_id'>
                                                                                                                                                              <input type='hidden' name='user-id' value='$comment_update_user_id'>
                                                                                                                                                              <input type='text' class='form-control' name='comment-data' value='$comment_update_data'>
                                                                                                                                                              <input type='submit' value='send' class='btn btn-primary'>
                                                                                                                                                          </div>
                                                                                                                                                     </form>
                                                                                                                                                
                                                                                                                                                ";
                                                        }
                                                    }

                                                    echo "
                                                                                                                                    </div>
                                                                                                                                    
                                                                                                                                </div>
                                                                                                                           </div>
                                                                                                                       </div>
                                                                                                                  
                                                                                                                  ";
                                                    //End comment Edit Modal

                                                    echo "
                                                                                                             
                                                                                                         ";
                                                }


                                                echo "
                                                                                                       
                                                                                                 </div>
                                                                                                
                                                                                                
                                                                                            </div>
                                                                                        </div>
                                                                                     </div>
                                                                                 
                                                                                 
                                                                                 ";

                                                //End specific Comment Modal

                                                echo "
                                                                          
                                                                          ";
                                            } else {
                                                echo "<br>";
                                            }



                                            echo "
                                                                     
                                                                 </span>
                                                            
                                                            
                                                              ";
                                        }
                                    }

                                    echo "
                                             </div>
                                             <div class='modal-footer'>
                                                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                             </div>
                                         </div>
                                     </div>
                                </div>
                             
                             
                                   ";

                                    //End comment show modal

                                    //Ajax comment show
                                    echo "
                                                <span id='$post_id'></span>
                    
                                         ";

                                    break;
                                }


                                //Like code start

                                echo "

                             
                                <hr>
                                <span>
                                    <form class='frmrecord' method='post'>
                                    ";
                                echo csrf_field();

                                echo "
                                       <input type='hidden' name='post_id' id='post_id$post_id' value='$post_id'>
                                       <button type='submit' class='btn btn-primary'><i style='color:White' class='fa fa-thumbs-up'></i></button>

                                        <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#commentModal$post_id' style='text-decoration:none; margin-left:100px'>
                                            <i style='color:white' class='fa fa-comment'></i>
                                        </a>
                                    </form>
                                       
                                    
                                </span>
        
                                <span>

                                
                                 ";


                                //Like data fetch
                                $get_like_data = "SELECT * FROM likedata WHERE post_id = $post_id ";
                                $run_like_data = DB::select($get_like_data);
                                $count = count($run_like_data);
                                $data_like = $run_like_data;

                                if ($count > 0) {
                                    echo "<a href='#' id='show$post_id' data-toggle='modal' data-target='#likeData$post_id' style='text-decoration:none; font-weight:bold; font-size:10px'>$count people's like</a>";
                                }

                                //Like Data Modal

                                echo "
                                <div class='modal' id='likeData$post_id'>
                                     <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <span style='font-weight:bold; font-size:10px'>List of people's like</span>
                                            </div>
                                        <div class='modal-body'>
                                       ";

                                $get_modal_like_data = "SELECT * FROM likedata WHERE post_id=$post_id ";
                                $run_modal_like_data = DB::select($get_modal_like_data);
                                $data_modal_like = $run_modal_like_data;

                                foreach ($data_modal_like as $item_modal_like) {
                                    $user_fname = $item_modal_like->user_fname;
                                    $user_lname = $item_modal_like->user_lname;
                                    $user_id = $item_modal_like->user_id;

                                    //Bring like list image

                                    $get_like_collect_image = "SELECT * FROM signup WHERE id=$user_id";
                                    $run_like_collect_image = DB::select($get_like_collect_image);
                                    $data_like_collect_image = $run_like_collect_image;

                                    foreach ($data_like_collect_image as $item_like_collect_image) {
                                        $like_collect_image = $item_like_collect_image->image;

                                        echo "

                                                        <a href='userprofile/$user_id' style='text-decoration:none'>

                                                            <span><img src='images/$like_collect_image' style='width:40px; height:40px; border-radius:100%'></span>
                                                            <span style='font-size:10px; font-weight:bold'>$user_fname $user_lname <br></span>
                                                            <br>
                                               
                                                        </a>
                                               
                                                         ";
                                    }
                                }

                                echo "
                                             </div>
                                             <div class='modal-footer'>
                                                 <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                             </div>
                                        </div>
                                     </div>
                                </div>
                        
                        
                                 ";

                                //End Like Data Modal

                                echo "

                                 <span id='$post_id'></span>
                                 
                                 ";








                                echo "

                             
                             

                             
                             <br>
                             <br>

                             </div>
     
                             ";

                                //comment post modal

                                echo "

                             <div  class='modal' id='commentModal$post_id'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            Comment Your Post
                                        </div>
                                        <div class='modal-body'>
                                         ";

                                $session_email = session()->get('email');
                                $get_session_data_for_comment = "SELECT * FROM signup WHERE email ='$session_email' ";
                                $run_session_data_for_comment = DB::select($get_session_data_for_comment);
                                $data_session_comment = $run_session_data_for_comment;

                                foreach ($data_session_comment as $item_session_comment) {
                                    $comment_image = $item_session_comment->image;
                                    $comment_user_id = $item_session_comment->id;
                                    $comment_user_fname = $item_session_comment->fname;
                                    $comment_user_lname = $item_session_comment->lname;

                                    echo "

                                             <span>
                                              
                                             </span>
                                             <form method='post' class='commentAjax' >
                                             ";

                                    echo csrf_field();


                                    echo "
                                                <div class='input-group mb-3 input-group-lg'>
                                                    <div class='input-group-prepend'>
                                                       <span class='input-group-text'><img src='images/$comment_image'  style='width:30px; height:30px'></span>
                                                    </div>
                                                     <input type='text' name='comment' class='form-control' placeholder='Enter Your Comment'>
                                                     <input type='hidden' name='post_id' value='$post_id'>
                                                     <input type='hidden' name='comment_user_id' value='$comment_user_id'>
                                                     <input type='hidden' name='comment_user_fname' value='$comment_user_fname'>
                                                     <input type='hidden' name='comment_user_lname' value='$comment_user_lname'>
                                                     <input type='submit' class='btn btn-primary' value='send'>
                                                </div>
                                            
                                            </form>
                                         
                                             ";
                                }

                                echo "
                                         </div>
                                         <div class='modal-footer'>
                                            <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                 </div>
                             </div>

                               ";

                                //End comment post modal


                            }
                        }
                    }

                    ?>

                    <!----When post is public--->

                    <?php

                    $get_data_public_post = "SELECT * FROM userpost WHERE choose='public' ORDER BY id DESC ";
                    $run_data_public_post = DB::select($get_data_public_post);
                    $data_public = $run_data_public_post;

                    foreach ($data_public as $item_public_post) {
                        $post_message = $item_public_post->message;
                        $post_image = $item_public_post->image;
                        $user_image = $item_public_post->user_image;
                        $time = $item_public_post->time;
                        $user_id = $item_public_post->user_id;
                        $post_id = $item_public_post->id;
                        $user_fname = $item_public_post->user_fname;
                        $user_lname = $item_public_post->user_lname;
                        $current_time = time();

                        echo "

                        <div class='col-md-12 col-xs-12 col-sm-12' style='text-decoration:none'>

                            <a href='userprofile/$user_id' style='text-decoration:none'>
                                <img src='images/$user_image' width=50px height=50px style='' class='img-thumbnail'>
                            </a>

                            <span style='font-weight:bold; font-size:10px'>
                                $user_fname $user_lname
                                <span style='color:blue; margin-left:20px'>
                                     public
                                </span>
                            </span>

                           <span style='margin-left:150px; font-weight:bold; font-size:10px'>
                        
                        

                   
                    ";

                        //time function

                        date_default_timezone_set('Asia/Dhaka');
                        $database_time = strtotime($time);
                        $difference_time = $current_time - $database_time;

                        $minute = floor($difference_time / 60);

                        if ($minute == 0) {
                            echo "just few second's ago";
                        } elseif ($minute > 0 && $minute <= 60) {
                            echo "$minute minute's ago";
                        } elseif ($minute >= 61 && $minute <= 1440) {
                            $hour = floor($minute / 60);
                            echo "$hour hour's ago";
                        } elseif ($minute >= 1441 && $minute <= 10080) {
                            $day = floor($minute / 1440);
                            echo "$day day's ago";
                        } elseif ($minute >= 10081 && $minute <= 43200) {
                            $week = floor($minute / 10080);
                            echo "$week week's ago";
                        } elseif ($minute >= 43201 && $minute <= 518400) {
                            $month = floor($minute / 43200);
                            echo "$month month's ago";;
                        } elseif ($minute >= 518401) {
                            $year = floor($minute / 518400);
                            echo "$year years ago";
                        }


                        echo "

                        
                    </span>
                    <br>

                    <span>
                    <br>
                        <p style='width:400px'>
                            $post_message
     
                        </p>
     
                    </span>
                    
                    ";

                        if ($post_image == '') {
                            echo " ";
                        } else {
                            echo "
                        <span>
                          <img src='images/$post_image' class='img-thumbnail'>
                        </span>
                        <br>
                        <br>

                        
                        
                        ";
                        }

                        //Comment data show

                        $get_comment_data = "SELECT * FROM comment WHERE post_id=$post_id ";
                        $run_comment_data = DB::select($get_comment_data);
                        $data_comment = $run_comment_data;

                        $count = count($run_comment_data);
                        $update_count = $count - 1;

                        foreach ($data_comment as $item_comment) {
                            $comment_user_id = $item_comment->user_id;
                            $comment_user_fname = $item_comment->user_fname;
                            $comment_user_lname = $item_comment->user_lname;
                            $comment_data = $item_comment->comment_data;

                            //Comment user Image Catch

                            $get_comment_image = "SELECT * FROM signup WHERE id =$comment_user_id ";
                            $run_comment_image = DB::select($get_comment_image);
                            $data_comment_image = $run_comment_image;

                            foreach ($data_comment_image as $item_comment_image) {
                                $comment_image = $item_comment_image->image;

                                echo "

                                <hr>

                             <a href='#' id='comment$post_id' style='text-decoration:none; color:black'>
                             
                                <span>
                                    <img src='images/$comment_image' width='20px' height='20px' style='border-radius:100%'>
                                </span>
                                <span>
                                    <span style='font-size:10px; font-weight:bold'>$comment_user_fname $comment_user_lname</span>
                                    <span style='margin-left:10px'>$comment_data</span>
                                    <br>
                                    <br>
                                </span>
                             </a>

                             
                             ";
                            }

                            if ($count > 1) {

                                echo "

                                     <span style='font-size:10px; font-weight:bold;'>
                                         <a href='$post_id' id='commentLink$post_id' data-toggle='modal' data-target='#commentshow$post_id' style='text-decoration:none'>Show $update_count more's comment</a>
                            
                                    </span>
                            
                                 ";
                            }

                            //Comment shows Modal

                            echo "
                             <div class='modal' id='commentshow$post_id'>
                                  <div class='modal-dialog'>
                                      <div class='modal-content'>

                                          <div class='modal-body'>
                                                
                                                 ";

                            //first part

                            $get_comment_post_data = "SELECT * FROM userpost WHERE id=$post_id";
                            $run_comment_post_data = DB::select($get_comment_post_data);
                            $data_comment_post = $run_comment_post_data;

                            foreach ($data_comment_post as $item_comment_post) {
                                $comment_post_image = $item_comment_post->image;
                                $comment_post_message = $item_comment_post->message;

                                echo "
                                                          <span>$comment_post_message</span>
                                                          <br>
                                                          

                                                          ";

                                if ($comment_post_image == '') {
                                    echo "
                                                              
                                                              ";
                                } else {

                                    echo "

                                                              <span><img src='images/$comment_post_image' class='img-thumbnail' style='margin-bottom:30px'></span>
                                                              
                                                              ";
                                }
                            }


                            //Second part

                            $get_comment_modal_data = "SELECT * FROM comment WHERE post_id=$post_id ";
                            $run_comment_modal_data = DB::select($get_comment_modal_data);
                            $data_comment_modal = $run_comment_modal_data;

                            foreach ($data_comment_modal as $item_comment_modal) {
                                $comment_user_id = $item_comment_modal->user_id;
                                $comment_user_fname = $item_comment_modal->user_fname;
                                $comment_user_lname = $item_comment_modal->user_lname;
                                $comment_data = $item_comment_modal->comment_data;
                                $comment_id = $item_comment_modal->id;

                                //Bring Image

                                $get_comment_image_data = "SELECT * FROM signup WHERE id=$comment_user_id";
                                $run_comment_image_data  = DB::select($get_comment_image_data);
                                $data_comment_image = $run_comment_image_data;

                                foreach ($data_comment_image as $item_comment_image) {
                                    $comment_image = $item_comment_image->image;

                                    echo "

                                                              <span>
                                                                   
                                                                   
                                                                   
                                                                   ";

                                    $session_email = session()->get('email');
                                    $get_session_data = "SELECT * FROM signup WHERE email ='$session_email' ";
                                    $run_session_data = DB::select($get_session_data);
                                    $data_session = $run_session_data;

                                    foreach ($data_session as $item_session) {
                                        $session_id = $item_session->id;
                                    }

                                    if ($session_id != $comment_user_id) {
                                        echo "

                                                                            <img src='images/$comment_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%;'>
                                                                            <span>$comment_user_fname $comment_user_lname <br></span>
                                                                            <span style='margin-left:80px; font-weight:bold; font-size:11px'>$comment_data</span>
                                                                       
                                                                       ";
                                    }

                                    if ($session_id == $comment_user_id) {
                                        echo "
                                                                             <img src='images/$comment_image' class='img-thumbnail  $comment_id' style='width:50px; height:50px; border-radius:100%;'>
                                                                             <span  class='$comment_id'>$comment_user_fname $comment_user_lname <br></span>
                                                                             <span style='margin-left:80px; font-weight:bold; font-size:11px' class='$comment_id edit$comment_id'>$comment_data </span>
                                                                             <span id='editShow$comment_id' style='font-weight:bold; font-size:12px; margin-left:80px; color:blue;'></span>

                                                                             <span style='margin-left:90px;  font-weight:bold; color:red; font-size:25px'>
                                                                                 <a href='$comment_id' class='$comment_id edit$comment_id'  data-toggle='modal' data-target='#specificComment$comment_id'  style='text-decoration:none'>....</a>
                                                                             </span>
                                                                             <br>

                                                                              ";

                                        //specific Comment Modal

                                        echo "

                                                                                  <div class='modal' id='specificComment$comment_id'>
                                                                                     <div class='modal-dialog modal-dialog-centered'>
                                                                                         <div class='modal-content'>
                                                                                              <div class='modal-body'>
                                                                                                  ";

                                        $get_comment_data_editOrDelete = "SELECT * FROM comment WHERE id=$comment_id";
                                        $run_comment_data_editOrDelete = DB::select($get_comment_data_editOrDelete);
                                        $data_comment_editOrDelete = $run_comment_data_editOrDelete;

                                        foreach ($data_comment_editOrDelete as $item_comment_editOrDelete) {
                                            $comment_user_fname_editOrDelete = $item_comment_editOrDelete->user_fname;
                                            $comment_user_lname_editOrDelete = $item_comment_editOrDelete->user_lname;
                                            $comment_user_data_editOrDelete = $item_comment_editOrDelete->comment_data;

                                            $comment_user_id_editOrDelete = $item_comment_editOrDelete->user_id;

                                            //Bring Image
                                            $get_comment_image_editOrDelete = "SELECT * FROM signup WHERE id = $comment_user_id_editOrDelete";
                                            $run_comment_image_editOrDelete = DB::select($get_comment_image_editOrDelete);
                                            $data_comment_image_editOrDelete = $run_comment_image_editOrDelete;

                                            foreach ($data_comment_image_editOrDelete as $item_comment_image_editOrDelete) {
                                                $comment_image_editOrDelete = $item_comment_image_editOrDelete->image;
                                            }




                                            echo "
                                                                                                          <span><img src='images/$comment_image_editOrDelete' style='width:50px; height:50px; border-radius:100%'></span>
                                                                                                          <span style='font-weight:bold; font-size:10px'>$comment_user_fname_editOrDelete $comment_user_lname_editOrDelete</span>
                                                                                                          <br>
                                                                                                          <span style='color:blue; margin-left:90px'>$comment_user_data_editOrDelete</span>
                                                                                                          <br>
                                                                                                          <hr>
                                                                                                          <span>
                                                                                                               <form method='post' class='commentDelete'>
                                                                                                                 ";

                                            echo csrf_field();

                                            echo "
                                                                                                                    <input type='hidden' name='comment_id' value='$comment_id'>
                                                                                                                    <input type='submit' class='btn btn-danger' value='Delete'>
                                                                                                               </form>
                                                                                                               
                                                                                                               <a href='#' style='margin-left:100px; margin-top:-52px'  data-toggle='modal' data-target='#commentEdit$comment_id' class='btn btn-warning btn-sm'>Update</a>
                                                                                                          
                                                                                                          </span>

                                                                                                          ";

                                            //comment Edit modal start
                                            echo "
                                                                                                                    <div class='modal' id='commentEdit$comment_id'>
                                                                                                                        <div class='modal-dialog'>
                                                                                                                             <div class='modal-content'>
                                                                                                                                 <div class='modal-body'>
                                                                                                                                     ";

                                            $get_update_comment_data = "SELECT * FROM comment WHERE id=$comment_id";
                                            $run_update_comment_data = DB::select($get_update_comment_data);
                                            $data_update_comment = $run_update_comment_data;

                                            foreach ($data_update_comment as $item_update_comment) {
                                                $comment_update_fname = $item_update_comment->user_fname;
                                                $comment_update_lname = $item_update_comment->user_lname;
                                                $comment_update_data = $item_update_comment->comment_data;
                                                $comment_update_user_id = $item_update_comment->user_id;

                                                //bring image
                                                $get_comment_update_image = "SELECT * FROM signup WHERE id =$comment_update_user_id ";
                                                $run_comment_update_image = DB::select($get_comment_update_image);
                                                $data_comment_update = $run_comment_update_image;

                                                foreach ($data_comment_update as $item_comment_update) {
                                                    $comment_update_image = $item_comment_update->image;

                                                    echo "

                                                                                                                                                  <form method='post' class='commentEdit'> 
                                                                                                                                                       ";

                                                    echo csrf_field();

                                                    echo "
                                                                                                                                                       <div class='input-group input-group-lg'>
                                                                                                                                                           <div class='input-group-prepend'>
                                                                                                                                                                <span><img src='images/$comment_update_image' class='img-thumbnail' style='width:49px; height:49px;'></span>
                                                                                                                                                           </div>
                                                                                                                                                           <input type='hidden' name='comment-id' value='$comment_id'>
                                                                                                                                                           <input type='hidden' name='user-id' value='$comment_update_user_id'>
                                                                                                                                                           <input type='text' class='form-control' name='comment-data' value='$comment_update_data'>
                                                                                                                                                           <input type='submit' value='send' class='btn btn-primary'>
                                                                                                                                                       </div>
                                                                                                                                                  </form>
                                                                                                                                             
                                                                                                                                             ";
                                                }
                                            }

                                            echo "
                                                                                                                                 </div>
                                                                                                                                 
                                                                                                                             </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                               
                                                                                                               ";
                                            //End comment Edit Modal

                                            echo "
                                                                                                          
                                                                                                      ";
                                        }


                                        echo "
                                                                                                    
                                                                                              </div>
                                                                                             
                                                                                             
                                                                                         </div>
                                                                                     </div>
                                                                                  </div>
                                                                              
                                                                              
                                                                              ";

                                        //End specific Comment Modal

                                        echo "
                                                                       
                                                                       ";
                                    } else {
                                        echo "<br>";
                                    }



                                    echo "
                                                                  
                                                              </span>
                                                         
                                                         
                                                           ";
                                }
                            }

                            echo "
                                          </div>
                                          <div class='modal-footer'>
                                               <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                          </div>
                                      </div>
                                  </div>
                             </div>
                          
                          
                               ";

                            //End comment show modal

                            //Ajax comment show
                            echo "
                                   <span id='$post_id'></span>
                          
                               ";

                            break;
                        }

                        //Like code start

                        echo "

                             
                        <hr>
                        <span>
                            <form class='frmrecord' method='post'>
                            ";
                        echo csrf_field();

                        echo "
                               <input type='hidden' name='post_id' id='post_id$post_id' value='$post_id'>
                               <button type='submit' class='btn btn-primary'><i style='color:White' class='fa fa-thumbs-up'></i></button>

                                <a href='#' class='btn btn-danger' data-toggle='modal' data-target='#commentModal$post_id' style='text-decoration:none; margin-left:100px'>
                                     <i style='color:white' class='fa fa-comment'></i>
                                </a>
                            </form>
                               
                            
                        </span>

                        <span>
                         ";

                        //Like data fetch
                        $get_like_data = "SELECT * FROM likedata WHERE post_id = $post_id ";
                        $run_like_data = DB::select($get_like_data);
                        $data_like = $run_like_data;

                        $count = count($run_like_data);

                        if ($count > 0) {
                            echo "<a href='#'  id='show$post_id' data-toggle='modal' data-target='#likeData$post_id' style='text-decoration:none; font-weight:bold; font-size:10px'>$count people's like</a>";
                        }


                        //Like Data Modal

                        echo "
                        <div class='modal' id='likeData$post_id'>
                             <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <span style='font-weight:bold; font-size:10px'>List of people's like</span>
                                    </div>
                                <div class='modal-body'>
                               ";

                        $get_modal_like_data = "SELECT * FROM likedata WHERE post_id=$post_id ";
                        $run_modal_like_data = DB::select($get_modal_like_data);
                        $data_modal_like = $run_modal_like_data;

                        foreach ($data_modal_like as $item_modal_like) {
                            $user_fname = $item_modal_like->user_fname;
                            $user_lname = $item_modal_like->user_lname;
                            $user_id = $item_modal_like->user_id;

                            //Bring like list image

                            $get_like_collect_image = "SELECT * FROM signup WHERE id=$user_id";
                            $run_like_collect_image = DB::select($get_like_collect_image);
                            $data_like_collect_image = $run_like_collect_image;

                            foreach ($data_like_collect_image as $item_like_collect_image) {
                                $like_collect_image = $item_like_collect_image->image;

                                echo "

                                                <a href='userprofile/$user_id' style='text-decoration:none'>

                                                    <span><img src='images/$like_collect_image' style='width:40px; height:40px; border-radius:100%'></span>
                                                    <span style='font-size:10px; font-weight:bold'>$user_fname $user_lname <br></span>
                                                    <br>
                                       
                                                </a>
                                       
                                                 ";
                            }
                        }

                        echo "
                                     </div>
                                     <div class='modal-footer'>
                                         <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                     </div>
                                </div>
                             </div>
                        </div>
                
                
                         ";

                        //End Like Data Modal


                        echo "

                         <span id='$post_id'></span>
                         
                         ";




                        echo "

                    

                    

                   
                   
                    <br>
                    <br>

                    </div>
                    
                    ";

                        //Comment post Modal

                        echo "

                            <div  class='modal' id='commentModal$post_id'>
                                <div class='modal-dialog'>
                                     <div class='modal-content'>
                                         <div class='modal-header'>
                                            Comment Your Post
                                         </div>
                                         <div class='modal-body'>
                                           ";

                        $session_email = session()->get('email');
                        $get_session_data_for_comment = "SELECT * FROM signup WHERE email ='$session_email' ";
                        $run_session_data_for_comment = DB::select($get_session_data_for_comment);
                        $data_session_comment = $run_session_data_for_comment;

                        foreach ($data_session_comment as $item_session_comment) {
                            $comment_image = $item_session_comment->image;
                            $comment_user_id = $item_session_comment->id;
                            $comment_user_fname = $item_session_comment->fname;
                            $comment_user_lname = $item_session_comment->lname;

                            echo "

                                                <span>
                                       
                                                </span>
                                                <form method='post' class='commentAjax'>
                                                 ";

                            echo csrf_field();


                            echo "
                                                 <div class='input-group mb-3 input-group-lg'>
                                                     <div class='input-group-prepend'>
                                                         <span class='input-group-text'><img src='images/$comment_image'  style='width:30px; height:30px'></span>
                                                     </div>
                                                      <input type='text' name='comment' class='form-control' placeholder='Enter Your Comment'>
                                                      <input type='hidden' name='post_id' value='$post_id'>
                                                      <input type='hidden' name='comment_user_id' value='$comment_user_id'>
                                                      <input type='hidden' name='comment_user_fname' value='$comment_user_fname'>
                                                      <input type='hidden' name='comment_user_lname' value='$comment_user_lname'>
                                                      <input type='submit' class='btn btn-primary' value='send'>
                                                </div>
                                     
                                                 </form>
                                  
                                               ";
                        }

                        echo "
                                         </div>
                                         <div class='modal-footer'>
                                             <button type='button' class='btn btn-warning' data-dismiss='modal'>Close</button>
                                         </div>
                                     </div>
                                 </div>
                            </div>

                             ";

                        //End comment post modal
                    }

                    ?>

                </div>
                <!---end userpost--->

            </div>

            <div class='col-md-2 col-sm-2 col-xs-2'>
                <div class='col-md-12 col-sm-12 col-xs-12 text-center'>
                    <a href="logout" class='btn btn-primary btn-sm '>LogOut</a>
                </div>
                <p style='margin-top:95px; font-weight:bold; margin-left:30px'>Friends</p>
                <br>
                <?php

                //Friend Find
                $session_email = session()->get('email');
                $get_session_id = "SELECT * FROM signup WHERE email='$session_email' ";
                $run_session_id = DB::select($get_session_id);
                $data = $run_session_id;

                foreach ($data as $item) {
                    $session_id = $item->id;
                    $mode = $item->mode;

                    $get_friend = "SELECT * FROM userlist WHERE user_id=$session_id AND status='friend' ";
                    $run_get_friend = DB::select($get_friend);
                    $data_friend = $run_get_friend;

                    foreach ($data_friend as $item_friend) {
                        $f_f_name = $item_friend->f_f_name;
                        $f_l_name = $item_friend->f_l_name;
                        $f_image = $item_friend->f_image;
                        $f_id = $item_friend->f_id;

                        //friend mode check
                        $target_data = "SELECT * FROM signup WHERE id=$f_id";
                        $run_target_data = DB::select($target_data);
                        $data_target = $run_target_data;

                        foreach ($data_target as $item_target) {
                            $mode = $item_target->mode;

                            if ($mode == 'online') {
                                echo "

                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                    
                                    <a href='$f_id' data-toggle='modal' data-target='#chatModal$f_id' style='text-decoration:none'>

                                        <span style=''>
                                            <span style='font-weight:bold; font-size:40px; color:blue;'>.</span>
                                            <img src='images/$f_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%; margin-bottom:10px'>
                                            <span style='font-size:10px; font-weight:bold'>$f_f_name</span>
                                        </span>
                                    
                                    </a>
                                    <br>

                                     ";

                                //Chat modal start
                                echo "
                                              <div class='modal' id='chatModal$f_id'>
                                                  <div class='modal-dialog'>
                                                      <div class='modal-content'>
                                                          <div class='modal-header'>
                                                              <img src='images/$f_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%'>
                                                              <span style='margin-right:290px; margin-top:20px'>$f_f_name $f_l_name</span>
                                                          </div>
                                                          <div class='modal-body'>
                                                                ";



                                echo "
                                                            
                                                               
                                                                ";

                                //Get Session Data

                                $session_email = session()->get('email');
                                $get_chat_session_image = "SELECT * FROM signup WHERE email='$session_email' ";
                                $run_chat_session_image = DB::select($get_chat_session_image);
                                $data_chat_session_image = $run_chat_session_image;

                                foreach ($data_chat_session_image as $item_chat_session_image) {
                                    $chat_session_image = $item_chat_session_image->image;
                                    $chat_session_id = $item_chat_session_image->id;
                                    $chat_session_fname = $item_chat_session_image->fname;
                                    $chat_session_lname = $item_chat_session_image->lname;

                                    echo "

                                                                            <div class='chat-history'>
                                                                                ";
                                    $get_sender_chat_data = "SELECT * FROM chat WHERE sender_id=$chat_session_id  AND receiver_id=$f_id OR sender_id=$f_id AND receiver_id=$chat_session_id ";
                                    $run_sender_chat_data = DB::select($get_sender_chat_data);
                                    $data_sender_chat = $run_sender_chat_data;

                                    $count = count($run_sender_chat_data);

                                    if ($count == 0) {
                                        echo "<span id='conversion$f_id'>No conversion Yet!!!</span>";
                                    } else {


                                        foreach ($data_sender_chat as $item_sender_chat) {
                                            $sender_fname = $item_sender_chat->sender_fname;
                                            $sender_lname = $item_sender_chat->sender_lname;
                                            $sender_id = $item_sender_chat->sender_id;
                                            $sender_data = $item_sender_chat->sender_data;
                                            $sender_date = $item_sender_chat->date;
                                            $time = $sender_date;

                                            //bring image

                                            $get_sender_chat_image = "SELECT * FROM signup WHERE id=$sender_id";
                                            $run_sender_chat_image = DB::select($get_sender_chat_image);
                                            $data_sender_chat_image = $run_sender_chat_image;

                                            foreach ($data_sender_chat_image as $item_sender_chat_image) {
                                                $sender_chat_image = $item_sender_chat_image->image;

                                                echo "

                                                                                         

                                                                                         <span><img src='images/$sender_chat_image' class='img-thumbnail' style='width:50px;height:50px'></span>
                                                                                         ";

                                                if ($sender_id == $chat_session_id) {
                                                    echo "

                                                                                             <span style='margin-top:10px; margin-bottom:10px; font-size:12px; font-weight:bold' class='text-center'>
                                                                                                $sender_data
                                                                                             </span>
                                                                                             
                                                                                             ";
                                                } else {
                                                    echo "

                                                                                             <span style='margin-top:10px; margin-bottom:10px; font-size:12px; font-weight:bold; color:blue' >
                                                                                                $sender_data
                                                                                             </span>
                                                                                             
                                                                                             ";
                                                }


                                                echo "
                                                                                         
                                                                                         <span style='margin-left:20px'></span>
                                                                                         
                                                                                         ";
                                            }


                                            //time function

                                            date_default_timezone_set('Asia/Dhaka');
                                            $database_time = strtotime($time);
                                            $difference_time = $current_time - $database_time;

                                            $minute = floor($difference_time / 60);

                                            if ($minute == 0) {
                                                echo "<span style='font-weight:bold; font-size:10px'>just few second's ago</span>";
                                            } elseif ($minute > 0 && $minute <= 60) {
                                                echo "<span style='font-weight:bold; font-size:10px'>$minute minute's ago</span>";
                                            } elseif ($minute >= 61 && $minute <= 1440) {
                                                $hour = floor($minute / 60);
                                                echo "<span style='font-weight:bold; font-size:10px'>$hour hour's ago</span>";
                                            } elseif ($minute >= 1441 && $minute <= 10080) {
                                                $day = floor($minute / 1440);
                                                echo "<span style='font-size:10px; font-weight:bold'>$day day's ago</span>";
                                            } elseif ($minute >= 10081 && $minute <= 43200) {
                                                $week = floor($minute / 10080);
                                                echo "<span style='font-weight:bold; font-size:10px'>$week week's ago</span>";
                                            } elseif ($minute >= 43201 && $minute <= 518400) {
                                                $month = floor($minute / 43200);
                                                echo "<span style='font-size:10px; font-weight:bold'>$month month's ago</span>";;
                                            } elseif ($minute >= 518401) {
                                                $year = floor($minute / 518400);
                                                echo "<span style='font-size:10px; font-weight:bold'>$year years ago</span>";
                                            }

                                            echo "

                                                                                             <br>

                                                                                             
                                                                                     
                                                                                     ";
                                        }
                                    } //End if else condition



                                    echo "
                                                                                
                                                                                 
                                                                            </div>

                                                                            <div class='receiver' style='margin-top:10px;'>
                                                                                 ";


                                    echo "
                                                                                 
                                                                                 
                                                                  
                                                                             </div>
                                                                             
                                                                             
                                                                          
                                                                         
                                                                          
                                                                         
                                                                     
                                                                     ";
                                }


                                echo "

                                                                <span id='SenderPostDataShow$f_id'></span>
                                                                
                                                          </div>

                                                          <div class='modal-footer'>

                                                                 <form method='post'  class='SenderPost' id='SenderPost$f_id' style='margin-right:120px'>
                                                                 ";

                                echo csrf_field();

                                echo "
                                                                 <div class='input-group input-group-lg'>
                                                                     <div class='input-group-prepend'>
                                                                         <span><img src='images/$chat_session_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%'></span>
                                                                     </div>
                                                                     <input type='text' class='form-control' name='sender_data' placeholder='Send your message' required>
                                                                     <input type='hidden' name='sender_id' value='$chat_session_id'>
                                                                     <input type='hidden' name='sender_fname' value='$chat_session_fname'>
                                                                     <input type='hidden' name='sender_lname' value='$chat_session_lname'>

                                                                     <input type='hidden' name='receiver_id' value='$f_id'>
                                                                     <input type='hidden' name='receiver_fname' value='$f_f_name'>
                                                                     <input type='hidden' name='receiver_lname' value='$f_l_name'> 


                                                                     <input type='submit' class='btn btn-primary btn-sm' value='send'>
                                                                 </div>
                                                      
                                                             </form>
                                                             
                                                          </div>
                                                          
                                                      </div>
                                                  </div>
                                              </div>
                                         
                                         ";
                                //End Chat Modal

                                echo "
                                
                                </div>
                                
                                
                                ";
                            } else {
                                echo "

                                <div class='col-md-12 col-sm-12 col-xs-12'>

                                     <a href='$f_id' data-toggle='modal' data-target='#offlineFriendModal$f_id' style='text-decoration:none'>

                                        <span style='margin-left:15px'>

                                         <span style=''>
                                             <img src='images/$f_image' class='img-thumbnail' style='width:50px; height:50px;  border-radius:100%; margin-bottom:10px '>
                                         </span>
                                         <span style='font-size:10px; font-weight:bold;'>$f_f_name</span>
                                        
                                        </span>
                                     
                                     </a>
                                
                                </div>
                                
                                
                                ";

                                //offline friend modal

                                echo "

                                <div class='modal' id='offlineFriendModal$f_id'>
                                    <div class='modal-dialog'>
                                         <div class='modal-content'>
                                              <div class='modal-header'>
                                                  ";

                                $get_offline_friend_data = "SELECT * FROM signUp WHERE id=$f_id";
                                $run_offline_friend_data = DB::select($get_offline_friend_data);
                                $data_offline_friend = $run_offline_friend_data;

                                foreach ($data_offline_friend as $item_offline_friend) {
                                    $offline_friend_fname = $item_offline_friend->fname;
                                    $offline_friend_lname = $item_offline_friend->lname;
                                    $offline_friend_image = $item_offline_friend->image;

                                    echo "

                                                      <img src='images/$offline_friend_image' style='width:50px; height:50px; border-radius:100%' class='img-thumbnail'>
                                                      <span style='font-weight:bold; font-size:10px; margin-right:330px; margin-top:15px'>$offline_friend_fname $offline_friend_lname</span>
                                                      
                                                      ";
                                }
                                echo "
                                              </div>

                                              <div class='modal-body'>
                                                 ";

                                //Get Session Data

                                $session_email = session()->get('email');
                                $get_chat_session_image = "SELECT * FROM signup WHERE email='$session_email' ";
                                $run_chat_session_image = DB::select($get_chat_session_image);
                                $data_chat_session_image = $run_chat_session_image;


                                foreach ($data_chat_session_image as $item_chat_session_image) {
                                    $chat_session_image = $item_chat_session_image->image;
                                    $chat_session_id = $item_chat_session_image->id;
                                    $chat_session_fname = $item_chat_session_image->fname;
                                    $chat_session_lname = $item_chat_session_image->lname;

                                    echo "

                                                                            <div class='chat-history'>
                                                                                ";
                                    $get_sender_chat_data = "SELECT * FROM chat WHERE sender_id=$chat_session_id  AND receiver_id=$f_id OR sender_id=$f_id AND receiver_id=$chat_session_id ";
                                    $run_sender_chat_data = DB::select($get_sender_chat_data);
                                    $data_sender_chat = $run_sender_chat_data;

                                    $count = count($run_sender_chat_data);

                                    if ($count == 0) {
                                        echo "<sapn id='conversion$f_id'>No conversion Yet!!!</sapn>";
                                    } else {


                                        foreach ($data_sender_chat as $item_sender_chat) {
                                            $sender_fname = $item_sender_chat->sender_fname;
                                            $sender_lname = $item_sender_chat->sender_lname;
                                            $sender_id = $item_sender_chat->sender_id;
                                            $sender_data = $item_sender_chat->sender_data;
                                            $sender_date = $item_sender_chat->date;
                                            $time = $sender_date;

                                            //bring image

                                            $get_sender_chat_image = "SELECT * FROM signup WHERE id=$sender_id";
                                            $run_sender_chat_image = DB::select($get_sender_chat_image);
                                            $data_sender_chat_image = $run_sender_chat_image;

                                            foreach ($data_sender_chat_image as $item_sender_chat_image) {
                                                $sender_chat_image = $item_sender_chat_image->image;

                                                echo "

                                                                                         

                                                                                         <span><img src='images/$sender_chat_image' class='img-thumbnail' style='width:50px;height:50px'></span>
                                                                                         ";

                                                if ($sender_id == $chat_session_id) {
                                                    echo "

                                                                                             <span style='margin-top:10px; margin-bottom:10px; font-size:12px; font-weight:bold' class='text-center'>
                                                                                                $sender_data
                                                                                             </span>
                                                                                             
                                                                                             ";
                                                } else {
                                                    echo "

                                                                                             <span style='margin-top:10px; margin-bottom:10px; font-size:12px; font-weight:bold; color:blue' >
                                                                                                $sender_data
                                                                                             </span>
                                                                                             
                                                                                             ";
                                                }


                                                echo "
                                                                                         
                                                                                         <span style='margin-left:20px'></span>
                                                                                         
                                                                                         ";
                                            }


                                            //time function

                                            date_default_timezone_set('Asia/Dhaka');
                                            $database_time = strtotime($time);
                                            $difference_time = $current_time - $database_time;

                                            $minute = floor($difference_time / 60);

                                            if ($minute == 0) {
                                                echo "<span style='font-weight:bold; font-size:10px'>just few second's ago</span>";
                                            } elseif ($minute > 0 && $minute <= 60) {
                                                echo "<span style='font-weight:bold; font-size:10px'>$minute minute's ago</span>";
                                            } elseif ($minute >= 61 && $minute <= 1440) {
                                                $hour = floor($minute / 60);
                                                echo "<span style='font-weight:bold; font-size:10px'>$hour hour's ago</span>";
                                            } elseif ($minute >= 1441 && $minute <= 10080) {
                                                $day = floor($minute / 1440);
                                                echo "<span style='font-size:10px; font-weight:bold'>$day day's ago</span>";
                                            } elseif ($minute >= 10081 && $minute <= 43200) {
                                                $week = floor($minute / 10080);
                                                echo "<span style='font-weight:bold; font-size:10px'>$week week's ago</span>";
                                            } elseif ($minute >= 43201 && $minute <= 518400) {
                                                $month = floor($minute / 43200);
                                                echo "<span style='font-size:10px; font-weight:bold'>$month month's ago</span>";;
                                            } elseif ($minute >= 518401) {
                                                $year = floor($minute / 518400);
                                                echo "<span style='font-size:10px; font-weight:bold'>$year years ago</span>";
                                            }

                                            echo "

                                                                                             <br>

                                                                                             
                                                                                     
                                                                                     ";
                                        }
                                    } //End if else condition



                                    echo "

                                                                                <span id='SenderPostDataShowOffline$f_id'></span>
                                                                                
                                                                                 
                                                                            </div>

                                                                            <div class='receiver' style='margin-top:10px;'>
                                                                                 ";


                                    echo "
                                                                                 
                                                                                 
                                                                  
                                                                             </div>
                                                                             
                                                                             
                                                                          
                                                                         
                                                                          
                                                                         
                                                                     
                                                                     ";
                                }



                                echo "
                                              </div>
                                              
                                              <div class='modal-footer'>
                                              ";

                                $get_session_data_offline_friend_chat = "SELECT * FROM signup WHERE id=$session_id";
                                $run_session_data_offline_friend_chat = DB::select($get_session_data_offline_friend_chat);
                                $data_session_offline_friend = $run_session_data_offline_friend_chat;

                                foreach ($data_session_offline_friend as $item_session_offline_friend) {
                                    $session_offline_friend_image = $item_session_offline_friend->image;
                                    $session_offline_friend_fname = $item_session_offline_friend->fname;
                                    $session_offline_friend_lname = $item_session_offline_friend->lname;
                                    $session_offline_friend_id = $item_session_offline_friend->id;

                                    echo "

                                                  <form method='post' class='SenderPost' id='SenderPost$f_id' style='margin-right:100px'>
                                                  ";

                                    echo csrf_field();

                                    echo "

                                                        <div class='input-group input-group-lg'> 
                                                             <div class='input-group-prepend'>
                                                             <span>
                                                                <img src='images/$session_offline_friend_image' style='width:50px; height:50px' class='img-thumbnail'>
                                                             </span>
                                                             </div>

                                                             <input type='text' class='form-control' name='sender_data' placeholder='Send your message' required>
                                                             <input type='hidden' name='sender_id' value='$session_offline_friend_id'>
                                                             <input type='hidden' name='sender_fname' value='$session_offline_friend_fname'>
                                                             <input type='hidden' name='sender_lname' value='$session_offline_friend_lname'>

                                                             <input type='hidden' name='receiver_id' value='$f_id'>
                                                             <input type='hidden' name='receiver_fname' value='$f_f_name'>
                                                             <input type='hidden' name='receiver_lname' value='$f_l_name'> 


                                                             <input type='submit' class='btn btn-primary' value='send'>
                                                        </div>
                                                  
                                                  </form>
                                                  
                                                  ";
                                }

                                echo "
                                              </div>
                                              
                                         </div>
                                    </div>
                                </div>
                                
                                
                                ";
                            }
                        }
                    }

                    //opponent page show friend

                    $get_opponent_friend = "SELECT * FROM userlist WHERE f_id=$session_id AND status='friend' ";
                    $run_opponent_friend = DB::select($get_opponent_friend);
                    $data_opponent = $run_opponent_friend;

                    foreach ($data_opponent as $item_opponent) {
                        $user_f_name = $item_opponent->user_f_name;
                        $user_l_name = $item_opponent->user_l_name;
                        $user_image = $item_opponent->user_image;
                        $user_id = $item_opponent->user_id;

                        //friend mode check
                        $target_data = "SELECT * FROM signup WHERE id=$user_id";
                        $run_target_data = DB::select($target_data);
                        $data_target = $run_target_data;

                        foreach ($data_target as $item_target) {
                            $mode = $item_target->mode;
                            if ($mode == 'online') {
                                echo "

                                <div class='col-md-12 col-xs-12 col-sm-12' style='margin-bottom:10px'>

                                     <a href='$user_id' data-toggle='modal' data-target='#chatModal$user_id' style='text-decoration:none'>

                                         <span style=''>
                                            <span style='font-weight:bold; font-size:40px; color:blue'>.</span>
                                            <img src='images/$user_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%'>
                                            <span style='font-size:10px; font-weight:bold'>$user_f_name</span>
                                         </span>

                                     </a>

                                      ";

                                //Chat modal
                                echo "
                                           <div class='modal' id='chatModal$user_id'>
                                               <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            ";
                                $get_opposite_chat_user = "SELECT * FROM signup WHERE id=$user_id ";
                                $run_opposite_chat_user = DB::select($get_opposite_chat_user);
                                $data_opposite_chat_user = $run_opposite_chat_user;

                                foreach ($data_opposite_chat_user as $item_opposite_chat_user) {
                                    $opposite_chat_user_image = $item_opposite_chat_user->image;
                                    $opposite_chat_user_fname = $item_opposite_chat_user->fname;
                                    $opposite_chat_user_lname = $item_opposite_chat_user->lname;

                                    echo "

                                                                <img src='images/$opposite_chat_user_image' style='width:50px; height:50px; border-radius:100%' class='img-thumbnail'>
                                                                <span style='font-weight:bold; font-size:11px; margin-right:320px; margin-top:20px'>$opposite_chat_user_fname $opposite_chat_user_lname</span>
                                                                
                                                                ";
                                }
                                echo "
                                                        </div>
                                                       
                                                        <div class='modal-body'>
                                                            ";

                                $get_opposite_chat_data = "SELECT * FROM chat WHERE sender_id = $session_id AND receiver_id=$user_id OR sender_id=$user_id AND receiver_id=$session_id";
                                $run_opposite_chat_data = DB::select($get_opposite_chat_data);
                                $data_opposite_chat = $run_opposite_chat_data;

                                $count = count($run_opposite_chat_data);

                                if ($count == 0) {
                                    echo "<span id='conversion$user_id'>No conversion yet!!!</span>";
                                }

                                foreach ($data_opposite_chat as $item_opposite_chat) {
                                    $opposite_chat_user_fname = $item_opposite_chat->sender_fname;
                                    $opposite_chat_user_lname = $item_opposite_chat->sender_lname;
                                    $opposite_chat_user_data = $item_opposite_chat->sender_data;
                                    $opposite_chat_user_id = $item_opposite_chat->sender_id;
                                    $opposite_chat_user_date = $item_opposite_chat->date;
                                    $time = $opposite_chat_user_date;

                                    //Bring Image

                                    $get_opposite_chat_user_image = "SELECT * FROM signup WHERE id = $opposite_chat_user_id";
                                    $run_opposite_chat_user_image = DB::select($get_opposite_chat_user_image);
                                    $data_opposite_chat_user_image = $run_opposite_chat_user_image;

                                    foreach ($data_opposite_chat_user_image as $item_opposite_chat_user_image) {
                                        $opposite_chat_user_image = $item_opposite_chat_user_image->image;
                                        echo "

                                                                    <span>
                                                                         <img src='images/$opposite_chat_user_image' class='img-thumbnail' style='width:50px; height:50px'>
                                                                    </span>
                                                                    ";

                                        if ($opposite_chat_user_id == $session_id) {
                                            echo "

                                                                        <span style='font-weight:bold; margin-left:10px; margin-right:20px; font-size:12px'>$opposite_chat_user_data</span>
                                                                        
                                                                        ";
                                        } else {
                                            echo "

                                                                        <span style='font-weight:bold; margin-left:10px; margin-right:20px; font-size:12px; color:blue'>$opposite_chat_user_data</span>
                                                                        
                                                                        
                                                                        ";
                                        }


                                        //time function

                                        date_default_timezone_set('Asia/Dhaka');
                                        $database_time = strtotime($time);
                                        $difference_time = $current_time - $database_time;

                                        $minute = floor($difference_time / 60);

                                        if ($minute == 0) {
                                            echo "<span style='font-weight:bold; font-size:10px'>just few second's ago</>";
                                        } elseif ($minute > 0 && $minute <= 60) {
                                            echo "<span style='font-weight:bold; font-size:10px'>$minute minute's ago</span>";
                                        } elseif ($minute >= 61 && $minute <= 1440) {
                                            $hour = floor($minute / 60);
                                            echo "<span style='font-size:10px; font-weight:bold'>$hour hour's ago</span>";
                                        } elseif ($minute >= 1441 && $minute <= 10080) {
                                            $day = floor($minute / 1440);
                                            echo "<span style='font-weight:bold; font-size:10px'>$day day's ago</span>";
                                        } elseif ($minute >= 10081 && $minute <= 43200) {
                                            $week = floor($minute / 10080);
                                            echo "<span style='font-weight:bold; font-size:10px'>$week week's ago</span>";
                                        } elseif ($minute >= 43201 && $minute <= 518400) {
                                            $month = floor($minute / 43200);
                                            echo "<span style='font-size:10px; font-weight:bold'>$month month's ago</span>";;
                                        } elseif ($minute >= 518401) {
                                            $year = floor($minute / 518400);
                                            echo "<span style='font-size:10px; font-weight:bold'>$year years ago</span>";
                                        }

                                        echo "


                                                                    <br>
                                                                    
                                                                    ";
                                    }
                                }


                                echo "
                                                           
                                                            <span id='SenderPostDataShowOpposite$user_id'></span>
                                                        </div>

                                                        <div class='modal-footer'>
                                                            ";

                                $get_chat_session_data = "SELECT * FROM signup WHERE id=$session_id";
                                $run_chat_session_data = DB::select($get_chat_session_data);
                                $data_chat_session = $run_chat_session_data;

                                foreach ($data_chat_session as $item_chat_session) {
                                    $session_chat_image = $item_chat_session->image;
                                    //Data passing into form

                                    $sender_id = $item_chat_session->id;
                                    $sender_fname = $item_chat_session->fname;
                                    $sender_lname = $item_chat_session->lname;

                                    //Receiver data carry
                                    $get_chat_receiver_data = "SELECT * FROM signup WHERE id=$user_id";
                                    $run_chat_receiver_data = DB::select($get_chat_receiver_data);
                                    $data_chat_receiver = $run_chat_receiver_data;

                                    foreach ($data_chat_receiver as $item_chat_receiver) {
                                        $receiver_id = $item_chat_receiver->id;
                                        $receiver_fname = $item_chat_receiver->fname;
                                        $receiver_lname = $item_chat_receiver->lname;
                                    }

                                    echo "

                                                                <form method='post' style='margin-right:110px' class='SenderPost' id='SenderPost$user_id'>
                                                                ";

                                    echo csrf_field();

                                    echo "
                                                                    <div class='input-group input-group-lg'>
                                                                        <div class='input-group-prepend'>
                                                                            <img src='images/$session_chat_image' style='width:50px; height:50px' class='img-thumbnail'>
                                                                         
                                                                        </div>
                                                                        <input type='text' class='form-control' name='sender_data' placeholder='Send your message' required>
                                                                        <input type='hidden' name='sender_id' value='$sender_id'>
                                                                        <input type='hidden' name='sender_fname' value='$sender_fname'>
                                                                        <input type='hidden' name='sender_lname' value='$sender_lname'>
                                                                        <input type='hidden' name='receiver_id' value='$receiver_id'>
                                                                        <input type='hidden' name='receiver_fname' value='$receiver_fname'>
                                                                        <input type='hidden' name='receiver_lname' value='$receiver_lname'>

                                                                        <input type='submit' class='btn btn-primary' value='send'>
                                                                    </div>
                                                                </form>
                                                                
                                                                ";
                                }

                                echo "
                                                        </div>
                                                    </div>
                                               </div>
                                           </div>
                                      
                                      
                                      ";

                                echo "
                                
                                </div>
                                
                                
                                ";
                            } else {

                                echo "
                                

                                <div class='col-md-12 col-sm-12 col-xs-12'>
                                     <a href='$user_id' data-toggle='modal' data-target='#opponentOfflineFriend$user_id' style='text-decoration:none'>
                                     

                                         <span style='margin-left:12px'>

                                         <span>
                                             <img src='images/$user_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%'>
                                         </span>
                                         <span style='font-size:10px; font-weight:bold'>$user_f_name</span>
                                         
                                         </span>
                
                                         </div>
                                         
                                     </a>
                                     
                                
                                ";

                                //opponent offline friend modal

                                echo "

                                <div class='modal' id='opponentOfflineFriend$user_id'>
                                     <div class='modal-dialog'>
                                         <div class='modal-content'>
                                             <div class='modal-header'>
                                                ";

                                $get_opposite_chat_user = "SELECT * FROM signup WHERE id=$user_id ";
                                $run_opposite_chat_user = DB::select($get_opposite_chat_user);
                                $data_opposite_chat_user = $run_opposite_chat_user;

                                foreach ($data_opposite_chat_user as $item_opposite_chat_user) {
                                    $opposite_chat_user_image = $item_opposite_chat_user->image;
                                    $opposite_chat_user_fname = $item_opposite_chat_user->fname;
                                    $opposite_chat_user_lname = $item_opposite_chat_user->lname;

                                    echo "

                                                                <img src='images/$opposite_chat_user_image' style='width:50px; height:50px; border-radius:100%' class='img-thumbnail'>
                                                                <span style='font-weight:bold; font-size:11px; margin-right:320px; margin-top:20px'>$opposite_chat_user_fname $opposite_chat_user_lname</span>
                                                                
                                                                ";
                                }



                                echo "
                                             </div>
                                             <div class='modal-body'>
                                                ";


                                $get_opposite_chat_data = "SELECT * FROM chat WHERE sender_id = $session_id AND receiver_id=$user_id OR sender_id=$user_id AND receiver_id=$session_id";
                                $run_opposite_chat_data = DB::select($get_opposite_chat_data);
                                $data_opposite_chat = $run_opposite_chat_data;

                                $count = count($run_opposite_chat_data);

                                if ($count == 0) {
                                    echo "<span id='conversion$user_id'>No conversion Yet!!!!!</span>";
                                } else {


                                    foreach ($data_opposite_chat as $item_opposite_chat) {
                                        $opposite_chat_user_fname = $item_opposite_chat->sender_fname;
                                        $opposite_chat_user_lname = $item_opposite_chat->sender_lname;
                                        $opposite_chat_user_data = $item_opposite_chat->sender_data;
                                        $opposite_chat_user_id = $item_opposite_chat->sender_id;
                                        $opposite_chat_user_date = $item_opposite_chat->date;
                                        $time = $opposite_chat_user_date;

                                        //Bring Image

                                        $get_opposite_chat_user_image = "SELECT * FROM signup WHERE id = $opposite_chat_user_id";
                                        $run_opposite_chat_user_image = DB::select($get_opposite_chat_user_image);
                                        $data_opposite_chat_user_image = $run_opposite_chat_user_image;

                                        foreach ($data_opposite_chat_user_image as $item_opposite_chat_user_image) {
                                            $opposite_chat_user_image = $item_opposite_chat_user_image->image;
                                            echo "
    
                                                                        <span>
                                                                             <img src='images/$opposite_chat_user_image' class='img-thumbnail' style='width:50px; height:50px;'>
                                                                        </span>
                                                                        ";

                                            if ($opposite_chat_user_id == $session_id) {
                                                echo "
    
                                                                            <span style='font-weight:bold; margin-left:10px; margin-right:20px; font-size:12px'>$opposite_chat_user_data</span>
                                                                            
                                                                            ";
                                            } else {
                                                echo "
    
                                                                            <span style='font-weight:bold; margin-left:10px; margin-right:20px; font-size:12px; color:blue'>$opposite_chat_user_data</span>
                                                                            
                                                                            
                                                                            ";
                                            }


                                            //time function

                                            date_default_timezone_set('Asia/Dhaka');
                                            $database_time = strtotime($time);
                                            $difference_time = $current_time - $database_time;

                                            $minute = floor($difference_time / 60);

                                            if ($minute == 0) {
                                                echo "<span style='font-weight:bold; font-size:10px'>just few second's ago</>";
                                            } elseif ($minute > 0 && $minute <= 60) {
                                                echo "<span style='font-weight:bold; font-size:10px'>$minute minute's ago</span>";
                                            } elseif ($minute >= 61 && $minute <= 1440) {
                                                $hour = floor($minute / 60);
                                                echo "<span style='font-size:10px; font-weight:bold'>$hour hour's ago</span>";
                                            } elseif ($minute >= 1441 && $minute <= 10080) {
                                                $day = floor($minute / 1440);
                                                echo "<span style='font-weight:bold; font-size:10px'>$day day's ago</span>";
                                            } elseif ($minute >= 10081 && $minute <= 43200) {
                                                $week = floor($minute / 10080);
                                                echo "<span style='font-weight:bold; font-size:10px'>$week week's ago</span>";
                                            } elseif ($minute >= 43201 && $minute <= 518400) {
                                                $month = floor($minute / 43200);
                                                echo "<span style='font-size:10px; font-weight:bold'>$month month's ago</span>";;
                                            } elseif ($minute >= 518401) {
                                                $year = floor($minute / 518400);
                                                echo "<span style='font-size:10px; font-weight:bold'>$year years ago</span>";
                                            }

                                            echo "
                                            <br>
    
    
                                                                        
                                                                        
                                                                        ";
                                        }
                                    }
                                }




                                echo "
                                

                                                <span id='SenderPostDataShowOppositeOffline$user_id'></span>
                                               
                                             </div>
                                             <div class='modal-footer'>
                                                ";

                                $get_chat_session_data = "SELECT * FROM signup WHERE id=$session_id";
                                $run_chat_session_data = DB::select($get_chat_session_data);
                                $data_chat_session = $run_chat_session_data;

                                foreach ($data_chat_session as $item_chat_session) {
                                    $session_chat_image = $item_chat_session->image;
                                    //Data passing into form

                                    $sender_id = $item_chat_session->id;
                                    $sender_fname = $item_chat_session->fname;
                                    $sender_lname = $item_chat_session->lname;

                                    //Receiver data carry
                                    $get_chat_receiver_data = "SELECT * FROM signup WHERE id=$user_id";
                                    $run_chat_receiver_data = DB::select($get_chat_receiver_data);
                                    $data_chat_receiver = $run_chat_receiver_data;

                                    foreach ($data_chat_receiver as $item_chat_receiver) {
                                        $receiver_id = $item_chat_receiver->id;
                                        $receiver_fname = $item_chat_receiver->fname;
                                        $receiver_lname = $item_chat_receiver->lname;
                                    }

                                    echo "

                                                    <form method='post' style='margin-right:110px' class='SenderPost' id='SenderPost$user_id'>
                                                    ";

                                    echo csrf_field();

                                    echo "
                                                        <div class='input-group input-group-lg'>
                                                            <div class='input-group-prepend'>
                                                                <img src='images/$session_chat_image' style='width:50px; height:50px' class='img-thumbnail'>
                                                             
                                                            </div>
                                                            <input type='text' class='form-control' name='sender_data' placeholder='Send your message' required>
                                                            <input type='hidden' name='sender_id' value='$sender_id'>
                                                            <input type='hidden' name='sender_fname' value='$sender_fname'>
                                                            <input type='hidden' name='sender_lname' value='$sender_lname'>
                                                            <input type='hidden' name='receiver_id' value='$receiver_id'>
                                                            <input type='hidden' name='receiver_fname' value='$receiver_fname'>
                                                            <input type='hidden' name='receiver_lname' value='$receiver_lname'>

                                                            <input type='submit' class='btn btn-primary' value='send'>
                                                        </div>
                                                    </form>
                                                    
                                                    ";
                                }

                                echo "
                                             </div>
                                         </div>
                                     </div>
                                </div>
                                
                                ";
                            }
                        }
                    }
                }

                ?>


            </div>

            <!--profileChange modal-->

            <div class="modal" id="profilepic">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Change Profile</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <?php
                            $get_data = "SELECT * FROM signup WHERE email = '$session_email' ";
                            $run_data = DB::select($get_data);
                            $data = $run_data;

                            foreach ($data as $item) {
                                $id = $item->id;
                                $image = $item->image;
                                echo "

                                <form method='post' action='changeProfile' enctype='multipart/form-data'>
                                ";
                                echo csrf_field();
                                echo "
                                    <div class='form-group'>
                                       <input type='file' name='image' class='form-control' value='$image' required>
                                       <input type='hidden' name='user_id' value='$id'>
                                    </div>
                                    <input type='submit' class='btn btn-primary' value='Submit'>
                                </form>
                                
                                ";
                            }

                            ?>

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <!--End Row-->

    </div>
    <!--- End jumbotron--->

    <!---Addfriend Comment Modal--->



    <script>
        $(document).ready(function() {

            $('#country_name').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete.fetch') }}",
                        method: "POST",
                        data: {
                            query: query,
                            _token: _token
                        },
                        success: function(data) {
                            $('#countryList').fadeIn();
                            $('#countryList').html(data);
                        }
                    });
                }
            });

            $(document).on('click', 'li', function() {
                // $('#country_name').val($(this).text());
                $('#countryList').fadeOut();
            });

        });


        //ajax insert data for session like

        jQuery(document).ready(function($) {


            $(".frmrecord").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'profile/like',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                        alert(returndata);

                        setInterval(function() {
                            $('#shuvo').load('LikeAjax')

                        }, 3000);

                        $.ajax({ //create an ajax request to display.php
                            type: "GET",
                            url: "LikeAjax",
                            dataType: "html", //expect html to be returned                
                            success: function(response) {
                                $("#" + returndata).html(response);
                                $('#show' + returndata).hide();
                                //alert(response);
                            }

                        });



                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });

        });

        //comment data ajax procedure
        $(document).ready(function() {

            $(".commentAjax").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'comment',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                       // alert(returndata);


                        $.ajax({ //create an ajax request to display.php
                            type: "GET",
                            url: "CommentAjax",
                            dataType: "html", //expect html to be returned                
                            success: function(response) {
                                $("#" + returndata).html(response);
                                $('#comment' + returndata).hide();
                                $('#commentLink' + returndata).hide();

                               // alert(response);
                            }

                        });

                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });


        })
        //end comment data ajax procedure


        //Comment Delete
        $(document).ready(function() {

            $(".commentDelete").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'commentDelete',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                       // alert(returndata);
                        $('#specificComment' + returndata).hide();
                        $('.' + returndata).hide();




                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });


        })


        //End comment Delete

        //comment Edit

        $(document).ready(function() {

            $(".commentEdit").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'commentEdit',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                       // alert(returndata);
                        $('#commentEdit' + returndata).hide();
                        $('#specificComment' + returndata).hide();
                        $('.edit' + returndata).hide();
                        //$('.' + returndata).hide();

                        $.ajax({ //create an ajax request to display.php
                            type: "GET",
                            url: "EditAjax",
                            dataType: "html", //expect html to be returned                
                            success: function(response) {
                                $("#editShow" + returndata).html(response);
                                // $('#comment' + returndata).hide();
                                // $('#commentLink' + returndata).hide();

                                //alert(response);
                            }

                        });




                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });


        })





        //End comment Edit

        //Ajax chat form submit

        $(document).ready(function() {

            $(".SenderPost").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'SenderPost',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                        //alert(returndata);
                        $('#SenderPost' + returndata)[0].reset();

                        $('#conversion' + returndata).hide();



                        $.ajax({ //create an ajax request to display.php
                            type: "GET",
                            url: "AjaxSenderPost",
                            dataType: "html", //expect html to be returned                
                            success: function(response) {
                                $("#SenderPostDataShow" + returndata).html(response);
                                $("#SenderPostDataShowOffline" + returndata).html(response);


                                $("#SenderPostDataShowOpposite" + returndata).html(response);
                                $("#SenderPostDataShowOppositeOffline" + returndata).html(response);


                               // alert(response);
                            }

                        });






                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });




        })

        //End of ajax chat form submit

        //password change

        $(document).ready(function() {

            $(".passwordChange").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'PasswordChange',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                        alert('Password Changed Successfully!!');
                        
                        $('#' + returndata).show().delay(5000).fadeOut('slow');
                       


                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });




        })

        //End password change
    </script>




















</body>

</html>