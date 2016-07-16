<?php
    
    
    # 数据
    # 合并数据
    # 合并匹配标识
    # 返回统计      默认返回全文件
    function FE($data,$odata,$value,$co = false){

        if(!isset($data)){
            return $data;
        }
        if(!isset($value)){
            foreach ($data as &$v){
                if(!is_array($odata)){
                    $v[$odata]=count($v[$odata]);
                }else{
                    foreach ($odata as $val){
                        $v[$val]=count($val);
                    }
                }                   
            }
            return $data;
        }
            foreach($data as &$val){
                $arr = array();
                foreach($odata as $v){  
                    if($val['id']==$v[$value]){
                        array_Push($arr,$v); 
                        $val['pooled'] = $co?count($arr):$arr;
                    }                
                }           
            }
        
        return $data;
    }
    
    #自定义排序  参数：数据库数据   排序模式 array('排序字段','rsort') 默认sort
    function setsort($data,$action){
        $str  = $action[0];
        $mysort = $action[1];
        usort($data,function($a,$b)use($str,$mysort){
            $al=$a[$str];
            $bl=$b[$str];
            if($al==$bl){
                return 0;
            }
            return ($al<$bl)?($mysort=='rsort'?1:-1):($mysort=='rsort'?-1:1);
        });
        return $data;
    }
?>