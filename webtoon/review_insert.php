<?php session_start(); ?>
    <?php
	$conn = mysqli_connect("localhost","root","king");
	$db = mysqli_select_db($conn,"first");	
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['nickname'];
    $sql = "INSERT INTO webtoon_review VALUES( NULL , 1 , '$user_id' ,'$user_name', '$_POST[starpoint]',NULL ,'$_POST[content]')";
    $conn->query($sql);
    echo "<script>alert('글이 등록되었습니다.');";

    echo "location.href='review_main.php';</script>";

     ?>