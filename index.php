<?php require('index_processing.php');  ?>
<?php require('h.php');  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>sns</title>
    <link rel="stylesheet" href="css/sns.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body  class="form-group container background_color">
    <div class="header container">
      <div class="header_left">
        <h1>みんなで討論しよう！</h1>
      </div>
      <div class="header_right">
        <p><a href="index.php">トップへ</a></p>
      </div>

    </div>
    <form action="index.php" method="get">
      <div class="form_height">
        <div class="col-md-6">
          <div class="form">
            <label for="contributor">投稿者</label>
            <input type="text" class="form-control" id="contributor" name="contributor" placeholder="名前を入力してください">
          </div>
          <div class="form">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="タイトルを入力してください">
          </div>
          <div class="form">
            <label for="memo">詳細</label>
            <input type="text" class="form-control" id="memo" name="memo" placeholder="詳細を入力してください">
          </div>
            <input type="submit" value="送信" class="btn btn-primary">
            <input type="reset" value="リセット" class="btn btn-danger">
        </div>

        <div class="col-md-6 float_left">
          <div class="search_input">
            <label>検索ワード</label>
            <input type="text" class="form-control" name="key" placeholder="キーワードを入力してください">
          </div>
          <div class="search_icon">
            <button type="submit">
              <img src="img/search.png" width="25" height="25">
            </button>
          </div>
          <div class="col-md-6 float_left">
            <label>検索する項目を選んでください</label>
            <div class="radio">
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="contributor"> 投稿者
              </label>
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="title"> タイトル
              </label>
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="memo"> 詳細
              </label>
            </div>
          </div>
        </div>
      </div>
    </form>

    <h2 class="float_left">ルームリスト</h2>

    <div id="result" class="result container float_left">
      <?php if($rooms == null){echo "<h1>検索結果はありません</h1>";} ?>
      <?php foreach($rooms as $room): ?>
        ルームID： <?php echo $room["id"]; ?><br>
        投稿者： <?php echo h($room["contributor"]); ?> <br>
               <?php $href = "room.php?room_id=" . $room["id"]; ?>
        タイトル： <?php echo "<a href= {$href} >" . h($room["title"]) . "</a><br>"; ?>
        詳細： <?php echo h($room["memo"]); ?> <br>
        <div class="font_silver">
          <?php echo date("Y年m月d日 H:i",strtotime($room["created"])); ?>
        </div>
        <hr class="border">
      <?php endforeach;?>
    </div>
  </body>
</html>
