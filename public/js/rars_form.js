$(function () {
    var userForm = $("#form");
    userForm.validate({
    // debug: true,
    submitHandler: function(form) {
        // do other things for a valid form
        // localStorage.setItem("Status", '1');
        $(':button[type="submit"]').prop("disabled", true);
        form.submit();
    },
    ignore: "#categories_primary",
    rules: {
        title: {
            required: true,
            maxlength: 250,
            // isChineseCharacter: true
        },
        content: {
            // required: true,
            maxlength: 4096,
            // isChineseCharacter: true
            lengthChineseCharacter: true
        },
        comment: {
            maxlength: 4096,
            // isChineseCharacter: true
            lengthChineseCharacter: true
            }
        }
    });
    //检测用户姓名是否为汉字  
    // jQuery.validator.addMethod("isChineseCharacter", function(value, element) {  
    //     var length = value.length;  
    //     var regName = /[\u4e00-\u9fa5]/g;  
    //     return (this.optional(element) || !regName.test( value ));    
    // }, "汉字。");  
    jQuery.validator.addMethod("lengthChineseCharacter", function(value, element) {  
        var length = value.length;  
        // console.log(length);
        var regName = /[\u4e00-\u9fa5]/g;  
        return (this.optional(element) || !regName.test( value ) || length < 2048);    
    }, "长度过长，请删减内容。");  



    let url_string = window.location.href;
    let url = new URL(url_string);
    let c = url.searchParams.get("view");
    if (c == 1) {
        let form = document.getElementById("form");
        let elements = form.elements;
        for (let i = 0, len = elements.length; i < len; ++i) {
             elements[i].readOnly = true;
             elements[i].disabled = true;
        
        }
        let backButton = document.getElementById("back-button");
        backButton.disabled = false;
        document.getElementById("delete1").style.display = 'none';
        document.getElementById("delete2").style.display = 'none';
        document.getElementById("delete3").style.display = 'none';
    } 


});