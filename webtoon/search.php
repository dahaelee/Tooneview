<html>

<head>
    <meta charset="utf-8">
    <title> home </title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body onload="init()">
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
                        <a href='logout.php'><img src='logout.png' width='40' height='40'></a>
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
        <button class="tab"><a href="search.php"></a><img src="search.png" width="22.5" height="22.5"></button>

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
                <li><a href="platform.php?query=naver">네이버</a></li>
                <li><a href="platform.php?query=daum">다음</a></li>
                <li><a href="platform.php?query=lezhin">레진코믹스</a></li>
            </ul>
        </div>

        <div id="Age" class="content">
            <ul id=tab_list>
                <li><a href="age.php?query=10">10대</a></li>
                <li><a href="age.php?query=20">20대</a></li>
                <li><a href="age.php?query=30">30대</a></li>
            </ul>
        </div>
<!--------------------------------------------------------------->
       <div id="container">
            <div id="login_content">
                <form action="search-result.php" method="post">
                     
    <table>
        <tr>
            <td>
                <select name="searchType" id="searchType"  />
                <option value="title">제목</option>
                <option value="artist">작가</option>
            </td>
            <td>
                &nbsp<input type="text" id="searchWord" placeholder="검색어를 입력하세요." name="searchWord" maxlength="30" size="30" />
            </td>
            </tr>
        <tr>
            <th colspan="2">
                <button class=btn type="submit" >검색</button>
            </th>
        </tr>
                    </table>                     

         </form>

            </div>
        </div>
        
        <section>
            <h1>  </h1>
            <?php
                       
@$db = mysqli_connect('localhost', 'root', 'king', 'first');
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }
        
        $query = "select * from webtoon_info where genre = 'comic'";
            //select webtoon_id from webtoon_info where genre like '%일상%';
        $result=mysqli_query($db, $query);
        $row=mysqli_fetch_array($result);


     $db->close();
            ?>
        </section>

        <footer id="main_footer"> 통합형 리뷰 포럼 웹 어플리케이션, tooneview </footer>
    </div>

    
</body>

</html>
