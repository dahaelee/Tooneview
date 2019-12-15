import pymysql
import requests
import random
from bs4 import BeautifulSoup

def crawl_info(link):
        global webtoon_id
        global val
        global sql
        global url
        url = link
        response= requests.get(url)
        source = response.text
        soup = BeautifulSoup(source, 'html.parser')
        table = soup.find(id="content")
        toon_artists = table.findAll("span",{"class":"wrt_nm"})
        for toon_artist in toon_artists:
                artist = toon_artist.get_text().split(" ")[0].strip() # 작가이름

        details = table.find("div",{"class":"detail"})
        description = details.findAll("p")[0].get_text()       #작품 간단 설명 받는 부분
        genre = table.find("span",{"class":"genre"})
        if genre is None:
                genre=""
        else:
                genre = genre.get_text()    # 장르 받는 부분
        imgs = table.findAll("div",{"class":"thumb"})
        for img in imgs:
                for im in img.findAll("img"):     
                        if 'src' in im.attrs:
                                img_src = im.attrs['src']  # 이미지 소스 링크
                        if 'title' in im.attrs:
                                webtoon_name = im.attrs['title'] # 웹툰 이름
        print(webtoon_id)
        sql = "INSERT INTO webtoon_info (webtoon_id,webtoon_name,artist,platform,genre,url,description,img_src,age) VALUES (%s, %s,%s,%s,%s,%s,%s,%s,%s)"
        age = random.randint(10,37)
        val = (webtoon_id, webtoon_name,artist,"Naver",genre, url, description,img_src,age)
        #age = table.find("span",{"class":"age"}).get_text()     # 연령가 받는데 없는 것에선 오류남 사용하지 말것

        
conn = pymysql.connect(host='localhost',user='root', password ='king')
cursor = conn.cursor()
sql="use first"
cursor.execute(sql)
sql = "drop table webtoon_info;"
cursor.execute(sql)
sql = "create table webtoon_info( webtoon_id INT NOT NULL, webtoon_name CHAR(100), artist CHAR(30), platform CHAR(30), genre CHAR(50), url VARCHAR(255), description VARCHAR(255), img_src VARCHAR(255), age INT, primary key(webtoon_id) );"
cursor.execute(sql)
url = 'https://comic.naver.com/webtoon/creation.nhn'
response= requests.get(url)
source = response.text
soup = BeautifulSoup(source, 'html.parser')

table = soup.find(id="content")

webtoon_id = 0
toon_names = table.findAll("strong")    # 웹툰 제목을 가져옵니다.
#for toon_name in toon_names:
#        if (toon_names.index(toon_name)%2==0):
#                url = toon_name.get_text().split("\"")
#                print(url[0])

toons = table.findAll("div",{"class":"thumb"}) # 웹툰 제목과 연결된 url 링크 주소를 가져옵니다.
for a in toons:
        for link in a.findAll("a"):
                #if 'title' in link.attrs:
                #        print(link.attrs["title"])
                if 'href' in link.attrs: # 내부에 있는 항목들을 리스트로 가져옵니다 ex) {u'href': u'//www.wikimediafoundation.org/'}
 
                        crawl_info("https://comic.naver.com/"+link.attrs['href'])
                        cursor.execute(sql,val)
                        webtoon_id+=1
conn.commit()               
