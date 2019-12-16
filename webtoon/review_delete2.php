<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>

    <script>
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            return results[2];
        }
        var review_id = getParameterByName("review_id");
        document.getElementById("head").innerHTML = id;

    </script>
    <?php
    $hostID = $_GET["hostID"];
	$conn = mysqli_connect("localhost","root","king");
	$db = mysqli_select_db($conn,"first");	
    $sql="DELETE FROM webtoon_review WHERE review_id='$_GET[review_id]'";
    $result=$conn->query($sql);

      echo "<script>alert('글이 삭제되었습니다');";
      echo "location.href='myPage.php?hostID=$hostID'</script>";

     ?>

</body>

</html>
