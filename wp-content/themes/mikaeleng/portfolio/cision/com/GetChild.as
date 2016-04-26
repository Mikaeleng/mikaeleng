package {

	import flash.display.*;

	public class GetChild extends Sprite {

		/////////////////////////////////////
		//
		//Geting the child object from any parent
		//
		/////////////////////////////////////

		public function GetChild() {
		}
		public function sendChild(thisParent,child):DisplayObject{
			var target:DisplayObject=thisParent.getChildByName(child);
			var nr =  thisParent.getChildIndex(target);
			var obj = thisParent.getChildAt(nr);
			return obj;
		}
	}
}