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
  <form class=login action="registration-result.php" method="post">
      <table>
          <tr width>
              <td width="200" height="30">
                  <label for="userID">ID</label>
              </td>
              <td>
                  <input type="text" id="userID" name="userID" maxlength="17" size="17" />
              </td>
          </tr>
          <tr>
              <td height="30">
                  <label for="password">password</label>
              </td>
              <td>
                  <input type="password" id="password" name="password" maxlength="17" size="17" />
              </td>
          </tr>
          <tr>
              <td height="30">
                  <label for="nickname">닉네임</label>
              </td>
              <td>
                  <input type="text" id="nickname" name="nickname" maxlength="17" size="17" />
              </td>
          </tr>
          <tr>
              <td height="30">
                  <label for="nickname">생일</label>
              </td>
              <td>
                  <input type="date" id="birthday" name="birthday" maxlength="60" size="17" />
              </td>
          </tr>
          <tr>
              <td height="30">
                  <label for="nickname">성별</label>
              </td>
              <td>
                  <select name="sex" id="sex"  />
                  <option value="여자">여자</option>
                  <option value="남자">남자</option>
              </td>
          </tr>
          
          <tr>
              <th colspan=2>
                  <p><button class=btn type="submit" >회원가입</button>
                  </p>
              </th>
          </tr>
                           
                    
      </table>
                </form>

            </div>
        </div>
        
    </div>

</body>
</html>