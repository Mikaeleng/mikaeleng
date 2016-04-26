package {

	import flash.display.*;
	import flash.net.URLRequest;
	import flash.events.*;
	//import Process;
	import GetChild;

	public class LoadImage extends Sprite {
		private var ldr:Loader;
		private var item:Sprite;
		//private var bar:Process;
		private var W:Boolean=false;
		public var done:Boolean=false;
		public var ldrWidth:Number;
		public var ldrHeight:Number;
		private var _loaded:Number=0;
		private var _total:Number=0;
		private var _getChild:GetChild = new GetChild();

		public function LoadImage(target, wid:Boolean=false) {
			W=wid;
			/*bar = new Process();
			addChild(bar);*/
			ldr = new Loader();
			var url:String=target;
			var urlReq:URLRequest=new URLRequest(url);
			ldr.load(urlReq);
			item = new Sprite();
			item.cacheAsBitmap=true;
			addChild(ldr);
			//addChild(item);
			ldr.contentLoaderInfo.addEventListener(Event.INIT, imgInit);
			ldr.contentLoaderInfo.addEventListener(Event.COMPLETE, imgLoaded);

		}


		private function imgInit(e:Event):void {
			ldrWidth=ldr.width;
			ldrHeight=ldr.height;
		}
		private function imgLoaded(e:Event):void {
			done=true;
			if (W==true) {
				ldr.width=152;
				ldr.height=100;
			}

			if (W==true) {
				var info:LoaderInfo=LoaderInfo(ldr.contentLoaderInfo);
				// pParent = the Slides Class handels the parents variables at this level
				var pParent=this.parent.parent;
				if (pParent.name=="tabItemContainer") {
					var pimpClass=this.parent.parent.parent.parent;
					var tabClass=_getChild.sendChild(pimpClass,"newTabs");
					tabClass.loaded=tabClass.loaded+1;
					var _procent:Number=Math.round(tabClass.loaded/tabClass.itemNr*100);
					// pRoot = stage Object, to find the movieClip of the preloader on the stage
					var pRoot=this.parent.parent.parent;
					//trace("name  ----- ", _procent, " --- ", pRoot);
					var _slideLoader=_getChild.sendChild(pRoot,"slideLoader");
					// does the calculation for the Slideranimation
					_slideLoader.filler.width = Math.round((_procent/100)*_slideLoader.width -3);
					//trace( _slideLoader.filler.width, Math.round((_procent/100)*_slideLoader.width));
					// checks if all the images are loaded then tells the parent script/class that it is done.
					var done=tabClass.loaded/tabClass.itemNr*100;
					//trace(done);
				}
				if (done==100) {
					tabClass.procent=done;
					_slideLoader.visible=false;
				}
			}
			//removeChild(bar);
		}
		public function get ldrWid():Number {
			return ldrWidth;
		}

		public function get bLoaded():Number {
			return _loaded;
		}
		public function get total():Number {
			return _total;
		}
		public function get lWidth():Number {
			return ldrWidth;
		}
		public function get lHeight():Number {
			return ldrHeight;
		}
	}
}