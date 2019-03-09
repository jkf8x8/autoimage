<?php
namespace Jkf8x8\autoimg;
use Illuminate\Support\Str;
use Image;
class Autoimg{

    /**
    *上传文件/图片
    * @FILES  $_FILES 
    * @sizeList  传入生成后的图片尺寸(可传多个值)   [width,height]  eg: [100,200] 多个值 [[100,200],[400],[800,400]]
    *
    * @return Array 
    */
    public function thumb($FILES,array $sizeList=[]){
        is_array($FILES)?($imgTmpName = $FILES ):($imgTmpName[] = $FILES);
        if(empty($imgTmpName)) return response()->json(['status'=>0,'message'=>'参数无效.1003']);
        $imgExt = $this->checkImgExtension($imgTmpName);
        if(!$imgExt){
            return response()->json(['status'=>0,'message'=>'扩展名错误.1002']);
        }
        
        return $this->makeImg($imgTmpName,$sizeList,$imgExt);
    }

    protected function makeImg($imgTmpName,array $sizeList=[] ,$imgExt){
        $imgPathArr = [];
        $dirPath = $this->makedir();
       
        foreach($imgTmpName as $key=>$tmpname){
            $randomStr = str::random(30);
            $origin = Image::make($tmpname);
            
            if(!empty($sizeList)){
                $imgPathArrTmp = [];
                foreach ($sizeList as $sizeKey => $sizeVal) {
                    $imgName = $randomStr.$sizeKey;
                    $imgPath = $dirPath.'/'.$imgName.'.'.$imgExt[$key];
                    $imgPathArrTmp[] = $imgPath;
                    
                    $origin->resize($sizeVal[0],isset($sizeVal[1])?$sizeVal[1]:$sizeVal[0])->save(public_path().$imgPath);

                }
                $imgPathArr[] = $imgPathArrTmp;
            }else{
                $imgPath = $dirPath.'/'.$randomStr.'.'.$imgExt[$key];
                $origin = $this->imageReSize($origin);
                $origin->save(public_path().$imgPath);
                $imgPathArr[] = $imgPath;
            }
        }

        return $imgPathArr;
    }
    

    /**
     * 图片尺寸控制
     * @param 
     * 
     */
    public function imageReSize($origin,$maxWidth=720){
        $imgW = $origin->width();
        if($imgW <= $maxWidth){
            return $origin;
        }
        return $origin->resize($maxWidth,null,function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }

    /**
    * 判断上传图片格式是否合法
    * imgtype 格式
    * allowType 允许的格式
    */

    public function checkImgExtension($imgTmpName,array $allowType =[]){
        $allowType = $allowType?$allowType:['png','jpeg','gif','jpg'];
        $extension = [];
        $tmpExt=[];
        
        foreach($imgTmpName as $val){
            $ext = $val->getClientOriginalExtension();   
            if(!in_array($ext,$allowType )){
                $extension= [];
                break;
            }else{
                $extension[]=$ext;
            }
        }

        return $extension;        
    }


    /**
    *  创建目录
    *  默认 以 年/年-月/年-月-日  创建文件路径
    *
    */
    function makedir($path=''){
    
        if($path==''){
            $year = date('Y',time());
            $month = date('Y-m',time());
            $day = date('Y-m-d',time());
            $path ='/images/'.$year.'/'.$month.'/'.$day;
        }
        if(!file_exists(public_path().$path)){
            mkdir( public_path().$path,0777,true);
        }
    
        return $path;
    
        
    }

}