<?php
    /**
     * 例子一
     */
    class Hook{
        private $hooklist = null;
 
        //感觉这里很像观察者模式或者是策略模式
        public function add($action_hook){
            $this->hooklist[]=new $action_hook();
        }
        //触发事件
        public function exec(){
            foreach($this->hooklist as $action_hook){
                $action_hook->act();//钩子中统一的方法
            }
        }
    }
    //不同用途的钩子具体对象,比如说验证密码，验证权限，统一加密等等，
    class action_hook_1{
        public function act(){
            echo "我来做第一件事"."<br>";
        }
    }
    class action_hook_2{
        public function act(){
            echo "我来做第2件事"."<br>";
        }
    }
    class action_hook_3{
        public function act(){
            echo "我来做第3件事"."<br>";
        }
    }
//需要绑定钩子的具体对象
class Ball{
    public function down(){
        echo '我需要做一些通用的验证工作'."<br>";
        //注册事件,这里就可以加载相应的钩子类，因为在一个文件，直接使用
        $hook = new Hook();
        $hook->add("action_hook_1");
        $hook->add("action_hook_2");
        $hook->add("action_hook_3");
        $hook->exec();
    }
    //淡然也可以注册完就直接执行钩子，也可以写到单独方法
    public function exec(){
    }
}
 
$ball = new Ball();
$ball->down();
//<----------------------------------------华丽分割线-------------------------------------------------->
/**
 * 密名函数钩子例子2
 */

class Hook2{
  private $hookList;
  //添加
 function add($name,$fun,$a="aa"){
 $this->hookList[$name][] = $fun;
 }
function excec($name){
  $value = func_get_args();    
  unset($value[0]);
  foreach ($this->hookList[$name] as $key => $fun) {
    call_user_func_array($fun, $value);
  }
}
}
$hook = new Hook2();
$hook->add('women',function($msg){
 echo 'oh my god'.$msg."<br>" ;
});
$hook->add('man',function($msg){
 echo 'nothing'.$msg."<br>" ;
});
// 执行
$hook->excec('man','taoge');
$hook->excec('women','xxx');

