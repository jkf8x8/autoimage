# autoimage

## 安装
composer require jkf8x8/autoimg

## 配置
## config/app中
## 在$providers中添加 providers
Jkf8x8\Autoimg\AutoimgServiceProvider::class,

## 在$aliases数组中添加 facade 
'Autoimg'=>Jkf8x8\Autoimg\Facades\Autoimg::class,


# eg:
````
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Autoimg;
class Test extends Controller
{
    public function index(){
        //支持多图上传
        //return array
         // $file = $request->filename;
        // return Autoimg::thumb($filename);
        //生成50*50头像
        return Autoimg::thumb($filename,[[50,50]]);
    }
}
````
