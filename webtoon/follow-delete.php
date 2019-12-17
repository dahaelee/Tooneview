<?php session_start(); ?>
    <?php
 $db = mysqli_connect('localhost', 'root', 'king', 'first');

if (mysqli_connect_errno()) {
echo '<p>Error: Could   not connect to database.<br/>
    Please try again later.</p>';
exit;} 
$hostID = $_GET["hostID"];
$myID=$_SESSION['user_id'];
$query="select * from follow where followee_id ='$hostID' and follower_id='$myID';";
$result=mysqli_query($db, $query);
$row=mysqli_fetch_array($result);
$followee_name=$row["followee_name"];
$query2="delete from follow where followee_id ='$hostID' and follower_id='$myID';";
if(mysqli_query($db, $query2)){
    echo "<script>alert('$followee_name 님을 팔로우 취소 했습니다.');";

    echo "location.href='myPage.php?hostID=$hostID';</script>";
}
echo "location.href='myPage.php?hostID=$hostID';</script>";
$db->close();
     ?>