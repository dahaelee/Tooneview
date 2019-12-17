<?php session_start(); ?>
    <?php
 $db = mysqli_connect('localhost', 'root', 'king', 'first');

if (mysqli_connect_errno()) {
echo '<p>Error: Could   not connect to database.<br/>
    Please try again later.</p>';
exit;} 
$hostID = $_GET["hostID"];
$query="delete from user_info where user_id ='$hostID';";
$result=mysqli_query($db, $query);
    echo "<script>alert('탈퇴를 완료했습니다.');";
    echo "location.href='home.php'</script>";
$res=session_destroy();

$db->close();
     ?>
