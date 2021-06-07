<?php
    $session_comment_post_id = session()->get('session_comment_post_id');
    $get_comment_data = "SELECT * FROM comment WHERE post_id=$session_comment_post_id";
    $run_comment_data = DB::select($get_comment_data);
    $data_comment = $run_comment_data;

    $count = count($run_comment_data);
    $update_count = $count-1;

    foreach($data_comment as $item_comment)
    {
        $comment_user_fname = $item_comment->user_fname;
        $comment_user_lname = $item_comment->user_lname;
        $comment_user_id = $item_comment->user_id;
        $comment_user_data = $item_comment->comment_data;

        //Bring Image
        $get_comment_user_image = "SELECT * FROM signup WHERE id=$comment_user_id ";
        $run_comment_user_image = DB::select($get_comment_user_image);
        $data_comment_user_image = $run_comment_user_image;

        foreach($data_comment_user_image as $item_comment_user_image)
        {
            $comment_user_image = $item_comment_user_image->image;
        }

        

        
    }

    echo "
         <span><img src='images/$comment_user_image' class='img-thumbnail' style='width:40px;height:40px; border-radius:100%'></span>
         <span style='font-weight:bold; font-size:10px'>$comment_user_fname $comment_user_lname</span>
         
         <span style='margin-left:20px'>$comment_user_data </span>
         <br>
         <br>

         <span style='font-size:10px; font-weight:bold;'>
             <a href='#'  data-toggle='modal' data-target='#commentshow' style='text-decoration:none; color:red'>Show $update_count more's comment</a>
                                
         </span>
    
    ";

    //Ajax comment show modal

    echo "
         <div class='modal' id='commentshow'>
             <div class='modal-dialog'>
                 <div class='modal-content'>
                     <div class='modal-body'>
                          ";

                              $get_modal_post_data ="SELECT * FROM userpost WHERE id=$session_comment_post_id";
                              $run_modal_post_data = DB::select($get_modal_post_data);
                              $data_modal_post = $run_modal_post_data;
                              
                              foreach($data_modal_post as $item_modal_post)
                              {
                                  $modal_post_message = $item_modal_post->message;
                                  $modal_post_image = $item_modal_post->image;


                                  echo "
                                       <span>$modal_post_message</span>
                                       <br>
                                       ";

                                       if($modal_post_image=='')
                                       {
                                           echo "";
                                       }else{
                                           echo "

                                                <span><img src='images/$modal_post_image' class='img-thumbnail'></span>
                                           
                                           ";
                                       }

                        

                                      //get all comment for the post
                                    $get_modal_post_comment = "SELECT * FROM comment WHERE post_id = $session_comment_post_id ";
                                    $run_modal_post_comment = DB::select($get_modal_post_comment);
                                    $data_modal_post_comment = $run_modal_post_comment;

                                    foreach($data_modal_post_comment as $item_modal_post_comment)
                                    {
                                        $modal_post_comment_data = $item_modal_post_comment->comment_data;
                                        $modal_post_comment_user_fname = $item_modal_post_comment->user_fname;
                                        $modal_post_comment_user_lname = $item_modal_post_comment->user_lname;
                                        $modal_post_comment_user_id = $item_modal_post_comment->user_id;
                                        $modal_post_comment_id = $item_modal_post_comment->id;

                                        //get image for post comment
                                        $get_modal_post_comment_image = "SELECT * FROM signup WHERE id=$modal_post_comment_user_id ";
                                        $run_modal_post_comment_image = DB::select($get_modal_post_comment_image);
                                        $data_modal_post_comment_image = $run_modal_post_comment_image;

                                        foreach($data_modal_post_comment_image as $item_modal_post_comment_image)
                                        {
                                            $modal_post_comment_image  = $item_modal_post_comment_image->image;

                                              //get session id
                                            $session_email = session()->get('email');
                                            $get_session_id = "SELECT * FROM signup WHERE email='$session_email' ";
                                            $run_session_id = DB::select($get_session_id);
                                            $data_session_id = $run_session_id;

                                            foreach($data_session_id as $item_session_id)
                                            {
                                                $session_id = $item_session_id->id;
                                            }


                                            echo "
                                                 
                                                
                                                 
                                                 ";

                                                 if($session_id == $modal_post_comment_user_id)
                                                 {
                                                     echo " 
                                                     
                                                        

                                                            <br>
                                                             <br>
                                                             <span><img src='images/$modal_post_comment_image' class='img-thumbnail $modal_post_comment_id' style='width:50px; height:50px; border-radius:100%'></span>
                                                             <span style='font-weight:bold; font-size:10px' class='$modal_post_comment_id'>$modal_post_comment_user_fname $modal_post_comment_user_lname</span>
                                                             <br>
                                                             <span style='margin-left:60px' class='$modal_post_comment_id'>$modal_post_comment_data</span>
                                                            <span style='margin-left:90px; font-weight:bold; color:red; font-size:25px'>
                                                                <a href='$modal_post_comment_id' class='$modal_post_comment_id'  data-toggle='modal' data-target='#commentEditOrDelete$modal_post_comment_id'  style='text-decoration:none'>....</a>
                                                            </span>
                                                            
                                                            
                                                             
                                                     
                                                     ";
                                                 }else{
                                                     echo "

                                                          <br>
                                                          <br>
                                                 
                                                          <span><img src='images/$modal_post_comment_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%'></span>
                                                          <span style='font-weight:bold; font-size:10px'>$modal_post_comment_user_fname $modal_post_comment_user_lname</span>
                                                          <br>
                                                          <span style='margin-left:60px'>$modal_post_comment_data</span>
                                                     
                                                         ";
                                                 }

                                                       //Comment Edit Delete Modal
                                                     echo "
                                                             <div class='modal' id='commentEditOrDelete$modal_post_comment_id'>
                                                                 <div class='modal-dialog'>
                                                                      <div class='modal-content'>
                                                                           <div class='modal-body'>
                                                                              
                                                                                ";
                                                                                    //specific comment found
                                                                                     $get_specific_comment_data="SELECT * FROM comment WHERE id= $modal_post_comment_id ";
                                                                                     $run_specific_comment_data = DB::select($get_specific_comment_data);
                                                                                     $data_specific_comment = $run_specific_comment_data;
                                                                                     
                                                                                     foreach($data_specific_comment as $item_specific_comment)
                                                                                     {
                                                                                         $specific_comment_data = $item_specific_comment->comment_data;
                                                                                         $specific_comment_user_fname = $item_specific_comment->user_fname;
                                                                                         $specific_comment_user_lname = $item_specific_comment->user_lname;
                                                                                         $specific_comment_user_id = $item_specific_comment->user_id;

                                                                                         //Collect image
                                                                                         $get_specific_comment_user_image = "SELECT * FROM signup WHERE id = $specific_comment_user_id";
                                                                                         $run_specific_comment_user_image = DB::select($get_specific_comment_user_image);
                                                                                         $data_specific_comment_user_image = $run_specific_comment_user_image;

                                                                                         foreach($data_specific_comment_user_image as $item_specific_comment_user_image)
                                                                                         {
                                                                                             $specific_comment_user_image = $item_specific_comment_user_image->image;

                                                                                             echo "
                                                                                                  <span><img src='images/$specific_comment_user_image' class='img-thumbnail' style='width:50px; height:50px; border-radius:100%'></span>
                                                                                                  <span style='font-weight:bold; font-size:10px'>$specific_comment_user_fname $specific_comment_user_lname</span>
                                                                                                  <br>
                                                                                                  <span style='margin-left:50px; color:blue'>$specific_comment_data</span>
                                                                                                  <hr>
                                                                                                  <br>

                                                                                                  <form method='post' class='commentDelete'>
                                                                                                  ";

                                                                                                  echo csrf_field();

                                                                                                  echo "
                                                                                                          <input type='hidden' value='$modal_post_comment_id' name='modal_post_comment_id'>
                                                                                                          <input type='submit' class='btn btn-danger' value='Delete'>
                                                                                                 </form>
                                                                                                  
                                                                                             
                                                                                                 ";
                                                                                         }

                                                                                         
                                                                                     }
                                                                                    //End specific comment found
                                                                                echo "
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                             </div>
                                                     
                                                     ";
                                                 

                                        }
                                        
                                        
                                    }

                                  
                              }
                          echo "
                     </div>
                 </div>
             </div>
         </div>
    
    
    ";

    //End Ajax comment show modal  

?>

<html>
    <head>

    </head>
    <body>
        <script>
            //Comment Delete Ajax

        $(document).ready(function(){
            
            $(".commentDelete").submit(function(event) {
                event.preventDefault();

                //validation for login form
                $("#progress").html('Inserting <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: 'CommentDeleteAjax',
                    type: 'POST',

                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(returndata) {
                        var returndata;
                        alert(returndata);

                        $('#commentEditOrDelete' + returndata).hide();
                        $('.' + returndata).hide();

                       

                    },

                    error: function() {
                        alert("error in ajax form submission");
                    }
                });
                return false;
            });


         })

         
        //End Comment Delete Ajax

        
        </script>
    </body>
</html>