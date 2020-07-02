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
var json_data = '{"info":{"name":"企業自動検索（士業）","author":"","strDate":"Wednesday,&nbsp;May 09,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000006.jpg"}],"mouseActions":[{"x":350,"y":192,"w":220,"h":88,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"a3f74db4-9b2c-4357-bcde-7d4845079eb2.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000453.png"}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636614834149145222.png","showOrHide":[true,true,true,true]},{"x":436,"y":268,"layer":2,"startTime":1000,"totalTime":-1,"img":"636614834150705232.png","showOrHide":[true,true,false,false]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":4500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000034.jpg"}],"mouseActions":[{"x":411,"y":317,"w":504,"h":120,"layer":8,"strokeColor":"#ff0000","next":2,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"857289b2-4db1-4cda-8dd9-ff9f8d28d9e1.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000454.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000455.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636614834154449256.png","showOrHide":[true,true,true,true]},{"x":69,"y":315,"layer":4,"startTime":3000,"totalTime":-1,"img":"636614834154449257.png","showOrHide":[true,true,false,false]},{"x":272,"y":453,"layer":5,"startTime":1500,"totalTime":-1,"img":"636614834154605257.png","showOrHide":[true,true,false,false]},{"x":128,"y":438,"layer":6,"startTime":3000,"totalTime":-1,"img":"636614834154917259.png","showOrHide":[true,true,false,false]},{"x":609,"y":465,"layer":7,"startTime":1500,"totalTime":-1,"img":"636614834155697264.png","showOrHide":[true,true,false,false]},{"x":750,"y":139,"layer":9,"startTime":100,"totalTime":-1,"img":"636614834156165267.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":2500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000414.jpg"}],"mouseActions":[{"x":1152,"y":291,"w":108,"h":32,"layer":1,"strokeColor":"#ff0000","next":3,"startTime":1000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"5181e76b-eb12-4ad4-b849-ff09b6fd59a7.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000456.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000457.png"}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636614834160301301.png","showOrHide":[true,true,true,true]},{"x":559,"y":104,"layer":6,"startTime":1000,"totalTime":-1,"img":"636614834160925305.png","showOrHide":[true,true,false,false]},{"x":842,"y":265,"layer":5,"startTime":1000,"totalTime":-1,"img":"636614834161393308.png","showOrHide":[true,true,false,false]},{"x":232,"y":494,"layer":7,"startTime":200,"totalTime":-1,"img":"636614834161549309.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":4500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000415.jpg"}],"mouseActions":[{"x":657,"y":52,"w":150,"h":44,"layer":3,"strokeColor":"#ff0000","next":4,"startTime":3000,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"90147351-b4ff-484c-a3ee-730d7d96d579.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000458.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000459.png"}],"notes":[{"x":-10,"y":701,"layer":7,"startTime":0,"totalTime":-1,"img":"636614834165761336.png","showOrHide":[true,true,true,true]},{"x":730,"y":421,"layer":8,"startTime":1200,"totalTime":-1,"img":"636614834166697342.png","showOrHide":[true,true,false,false]},{"x":240,"y":217,"layer":4,"startTime":200,"totalTime":-1,"img":"636614834166853343.png","showOrHide":[true,true,false,false]},{"x":789,"y":78,"layer":5,"startTime":3000,"totalTime":-1,"img":"636614834167633348.png","showOrHide":[true,true,false,false]},{"x":227,"y":378,"layer":6,"startTime":1200,"totalTime":-1,"img":"636614834167789349.png","showOrHide":[true,true,false,false]},{"x":368,"y":151,"layer":9,"startTime":200,"totalTime":-1,"img":"636614834168101351.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000317.jpg"}],"mouseActions":[{"x":863,"y":75,"w":264,"h":54,"layer":5,"strokeColor":"#ff0000","next":5,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"c6573719-131f-4aad-ba85-659e1aa8ed38.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":1,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000460.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000461.png"}],"notes":[{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636614834172157377.png","showOrHide":[true,true,true,true]},{"x":1049,"y":0,"layer":4,"startTime":0,"totalTime":-1,"img":"636614834172157378.png","showOrHide":[true,true,false,false]},{"x":589,"y":107,"layer":6,"startTime":200,"totalTime":-1,"img":"636614834172625380.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":6,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000418.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":6,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000462.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000463.png"}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636614834176213403.png","showOrHide":[true,true,true,true]},{"x":505,"y":219,"layer":6,"startTime":200,"totalTime":-1,"img":"636614834176369404.png","showOrHide":[true,true,false,false]},{"x":807,"y":393,"layer":7,"startTime":200,"totalTime":-1,"img":"636614834176525405.png","showOrHide":[true,true,false,false]}]},{"num":"7","pro":5,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000413.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000464.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636614834179177422.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);