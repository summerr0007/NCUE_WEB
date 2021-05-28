-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-05-28 05:46:44
-- 伺服器版本： 10.4.17-MariaDB
-- PHP 版本： 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `group_22`
--
CREATE DATABASE IF NOT EXISTS `group_22` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `group_22`;

-- --------------------------------------------------------

--
-- 資料表結構 `commodity`
--

CREATE TABLE `commodity` (
  `pid` int(8) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `publisher` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `price` int(100) NOT NULL,
  `summary` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(100) NOT NULL,
  `cate` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `star` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `commodity`
--

INSERT INTO `commodity` (`pid`, `name`, `author`, `publisher`, `date`, `price`, `summary`, `stock`, `cate`, `file_name`, `star`) VALUES
(1, '微積分', '蔡聰明', '高立圖書', '2012-06-01', 665, '<br>&emsp; &emsp;這是一本紮實與精準的教科書，力圖呈現微積分的驚心動魄與美。微積分的求切線斜率與求面積問題，一舉解決於相對容易的微分正逆演算。微分的正算解決了函數的遞增、遞減、臨界點、極值、凹口向上、凹口向下、反曲點、函數圖形的樣貌、泰勒展式；而微分的逆算 ( 不定積分 ) 解決了求面積問題與解微分方程的問題等。<br>&emsp; &emsp;微積分可用一個口訣來描寫：一法二念二義一理。一法就是一個方法，指的是本義的無窮步驟之分析與綜合法 ( 即無窮步驟的分割與連續求和 )；二念就是兩個概念，即極限與無窮小量；二義就是兩個定義，即微分與積分的定義；一理就是一個定理，即微積分學根本定理，它是連結微分與積分的橋樑，以四兩撥千斤的巧妙，解決求面積的千古難題。<br>&emsp; &emsp;微積分是整個近代科學與工藝的基礎。若沒有微積分，就沒有物理學，沒有電磁學，沒有近代的科學革命，更沒有現代的電腦資訊文明。學習微積分雖然有點困難，但是努力用心去學，太值得了。深信天下沒有學不會的東西。<br>&emsp; &emsp;微積分可能是每一位初學者第一次接觸到的最抽象，也最具挑戰性的數學，因為它結結實實遇到了「無窮」，落實於取極限的操作或無窮小量的論述法。「無窮」讓微積分具有深度，困難且迷人。本書願盡所能幫助讀者克服這個「無窮」的難關。「大道無門，千差有路，透得此關，乾坤獨步」，加油！', 146, '考試用書', 'p_1.jpg', 2),
(2, '普通物理學', 'Zill Chen', '陳云川', '2017-06-22', 360, '<br>&emsp; &emsp;本書著重在物理的觀念和證明，以簡單扼要的文字和圖像，使公式推導清楚易懂。各章附有例題，並分析其物理意義。部分例題會以多種方式求解，除了提供解題技巧，更培養讀者分析的能力。章末提供難度適中的習題，加強讀者對物理公式的應用。', 8, '考試用書', 'p_2.jpg', 3),
(3, '研究所講重點【線性代數及其應用(上)】(5版)', '黃子嘉', '大碩教育', '2019-07-23', 395, '<br>★內容完整兼具深度及廣度以深入淺出的方式來表達<br>★相關試題收集最完整<br>★以最有效且最詳實的方式來解題<br>★適合研究所入學考試及自修用的參考書<br>', 82, '考試用書', 'p_3.jpg', 4),
(4, '研究所講重點【線性代數及其應用(下)】（5版）', '黃子嘉', '大碩教育', '2019-08-14', 656, '<br>&emsp; &emsp;本書內容完整兼具深度及廣度以深入淺出的方式來表達，相關試題收集最完整，以最有效且最詳實的方式來解題，適合研究所入學考試及自修用的參考書。<br>&emsp; &emsp;本書共八章分成上、下二冊，上冊內容從第零章先介紹一些往後各章會用到的基礎數學，第一章討論矩陣及線性系統，矩陣為線性代數中一個很重要的工具，而解線性系統則為一個很基本且具有相當多應用的問題。第二章介紹行列式，這也是線性代數一個很重要工具。第三章討論向量空間，向量空間可以說是支撐線性代數的一個平台，主要內容在討論獨立、生成及基底的觀念。第四章引進比較動態且抽象的函數觀念，即線性映射，它可用來表示向量之間線性轉換的過程，在此我們也研究如何利用比較具體的矩陣來表示一個比較抽象的線性映射。<br>&emsp; &emsp;下冊內容從第五章介紹對角化及其相關應用，這是線性代數應用最廣的問題之一，將一個矩陣或線性映射對角化可解決許多應用方面的問題。然而當一個矩陣或線性映射無法對角化時，此時退而求其次對矩陣或線性映射作Jordan form，這也是我們第六章的內容，第七章介紹內積，內積主要用來測度一個向量的長度以及向量之間是否垂直，有了測度便可處理一些量化的最佳化問題，這在線性代數的應用裡佔了相當重要的地位。第八章介紹幾個比較重要的線性算子或矩陣，另外也討論比一般對角化更完美的正交對角化。<br>&emsp; &emsp;', 10, '考試用書', 'p_4.jpg', 4),
(5, '研究所講重點【離散數學(上)】（6版）', '黃子嘉', '大碩教育', '2019-08-06', 589, '<br>&emsp; &emsp;離散數學為資訊科學中最重要的一門數學課程，其範圍相當廣泛，涵蓋了資訊科學中常用的數學概念，舉凡資料結構、演算法、作業研究、編碼解碼、編譯器理論等等都需要離散數學的背景知識。離散數學主要探討電腦能表示的離散及有限集的特性，常見的範圍包含組合數學、圖論、代數、編碼解碼理論、有限狀態機等五大部份。<br>&emsp; &emsp;本書共分成十三章，第一、二、三、四、五及十一章屬於組合數學的範圍，其中第一章基本數學介紹集合論、數學歸納法以及基礎數論，此為往後各章節的基礎。第二章探討各種不同關係與函數的性質，此外也討論鴿籠原理與基數問題。第三章介紹排列組合、排容原理以及離散機率。第四章介紹一個解排列組合或遞迴關係很有用的工具－生成函數。第五章討論如何求解各種不同的遞迴關係式，同時也探討如何用遞迴關係式解一些高等的排列組合問題。第十一章探討Burnside 及Polya 定理，二個組合數學領域的重要定理。<br>&emsp; &emsp;第六、七及八章屬於圖論的範圍，其中第六章介紹圖論的一些基本觀念及一些重要的圖論問題如路徑問題、平面圖以及著色理論。第七章介紹一個特別的圖－樹狀結構，探討樹的各種性質及應用。第八章主要討論常見圖論上的演算法及計算複雜度的分析。<br>&emsp; &emsp;第九及第十章屬於代數的範圍，其中第九章介紹群、環、整域及體等代數結構的基本性質及應用。第十章討論絡與布林代數的代數結構。第十二章為編碼與解碼，介紹如何獲得最有效率的編碼方式以及相對應的解碼方式。<br>&emsp; &emsp;第十三章為有限狀態機結構，討論有限狀態機、自動狀態機、文法及正規表示式。<br>&emsp; &emsp;', 7, '考試用書', 'p_5.jpg', 5),
(6, '研究所講重點【離散數學(下)】（6版）', '黃子嘉', '大碩教育', '2019-08-14', 551, '<br>&emsp; &emsp;離散數學為資訊科學中最重要的一門數學課程，其範圍相當廣泛，涵蓋了資訊科學中常用的數學概念，舉凡資料結構、演算法、作業研究、編碼解碼、編譯器理論等等都需要離散數學的背景知識。離散數學主要探討電腦能表示的離散及有限集的特性，常見的範圍包含組合數學、圖論、代數、編碼解碼理論、有限狀態機等五大部份。<br>&emsp; &emsp;本書共分成十三章，第一、二、三、四、五及十一章屬於組合數學的範圍，其中第一章基本數學介紹集合論、數學歸納法以及基礎數論，此為往後各章節的基礎。第二章探討各種不同關係與函數的性質，此外也討論鴿籠原理與基數問題。第三章介紹排列組合、排容原理以及離散機率。第四章介紹一個解排列組合或遞迴關係很有用的工具－生成函數。第五章討論如何求解各種不同的遞迴關係式，同時也探討如何用遞迴關係式解一些高等的排列組合問題。第十一章探討Burnside 及Polya 定理，二個組合數學領域的重要定理。<br>&emsp; &emsp;第六、七及八章屬於圖論的範圍，其中第六章介紹圖論的一些基本觀念及一些重要的圖論問題如路徑問題、平面圖以及著色理論。第七章介紹一個特別的圖－樹狀結構，探討樹的各種性質及應用。第八章主要討論常見圖論上的演算法及計算複雜度的分析。<br>&emsp; &emsp;第九及第十章屬於代數的範圍，其中第九章介紹群、環、整域及體等代數結構的基本性質及應用。第十章討論絡與布林代數的代數結構。第十二章為編碼與解碼，介紹如何獲得最有效率的編碼方式以及相對應的解碼方式。<br>&emsp; &emsp;第十三章為有限狀態機結構，討論有限狀態機、自動狀態機、文法及正規表示式。<br>&emsp; &emsp;', 2, '考試用書', 'p_6.jpg', 5),
(7, '研究所講重點【計算機組織與結構重點直擊(上)】(3版)', '張凡', '大碩教育', '2019-09-01', 561, '<br>&emsp; &emsp;原來計算機內部構造及其運作原理這麼有趣！<br><br>&emsp; &emsp;1.概念釐清：詳盡的觀念說明，協助同學了解相關概念。<br>&emsp; &emsp;2.高分奪標：重點說明後，搭配練習與範例，保證考取高分。<br>&emsp; &emsp;3.歷屆試題：完整蒐錄各大系所歷屆完整之考試題型，俾收鑑往知來之效。<br>&emsp; &emsp;', 10, '考試用書', 'p_7.jpg', 5),
(8, '研究所講重點【計算機組織與結構重點直擊(下)】(3版)', '張凡', '大碩教育', '2019-09-01', 456, '<br>&emsp; &emsp;原來計算機內部構造及其運作原理這麼有趣！<br><br>&emsp; &emsp;1.概念釐清：詳盡的觀念說明，協助同學了解相關概念。<br>&emsp; &emsp;2.高分奪標：重點說明後，搭配練習與範例，保證考取高分。<br>&emsp; &emsp;3.歷屆試題：完整蒐錄各大系所歷屆完整之考試題型，俾收鑑往知來之效。<br>&emsp; &emsp;', 10, '考試用書', 'p_8.jpg', 5),
(9, '資料結構', '陳木中', '新文京', '2015-08-01', 456, '<br>&emsp; &emsp;資料結構是演算法的一個好幫手，規劃好的資料結構，在撰寫程式時方能得心應手。本書談論程式內的資料如何運用變數，有效率的擺放在記憶體中，好讓演算法在運作時能得心應手，並說明演算法的利用方式，學習資料結構結合演算法的運作效果。<br>&emsp; &emsp;全書分為十章，內容完整，架構清楚。第一章介紹資料結構的基本概念，包含結構、指標及遞迴程式等；第二章及第三章說明陣列與鏈結串列等資料結構的基礎工具，也就是所謂的靜態與動態資料結構；第四章與第五章則探討線性結構中，堆疊與佇列兩種特例。<br>&emsp; &emsp;第六章到第八章分別闡述樹狀結構、二元搜尋樹與其高度平衡、圖形結構，這三章是資料結構中相當重要的單元，特別詳加說明；第九章與第十章分別講述排序與搜尋這兩項資料處理時經常應用的工具。<br>&emsp; &emsp;', 9, '考試用書', 'p_9.jpg', 3),
(10, '作業系統', '呂沐錡, 陳耀宗', '高立圖書', '2015-11-01', 523, '<br>&emsp; &emsp;本書以循序漸進的方式來撰寫，希望引導讀者按部就班地了解作業系統的全貌。本書的內容安排首先是「作業系統概論篇」，將介紹作業系統是甚麼，它是如何被建構與設計的；接下來是「行程管理篇」，介紹行程觀念、CPU排程、合作行程之同步及死結之避免與防止等內容；其次是「儲存管理篇」，介紹各種不同的記憶體管理方法及檔案管理方法等內容；再其次是「I/O系統篇」，介紹I/O管理機制及大量儲存結構；然後是「分散式系統篇」，討論分散式系統架構、分散式統合機制、及雲端計算系統等內容；其次是「系統安全篇」，主要介紹系統保護與安全；最後是「系統實例篇」、主要介紹Linux作業。<br>&emsp; &emsp;本書除了適合用於一般大學、科技大學、獨立學院、技術學院、大專等之資訊與電機相關科系及一般理工科系之學生的上課教材之外，也適合一般希望進修電腦知識之讀者研習或自修之書籍。<br>&emsp; &emsp;', 9, '考試用書', 'p_10.jpg', 3),
(11, '你的名字。', '新海誠', '台灣角川', '2016-12-15', 205, '<br>&emsp; &emsp;家住深山的女高中生三葉，每天過著鬱鬱寡歡的生活。<br>&emsp; &emsp;身為鎮長的父親參與的選舉、家中神社的古老習俗、狹小的村莊──在莫名在意四周眼光的年紀，她對都會生活懷抱強烈憧憬。<br><br>&emsp; &emsp;「下輩子，請讓我生為東京的帥哥！」<br>&emsp; &emsp;某日，三葉夢見自己變成男高中生。<br>&emsp; &emsp;不曾看過的房間、不認識的朋友、繁華的街道與時髦的咖啡廳──三葉在夢裡盡情享受了渴望的都市生活。<br>&emsp; &emsp;住在東京的男高中生──瀧，也做了奇怪的夢。在夢裡，他是家住深山的女高中生。<br>&emsp; &emsp;偶有遺落的記憶與時間，不可思議卻不斷持續的夢境……三葉和瀧終於察覺：<br>&emsp; &emsp;「我和他（她）互換靈魂了嗎？」<br>&emsp; &emsp;', 10, '輕小說', 'p_11.jpg', 5),
(12, '天氣之子', '新海誠', '台灣角川', '2019-09-11', 237, '<br>&emsp; &emsp;高一夏天，帆高自故鄉離島離家出走，來到東京。<br>&emsp; &emsp;但獨立生活的夢想很快於現實中破滅，<br>&emsp; &emsp;東京連日的大雨，也彷彿象徵帆高晦暗的未來。<br><br>&emsp; &emsp;在困頓的生活中，帆高於人潮擁擠的都會一角，<br>&emsp; &emsp;邂逅與弟弟相依為命的不可思議少女──陽菜。<br>&emsp; &emsp;「馬上就會放晴了喔。」<br>&emsp; &emsp;廢棄大樓雜草叢生的屋頂上，在陽菜這句話之後，<br>&emsp; &emsp;烏雲散去、陽光灑落，<br>&emsp; &emsp;灰色的世界恢復了鮮豔色彩……<br><br>&emsp; &emsp;在氣候異常的時代，被命運捉弄的少年少女，<br>&emsp; &emsp;如何「選擇」自己的生活？<br>&emsp; &emsp;', 9, '輕小說', 'p_12.jpg', 5),
(13, '言葉之庭', '新海誠', '悅知文化', '2015-08-24', 284, '<br>夢想成為製鞋師的少年，與忘記如何邁出步伐的女人。<br><br>15歲的高中生孝雄，每當雨天，便翹課到日式庭園的涼亭中，繪製鞋子的素描。某天，出現了獨自一人喝著罐裝啤酒、吃著巧克力的27歲謎樣女性雪野，此後，即便沒有特別約定，兩人卻總是在下著雨的涼亭一再重逢。日復一日，於是，跨越年齡的情愫就此展開。<br>沒有約定的邂逅，只在下著雨的日式庭院。<br>與你一再地相遇，我們拯救了彼此……<br>「對她而言，15歲的我只不過是個孩子。」<br>「27歲的我，絲毫不比15歲時的我聰明。」<br>', 10, '輕小說', 'p_13.jpg', 4),
(14, '秒速5公分(全)', '新海誠', '尖端', '2011-12-20', 158, '<br>&emsp; &emsp;遠野貴樹與篠原明里在小學畢業後即分隔兩地，雖然兩人對彼此都抱有著特別的思念，但時間仍無情地一天天流逝。在某個下著大雪的日子，貴樹終於決定要去見明里……<br><br>&emsp; &emsp;本作品一共分成描述貴樹與明里的幼小愛苗與他們重逢之日的「櫻花抄」、以對進入高中就讀的貴樹懷有好感的澄田花苗觀點來詮釋的「太空人」，以及描述兩人內心之徬徨，與本作片名同名的「秒速5公分」等三話。<br><br>&emsp; &emsp;以「現在、這裡」的日本為舞台，搭配抒情式畫面詮釋的連作短篇動畫作品首次小說化！<br>&emsp; &emsp;', 10, '輕小說', 'p_14.jpg', 2),
(15, '追逐繁星的孩子', 'あきさかあさひ, 新海誠, 西村貴世', '台灣角川', '2017-11-29', 205, '<br>&emsp; &emsp;想要再一次見到那個人，不論付出何種代價！<br><br>&emsp; &emsp;自幼喪父的明日菜，在山間與母親相依為命。堅強的明日菜獨自擔起所有家務，但仍難掩心中寂寞，唯一的興趣是聆聽父親遺留的礦石收音機。自收音機傳出的不可思議樂音，在她耳邊縈繞不去。<br><br>&emsp; &emsp;某天，明日菜遇見了來自雅戈泰的少年瞬，兩人建立起心靈相通的關係，瞬卻悄然離開人世。接著，和瞬幾乎是同一個模子刻出來的少年心，以及追尋雅戈泰的教師森崎，出現在希望能跟瞬再次見面的明日菜眼前。三人懷抱各自的目標，在傳說能將死者復活的地下國度展開旅程……<br>&emsp; &emsp;', 10, '輕小說', 'p_15.jpg', 5),
(16, '煙花', '大根仁, 岩井俊二, 渡邊明夫', '台灣角川', '2017-09-14', 221, '<br>&emsp; &emsp;「如果，那個時候──」<br><br>&emsp; &emsp;舉辦煙火大會的某個夏日，家住海邊小鎮的典道和兒時玩伴爭論著：「高空煙火從側面看，是圓的還是扁的？」眾人相約登上燈塔確認答案，但當天傍晚，典道暗戀已久的同班同學奈砂突然邀他私奔。<br>&emsp; &emsp;可是，奈砂被母親帶回，私奔計畫失敗了。<br>&emsp; &emsp;為了將奈砂搶回來，典道祈求那一天能夠重新來過，扔出在海邊撿到的神祕珠子……<br>&emsp; &emsp;變形蟲般的煙火、倒轉的風車葉片、扭曲的防風林、歪斜的房屋──重複經歷的某個夏日裡，隨著高空煙火施放，未曾體驗的戀愛奇蹟誕生！<br><br>&emsp; &emsp;「不管幾次，我都會拯救妳；  不管幾次，我都會愛上妳！」<br>&emsp; &emsp;', 10, '輕小說', 'p_16.jpg', 3),
(17, '妳在月夜裡閃耀光輝', '佐野徹夜', '台灣角川', '2017-10-06', 221, '<br>&emsp; &emsp;重要之人辭世後，岡田卓也只是渾渾噩噩活著，<br>&emsp; &emsp;直到他在高中邂逅一位罹患「發光病」的少女。<br>&emsp; &emsp;少女說，在她所剩不多的生命裡，還想完成某些心願。<br>&emsp; &emsp;「如果可以，我想幫妳完成心願。」<br>&emsp; &emsp;「真的嗎？」<br>&emsp; &emsp;卓也與少女許下約定，停滯多年的時光再次流動，<br>&emsp; &emsp;去遊樂園遊玩、在女僕店打工、於夏夜看星星……<br>&emsp; &emsp;清單上的願望一個個消去，少女的生命也靜靜消逝。<br>&emsp; &emsp;終於，少女在月夜散發出強烈光芒，<br>&emsp; &emsp;她的最後一個願望是──<br><br>&emsp; &emsp;獻給活在當下的每一個人，<br>&emsp; &emsp;溫柔包覆失去的傷痛，<br>&emsp; &emsp;最為極致動人的愛情故事──<br>&emsp; &emsp;', 10, '輕小說', 'p_17.jpg', 5),
(18, '致 十年後的你', '天澤夏月', '台灣角川', '2017-07-26', 237, '<br>&emsp; &emsp;千尋，因為一段不討厭也不心動、曖昧的戀愛關係而苦惱。<br>&emsp; &emsp;冬彌，曾經夢想進軍世界，現在卻逃離社團活動的前足球少年。<br>&emsp; &emsp;優，不知道自己未來要做什麼，就讀夜間部的不良高中生。<br>&emsp; &emsp;美夏，對不習慣的辣妹生活、女孩子的小團體感到窒息。<br>&emsp; &emsp;時子，害怕面對自己的缺點，不願意踏出家門的繭居族。<br>&emsp; &emsp;耀，進入大學後，卻仍掛念著小學時吵架而分開的少女。<br><br>&emsp; &emsp;十年前埋下的時光膠囊，為失去夢想與未來的今日，<br>&emsp; &emsp;帶來滿滿的勇氣與祝福……<br>&emsp; &emsp;', 10, '輕小說', 'p_18.jpg', 2),
(19, '咖啡館推理事件簿6：盛滿咖啡杯的愛', '岡崎琢磨', '麥田', '2021-01-28', 221, '<br>一個破碎的咖啡杯、一幅懸賞千萬的遺失畫作，<br>埋藏著塔列蘭咖啡的起源故事？<br><br>不管是苦澀、甘甜，還是溫暖，咖啡的滋味全都源自愛……<br><br>聰明的咖啡師美星首度陷入困境──<br>如果死者希望保守祕密，該不該揭開塵封的往事？<br>', 10, '輕小說', 'p_19.jpg', 2),
(20, '三日間的幸福', '三秋縋', '台灣角川', '2014-12-05', 205, '<br>&emsp; &emsp;我，二十歲，前途一片黯淡，<br>&emsp; &emsp;我決定留下三個月，將剩餘的三十年壽命全部賣掉。<br>&emsp; &emsp;然而，我的未來卻不如我想像中值錢，一年，僅僅值一萬日圓……<br><br>&emsp; &emsp;第二天，一位自稱監視員的年輕女性出現在我門前，<br>&emsp; &emsp;負責監視我度過剩餘的三個月。<br>&emsp; &emsp;然而，和她相處的時間，<br>&emsp; &emsp;卻讓我的未來價值，出現了意想不到的改變……<br><br>&emsp; &emsp;當眼前的一切都變得如此美好之時，<br>&emsp; &emsp;我決定將我僅存的人生全數賣出，只留下最後的──<br><br>&emsp; &emsp;三天……<br>&emsp; &emsp;', 10, '輕小說', 'p_20.jpg', 3),
(21, '一生必學的100道經典家常菜', '蔣偉文', '日日幸福', '2021-05-12', 356, '<br>&emsp; &emsp;誰說在家煮飯就要大刀闊斧、風風火火？輕鬆簡單才是王道，只要掌握每道菜的小訣竅，廣泛運用，就能輕鬆變化出屬於自家的經典料理。不管是最能代表台灣菜的三杯雞、客家小炒、蒼蠅頭、白菜滷等，或已入境隨俗、經過改良的中國名菜如宮保雞丁、醉雞、回鍋肉、蔥燒鯽魚、麻婆豆腐等，或其他國家已在台灣落地生根的泰式檸檬魚、大阪燒、親子丼、玉米濃湯、羅宋湯等等，排隊名菜、熱炒店人氣料理、懷念的家鄉美味通通囊括！從肉類、海鮮、蛋、豆腐、蔬菜到麵飯、湯品，應有盡有！自炊、請客、好友相聚，單身貴族、小家庭、大家庭都適合，在家就能簡單做，輕鬆享用！<br><br>&emsp; &emsp;本書共分為一生必學的經典肉料理、豐味海鮮料理、蛋、豆腐與蔬菜料理、家常麵&飯料理與美味湯品等五大單元，即使隨意選擇組合，都能烹調出一桌精彩絕妙的美味！<br>&emsp; &emsp;', 10, '飲食', 'p_21.jpg', 2),
(22, '舒心廚房', '姊弟煮廚 PAULINA&JERRY CHEN', '四塊玉文創', '2021-03-31', 340, '<br>&emsp; &emsp;這本書可以給熱愛下廚或剛開始下廚的你，<br>&emsp; &emsp;提供實用的聰明小訣竅。<br>&emsp; &emsp;這本書也適合對生活有美麗想像的你閱讀，<br>&emsp; &emsp;為自己沖杯咖啡，然後細嚼慢嚥，尋常日子裡的豐美簡約。<br>&emsp; &emsp;', 10, '飲食', 'p_22.jpg', 4),
(23, 'Amyの私人廚房，一日兩餐快速料理', 'Amy (張美君) ', '幸福文化', '2021-04-14', 395, '<br>＼Amy老師「首本從未公開的快速常備菜」最新力作／<br>小家庭適合的美味晚餐，還有午餐便當！<br>10分鐘下班後快速上桌的家常菜<br>', 10, '飲食', 'p_23.jpg', 3),
(24, '增肌減脂！運動前後快速料理', 'Amyの私人廚房, 好食課營養師團隊', '幸福文化', '2020-12-16', 349, '<br>&emsp; &emsp;瘋健身已成全民運動，大家也知道有計劃地吃、吃對時間與食材，才能讓健身效果發揮到最大，但對於時間有限又想下廚的運動族群們來說，快速煮出營養豐富的一餐並不容易！知名料理網紅Amy老師+專業營養師團隊－好食課聯手合著，精心設計出全家人一起吃、省時輕鬆煮的快速料理！<br>&emsp; &emsp;', 10, '飲食', 'p_24.jpg', 4),
(25, '會開瓦斯就會煮【續攤】', '大象主廚', '野人', '2020-12-30', 356, '<br>&emsp; &emsp;你也有以下困擾？<br>&emsp; &emsp;→想吃個溏心蛋卻成煮成超老白煮蛋！<br>&emsp; &emsp;→別人端上桌是漂亮的鮮豔紫茄，而自己只能料理出暗黑茄！<br>&emsp; &emsp;→老羨慕人家的滷味噴香又下酒，你的卻總少一味還滯銷！<br>&emsp; &emsp;→涼拌開胃菜不但開不了胃，還讓親友say no way！<br>&emsp; &emsp;→知名大菜都是工序繁複，美味料理一定跟新手無緣！<br>&emsp; &emsp;→買個排骨彷彿走進大觀園，只能瞎子摸象全憑運氣！<br>&emsp; &emsp;→好擔心食安問題，但是偏偏不會煮只能外食！<br>&emsp; &emsp;………………………………………. <br><br>&emsp; &emsp;其實，你不是不會煮，只是沒有買對書！<br>&emsp; &emsp;跟著大象主廚學料理，上述困擾全部解決，<br>&emsp; &emsp;超詳細的教學內容，好理解的步驟圖輔助，<br>&emsp; &emsp;受用一生的烹飪小撇步不藏私傾囊相授，<br>&emsp; &emsp;讓你輕鬆寫意就能出好菜，<br>&emsp; &emsp;新手受用，老手實用，<br>&emsp; &emsp;有了《會開瓦斯就會煮【續攤】》，料理成就感秒爆棚！<br>&emsp; &emsp;', 10, '飲食', 'p_25.jpg', 2),
(26, '一個人的旅味煮食：味蕾輕旅行~咩莉的85道料理風景', '咩莉‧煮食', '野人', '2021-01-27', 332, '<br>&emsp; &emsp;2020年半路殺出意料之外的新冠疫情，讓大家期待的國外旅行計劃全都泡了湯。歐洲、亞洲…哪兒都不了的一年你是不是悶壞了呢？除了先用國內旅遊暫時擋一下，試著自己動手做異國料理解解饞，邊吃邊神遊國外風光是不是也是不錯的選擇？<br><br>&emsp; &emsp;吃過薩巴雍這道義大利甜品嗎？做起來比提拉米蘇還簡單喔！南京的美齡粥是有多美味可以讓宋美齡女士胃口大開？雲南的老奶奶洋芋和紅三剁光看菜名實在是讓人摸不著頭緒菜色吃起來是什麼滋味？「Bobó de Camarão」這道巴西非常受歡迎的佳餚吃起來反而有一種濃濃的東南亞風味。<br><br>&emsp; &emsp;究∼竟，是誰偷師誰呢？少油少鹽，味道卻甘美鮮甜鱈魚西京燒聽起來就超下酒的呀……<br>&emsp; &emsp;這些有意思的異國料理是不是已讓你口水不自覺的狂分泌了？快快翻開書做幾道嚐嚐吧！<br>&emsp; &emsp;', 10, '飲食', 'p_26.jpg', 4),
(27, '原型食物煲湯料理', 'Lowlee', '采實文化', '2021-01-28', 300, '<br>&emsp; &emsp;「我不確定是否是因為這一鍋鍋的煲湯，讓我老公從原本被醫生宣判的三個月生命延長至三年，但我相信大自然裡的原型食物有它們的力量，能帶來滿滿的營養，讓老公化療期間精神與體力幾乎和一般人無異……」<br><br>&emsp; &emsp;自己與家人都因喝湯而受惠的Lowlee，讓她一頭栽入自然食物的營養研究，並努力推廣煲湯飲食，剛開始只是分享給身邊的親友，後來慢慢在網路上分享給更多人，並獲得廣大回饋好評，進而開班授課並成立品牌，成為網路人氣店家。<br>&emsp; &emsp;', 10, '飲食', 'p_27.jpg', 3),
(28, '日日湯療：中醫師的39道對症家常湯', '陳峙嘉', '采實文化', '2016-12-01', 284, '<br>&emsp; &emsp;加班過勞、臉色差、全身痠痛、用眼過度等，喝湯就能緩解，<br>&emsp; &emsp;中醫師特調的39道對症家常湯，<br>&emsp; &emsp;省時‧美味‧紓壓，1碗就有感，<br>&emsp; &emsp;知名中醫師首度公開最有效的健康養生法，每天一碗好湯+養生茶，對症改善惱人小病痛！<br><br>&emsp; &emsp;【39道對症湯品】中醫師才知道的獨門湯方，緩解症狀最有效，一喝就有感。<br>&emsp; &emsp;【10大好食材】介紹家中要常備的好食物，搭配說明、保存方法，吃得健康又安心。<br>&emsp; &emsp;【10大好藥材】精選一般人可多吃的中藥材，搭配獨門茶飲作法，喝出健康不求人。<br>&emsp; &emsp;【5大療癒花草茶】特別收錄最療癒的茶飲，安定心神、解憂紓壓最有效。<br>&emsp; &emsp;', 10, '飲食', 'p_28.jpg', 5),
(29, '日日食療：中醫師精心設計42道療癒身心的對症家常菜', '陳峙嘉', '采實文化', '2017-10-26', 284, '<br>&emsp; &emsp;》早上醒不來上班沒精神，在「咖啡」裡加點「人參」，助你甦醒有元氣<br>&emsp; &emsp;》肩頸如化石，「葛根」＋「鮭魚」能舒緩痠痛、趕走壓力<br>&emsp; &emsp;》一變天就鼻塞，「桂枝」＋「生薑」能幫助發熱，吹到冷風不再打噴嚏<br>&emsp; &emsp;》頭痛想撞牆，今晚的「咖哩雞」裡加點「川芎」一起煮<br>&emsp; &emsp;》小兒尿床，可吃麻油桂圓「炒蛋」<br>&emsp; &emsp;》想要燃脂瘦小腹，可吃加了赤小豆x白腎豆的「溫沙拉」<br>&emsp; &emsp;', 10, '飲食', 'p_29.jpg', 2),
(30, '1個人吃の無敵蓋飯：90道懶人必學的快速料理大絕招！', '杵島隆太', '采實文化', '2017-11-30', 195, '<br>&emsp; &emsp;3步驟OK＋10分鐘搞定＝1碗大滿足<br>&emsp; &emsp;三菜一湯太麻煩，一碗蓋飯就搞定<br>&emsp; &emsp;90道色．香．味俱全的無敵蓋飯<br>&emsp; &emsp;絕對滿足你的貪吃魂<br><br>&emsp; &emsp;肚子餓也不用等<br>&emsp; &emsp;快速╳省時╳零失敗<br>&emsp; &emsp;只要利用冰箱現有食材烹煮<br>&emsp; &emsp;兩三下就能將美味端上桌<br>&emsp; &emsp;', 10, '飲食', 'p_30.jpg', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `account` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 2,
  `bill` int(8) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`account`, `password`, `email`, `level`, `bill`) VALUES
('admin', 'admin123456', 'admin@mail.com', 3, 0),
('member', 'member123456', 'member@mail.com', 2, 0),
('testlogin2', 'testpassword', 'test@gmail.com', 2, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `mycarousel`
--

CREATE TABLE `mycarousel` (
  `cid` int(8) NOT NULL,
  `pic` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ptitle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ptext` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `mycarousel`
--

INSERT INTO `mycarousel` (`cid`, `pic`, `ptitle`, `ptext`) VALUES
(1, 'book-1.jpg', '子敬我大哥，牛逼!', ''),
(2, 'animals-5.jpg', '好挖', '好耶'),
(3, 'animals-4.jpg', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `order_form`
--

CREATE TABLE `order_form` (
  `commodity_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `members_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_count` int(8) NOT NULL,
  `quantity` int(8) NOT NULL,
  `time` int(8) NOT NULL,
  `apply_for_return` int(5) NOT NULL DEFAULT 0,
  `sequence` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `reviews`
--

CREATE TABLE `reviews` (
  `pid` int(11) NOT NULL,
  `account` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `review` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `commodity`
--
ALTER TABLE `commodity`
  ADD PRIMARY KEY (`pid`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`account`);

--
-- 資料表索引 `mycarousel`
--
ALTER TABLE `mycarousel`
  ADD PRIMARY KEY (`cid`);

--
-- 資料表索引 `order_form`
--
ALTER TABLE `order_form`
  ADD PRIMARY KEY (`sequence`);

--
-- 資料表索引 `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`number`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `commodity`
--
ALTER TABLE `commodity`
  MODIFY `pid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_form`
--
ALTER TABLE `order_form`
  MODIFY `sequence` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reviews`
--
ALTER TABLE `reviews`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
