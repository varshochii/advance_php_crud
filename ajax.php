
<?php 



 $action = $_REQUEST['action'];

 if(!empty($action)){
     require_once './partials/User.php';
     $obj = new User();
 }


 ////////// adding user action
 if($action == 'adduser' && !empty($_POST)){
   
     $name   = $_POST['username'];
     $email  = $_POST['email'];
     $mobile = $_POST['mobile'];
     $photo  = $_FILES['photo'];

     $userID = (!empty($_POST['userId'])) ? $_POST['userId'] : '';

     $imageName = "";
     if(!empty($photo['name'])){
        $imageName = $obj->uploadPhoto($photo);
        $userData  = [
            'name'   => $name,
            'email'  => $email,
            'mobile' => $mobile,
            'photo'  => $imageName
        ];
     }else{
        $userData  = [
            'name'   => $name,
            'email'  => $email,
            'mobile' => $mobile
        ];
     }


     ////// if there is id and id is not empty then it means we should edit user, otherwise id is empty then we need to add new user
     if($userID){

        $currentUser = $obj->getRow('id',$userID);
        if(!empty($photo['name'])){
            if(!empty($currentUser['photo'])){
                $obj->deletePhoto($currentUser['photo']);
            } 
        }

        $obj->update($userData,$userID);

     }else{
         $userID = $obj->add($userData);
     }


     if(!empty($userID)){
        $user = $obj->getRow('id',$userID);
        echo json_encode($user);
        exit();
     }


 }




 ////////// getcountof function and getallusers action 
 if($action == 'getallusers'){

     $page  = (!empty($_GET['page'])) ? $_GET['page'] : 1;
     $limit = 4;
     $start = ($page - 1) * $limit;

     $users = $obj->getRows($start,$limit);

     if(!empty($users)){
         $userlist = $users;
     }else{
        $userlist = [];
     }

     $total = $obj->getCount();

     $userArr = ['count' => $total,'users' => $userlist];
     
     echo json_encode($userArr);
    //  echo json_encode($userlist);
     exit();
 }




 ///////////// action to perform editing 
 if($action == 'editusersdata'){

      $userId = (!empty($_POST['userId'])) ? $_POST['userId'] : ''; 

      if(!empty($userId)){
          
            $user = $obj->getRow('id',$userId);
            echo json_encode($user);
            exit();
      }
 }



 /////////// perform deleting 
 if($action == 'deleteUser'){

    $userId = (!empty($_POST['userId'])) ? $_POST['userId'] : ''; 

    if(!empty($_POST['userId'])){

        $currentUser = $obj->getRow('id',$userId);
        $photoName = '';
        if(!empty($currentUser['photo'])){
            $photoName = $currentUser['photo'];
        } 

        $isDeleted = $obj->deleteUser($userId);

        if($isDeleted){
            $obj->deletePhoto($photoName);
            $displayMessage = ['delete'=> 1];
        }else{
            $displayMessage = ['delete'=> 0];
        }

        echo json_encode($displayMessage);
        exit();
    }

 }



 /////////////// for searching 
 if($action == 'searchuser'){

      $queryString = (!empty($_POST['searchQuery'])) ? trim($_POST['searchQuery']) : '';
      $results = $obj->searchUser($queryString);
      echo json_encode($results);
      exit();
         
 }




?>