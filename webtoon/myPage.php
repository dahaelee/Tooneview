<?php session_start(); ?>
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
            color: #ff7a1b;
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
            .rtb2{
                text-align: center;
            }
            
        .star_select {
            width: 70px;
            padding: inherit;
        }
            .ftable{
                border-collapse: separate;
  border-spacing: 0 20px;
                margin:0;
                padding:0;
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
                    if($_SESSION['user_id']==$_GET['hostID']){
                        echo "<table>
                <tr>
                    <td>
                        <a href='leave.php?hostID=$_SESSION[user_id]'>회원탈퇴</a>
                    </td>
                    <td>
                        <a href='logout.php'><img src='logout.png' width='40' height='40'></a>
                    </td>
                </tr>
                
                </table> ";
                    }
                    else{
                        echo "<table>
                <tr>
                    <td>
                        <a href='mypage.php?hostID=$_SESSION[user_id]'><img src='profile.png' width='40' height='40'></a>
                    </td>
                    <td>
                        <a href='logout.php'><img src='logout.png' width='40' height='40'></a>
                    </td>
                </tr>
                
                </table> ";
                    }
                }
            ?>
            </div>
        </header>
        

        <section id="main_section">
            <table id=mypageTable>
                <table>
            <tr width='500'>
                <th width='150'>
            <img src="profile.png" width = "100"height = "100">
                </th>
                <th width="250">
                     <?php
                    $db = mysqli_connect('localhost', 'root', 'king', 'first');
                    $hostID = $_GET["hostID"];
                    $document_root = $_SERVER['DOCUMENT_ROOT']; 
                    $query="select * from user_info where user_id='$hostID'";
                    $result=mysqli_query($db,$query);
                    $row=mysqli_fetch_array($result);
                    echo '닉네임 : '.$row['user_name'].'<br>';
                    $query="select * from webtoon_review where user_id='$hostID';";
                    $result=mysqli_query($db, $query);
                    echo "게시물 ".$result->num_rows;
                    $query="select * from follow where followee_id='$hostID';";
                    $result=mysqli_query($db, $query);
                    echo " 팔로워 ".$result->num_rows;
                    $query="select * from follow where follower_id='$hostID';";
                    $result=mysqli_query($db, $query);
                    echo " 팔로잉 ".$result->num_rows;
                    
                    
                    $loginUser=$_SESSION['user_id'];
                    ////////////팔로우버튼 구분하기//////////////////
                    $query="select * from follow where follower_id='$loginUser' and followee_id='$hostID'"; 
                    $result=mysqli_query($db,$query);
                    if($_SESSION['user_id']!=$hostID){
                    if($result->num_rows>0){
                        echo "<a href='follow-delete.php?hostID=$hostID'><button class=btn>팔로우 취소</button></a>";
                    }
                    else{
                    echo "<a href='follow-insert.php?hostID=$hostID'><button class=btn>팔로우</button></a>";
                    }
                    }
                    
                    
                    $db->close();
                    $db = mysqli_connect('localhost', 'root', 'king', 'first');
                
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        $hostID = $_GET["hostID"];
        //table 시작
        echo "<table class=ftable><tr width='300'>";
        echo "<td class=rtb width='100'> 팔로워 목록 </td>";
        echo "<td class=rtb width='100'> 팔로잉 목록 </td></tr>";
        $query="select * from follow where followee_id='$hostID';";
        $result=mysqli_query($db, $query);
        echo "<tr>";
        echo "<td class=rtb2 width='100'>";
        if($result->num_rows==0){
             echo "팔로워 목록이 없습니다.";
        }
        else{
            
            while($row=$result->fetch_array()){
                $url="myPage.php?hostID=$row[follower_id]";
                echo "<a href=$url style='cursor:pointer;'>";
                echo "$row[follower_name]";
                echo "</a>";
                echo "<br>";
            }
            
        }
        echo "</td>";
        //////////////////팔로잉 목록
        $query2="select * from follow where follower_id='$hostID';";
        $result2=mysqli_query($db, $query2);
        echo "<td class=rtb2 width='100'>";
        if($result2->num_rows==0){
            echo "팔로잉 목록이 없습니다.";
        }
        else{
            while($row=$result2->fetch_array()){
                 $url="myPage.php?hostID=$row[followee_id]";
                echo "<a href=$url style='cursor:pointer;'>$row[followee_name]</a><br>";
            }
        }
                    
        echo "</tr></table>";
                    ?>
                </th>
                </tr>
                    </table>
            </table>
        </section>
        <?php
        
        ///////리뷰 보여주는 곳/////////////
        $db = mysqli_connect('localhost', 'root', 'king', 'first');
                
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br/>
            Please try again later.</p>';
            exit;
        }
        $query="select * from webtoon_review where user_id='$hostID' order by review_date desc";
                
        $result=$db->query($query);
                

    while($row=$result->fetch_array()){
        $sql="select * from webtoon_info where webtoon_id='$row[webtoon_id]'";
        $result2=$db->query($sql);
        $row2=$result2->fetch_array();
              $rate_percentage=$row['rate']*20;
        $url = "location.href='review_main.php?toonID=$row2[webtoon_id]'";
      echo "<table id=review_table><tr>";
      echo "<td class=rtb onClick=location.href=$url style='cursor:pointer;' width=250>$row2[webtoon_name]</td>";
      echo "<td width=30></td><td width=50>
            <div style='CLEAR:both;	PADDING-RIGHT:0px;	PADDING-LEFT:0px; BACKGROUND:url(icon_star2.gif) 0px 0px; FLOAT:left; PADDING-BOTTOM: 0px; MARGIN:0px; WIDTH: 90px; PADDING-TOP:0px; HEIGHT:18px;'>
	       <p style='WIDTH:$rate_percentage%; PADDING-RIGHT:0px;	PADDING-LEFT:0px; BACKGROUND: url(icon_star.gif) 0px 0px; PADDING-BOTTOM:0px; MARGIN:0px; PADDING-TOP:0px;	HEIGHT: 18px;'>
	       </p>
	       </div>
      </td>";    
      echo "<td width=250 align=center>$row[review_date]</td>";
        if(isset($_SESSION['user_id'])){
            if(strcmp($_SESSION['user_id'],$row['user_id'])==0){
                echo "<td class=rtb width=100><a href='review_delete2.php?review_id=$row[review_id]&hostID=$hostID'>삭제</a></td></tr>";
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