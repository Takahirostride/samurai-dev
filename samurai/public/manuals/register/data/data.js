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
var json_data = '{"info":{"name":"新規登録（共通）","author":"","strDate":"Wednesday,&nbsp;May 09,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":false,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000321.jpg"}],"mouseActions":[{"x":718,"y":228,"w":170,"h":62,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"4b104448-61d1-4c92-bdd5-913fac70b90c.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":5,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000445.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":841,"img":"mouseRoute1.png"},{"x":803,"y":259,"totalTime":959}]}],"notes":[{"x":468,"y":273,"layer":2,"startTime":300,"totalTime":-1,"img":"636614791691721317.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636614791692189317.png","showOrHide":[true,true,true,true]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":4300,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000319.jpg"}],"mouseActions":[{"x":356,"y":489,"w":525,"h":49,"layer":1,"strokeColor":"#ff0000","next":2,"startTime":2500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"86b5f58d-32ff-4487-96fe-a1c4fb9e8ab2.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":10,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000446.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":11,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000447.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":803,"y":259,"startTime":0,"totalTime":1525,"img":"mouseRoute2.png"},{"x":618,"y":513,"totalTime":2775}]}],"notes":[{"x":592,"y":510,"layer":2,"startTime":2800,"totalTime":-1,"img":"636614791695777317.png","showOrHide":[true,true,false,false]},{"x":340,"y":93,"layer":3,"startTime":100,"totalTime":-1,"img":"636614791695933317.png","showOrHide":[true,true,false,false]},{"x":653,"y":-9,"layer":4,"startTime":100,"totalTime":-1,"img":"636614791696401317.png","showOrHide":[true,true,false,false]},{"x":818,"y":180,"layer":6,"startTime":1200,"totalTime":-1,"img":"636614791697181317.png","showOrHide":[true,true,false,false]},{"x":322,"y":353,"layer":5,"startTime":1200,"totalTime":-1,"img":"636614791697181318.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":9,"startTime":0,"totalTime":-1,"img":"636614791697649317.png","showOrHide":[true,true,true,true]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":1800,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000324.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":7,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000448.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":8,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000449.png"}],"notes":[{"x":410,"y":242,"layer":3,"startTime":0,"totalTime":-1,"img":"636614791700925317.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":6,"startTime":0,"totalTime":-1,"img":"636614791701121317.png","showOrHide":[true,true,true,true]},{"x":738,"y":344,"layer":9,"startTime":300,"totalTime":-1,"img":"636614791701909317.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000320.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000450.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636614791705341317.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);