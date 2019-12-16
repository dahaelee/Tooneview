<?php session_start(); ?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title> home </title>

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

    <?php
    $webtoon_id = $_GET["toonID"];
   $conn = mysqli_connect("localhost","root","king");
   $db = mysqli_select_db($conn,"first");   
   $sql = "SELECT * FROM webtoon_review WHERE webtoon_id=$webtoon_id ORDER BY review_id DESC";
   $result = $conn->query($sql) or die($this->_connect->error);
    ?>

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
                        <a href='logout.php'>로그아웃</a>
                    </td>
                </tr>
                
                </table> ";
                }
            ?>
            </div>
        </header>

        <button id="default" class="tab" onclick="openMenu('Genre', this)">장르</button>
        <button id="platform" class="tab" onclick="openMenu('Platform', this)">플랫폼</button>
        <button id="age" class="tab" onclick="openMenu('Age', this)">연령대</button>
        <button class="tab"><a href="search.html"></a><img src="search.png" width="23" height="23"></button>

        <div id="Genre" class="content">
            <ul id=tab_list>

                <li><a href="genre.php?query=일상">일상</a></li>
                <li><a href="genre.php?query=개그">개그</a></li>
                <li><a href="genre.php?query=판타지">판타지</a></li>
                <li><a href="genre.php?query=액션">액션</a></li>
                <li><a href="genre.php?query=드라마">드라마</a></li>
                <li><a href="genre.php?query=순정">순정</a></li>
                <li><a href="genre.php?query=감성">감성</a></li>
                <li><a href="genre.php?query=스릴러">스릴러</a></li>
                <li><a href="genre.php?query=시대극">시대극</a></li>
                <li><a href="genre.php?query=스포츠">스포츠</a></li>
            </ul>
        </div>

        <div id="Platform" class="content">
            <ul id=tab_list>
                <li><a href="platform.php?query=네이버">네이버</a></li>
                <li><a href="platform.php?query=다음">다음</a></li>
                <li><a href="platform.php?query=레진코믹스">레진코믹스</a></li>
            </ul>
        </div>

        <div id="Age" class="content">
            <ul id=tab_list>
                <li><a href="age.php?query=10">10대</a></li>
                <li><a href="age.php?query=20">20대</a></li>
                <li><a href="age.php?query=30">30대</a></li>
            </ul>
        </div>

        <section id="main_section">

		<?php

@$db = mysqli_connect('localhost', 'root', 'king', 'first');
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }
        
        $query = "select * from webtoon_info where webtoon_id = $webtoon_id";
$web_info=mysqli_query($db, $query);
        $row=mysqli_fetch_array($web_info);
            
	$name = $row["webtoon_name"];
	$img_src = $row["img_src"];
	$artist = $row["artist"];
	$description = $row["description"];
	$platform = $row["platform"];
	echo "<img src = $img_src>";
	echo "<h1><br><font size='6'>$name</font><br></h1>";
	echo "<p text align='center'><b><font size='4'>$description</font></b></p>";



?>

        </section>

        <?php
        if(isset($_SESSION["user_id"])) { 
            $nickname=$_SESSION["nickname"];
            echo"
        <form action='review_insert.php?toonID=$webtoon_id' method='post' >
            <table id='review_table'>
                <tr>
                    <td class='rtb' width='80' align=center>닉네임</td>
                    <td width='100' align=center> $nickname </td>
                    <td class='rtb' width='80' align=center>별점</td>
                    <td width='100' align=center>
                        <select class='star_select' name='starpoint'>
                            <option value='5'>5점</option>
                            <option value='4'>4점</option>
                            <option value='3'>3점</option>
                            <option value='2'>2점</option>
                            <option value='1'>1점</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <textarea class='review_text' placeholder='내용을 입력하세요' name='content' rows='8' cols='85'></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4 align=right><input type='submit' value='등록'></td>
                </tr>    
            </table>
        </form>";}
        
        else echo "<table id='review_table'><tr><td><font color=#fac706>리뷰를 작성하시려면 로그인하세요.</font></tr></td></table>";
        ?>

        <?php       
        $ord_array = array('desc','asc'); 
        $ord_arrow = array('▼','▲'); 
        $ord = isset($_REQUEST['ord']) && in_array($_REQUEST['ord'],$ord_array) ? $_REQUEST['ord'] : $ord_array[1]; // 지정된 정렬이면 그 값, 아니면 기본 정렬(오름차순)
        $ord_key = array_search($ord,$ord_array); // 해당 키 찾기 (0, 1)
        if($ord_key==1){
            $sql = "SELECT * FROM webtoon_review WHERE webtoon_id=$webtoon_id ORDER BY rate DESC";
            $result = $conn->query($sql) or die($this->_connect->error);}
        else{
            $sql = "SELECT * FROM webtoon_review WHERE webtoon_id=$webtoon_id ORDER BY rate ASC";
            $result = $conn->query($sql) or die($this->_connect->error);}
        $ord_rev = $ord_array[($ord_key+1)%2]; // 내림차순→오름차순, 오름차순→내림차순
        ?><a href="?ord=<?php echo $ord_rev; ?>">별점순<?php echo $ord_arrow[$ord_key]; ?></a>
       
        <?php       
        $ord_array = array('desc','asc'); 
        $ord_arrow = array('▼','▲'); 
        $ord = isset($_REQUEST['ord']) && in_array($_REQUEST['ord'],$ord_array) ? $_REQUEST['ord'] : $ord_array[0]; // 지정된 정렬이면 그 값, 아니면 기본 정렬(내림차순)
        $ord_key = array_search($ord,$ord_array); // 해당 키 찾기 (0, 1)
        if($ord_key==0){
            $sql = "SELECT * FROM webtoon_review WHERE webtoon_id=$webtoon_id ORDER BY review_id DESC";
            $result = $conn->query($sql) or die($this->_connect->error);}
        else{
            $sql = "SELECT * FROM webtoon_review WHERE webtoon_id=$webtoon_id ORDER BY review_id ASC";
            $result = $conn->query($sql) or die($this->_connect->error);}
        $ord_rev = $ord_array[($ord_key+1)%2]; // 내림차순→오름차순, 오름차순→내림차순
        ?><a href="?ord=<?php echo $ord_rev; ?>">등록일순<?php echo $ord_arrow[$ord_key]; ?></a>
        <?php
    while($row=$result->fetch_array()){
      echo "<table id=review_table><tr>";
      echo "<td class=rtb width=100>$row[user_name]</td>";
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
?>

        <footer id="main_footer"> 통합형 리뷰 포럼 웹 어플리케이션, tooneview </footer>
    </div>

    <script>
        function init() {
            document.getElementById("default").onclick();
        }

        function openMenu(target, seltab) {
            var i, content, tab;
            content = document.getElementsByClassName("content");
            for (i = 0; i < content.length; i++) {
                content[i].style.display = "none";
            }
            document.getElementById(target).style.display = "block";
            tab = document.getElementsByClassName(seltab.className);
            for (i = 0; i < tab.length; i++) {
                tab[i].style.backgroundColor = "";
                tab[i].style.color = "white";
            }
            seltab.style.backgroundColor = "white";
            seltab.style.color = "#fac706";
        }

    </script>
</body>

</html>