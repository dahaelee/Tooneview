<html>
<?php session_start(); ?>
<head>
    <meta charset="utf-8">
    <title> home </title>
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
        <a href="search.php"><button class="tab"><img src="search.png" width="22.5" height="22.5"></button></a>

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
            <h1> 최근에 리뷰된 웹툰 </h1>
            <a class="article" href="review_main.php">
                <p>
                    리뷰내용
                </p>
            </a>
            <a class="article" href="리뷰링크여기에넣기">
                <p>
                    리뷰내용
                </p>
            </a>
            <a class="article" href="리뷰링크여기에넣기">
                <p>
                    리뷰내용
                </p>
            </a>
            <a class="article" href="리뷰링크여기에넣기">
                <p>
                    리뷰내용
                </p>
            </a>
            <a class="article" href="리뷰링크여기에넣기">
                <p>
                    리뷰내용
                </p>
            </a>
        </section>

   <?php
   $conn = mysqli_connect("localhost","root","king");
   $db = mysqli_select_db($conn,"first");
    
      echo "<table><tr>";
        
      $sql = "select table1.webtoon_id as webtoon_id, table1.img_src as thumbnail, table1.webtoon_name as title from (select * from webtoon_info) as table1 inner join (select webtoon_id, AVG(rate) as avg_rate from webtoon_review where Date(review_date) =curdate() group by webtoon_id ) as table2 on table1.webtoon_id = table2.webtoon_id order by table2.avg_rate desc;";
      $result = $conn->query($sql) or die($this->_connect->error);    
    
      echo "<th><section id='main_aside'><h1> TODAY 순위 </h1><table class='rank_table'>";
      $today_count=1;
      while($row=$result->fetch_array()){ 
      if($today_count<=10){
      $url = "location.href='review_main.php?toonID=$row[webtoon_id]'";
      echo "<tr onClick=$url style='cursor:pointer;'>
            <td width='30'><font color=#fac706>$today_count</font></td>
            <td><img src=$row[thumbnail] width='50' height='50'></td>
            <td>$row[title]</td>
            </tr></a>";
      $today_count=$today_count+1;
      }
      }
      echo"</table></section></th>";
        
        $sql = "select table1.webtoon_id as webtoon_id, table1.img_src as thumbnail, table1.webtoon_name as title from (select * from webtoon_info) as table1 inner join (select webtoon_id, AVG(rate) as avg_rate from webtoon_review where Date(review_date) =curdate() group by webtoon_id ) as table2 on table1.webtoon_id = table2.webtoon_id order by table2.avg_rate desc;";
        $result = $conn->query($sql) or die($this->_connect->error);
        
      echo "<th><section id='main_aside'><h1> WEEKLY 순위 </h1><table class='rank_table'>";
      $weekly_count=1;
      while($row=$result->fetch_array()){ 
      if($weekly_count<=10){
      $url = "location.href='review_main.php?toonID=$row[webtoon_id]'";
      echo "<tr onClick=$url style='cursor:pointer;'>
            <td width='30'><font color=#fac706>$weekly_count</font></td>
            <td><img src=$row[thumbnail] width='50' height='50'></td>
            <td>$row[title]</td>
            </tr>";
      $weekly_count=$weekly_count+1;
      }
      }
      echo"</table></section></th>";
        
      echo"</tr></table>";
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
