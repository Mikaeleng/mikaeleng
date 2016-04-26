package {  
 
      import flash.display.Loader;  
 
      import flash.display.Sprite;  
 
      import flash.events.Event;  
 
      import flash.net.URLRequest;  
 
      import flash.text.*;
        import flash.utils.describeType;
 
      public class TextLib extends Sprite {  
 
           public function TextLib() {  
 
                loadFont("MyFontASLibs.swf");
           }  
 
           private function loadFont(url:String):void {  
 
                var loader:Loader = new Loader();  
 
                loader.contentLoaderInfo.addEventListener(Event.COMPLETE, fontLoaded);  
 
                loader.load(new URLRequest(url));  
 
           }  
 
           private function fontLoaded(event:Event):void {  
 
                drawText();  
 
           }  
 
           public function drawText():void {  
 
                var tf:TextField = new TextField();  
 
                tf.defaultTextFormat = new TextFormat("_Franklin", 30, 0);  
 
                                tf.embedFonts = true;  
 
              tf.antiAliasType = AntiAliasType.ADVANCED;  
 
                tf.autoSize = TextFieldAutoSize.LEFT;  
 
                tf.border = true;
                tf.text = " MIERLAER AER AERKAELR ESARK LAER ER AERKL " //"Troy was here\nScott was here too\nblah scott...:;*&amp;^% ";
               // tf.rotation = 15;
                addChild(tf);  
 
           }  
 
      }  
 
 }