# autoimage

## 安装
composer require jkf8x8/autoimg

## 配置
## config/app中
## 在$providers中添加 providers
Jkf8x8\Autoimg\AutoimgServiceProvider::class,

## 在$aliases数组中添加 facade 
'Autoimg'=>Jkf8x8\Autoimg\Facades\Autoimg::class,


#eg:
````
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Autoimg;
class Test extends Controller
{
    public function index(){
        //支持多图上传
        //return array
        $array = Autoimg::thumb($_FILES['filename']);
    }
}
````
