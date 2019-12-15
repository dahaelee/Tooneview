<?php session_start(); ?>
<html>

<head>
    <meta charset="utf-8">
    <title> myPage </title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body onload="init()">
    <div id="wrapper">
        <header id="main_header">
            <a href="home.php"><img src="logo.png" width="144" height="93"></a>
            <div id="mypage">
                <?php
            if(!isset($_SESSION['user_id']) ) {
                echo '<a href="registration.php">회원가입 </a><a href="login.html"> 로그인</a>';
            }
                else{
                    echo "<table>
                <tr>
                    <td>
                        <a href='logout.php'>로그아웃</a>
                    </td>
                </tr>
                
                </table> ";
                }
            ?>
            </div>
        </header>
        

        <section id="main_section">
            <table id=mypageTable>
            <tr>
                <th>
            <img src="profile.png" width = "100"height = "100">
                </th>
                <th width="200">
                     <?php
                    $document_root = $_SERVER['DOCUMENT_ROOT']; 
                    echo 'id : '.$_SESSION['user_id']."<br>
                    ".'닉네임 : '.$_SESSION['nickname']."<br>";
                        echo "게시물 3  팔로워 104";
                    ?>
                </th>
                </tr>
            </table>
        </section>

    </div>
    <script>
        
    </script>
</body>

</html>