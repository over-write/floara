<!doctype html>
<html xmlns:og="http://ogp.me/ns#" lang="ja">
<head>
    <meta charset="utf-8">
    <title>Froula Test | wysiwyg Change table data</title>
    <meta name="viewport" content="width=750px">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:description" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src" content="">
    <meta name="twitter:domain" content="">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" href="" />
    <link rel="shortcut icon" href="">


    <link href="./css/froala_editor.min.css" rel="stylesheet" type="text/css">
    <link href="./css/froala_style.min.css" rel="stylesheet" type="text/css">

    <link href="css/style.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,700,700i" rel="stylesheet">

    <script type="text/javascript" src="js/jquery.js"></script>

    <?php basename($_SERVER['PHP_SELF']); ?>
    <?php if(basename($_SERVER['PHP_SELF']) == "admin.php"){ ?>
    <script type='text/javascript' src='js/froala_editor.min.js'></script>
    <script type='text/javascript' src='js/plugins/link.min.js'></script>
    <script type='text/javascript' src='js/plugins/table.min.js'></script>
    <script type='text/javascript' src='js/languages/<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>.js'></script>
        <script>
            $(function() {

                $.FroalaEditor.DefineIcon('insert', {NAME: 'plus'});
                $.FroalaEditor.RegisterCommand('insert', {
                    title: 'Add Row the bottom(最下部に1件追加)',
                    focus: true,
                    undo: true,
                    refreshAfterCallback: true,
                    callback: function () {
                        $('#theaters tbody > tr:last').after('<tr><td>エリア</td><td>店名</td><td>営業時間</td></tr>')
                    }
                });
                $.FroalaEditor.DefineIcon('clear', {NAME: 'remove'});
                $.FroalaEditor.RegisterCommand('clear', {
                    title: 'Delete Row the bottom (最下部を１件削除)',
                    focus: false,
                    undo: true,
                    refreshAfterCallback: true,
                    callback: function () {
                        $('#theaters tbody > tr:last').remove();
                        this.events.focus();
                    }
                });

                $('div#froala-editor').froalaEditor({
                    language: '<?php echo substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); ?>',
                    height:500,
                    linkAlwaysBlank: true,
                    tableEditButtons: ['tableRows'],
                    linkList: [
                        {
                            text: 'オーバーライト',
                            href: 'https://overwrite.jp',
                            target: '_blank',
                            rel: 'nofollow'
                        }
                    ],
                    linkEditButtons: ['linkEdit', 'linkRemove'],
                    toolbarButtons:  ['insert','clear','undo', 'redo','insertLink'],
                    // Define new inline styles.
                    inlineStyles: {
                        'Big Red': 'font-size: 20px; color: red;',
                        'Small Blue': 'font-size: 14px; color: blue;'
                    },
                });

                $('#send').click(function() {
                    var postData = {"table-data": $('#theaters').html()};
//                    alert($('#theaters').html());
                    $.post(
                        "admin.php",
                        postData,
                        function (data) {
                            $(".preview").css("display","block");
                            alert(data);
                        }
                    );
                });

                $(".fadeout").fadeOut("5000");
            })
        </script>
    <?php } ?>

</head>
<body>
<div class="modaal-container">

    <?php if(basename($_SERVER['PHP_SELF']) == "admin.php"){ ?>
    <div class="btn-area">
        <?php if(isset($_POST["init"])) { ?>
            <p class="fadeout">Initialized.(初期化しました)</p>
        <?php } ?>
        <form action="./admin.php" method="post"><input type="submit" value="Initialize（初期データに戻す）"  name="init"></a></form>
    </div>
    <?php } ?>

    <?php if(basename($_SERVER['PHP_SELF']) == "admin.php"){ ?>
    <div class="btn-area preview" style="display: none;margin-top: 20px;">
        <a href="./" target="_blank"><input type="button" value="Preview(サイトを確認する)" ></a>
    </div>
    <?php } ?>
    <section class="m-box">
        <div id="froala-editor">
            <table id="theaters">
                  <?php

                  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

                  $server = $url["host"];
                  $username = $url["user"];
                  $password = $url["pass"];
                  $db = substr($url["path"], 1);

                  $link = mysqli_connect($server, $username, $password, $db);
                  $result = mysqli_query($link, "select * from page");
                  while($page = mysqli_fetch_array($result)) {
                      $body = $page['body'];
                  }
                  echo $body;

                  ?>
            </table>
        </div>
   </section>
<?php if(basename($_SERVER['PHP_SELF']) == "admin.php"){ ?>
        <div class="btn-area">
            <input type="button" value="save(保存)" id="send" >
        </div>

    <div style="line-height:1.2em">
        <h3>How to Use</h3>
        You Can Change Table data on Directory.<br />
        If you changed the data the data keeping you saved.<br />
        And you can see the preview btn that linked Guest Side url!<br />
        <b>Let's Enjoy!</b>
    </div>

<?php } ?>
</div>

</body>
</html>