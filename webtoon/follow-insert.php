<?php session_start(); ?>
    <?php
 $db = mysqli_connect('localhost', 'root', 'king', 'first');

if (mysqli_connect_errno()) {
echo '<p>Error: Could   not connect to database.<br/>
    Please try again later.</p>';
exit;} 
$hostID = $_GET["hostID"];
$query="select * from user_info where user_id ='$hostID';";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_array($result);
$follower_id = $_SESSION['user_id'];
$follower_name = $_SESSION['nickname'];
$followee_id=$row["user_id"];
$followee_name=$row["user_name"];
$query2="insert into follow values('$follower_id', '$follower_name', '$followee_id', '$followee_name')";
;
mysqli_query($db, $query2);
    echo "<script>alert('$followee_name 님을 팔로우 했습니다.');";

    echo "location.href='myPage.php?hostID=$hostID';</script>";
$db->close();
     ?>