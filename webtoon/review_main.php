<?php session_start(); ?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title> home </title>

</head>

<body onload="init()">

    <style>

a:link { color: black; text-decoration: none;}
a:visited { color: black; text-decoration: none;}
a:hover { color: #fac706; text-decoration: none;}

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
	$conn = mysqli_connect("localhost","root","king");
	$db = mysqli_select_db($conn,"first");	
	$sql = "SELECT * FROM webtoon_review ORDER BY webtoon_id DESC";
	$result = $conn->query($sql) or die($this->_connect->error);
    ?>

    <div id="wrapper">
        <header id="main_header">
            <a href="home.php"><img src="logo.png" width="144" height="93"></a>
            <div id="mypage"><a href="login.html"><img src="profile.png" width="40" height="40"></a></div>
        </header>

        <button id="default" class="tab" onclick="openMenu('Genre', this)">장르</button>
        <button id="platform" class="tab" onclick="openMenu('Platform', this)">플랫폼</button>
        <button id="age" class="tab" onclick="openMenu('Age', this)">연령대</button>
        <button class="tab"><a href="search.html"></a><img src="search.png" width="22.5" height="22.5"></button>

        <div id="Genre" class="content">
            <ul id=tab_list>
                <li><a href="genre_ilsang.php">일상</a></li>
                <li><a href="genre_gag.html">개그</a></li>
                <li><a href="genre_fantasy.html">판타지</a></li>
                <li><a href="genre_action.html">액션</a></li>
                <li><a href="genre_drama.html">드라마</a></li>
                <li><a href="genre_soonjeong.html">순정</a></li>
                <li><a href="genre_gamseong.html">감성</a></li>
                <li><a href="genre_thriller.html">스릴러</a></li>
                <li><a href="genre_sidae.html">시대극</a></li>
                <li><a href="genre_sports.html">스포츠</a></li>
            </ul>
        </div>

        <div id="Platform" class="content">
            <ul id=tab_list>
                <li><a href="platform_naver.html">네이버</a></li>
                <li><a href="platform_daum.html">다음</a></li>
                <li><a href="platform_lezhin.html">레진코믹스</a></li>
                <li><a href="platform_bom.html">봄툰</a></li>
            </ul>
        </div>

        <div id="Age" class="content">
            <ul id=tab_list>
                <li><a href="age_10.html">10대</a></li>
                <li><a href="age_20.html">20대</a></li>
                <li><a href="age_30.html">30대</a></li>
            </ul>
        </div>

        <section id="main_section">
            <h1>웹툰 정보</h1>
        </section>

        <form action="review_insert.php" method="post">
            <table id="review_table">
                <tr>
                    <td class="rtb" width="80" align=center>닉네임</td>
                    <td width="100" align=center><?php echo $_SESSION['user_id'] ?></td>
                    <td class="rtb" width="80" align=center>별점</td>
                    <td width="100" align=center>
                        <select class="star_select" name="starpoint">
                            <option value="5">5점</option>
                            <option value="4">4점</option>
                            <option value="3">3점</option>
                            <option value="2">2점</option>
                            <option value="1">1점</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=4>
                        <textarea class="review_text" placeholder="내용을 입력하세요" name="content" rows="8" cols="85"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4 align=right><input type="submit" value="등록"></td>
                </tr>
            </table>
        </form>
        </br>
        <?php
    while($row=$result->fetch_array()){
      echo "<table id=review_table><tr>";
      echo "<td class=rtb width=80>No. $row[webtoon_id]</td>";
      echo "<td width=200 align=center>$row[user_name]</td>";
      echo "<td width=300 align=center>$row[review_date]</td>";
      echo "<td class=rtb width=50><a href='modifycheck.php?id=$row[webtoon_id]'>수정</a></td>";
      echo "<td class=rtb width=50><a href='delete.php?id=$row[webtoon_id]'>삭제</a></td></tr>";
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
