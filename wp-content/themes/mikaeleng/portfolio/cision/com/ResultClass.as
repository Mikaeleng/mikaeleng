package {
	import flash.display.*;
	import flash.text.TextFieldAutoSize;
	import flash.events.MouseEvent;
	import flash.errors.*;
	import flash.events.TimerEvent;
	import flash.utils.Timer;
	import flash.external.ExternalInterface;

	public class ResultClass extends Sprite {

		// Constants:
		// Public Properties:
		// Private Properties:
		private var resultContainer:ResultPanel = new ResultPanel();
		private var _myParent:Object;
		private var _count:Number=0;
		// Initialization:
		public function ResultClass() {

		}
		public function makeResult():void {
			_myParent=this.parent.parent;
			this.parent.addChild(resultContainer);
			resultContainer.name="resultContainer";

			resultContainer.x=25-resultContainer.width/2;
			resultContainer.y=25-resultContainer.height/2;



			resultContainer.pName.text="";
			resultContainer.pEmail.text="";
			if (_myParent.country=="english") {
				resultContainer.pPoint.text=_myParent.rightAnswers+" correct of 15 : ";
				resultContainer._endText.text="If you have any questions about the values that everyone lives by at Cision, or what our Vision and Mission might be, please review the Cision Brand Book once again. And remember, it’s all about you.Submit your name and email in order to participate in the competition. Thank you! ";
				resultContainer.formName.text="Name:";
				resultContainer.formEmail.text="Email:";
				resultContainer.submitBtn._label.text="Submit";
			} else if (_myParent.country == "french") {
				resultContainer.pPoint.text=_myParent.rightAnswers+" correct de 15 : ";
				resultContainer.formName.text="Nom:";
				resultContainer.formEmail.text="Email:";
				resultContainer.submitBtn._label.text="Soumettre";
				resultContainer._endText.text="Si vous avez des questions sur les valeurs que tout le monde met en pratique chez Cision, ou sur ce que sont notre mission et notre vision, veuillez étudier de nouveau le livre sur la marque de Cision. N’oubliez pas, c’est de vous qu’il est question. Donnez votre nom et votre adresse courriel afin de participer au concours. Merci!";
			}
			resultContainer.pPoint.autoSize=TextFieldAutoSize.RIGHT;
			resultContainer.xPoint.text=_myParent.points+" points";
			resultContainer.xPoint.autoSize=TextFieldAutoSize.RIGHT;
			resultContainer.pPoint.selectable = false;
			resultContainer.xPoint.selectable = false;
			
			resultContainer._eStar.text="";
			resultContainer._nStar.text="";

			resultContainer.pPoint.x=0;
			resultContainer.xPoint.x=0+resultContainer.pPoint.width+5;
			resultContainer.pPoint.height=resultContainer.pPoint.height+5;
			resultContainer.submitBtn.HL.buttonMode=true;
			//resultContainer.submitBtn._label.mouseEnabled = false;
			
			
			resultContainer.submitBtn.HL.addEventListener(MouseEvent.MOUSE_UP, sendEvent);
			resultContainer.submitBtn.HL.addEventListener(MouseEvent.MOUSE_OVER, btnHandler);
			resultContainer.submitBtn.HL.addEventListener(MouseEvent.MOUSE_DOWN, btnHandler);
			resultContainer.submitBtn.HL.addEventListener(MouseEvent.MOUSE_OUT, btnHandler);
		}

		private function btnHandler(event:MouseEvent):void {
			if (event.type=="mouseOver") {
				resultContainer.submitBtn.gotoAndStop(2);
			} else if (event.type =="mouseDown") {
				resultContainer.submitBtn.gotoAndStop(3);
			} else if (event.type =="mouseOut") {
				resultContainer.submitBtn.gotoAndStop(1);
			}
		}
		private function sendEvent(event:MouseEvent):void {
			resultContainer.submitBtn.gotoAndStop(1);
			try {
				checkEmail(resultContainer.pEmail.text);
			} catch (e:Error) {
				//trace(e);
				resultContainer._eStar.text="*";
			if (_myParent.country=="english") {
				resultContainer.pEmail.text="Invalid email address";
			}else if(_myParent.country == "french"){
				resultContainer.pEmail.text="Adresse e-mail nulle";
					
				}
				resultContainer.pEmail.addEventListener(MouseEvent.MOUSE_UP, nameHandler);
			}
			try {
				checkName(resultContainer.pName.text);
			} catch (e:Error) {
				//trace(e);
				resultContainer._nStar.text="*";
				if (_myParent.country=="english") {
				resultContainer.pName.text="you must submit your name";
				}else if(_myParent.country == "french"){
				resultContainer.pName.text="vous devez soumettez votre nom";
					
				}
				resultContainer.pName.addEventListener(MouseEvent.MOUSE_UP, nameHandler);

			}

		}

			private function nameHandler(event:MouseEvent):void {
				event.target.text="";
				trace(event.target.name);
				if (event.target.name=="pName") {
					resultContainer._nStar.text="";
				} else if (event.target.name =="pEmail") {
					resultContainer._eStar.text="";
				}
			}

		private function checkEmail(email:String) {
			if (email.indexOf("@")==-1) {
				throw new Error("Invalid email address");
			} else {
				resultContainer._eStar.text="";
				_count=_count+1;
			}
			doSend();
		}

		private function checkName(qName:String) {
			if (qName=="") {
				throw new Error("you have to submit your name");
			} else {
				resultContainer._nStar.text="";
				_count=_count+1;
			}
			doSend();
		}
		private function doSend():void {
			if (_count==2) {
				try {
					sendParams();
				} catch (e:Error) {
					trace(resultContainer.pName.text,resultContainer.pEmail.text);
					trace(e);
				}
				function sendParams():void {
					if (resultContainer.pName.text!=""||resultContainer.pEmail.text!=""||_myParent.points!="") {
						ExternalInterface.call("SaveQuizData",resultContainer.pName.text, resultContainer.pEmail.text, _myParent.rightAnswers, _myParent.points, "");

						trace("...sending...",resultContainer.pName.text,resultContainer.pEmail.text, _myParent.rightAnswers, _myParent.points);
					} else {
						throw new Error("ERROR: please try submiting your information again");
					}
				}
			}
		}
		// Public Methods:
		// Protected Methods:
	}

}