package {

	import flash.display.*;
	import flash.media.Video;
	import flash.net.*;
	import flash.events.*;
	import flash.utils.Timer;

	public class GetXml extends Sprite {
		public var objXML:XML;
		public var place:Number=0;
		public var done:Boolean = false;
		public var xLength:Number;

		private var myLoader:URLLoader;
		private var myXMLURL:URLRequest;
		private var myParent:Object;
		
		public function GetXml(_targetPath):void {
			var XML_URL:String=_targetPath;
			myXMLURL=new URLRequest(XML_URL);
			myLoader=new URLLoader(myXMLURL);
			myLoader.addEventListener("complete",xmlLoaded);

		}
		public function get Xml():XML {
			return objXML;
		}
		
		public function get Node():Object {
			myParent = this.parent;
			var itemObj:Object = new Object();
			var xml2:XML = objXML.question[myParent.place];
			itemObj.id =xml2.attribute("id");
			itemObj.question = xml2.attribute("question");
			itemObj.option1 = xml2.attribute("option1");
			itemObj.option2 = xml2.attribute("option2");
			itemObj.option3 = xml2.attribute("option3");
			itemObj.answer = xml2.attribute("answer");
			itemObj.explain = xml2.attribute("explain");
			return itemObj;
		}
		private function xmlLoaded(event:Event):void {
			objXML=XML(myLoader.data);
			xLength = objXML.children().length();
			done = true;
		}
	}
}