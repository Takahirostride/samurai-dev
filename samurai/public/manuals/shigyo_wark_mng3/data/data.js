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
var json_data = '{"info":{"name":"仕事管理（士業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000439.jpg"}],"mouseActions":[{"x":293,"y":270,"w":898,"h":439,"layer":2,"strokeColor":"#ff0000","next":1,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"caa20e65-5398-4e7a-a24c-42d0bc149c84.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000475.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":584,"img":"mouseRoute1.png"},{"x":742,"y":489,"totalTime":2916}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616468378202614.png","showOrHide":[true,true,true,true]},{"x":21,"y":154,"layer":5,"startTime":0,"totalTime":-1,"img":"636616468378358619.png","showOrHide":[true,true,true,true]},{"x":72,"y":149,"layer":4,"startTime":0,"totalTime":-1,"img":"636616468378514624.png","showOrHide":[true,true,false,false]},{"x":959,"y":179,"layer":6,"startTime":200,"totalTime":-1,"img":"636616468378514625.png","showOrHide":[true,true,false,false]},{"x":843,"y":270,"layer":7,"startTime":1000,"totalTime":-1,"img":"636616468378982639.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":11,"startTime":2000,"totalTime":-1,"img":"636616468379138644.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000197.jpg"}],"mouseActions":[{"x":304,"y":122,"w":781,"h":527,"layer":2,"strokeColor":"#ff0000","next":2,"startTime":500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"8879cb8d-f44b-4cec-99ea-2d69afa0de1f.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":9,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000476.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000477.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":742,"y":489,"startTime":0,"totalTime":556,"img":"mouseRoute2.png"},{"x":694,"y":385,"totalTime":2944}]}],"notes":[{"x":839,"y":75,"layer":7,"startTime":500,"totalTime":-1,"img":"636616468382902766.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":11,"startTime":2000,"totalTime":-1,"img":"636616468382902767.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":12,"startTime":0,"totalTime":-1,"img":"636616468383370781.png","showOrHide":[true,true,true,true]},{"x":535,"y":576,"layer":13,"startTime":1000,"totalTime":-1,"img":"636616468383370782.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000214.jpg"}],"mouseActions":[{"x":292,"y":86,"w":877,"h":513,"layer":2,"strokeColor":"#ff0000","next":3,"startTime":500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"6729947d-a5ad-4c37-9017-56d50d99db37.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":9,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000478.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000479.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":694,"y":385,"startTime":0,"totalTime":272,"img":"mouseRoute3.png"},{"x":730,"y":342,"totalTime":2228}]}],"notes":[{"x":535,"y":492,"layer":6,"startTime":1000,"totalTime":-1,"img":"636616468386510883.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":11,"startTime":0,"totalTime":-1,"img":"636616468386978898.png","showOrHide":[true,true,true,true]},{"x":844,"y":156,"layer":12,"startTime":500,"totalTime":-1,"img":"636616468387632921.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000416.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000480.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616468390597016.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);