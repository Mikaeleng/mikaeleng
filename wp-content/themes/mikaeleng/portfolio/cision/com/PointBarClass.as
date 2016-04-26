package {
	import flash.display.*;
	import gs.*;
	import gs.easing.*;
	
	public class PointBarClass extends Sprite {

		// Constants:
		// Public Properties:
		// Private Properties:
		public var arrowArr:Array=[];
		private var _myParent:Object;
		private var arrowContainer:Sprite = new Sprite();
		// Initialization:
		public function PointBarClass() {

		}

		public function makeArrowBar():void {
			addChild(arrowContainer);
			_myParent=this.parent.parent;
			for (var i:Number =0; i<15; i++) {
				var formBtn:ArrowButton = new ArrowButton();
				arrowContainer.addChild(formBtn);
				if(i==0){
					formBtn.x = 33;
				}else {
					formBtn.x = arrowContainer.width + 13;
				}
				}
		}
		public function asignArrow(pPlace:Number, pAnswer:Boolean):void{
			var arrowBtn =arrowContainer.getChildAt(pPlace);
			if(pAnswer==true){
				TweenMax.to(arrowBtn.right, .75, {alpha:1, ease:Elastic.easeInOut});
			}else if(pAnswer==false){
				TweenMax.to(arrowBtn.wrong, .75, {alpha:1, ease:Elastic.easeInOut});				
			}
		}
		// Public Methods:
		// Protected Methods:
	}

}