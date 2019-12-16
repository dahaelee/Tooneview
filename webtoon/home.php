<html>
<?php session_start(); ?>
<head>
    <meta charset="utf-8">
    <title> home </title>
    <link rel="stylesheet" href="style.css?after" type="text/css" />
    <meta http-equiv="Content-Type" Content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<style type="text/css">
<!--
   body {font-size:11pt; padding:0; margin:0; text-align: center;}
   h3 {color: #85144b; font-size: 14pt; margin:10 auto; padding: 10px;}
   .contents {width: 800px; height: 400px; background-color: #d6d6d6; margin: 0 auto;}
   
   /* banner */
   .banner {position: relative; width: 400px; height: 180px; top: 0px;  margin:0 auto; padding:0; overflow: hidden;}
   .banner ul {position: absolute; margin: 0px; padding:0; list-style: none; }
   .banner ul li {float: left; width: 400px; height: 210px; margin:0; padding:0;}

//-->
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script language="JavaScript">
<!--
   $(document).ready(function() {
      //사용할 배너
      var $banner = $(".banner").find("ul");

      var $bannerWidth = $banner.children().outerWidth();//배너 이미지의 폭
      var $bannerHeight = $banner.children().outerHeight(); // 높이
      var $bannerLength = $banner.children().length;//배너 이미지의 갯수
      var rollingId;

      //정해진 초마다 함수 실행
      rollingId = setInterval(function() { rollingStart(); }, 3000);//다음 이미지로 롤링 애니메이션 할 시간차

      //마우스 오버시 롤링을 멈춘다.
      banner.mouseover(function(){
         //중지
         clearInterval(rollingId);
         $(this).css("cursor", "pointer");
      });
      //마우스 아웃되면 다시 시작
      banner.mouseout(function(){
         rollingId = setInterval(function() { rollingStart(); }, 3000);
         $(this).css("cursor", "default");
      });
      
      function rollingStart() {
         $banner.css("width", $bannerWidth * $bannerLength + "px");
         $banner.css("height", $bannerHeight + "px");
         //alert(bannerHeight);
         //배너의 좌측 위치를 옮겨 준다.
         $banner.animate({left: - $bannerWidth + "px"}, 1500, function() { //숫자는 롤링 진행되는 시간이다.
            //첫번째 이미지를 마지막 끝에 복사(이동이 아니라 복사)해서 추가한다.
            $(this).append("<li>" + $(this).find("li:first").html() + "</li>");
            //뒤로 복사된 첫번재 이미지는 필요 없으니 삭제한다.
            $(this).find("li:first").remove();
            //다음 움직임을 위해서 배너 좌측의 위치값을 초기화 한다.
            $(this).css("left", 0);
            //이 과정을 반복하면서 계속 롤링하는 배너를 만들 수 있다.
         });
      }
   }); 
//-->  
</script>

</head>

   <?php
   $conn = mysqli_connect("localhost","root","king");
   $db = mysqli_select_db($conn,"first");
    ?>
    
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

        <button id="default" class="tab" onclick="openMenu('Genre', this)">장르</button>
        <button id="platform" class="tab" onclick="openMenu('Platform', this)">플랫폼</button>
        <button id="age" class="tab" onclick="openMenu('Age', this)">연령대</button>
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

               <?php
$sql = "select table1.webtoon_name as title, table1.webtoon_id as webtoon_id, table2.review_content as review_content, Date(table2.review_date) as date from (select * from webtoon_info) as table1 inner join (select webtoon_id, review_date, review_content from webtoon_review) as table2 on table1.webtoon_id = table2.webtoon_id order by table2.review_date desc";
$result = $conn->query($sql) or die($this->_connect->error);
        
        echo"<table><th>";
        
        echo"<table>";
        echo"<tr><td><section id='main_section'>
        <h1> 웹툰 소개 </h1>   

      <div class='banner'>
         <ul>
            <li><a href='https://comic.naver.com/webtoon/list.nhn?titleId=183559&weekday=mon' ><img src='https://image-comic.pstatic.net/webtoon/183559/thumbnail/thumbnail_IMAG02_e3b5a7f9-76c2-48d5-b360-0994d7b017c0.jpg' width='400' height='180px'></a></li>
            <li><a href='https://comic.naver.com/webtoon/list.nhn?titleId=733074&weekday=mon' ><img src='https://image-comic.pstatic.net/webtoon/733074/thumbnail/thumbnail_IMAG02_30abfeef-270d-4000-8a43-155e93ace734.jpg' width='400' height='180px'></a></li>
            <li><a href='https://comic.naver.com/webtoon/list.nhn?titleId=726212&weekday=mon' ><img src='https://image-comic.pstatic.net/webtoon/720121/thumbnail/thumbnail_IMAG02_e4083187-102b-44f7-8278-cac672c98c73.jpg' width='400' height='180px'></a></li>
            <li><a href='https://comic.naver.com/webtoon/list.nhn?titleId=720121&weekday=mon' ><img src='https://image-comic.pstatic.net/webtoon/726212/thumbnail/thumbnail_IMAG02_ef80419b-7fec-40d5-923e-18b872dfb453.jpg' width='400' height='180px'></a></li>
         </ul>
   </div></section></td></tr>";
        
        echo"<tr><td><section id='main_section'><h1> 최근 리뷰된 웹툰 </h1>";
        $count=1;
        while($row=$result->fetch_array()){

            if($count<=5){
                
            echo"<a class='article' href='review_main.php?toonID=$row[webtoon_id]'>
                
                <table>
                <tr>
                    <td width='300' align=left><b>$row[title]</b></td>
                    <td width='120' align=right> $row[date] </td>
                </tr>
                <tr>
                    <td>";
                        echo mb_strimwidth($row['review_content'], 0, 35, '...');
                    echo"</td>
                </tr>
            </table>
            </a>"; 
         $count=$count+1;
        }
        }
        echo"</td></tr></section>";
        echo"</table>";
        echo"</th>";
       ?>

   <?php
    
      echo"<th>";
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
      echo"</th></table>";
?>

        <footer id="main_footer"> 통합형 리뷰 포럼 웹 어플리케이션, tooneview </footer>
    </div>

    
</body>

</html>
