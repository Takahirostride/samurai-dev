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
var json_data = '{"info":{"name":"募集する（企業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000026.jpg"}],"mouseActions":[{"x":1079,"y":333,"w":157,"h":43,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":1500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"d759ab5a-e058-4624-bd7a-7cb320b632a8.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000980.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":2305,"img":"mouseRoute1.png"},{"x":1157,"y":354,"totalTime":695}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616542783102626.png","showOrHide":[true,true,true,true]},{"x":96,"y":275,"layer":5,"startTime":200,"totalTime":-1,"img":"636616542783258626.png","showOrHide":[true,true,false,false]},{"x":849,"y":350,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616542783570626.png","showOrHide":[true,true,false,false]},{"x":361,"y":223,"layer":7,"startTime":200,"totalTime":-1,"img":"636616542784194626.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000030.jpg"}],"mouseActions":[{"x":1029,"y":570,"w":156,"h":41,"layer":1,"strokeColor":"#ff0000","next":2,"startTime":1500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"648cfb8d-acf2-4632-81d0-bbbf2e6a7d5e.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000981.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000982.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":1157,"y":354,"startTime":0,"totalTime":1171,"img":"mouseRoute2.png"},{"x":1107,"y":590,"totalTime":1829}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616542788446626.png","showOrHide":[true,true,true,true]},{"x":103,"y":281,"layer":5,"startTime":200,"totalTime":-1,"img":"636616542788602626.png","showOrHide":[true,true,false,false]},{"x":806,"y":404,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616542788758626.png","showOrHide":[true,true,false,false]},{"x":79,"y":508,"layer":7,"startTime":200,"totalTime":-1,"img":"636616542788914626.png","showOrHide":[true,true,false,false]},{"x":389,"y":353,"layer":8,"startTime":200,"totalTime":-1,"img":"636616542789226626.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000830.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000983.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616542795310626.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);