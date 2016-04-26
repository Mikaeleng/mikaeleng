package{
	import flash.display.*;
	import flash.events.*;
	import QuestText;
	import flash.text.TextFormat;
	
	public class QuestionClass extends Sprite{
		
		private var questionContainer:Sprite;
		private var _myParent:Object;
		private var _node:Object;
		private var questText:QuestText = new QuestText();
		private var _answer:Number;
		private var _rightAnswer:Number;
		
		public function QuestionClass(){
			
		}
	
		public function getXmlNode():void{
			_myParent = this.parent.parent;
			_node = _myParent.xmlNode;
			questionContainer = new Sprite();
			addChild(questionContainer);
			questionContainer.x = -211;
			questionContainer.y = -195;
			questionContainer.addChild(questText);	
			questText.questNr.text = _node.id;
			questText.txt.text = _node.question;
		}
		
		private function setTextFormatHandler(target:Object, formatObj:Object):void{
		var currFormat:TextFormat = questText.txt.getTextFormat();
		trace(currFormat.size);
		currFormat["size"] = 14;
		questText.txt.setTextFormat(currFormat);
		for each(var item in formatObj){
			trace(item);
		}
		}
	}
}