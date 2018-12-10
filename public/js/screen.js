(function ($) {
    var width = $(window).width();
    var height = $(window).height();
    var bookperrow, initialRowNum;
    var allBooks = allBooksObj;
    if (width > height) {
        bookperrow = 5;
        initialRowNum = 2;
    } else {
        bookperrow = 3;
        initialRowNum = 4;
    }
    bookperrow = 5;
    initialRowNum = 2;
    // bookInRow = divideRows(allBooks, bookperrow);
    var shelf = document.getElementById("shelf");
    var i;
    // for (i = 0; i < initialRowNum; i++) {
    //     var books = bookInRow[i];
    //     var rowItem = createRow(books);
    //     if (i = 0) {
    //         rowItem.className = "bookrow row-1";
    //     }
    //     shelf.appendChild(rowItem);
    // }

    // hover();

    // create row div
    function createRow(books) {
        var rowItem = document.createElement("div");
        rowItem.className = "bookrow";
        var locItem = document.createElement("div");
        locItem.className = "loc";
        var docFragments = document.createDocumentFragment();
        $.each(books, function (index, value) {
            docFragments.appendChild(createBook(value));
        });
        locItem.appendChild(docFragments);
        rowItem.appendChild(locItem);
        
        return rowItem;
    }
    // create book div for row
    function createBook(book) {
        var id = book['id'];
        var name = book['name'];
        var divItem = document.createElement("div");
        var sampleItem = document.createElement("div");
        sampleItem.className = "sample";
        sampleItem.setAttribute("sample", "se" + id);
        var style = "background-image:url(/storage/samples/se" + id + "/pages/thumb.jpg); background-position:bottom";
        sampleItem.setAttribute("style", style);
        divItem.appendChild(sampleItem);
        var pItem = document.createElement("p");
        pItem.className = "bookname";
        pItem.innerHTML = name;
        divItem.appendChild(pItem);
        return divItem;
    }
    // divide array based on book per row
    function divideRows(allBooks, bookPerRow) {
        var bookcount = allBooks.length;
        var rowCount = Math.ceil(bookcount / bookPerRow);
        var i;
        var bookInRow = [];
        for (i = 0; i < rowCount; i++) {
            var startbooknum = i * bookPerRow;
            var j;
            var temp = [];
            for (j = 0; j < bookPerRow; j++) {
                temp.push(allBooks[startbooknum + j]);
            }
            bookInRow.push(temp);
        }
        return bookInRow;
    }
    // add hover function
    function hover() {
        $('.loc .sample').bind($.mouseEvents.over, function (e) {

            $(this).addClass('hover');
            e.preventDefault();

        }).bind($.mouseEvents.out, function (e) {

            $(this).removeClass('hover');
        });
    }
})(jQuery);


// // scroll function
// (function ($) {
//     var i = 2;
//     var currentHeight;
//     var ADD_HEIGHT = 210;
//     //滚动条距底部的距离
//     var BOTTOM_OFFSET = 0;

//     $(document).ready(function () {
//         $(window).scroll(function () {
//             var $currentWindow = $(window);
//             //当前窗口的高度
//             var windowHeight = $currentWindow.height();
//             currentHeight = windowHeight;
//             console.log("current widow height is " + windowHeight);
//             //当前滚动条从上往下滚动的距离
//             var scrollTop = $currentWindow.scrollTop();
//             console.log("current scrollOffset is " + scrollTop);
//             //当前文档的高度
//             var docHeight = $(document).height();
//             console.log("current docHeight is " + docHeight);

//             //当 滚动条距底部的距离 + 滚动条滚动的距离 >= 文档的高度 - 窗口的高度
//             //换句话说：（滚动条滚动的距离 + 窗口的高度 = 文档的高度）  这个是基本的公式
//             if ((BOTTOM_OFFSET + scrollTop) >= docHeight - windowHeight) {
//                 // console.log("current i is " +i);
//                 // console.log("current rowCount is " +!(typeof rowCount === 'undefined'));
//                 if (!(typeof rowCount === 'undefined') && !(typeof bookInRow === 'undefined') && i < rowCount) {
//                     createListItems();
//                 }
//             }
//         });
//     });

//     function createListItems() {
//         console.log("current i is " + i);
//         var myDocument = document;
//         var splash = myDocument.getElementById("splash");
//         currentHeight += ADD_HEIGHT;
//         splash.setAttribute("style", "height:" + currentHeight + "px");
//         var shelf = myDocument.getElementById("shelf");
//         var rowItem = myDocument.createElement("div");
//         rowItem.className = "bookrow";
//         var locItem = myDocument.createElement("div");
//         locItem.className = "loc";
//         var books = bookInRow[i];
//         var docFragments = myDocument.createDocumentFragment();
//         $.each(books, function (index, value) {
//             var id = value['id'];
//             var name = value['name'];
//             var divItem = myDocument.createElement("div");
//             var sampleItem = myDocument.createElement("div");
//             sampleItem.className = "sample";
//             sampleItem.setAttribute("sample", "se" + id);
//             var style = "background-image:url(/storage/samples/se" + id + "/pages/thumb.jpg); background-position:bottom";
//             sampleItem.setAttribute("style", style);
//             divItem.appendChild(sampleItem);
//             var pItem = myDocument.createElement("p");
//             pItem.className = "bookname";
//             pItem.innerHTML = name;
//             divItem.appendChild(pItem);
//             docFragments.appendChild(divItem);
//         });
//         locItem.appendChild(docFragments);
//         rowItem.appendChild(locItem);
//         shelf.appendChild(rowItem);
//         i++;

//     }
// })(jQuery);