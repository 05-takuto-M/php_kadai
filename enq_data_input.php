<?php
// データまとめ用の空文字変数
// $str = '';

$html=0;
$js=0;
$php=0;
$laravel=0;
$python=0;
$swift=0;
$ruby=0;

// $zenbu=0;
// $jsga=0;
// $imanotokoro=0;
// $lara=0;
// $pyth=0;



// 1 全部無理
// 2 jsが無理
// 3 今のところ大丈夫
// 4 もぉLaravelやってる位
// 5 Pythonやっちゃってます

// ファイルを開く（読み取り専用）
$file = fopen('data/data.csv', 'r');
// ファイルをロック
flock($file, LOCK_EX);

// fgets()で1行ずつ取得→$lineに格納
if ($file) {
  while ($line = fgets($file)) {
    $arrey=explode(" ",$line);
    if($arrey[7]=="html/css"){$html=$html+1;}
    else if($arrey[7]=="javascript"){$js=$js+1;}
    else if($arrey[7]=="php"){$php=$php+1;}
    else if($arrey[7]=="Laravel"){$laravel=$laravel+1;}
    else if($arrey[7]=="Python"){$python=$python+1;}
    else if($arrey[7]=="Swift"){$swift=$swift+1;}
    else if($arrey[7]=="Ruby"){$ruby=$ruby+1;}
    
    // // 取得したデータを`$str`に追加する
    // $str .="<tr><td>{$line}</td></tr>";
    // echo $arrey[7];
  }
};

// if ($file) {
//   while ($line = fgets($file)) {
//     $arrey2=explode(" ",$line);
//     echo $arrey2[6];
    // if($arrey2[6]=="1 全部無理"){$zenbu=$zenbu+1;}
    // else if($arrey2[6]=="2 jsが無理"){$jsga=$jsga+1;}
    // else if($arrey2[6]=="3 今のところ大丈夫"){$imanotokoro=$imanotokoro+1;}
    // else if($arrey2[6]=="4 もぉLaravelやってる位"){$lara=$lara+1;}
    // else if($arrey2[6]=="5 Pythonやっちゃってます"){$pyth=$pyth+1;}
    
    // // 取得したデータを`$str`に追加する
    // $str .="<tr><td>{$line}</td></tr>";
//   }
// };
// echo($html);
// echo($js);
// echo($php);
// echo($laravel);
// echo($python);
// echo($swift);
// echo($ruby);
// ロックを解除する
flock($file, LOCK_UN);
// ファイルを閉じる
fclose($file);

// `$str`に全てのデータ（タグに入った状態）がまとまるので，HTML内の任意の場所に表示する．
?>
<?php
//phpでのデータ
$x = array("html/css", "javascript", "php", "Laravel", "Python","Swift","Ruby");
$y = array($html, $js, $php, $laravel, $python,$swift,$ruby);

//javascriptに渡す
$jx = json_encode($x);
$jy = json_encode($y);

?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.0/Chart.min.js"></script>
  <title>プラグラミングアンケート（入力画面）</title>
</head>

<body>
  <form action="enq_data_create.php" method="POST">
  
    <fieldset>
      <legend>プログラミング理解度アンケート（入力画面）</legend>
      <a href="enq_data_read.php">一覧画面</a>
      <div>
        お名前  : <input type="text" name="name">
      </div>
      <div>
        年齢　  : <input type="text" name="age">
      </div>
      <div>
        性別　  :
        男 <input type="radio" name="gender" value="男">
        女 <input type="radio" name="gender" value="女">
      </div>
      <div>
        Mobile : <input type="text" name="number" placeholder="090-1234-5678">
      </div>
      <div>
        Email  : <input type="text" name="address"placeholder="info@example.com">
      </div>
      <div>
        理解度：
        <input type="radio" name="rikaido" value="1 全部無理">1 全部無理
        <input type="radio" name="rikaido" value="2 jsが無理">2 jsが無理
        <input type="radio" name="rikaido" value="3 今のところ大丈夫">3 今のところ大丈夫
        <input type="radio" name="rikaido" value="4 もぉLaravelやってる位">4 もぉLaravelやってる位
        5<input type="radio" name="rikaido" value="5 Pythonやっちゃってます"> Pythonやっちゃってます
      </div>
      <div>
        得意な言語(複数選択可)：
      </div>
      <div>
        <input type="checkbox" name="gengo" value="html/css">html/css
        <input type="checkbox" name="gengo" value="javascript">javascript
        <input type="checkbox" name="gengo" value="php">php
        <input type="checkbox" name="gengo" value="Laravel">Laravel
        <input type="checkbox" name="gengo" value="Python">Python
        <input type="checkbox" name="gengo" value="Swift">Swift
        <input type="checkbox" name="gengo" value="Ruby">Ruby
      </div>
      <div>
        <textarea name="toiawase" rows="4" cols="40" placeholder="不明点など具体的に記述してください"></textarea>
      </div>
      <div>
        <button>submit</button>
      </div>
      <div>
      <input type="reset" value="cancel" />
      </div>
    </fieldset>
  </form>
  <!-- <fieldset> -->
    <!-- <legend>アンケート結果（グラフ）</legend> -->
    <div>アンケート結果（グラフ）</div>
    

    <!-- <a href="enq_data_input.php">入力画面</a>
    <table>
      <thead>
        <tr>
          <th><?=$str?></th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </fieldset> -->
  
  
<canvas id="myPieChart"style="position: relative; vh:50%; vw:50%"></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

<script>


//phpから値を受け取る
let x = JSON.parse('<?php echo $jx; ?>');
let y = JSON.parse('<?php echo $jy; ?>');


//以下，グラフを表示
var ctx = document.getElementById("myPieChart");
  var myLineChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: x,
      datasets: [
        {
          label: 'Yの値',
          data: y,
          borderColor: "rgba(0,100,100,1)",
          backgroundColor: "rgba(0,0,100,0.5)"
        },
        {
          label: 'Xの値',
          data: x,
          borderColor: "rgba(0,0,0,0)",
          backgroundColor: "rgba(0,0,0,1)"
        }
      ],
    },
    options: {
      title: {
        display: true,
        text: '得意な言語'
        
      },
      // scales: {
      //   yAxes: [{
      //     ticks: {
      //       suggestedMax: 20,
      //       suggestedMin: 0,
      //       stepSize: 10,
      //       callback: function(value, index, values){
      //         return  value +  'cm'
      //       }
      //     }
      //   }]
      // },
    }
  });
  </script>


</body>

</html>