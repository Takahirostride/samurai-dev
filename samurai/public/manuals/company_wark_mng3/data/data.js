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
var json_data = '{"info":{"name":"仕事管理（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":4000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000422.jpg"}],"mouseActions":[{"x":295,"y":576,"w":167,"h":45,"layer":2,"strokeColor":"#ff0000","next":1,"startTime":2500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"bb17222e-d15e-4e11-b234-76a2912e6a52.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":6,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000454.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":1808,"img":"mouseRoute1.png"},{"x":378,"y":598,"totalTime":2192}]}],"notes":[{"x":71,"y":275,"layer":3,"startTime":0,"totalTime":-1,"img":"636616455620970554.png","showOrHide":[true,true,false,false]},{"x":20,"y":280,"layer":4,"startTime":0,"totalTime":-1,"img":"636616455621126554.png","showOrHide":[true,true,true,true]},{"x":271,"y":441,"layer":0,"startTime":1000,"totalTime":-1,"img":"636616455621282554.png","showOrHide":[true,true,false,false]},{"x":-17,"y":380,"layer":10,"startTime":2500,"totalTime":-1,"img":"636616455621906554.png","showOrHide":[true,true,false,false]},{"x":270,"y":118,"layer":7,"startTime":200,"totalTime":-1,"img":"636616455621906555.png","showOrHide":[true,true,false,false]},{"x":733,"y":308,"layer":8,"startTime":1000,"totalTime":-1,"img":"636616455622218554.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":9,"startTime":0,"totalTime":-1,"img":"636616455622584554.png","showOrHide":[true,true,true,true]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":2700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000423.jpg"}],"mouseActions":[{"x":287,"y":231,"w":937,"h":475,"layer":2,"strokeColor":"#ff0000","next":2,"startTime":1200,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"62f77a2c-ee20-4d39-80e7-2458f4dda8f6.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":9,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000455.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000456.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":378,"y":598,"startTime":0,"totalTime":1935,"img":"mouseRoute2.png"},{"x":755,"y":468,"totalTime":765}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616455627002554.png","showOrHide":[true,true,true,true]},{"x":71,"y":102,"layer":4,"startTime":0,"totalTime":-1,"img":"636616455627158554.png","showOrHide":[true,true,false,false]},{"x":20,"y":107,"layer":5,"startTime":0,"totalTime":-1,"img":"636616455627314554.png","showOrHide":[true,true,true,true]},{"x":283,"y":134,"layer":6,"startTime":200,"totalTime":-1,"img":"636616455627470554.png","showOrHide":[true,true,false,false]},{"x":856,"y":240,"layer":7,"startTime":1200,"totalTime":-1,"img":"636616455628094554.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":2700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000424.jpg"}],"mouseActions":[{"x":292,"y":231,"w":931,"h":475,"layer":2,"strokeColor":"#ff0000","next":3,"startTime":1200,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"76583b42-f331-48db-aa26-11ae83437b79.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":9,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000457.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":10,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000458.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":755,"y":468,"startTime":0,"totalTime":9,"img":"mouseRoute3.png"},{"x":757,"totalTime":2691}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616455631682554.png","showOrHide":[true,true,true,true]},{"x":70,"y":102,"layer":4,"startTime":0,"totalTime":-1,"img":"636616455631838554.png","showOrHide":[true,true,false,false]},{"x":19,"y":107,"layer":5,"startTime":0,"totalTime":-1,"img":"636616455631994554.png","showOrHide":[true,true,true,true]},{"x":446,"y":131,"layer":6,"startTime":200,"totalTime":-1,"img":"636616455631994555.png","showOrHide":[true,true,false,false]},{"x":793,"y":276,"layer":7,"startTime":1200,"totalTime":-1,"img":"636616455632462554.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":2700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000425.jpg"}],"mouseActions":[{"x":293,"y":333,"w":787,"h":373,"layer":2,"strokeColor":"#ff0000","next":4,"startTime":1200,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"a9193e9b-443b-45c9-97c3-9d6bc6f7bf7a.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":9,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000459.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000460.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":757,"y":468,"startTime":0,"totalTime":424,"img":"mouseRoute4.png"},{"x":686,"y":519,"totalTime":2276}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616455635738554.png","showOrHide":[true,true,true,true]},{"x":71,"y":102,"layer":4,"startTime":0,"totalTime":-1,"img":"636616455635738555.png","showOrHide":[true,true,false,false]},{"x":20,"y":107,"layer":5,"startTime":0,"totalTime":-1,"img":"636616455635894554.png","showOrHide":[true,true,true,true]},{"x":958,"y":132,"layer":6,"startTime":200,"totalTime":-1,"img":"636616455636050554.png","showOrHide":[true,true,false,false]},{"x":822,"y":336,"layer":7,"startTime":1200,"totalTime":-1,"img":"636616455636674554.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000415.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000461.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616455640730554.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);