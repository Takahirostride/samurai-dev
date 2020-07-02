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
var json_data = '{"info":{"name":"プロフィール管理（士業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001330.jpg"}],"mouseActions":[{"x":274,"y":432,"w":772,"h":59,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"a2888e7c-2d5e-4e65-9197-8020e6e39180.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000329.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":390,"img":"mouseRoute1.png"},{"x":660,"y":461,"totalTime":1310}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616593361292747.png","showOrHide":[true,true,true,true]},{"x":30,"y":426,"layer":7,"startTime":0,"totalTime":-1,"img":"636616593361604747.png","showOrHide":[true,true,true,true]},{"x":534,"y":253,"layer":5,"startTime":200,"totalTime":-1,"img":"636616593362072747.png","showOrHide":[true,true,false,false]},{"x":72,"y":423,"layer":6,"startTime":0,"totalTime":-1,"img":"636616593362072748.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001331.jpg"}],"mouseActions":[{"x":854,"y":517,"w":147,"h":47,"layer":1,"strokeColor":"#ff0000","next":2,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"d0051de0-4e0a-43cf-bdbb-5bde81824205.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000330.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000331.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":660,"y":461,"startTime":0,"totalTime":1351,"img":"mouseRoute2.png"},{"x":927,"y":540,"totalTime":349}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616593366440747.png","showOrHide":[true,true,true,true]},{"x":30,"y":428,"layer":7,"startTime":0,"totalTime":-1,"img":"636616593366752747.png","showOrHide":[true,true,true,true]},{"x":319,"y":389,"layer":9,"startTime":0,"totalTime":-1,"img":"636616593366908747.png","showOrHide":[true,true,true,true]},{"x":607,"y":329,"layer":2,"startTime":200,"totalTime":-1,"img":"636616593367220747.png","showOrHide":[true,true,false,false]},{"x":72,"y":423,"layer":6,"startTime":0,"totalTime":-1,"img":"636616593367376747.png","showOrHide":[true,true,false,false]},{"x":268,"y":426,"layer":8,"startTime":0,"totalTime":-1,"img":"636616593367376748.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001332.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000332.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000333.png"}],"notes":[{"x":-10,"y":701,"layer":2,"startTime":0,"totalTime":-1,"img":"636616593371172747.png","showOrHide":[true,true,true,true]},{"x":308,"y":570,"layer":5,"startTime":300,"totalTime":-1,"img":"636616593371328747.png","showOrHide":[true,true,false,false]},{"x":577,"y":408,"layer":6,"startTime":300,"totalTime":-1,"img":"636616593371640747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":7,"startTime":2500,"totalTime":-1,"img":"636616593371796747.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001333.jpg"}],"mouseActions":[{"x":605,"y":602,"w":121,"h":46,"layer":1,"strokeColor":"#ff0000","next":4,"startTime":1500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"5e9e1ade-2ce6-4bc9-9fad-48cf3362f973.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":4,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000334.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":5,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000335.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":927,"y":540,"startTime":0,"totalTime":1337,"img":"mouseRoute3.png"},{"x":665,"y":625,"totalTime":1663}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616593375540747.png","showOrHide":[true,true,true,true]},{"x":649,"y":456,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616593376008747.png","showOrHide":[true,true,false,false]},{"x":302,"y":54,"layer":0,"startTime":200,"totalTime":-1,"img":"636616593376476747.png","showOrHide":[true,true,false,false]},{"x":794,"y":89,"layer":7,"startTime":200,"totalTime":-1,"img":"636616593377412747.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001325.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000336.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616593381468747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);