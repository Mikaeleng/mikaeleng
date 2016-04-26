package{
	import flash.display.*;
	import flash.events.*;
	import flash.utils.Timer;
	import Clock;
	import gs.*;
	import gs.easing.*;
	
	public class ClockClass extends Sprite{
		
		public var _myParent:Object;
		
		private var clockContainer:Sprite = new Sprite();
		private var clock:Clock = new Clock();
		private var _warning:DisplayObject;
		private var _clockTimer:Timer = new Timer(1000,8);
		private var _time:Number = 10;
		
		public function ClockClass(){
			addChild(clockContainer);
			clockContainer.addChild(clock);
			clockContainer.x = 166;
			clockContainer.y = -150;
			clockContainer.name = "clockContainer";
		}
		
		public function setClock(){
			_myParent = this.parent.parent;
			clock.warning.gotoAndPlay(2);
			_clockTimer.addEventListener(TimerEvent.TIMER, timeHandler);
			_clockTimer.start();
			
		}
		
		private function timeHandler(event:TimerEvent):void{
			//_time--
			_myParent.cTime = event.target.repeatCount - event.target.currentCount;
			}
		
		public function stopClock():void{
			_clockTimer.stop();
			clock.warning.stop();
		}
	}
}