<?php


class Index
{
    
    // public function index()
    // {	
    //     return view('index'); 

    // }
    public function doo(){

        $a = array(
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
        );
        $b=['订单号','名称','表头名1','表头名2','表头名3'];

        
         $c = array(
            '1' => $a,
            '2' => $a,
            '3' => $a,
            '4' => $a,
            '5' => $a,
        );


        $this->toCSV('用户订单明细表'.date('ymdhis').'.csv',$b,$c);
    }
    public function toCSV($filename, $tileArray=array(), $dataArray=array()){
        ini_set('memory_limit','512M');
        ini_set('max_execution_time',0); //限制程序执行时间 
        echo 'ini设置完成==>';
        ob_end_clean(); //清空（擦除）缓冲区并关闭输出缓冲
      //  echo '清空（擦除）缓冲区并关闭输出缓冲==》';
        ob_start();// 打开输出控制缓冲
    //    echo '打开输出控制缓冲成功==>';

        header("Content-Type: text/csv");//header（）用于发送原始 HTTP 头
      //  echo 'header告诉要csv格式==》';
        header("Content-Disposition:filename=".$filename); //filename指令告诉浏览器，附件下载的形式展示数据。
     //   echo 'filename指令告诉浏览器，附件下载的形式展示数据。==》';
     //    echo '<br/>';
        $fp=fopen('php://output','w'); //php://output：一个只写的数据流，  fopen(,'w');将资源绑定到流中，w：写入方式打开文件
     //   var_dump($fp);
      //  echo '以写入方式打开一个只写的数据流 成功==>';
      //  echo '<br/>';
       

        fwrite($fp, chr(0xEF).chr(0xBB).chr(0xBF));//转码 防止乱码(比如微信昵称(乱七八糟的))
    //    echo '将内容写到数据流中... 成功==》';
    //     echo '<br/>';
      //  $raw_post_data = file_get_contents('php://input', 'r'); 
      //  echo $raw_post_data . "\n";exit;

        fputcsv($fp,$tileArray);// 该函数将行格式数据 化为 CSV格式， 并写入一个打开的文件。
  //      echo '行格式数据 化为 CSV格式， 并写入一个打开的文件 成功';
     //   fputcsv($fp,$dataArray);       

        $index = 0;
        foreach ($dataArray as $item) {
            $index++;
            fputcsv($fp,$item);
        }
        // fputcsv($fp,array('a','s','rr'));
        ob_flush();
        flush();
        ob_end_clean();
    }
    
}
(new Index)->doo();
