<html>
  <head>
    <title>Callback</title>
  </head>
  <body>
    <?php
    session_start();

    require "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    require "initialize.php";

    #index.phpでセッション関数に代入したトークンを用いて$connectionを作成
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,$_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

    #APIのアクセスに必要なトークンを取得
    $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

    #セッション関数に入れておいたコールバック用トークンを差し替える
    $_SESSION['oauth_token'] = $access_token["oauth_token"];
    $_SESSION['oauth_token_secret'] = $access_token["oauth_token_secret"];
    ?>
    <a href = "tweet.php">Tweet!</a>
  </body>
</html>
