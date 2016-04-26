package  {
	import flash.display.Sprite;
	import flash.text.TextFieldType;
	import flash.events.MouseEvent;
	import math.Iteration;
	import draw.Primatives;
	import orient.Orient;
	public class TextMain extends Sprite{
		
		// Constants:
		// Public Properties:
		// Private Properties:
		private var _loadText:LoadText;
		private var _orient:orient.Orient = new Orient();
		private var _fontSequence:math.Iteration = new Iteration(0, 4);
		private var fontArr:Array = ["Arial","Helvetica","Silom","Copper Std","Blackcloak Std"];
		// Initialization:
		public function TextMain() { 
		doText();
		}
		
	public function	doText():void{
		_loadText = new LoadText();
		
		_loadText.newTextfield({text:"Mikael Rockar",autoSize:"center",selectable:false,type : TextFieldType.DYNAMIC, background:true,backgroundColor:0x000000},{color:0x1A4A8C,size:15,bold:true,font:_loadText.embeddedFonts(_fontSequence.place)});
		addChild(_loadText);
		_orient.to(_loadText.getChildAt(0),{x:stage.stageWidth/2-_loadText.width/2,y:stage.stageHeight/2-_loadText.height/2});
		bwd.addEventListener(MouseEvent.MOUSE_UP, bwdHandler);
		fwd.addEventListener(MouseEvent.MOUSE_UP, fwdHandler);
	}
	
	private function bwdHandler(event:MouseEvent):void{
		var _textField = _loadText.textfield;
		//_loadText.formatParams = {color:0x443322, font:_loadText.embeddedFonts(fontArr[_fontSequence.loop("backward")])};
		_loadText.newTextfield({text:fontArr[_fontSequence.loop("backward")],autoSize:"center",selectable:false,type : TextFieldType.DYNAMIC, background:true,backgroundColor:0x000000},{color:0x1A4A8C,size:15,bold:true,font:_loadText.embeddedFonts(_fontSequence.place)});
		_orient.center(_loadText,"left");
	}
	
	private function fwdHandler(event:MouseEvent):void{
		_loadText.newTextfield({text:fontArr[_fontSequence.loop("forward")],autoSize:"center",selectable:false,type : TextFieldType.DYNAMIC, background:true,backgroundColor:0x000000},{color:0x1A4A8C,size:15,bold:true,font:_loadText.embeddedFonts(_fontSequence.place)});
		_orient.center(_loadText,"right");
		var primative:draw.Primatives = new Primatives();
		addChild(primative.makeEllipse(60,160,0x00ff00));
		trace(_loadText.numChildren);
	}
		// Public Methods:
		// Protected Methods:
	}
	
}