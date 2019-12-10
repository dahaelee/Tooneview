<html>
<!--search result & search & home 수정함-->
<head>
    <meta charset="utf-8">
    <title> home </title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body onload="init()">
    <div id="wrapper">
        <header id="main_header">
            <a href="home.php"><img src="logo.png" width="144" height="93"></a>
            <div id="mypage">               <?php
                
                
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
            ?></div>
        </header>

        <button id="default" class="tab" onclick="openMenu('Genre', this)">장르</button>
        <button id="platform" class="tab" onclick="openMenu('Platform', this)">플랫폼</button>
        <button id="age" class="tab" onclick="openMenu('Age', this)">연령대</button>
        <button class="tab"><a href="search.php"></a><img src="search.png" width="22.5" height="22.5"></button>

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
<!--------------------------------------------------------------->
         <section>
            <h1>  </h1>
            <?php
    $searchType=$_POST['searchType'];
    $searchWord=$_POST['searchWord'];
        if ($searchWord==NULL) 
           {
       echo "<p>검색어를 입력해주세요.</p>";
       exit;
    }  else{
            @$db = mysqli_connect('localhost', 'root', 'king', 'first');
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }
        
        if($searchType=='title'){
            $query = "select * from webtoon_info where webtoon_name like '%$searchWord%'";
            //select webtoon_id from webtoon_info where genre like '%일상%';
        }
            else if($searchType=='artist'){
                $query = "select * from webtoon_info where artist like '%$searchWord%'";
            }
            $result=mysqli_query($db, $query);
            $row=mysqli_fetch_array($result);
            $resultArr=array();
            while($r=mysqli_fetch_assoc($result)){
                $resultArr[]=$r;
            }
            $i=$result->num_rows;
            echo $i;
            if($i==0){
                echo "검색결과가 없습니다.";
            }
            if($i>0){
            //첫번째요소는 이렇게 받아오기
            //webtoon_id는 $row['webtoon_id']로 받아오면됨
	$webtoon_id = $row['webtoon_id'];
            $webtoon_name=$row['webtoon_name'];
                echo " <a class='article' href='review_main.php?toonID=$webtoon_id'>
                <p> 
                $webtoon_name
                </p>
            </a>";    
                 echo "<br/>";  
            //두번째 요소부터 이렇게 받아오기
            //webtoon_id는 $resulta['webtoon_id로 받아오면 됨
            for($count=0;$count<$i-1;$count++){
                $resulta=$resultArr[$count];
	$webtoon_id = $resulta['webtoon_id'];
                $name= $resulta["webtoon_name"];
                echo " <a class='article' href='review_main.php?toonID=$webtoon_id'>
                <p>
                   $name
                </p>
            </a>";    
                 echo "<br/>";  
            }
            }


     $db->close();
        }

            ?>
        </section>

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
