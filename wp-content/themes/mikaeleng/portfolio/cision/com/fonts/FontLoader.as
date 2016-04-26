package fonts{  
 
      import flash.display.Loader;  
 
      import flash.display.Sprite;  
 
      import flash.events.Event;  
 
      import flash.net.URLRequest;  
 
      import flash.text.*;
        import flash.utils.describeType;
 
      public class FontLoader extends Sprite {  
 
 		private var xFont:String;
		private var xSize:Number;
		public var tf:TextField;
		private var textParams:Object;
		
           public function FontLoader(pFont,pSize) {  
 				xFont = pFont;
				xSize = pSize;
                //loadFont(xFont+".swf");
           }  
 
           public function loadFont(url:String, pParams:Object):void {  
 				textParams = pParams;
                var loader:Loader = new Loader();  
 
                loader.contentLoaderInfo.addEventListener(Event.COMPLETE, fontLoaded);  
 
                loader.load(new URLRequest(url));  
 
           }  
 
           private function fontLoaded(event:Event):void {  

					drawText();  
 				
           }  
 
           public function drawText():TextField {  
 
                tf = new TextField();  
 
                tf.defaultTextFormat = new TextFormat(xFont, textParams.size, 0x10387B);  
 
               tf.embedFonts = true;  
 
              tf.antiAliasType = AntiAliasType.ADVANCED;  
 
                tf.autoSize = TextFieldAutoSize.LEFT;  
 
 				trace("IN:", textParams.txt);
				tf.text = textParams.txt;
                //tf.text = " MIERLAER AER AERKAELR ESARK LAER ER AERKL " //"Troy was here\nScott was here too\nblah scott...:;*&amp;^% ";
               // tf.rotation = 15;
                this.addChild(tf);  
 				return tf;
           }  
 
      }  
 
 }