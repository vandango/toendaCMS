/*       _\|/_
         (o o)
+-----oOO-{_}-OOo--------------------------------------------------------+
| toendaCMS - Content Management and Weblogging System with XML and SQL  |
+------------------------------------------------------------------------+
| Copyright (c) Toenda Software Development                              |
| Author: Jonathan Naumann                                               |
+------------------------------------------------------------------------+
| 
| Anti Frame function
|
| File:		anti_frame.js
| Version:	0.0.1
|
+
*/


if(window.top != window)
	window.top.location = window.location;

