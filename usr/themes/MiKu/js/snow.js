		//判断IE
		function isIE(){
		    var b = document.createElement('b');
		    b.innerHTML = '<!--[if lte IE 8]><i></i><![endif]-->';
		    return b.getElementsByTagName('i').length === 1;
		};
		//定义雪花
        function CreateSnow(snowBox,src,style){
            this.snowBox = document.getElementById(snowBox);//找到容器
            this.snowStyle = Math.ceil(Math.random()*style);//雪花类型[1,2]
            this.maxLeft = this.snowBox.offsetWidth-Math.random()*5+3;//运动范围
            this.maxTop = this.snowBox.offsetHeight-Math.random()*5+3;
            this.left = this.snowBox.offsetWidth*Math.random();//起始位置
            this.top = this.snowBox.offsetHeight*Math.random();
            this.angle=1.1+0.8*Math.random();//飘落角度
            this.minAngle=1.1;
            this.maxAngle=1.9;
            this.angleDelta=0.01*Math.random();
            this.speed=1.4+Math.random();//下落速度
            this.createEle(src);//制作雪花dom   凹=放在最后，使得原型里能取到值
        };
        //雪片生成+下落
        CreateSnow.prototype = {
            createEle : function(baseSrc){//生成雪花元素
                var srcIndex = baseSrc.lastIndexOf('.'),//获取最后一个'.'
                    src = baseSrc.substring(0,srcIndex)+this.snowStyle+baseSrc.substring(srcIndex,baseSrc.length);
                var image = new Image();
                    image.src = src;
                this.ele = document.createElement("img");
                this.ele.setAttribute('src',src);
                this.ele.style.position="absolute";
                this.ele.style.zIndex="99";
                this.snowBox.appendChild(this.ele);
                //设置雪花尺寸
                var img = this.ele;
                image.onload = function(){
                    imgW = image.width;
                    img.setAttribute('width',Math.ceil(imgW*(0.1+Math.random())));
                    if(isIE()){//如果旧IE，设置高度
                        imgH = image.height;
                        img.setAttribute('height',Math.ceil(imgH*(0.1+Math.random())));
                    }
                };
            },
            move : function(){//雪花运动
                if(this.angle< this.minAngle||this.angle>this.maxAngle){
                    this.angleDelta=-this.angleDelta;
                }
                this.angle+=this.angleDelta;
                this.left+=this.speed*Math.cos(this.angle*Math.PI);
                this.top-=this.speed*Math.sin(this.angle*Math.PI);
                if(this.left<0){
                    this.left=this.maxLeft;
                }else if(this.left>this.maxLeft){
                    this.left=0
                }
                if(this.top>this.maxTop){//雪花掉出来后回到顶部
                    this.top=0;
                }
                this.ele.style.left=this.left+'px';//凹=加‘px’
                this.ele.style.top=this.top+'px';
            }
        };
        //下雪启动
        function goSnow(snowBox,src,num,style){
            var snowArr = [];
            for(var j = 0 ; j<num ; j++){
                snowArr.push(new CreateSnow(snowBox,src,style));
            }
            var makeSnowtime = setInterval(function(){
                for(var i = snowArr.length-1;i>=0;i--){//找到数组中的最新的一个
                    if(snowArr[i]){
                        snowArr[i].move();
                    }
                }
            },40);
        };
        //初始化加载
        window.onload = function(){
            var snowBox = 'snowBox',//雪花容器
                src = './usr/themes/kuiTools/images/snow.png',//雪花图基本命名<图片名就是snow+1/2/3/4...>
                num = 130,//雪花数量
                style = 2;//图片种类数
            goSnow(snowBox,src,num,style);
        };