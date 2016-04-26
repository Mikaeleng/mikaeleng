package math
{

	import flash.display.Sprite;

	dynamic public class RandomNum extends Sprite{
		public var thisNr:Number;
		private var originalArray:Array;
		private var bufferArray = new Array();

		public function RandomNum ()
		{
			//getNr (min,max);
		}
		public function getNr (min:Number, max:Number):Number
		{
			var Nr:Number = Math.floor(Math.random() * (max - min + 1)) + min;
			return Nr;
		}
		public function getRandomArray (max:Number):Array
		{
			bufferArray=[]
			for(var i:Number = 0;i<max;i++)
			{
				bufferArray.push(i);
			}
			bufferArray.sort(shuffle);
			return bufferArray;
		}
		private function shuffle(a,b):int
		{
			var num : int = Math.round(Math.random()*2)-1;
			return num;
		}
	}
}