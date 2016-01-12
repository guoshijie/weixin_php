##项目简介
####这是一个微信公众平台开发示例,基于PHP框架Laravel5.2
>- **IDE:** PhpStorm 9.0.2
>- **PHP VERSION:** 5.6.7
>- **DATABASE:** Mysql 
>- **Author:** Steven Guo

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

##小工具
####在局域网内开发时，[ngrok](https://github.com/inconshreveable/ngrok)可以将内网端口映射到外网，生成一个临时域名，堪称调试神器
```
git clone git@github.com:inconshreveable/ngrok.git
```