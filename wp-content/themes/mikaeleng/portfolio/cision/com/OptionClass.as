package {
	import flash.display.*;
	import flash.events.*;
	import gs.*;
	import gs.easing.*;
	import flash.text.TextFormat;

	public class OptionClass extends Sprite {

		private var optionContainer:Sprite = new Sprite();
		private var _myParent:Object;
		private var _node:Object;
		private var _answer:Number;
		private var _rightAnswer:Number;
		private var optionBtn:OptionBtn;
		private var dark:DarkBlue;
		private var light:LightBlue;
		private var green:Gron;
		private var btnArr=[];
		private var _nextBtn:DisplayObject;
		public function OptionClass() {
		}
		public function getXmlNode():void {
			_myParent=this.parent.parent;
			_node=_myParent.xmlNode;
			_rightAnswer=parseInt(_node.answer);

			addChild(optionContainer);
			optionContainer.name="optionContainer";
			optionContainer.x=-180;
			optionContainer.y=-76;


			var arr:Array=[0,45,95];
			for (var i:Number=1; i<4; i++) {
				optionBtn = new OptionBtn();
				optionBtn.y=arr[i-1];
				optionBtn.name="option"+i.toString();
				optionBtn.addEventListener(MouseEvent.MOUSE_UP, answerHandler);
				btnArr.push(optionBtn);
				optionContainer.addChild(optionBtn);
				switch (i) {
					case 1 :
						light = new LightBlue();
						light.y=arr[i-1]-2;
						optionContainer.addChildAt(light,0);
						optionBtn.txt.text=_node.option1;
						light.name = "lBlue";
						break;
					case 2 :
						dark = new DarkBlue();
						dark.y=arr[i-1]-2;
						optionContainer.addChildAt(dark,0);
						optionBtn.txt.text=_node.option2;
						dark.name = "dBlue";
						break;
					case 3 :
						green = new Gron();
						green.y=arr[i-1]-2;
						optionContainer.addChildAt(green,0);
						optionBtn.txt.text=_node.option3;
						green.name = "green";
						break;
				}
				optionBtn.txt.autoSize = "left";
				optionBtn.HL.width=optionBtn.HL.width+optionBtn.txt.width;
				optionBtn.HL.height=optionBtn.HL.height+optionBtn.txt.height;
				optionBtn.txt.width = 250;
				optionBtn.HL.buttonMode = true; 
			}
		}
		private function boldFormat(targetText):void{
			var boldText:TextFormat = new TextFormat();
			boldText.font = "ITC Franklin Gothic Heavy";
			targetText.setTextFormat(boldText);
		}
		
		private function redFormat(targetText):void{
			var redText:TextFormat = new TextFormat();
			redText.color = "0xFF0000";
			targetText.setTextFormat(redText)
		}
		private function answerHandler(event:MouseEvent):void {
			var i:Number;
			var pName:String=event.target.parent.name;
			_answer=parseInt(pName.slice(6));
			switch (pName) {
				case "option1" :
					moveArrows();
					break;
				case "option2" :
					moveArrows();
					break;
				case "option3" :
					moveArrows();
					break;
			}
			var _clockTime=_myParent.cTime;
			var _points=_myParent.points;
			for (var h =0; h<_myParent.numChildren; h++) {
				var panel=_myParent.getChildAt(h);
				if (panel.name=="panel") {
					for (i =0; i<panel.numChildren; i++) {
						var sibling=panel.getChildAt(i);
						if (sibling.name=="explainClass") {
							sibling=sibling.getChildAt(0);
							sibling.visible=true;
						}
					}
				}
			}
			for(i = 0;i<optionContainer.numChildren;i++){
			var option = optionContainer.getChildAt(i).name.slice(0,6);
				if(option=="option"){
					var oName =optionContainer.getChildAt(i).name.slice(6);
					var oNumber:Number = parseInt(oName);
					var tNumber:Number = parseInt(pName.slice(6));
						var rOption = optionContainer.getChildAt(i);
						rOption.HL.buttonMode = false;
					if(oNumber == _rightAnswer && _answer == _rightAnswer){
						boldFormat(rOption.txt);
					}
					if(tNumber != _rightAnswer){
						redFormat(event.currentTarget.txt);
					}
				}
			}
				_myParent.newClock.stopClock();
			if (_rightAnswer==_answer) {
				_myParent.rightAnswers = _myParent.rightAnswers +1;
				_myParent.points=_points+1+_clockTime;
			}
		}

		private function moveArrows():void {
			if (_rightAnswer==1) {
				var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:-5},{target:dark,time:.5,x:-5},{target:green,time:.5,x:-5,onComplete:moveY}],TweenMax,TweenGroup.ALIGN_START);
				function moveY() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,scaleX:.75,scaleY:.75},{target:dark,time:.5,y:0,scaleX:.75,scaleY:.75},{target:green,time:.75,y:0,scaleX:.75,scaleY:.75,onComplete:moveX}],TweenMax,TweenGroup.ALIGN_START);
				}
				function moveX() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:light.x-light.width-4,y:light.y-light.height/2-4},{target:green,time:.5,x:green.x-green.width-4,y:green.y+green.height/2+4,onComplete:forward}],TweenMax,TweenGroup.ALIGN_START);
				}
				function forward() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:"5"},{target:dark,time:.5,x:"5"},{target:green,time:.5,x:"5",onComplete:nextBtn}],TweenMax,TweenGroup.ALIGN_START);
				}
			}
			if (_rightAnswer==2) {
				var twoGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:-5},{target:dark,time:.5,x:-5},{target:green,time:.5,x:-5,onComplete:moveY2}],TweenMax,TweenGroup.ALIGN_START);
				function moveY2() {
					var oneGroup:TweenGroup=new TweenGroup([{target:dark,time:.5,scaleX:.75,scaleY:.75},{target:light,time:.5,y:45,scaleX:.75,scaleY:.75},{target:green,time:.75,y:45,scaleX:.75,scaleY:.75,onComplete:moveX2}],TweenMax,TweenGroup.ALIGN_START);
				}
				function moveX2() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:light.x-light.width-4,y:light.y-light.height/2-4},{target:green,time:.5,x:green.x-green.width-4,y:green.y+green.height/2+4,onComplete:forward2}],TweenMax,TweenGroup.ALIGN_START);
				}
				function forward2() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:"5"},{target:dark,time:.5,x:"5"},{target:green,time:.5,x:"5",onComplete:nextBtn}],TweenMax,TweenGroup.ALIGN_START);
				}
			}
			if (_rightAnswer==3) {
				var threeGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:-5},{target:dark,time:.5,x:-5},{target:green,time:.5,x:-5,onComplete:moveY3}],TweenMax,TweenGroup.ALIGN_START);
				function moveY3() {
					var oneGroup:TweenGroup=new TweenGroup([{target:green,time:.5,scaleX:.75,scaleY:.75},{target:light,time:.5,y:95,scaleX:.75,scaleY:.75},{target:dark,time:.75,y:95,scaleX:.75,scaleY:.75,onComplete:moveX3}],TweenMax,TweenGroup.ALIGN_START);
				}
				function moveX3() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:light.x-light.width-4,y:light.y-light.height/2-4},{target:green,time:.5,x:green.x-green.width-4,y:green.y+green.height/2+4,onComplete:forward3}],TweenMax,TweenGroup.ALIGN_START);
				}
				function forward3() {
					var oneGroup:TweenGroup=new TweenGroup([{target:light,time:.5,x:"5"},{target:dark,time:.5,x:"5"},{target:green,time:.5,x:"5",onComplete:nextBtn}],TweenMax,TweenGroup.ALIGN_START);
				}
			}
			function nextBtn() {
				
				if (_rightAnswer==_answer) {
					_myParent.pointBarClass.asignArrow(_myParent.place,true);
				} else if (_rightAnswer != _answer) {
					_myParent.pointBarClass.asignArrow(_myParent.place,false);
				}

				for (var j = 0; j<optionContainer.parent.parent.numChildren; j++) {
					if (optionContainer.parent.parent.getChildAt(j).name=="nextBtn") {
						var nextBtn=optionContainer.parent.parent.getChildAt(j);



						TweenMax.to(nextBtn, .5, {alpha:1, scaleX:1, scaleY:1,bezierThrough:[{scaleX:1.15, scaleY:1.05}], ease:Back.easeInOut});
						nextBtn.buttonMode=true;
						nextBtn.addEventListener(MouseEvent.MOUSE_UP, _myParent.nextQuestionHandler);
					}
				}
			}

			for (var i:Number=0; i<btnArr.length; i++) {
				var item=btnArr[i];
				item.removeEventListener(MouseEvent.MOUSE_UP, answerHandler);
			}

		}

		private function setTextFormatHandler():void {

		}
	}
}