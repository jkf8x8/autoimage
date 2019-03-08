# autoimage

## 安装
composer require jkf8x8/autoimg

# 配置
## config/app中
## 在$providers中添加 providers
Jkf8x8\Autoimg\AutoimgServiceProvider::class,

## 在$aliases数组中添加 facade 
'Autoimg'=>Jkf8x8\Autoimg\Facades\Autoimg::class,
