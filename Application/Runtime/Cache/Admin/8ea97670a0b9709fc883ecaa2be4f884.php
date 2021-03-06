<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加标签</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/MyProject/PHP/think_blog/Public/static/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/MyProject/PHP/think_blog/Public/static/bootstrap-3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/MyProject/PHP/think_blog/Public/static/font-awesome-4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/MyProject/PHP/think_blog/Public/static/css/bjy.css">
    <link rel="stylesheet" type="text/css" href="/MyProject/PHP/think_blog/Template/default/Home/Public/css/index.css">
</head>
<body>
<form action="<?php echo U('Admin/Tag/edit');?>" method="post">
    <table class="table table-bordered table-striped table-hover table-condensed">
        <input type="hidden" name="tid" value="<?php echo ($data['tid']); ?>">
        <tr>
            <th>标签名</th>
            <td>
                <input class="form-control modal-sm" type="text" name="tname" value="<?php echo ($data['tname']); ?>">
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <input class="btn btn-success" type="submit" value="修改">
            </td>
        </tr>
    </table>
</form>
<script src="/MyProject/PHP/think_blog/Public/static/js/jquery-2.0.0.min.js"></script>
<script>
    logoutUrl="<?php echo U('Home/User/logout');?>";
</script>
<script src="/MyProject/PHP/think_blog/Public/static/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="/MyProject/PHP/think_blog/Public/static/js/html5shiv.min.js"></script>
<script src="/MyProject/PHP/think_blog/Public/static/js/respond.min.js"></script>
<![endif]-->
<script src="/MyProject/PHP/think_blog/Public/static/pace/pace.min.js"></script>
<script src="/MyProject/PHP/think_blog/Template/default/Home/Public/js/index.js"></script>
<!-- 百度页面自动提交开始 -->
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!-- 百度页面自动提交结束 -->

<!-- 百度统计开始 -->

<!-- 百度统计结束 -->
</body>
</html>