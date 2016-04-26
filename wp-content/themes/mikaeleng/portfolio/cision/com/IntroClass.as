package  {
	import flash.display.*;
	import gs.*;
	import gs.easing.*;
	import flash.events.*;
	public class IntroClass extends Sprite{
		
		// Constants:
		// Public Properties:
		// Private Properties:
	private var inZoom							:LoadImage = new LoadImage("img/intro_small.jpg");
	private var outZoom							:LoadImage = new LoadImage("img/intro_large.jpg");
	private var loadCount 						:Number = 0;
	private var _myParent						:Object;
	private var clipSign						:Sign = new Sign();
	private var clipIn							:Sprite = new Sprite();
	private var clipOut							:Sprite = new Sprite();
	private var currentCount					:Number = 0;
	private var totalCount						:Number = 2;
		// Initialization:
		public function IntroClass(imagePath) {
		inZoom = new LoadImage(imagePath+ "intro_small.jpg");
		outZoom = new LoadImage(imagePath+ "intro_large.jpg");
		inZoom.addEventListener(Event.ENTER_FRAME, imgLoaded);
		outZoom.addEventListener(Event.ENTER_FRAME, imgLoaded);
		addChild(clipOut); 
		addChild(clipIn);
		
		}
		public function set clipAlpha(pAlpha:Number):void{clipOut.alpha = pAlpha}
		public function hideClip():void{clipIn.alpha = 0}
		
		public function imgLoaded(event:Event):void{
			var target = event.target;
			_myParent = this.parent;
			_myParent.showPreLoader();
			
			if(target.done==true){
				currentCount = currentCount + 1;
				if(currentCount == totalCount){
				_myParent.hidePreLoader();
				init();
				}
				target.removeEventListener(Event.ENTER_FRAME, imgLoaded);
			}
			
		}
		
		public function init():void{
			_myParent = this.parent;
		addChild(clipSign);
		if(_myParent.country == "french"){
			clipSign._introText_fre.alpha = 1;
		}else if(_myParent.country == "english"){
			clipSign._introText_eng.alpha = 1;
		}
		
		clipSign.x = stage.stageWidth +  clipSign.width/2;
		clipSign.y = stage.stageHeight/2 - clipSign.height/2;
		
		clipSign.introBtn.addEventListener(MouseEvent.MOUSE_UP, introHandler);
		
			inZoom.addEventListener(Event.ENTER_FRAME, loadDone);
			outZoom.addEventListener(Event.ENTER_FRAME, loadDone);
		function loadDone(event:Event):void{
			if(event.target.done== true){
				loadCount = loadCount + 1;
			if(loadCount==1){
			//_myParent.hideLoader();
			clipOut.addChild(outZoom);
			outZoom.x = 0- outZoom.ldrWidth/2;
			outZoom.y = 0- outZoom.ldrHeight/2;
			
			clipOut.x = stage.stageWidth/2;
			clipOut.y = stage.stageHeight/2
			
			clipIn.addChild(inZoom);
			inZoom.x = 0- inZoom.ldrWidth/2
			inZoom.y = 0- inZoom.ldrHeight/2;
			
			clipIn.x = stage.stageWidth/2;
			clipIn.y = stage.stageHeight/2;
				
				TweenMax.to(clipIn,.5,{delay:.5, scaleX:.5, scaleY:.5, blurFilter:{blurX:30}, alpha:0, ease:Back.easeOut});
				TweenMax.to(clipSign,.8,{delay:1, x:stage.stageWidth/2 - clipSign.width/10, ease:Back.easeOut});
				var oneGroup:TweenGroup=new TweenGroup([{target:clipOut,time:.5,delay:.5, scaleX:.5, scaleY:.5, ease:Back.easeOut},{target:clipOut,time:.55,delay:.2, x:"-200", ease:Back.easeOut}],TweenMax,TweenGroup.ALIGN_SEQUENCE);
				
				event.target.removeEventListener(Event.ENTER_FRAME,loadDone);
				
			}
			}
		}
		}
		private function introHandler(event:MouseEvent):void{
		TweenMax.to(clipSign,1.2,{delay:.2, x:stage.stageWidth + clipSign.width/8, ease:Back.easeOut});
			
			var zeroGroup:TweenGroup=new TweenGroup([{target:clipIn,time:.55,delay:1.3, scaleX:1, scaleY:1, blurFilter:{blurX:0}, alpha:1, ease:Back.easeOut},{target:clipIn,time:.4, alpha:0, ease:Back.easeOut}],TweenMax,TweenGroup.ALIGN_SEQUENCE);
				
			var oneGroup:TweenGroup=new TweenGroup([{target:clipOut,time:.5, delay:.2, x:"200", ease:Back.easeOut},{target:clipOut,time:.5,delay:.5, scaleX:1, scaleY:1, onComplete:firstFrameIn, ease:Back.easeOut},{target:clipOut,time:.3, alpha:0, ease:Back.easeOut}],TweenMax,TweenGroup.ALIGN_SEQUENCE); //
			
			
			function firstFrameIn():void{
			_myParent.newTween();
			}
		}
	
		// Public Methods:
		public function outit():void{
			clipIn.alpha = 1;
			clipOut.alpha = 1;
			TweenMax.to(clipIn,.5,{delay:.5, scaleX:.5, scaleY:.5, blurFilter:{blurX:30}, alpha:0, ease:Back.easeOut});
				//TweenMax.to(clipSign,.8,{delay:1, x:stage.stageWidth/2 - clipSign.width/10, ease:Back.easeOut});
				var oneGroup:TweenGroup=new TweenGroup([{target:clipOut,time:.5,delay:.5, scaleX:.5, scaleY:.5, onStart:_myParent.makeResultPanel, ease:Back.easeOut},{target:clipOut,time:.55,delay:.2, x:"-200", ease:Back.easeOut}],TweenMax,TweenGroup.ALIGN_SEQUENCE);
				}
		/*private function outHadler(event:MouseEvent):void{
			
		}*/
		// Protected Methods:
	}
	
}