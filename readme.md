##项目简介
####基于PHP框架Laravel5.2的微信公众平台开发示例
>- **IDE:** PhpStorm 9.0.2
>- **PHP VERSION:** 5.6.7
>- **DATABASE:** Mysql5.6 
>- **Author:** Steven Guo

##包含功能
>1.微信公众平台接入

>2.获取AccessToken

>3.接收普通消息，并被动回复文本消息

>4.首次关注回复欢迎语

>5.创建自定义菜单

>6.通过code换取网页授权access_token

>7.获取自定义菜单

##注意事项
####1.下载项目后将.env.example更名为.env
```
mv .env.example .env
```

####2.给storage和bootstrap/cache目录赋予权限
```
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

##常用命令
####创建Models目录
```
php artisan make:model Models
```

####创建Controller和Model
```
php artisan make:controller Admin/AdminController
php artisan make:model Models/User/UserModel
```

###解决.gitignore无效问题
```
git rm --cached filename
```

###更新代码后重载索引
```
php composer.phar dump-autoload
```

##小工具
####在局域网内开发时，[ngrok](https://github.com/inconshreveable/ngrok)可以反向代理将内网端口映射到外网，生成一个临时域名
```
git clone git@github.com:inconshreveable/ngrok.git
```

##URL示例
####1.创建自定义菜单
```
http://fa408526.ngrok.io/createMenu
```
####2.通过code换取网页授权access_token
```
http://fa408526.ngrok.io/getOAuth2AccessToken?code=02113c9440d560824fd662a66e371b1u
```
返回示例

```
{
    "access_token": "OezXcEiiBSKSxW0eoylIeLbTirX__QgA7uW8WJE0Z2izAbnXV7DHbdHni-j9OoCq2Xqh5gLlPt0uAHtfYByOH80h1dwMrq74iALd_K359JYEN5KWKB7_sEz3T19V86sP9lSO5ZGbc-qoXUD3XZjEPw",
    "expires_in": 7200,
    "refresh_token": "OezXcEiiBSKSxW0eoylIeLbTirX__QgA7uW8WJE0Z2izAbnXV7DHbdHni-j9OoCqgBFR_ApctbH4Tk5buv8Rr3zb7T3_27zZXWIdJrmbGFoFzGUfOvnwX249iPoeNJ2HYDbzW5sEfZHkC5zS4Qr8ug",
    "openid": "oMzBIuI7ctx3n-kZZiixjchzBKLw",
    "scope": "snsapi_base"
}
```

####3.获取自定义菜单
```
http://fa408526.ngrok.io/getMenu
```

##微信支付
![业务流程时序图](http://7xlbf0.com1.z0.glb.clouddn.com/weixin_pay.png)

##Git开发规范
+ branch 分支规范：
> master ：主分支，线上部署代码
> 
> test   : 进入测试代码，只有开发完成了才允许合并到此分支
> 
> dev    : 开发分支，处于开发阶段分支
> 
> XXXXXX : 正处于开发的分支，此分支不需提交git
  
+ Tags 标签规范
> 不允许提交本地标签
> 
> 线上版本标签 格式 vN.n.n.yyyyMMddHHmm 例如：v1.0.0.201601201501

+ 代码编写提交规范
> 更新所有分支
> 
> 从dev 分支创建一个新的开发分支
> 
> 在新的分支进行开发，开发完成，更新dev分支，合并当前分支到dev分支，测试无误项目组长将dev合并到test
> 
> 测试拉取test进行测试