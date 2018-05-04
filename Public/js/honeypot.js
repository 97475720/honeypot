$(document).ready(function () {
    //定义全局的变量
    var requestUrl = "http://localhost/honeypot/index.php/Home/";
    var signErrorTips = $('.sign-error-tips');
    var loginErrorTips = $('.login-error-tips');
    //获取url参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg); //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
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
    function operateModalShow() {

        $('#tips-modal').css({
            'width':'300px',
            'height':'200px',
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
                'width':0,
                'height':0
            });
        }),100)
    }
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
        password = hex_md5(password);
        $.post(requestUrl+'Index/login',{username:username,password:password},function (data) {
            if(data.code == 200){
                formModal(2,loginErrorTips,"登录成功！");
                setTimeout(function () {
                    window.location.reload();
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
                window.location.href = requestUrl+"Index/index";
            }else {

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
                    if (data.code == "200") {
                        var str = "<div class='image-list'><img src='"+data.data+"'></div>"
                        $(".release-image-container").append(str);
                    } else {
                        operateModalShow();
                    }
                },
                error: function (data) {
                    operateModalShow();
                }
            })
        })
    });

});