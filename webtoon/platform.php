<html>

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
                <li><a href="age_10.html">10대</a></li>
                <li><a href="age_20.html">20대</a></li>
                <li><a href="age_30.html">30대</a></li>
            </ul>
        </div>
        <!--------------------------------------------------------------->
        <section>
            <h1> </h1>
            <?php
                       $platform = $_GET["query"];
	echo $platform;
            @$db = mysqli_connect('localhost', 'root', 'king', 'first');
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }
        
        $query = "select * from webtoon_info where platform like '%$platform%'";
        $result=mysqli_query($db, $query);
        $row=mysqli_fetch_array($result);
            $resultArr=array();
            while($r=mysqli_fetch_assoc($result)){
                $resultArr[]=$r;
            }
            
        $webtoon_name=$row['webtoon_name'];
            $i=$result->num_rows;
	echo $i;
	echo count($resultArr);
            for($count=0;$count<count($resultArr);$count++){
                $resulta=$resultArr[$count];
                $name= $resulta["webtoon_name"];
   $img_src = $resulta["img_src"];
   $artist = $resulta["artist"];
                $webtoon_id=$resulta["webtoon_id"];
                echo " <a class='article' href='review_main.php?toonID=$webtoon_id' width='300' height='130'>
                <p>
      <img src=$img_src width = '100' height='100'>
                   $name
      <p style='text-align:right'>
      $artist
      </p>
                </p>
            </a>";    
                 echo "<br/>";  
            }            


     $db->close();
            ?>
        </section>

        <footer id="main_footer"> 통합형 리뷰 포럼 웹 어플리케이션, tooneview </footer>
    </div>

    <script>
        function init() {
            document.getElementById("platform").onclick();
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