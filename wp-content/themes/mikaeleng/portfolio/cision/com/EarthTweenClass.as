package {
	import flash.display.*;
	import flash.utils.Timer;
	import flash.events.TimerEvent;
	import flash.events.Event;
	import flash.events.MouseEvent;

	import gs.*;
	import gs.easing.*;

	public class EarthTweenClass extends Sprite {

		// Constants:
		// Public Properties:
		// Private Properties:
		private var imgArr:Array=[];
		private var bgArr:Array=[];
		private var container:Sprite;
		public var bg:Sprite = new Sprite();
		private var clip00:Sprite;
		private var clip0:Sprite;
		private var clip1:Sprite;
		private var anyTimer:Timer;
		private var _myParent:Object;
		private var place:Number=0;
		private var totalCount:Number;
		private var loadCount:Number = 0;
		private var repeatCount:Number=1;
		private var currentCount:Number=0;
		private var bg01:LoadImage;
		private var bg02:LoadImage;
		private var bg03:LoadImage;
		private var bg04:LoadImage;
		private var bg05:LoadImage;
		private var bg06:LoadImage;
		private var bg07:LoadImage;
		private var bg08:LoadImage;
		private var bg09:LoadImage;
		private var bg10:LoadImage;
		private var bg11:LoadImage;
		private var bg12:LoadImage;
		private var bg13:LoadImage;
		private var bg14:LoadImage;
		private var bg15:LoadImage;
		private var loop:LoadImage;
		private var loop_in:LoadImage;
		private var loop_out:LoadImage;
		
		// Initialization:
		public function EarthTweenClass(imagePath) {
		bg01=new LoadImage(imagePath+"bg01.jpg");
		bg02=new LoadImage(imagePath+"bg02.jpg");
		bg03=new LoadImage(imagePath+"bg03.jpg");
		bg04=new LoadImage(imagePath+"bg04.jpg");
		bg05=new LoadImage(imagePath+"bg05.jpg");
		bg06=new LoadImage(imagePath+"bg06.jpg");
		bg07=new LoadImage(imagePath+"bg07.jpg");
		bg08=new LoadImage(imagePath+"bg08.jpg");
		bg09=new LoadImage(imagePath+"bg09.jpg");
		bg10=new LoadImage(imagePath+"bg10.jpg");
		bg11=new LoadImage(imagePath+"bg11.jpg");
		bg12=new LoadImage(imagePath+"bg12.jpg");
		bg13=new LoadImage(imagePath+"bg13.jpg");
		bg14=new LoadImage(imagePath+"bg14.jpg");
		bg15=new LoadImage(imagePath+"bg15.jpg");
		loop=new LoadImage(imagePath+"loop.jpg");
		loop_in=new LoadImage(imagePath+"loop_in.jpg");
		loop_out=new LoadImage(imagePath+"loop_out.jpg");
			
			addChild(bg);
			bgArr=[bg01,bg02,bg03,bg04,bg05,bg06,bg07,bg08,bg09,bg10,bg11,bg12,bg13,bg14,bg15];
			imgArr=[loop_in,loop,loop_out];
			bg.addChild(bg04);
			bg04.addEventListener(Event.ENTER_FRAME, imgLoaded);

		}
		public function initTween():void {
			
			_myParent=this.parent;
			
			currentCount=0;


			var shadows = new Shadow();
			shadows.alpha=.5;

			shadows.width=stage.stageWidth;
			shadows.height=stage.stageHeight;

			clip0 = new Sprite();
			addChild(clip0);

			clip00 = new Sprite();
			addChild(clip00);

			clip1 = new Sprite();
			addChild(clip1);

			addChild(shadows);

			makeNewObject(clip0,imgArr[1]);
			clip0.alpha=0;
			
			TweenMax.to(clip0, .1, {alpha:.5});// onComplete:startTween

			makeNewObject(clip00,imgArr[0]);
			makeNewObject(clip1,imgArr[2]);
			clip00.alpha=clip1.alpha=0;

		}
		public function startTween():void {
			//_myParent.showPreLoader();
			placeObject(clip00,0-stage.stageWidth/2);
			tweenBlur(clip00);


			var img=clip0.getChildAt(0);
			img.addEventListener(Event.ENTER_FRAME, traceDone);
			//bg.alpha = 0;
			
			function traceDone(event:Event):void {
				if (img.done==true) {
					//_myParent.hidePreLoader();
					placeObject(clip0,0 - img.lWidth + stage.stageWidth);
					tweenIn(clip0);
					
					placeObject(clip1,0);
					tweenOut(clip1);
					img.removeEventListener(Event.ENTER_FRAME, traceDone);
				}
			}

		}
		
		private function tweenIn(item):void {
			
			TweenMax.to(item, .8, {alpha:.75, x:0, onComplete:turnBack});
			bg.removeChildAt(0);
			bg.addChildAt(bgArr[_myParent.place],0);
			TweenMax.to(clip0, .2, {delay:.7, alpha:0});
			TweenMax.to(bg, .2, {blurFilter:{blurX:30},x:stage.stageWidth, onComplete:bgBack});
			
			function bgBack():void{
				placeObject(bg,0-stage.stageWidth);
				TweenMax.to(bg, .2, {delay:.4, blurFilter:{blurX:0},x:0, alpha:1, ease:Quint.easeOut});
			}
			
			function turnBack():void {

				if (currentCount<repeatCount) {
					moveObject();
				}
			}

		}
		private function tweenBlur(item):void {
			TweenMax.to(item, .0, {alpha:0.5, blurFilter:{blurX:30},onComplete:blurIn});
			function blurIn():void {
				TweenMax.to(item, .5, {x:0, alpha:0.2, onComplete:Next});

				function Next():void {
					if (currentCount<repeatCount) {
						clip00.alpha=0;
						placeObject(clip00,0-stage.stageWidth/2);
					}
				}
			}
		}
		private function tweenOut(item):void {
			TweenMax.to(item, .0, {alpha:.5, blurFilter:{blurX:30},onComplete:fadeOut});

			function turnBack():void {

				if (currentCount<repeatCount) {
					clip1.alpha=0;
					placeObject(clip1,0);

				}
			}
			function fadeOut():void {
				TweenMax.to(item, .3, {alpha:.2, x:stage.stageWidth, onComplete:turnBack});
			}
		}
		private function moveObject():void {
			_myParent.makeCityMarker();
		}

		private function makeNewObject(container,img):void {
			_myParent.showPreLoader();
			container.addChild(img);
			totalCount = imgArr.length;
			img.addEventListener(Event.ENTER_FRAME, imgLoaded);
			img.name="clip"+place.toString();
		}
		
		private function imgLoaded(event:Event):void{
			var target = event.target;
			
			if(target.done==true){
			trace("LOADCOUNT:", loadCount, "name:", target.name);
			loadCount = loadCount + 1;
			}
			
			if(loadCount == totalCount){
				trace("ALLDONE!", loadCount, totalCount);
				loadCount = 0;
				for(var i:Number = 0; i< imgArr.length;i++){
					imgArr[i].removeEventListener(Event.ENTER_FRAME, imgLoaded);
				}
				bg.getChildAt(0).removeEventListener(Event.ENTER_FRAME, imgLoaded);
					_myParent.hidePreLoader();
					_myParent.intro.clipAlpha = 0;
					_myParent.intro.hideClip();
					startTween();
			}
		
		}
		private function placeObject(item,X,Y:Number=0):void {
			item.x=X;
			item.y=Y;
		}
	}

}