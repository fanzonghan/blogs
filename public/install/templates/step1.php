<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $Title; ?> - <?php echo $Powered; ?></title>
<link rel="stylesheet" href="./css/install.css?v=9.0" />
<link rel="stylesheet" href="./css/step1.css?v=9.0" />
<link rel="stylesheet" href="./css/theme-chalk.css">
    <script src="./js/vue2.6.11.js"></script>
<script src="./js/element-ui.js?v=9.0"></script>
</head>
<body>
<div class="wrap" id="step1">
<!--  --><?php //require './templates/header.php';?>
  <div class="title">
      <h1>欢迎使用 XF博客程序</h1>
      <div class="df agreement cp">
          <div class="radio-box" :class="{'is-shock': isShock}" @click="radio = !radio">
              <img v-if="radio" src="./images/install/success.png" alt="">
          </div>
          <span @click="radio = !radio">详细阅读并勾选同意</span>
          <span class="agreements" @click.stop="isShow = 1">《软件使用协议》</span>
      </div>
      <div class="bottom tac"> <span class="btn" :class="{'more-text': radio}" @click="jump">
              开始安装</span> </div>
  </div>
  <div class="section" v-if="isShow">
      <div class="main cc">
          <pre class="pact" readonly="readonly">
          <h1 class="title">软件许可协议</h1>
提示条款：
    <strong>协议内容</strong>
</pre>
        </div>
        <div class="bottom" @click="agree">我知道了</div>
    </div>
</div>
<?php require './templates/footer.php';?>

</body>
<script>
    new Vue({
        el: '#step1',
        data() {
            return { radio: 0,isShow: 0,isShock:false }
        },
        methods:{
            jump(){
                if(this.radio==1){
                    window.location.href = "./index.php?step=2";
                } else {
                    // this.$message({
                    //     message: '请先阅读并同意《软件使用协议》再进行下一步操作',
                    //     type: 'error'
                    // });
                    this.isShock = true
                    setTimeout(e=>{this.isShock = false},500)
                }
            },
            agree(){
                this.isShow = 0
            }
        }
    })
</script>
<script>
    console.log(`
  小范的技术博客 https://www.xiaofan.ink/
        `)
</script>
</html>