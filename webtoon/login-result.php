<!DOCTYPE html> 
<html>
<head>
    <meta charset="utf-8">

<title> Log in </title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <header id="main_header"><a href="home.php"><img src="logo.png" width = "162.75"height = "105"></a></header>
        <div id="container">
            <div id="login_content">
 <?php 

// create short variable names
                session_start();
    $userID=$_POST['userID'];
    $password=$_POST['password'];
                
                 if ($userID==NULL || $password==NULL) 
           {
       echo "<p>아이디와 비밀번호 모두 입력해주세요.</p>";
       exit;
    }
        $db = mysqli_connect('localhost', 'root', 'king', 'first');
                
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        
        $query="select * from user_info where user_id='$userID'";
                
        $result=$db->query($query);
                
        if($result->num_rows==1){
            $row=$result->fetch_array(MYSQLI_ASSOC);//하나의 열을 배열로 가져오기
            if($row['user_pw']==$password){
                $_SESSION['user_id']=$userID;
                $_SESSION['nickname']=$row['user_name'];
                if(isset($_SESSION['user_id'])){
                    header('Location: home.php');
                }
                else{
                    echo "세션 저장 실패";
                }
            }
            else{
                echo "id와 비밀번호를 정확히 입력해주세요.";
            }
            
        }
                else{
                    echo "id와 비밀번호를 정확히 입력해주세요.";
                }
                
        $db->close();

        ?>
            </div>
            </div>
            </div>
</body>
</html>