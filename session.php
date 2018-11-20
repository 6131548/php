//默认的SEESION以文件形式存在TMP目录下
SEESIOn存放有三个
1 user //自定义
2files //以文件形式
3.mamcache //已缓存形式,大型网站一般用此项
PHP.INI 中修改session.save_handler=files
配置路径
session.save_path="tcp://127.0.0.1:1211" //TCP传输协议
如果SEESION 存在mamcache里，那么一定以session_id为KEY
如果服务器不允许修改PHP.INI，那么用ini_set();
ini_set("session.save_handler","mamcache");
ini_set("session.save_path","tcp://127.0.0.1:1211");
