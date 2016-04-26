package {
	import flash.display.*;
	import flash.text.*;
	import flash.events.MouseEvent;

	public class LoadText extends Sprite {

		// Constants:
		// Public Properties:
		// Private Properties:
		private var _textField:TextField;
		private var _textFormat:TextFormat;
		// Initialization:
		public function LoadText() {
			_textField = new TextField();
			this.addChild(_textField);
		}

		// Public Methods:
		public function newTextfield(pField:Object,pFormat:Object):void{
			var textParams:Object = pField;
			var styleParams:Object = pFormat;
			 fieldParams = textParams;
			 formatParams = styleParams;
		}
		
		public function set fieldParams(pField):void {
			var _value:String;
			
			for (var _item:Object in pField) {
				_value=String(pField[_item.toString()]);
				_textField[_item]=_value;
			}
		}

		public function set formatParams(pFormat):void {
			var _value:String;
			_textFormat = new TextFormat();

			for (var _item:Object in pFormat) {
				_value=String(pFormat[_item.toString()]);
				_textFormat[_item]=_value;
			}
			_textField.setTextFormat(_textFormat);
		}

		public function embeddedFonts(pFont):String {
			var allFonts:Array=Font.enumerateFonts(true);
			allFonts.sortOn("fontName", Array.CASEINSENSITIVE);
			var rightFont:String;
			for (var i:Number=0; i < allFonts.length; i++) {
				if(pFont == allFonts[i].fontName){
					rightFont = allFonts[i].fontName;
				}
			}
			return rightFont;
		}
		
		public function get fieldParams():Object {
			return null;
		}

		public function get formatParams():Object {
			return null;
		}
		public function get textfield():TextField{			return _textField		}
	}

}