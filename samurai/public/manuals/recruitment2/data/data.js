/*
 * Copyright (C) 2014 Tenda,Inc.All rights reserved.
*/


/*dojo lesson of json data structure

[Dojo Version 7.31]

[sets]:set values,include lesson;
-[bgSize]:lesson background value;
--[w]:width;
--[h]:height;
-[flickerTime]:The Action flicker of time. -1:none
//wanghaiyang
-[examInterval]: the interval of examination time(minutes).
-[level]: the hard level of examination. 0:easy,1:hard
-[requireLine]: the requirement of examination score.
-[mail]: the mail address of sending report.
-[scormVersion]:the version of SCORM 1-ver1.2;2-ver2004
-[completionMode]:the mode of SCORM completion :0-auto;1-lecture;2-exercise;3-examination
//wanghaiyang
[steps]:step array,include all step;
-[num]:the number of the step
-[totalTime]:step time;
-[img]:background image;
-[x]:bgimage x position,you may not add 0 value;
-[y]:bgimage y position,you may not add 0 value;
-[buttons]:button action array,include current step of all buttons;
--[img]:button image;
--[startTime]:start time,you may not add 0 value;
--[totalTime]:continue time,you may not add -1 value;
--[x]:button x position;
--[y]:button y position;
-[mouseRoutes]:mouseroute array,include current step of all mouseroutes;
--[mouseRoute]:one mouseroute of all notes;
---[images]:all cursor'image for one mouseroute;
---[startTime]:start time,you may not add 0 value;
---[totalTime]:continue time,you may not add -1 value;
---[sx]:Cut the x coordinate of the start position;
---[sy]:Cut the y coordinate of the start position;
---[sWidth]:The width of the image is cut;
---[sHeight]:The height of the image is cut;
---[x]:Place the image on the canvas x coordinate location;
---[y]:Place the image on the canvas y coordinate location;
-[notes]:note array,include current step of all notes;
--[img]:note image;
--[startTime]:start time,you may not add 0 value;
--[totalTime]:continue time,you may not add -1 value;
--[x]:note x position;
--[y]:note y position;
--[layer]:the index of the note layers;
--[showOrHide]:the flag of the note displaying in four modes;
--[hyperLinks]:the hyperlinks of the note;
---[linkUrl]:the url of the hyperlink;
---[linkAreas]:the effective areas of the hyperlink;
----[x]:the x position of the effective areas;
----[y]:the y position of the effective areas;
----[w]:the width of the effective areas;
----[h]:the height of the effective areas;
-[promptBoxes]:promptBox array,include current step of all promptBoxes;
--[img]:promptBox image;
--[imgInfo]:promptBox information image;
--[x]:promptBox x position;
--[y]:promptBox y position;
--[xInfo]:promptBox information x position;
--[yInfo]:promptBox information y position;
--[startTime]:start time,you may not add 0 value;
--[totalTime]:continue time,you may not add -1 value;
--[layer]:the index of the note layers;
--[showOrHide]:the flag of the note displaying in four modes;
--[hyperLinks]:the hyperlinks of the note;
---[linkUrl]:the url of the hyperlink;
---[linkAreas]:the effective areas of the hyperlink;
----[x]:the x position of the effective areas;
----[y]:the y position of the effective areas;
----[w]:the width of the effective areas;
----[h]:the height of the effective areas;
-[videos]:video array,include current step of all videos;
--[src]:video file name;
-[audios]:audio array,include current step of all audios;
--[type]:0-instruction audio，1-question audio;
--[src]:audio file name;
*/
var json_data = '{"info":{"name":"募集する（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000083.jpg"}],"mouseActions":[{"x":67,"y":70,"w":1226,"h":692,"layer":0,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"80387750-8f04-41d6-9a4f-dd504f81847d.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000985.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":156,"img":"mouseRoute1.png"},{"x":680,"y":416,"totalTime":1544}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616546355484626.png","showOrHide":[true,true,true,true]},{"x":390,"y":289,"layer":5,"startTime":200,"totalTime":-1,"img":"636616546356148626.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000780.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000986.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000987.png"}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616546359756626.png","showOrHide":[true,true,true,true]},{"x":258,"y":53,"layer":5,"startTime":200,"totalTime":-1,"img":"636616546359912626.png","showOrHide":[true,true,false,false]},{"x":323,"y":545,"layer":0,"startTime":1500,"totalTime":-1,"img":"636616546360068626.png","showOrHide":[true,true,false,false]},{"x":826,"y":237,"layer":6,"startTime":200,"totalTime":-1,"img":"636616546360380626.png","showOrHide":[true,true,false,false]},{"x":588,"y":419,"layer":7,"startTime":1500,"totalTime":-1,"img":"636616546360848626.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":8,"startTime":2500,"totalTime":-1,"img":"636616546360848627.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000786.jpg"}],"mouseActions":[{"x":77,"y":76,"w":1185,"h":305,"layer":0,"strokeColor":"#ff0000","next":3,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"73dec3ad-c4d0-47eb-9f38-085fdbb2c690.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000988.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000989.png"}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616546364280626.png","showOrHide":[true,true,true,true]},{"x":622,"y":349,"layer":5,"startTime":200,"totalTime":-1,"img":"636616546364748626.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616546365060626.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000794.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000990.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000991.png"}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616546368474626.png","showOrHide":[true,true,true,true]},{"x":1151,"y":362,"layer":5,"startTime":1500,"totalTime":-1,"img":"636616546368474627.png","showOrHide":[true,true,false,false]},{"x":409,"y":303,"layer":6,"startTime":200,"totalTime":-1,"img":"636616546369410626.png","showOrHide":[true,true,false,false]},{"x":65,"y":115,"layer":0,"startTime":200,"totalTime":-1,"img":"636616546369878626.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000804.jpg"}],"mouseActions":[{"x":428,"y":649,"w":246,"h":44,"layer":7,"strokeColor":"#ff0000","next":5,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"190354be-9bbb-4df6-b853-27d4550c999b.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000992.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000993.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":680,"y":416,"startTime":0,"totalTime":1387,"img":"mouseRoute2.png"},{"x":551,"y":671,"totalTime":1113}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616546373184626.png","showOrHide":[true,true,true,true]},{"x":536,"y":469,"layer":5,"startTime":1000,"totalTime":-1,"img":"636616546373496626.png","showOrHide":[true,true,false,false]},{"x":65,"y":-6,"layer":0,"startTime":200,"totalTime":-1,"img":"636616546373964626.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":6,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000834.jpg"}],"mouseActions":[{"x":397,"y":662,"w":229,"h":44,"layer":1,"strokeColor":"#ff0000","next":6,"startTime":1500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"27be4e93-5c25-46fb-a251-cedf1794cc2b.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":6,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000994.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000995.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":551,"y":671,"startTime":0,"totalTime":204,"img":"mouseRoute3.png"},{"x":511,"y":684,"totalTime":2796}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616546377858626.png","showOrHide":[true,true,true,true]},{"x":521,"y":483,"layer":7,"startTime":1500,"totalTime":-1,"img":"636616546378170626.png","showOrHide":[true,true,false,false]},{"x":66,"y":51,"layer":5,"startTime":200,"totalTime":-1,"img":"636616546378638626.png","showOrHide":[true,true,false,false]},{"x":1000,"y":242,"layer":6,"startTime":200,"totalTime":-1,"img":"636616546378950626.png","showOrHide":[true,true,false,false]}]},{"num":"7","pro":5,"next":7,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000833.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":6,"next":7,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000996.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":7,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000997.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616546382382626.png","showOrHide":[true,true,true,true]},{"x":571,"y":476,"layer":5,"startTime":2000,"totalTime":-1,"img":"636616546383162626.png","showOrHide":[true,true,false,false]},{"x":223,"y":195,"layer":1,"startTime":200,"totalTime":-1,"img":"636616546383162627.png","showOrHide":[true,true,false,false]},{"x":604,"y":135,"layer":4,"startTime":200,"totalTime":-1,"img":"636616546383786626.png","showOrHide":[true,true,false,false]},{"x":221,"y":395,"layer":0,"startTime":2000,"totalTime":-1,"img":"636616546383942626.png","showOrHide":[true,true,false,false]},{"x":11,"y":507,"layer":8,"startTime":0,"totalTime":-1,"img":"636616546384098626.png","showOrHide":[true,true,false,false]},{"x":482,"y":325,"layer":9,"startTime":0,"totalTime":-1,"img":"636616546384254626.png","showOrHide":[true,true,false,false]},{"x":531,"y":288,"layer":10,"startTime":0,"totalTime":-1,"img":"636616546384410626.png","showOrHide":[true,true,true,true]}]},{"num":"8","pro":6,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000830.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000998.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616546388194626.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);