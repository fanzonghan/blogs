<?php


namespace app\api\controller;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/3 15:38
 * @version 1.0
 */
class VerificationCodeGenerator
{
    private $type = 1;          //验证码类型
    private $charset_en = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';      //随机因子
    private $charset_num = '0123456789';        //数字随机因子
    private $charset_ch = ['浩', '比', '不', '惊', '静', '看', '友', '前', '花',
        '开', '龙', '落', '义', '得', '江', '无', '意', '虎', '望', '天', '外',
        '云', '卷', '市', '丁', '中', '程', '人', '产', '名', '仅', '余', '金',
        '国', '美', '币', '东', '木', '水', '火', '土', '七', '九', '八', '工',
        '码', '图', '员', '电', '大', '秒', '舒', '仁'];      //中文随机因子
    private $text = [];         //中文因子数组
    private $code = '';         //验证码
    private $codelen = 4;       //验证码长度
    private $width = 200;       //宽度
    private $height = 80;       //高度
    private $img;               //图形资源句柄
    public $font = '';              //字体
    private $fontsize = 35;     //字体大小
    private $fontcolor;         //字体颜色

    //构造方法
    public function __construct()
    {
        $type = $this->type;
        switch ($type) {
            case $type == 1:
                $this->font = public_path() . '/static/font/randome.otf';
                break;
            case $type == 2:
                $this->font = public_path() . '/static/font/randome.otf';
                break;
            case $type == 3:
                $this->font = public_path() . '/static/font/zhcn.ttf';
                break;
            default:
        }
    }

    //生成验证码
    private function createCode()
    {
        $type = $this->type;
        if ($type == 1) {
            for ($i = 0; $i < $this->codelen; $i++) {
                $this->code .= $this->charset_en[mt_rand(0, strlen($this->charset_en) - 1)];
            }
        }
        if ($type == 2) {
            for ($i = 0; $i < $this->codelen; $i++) {
                $this->code .= $this->charset_num[mt_rand(0, strlen($this->charset_num) - 1)];
            }
        }
        if ($type == 3) {
            $numArray = array_rand($this->charset_ch, $this->codelen);
            for ($i = 0; $i < $this->codelen; $i++) {
                $this->code .= $this->charset_ch[$numArray[$i]];
                $this->text[] = $this->charset_ch[$numArray[$i]];
            }
        }
    }

    //生成背景
    private function createBg()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $color = imagecolorallocate($this->img, mt_rand(157, 255), mt_rand(157, 255), mt_rand(157, 255));
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $color);
    }

    //生成线条、雪花
    private function createLine()
    {
        for ($i = 0; $i < 10; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width), mt_rand(0, $this->height), mt_rand(0, $this->width), mt_rand(0, $this->height), $color);
        }
        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5), mt_rand(0, $this->width), mt_rand(0, $this->height), '*', $color);
        }
    }

    //生成文字
    private function createFont()
    {
        $type = $this->type;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156), mt_rand(0, 156), mt_rand(0, 156));
            $textx = ($this->width / $this->codelen) * $i + mt_rand(18, 22);
            $texty = $this->height / 1.4;
            if ($type == 1 or $type == 2) {
                imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $textx, $texty, $this->fontcolor, $this->font, $this->code[$i]);
            }
            if ($type == 3) {
                imagettftext($this->img, $this->fontsize, mt_rand(-30, 30), $textx, $texty, $this->fontcolor, $this->font, $this->text[$i]);
            }
        }
    }

    //输出
    private function outPut()
    {
        header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }

    //对外生成
    public function doimg()
    {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }

    //获取验证码
    public function getCode()
    {
        return strtolower($this->code);
    }
}

$_vc = new VerificationCodeGenerator(); //实例化一个对象
$_vc->doimg();
//$_vc->getCode();