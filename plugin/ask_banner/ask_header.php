<?php
/*
 * ASK Banner Header
 */
if (!defined('_GNUBOARD_')) {
    exit;
} // 개별 페이지 접근 불가
?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ASK Banner</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/ask_banner.css">
        <link rel="stylesheet" href="css/font-awesome/font-awesome.min.css">
        <!-- jQuery first, then Tether, then Bootstrap JS. -->

        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.x-git.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/holder.min.js"></script>
        <script src="js/anchor.min.js"></script>
        <script src="js/clipboard.min.js"></script>
        <script src="js/ie-emulation-modes-warning.js"></script>
        <script src="js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript">
            $(function () {
                $('.tooltip').tooltip();
            });
        </script>
    </head>
    <body>

        <nav class="navbar navbar-dark bg-inverse">
            <div class="container">
                <a class="navbar-brand" href="./">ASK Banner</a>
                <ul class="nav navbar-nav">
                    <li class="nav-item active"><a class="nav-link" href="<?php echo G5_URL ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://www.asktheme.net/demo.php">Document</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://www.asktheme.net/bbs/board.php?bo_table=qna">Q&amp;A</a></li>
                </ul>
            </div><!-- /.container -->
        </nav>
        <div class="container">
            <div class="row">
                <div id="sidebar" class="aside col-sm-12 col-md-3 col-lg-2">
                    <div class="side-menu-wrap">
                        <h2 class="sr-only">메뉴</h2>
                        <ul class="side-menu">
                            <li>
                                <h3 class="sr-only">그룹</h3>
                                <ul class="sub-menu">
                                    <li><a href='./group_add.php'>그룹 등록</a></li>
                                    <li><a href='./group_list.php'>그룹 목록</a></li>
                                </ul>
                            </li>
                            <li>
                                <h3 class="sr-only">배너</h3>
                                <ul class="sub-menu">
                                    <li><a href='./banner_add.php'>배너 등록</a></li>
                                    <li><a href='./banner_list.php'>배너 목록</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="contents" class="col-sm-12 col-md-9 col-lg-10">
                    <!-- 컨텐츠 시작-->