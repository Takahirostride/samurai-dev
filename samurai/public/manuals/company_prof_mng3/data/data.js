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
var json_data = '{"info":{"name":"プロフィール管理（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000838.jpg"}],"mouseActions":[{"x":853,"y":98,"w":149,"h":46,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"bffc1372-7ddb-47af-aee3-70f9ea531bb7.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000609.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":1741,"img":"mouseRoute1.png"},{"x":927,"y":121,"totalTime":59}]}],"notes":[{"x":284,"y":121,"layer":5,"startTime":300,"totalTime":-1,"img":"636616584553320747.png","showOrHide":[true,true,false,false]},{"x":409,"y":5,"layer":6,"startTime":0,"totalTime":-1,"img":"636616584553476747.png","showOrHide":[true,true,false,false]},{"x":451,"y":60,"layer":8,"startTime":0,"totalTime":-1,"img":"636616584553632747.png","showOrHide":[true,true,true,true]},{"x":-10,"y":701,"layer":9,"startTime":0,"totalTime":-1,"img":"636616584554100747.png","showOrHide":[true,true,true,true]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":4500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000839.jpg"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":7,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000610.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":9,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000611.png"}],"notes":[{"x":263,"y":346,"layer":2,"startTime":1200,"totalTime":-1,"img":"636616584558040747.png","showOrHide":[true,true,false,false]},{"x":261,"y":146,"layer":3,"startTime":200,"totalTime":-1,"img":"636616584558270747.png","showOrHide":[true,true,false,false]},{"x":674,"y":20,"layer":4,"startTime":200,"totalTime":-1,"img":"636616584558560747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":361,"layer":5,"startTime":3000,"totalTime":-1,"img":"636616584558932747.png","showOrHide":[true,true,false,false]},{"x":896,"y":302,"layer":6,"startTime":1200,"totalTime":-1,"img":"636616584559868747.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":8,"startTime":0,"totalTime":-1,"img":"636616584560492747.png","showOrHide":[true,true,true,true]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000840.jpg"}],"mouseActions":[{"x":593,"y":636,"w":149,"h":44,"layer":1,"strokeColor":"#ff0000","next":3,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"dbd4eede-c793-48d8-8fe0-12506c337ad8.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":5,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000612.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000613.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":927,"y":121,"startTime":0,"totalTime":2896,"img":"mouseRoute2.png"},{"x":667,"y":658,"totalTime":104}]}],"notes":[{"x":261,"y":443,"layer":2,"startTime":200,"totalTime":-1,"img":"636616584564392747.png","showOrHide":[true,true,false,false]},{"x":567,"y":291,"layer":3,"startTime":200,"totalTime":-1,"img":"636616584565016747.png","showOrHide":[true,true,false,false]},{"x":723,"y":497,"layer":4,"startTime":1500,"totalTime":-1,"img":"636616584565328747.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":6,"startTime":0,"totalTime":-1,"img":"636616584566108747.png","showOrHide":[true,true,true,true]}]},{"num":"4","pro":2,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000831.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000614.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616584569746747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);