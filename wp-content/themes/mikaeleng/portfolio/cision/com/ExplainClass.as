package{
	import flash.display.*;
	import flash.events.*;
	import ExplText;
	
	public class ExplainClass extends Sprite{
		
		private var explainContainer:Sprite;
		private var explText:ExplText = new ExplText();
		private var _myParent:Object;
		private var _node:Object;
		private var _answer:Number
		private var _rightAnswer:Number;
		
		public function ExplainClass(){
			
		}
		
		public function getXmlNode():void{
			_myParent = this.parent.parent;
			_node = _myParent.xmlNode;
			explainContainer = new Sprite();
			addChild(explainContainer);
			explainContainer.x = -210;
			explainContainer.y = 120;
			explainContainer.visible = false;
			explainContainer.name = "explain";
			explainContainer.addChild(explText);
			explText.txt.text = _node.explain;
			_myParent.charLength(explText.txt,120);
			explText.name = "txt";
		}
		
		private function setTextFormatHandler():void{
		
		}
	}
}