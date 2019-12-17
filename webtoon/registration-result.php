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
    $userID=$_POST['userID'];
    $password=$_POST['password'];
    $nickname=$_POST['nickname'];
    $birthday=$_POST['birthday'];
    $sex=$_POST['sex'];
                
    if ($userID==NULL || $password==NULL || $nickname==NULL || $birthday==NULL || $sex==NULL) {
       echo "<p>모든 정보를 정확하게 입력해 주세요.<br />
             </p>";
       exit;
    }            
@$db = new mysqli('localhost', 'root', 'king', 'first');
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }
        
        $query = "INSERT INTO user_info VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $userID, $nickname,$password, $birthday, $sex);
    $stmt->execute();

        if ($stmt->affected_rows > 0) {
        echo  "<p>회원가입이 완료되었습니다.</p><br>";
        echo $nickname."님 환영합니다. 로그인 후 이용해주세요!";
    } else {
        echo "<p>An error has occurred.<br/>
              The item was not added.</p>";
    }


     $db->close();
        ?>
            </div>
            </div>
            </div>
</body>
</html>