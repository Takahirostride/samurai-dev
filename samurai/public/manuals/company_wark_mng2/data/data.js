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
var json_data = '{"info":{"name":"仕事管理（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000420.jpg"}],"mouseActions":[{"x":274,"y":294,"w":275,"h":63,"layer":2,"strokeColor":"#ff0000","next":1,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"b38f7fdd-1afa-4775-abc4-d4befb95ef21.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":9,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000458.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":1351,"img":"mouseRoute1.png"},{"x":411,"y":325,"totalTime":1149}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616453490772554.png","showOrHide":[true,true,true,true]},{"x":72,"y":447,"layer":5,"startTime":0,"totalTime":-1,"img":"636616453490772555.png","showOrHide":[true,true,false,false]},{"x":21,"y":452,"layer":6,"startTime":0,"totalTime":-1,"img":"636616453490928554.png","showOrHide":[true,true,true,true]},{"x":589,"y":171,"layer":7,"startTime":200,"totalTime":-1,"img":"636616453491084554.png","showOrHide":[true,true,false,false]},{"x":466,"y":326,"layer":8,"startTime":1000,"totalTime":-1,"img":"636616453491708554.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000421.jpg"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":6,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000459.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000460.png"}],"notes":[{"x":-10,"y":701,"layer":2,"startTime":0,"totalTime":-1,"img":"636616453495500554.png","showOrHide":[true,true,true,true]},{"x":72,"y":447,"layer":3,"startTime":0,"totalTime":-1,"img":"636616453495656554.png","showOrHide":[true,true,false,false]},{"x":21,"y":452,"layer":4,"startTime":0,"totalTime":-1,"img":"636616453495812554.png","showOrHide":[true,true,true,true]},{"x":385,"y":289,"layer":5,"startTime":200,"totalTime":-1,"img":"636616453495812555.png","showOrHide":[true,true,false,false]},{"x":835,"y":174,"layer":8,"startTime":1000,"totalTime":-1,"img":"636616453496592554.png","showOrHide":[true,true,false,false]},{"x":267,"y":343,"layer":0,"startTime":1000,"totalTime":-1,"img":"636616453496672554.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000415.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000461.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616453500692554.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);