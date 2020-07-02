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
var json_data = '{"info":{"name":"プロフィール管理（士業）","author":"","strDate":"Friday,&nbsp;May 11,&nbsp;2018","modes":{"mode0":false,"mode1":true,"mode2":false,"mode3":false},"bgSize":{"w":1366,"h":768},"flickerTime":500,"level":0,"requireLine":0,"boolTuckToolBar":true,"mail":"mimi@tendaco.jp"},"steps":[{"num":"1","pro":0,"next":1,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001346.jpg"}],"mouseActions":[{"x":706,"y":400,"w":147,"h":47,"layer":1,"strokeColor":"#ff0000","next":1,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"08f18cdb-e5d9-41a5-bdf3-434a3ad9c7f8.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000347.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":683,"y":384,"startTime":0,"totalTime":503,"img":"mouseRoute1.png"},{"x":779,"y":423,"totalTime":1197}]}],"notes":[{"x":603,"y":271,"layer":9,"startTime":0,"totalTime":-1,"img":"636616597075310747.png","showOrHide":[true,true,true,true]},{"x":759,"y":208,"layer":2,"startTime":200,"totalTime":-1,"img":"636616597075798747.png","showOrHide":[true,true,false,false]},{"x":550,"y":309,"layer":8,"startTime":0,"totalTime":-1,"img":"636616597075798748.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":10,"startTime":0,"totalTime":-1,"img":"636616597076266747.png","showOrHide":[true,true,true,true]}]},{"num":"2","pro":0,"next":2,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001344.jpg"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000348.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":0,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000349.png"}],"notes":[{"x":-10,"y":701,"layer":10,"startTime":0,"totalTime":-1,"img":"636616597080176747.png","showOrHide":[true,true,true,true]},{"x":903,"y":279,"layer":11,"startTime":200,"totalTime":-1,"img":"636616597080332747.png","showOrHide":[true,true,false,false]},{"x":369,"y":409,"layer":12,"startTime":200,"totalTime":-1,"img":"636616597081424747.png","showOrHide":[true,true,false,false]}]},{"num":"3","pro":1,"next":3,"bScore":true,"totalTime":4500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000258.jpg"}],"mouseActions":[{"x":292,"y":197,"w":277,"h":40,"layer":1,"strokeColor":"#ff0000","next":3,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"eb0228b5-d7cd-49a8-b6f7-d69d91515012.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000350.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000351.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":779,"y":423,"startTime":0,"totalTime":1967,"img":"mouseRoute2.png"},{"x":430,"y":217,"totalTime":2533}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616597085480747.png","showOrHide":[true,true,true,true]},{"x":540,"y":43,"layer":2,"startTime":200,"totalTime":-1,"img":"636616597086320747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":3000,"totalTime":-1,"img":"636616597086476747.png","showOrHide":[true,true,false,false]},{"x":264,"y":537,"layer":7,"startTime":2500,"totalTime":-1,"img":"636616597086632747.png","showOrHide":[true,true,false,false]},{"x":580,"y":523,"layer":10,"startTime":2500,"totalTime":-1,"img":"636616597086798747.png","showOrHide":[true,true,false,false]},{"x":265,"y":295,"layer":8,"startTime":1500,"totalTime":-1,"img":"636616597086868747.png","showOrHide":[true,true,false,false]},{"x":793,"y":242,"layer":9,"startTime":1500,"totalTime":-1,"img":"636616597087406747.png","showOrHide":[true,true,false,false]}]},{"num":"4","pro":2,"next":4,"bScore":true,"totalTime":3382,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000302.jpg"}],"mouseActions":[{"x":1065,"y":228,"w":122,"h":44,"layer":1,"strokeColor":"#ff0000","next":4,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"4f3d3ab7-87f1-4924-92ac-b5994ccd3991.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":4,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000352.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":5,"next":2,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000353.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":430,"y":217,"startTime":0,"totalTime":3382,"img":"mouseRoute3.png"},{"x":1126,"y":250,"totalTime":0}]}],"notes":[{"x":-10,"y":701,"layer":6,"startTime":0,"totalTime":-1,"img":"636616597090682747.png","showOrHide":[true,true,true,true]},{"x":76,"y":149,"layer":2,"startTime":200,"totalTime":-1,"img":"636616597090838747.png","showOrHide":[true,true,false,false]},{"x":765,"y":255,"layer":3,"startTime":1300,"totalTime":-1,"img":"636616597091150747.png","showOrHide":[true,true,false,false]}]},{"num":"5","pro":3,"next":5,"bScore":true,"totalTime":3002,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000306.jpg"}],"mouseActions":[{"x":592,"y":646,"w":159,"h":47,"layer":1,"strokeColor":"#ff0000","next":5,"startTime":1500,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"93b99c2e-714c-471c-9656-84b0b8ae027c.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000354.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":3,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000355.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":1126,"y":250,"startTime":0,"totalTime":3002,"img":"mouseRoute4.png"},{"x":671,"y":669,"totalTime":0}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616597095986747.png","showOrHide":[true,true,true,true]},{"x":506,"y":175,"layer":2,"startTime":200,"totalTime":-1,"img":"636616597096776747.png","showOrHide":[true,true,false,false]},{"x":1020,"y":398,"layer":6,"startTime":200,"totalTime":-1,"img":"636616597096836747.png","showOrHide":[true,true,false,false]},{"x":193,"y":459,"layer":7,"startTime":1500,"totalTime":-1,"img":"636616597097540747.png","showOrHide":[true,true,false,false]}]},{"num":"6","pro":4,"next":6,"bScore":true,"totalTime":3270,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001323.jpg"}],"mouseActions":[{"x":72,"y":285,"w":59,"h":50,"layer":1,"strokeColor":"#ff0000","next":6,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"42461bf9-e705-4cfd-a0f8-186e81ffd106.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":6,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000356.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":4,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000357.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":671,"y":669,"startTime":0,"totalTime":3270,"img":"mouseRoute5.png"},{"x":101,"y":310,"totalTime":0}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616597102376747.png","showOrHide":[true,true,true,true]},{"x":82,"y":314,"layer":5,"startTime":300,"totalTime":-1,"img":"636616597103000747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616597103156747.png","showOrHide":[true,true,false,false]}]},{"num":"7","pro":5,"next":7,"bScore":true,"totalTime":2940,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000346.jpg"}],"mouseActions":[{"x":542,"y":620,"w":131,"h":47,"layer":2,"strokeColor":"#ff0000","next":7,"startTime":1200,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"620f6371-7037-46be-aa7b-9b514d07ab22.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":5,"next":5,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000358.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":8,"next":7,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000359.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":101,"y":310,"startTime":0,"totalTime":2940,"img":"mouseRoute6.png"},{"x":607,"y":643,"totalTime":0}]}],"notes":[{"x":-10,"y":701,"layer":6,"startTime":0,"totalTime":-1,"img":"636616597106910747.png","showOrHide":[true,true,true,true]},{"x":811,"y":129,"layer":3,"startTime":200,"totalTime":-1,"img":"636616597107534747.png","showOrHide":[true,true,false,false]},{"x":230,"y":33,"layer":0,"startTime":200,"totalTime":-1,"img":"636616597107846747.png","showOrHide":[true,true,false,false]},{"x":649,"y":445,"layer":7,"startTime":1200,"totalTime":-1,"img":"636616597108314747.png","showOrHide":[true,true,false,false]}]},{"num":"8","pro":6,"next":8,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001326.jpg"}],"mouseActions":[{"x":292,"y":225,"w":339,"h":39,"layer":1,"strokeColor":"#ff0000","next":8,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"51b8aafb-1cad-4d55-8735-2979ad774ea2.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":3,"next":8,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000360.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":4,"next":6,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000361.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":607,"y":643,"startTime":0,"totalTime":2062,"img":"mouseRoute7.png"},{"x":461,"y":244,"totalTime":938}]}],"notes":[{"x":-10,"y":701,"layer":5,"startTime":0,"totalTime":-1,"img":"636616597112002747.png","showOrHide":[true,true,true,true]},{"x":456,"y":243,"layer":2,"startTime":200,"totalTime":-1,"img":"636616597113562747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616597113718747.png","showOrHide":[true,true,false,false]}]},{"num":"9","pro":7,"next":9,"bScore":true,"totalTime":1700,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000422.jpg"}],"mouseActions":[{"x":349,"y":291,"w":649,"h":193,"layer":1,"strokeColor":"#ff0000","next":9,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"eb133b03-a81e-4fe9-97b3-8b3ddfe4d4ec.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":2,"next":7,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000362.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":4,"next":9,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000363.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":461,"y":244,"startTime":0,"totalTime":1241,"img":"mouseRoute8.png"},{"x":673,"y":387,"totalTime":459}]}],"notes":[{"x":621,"y":69,"layer":5,"startTime":200,"totalTime":-1,"img":"636616597117280747.png","showOrHide":[true,true,false,false]},{"x":-10,"y":701,"layer":3,"startTime":0,"totalTime":-1,"img":"636616597117788747.png","showOrHide":[true,true,true,true]}]},{"num":"10","pro":8,"next":10,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000474.jpg"}],"mouseActions":[{"x":277,"y":348,"w":979,"h":384,"layer":0,"strokeColor":"#ff0000","next":10,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"fc174f1d-e436-482e-9efd-9b54f6d72ae7.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":10,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000364.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":8,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000365.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":673,"y":387,"startTime":0,"totalTime":869,"img":"mouseRoute9.png"},{"x":766,"y":540,"totalTime":2131}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616597121064747.png","showOrHide":[true,true,true,true]},{"x":839,"y":144,"layer":5,"startTime":300,"totalTime":-1,"img":"636616597121712747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616597121712748.png","showOrHide":[true,true,false,false]}]},{"num":"11","pro":9,"next":11,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000540.jpg"}],"mouseActions":[{"x":271,"y":0,"w":994,"h":562,"layer":0,"strokeColor":"#ff0000","next":11,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"06787297-4851-4c6c-8b0d-7d43f3115d00.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":11,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000366.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":9,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000367.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":766,"y":540,"startTime":0,"totalTime":1257,"img":"mouseRoute10.png"},{"x":768,"y":281,"totalTime":1743}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616597124988747.png","showOrHide":[true,true,true,true]},{"x":791,"y":180,"layer":5,"startTime":300,"totalTime":-1,"img":"636616597125612747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616597125612748.png","showOrHide":[true,true,false,false]}]},{"num":"12","pro":10,"next":12,"bScore":true,"totalTime":3000,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000952.jpg"}],"mouseActions":[{"x":271,"y":0,"w":994,"h":707,"layer":0,"strokeColor":"#ff0000","next":12,"startTime":0,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"f78d34b8-8bc5-4e92-bbd7-86cafd05568d.png"}],"buttons":[{"x":1238,"y":658,"w":99,"h":45,"layer":2,"next":12,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000368.png"},{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":10,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000369.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":768,"y":281,"startTime":0,"totalTime":349,"img":"mouseRoute11.png"},{"y":353,"totalTime":2651}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616597128022747.png","showOrHide":[true,true,true,true]},{"x":836,"y":161,"layer":5,"startTime":300,"totalTime":-1,"img":"636616597128686747.png","showOrHide":[true,true,false,false]},{"x":1151,"y":362,"layer":6,"startTime":1500,"totalTime":-1,"img":"636616597128696747.png","showOrHide":[true,true,false,false]}]},{"num":"13","pro":11,"next":13,"bScore":true,"totalTime":4300,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0000972.jpg"}],"mouseActions":[{"x":653,"y":572,"w":112,"h":47,"layer":2,"strokeColor":"#ff0000","next":13,"startTime":2800,"showOrHide":[true,true,true,true],"mouseActionName":"Left Click","ctrlKey":false,"shiftKey":false,"img":"a3b34141-e007-49c8-b330-55cdf197c398.png"}],"buttons":[{"x":1117,"y":658,"w":99,"h":45,"layer":3,"next":11,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000370.png"},{"x":1238,"y":658,"w":99,"h":45,"layer":5,"next":13,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000371.png"}],"mouseRoutes":[{"layer":10001,"mouseRoute":[{"iStepRoute":true,"sx":0,"sy":0,"sw":13,"sh":23,"x":768,"y":353,"startTime":0,"totalTime":1209,"img":"mouseRoute12.png"},{"x":709,"y":595,"totalTime":3091}]}],"notes":[{"x":-10,"y":701,"layer":4,"startTime":0,"totalTime":-1,"img":"636616597132636747.png","showOrHide":[true,true,true,true]},{"x":905,"y":24,"layer":8,"startTime":200,"totalTime":-1,"img":"636616597132948747.png","showOrHide":[true,true,false,false]},{"x":260,"y":-12,"layer":0,"startTime":200,"totalTime":-1,"img":"636616597132948748.png","showOrHide":[true,true,false,false]},{"x":145,"y":409,"layer":9,"startTime":2800,"totalTime":-1,"img":"636616597133416747.png","showOrHide":[true,true,false,false]},{"x":261,"y":48,"layer":6,"startTime":1200,"totalTime":-1,"img":"636616597133572747.png","showOrHide":[true,true,false,false]},{"x":813,"y":234,"layer":7,"startTime":1200,"totalTime":-1,"img":"636616597134040747.png","showOrHide":[true,true,false,false]}]},{"num":"14","pro":12,"next":-1,"bScore":false,"totalTime":1500,"imageBK":[{"x":0,"y":0,"w":1366,"h":768,"totalTime":0,"src":"i0001325.jpg"}],"buttons":[{"x":544,"y":557,"w":273,"h":87,"layer":1,"next":-1,"startTime":0,"showOrHide":[true,true,true,true],"img":"o0000372.png"}],"notes":[{"x":-18,"y":690,"layer":2,"startTime":0,"totalTime":-1,"img":"636616597136224747.png","showOrHide":[true,true,true,true]}]}]}';
var lesson_data = JSON.parse(json_data);