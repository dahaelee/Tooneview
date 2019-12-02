<!DOCTYPE html> 
<html>
<head>
    <meta charset="utf-8">

<title> Log in </title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body onload="init()">
    <div id="wrapper">
        <header id="main_header"><a href="home.php"><img src="logo.png" width = "162.75"height = "105"></a></header>
        <div id="container">
            <div id="login_content">
                <form action="registration-result.php" method="post" name = "test" onSubmit = "register()" onReset = "reWrite()" >
                    <table class="table table-responsive">
 <h1>회원가입</h1>
  <form action="insert_book.php" method="post">
  <fieldset>
    <p><label for="userID">ID</label>
    <input type="text" id="userID" name="userID" maxlength="13" size="13" /></p>
    <p><label for="password">password</label>
    <input type="password" id="password" name="password" maxlength="30" size="30" /></p>
    <p><label for="nickname">닉네임</label>
    <input type="text" id="nickname" name="nickname" maxlength="60" size="30" /></p>
      <p><label for="nickname">생일</label>
    <input type="text" id="birthday" name="birthday" maxlength="60" size="30" /></p>
      <p><label for="nickname">성별</label>
    <select name="sex" id="sex"  />
          <option value="여자">여자</option>
          <option value="남자">남자</option>
      </p>
  </fieldset>
  
  <p><input type="submit" value="회원가입" /></p>
  
  </form>
    </table>
                </form>

            </div>
        </div>
        
    </div>

</body>
</html>