$(document).ready(function () {
    //定义全局的变量
    var requestUrl = "http://localhost/honeypot/index.php/Home/";
    var signErrorTips = $('.sign-error-tips');
    var loginErrorTips = $('.login-error-tips');
    //获取url参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg); //匹配目标参数
        if (r != null) return decodeURI(r[2]); return null; //返回参数值
    }
    /**
     * 阻止冒泡使再登录和注册容器内不会触发时间
     */
    $('.login-form').click(function (event) {
        event.stopPropagation();
    });
    $('.sign-form').click(function (event) {
        event.stopPropagation();
    });

    /**
     * 登陆注册的错误与正确提示信息
     */
    function formModal(type,obj,val) {
        obj.text(val);
        if(type == 1){
            obj.css('color','#fe1f1f');
        }else if(type == 2){
            obj.css('color','#15ff03');
        }
        obj.css({
            'z-index':'10',
            'top':'45%',
            'opacity':1
        });
        setTimeout(function () {
            obj.css({
                'top':'50%',
                'opacity':0
            });
            setTimeout((function(){
                obj.css('z-index','-10');
                obj.text("");
            }),300)
        },2000);
    }

    /**
     *   操作提示框显示与点击确定隐藏
     */
    function operateModalShow(msg) {
        $('.tips-content').text(msg);
        $('#tips-modal').css({
            'z-index':'99',
            'opacity':1
        });
    }
    function operateModalHide() {

        $('#tips-modal').css({
            'opacity':0
        });
        setTimeout((function(){
            $('#tips-modal').css({
                'z-index':'-99',
            });
        }),100);
    }

    /**
     * 点击确定隐藏
     */
    $('.btn-determine').click(function () {
        operateModalHide();
    });
    /**
     * 登录框弹出
     */
    function showLoginModal() {
        $('#login-container').css('display','block');
        setTimeout(function () {
            $('.login-form').css({
                'opacity':1,
                'margin-top':'100px'
            });
        },100);
    }
    $('.login').click(function () {
        showLoginModal();
    });
    /**
     * 登录框隐藏
     */
    function hideLoginModal() {
        var hei = $('.login-form').height();
        $('.login-form').css({
            'opacity':0,
            'margin-top':-hei+"px"
        });
        setTimeout(function () {
            $('#login-container').css('display','none');
        },300);
    }
    
    $('#login-container').click(function () {
        hideLoginModal();
    });
    /**
     * 注册框弹出
     */
    function showSignModal() {
        $('#sign-container').css('display','block');
        setTimeout(function () {
            $('.sign-form').css({
                'opacity':1,
                'margin-top':'100px'
            });
        },100);
    }
    $('.sign').click(function () {
        showSignModal();
    });
    /**
     * 注册框隐藏
     */
    function hideSignModal() {
        var hei = $('.sign-form').height();
        $('.sign-form').css({
            'opacity':0,
            'margin-top':-hei+"px"
        });
        setTimeout(function () {
            $('#sign-container').css('display','none');
        },500);
    }
    $('#sign-container').click(function () {
        hideSignModal();
    });
    /**
     * 判断是登录还是注册
     */
    var index_type = getUrlParam('index_type');
    (function () {
        if(index_type == 1){
            showLoginModal();
        }
    })();



    /**
     *注册提交前自动去验证
     */
    $('.sign-username input[name=username]').blur(function () {
        var username = $(this).val();
        $.post(requestUrl+'Index/registerVerify',{username:username},function (data) {
            if(data.code != 200){
                formModal(1,signErrorTips,data.msg);
            }
        })
    });
    $('.sign-nickname input[name=nickname]').blur(function () {
        var nickname = $(this).val();
        $.post(requestUrl+'Index/registerVerify',{nickname:nickname},function (data) {
            if(data.code != 200){
                formModal(1,signErrorTips,data.msg);
            }
        })
    });

    /**
     * 注册
     * @param string username
     * @param string nickname
     * @param string password
     * @param string repassword
     */
    $('.sign-submit').click(function () {
        var username = $('.sign-username input[name=username]').val();
        var nickname = $('.sign-nickname input[name=nickname]').val();
        var password = $('.sign-password input[name=password]').val();
        var repassword = $('.sign-repassword input[name=repassword]').val();
        if(username == ""){
            formModal(1,signErrorTips,"请输入用户名！");
            return false;
        }else if(nickname == ""){
            formModal(1,signErrorTips,"请输入昵称！");
            return false;
        }else if(password == ""){
            formModal(1,signErrorTips,"请输入密码！");
            return false;
        }else if(password.length < 6 || password.length > 16){
            formModal(1,signErrorTips,"请输入6到16位长度的密码！");
            return false;
        }else if(repassword == ""){
            formModal(1,signErrorTips,"请再次输入密码以确保两次密码输入一致！");
            return false;
        }else if(password != repassword){
            formModal(1,signErrorTips,"两次密码不一致，请再次确认！");
            return false;
        }
        password = hex_md5(password);
        repassword = hex_md5(repassword);
        $.post(requestUrl+'Index/sign',{username:username,nickname:nickname,password:password,repassword:repassword},function (data) {
            if(data.code == 200){
                formModal(2,signErrorTips,"注册成功！");
                setTimeout(function () {
                    window.location.reload();
                },2000);
            }
        })

    });

    /**
     *  登录
     *  @param string username
     *  @param string nickname
     */
    $('.login-submit').click(function (event) {
        event.stopPropagation();
        var username = $('.login-username input[name=username]').val();
        var password = $('.login-password input[name=password]').val();
        var cases_id = getUrlParam('cases_id');
        var key_word = getUrlParam('key_word');
        var order_type = getUrlParam('order_type');
        password = hex_md5(password);
        $.post(requestUrl+'Index/login',{username:username,password:password},function (data) {
            if(data.code == 200){
                formModal(2,loginErrorTips,"登录成功！");
                setTimeout(function () {
                    if(cases_id != null){
                        window.location.href = "http://localhost/honeypot/index.php/Home/Index/getCases?cases_id="+cases_id;
                    }else if(key_word != null){
                        window.location.href = "http://localhost/honeypot/index.php/Home/Index/search?key_word="+key_word+"&order_type="+order_type;
                    }else {
                        window.location.href = "http://localhost/honeypot/index.php/Home/Index/index";
                    }

                },2000);
            }else {
                formModal(1,loginErrorTips,data.msg);
            }
        })
    });

    /**
     * 退出登录
     */
    $('.index-login-out').click(function () {
        $.post(requestUrl+'Index/loginOut',function (data) {
            if(data.code == 200){
                window.location.reload();
            }else {
                operateModalShow("用户退出失败!");
            }
        })
    });


    /**
     * 搜索页选择排序规则
     */
    $('.order-type').each(function () {
        $(this).click(function () {
            var type = $(this).attr('type');
            var key = $('.search-key-word').val();
            window.location.href =  requestUrl+"Index/search?type="+type+"&key="+key;
        });
    });


    /**
     * 上传图片
     */
    $("#upload-cases-image").click(function () {
        $("#btn-cases-image").click();
    });
    $(document).ready(function (e) {
        $("#btn-cases-image").change(function (e) {
            var formData = new FormData();
            formData.append('file', $('#btn-cases-image')[0].files[0]);  //添加图片信息的参数
            // var formData = new FormData($("#cases-image")[0]);
            $.ajax({
                url: requestUrl + 'Index/casesImgUpload',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#btn-cases-image').outerHTML = $('#btn-cases-image').outerHTML;
                    if (data.code == "200") {
                        var str = "<div class='image-list'><i class='remove-cases-image'></i><img src='"+data.data.image+"' class='cases-image-url' draft_id='"+data.data.draft_id+"'></div>";
                        $(".release-image-container").append(str);
                    } else if(data.code == 100) {
                        window.location.href = "http://localhost/hoenypot/index.php/Home/Index/index?index_type=1";
                    } else {
                        operateModalShow(data.msg);
                    }
                },
                error: function () {
                    $('#btn-cases-image').outerHTML = $('#btn-cases-image').outerHTML;
                    operateModalShow("网络错误，请重试！");
                }
            })
        })
    });

    /**
     * 移除图片
     */
    $('.release-image-container').on('click','.remove-cases-image',function () {
            var _this = $(this);
            var draft_id = $(this).parent().find(".cases-image-url").attr('draft_id');
            var image = $(this).parent().find(".cases-image-url").attr('src');
            $.post(requestUrl+'Index/removeCaseImg',{draft_id:draft_id,image:image},function (data) {
                if(data.code == 100){
                    window.location.href = "http://localhost/hoenypot/index.php/Home/Index/index?index_type=1";
                }else if(data.code == 200){
                    $(_this).parent('.image-list').remove();
                }else{
                    operateModalShow(data.msg);
                }
            })
    });
    $('.remove-cases-image').l

    /**
     * 发布作品
     */
    $('.btn-submit-cases').click(function () {
        var title = $('.release-cases-title').val();
        var synopsis = $('.release-cases-synopsis').val();
        var images = "";
        var draft_id = "";
        $.each($('.cases-image-url'), function (k, v) {
            images += $(v).attr('src') + ",";
            draft_id += $(v).attr('draft_id')+",";
        });
        images = images.substring(0, images.length - 1);
        draft_id = draft_id.substring(0, draft_id.length - 1);
        $.post(requestUrl + 'Index/publishCases', {title: title, synopsis: synopsis, images: images,draft_id : draft_id}, function (data) {
                if(data.code == 100){
                    window.location.href = "http://localhost/honeypot/index.php/Home/Index/index?index_type=1";
                }else if(data.code == 200){
                    operateModalShow(data.msg);
                    setTimeout(function () {
                      window.location.reload();
                    },500)
                }else {
                    operateModalShow(data.msg);
                }
        });
    });

    /**
     * 搜索
     */
    $('.search-btn').click(function () {
        var key_word = $('.search-key-word').val();
        var order_type = $('.order-type-active').attr('order_type');
        window.location.href = "http://localhost/honeypot/index.php/Home/Index/search?key_word="+key_word+"&order_type="+order_type;
    });

    $('.index-btn-search').click(function () {
        var key_word = $('.index-search-text').val();
        window.location.href = "http://localhost/honeypot/index.php/Home/Index/search?key_word="+key_word+"&order_type=1";
    });

    /**
     * 排序
     */
    $('.order-type').each(function () {
        $(this).click(function () {
            var order_type = $(this).attr('order_type');
            var key_word = $('.search-key-word').val();
            window.location.href = "http://localhost/honeypot/index.php/Home/Index/search?key_word="+key_word+"&order_type="+order_type;
        });
    });

    /**
     * 回复
     */
    $('.join-comment-btn').on('click','.comment-can-submit',function () {
       var content = $('.join-comment-content').val();
       var cases_id = $(this).attr('cases_id');
       $.post(requestUrl+'Index/addReply',{content:content,cases_id:cases_id},function (data) {
           if(data.code == 100){
               window.location.href = "http://localhost/honeypot/index.php/Home/Index/getCases?index_type=1&cases_id="+cases_id;
           }else if(data.code == 200){
               operateModalShow(data.msg);
               setTimeout(function () {
                   window.location.reload();
               },2000)
           }else {
               operateModalShow(data.msg);
           }
       })
    });


    /**
     * 收藏作品
     */
    $('.increase-collect').click(function () {
        var cases_id =  $(this).attr('cases_id');
        $.post(requestUrl+"Index/collectCases",{cases_id:cases_id},function (data) {
            if(data.code == 100){
                window.location.href = "http://localhost/honeypot/index.php/Home/Index/getCases?index_type=1&cases_id="+cases_id;
            }else if(data.code == 200){
                operateModalShow(data.msg);
                setTimeout(function () {
                    window.location.reload();
                },2000)
            }else {
                operateModalShow(data.msg);
            }
        })
    });

    /**
     * 取消收藏
     */
    $('.cancel-collect').click(function () {
        var cases_id =  $(this).attr('cases_id');
        $.post(requestUrl+"Index/cancelCollect",{cases_id:cases_id},function (data) {
            if(data.code == 100){
                window.location.href = "http://localhost/honeypot/index.php/Home/Index/getCases?index_type=1&cases_id="+cases_id;
            }else if(data.code == 200){
                operateModalShow(data.msg);
                setTimeout(function () {
                    window.location.reload();
                },2000)
            }else {
                operateModalShow(data.msg);
            }
        })
    })

    /**
     * 点击购买作品
     */
    $('.click-buy-cases').click(function () {
        var cases_id = $(this).attr('cases_id');
        $.post(requestUrl+'Index/buyCases',{cases_id:cases_id},function (data) {
            if(data.code == 100){
                window.location.href = "http://localhost/honeypot/index.php/Home/Index/getCases?index_type=1&cases_id="+cases_id;
            }else if(data.code == 200){
                operateModalShow(data.msg);
                setTimeout(function () {
                    window.location.reload();
                },2000)
            }else {
                operateModalShow(data.msg);
            }
        })
    });
});