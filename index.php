<html>
  <head>
    <title>Authorize</title>
  </head>
  <body>
    <?php
    session_start();  #トークンの共有にセッション関数を使うので、全てのphpの最初にsession_start();を入れる

    #twitterOAuthの読み込み
    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    #認証時に必要な設定の読み込み(initialize.php参照)
    require "initialize.php";

    #initialize.phpで入力した値を用いてTwitterに接続
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

    #認証URLを取得するためのリクエストトークンの生成
    $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

    #認証後にアクセストークンを取得するために、セッション関数にトークンを保存することでコールバック後にアクセス出来るようにする
    $_SESSION['oauth_token'] = $request_token["oauth_token"];
    $_SESSION['oauth_token_secret'] = $request_token["oauth_token_secret"];

    #認証URLの取得
    $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

    print("<a href = \"${url}\">authorize</a>");
    ?>
  </body>
</html>
