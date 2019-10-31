<?php
/**
 * [post_curl description]
 * @param  [type] $url  [description]
 * @param  string $data [数组]
 * @return [type]       [description]
 */
require 'rsa.php';
class Api{
	protected $data	=[]	;
	protected $PostUrl;
	protected $api_app_id = '19880306123Hyb';
	/**
	 * [__construct 构造函数]
	 * @param [type] $PostUrl       [请求地址]
	 * @param [type] $link_username [链接账号]
	 * @param [type] $link_password [链接密码]
	 * @param [type] $phone         [电话号码]
	 */
	public function __construct($PostUrl){
		$this->PostUrl 	= $PostUrl;
	}

	public function Rsa($pubfile,$prifile){
		$rsa = new RSA($pubfile, $prifile); 

		$data = json_encode($this->data);
		$et_data = $rsa->encrypt($data); //加密后d

		$api_app_id = $this->api_app_id;
		$sign = $rsa->sign($api_app_id); 

		//验证 
		$check_sign = $rsa->verify($api_app_id, $sign); 
		
		$res['sign'] = $sign;
		$res['data'] = $et_data;
		$this->data = $res;

		// return post_curl($this->PostUrl,$this->data);
		return $this;
	}
	/**
	 * [addigl 添加积分]
	 * @param  [type] $addIglNum [积分数量]
	 * @return [type]            [description]
	 */
	public function HandleIgl($addIglNum,$phone_add,$phone_reduct){
		$data 					= $this->data;
		$data['phone_add'] = $phone_add;
		$data['phone_reduct'] = $phone_reduct;
		$data['request_type'] 	= 'handleIgl';
		$data['hanle_num'] 		=		$addIglNum;
		$this->data = $data;
		return  $this;
	}
	/**
	 * [getIgl 查找积分]
	 * @return [type] [description]
	 */
	public function getIgl($phone){
		$data['phone'] = $phone;
		$data['request_type'] = 'get_igl' ;
		$this->data = $data;
		return $this;
	}
	


	public function post_curl(){
		$data = $this->data;
		// var_dump($data);
		$url = $this->PostUrl;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			print curl_error($ch);
		}
		curl_close($ch);
		return $result;
	}
}
$pubfile = './rsa_public_key.txt'; 
$prifile = './rsa_private_key.txt'; 
$res = (new Api("http://demo.databe.net/api"))->getIgl(13281983960)->Rsa($pubfile,$prifile)->post_curl();

echo "积分查询<hr>";
echo $res;
echo "<hr>积分操作<hr>";
$rs = (new Api("http://demo.databe.net/api"))-> HandleIgl(1,13281983960,13281983960)->Rsa($pubfile,$prifile)->post_curl();
echo $rs;


