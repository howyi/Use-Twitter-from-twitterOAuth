<html>
  <head>
    <title>Tweet</title>
  </head>
  <body>
    <pre>
      <?php
      session_start();

      require "twitteroauth/autoload.php";
      use Abraham\TwitterOAuth\TwitterOAuth;

      require "initialize.php";

      #APIにアクセスするためのアクセストークンを用いて$connectionを作成
      $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,
      $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

      #"Hello,world!"とツイートする、$resultにはbool型で実行結果が出力される
      $result = $connection->post('statuses/update', array('status' => "Hello,world!"));
      if($result){
        print ("success!");
      }else{
        print ("failed...");
      }

      #ログインしたアカウントのプロフィールの取得、出力
      var_dump($connection->get("account/verify_credentials"));
      ?>
    </pre>
  </body>
</html>
