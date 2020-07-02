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
var json_data = '{"info":{"name":"自動検索（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000398.jpg"}],"mouseActions":[{"x":863,"y":75,"w":268,"h":54,"layer":5,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"95f6fdaf-3edc-4298-9b15-5fde6f31db9a.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000452.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616536762718626.png","showOrHide":[true,true,true,true]},{"x":1049,"y":0,"layer":4,"startTime":0,"totalTime":-1,"img":"636616536762874626.png","showOrHide":[true,true,false,false]},{"x":588,"y":107,"layer":6,"startTime":200,"totalTime":-1,"img":"636616536763186626.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000418.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000453.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000454.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616536766366626.png","showOrHide":[true,true,true,true]},{"x":505,"y":217,"layer":6,"startTime":200,"totalTime":-1,"img":"636616536766522626.png","showOrHide":[true,true,false,false]},{"x":864,"y":391,"layer":7,"startTime":200,"totalTime":-1,"img":"636616536766678626.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000412.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000455.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616536769812626.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);