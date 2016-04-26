package orient {
	import flash.display.Sprite;
	import gs.*;
	import gs.easing.*;
	public class Orient extends Sprite{
		
		// Constants:
		// Public Properties:
		// Private Properties:
	
		// Initialization:
		public function Orient() { 
		
		}
	
		// Public Methods:
		public function to(pTarget:Object,pParams:Object):void{
			
			var _value:String;

			for (var _item:Object in pParams) {
				_value=String(pParams[_item.toString()]);
				pTarget[_item]=_value;
			}
		}
		
		public function center(pTarget:Object,align:String = "center"):void{
			switch(align){
				case "left":
				pTarget.x = pTarget.y = 0;
				break;
				case "center":
				pTarget.x = 0 - pTarget.width/2;
				pTarget.y = 0 - pTarget.height/2;
				
				break;
				case "right":
				pTarget.x = 0 - pTarget.width;
				pTarget.y = 0;
				break;
			}
		}
		// Protected Methods:
	}
	
}