package math{

	public class Iteration {

		// Constants:
		// Public Properties:
		public var place:Number;
		private var min:Number;
		private var max:Number;
		// Private Properties:
		// Initialization:
		public function Iteration(pMin:Number,pMax:Number) {
		min = pMin;
		max = pMax;
		place = min;
		}

		// Public Methods:

		public function loop(pDirection:String):Number {
			switch (pDirection) {
				case "backward" :
					if (place==min) {
						place=max;
					} else if (place<=max) {
						place=place-1;
					}
					break;
				case "forward" :
					if (place==max) {
						place=min;
					} else if (place>=min) {
						place=place+1;
						break;
					}
			}
			trace("iteration:",place);
			return place;
		}
		// Protected Methods:
	}

}