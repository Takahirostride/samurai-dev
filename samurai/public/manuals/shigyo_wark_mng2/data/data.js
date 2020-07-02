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
var json_data = '{"info":{"name":"仕事管理（士業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":3700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000434.jpg"}],"mouseActions":[{"x":296,"y":460,"w":167,"h":45,"layer":2,"strokeColor":"#ff0000","next":1,"startTime":2200,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"767c4051-dd52-4689-8589-017af916cc8b.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000486.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":1550,"img":"mouseRoute1.png"},{"x":379,"y":482,"totalTime":2150}]}],"notes":[{"x":21,"y":165,"layer":5,"startTime":0,"totalTime":-1,"img":"636616466292902935.png","showOrHide":[true,true,true,true]},{"x":-10,"y":701,"layer":11,"startTime":0,"totalTime":-1,"img":"636616466293068941.png","showOrHide":[true,true,true,true]},{"x":72,"y":160,"layer":4,"startTime":0,"totalTime":-1,"img":"636616466293088943.png","showOrHide":[true,true,false,false]},{"x":274,"y":324,"layer":0,"startTime":1000,"totalTime":-1,"img":"636616466293490962.png","showOrHide":[true,true,false,false]},{"x":-12,"y":264,"layer":8,"startTime":2200,"totalTime":-1,"img":"636616466293802972.png","showOrHide":[true,true,false,false]},{"x":270,"y":2,"layer":9,"startTime":200,"totalTime":-1,"img":"636616466293958977.png","showOrHide":[true,true,false,false]},{"x":759,"y":199,"layer":10,"startTime":1000,"totalTime":-1,"img":"636616466294124983.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000435.jpg"}],"mouseActions":[{"x":273,"y":297,"w":986,"h":409,"layer":2,"strokeColor":"#ff0000","next":2,"startTime":500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"4e9b8712-02c9-41b0-81f0-68543099733a.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":6,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000487.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000488.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":379,"y":482,"startTime":0,"totalTime":1880,"img":"mouseRoute2.png"},{"x":766,"y":501,"totalTime":1620}]}],"notes":[{"x":745,"y":96,"layer":3,"startTime":500,"totalTime":-1,"img":"636616466298573131.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":4,"startTime":2000,"totalTime":-1,"img":"636616466298729136.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616466299197151.png","showOrHide":[true,true,true,true]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000426.jpg"}],"mouseActions":[{"x":664,"y":205,"w":615,"h":404,"layer":2,"strokeColor":"#ff0000","next":3,"startTime":500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"00f790fe-5e4e-4da1-82e5-2f8774c4610b.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":6,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000489.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000490.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":766,"y":501,"startTime":0,"totalTime":1094,"img":"mouseRoute3.png"},{"x":971,"y":407,"totalTime":1406}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616466302317251.png","showOrHide":[true,true,true,true]},{"x":57,"y":103,"layer":3,"startTime":500,"totalTime":-1,"img":"636616466302975285.png","showOrHide":[true,true,false,false]},{"x":680,"y":642,"layer":8,"startTime":1000,"totalTime":-1,"img":"636616466303131290.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":3500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000436.jpg"}],"mouseActions":[{"x":460,"y":460,"w":167,"h":45,"layer":2,"strokeColor":"#ff0000","next":4,"startTime":2000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"97343f40-8b83-48d7-a34f-29bff7267524.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":6,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000491.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000492.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":971,"y":407,"startTime":0,"totalTime":2109,"img":"mouseRoute4.png"},{"x":543,"y":482,"totalTime":1391}]}],"notes":[{"x":21,"y":165,"layer":5,"startTime":0,"totalTime":-1,"img":"636616466305767384.png","showOrHide":[true,true,true,true]},{"x":-10,"y":701,"layer":11,"startTime":0,"totalTime":-1,"img":"636616466306235399.png","showOrHide":[true,true,true,true]},{"x":72,"y":160,"layer":4,"startTime":0,"totalTime":-1,"img":"636616466306235400.png","showOrHide":[true,true,false,false]},{"x":274,"y":324,"layer":0,"startTime":800,"totalTime":-1,"img":"636616466306391404.png","showOrHide":[true,true,false,false]},{"x":210,"y":264,"layer":8,"startTime":2000,"totalTime":-1,"img":"636616466306859419.png","showOrHide":[true,true,false,false]},{"x":270,"y":2,"layer":9,"startTime":200,"totalTime":-1,"img":"636616466306859420.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000437.jpg"}],"mouseActions":[{"x":287,"y":270,"w":937,"h":439,"layer":2,"strokeColor":"#ff0000","next":5,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"61ea885d-aea0-4af2-84ff-785d43f99911.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":9,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000493.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000494.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":543,"y":482,"startTime":0,"totalTime":1029,"img":"mouseRoute5.png"},{"x":755,"y":489,"totalTime":1471}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616466314085654.png","showOrHide":[true,true,true,true]},{"x":21,"y":152,"layer":5,"startTime":0,"totalTime":-1,"img":"636616466314241659.png","showOrHide":[true,true,true,true]},{"x":72,"y":147,"layer":4,"startTime":0,"totalTime":-1,"img":"636616466314397664.png","showOrHide":[true,true,false,false]},{"x":446,"y":180,"layer":6,"startTime":200,"totalTime":-1,"img":"636616466314397665.png","showOrHide":[true,true,false,false]},{"x":876,"y":263,"layer":7,"startTime":1000,"totalTime":-1,"img":"636616466315297701.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":6,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000438.jpg"}],"mouseActions":[{"x":293,"y":298,"w":931,"h":411,"layer":2,"strokeColor":"#ff0000","next":6,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"56f44b0d-806a-4be3-8a1e-1a9439094ca8.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":9,"next":6,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000495.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":10,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000496.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":755,"y":489,"startTime":0,"totalTime":69,"img":"mouseRoute6.png"},{"x":758,"y":503,"totalTime":2431}]}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616466319665841.png","showOrHide":[true,true,true,true]},{"x":21,"y":154,"layer":5,"startTime":0,"totalTime":-1,"img":"636616466319821846.png","showOrHide":[true,true,true,true]},{"x":72,"y":149,"layer":4,"startTime":0,"totalTime":-1,"img":"636616466319821847.png","showOrHide":[true,true,false,false]},{"x":612,"y":178,"layer":6,"startTime":200,"totalTime":-1,"img":"636616466319821848.png","showOrHide":[true,true,false,false]},{"x":810,"y":333,"layer":7,"startTime":1000,"totalTime":-1,"img":"636616466320289861.png","showOrHide":[true,true,false,false]}]},{"num":"7","pro":5,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000416.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000497.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616466324279995.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);