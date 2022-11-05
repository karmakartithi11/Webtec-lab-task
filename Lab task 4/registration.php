<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Signup</title>  
      </head>  
      <body>                              
<form method="post" action="">  
<?php   
 include 'Home.php';
 $message = $error = '';  
 if(isset($_POST["submit"]))  
 {  
      if(empty($_POST["name"]))  
      {  
           $error = "Enter Name";  
      }
      else if(empty($_POST["email"]))  
      {  
           $error = "Enter an e-mail";  
      }  
      else if(empty($_POST["username"]))  
      {  
           $error = "Enter a username";  
      }  
      else if(empty($_POST["password"]))  
      {  
           $error = "Enter a password";  
      }
      else if(empty($_POST["Cpass"]))  
      {  
           $error = "Confirm password field cannot be empty";  
      } 
      else if(empty($_POST["gender"]))  
      {  
           $error = "Gender cannot be empty";  
      } 
       
      else  
      {  
           if(file_exists('credentials.json'))  
           {  
                $current_data = file_get_contents('credentials.json');  
                $array_data = json_decode($current_data, true);  
                $extra = array(  
                     'name'               =>     $_POST['name'],  
                     'e-mail'          =>     $_POST["email"],  
                     'username'     =>     $_POST["username"], 
                     'password'        =>     $_POST["password"], 
                     'gender'     =>     $_POST["gender"],  
                     'dob'     =>     $_POST["dob"]  
                );  
                $array_data[] = $extra;  
                $final_data = json_encode($array_data);  
                if(file_put_contents('credentials.json', $final_data))  
                {  
                     $message = "Account registered successfully";
                }  
           }
           else
           {  
                $error = 'JSON File not exists';  
           }  
      }  
 } 
      if(isset($error))  
     {  
          echo $error;  
     }  
 
 ?>  
     <fieldset>
     <legend>REGISTRATION</legend> 
     <label>Name</label>  
     <input type="text" name="name"><br><br>  
     <label>E-mail</label>
     <input type="email" name = "email" ><br><br>
     <label>User Name</label>
     <input type="text" name = "username"><br><br>
     <label>Password</label>
     <input type="password" name = "password"><br><br>
     <label>Confirm Password</label>
     <input type="password" name = "Cpass"><br><br>

     <legend>Gender</legend>
     <input type="radio" id="male" name="gender" value="male">
     <label for="male">Male</label>                     
     <input type="radio" id="female" name="gender" value="female">
     <label for="female">Female</label>
     <input type="radio" id="other" name="gender" value="other">
     <label for="other">Other</label><br><br>

     <legend>Date of Birth:</legend>
     <input type="date" name="dob"> <br><br>
     </fieldset> 
                     
     <input type="submit" name="submit" value="Submit" />
     <input type="reset" name="reset" value="Reset" /><br><br>                    
     <?php  
     if(isset($message))  
     {  
          echo $message;  
     }  
     ?>  
     </form>      
</body>  
</html>