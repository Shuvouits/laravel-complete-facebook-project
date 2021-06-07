<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignUpController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'fname' => 'min:3 | max:10',
            'lname' => 'min:3 | max:10',
            'email' => 'regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'min:5 | max:10',
            'cpassword' => 'min:5 | max:10'
        ]);

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $password = $request->input('password');
        $cpassword = $request->input('cpassword');
        $image = $request->input('image');

        if ($password == $cpassword) {
            $get_data = "SELECT * FROM signup WHERE email='$email' ";
            $run_get_data = DB::select($get_data);
            $count = count($run_get_data);

            if ($count == 0) {
                $insert_data = "INSERT INTO signup(fname,lname,email,password,image, mode) VALUES ('$fname','$lname','$email','$password','$image', 'offline')";
                $run_data = DB::select($insert_data);

                return redirect('/')->with('signUpSuccess', 'Your account SignUp Successfully');
            } else {
                return redirect('/')->with('emailUse', 'This Email Already use by Another user!!');
            }
        } else {
            return redirect('/')->with('passwordNotMatch', 'Password doesnot match');
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $get_data = "SELECT * FROM signup WHERE email='$email' AND password='$password' ";
        $run_data = DB::select($get_data);

        $count = count($run_data);
        if ($count == 1) {
            session()->put('email', $email);

            $update_mode = "UPDATE signup SET mode='online' WHERE email='$email' AND password='$password' ";
            $run_update_mode = DB::select($update_mode);

            return redirect('/profile');
        } else {
            return redirect('/')->with('loginErr', 'Error Email or Password');
        }
    }

    public function profile()
    {
        $email = session()->get('email');

        if ($email) {
            return view('/Profile');
        } else {
            return redirect('/');
        }
    }

    public function logout()
    {
        $email = session()->get('email');
        $get_data = "SELECT * FROM signup WHERE email='$email' ";
        $run_data = DB::select($get_data);
        $count = count($run_data);

        if($count==1){
            $update_mode = "UPDATE signup SET mode='offline' WHERE email='$email' ";
            $run_data = DB::select($update_mode);
            session()->flush();
            return redirect('/');

        }
        
        
        
        //$email = session()->get('email');
        
    }

    public function changeprofile(Request $request)
    {
        $user_id = $request->input('user_id');
        //upload Image

        $msg = "";
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
        $get_data = "UPDATE signup SET image='$image' WHERE id=$user_id ";
        $run_data = DB::select($get_data);
        return redirect('/profile');
    }


    public function index()
    {
        return view('autocomplete');
    }

    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('signup')
                ->where('fname', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
                    <li> 
                    
                       <a href= "userprofile/'.$row->id.' "  style="text-decoration:none; font-weight:bold"> 
                            <img src="images/'.$row->image.' " style="width:50px; height:50px" class="img-thumbnail">
                             <span style="font-size:12px; font-weight:bold">'. $row->fname .'</span>
                            </a>
                    </li> <br> ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function personProfile($id)
    {
        $email = session()->get('email');
        if($email){
            session()->put('id', $id);

            return redirect('/findPeople');
           

        }else{
            return redirect('/');
        }
    }

    public function findPeople(){
        $email = session()->get('email');

        if($email){
            return view('ProfilePerson');

        }else{
            return redirect('/');
        }
        
    }

    public function addfriend($id){
        //return $id;
        $email = session()->get('email');
        //return $email;

       
        
        if($email){
            $get_data = "SELECT * FROM userlist WHERE f_id = $id AND user_email='$email' ";
            $run_data = DB::select($get_data);
            $count = count($run_data);

            if($count==0){
                $get_signup_data = "SELECT * FROM signup WHERE id = $id";
                $run_signup_data = DB::select($get_signup_data);
                $f_data = $run_signup_data;
    
                foreach($f_data as $item){
                    $f_id = $item->id;
                    $f_email = $item->email;
                    $f_image = $item->image;
                    $f_f_name = $item->fname;
                    $f_l_name = $item->lname;
                    
                    $get_user_signup_data = "SELECT *FROM signup WHERE email = '$email' ";
                    $run_user_signup_data = DB::select($get_user_signup_data);
                    $user_data = $run_user_signup_data;
    
                    foreach($user_data as $item){
                        $user_email = $item->email;
                        $user_id = $item->id;
                        $user_image = $item->image;
                        $user_f_name = $item->fname;
                        $user_l_name = $item->lname;
                        
                    }
                }
    
                $insert_data = "INSERT INTO userlist (user_email,user_id,status,f_email,f_id,user_image,user_f_name,user_l_name,f_f_name,f_l_name,f_image) VALUES ('$user_email','$user_id', 'requestsent', '$f_email','$f_id','$user_image','$user_f_name','$user_l_name','$f_f_name','$f_l_name', '$f_image') ";
                $run_data = DB::select($insert_data);
    
                return redirect('/findPeople');
    
            }

        }else{
            return redirect('/');
        }
    }

    public function friendlist($id){
        $email = session()->get('email');

        if($email){
            $update_status = " UPDATE userlist SET status='friend' WHERE user_id=$id AND f_email='$email'  ";
            $run_update_status = DB::select($update_status);
            return redirect('/profile');

        }else{
            return redirect('/');
        }

    }

    public function decline($id){
        $email = session()->get('email');

        if($email){
            $decline_data = "UPDATE userlist SET status='decline' WHERE user_id=$id AND f_email='$email' ";
            $run_data = DB::select($decline_data);
            return redirect('/profile');

        }else{
            return redirect('/');
        }

    }
    public function declinesent($id){
        //return $id;
        $email = session()->get('email');
        if($email){
            $update_data = "UPDATE userlist SET status='requestsent' WHERE f_id=$id AND user_email='$email'   ";
            $run_update_data = DB::select($update_data);
            return redirect('/findPeople');

        }else{
            return redirect('/');
        }
    }

    public function block($id){
        $email = session()->get('email');
        if($email){
            $block_data = "DELETE FROM userlist WHERE user_id = $id AND f_email = '$email' ";
            $run_data = DB::select($block_data);
            return redirect('/profile');

        }else{
            return redirect('/');
        }
    }

    public function postdata(Request $request){
        $email = session()->get('email');

        if($email){
            $user_email = $request->input('email');
            $message = $request->input('message');
            $choose = $request->input('choose');
            $user_image = $request->input('user_image');
            $user_fname = $request->input('fname');
            $user_lname = $request->input('lname');
            $user_id = $request->input('user_id');
            //upload Image
    
            $msg = "";
            $image = $_FILES['image']['name'];
            $target = "images/" . basename($image);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
            
            $insert_post = "INSERT INTO userpost (user_email,message,image,choose,user_image,user_fname,user_lname,user_id) VALUES ('$user_email','$message','$image','$choose','$user_image','$user_fname','$user_lname', '$user_id')";
            $run_insert_post = DB::select($insert_post);
            return redirect('/profile');

        }else{
            return redirect('/');
        }

    }

    public function cancel($id){
        $delete_data = "DELETE FROM userlist WHERE f_id =$id ";
        $run_data = DB::select($delete_data);
        return redirect('/profile');
    }

    public function dec($id){

        $email = session()->get('email');
        if($email){
            $decline_data = "DELETE FROM userlist WHERE user_id = $id OR f_id = $id ";
            $run_data = DB::select($decline_data);
            return redirect('/profile');

        }else{
            return redirect('/');
        }
    }

    public function like($id){
        $email = session()->get('email');
        if($email){
            $get_data = "SELECT * FROM signup WHERE email ='$email' ";
            $run_data = DB::select($get_data);
            $data = $run_data;
            foreach($data as $item){
                $fname = $item->fname;
                $lname = $item->lname;
                $user_id = $item->id;

                $get_likedata = "SELECT * FROM likedata WHERE user_id=$user_id AND post_id = $id ";
                $run_likedata = DB::select($get_likedata);
                $count = count($run_likedata);
                
                if($count==0){
                    $insert_data = "INSERT INTO likedata (user_id,user_fname,user_lname,post_id) VALUES ('$user_id','$fname','$lname','$id')";
                    $run_data = DB::select($insert_data);
                    return redirect('/profile');

                }else{
                    return redirect('/profile');
                }
            }

        }else{
            return redirect('/');
        }
    }

    public function comment(Request $request)
    {
        $email = session()->get('email');

        if ($email) {

            $post_id = $request->input('post_id');
            
            session()->put('session_comment_post_id', $post_id);
            //$session_comment_post_id = session()->get('session_comment_post_id');
            $comment_user_id = $request->input('comment_user_id');
            $comment = $request->input('comment');
            $comment_user_fname = $request->input('comment_user_fname');
            $comment_user_lname = $request->input('comment_user_lname');

            $insert_comment_data = "INSERT INTO comment (post_id,user_id,comment_data,user_fname,user_lname) VALUES('$post_id','$comment_user_id','$comment','$comment_user_fname','$comment_user_lname')";
            $run_comment_data = DB::select($insert_comment_data);
            
            return $post_id;
        } else {
            return redirect('/');
        }
        

    }

    public function commentEdit(Request $request){
        $comment_data = $request->input('comment-data');
        $comment_id = $request->input('comment-id');
        session()->put('comment_id', $comment_id);
        $user_id = $request->input('user-id');

        
        $update_data = "UPDATE comment SET comment_data='$comment_data' WHERE id=$comment_id AND user_id=$user_id  ";
        $run_update_data = DB::select($update_data);

        return $comment_id;

        //return redirect('/profile');

    }

    

    public function deletepost($id){
        $delete_post = "DELETE FROM userpost WHERE id=$id ";
        $run_delete_post = DB::select($delete_post);
        return redirect('/findPeople');
    }

    public function findpeoplecomment(Request $request){
        $comment_data = $request->input('comment_data');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $user_fname = $request->input('user_fname');
        $user_lname = $request->input('user_lname');

        $insert_data = "INSERT INTO comment (post_id,user_id,user_fname,user_lname,comment_data) VALUES ('$post_id','$user_id','$user_fname','$user_lname','$comment_data')";
        $run_data = DB::select($insert_data);

        return redirect('/findPeople');

    }

    public function profileLike(Request $request)
    {
        $email = session()->get('email');
        if($email){
            $post_id = $request->input('post_id');
            session()->put('session_post_id', $post_id);

            $get_data = "SELECT * FROM signup WHERE email = '$email' ";
            $run_data = DB::select($get_data);
            $data = $run_data;

            foreach($data as $item)
            {
                $user_id = $item->id;
                $user_fname = $item->fname;
                $user_lname = $item->lname;

                $get_check_like_data = "SELECT * FROM likedata WHERE user_id=$user_id AND post_id=$post_id ";
                $run_check_like_data = DB::select($get_check_like_data);
                $count = count($run_check_like_data);

                if($count==0){

                    $insert_data = "INSERT INTO likedata (user_id,user_fname,user_lname,post_id) VALUES ('$user_id','$user_fname','$user_lname','$post_id')";
                    $run_data = DB::select($insert_data);
        
                    return $post_id;

                }else{
                    return "Already Liked";
                }
                
                
            }

           

        }else{
            return redirect('/');
        }
        
        
    }

    public function LikeAjax(){
        return view('LikeAjax');
    }

    public function CommentAjax(){
        return view('CommentAjax');
    }

    public function CommentDeleteAjax(Request $request)
    {
        $target_id = $request->input('modal_post_comment_id');

        $get_delete_data = "DELETE FROM comment WHERE id=$target_id";
        $run_delete_data = DB::select($get_delete_data);
        return $target_id;

        
    }

    public function commentDelete(Request $request)
    {
        $target_id = $request->input('comment_id');
        $get_delete_data = "DELETE FROM comment WHERE id=$target_id ";
        $run_delete_data = DB::select($get_delete_data);
        return $target_id;
    }

    public function EditAjax()
    {
        return view('EditAjax');
    }

    public function SenderPost(Request $request)
    {
        $sender_id = $request->input('sender_id');
        $sender_fname = $request->input('sender_fname');
        $sender_lname = $request->input('sender_lname');
        $sender_data = $request->input('sender_data');
        $receiver_id = $request->input('receiver_id');
        $receiver_fname = $request->input('receiver_fname');
        $receiver_lname = $request->input('receiver_lname');

        session()->put('chat_receiver_id', $receiver_id);

        $insert_sender_data = "INSERT INTO chat (sender_id, sender_fname, sender_lname, sender_data, receiver_id, receiver_fname, receiver_lname) VALUES('$sender_id','$sender_fname', '$sender_lname', '$sender_data', '$receiver_id', '$receiver_fname', '$receiver_lname')";
        $run_sender_data = DB::select($insert_sender_data);

       // return redirect('/profile');
       return $receiver_id;
    }

    public function AjaxSenderPost()
    {
        return view('AjaxSenderPost');
    }

    public function AjaxReceiverPost()
    {
        return view('AjaxReceiverPost');
    }

    public function passwordChange(Request $request)
    {
        
        $session_email = session()->get('email');
        $current_password = $request->input('current_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        $new_password_length = strlen($new_password);

        $get_data = "SELECT * FROM signup WHERE email = '$session_email' ";
        $run_data = DB::select($get_data);
        $data = $run_data;

        foreach($data as $item)
        {
            $password = $item->password;
            $session_id = $item->id;

            if($password==$current_password)
            {
                $new_password_length = strlen($new_password);

                 if($new_password_length > 5)
                 {
                     if($new_password == $confirm_password)
                     {
                         $update_password = "UPDATE signup SET password='$new_password' WHERE id=$session_id ";
                         $run_update_password = DB::select($update_password);

                         return "Password Updated Successfully";
                     }else{
                         return "confirmPassword";
                     }

                 }else{
                     return "newPassword";
                 }

            }else{

                return "currentPassword";

            }
        }

        
        
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        //return $password;
        $passwordLength = strlen($password);

        $check_email = "SELECT * FROM signup WHERE email='$email' ";
        $run_email = DB::select($check_email);
        $count = count($run_email);


        if($count > 0)
        {
            if($passwordLength > 5){

                $update_password = "UPDATE signup SET password='$password'  WHERE email='$email' ";
                $run_password = DB::select($update_password);

                echo '

                <script>
                   alert("Update your password");
                </script>
                
                ';
                return view ('Index');
           
            }else{

                echo '

            <script>
               alert("Password set not correct");
            </script>
            
            ';
            return view ('Index');


            }

        }else{

            echo '

            <script>
               alert("Email not found");
            </script>
            
            ';
            return view ('Index');

        }

    }

   





    

   

   

   

}
