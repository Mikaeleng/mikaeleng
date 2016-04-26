package {
	import flash.display.*;
	import flash.utils.Timer;
	import flash.events.TimerEvent;
	import flash.events.MouseEvent;
	
	import gs.*;
	import gs.easing.*;
	
	public class TweenTest extends Sprite {

		// Constants:
		// Public Properties:
		// Private Properties:
		private var imgArr:Array=[];
		private var container:Sprite;
		private var clip00:Sprite;
		private var clip0:Sprite;
		private var clip1:Sprite;
		private var anyTimer:Timer;
		private var repeatCount:Number = 6;
		private var place:Number = 0;
		private var count:Number = 0;
		private var img0=new LoadImage("img/map_europe011.swf");
		private var img1=new LoadImage("img/map_europe002.swf");
		private var img2=new LoadImage("img/map_europe003.swf");
		private var img3=new LoadImage("img/map_europe004.swf");
		/*
		private var img0=new LoadImage("img/map_europe01.png");
		private var img1=new LoadImage("img/map_europe02.png");
		private var img2=new LoadImage("img/map_europe03.png");
		private var img3=new LoadImage("img/map_europe04.png");
		*/
		// Initialization:
		public function TweenTest() {
			StageScaleMode.NO_SCALE;
			
			
			imgArr=[img0,img1,img2,img3];
			
			var shadows = new Shadow();
			addChild(shadows);
			shadows.alpha=.5;
			clip00 = new Sprite();
			clip0 = new Sprite();
			clip1 = new Sprite();
			addChild(clip0);
			addChild(clip00);
			addChild(clip1);
			clip0.alpha = 0;
			makeNewObject(clip00,imgArr[1]);
			makeNewObject(clip0,imgArr[0]);
			//makeNewObject(clip1,imgArr[1]);
			placeObject(clip00,0-stage.stageWidth/2);
			placeObject(clip0,0-stage.stageWidth/2);
			//placeObject(clip1,0);
			tweenBlur(clip00);
			tweenIn(clip0);
			//tweenOut(clip1);
			/*startNewClip();*/
		}
		private function startNewClip():void
		{
			anyTimer = new Timer(100,repeatCount);
			anyTimer.start();
			anyTimer.addEventListener(TimerEvent.TIMER, timeHandler);
			
			/*var clip = makeNewObject(clip0,imgArr[1]);
			placeObject(clip,0 - stage.stageWidth/2,0 - stage.stageHeight/2);
			TweenMax.to(clip, 0, {blurFilter:{blurX:30}});
			tweenIn (clip);*/
		}
		private function timeHandler(event:TimerEvent):void
		{
			if(event.target.currentCount==repeatCount){
			trace("COUNT: ", event.target.currentCount);
			trace("REPEAT: ", event.target.repeatCount);
				startNewClip();
			event.target.removeEventListener(TimerEvent.TIMER, timeHandler);
			}
		}
		private function tweenIn(item):void
		{
			TweenMax.to(item, 0, {blurFilter:{blurX:30},alpha:.2, onComplete:Next});
			
			function Next():void{
			TweenMax.to(item, .4, {x:0, blurFilter:{blurX:5},alpha:1, onComplete:turnBack});
			}
			function turnBack():void{
				placeObject(clip0,0 - stage.stageWidth/2)
				tweenIn(clip0);
				moveObject();
			}

		}
		private function tweenBlur(item):void{
			TweenMax.to(item, .0, {blurFilter:{blurX:30},onComplete:blurIn});
			function blurIn():void{
			TweenMax.to(item, .3, {x:0, alpha:0, onComplete:Next});
			function Next():void{
				clip00.alpha = 1;
				placeObject(clip00,0-stage.stageWidth/2);
				tweenBlur(clip00);
			}
			}
		}
		private function tweenOut(item):void
		{
			TweenMax.to(item, .0, {blurFilter:{blurX:30},onComplete:fadeOut});
			function turnBack():void{
			placeObject(clip1,0);				
			tweenOut(clip1);
			removeObject();
			}
			function fadeOut():void
			{
				TweenMax.to(item, .3, {x:stage.stageWidth, onComplete:turnBack});
			}
		}
		
		private function makeNewObject(container,img):void
		{
			container.addChild(img);
			img.name = "clip"+place.toString();
		}
		private function placeObject(item,X):void{
			item.x = X;
		}
		private function removeObject(move:String="move"):void{
			// --- remove = tweenOut;
			/*if(place<5){
			clip1.addChildAt(clip0.getChildAt(0),0);
			}else if(place==5){
			clip0.addChildAt(clip0.getChildAt(0),0);
				place=0;
			}*/
			/*var _stage = clip0.parent;
			placeObject(clip0,0 - stage.stageWidth/2);
			placeObject(clip1,0);
			tweenOut(clip1);*/
		}
		private function moveObject():void{
			
			clip0.removeChildAt(0);
			if(place<4){
			clip0.addChild(imgArr[place]);
			place++			
			}else if(place==4){
				clip0.addChild(imgArr[0]);
				place=0
				count++
			}
			trace(place);
		/*placeObject(clip0,0 - stage.stageWidth/2,0 - stage.stageHeight/2);
			placeObject(clip1,0,0);*/
			
				/*var moveIt = clip0.getChildAt(0);
				clip1.addChildAt(moveIt,0);
				makeNewObject(clip0,imgArr[1]);
				placeObject(clip0,0 - stage.stageWidth/2,0 - stage.stageHeight/2);
				tweenOut(clip1);
				placeObject(clip0,0 - stage.stageWidth/2,0 - stage.stageHeight/2);*/
		}

		// Public Methods:
		// Protected Methods:
		// jag behöver ju inte två stycken tweens bara en och en längre fart från -550 till 500
	}

}