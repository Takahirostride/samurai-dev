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
var json_data = '{"info":{"name":"トップページ（企業）","author":"","strDate":"Wednesday,&nbsp;May 09,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":3800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000114.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000406.png"}],"notes":[{"x":-10,"y":701,"layer":2,"startTime":0,"totalTime":-1,"img":"636614829832270863.png","showOrHide":[true,true,true,true]},{"x":223,"y":177,"layer":4,"startTime":200,"totalTime":-1,"img":"636614829832426864.png","showOrHide":[true,true,false,false]},{"x":835,"y":-11,"layer":5,"startTime":200,"totalTime":-1,"img":"636614829833206869.png","showOrHide":[true,true,false,false]},{"x":439,"y":317,"layer":6,"startTime":2300,"totalTime":-1,"img":"636614829833362870.png","showOrHide":[true,true,false,false]},{"x":113,"y":380,"layer":7,"startTime":2300,"totalTime":-1,"img":"636614829834142875.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":4300,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000122.jpg"}],"keyActions":[{"x":429,"y":77,"w":82,"h":82,"layer":1,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"keyName":"F11","keyCodes":[122],"ctrlKey":false,"shiftKey":false,"altKey":false,"anyKey":false}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000407.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000408.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614829837886899.png","showOrHide":[true,true,true,true]},{"x":893,"y":-5,"layer":6,"startTime":200,"totalTime":-1,"img":"636614829838042900.png","showOrHide":[true,true,false,false]},{"x":631,"y":165,"layer":7,"startTime":200,"totalTime":-1,"img":"636614829838354902.png","showOrHide":[true,true,false,false]},{"x":60,"y":517,"layer":0,"startTime":1500,"totalTime":-1,"img":"636614829838510903.png","showOrHide":[true,true,false,false]},{"x":255,"y":486,"layer":8,"startTime":1500,"totalTime":-1,"img":"636614829838822905.png","showOrHide":[true,true,false,false]},{"x":1157,"y":374,"layer":11,"startTime":2800,"totalTime":-1,"img":"636614829838822906.png","showOrHide":[true,true,false,false]},{"x":1103,"y":364,"layer":12,"startTime":2800,"totalTime":-1,"img":"636614829838978906.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000323.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000409.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000410.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614829842878931.png","showOrHide":[true,true,true,true]},{"x":51,"y":34,"layer":6,"startTime":200,"totalTime":-1,"img":"636614829843190933.png","showOrHide":[true,true,false,false]},{"x":638,"y":304,"layer":7,"startTime":200,"totalTime":-1,"img":"636614829843824938.png","showOrHide":[true,true,false,false]},{"x":1151,"y":368,"layer":10,"startTime":2500,"totalTime":-1,"img":"636614829843824939.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000146.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000411.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000412.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614829847412961.png","showOrHide":[true,true,true,true]},{"x":1151,"y":362,"layer":6,"startTime":2500,"totalTime":-1,"img":"636614829847724963.png","showOrHide":[true,true,false,false]},{"x":45,"y":2,"layer":7,"startTime":200,"totalTime":-1,"img":"636614829848192966.png","showOrHide":[true,true,false,false]},{"x":440,"y":151,"layer":8,"startTime":200,"totalTime":-1,"img":"636614829848660969.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000154.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000413.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000414.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614829851946991.png","showOrHide":[true,true,true,true]},{"x":1151,"y":362,"layer":6,"startTime":2500,"totalTime":-1,"img":"636614829852102992.png","showOrHide":[true,true,false,false]},{"x":45,"y":2,"layer":7,"startTime":200,"totalTime":-1,"img":"636614829852414994.png","showOrHide":[true,true,false,false]},{"x":440,"y":151,"layer":8,"startTime":200,"totalTime":-1,"img":"636614829852882997.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":6,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000162.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":6,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000415.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000416.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614829855691015.png","showOrHide":[true,true,true,true]},{"x":1151,"y":362,"layer":6,"startTime":2500,"totalTime":-1,"img":"636614829855691016.png","showOrHide":[true,true,false,false]},{"x":45,"y":2,"layer":9,"startTime":200,"totalTime":-1,"img":"636614829856003017.png","showOrHide":[true,true,false,false]},{"x":440,"y":151,"layer":10,"startTime":200,"totalTime":-1,"img":"636614829856315019.png","showOrHide":[true,true,false,false]}]},{"num":"7","pro":5,"next":7,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000170.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":7,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000417.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000418.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614829859591040.png","showOrHide":[true,true,true,true]},{"x":45,"y":2,"layer":9,"startTime":200,"totalTime":-1,"img":"636614829860059043.png","showOrHide":[true,true,false,false]},{"x":431,"y":105,"layer":10,"startTime":200,"totalTime":-1,"img":"636614829860371045.png","showOrHide":[true,true,false,false]}]},{"num":"8","pro":6,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000325.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000419.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636614829863803067.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);