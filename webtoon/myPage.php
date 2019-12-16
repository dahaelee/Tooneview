﻿<?php session_start(); ?>
<html>

<head>
    <meta charset="utf-8">
    <title> myPage </title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body onload="init()">
        <style>
        a:link {
            color: black;
            text-decoration: none;
        }

        a:visited {
            color: black;
            text-decoration: none;
        }

        a:hover {
            color: #fac706;
            text-decoration: none;
        }

        #review_table {
            border: 1px solid #999999;
            width: 600;
            padding: 10px;
            padding-left: 10px;
            padding-right: 10px;
            margin: 0 0 20 0;
        }

        #review_table td {
            padding: 3px;
        }


        .review_text {
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .rtb {
            border: 1px solid #999999;
            text-align: center;
        }

        .star_select {
            width: 70px;
            padding: inherit;
        }

    </style>
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
                        <a href='mypage.php'><img src='profile.png' width='40' height='40'></a>
                    </td>
                    <td>
                        <a href='logout.php'><img src='logout.png' width='40' height='40'></a>
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
        <?php
        $db = mysqli_connect('localhost', 'root', 'king', 'first');
                
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        $userID=$_SESSION['user_id'];
        $query="select * from webtoon_review where user_id='$userID' order by review_date desc";
                
        $result=$db->query($query);
                

    while($row=$result->fetch_array()){
        $sql="select * from webtoon_info where webtoon_id='$row[webtoon_id]'";
        $result2=$db->query($sql);
        $row2=$result2->fetch_array();
      echo "<table id=review_table><tr>";
      echo "<td class=rtb width=100>$row2[webtoon_name]</td>";
      echo "<td width=120 align=center><font color=#fac706>$row[rate]점</font></td>";    
      echo "<td width=250 align=center>$row[review_date]</td>";
        if(isset($_SESSION['user_id'])){
            if(strcmp($_SESSION['user_id'],$row['user_id'])==0){
                echo "<td class=rtb width=100><a href='review_delete.php?review_id=$row[review_id]'>삭제</a></td></tr>";
            }
        }
      echo "<tr><td colspan=5>$row[review_content]</td>";
      echo "</tr></table>";
    }

                
        $db->close();

        ?>
    </div>
    <script>
        
    </script>
</body>

</html>