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

        <table>
            <tr>
                <th>
                    <section id="main_aside">
                        <h1> TODAY 순위 </h1>
                        <table class="rank_table">
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">1</td>
                                <td class="pic">그림넣기</td>
                                <td class="title">제목넣기</td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">2</td>
                                <td class="pic">그림넣기</td>
                                <td class="title">제목넣기</td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">3</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">4</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">5</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">6</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">7</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">8</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">9</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">10</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                        </table>
                    </section>
                </th>
                <th>
                    <section id="main_aside">
                        <h1> WEEKLY 순위 </h1>
                        <table class="rank_table">
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">1</td>
                                <td class="pic">그림넣기</td>
                                <td class="title">제목넣기</td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">2</td>
                                <td class="pic">그림넣기</td>
                                <td class="title">제목넣기</td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">3</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">4</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">5</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">6</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">7</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">8</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">9</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                            <tr onClick="location.href='리뷰링크넣기'" style="cursor:pointer;">
                                <td class="ranking">10</td>
                                <td class="pic"></td>
                                <td class="title"></td>
                            </tr>
                        </table>
                    </section>
                </th>
            </tr>
        </table>

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
