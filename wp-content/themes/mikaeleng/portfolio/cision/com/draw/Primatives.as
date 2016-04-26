package draw
{
	
	import flash.display.Sprite;
	
	public class Primatives extends Sprite{
		
		public function Primatives(){
		}
		
		public function makeRect(xSize:Number,ySize:Number, bgColor:uint):Sprite{
		var wBg:Sprite=new Sprite;
		wBg.graphics.beginFill(bgColor);
		wBg.graphics.lineStyle(1,0x000000);
		wBg.graphics.drawRect(0,0,xSize,ySize);
		wBg.graphics.endFill();
		return wBg;
		}
		
		public function makeCircle(radius:Number, bgColor:uint):Sprite{
		var wBg:Sprite=new Sprite();
		wBg.graphics.beginFill(bgColor);
		wBg.graphics.lineStyle(1,0x000000);
		wBg.graphics.drawCircle(0,0, radius);
		wBg.graphics.endFill();
		return wBg;
		}
		
		public function makeEllipse(xSize:Number,ySize:Number, bgColor:uint):Sprite{
		var wBg:Sprite=new Sprite;
		wBg.graphics.beginFill(bgColor);
		wBg.graphics.lineStyle(1,0x000000);
		wBg.graphics.drawEllipse(0,0,xSize,ySize);
		wBg.graphics.endFill();
		return wBg;
		}
		
		public function makeCustom():Sprite{
			trace("custom#");
			return null
		}
	}
}