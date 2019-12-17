<html>
<?php session_start(); ?>
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
            seltab.style.color = "#ff7a1b";
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
                        <a href='mypage.php?hostID=$_SESSION[user_id]'><img src='profile.png' width='40' height='40'></a>
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

        <button id="genre" class="tab" onclick="openMenu('Genre', this)">장르</button>
        <button id="platform" class="tab" onclick="openMenu('Platform', this)">플랫폼</button>
        <button id="default" class="tab" onclick="openMenu('Age', this)">연령대</button>
        <a href="search.php"><button class="tab"><img src="search.png" width="23" height="23"></button></a>

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
        <section>
            <h1> </h1>
            <?php
                       $age = $_GET["query"];
            @$db = mysqli_connect('localhost', 'root', 'king', 'first');
    if (mysqli_connect_errno()) {
       echo "<p>Error: Could not connect to database.<br/>
             Please try again later.</p>";
       exit;
    }
        if($age==10){
        $query = "select * from webtoon_info where age<20;";
        }
            else if($age==20){
                $query = "select * from webtoon_info where age<30 and age>=20;";
            }
            else{
                $query = "select * from webtoon_info where age>=30;";
            }
        $result=mysqli_query($db, $query);
        $num = mysqli_num_rows($result);    //총 데이터 수
        
        $list = 10; //페이지 당 데이터 수
        $block = 10; //블록 당 페이지 수
        $pageNum = ceil($num/$list); //총 페이지
            $page = isset($_GET['page'])?$_GET['page']:1;
        $blockNum = ceil($pageNum/$block); //총 블록
        $nowBlock = ceil($page/$block);
        
        $s_page = ($nowBlock*$block)-($block -1); //시작 페이지
        if ($s_page <=1){
            $s_page = 1;
        }
        $e_page = $nowBlock*$block; //종료 페이지
        if($pageNum<=$e_page){
            $e_page = $pageNum;
        }
        ?>                
        <p style='text-align:right'>
        <?php
            if($page>1){    //첫 페이지면 이전으로 못가게
                ?>
                <a href="<?=$_SERVER['PHP_SELF']?>?query=<?=$age?>&page=<?=$page-1?>">이전</a>
            <?php
            }
            else{
                ?>
                <a href="<?=$_SERVER['PHP_SELF']?>?query=<?=$age?>&page=<?=$page?>">이전</a>
            <?php
            }
        for($p=$s_page;$p<=$e_page;$p++){   //페이지 수 띄우기
            if($p==$page){
                ?>
                <a href="<?=$_SERVER['PHP_SELF']?>?query=<?=$age?>&page=<?=$p?>"><b><?=$p?></b></a>
            <?php
            }
            else{
            ?>
                        <a href="<?=$_SERVER['PHP_SELF']?>?query=<?=$age?>&page=<?=$p?>"><?=$p?></a>
                        <?php
                
            }
            
        }
            if($page<$pageNum){  //마지막 페이지면 다음으로 못가게
                ?>
                <a href="<?=$_SERVER['PHP_SELF']?>?query=<?=$age?>&page=<?=$page+1?>">다음</a>
            <?php
            }
            else{
                ?>
                <a href="<?=$_SERVER['PHP_SELF']?>?query=<?=$age?>&page=<?=$page?>">다음</a>
            <?php } ?>
    </p>            
            <?php
            $s_point = ($page-1) * $list;
            if($age==10){
        $query = "select * from webtoon_info where age<20 LIMIT $s_point,$list;";
        }
            else if($age==20){
                $query = "select * from webtoon_info where age<30 and age>=20 LIMIT $s_point,$list;";
            }
            else{
                $query = "select * from webtoon_info where age>=30 LIMIT $s_point,$list;";
            } 
            $result=mysqli_query($db, $query);
            $row=mysqli_fetch_array($result);
            $resultArr=array();
            while($r=mysqli_fetch_assoc($result)){
                $resultArr[]=$r;
            }
            
        $webtoon_name=$row['webtoon_name'];
            $i=$result->num_rows;

            echo"<br>";
           
                        
            for($count=0;$count<count($resultArr);$count++){
                $resulta=$resultArr[$count];
                $name= $resulta["webtoon_name"];
                $img_src = $resulta["img_src"];
                $artist = $resulta["artist"];
                $webtoon_id=$resulta["webtoon_id"];
                
                $query1 = "select AVG(rate) as rate from webtoon_review where webtoon_id ='$webtoon_id'" ;
                $rate_info=mysqli_query($db, $query1);
                $row=mysqli_fetch_array($rate_info);
                $rate=$row['rate'];
                $rate_percentage=$rate*20;
                
                echo "<a class='article' href='review_main.php?toonID=$webtoon_id' width='300' height='130'>";
                
                echo "<table><tr>
                <td width=150></td>
                <td><img src=$img_src width = '110' height='110'></td>
                <td width=60></td>
                <td width=400 align='center'><h1>$name</h1></td>
                <td width=400 align='center'><font color=#ff7a1b><h1>$artist</h1></font></td>
                <td width=30></td>
                <td width=300>
                <div style='CLEAR:both;	PADDING-RIGHT:0px;	PADDING-LEFT:0px; BACKGROUND:url(icon_star2.gif) 0px 0px; FLOAT:left; PADDING-BOTTOM: 0px; MARGIN:0px; WIDTH: 90px; PADDING-TOP:0px; HEIGHT:18px;'>
	            <p style='WIDTH:$rate_percentage%; PADDING-RIGHT:0px;	PADDING-LEFT:0px; BACKGROUND: url(icon_star.gif) 0px 0px; PADDING-BOTTOM:0px; MARGIN:0px; PADDING-TOP:0px;	HEIGHT: 18px;'>
	            </p>
	            </div>
                </td>
                </tr></table></a>";
            }  

     $db->close();
            ?>
        </section>

        <footer id="main_footer"> 통합형 리뷰 포럼 웹 어플리케이션, tooneview </footer>
    </div>


</body>

</html>