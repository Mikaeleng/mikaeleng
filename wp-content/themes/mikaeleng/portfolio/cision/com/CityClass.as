package {
	import flash.display.*;
	import flash.text.*;
	import flash.events.*;
	import fonts.*;
	import gs.*;
	import gs.easing.*;
	
	import fonts.*;
	
	public class CityClass extends Sprite {

		// Constants:
		// Public Properties:
		// Private Properties:
		private var _bracket:Sprite;
		private var _myParent:Object;
		private var _marker:Sprite;
		private var loadText:LoadText;
		private var fontLoader:fonts.FontLoader;
		
		// Initialization:
		public function CityClass() {
		}

		public function makeBraket(prop:String):Sprite {
			_myParent = this.parent;
			_bracket = new Sprite();
			_bracket.graphics.lineStyle(0, 0x1A4A8C, 0, false, LineScaleMode.NONE, CapsStyle.SQUARE);
			
			if(prop=="left"){

			_bracket.graphics.beginFill(0x1A4A8C);
			_bracket.graphics.moveTo(0, -10);
			_bracket.graphics.lineTo(0, -20);
			_bracket.graphics.lineTo(-20, -20);
			_bracket.graphics.lineTo(-20, 20);
			_bracket.graphics.lineTo(0, 20);
			_bracket.graphics.lineTo(0, 10);
			_bracket.graphics.lineTo(-10, 10);
			_bracket.graphics.lineTo(-10, -10);
			_bracket.graphics.lineTo(0, -10);
			_bracket.graphics.endFill()
			}else if (prop=="right"){

			_bracket.graphics.beginFill(0x1A4A8C);
			_bracket.graphics.moveTo(0, -10);
			_bracket.graphics.lineTo(0, -20);
			_bracket.graphics.lineTo(20, -20);
			_bracket.graphics.lineTo(20, 20);
			_bracket.graphics.lineTo(0, 20);
			_bracket.graphics.lineTo(0, 10);
			_bracket.graphics.lineTo(10, 10);
			_bracket.graphics.lineTo(10, -10);
			_bracket.graphics.moveTo(0, -10);
			_bracket.graphics.endFill()
			}
			return _bracket;
			//addChild(_bracket);
		}
		public function makeMarker():Sprite{
			_marker = new Sprite();
			_myParent = this.parent;
			
			_marker.graphics.lineStyle(0, 0x1A4A8C, 0, false, LineScaleMode.NONE, CapsStyle.SQUARE);
			_marker.graphics.beginFill(0x1A4A8C,1);
			_marker.graphics.drawCircle(0,0,10);
			_marker.graphics.endFill();
		
			return _marker;
		}
		
		public function makeText():Sprite{
			_myParent = this.parent;
			fontLoader = new FontLoader("_Franklin",24); //
			addChild(fontLoader);
			fontLoader.name = "fontClass";
			
			var textParams:Object = {txt:_myParent.cityNames[_myParent.place], size:24}
			fontLoader.loadFont(_myParent.imagePath + "_Franklin.swf",textParams);
			return fontLoader;
			
			//fontLoader.addEventListener(Event.ENTER_FRAME, fontLoaded);		
			
			/*_myParent = this.parent;
			loadText  = new LoadText();
			loadText.newTextfield({text:cityNames[_myParent.place],autoSize:"center",selectable:false,type : TextFieldType.DYNAMIC},{color:0x1A4A8C,size:24, bold:true, font:loadText.embeddedFonts("ITC Franklin Gothic Demi")});
			//this.addChild(loadText);
			loadText.name = "loadText";*/
			return loadText;
		}
		
		
		public function tweenObject(pTarget:DisplayObject, pTime:Number,pProp:Object):void{
			TweenMax.to(pTarget,pTime,pProp);
		}
		public function placeObject(pTarget:Object,pParams:Object):void{
			
			var _value:String;

			for (var _item:Object in pParams) {
				_value=String(pParams[_item.toString()]);
				pTarget[_item]=_value;
			}
		}
		
	}

}