<!DOCTYPE html>
<html lang="zh-CN" class="noie js csstransforms csstransforms3d">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>学生经验分享</title>
    <link type="text/css" rel="stylesheet" href="css/app.css">
    <link type="text/css" rel="stylesheet" href="css/bookshelf.css">
    <link type="text/css" rel="stylesheet" href="css/jquery.ui.css">
    <meta name="viewport" content="width=1200">
</head>

<body>
    <div class="splash" id="splash" style="height:700px">
        <div class="center row">
            <div class="bookshelf">
                <div class="shelf" id="shelf">

                </div>
            </div>
        </div>
        <!-- Samples-->
        <div class="row">
            <div class="samples">
                <div class="bar">
                    <a class="icon quit"></a>
                </div>
                <div id="book-wrapper">
                    <div id="book-zoom"></div>
                </div>

            </div>
        </div>

        <!-- End samples -->
        <div class="gradient"></div>
    </div>
    @isset($allBooks)
    <script type="text/javascript" src="/js/all.js"></script>
    <script type='text/javascript'>
        var allBooksObj = {!!json_encode($allBooks, JSON_UNESCAPED_UNICODE)!!};
        var bookInRow;
    </script>
    <script type="text/javascript" src="/js/screen.js"></script>
    <script type='text/javascript'>
        (function ($) {

            samples = {
                @foreach($allBooks as $book)
                'se{{$book->id}}': {
                    'path': 'storage/samples/se{{$book->id}}/'
                }
                @unless($loop -> last),
                @endunless
                @endforeach
            };

        })(jQuery);
    </script>
    <script type="text/javascript" src="/js/bookshelf.js"></script>
    <script type="text/javascript" async="" src="/js/ga.js"></script>
    <script type="text/javascript" src="/js/hash.js"></script>
    <script type="text/javascript" src="/js/turn.min.js"></script>
    <script type="text/javascript" src="/js/zoom.min.js"></script>
    

    
    @endisset
</body>

</html>