<?php require('room_processing.php') ?>
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

    <form action="room.php" method="get">
      <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
      <div class="form_height180">
        <div class="col-md-6">
          <div class="form">
            <label for="contributor">投稿者</label>
            <input type="text" class="form-control" id="contributor" name="contributor" placeholder="名前を入力してください">
          </div>
          <div class="form">
            <label for="title">コメント</label>
            <input type="text" class="form-control" id="comment" name="comment" placeholder="コメントを入力してください">
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
        </div>
          <div class="col-md-6 float_left">
            <label>検索する項目を選んでください</label>
            <div class="radio">
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="contributor"> 投稿者
              </label>
              <label class="radio-inline">
                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="comment"> コメント
              </label>
            </div>
          </div>
        </div>
    </form>

    <h2 class="container">ステートメント</h2>

    <div class="datail container">
      ルームID：<?php echo $room_id; ?><br>
      タイトル：<?php echo h($room_datail["title"]); ?><br>
      投稿者：<?php echo h($room_datail["contributor"]); ?><br>
      詳細：<?php echo h($room_datail["memo"]); ?><br>
      <div class="font_silver">
        <?php echo date("Y年m月d日 H:i",strtotime($room_datail["created"])); ?>
      </div>
    </div>

    <h2 class="container">コメント</h2>

    <div id="result" class="result container">
      <?php foreach ($contents as $content): ?>
        投稿者： <?php echo h($content["contributor"]); ?><br>
        コメント： <?php echo h($content["comment"]); ?><br>
        <div class="font_silver">
          <?php echo date("Y年m月d日 H:i",strtotime($content["created"])); ?>
        </div>
        <hr class="border">
      <?php endforeach; ?>
    </div>

  </body>
</html>
