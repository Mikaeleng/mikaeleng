package {
	import flash.display.*;
	import flash.events.*;
	import flash.xml.*;
	import flash.text.*;
	import flash.utils.Timer;
	import gs.*;
	import gs.easing.*;
	import orient.Orient;


	public class QuizMainClass extends Sprite {

		public var quizXML:GetXml;
		public var place:Number=0;
		public var xLength:Number;
		public var points:Number=0;
		public var rightAnswers:Number=0;
		public var cTime:Number=0;
		public var panelContainer:Sprite;
		public var intro:IntroClass;
		public var xmlPath:String;
		public var imagePath:String;
		public var country:String;

		private var earthIndex:Number;
		private var newQuestion:QuestionClass;
		private var newOption:OptionClass;
		private var newExplain:ExplainClass;
		public var newClock:ClockClass;
		private var newResult:ResultClass;
		private var earthTweenClass:EarthTweenClass;
		private var city:CityClass;
		private var cityTimer:Timer;
		private var _text:Sprite;
		private var _getChild:GetChild = new GetChild();
		private var _orient:orient.Orient = new Orient();
		private var loadText:LoadText;
		public var pointBarClass:PointBarClass;
		private var nextBtn:NextBtn=new NextBtn  ;
		private var paramList:Object;
		private var preLoader:PreLoader = new PreLoader();
		private var posArr:Array = [[455,318],[675,259],[495,307],[495,307],[575,310],[463,293],[483,480],[437,305], [454,290],
		[457,302], [431,231],[444,285], [435,305],[476,341], [480,182]];
		public var cityNames:Array = ["Stockholm", "Toronto", "Copenhagen","Stuttgart","Helsinki", "Oslo","Kaunas","Lissabon","London", "Chicago","Amsterdam", "Hong Kong","Coimbra", "Baden Baden", "Oakland", "Boston"]


		public function QuizMainClass() {
			trace("adfa");
			try{
			paramList=root.loaderInfo.parameters;
			if (paramList.xmlPath!=null) {
				xmlPath=paramList.xmlPath;
				imagePath=paramList.imagePath;
				country = paramList.country;
			} else {
				imagePath="img/";
				country="english";
				if(country=="french"){
				xmlPath="xmlpath_fre.xml";
				}else if(country=="english"){
				xmlPath="xmlPath_eng.xml";
				}
			}
			}catch(e:Error){
				trace("Can't find external files");
			}
			quizXML=new GetXml(xmlPath);
			StageScaleMode.NO_SCALE;

			addChild(quizXML);
			addChild(_orient);
			quizXML.name="xmlClass";
			this.addEventListener(Event.ENTER_FRAME,xmlHandler);
		}

		private function xmlHandler(event:Event):void {
			if (quizXML.done) {
				xLength= quizXML.xLength;
				trace("UUU", quizXML.objXML.question[0]);
				init();
				this.removeEventListener(Event.ENTER_FRAME,xmlHandler);
			}
		}

		private function init():void {
			intro = new IntroClass(imagePath);
			addChild(intro);
			//intro.init();
			city = new CityClass();
			addChild(city);
			city.name="cityClass";
		}
		public function makeCityMarker():void {


			if (place<xLength) {
				city = new CityClass();
				addChild(city);
				city.name="cityClass";
				var _left=city.makeBraket("left");
				_left.name="left";
				var _right=city.makeBraket("right");
				_right.name="right";
				var _marker=city.makeMarker();
				_marker.name="marker";
				_text=city.makeText();
				addChild(_text);
				trace("TRACE:", _text.numChildren);
				//_text.addEventListener(Event.ENTER_FRAME, fontLoaded);


				city.addChild(_marker);
				city.placeObject(_marker,{x:0,y:0});

				city.addChild(_left);
				city.placeObject(_left,{x:0 -_left.width + _left.width/2 , y:0});

				city.addChild(_right);
				city.placeObject(_right,{x:0 +_right.width + _right.width/2,y:0});

				city.tweenObject(_left,1.5,{alpha:1, x:-15,scaleX:1,scaleY:1, bezierThrough:[{x:-20,alpha:.4,scaleX:1.5,scaleY:1.5},
				 {x:-30,alpha:.2,scaleX:1.4,scaleY:1.4},
				 {x:-15,alpha:.8,scaleX:1.3,scaleY:1.3},
				 {x:-20,alpha:.6,scaleX:1.2,scaleY:1.2},
				 {x:-15,alpha:.9,scaleX:1.1,scaleY:1.1}]});

				city.tweenObject(_right,1.5,{alpha:1, x:15,scaleX:1,scaleY:1, bezierThrough:[{x:20,alpha:.4,scaleX:1.5,scaleY:1.5},
				 {x:30,alpha:.2,scaleX:1.4,scaleY:1.4},
				 {x:15,alpha:.8,scaleX:1.3,scaleY:1.3},
				 {x:20,alpha:.6,scaleX:1.2,scaleY:1.2},
				 {x:15,alpha:.9,scaleX:1.1,scaleY:1.1}],onComplete:startTimer()});


				city.placeObject(city,{x:posArr[place][0],y:posArr[place][1],scaleX:.75,scaleY:0.75});

				
				this.setChildIndex(city,earthIndex + 1);
				_orient.to(_text,{x:city.x - _text.width/3,y:city.y + city.height/1.5});
				this.setChildIndex(_text,earthIndex + 2);

				function fontLoaded(event:Event):void{
					if(event.target.fontComplete==true){
							trace(typeof event.target);
							var tf:TextField = event.target.drawText();
							tf.antiAliasType = AntiAliasType.ADVANCED;  
			  
							tf.autoSize = TextFieldAutoSize.CENTER;  
			   
			  
							tf.text = cityNames[place];  
						
							//tf.rotation = 15; 
							event.target.addChild(tf);
							tf.name="text";
							this.setChildIndex(_text,earthIndex + 2);
							_orient.to(tf,{x:city.x - _text.width/3,y:city.y + city.height/1.5});
							tf.x = stage.stageWidth/2 - tf.width/2;
							tf.y = stage.stageHeight/2 - tf.height/2;
							event.target.removeEventListener(Event.ENTER_FRAME, fontLoaded);
						}
				}
		
				function startTimer() {
					cityTimer=new Timer(500,3);
					cityTimer.start();
					cityTimer.addEventListener(TimerEvent.TIMER, holdCity);
				}

				function holdCity(event:TimerEvent) {
					if (event.target.currentCount==event.target.repeatCount) {
						newPanel();
					}
				}
			}
		}
		
		public function newTween():void {
			earthTweenClass=new EarthTweenClass(imagePath);
			addChild(earthTweenClass);
			earthTweenClass.initTween();
			earthIndex=this.getChildIndex(earthTweenClass);
		}
		public function newPanel():void {
			if (place==0) {
				var bg=new Bg  ;
				panelContainer=new Sprite  ;
				panelContainer.addChild(bg);
				addChild(panelContainer);
				panelContainer.name="panel";
				panelContainer.x=0-stage.stageWidth;
				panelContainer.y=290;
				pointBarClass=new PointBarClass  ;
				panelContainer.addChild(pointBarClass);
				pointBarClass.x=-250;
				pointBarClass.y=195;
				pointBarClass.name="pointBar";
				pointBarClass.makeArrowBar();
			}
			TweenMax.to(panelContainer,1.5,{x:stage.stageWidth/2, delay:.2, onStart:makeNewQuestion, onComplete:makeNewClock,ease:Back.easeOut});
		}

		public function nextQuestionHandler(event:MouseEvent):void {
			removeChild(city);
			removeChild(_text);
			if (place<xLength-1) {
				nextBtn.buttonMode=false;
				nextBtn.alpha=.3;
				nextBtn.removeEventListener(MouseEvent.MOUSE_UP,nextQuestionHandler);
				TweenMax.to(panelContainer,1,{x:stage.stageWidth+panelContainer.width/2,onComplete:makeFilm,ease:Back.easeOut});
				function makeFilm():void {
					panelContainer.removeChild(newOption);
					panelContainer.removeChild(newQuestion);
					panelContainer.removeChild(newExplain);
					panelContainer.removeChild(newClock);

					panelContainer.x=0-stage.stageWidth;
					earthTweenClass.startTween();
				}

			} else if (place==xLength-1) {
				for (var i:Number=panelContainer.numChildren-1; i>0; i--) {
					if (panelContainer.getChildAt(i).name!="pointBar") {
						panelContainer.removeChildAt(i);
					}
				}
				nextBtn.buttonMode=false;
				nextBtn.alpha=0;
				nextBtn.removeEventListener(MouseEvent.MOUSE_UP,nextQuestionHandler);
				TweenMax.to(panelContainer,1,{x:stage.stageWidth+panelContainer.width/2,ease:Back.easeOut});
				TweenMax.to(earthTweenClass.bg,1,{alpha:0,ease:Back.easeOut});
				intro.outit();
			}
			place=place+1;
		}

		public function makeResultPanel():void {
			newResult=new ResultClass  ;
			panelContainer.addChild(newResult);
			newResult.makeResult();
			TweenMax.to(panelContainer,1.5,{x:stage.stageWidth/2 + panelContainer.width/14,ease:Back.easeOut});
		}
		private function makeNewQuestion():void {

			var node:Object=quizXML.Node;

			newQuestion=new QuestionClass  ;
			panelContainer.addChild(newQuestion);
			panelContainer.addChild(nextBtn);

			nextBtn.name="nextBtn";
			nextBtn.x=162;
			nextBtn.y=149;
			nextBtn.alpha=.3;

			newQuestion.name="questionClass";
			newQuestion.getXmlNode();

			newOption=new OptionClass  ;
			panelContainer.addChild(newOption);
			newOption.name="optionClass";
			newOption.getXmlNode();

			newExplain=new ExplainClass  ;
			panelContainer.addChild(newExplain);
			newExplain.name="explainClass";
			newExplain.getXmlNode();

			newClock=new ClockClass  ;
			panelContainer.addChild(newClock);
			newClock.name="Clock";

		}
		private function makeNewClock():void {
			newClock.setClock();
		}

		public function get xmlNode():Object {
			return quizXML.Node;
		}

		public function showPreLoader():void {
			var bol:Boolean=false;
			for (var i : Number = 0; i<this.numChildren; i++) {
				var loadName=this.getChildAt(i).name;
				if (loadName=="loader") {
					var xLoader = this.getChildAt(i);
					bol=true;
				}
			}
			if(bol == false){
				addChild(preLoader);
				preLoader.gotoAndPlay(2);
			preLoader.name = "loader";
			preLoader.x = stage.stageWidth/2;
			preLoader.y = stage.stageHeight/2;
			
			}else if(bol== true){
				xLoader.visible=true;
			}
		}

		public function hidePreLoader():void {
			var loader=_getChild.sendChild(this,"loader");
			loader.visible=false;
		}

		public function charLength(target:Object,tLength:Number=25):void {
			if (target.length>=tLength) {
				target.text=target.text.substring(0,tLength);
			}
		}
	}
}