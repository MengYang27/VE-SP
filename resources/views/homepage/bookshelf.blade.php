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
            <div class="bookshelf mx-auto">
                <div class="shelf" id="shelf">
                    @isset($bookInRow)
                    <div class="row-1 bookrow">
                        <div class="loc">
                            @foreach($bookInRow[0] as $r)
                            <div>
                                <div class="sample" sample="se{{$r->id}}" style="background-image:url(/storage/samples/se{{$r->id}}/pages/thumb.jpg); background-position:bottom"></div>
                                <p class="bookname">{{$r->name}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bookrow">
                        <div class="loc">
                            @foreach($bookInRow[1] as $r)
                            <div>
                                <div class="sample" sample="se{{$r->id}}" style="background-image:url(/storage/samples/se{{$r->id}}/pages/thumb.jpg); background-position:bottom"></div>
                                <p class="bookname">{{$r->name}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endisset
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

        </div></div>

        <!-- End samples -->
        <div class="gradient"></div>
    </div>
    <script type="text/javascript" async="" src="/js/ga.js"></script>
    <script type="text/javascript" src="/js/all.js"></script>
    <script type="text/javascript" src="/js/hash.js"></script>
    <script type="text/javascript" src="/js/turn.min.js"></script>
    <script type="text/javascript" src="/js/zoom.min.js"></script>
    <script type='text/javascript'>
        (function ($) {
            @isset($bookInRow)
            samples = {
                @foreach($bookInRow as $row)
                @foreach($row as $book)
                'se{{$book->id}}': {
                    'path': 'storage/samples/se{{$book->id}}/'
                }
                @unless($loop -> parent-> last && $loop ->last),
                @endunless
                @endforeach

                @endforeach
            };
            @endisset
        })(jQuery);
    </script>
    <script type="text/javascript">
    @isset($bookInRow)
    var bookInRow = {!!json_encode($bookInRow)!!};
    var rowCount = {{$rowCount}};
    @endisset
    </script>
    <script type="text/javascript" src="/js/scroll.js"></script>
    <script type="text/javascript" src="/js/bookshelf.js"></script>
</body>

</html>
