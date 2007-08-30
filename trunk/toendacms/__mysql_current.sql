-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 31. August 2007 um 00:28
-- Server Version: 5.0.33
-- PHP-Version: 5.2.1
-- 
-- Datenbank: `tcms_blog`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_albums`
-- 

CREATE TABLE `blog_albums` (
  `uid` varchar(12) NOT NULL default '',
  `title` varchar(255) default NULL,
  `album_id` varchar(6) NOT NULL default '',
  `published` int(1) NOT NULL default '0',
  `desc` text,
  `image` varchar(255) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_albums`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_comments`
-- 

CREATE TABLE `blog_comments` (
  `uid` varchar(10) NOT NULL default '',
  `module` varchar(5) NOT NULL default '',
  `timestamp` varchar(14) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) default NULL,
  `web` varchar(255) default NULL,
  `msg` text,
  `time` varchar(14) NOT NULL default '',
  `ip` varchar(15) default NULL,
  `domain` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_comments`
-- 

INSERT INTO `blog_comments` (`uid`, `module`, `timestamp`, `name`, `email`, `web`, `msg`, `time`, `ip`, `domain`) VALUES ('c4c846e167', 'news', '20051126005016', 'vandango', 'vandango@toenda.com', 'http://vandango.org', 'This is a test comment ...', '20051126005016', '127.0.0.1', 'localhost'),
('90ac2e39eb', 'news', '20070701170303', 'vandango', 'vandango@toenda.com', 'http://vandango.org', 'Ein Kommentar, hier sind &lt;strong&gt;fette&lt;/strong&gt; Texte, &lt;p&gt;neue Bl&ouml;cke&lt;/p&gt;&lt;br /&gt;\r\n&lt;br /&gt;Zeilenumbr&uuml;che&lt;br /&gt;&lt;br /&gt;\r\nund &lt;a href__________&quot;http://www.toendacms.com&quot; target__________&quot;_blank&quot;&gt;Links&lt;/a&gt; erlaubt.', '20070701170303', '127.0.0.1', 'vandango-PC');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_contactform`
-- 

CREATE TABLE `blog_contactform` (
  `uid` varchar(11) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `contact` varchar(255) NOT NULL default '',
  `show_contacts_in_sidebar` int(1) NOT NULL default '0',
  `send_id` varchar(11) NOT NULL default '',
  `contacttitle` varchar(255) NOT NULL default '',
  `contactstamp` varchar(255) NOT NULL default '',
  `contacttext` text NOT NULL,
  `access` varchar(10) NOT NULL default '',
  `enabled` int(1) default NULL,
  `use_adressbook` int(1) default NULL,
  `use_contact` int(1) default NULL,
  `show_contactemail` int(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_contactform`
-- 

INSERT INTO `blog_contactform` (`uid`, `language`, `contact`, `show_contacts_in_sidebar`, `send_id`, `contacttitle`, `contactstamp`, `contacttext`, `access`, `enabled`, `use_adressbook`, `use_contact`, `show_contactemail`) VALUES ('contactform', 'english_EN', 'info@toenda.com', 0, 'contactform', 'Contact Us and ...', '... send us a message.', 'my contacttext&lt;br /&gt;\r\n', 'Public', 1, 1, 1, 1),
('196716e11c5', 'germany_DE', 'info@toenda.com', 1, 'contactform', 'Kontaktformular', '', 'Und ein wenig Text ...\r\n', 'Public', 1, 1, 1, 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_contacts`
-- 

CREATE TABLE `blog_contacts` (
  `uid` varchar(10) NOT NULL default '',
  `default_con` int(1) NOT NULL default '0',
  `published` int(1) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `position` varchar(255) default NULL,
  `email` varchar(255) NOT NULL default '',
  `street` varchar(255) default NULL,
  `country` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `town` varchar(255) default NULL,
  `postal` int(8) default NULL,
  `phone` varchar(40) default NULL,
  `fax` varchar(40) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_contacts`
-- 

INSERT INTO `blog_contacts` (`uid`, `default_con`, `published`, `name`, `position`, `email`, `street`, `country`, `state`, `town`, `postal`, `phone`, `fax`) VALUES ('10a1b5f6ab', 1, 1, 'Max Musterman', 'CEO', 'max@musterman.com', 'Musterstrasse 123', 'Deutschland', '', 'Musterstadt', 8203, '', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_content`
-- 

CREATE TABLE `blog_content` (
  `uid` varchar(5) NOT NULL default '',
  `title` varchar(255) default NULL,
  `key` varchar(255) default NULL,
  `content00` text,
  `content01` text,
  `foot` varchar(255) default NULL,
  `db_layout` varchar(50) default NULL,
  `access` varchar(10) NOT NULL default '',
  `in_work` int(1) NOT NULL default '0',
  `published` int(1) NOT NULL default '0',
  `autor` varchar(255) default NULL,
  `language` varchar(25) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_content`
-- 

INSERT INTO `blog_content` (`uid`, `title`, `key`, `content00`, `content01`, `foot`, `db_layout`, `access`, `in_work`, `published`, `autor`, `language`) VALUES ('18e2a', 'License', 'toendaCMS &amp; GNU General Public License', '&lt;div align__________&quot;center&quot;&gt;&lt;strong&gt;GNU General Public License&lt;/strong&gt;&lt;/div&gt; &lt;div align__________&quot;center&quot;&gt;     &lt;em&gt;Version 2, June 1991&lt;/em&gt;     1989, 1991 Free Software Foundation, Inc. &lt;br /&gt;  Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA, 02111-1307, USA &lt;br /&gt;  Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed. &lt;br /&gt;  Version 2, June 1991&lt;/div&gt; &lt;br /&gt; &lt;h2&gt;GNU General Public License&lt;/h2&gt; &lt;br /&gt; &lt;p&gt;&lt;strong&gt;&lt;img src__________&quot;http://localhost/toendacms/data/images/Image/osi-certified-120x100.png&quot; border__________&quot;0&quot; alt__________&quot;&quot; hspace__________&quot;4&quot; width__________&quot;120&quot; height__________&quot;100&quot; align__________&quot;left&quot; /&gt;Preamble&lt;/strong&gt; The licenses for most software are designed to take away your freedom to share and change it. By contrast, the GNU General Public License is intended to guarantee your freedom to share and changefree software - to make sure the software is free for all its users. This General Public License applies to most of the Free Software Foundation&amp;#39;s software and to any other program whose authors commit to using it. (Some other Free Software Foundation software is covered by the GNU Library General Public License instead.) You can apply it to your programs, too. &lt;br /&gt;  &lt;br /&gt;  When we speak of free software, we are referring to freedom, not price. Our General Public Licenses are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things. &lt;br /&gt;  &lt;br /&gt;  To protect your rights, we need to make restrictions that forbid anyone to deny you these rights or to ask you to surrender the rights. These restrictions translate to certain responsibilities for you if you distribute copies of the software, or if you modify it. &lt;br /&gt;  &lt;br /&gt;  For example, if you distribute copies of such a program, whether gratis or for a fee, you must give the recipients all the rights that you have. You must make sure that they, too, receive or can get the source code. And you must show them these terms so they know their rights. &lt;br /&gt;  &lt;br /&gt;  We protect your rights with two steps: &lt;br /&gt;  &lt;/p&gt; &lt;ul&gt;     &lt;li&gt;copyright the software, and&lt;/li&gt;     &lt;li&gt;offer you this license which gives you legal permission to copy, distribute and/or modify the software.&lt;/li&gt; &lt;/ul&gt; Also, for each author&amp;#39;s protection and ours, we want to make certain that everyone understands that there is no warranty for this free software. If the software is modified by someone else and passed on, we want its recipients to know that what they have is not the original, so that any problems introduced by others will not reflect on the original authors&amp;#39; reputations. &lt;br /&gt;  &lt;br /&gt;  Finally, any free program is threatened constantly by software patents. We wish to avoid the danger that redistributors of a free program will individually obtain patent licenses, in effect making the program proprietary. To prevent this, we have made it clear that any patent must be licensed for everyone&amp;#39;s free use or not licensed at all. &lt;br /&gt;  &lt;br /&gt;  The precise terms and conditions for copying, distribution and modification follow.  {tcms_more}&lt;br /&gt;  &lt;strong&gt;TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION&lt;/strong&gt;    &lt;strong&gt;Section 0&lt;/strong&gt; This License applies to any program or other work which contains a notice placed by the copyright holder saying it may be distributed under the terms of this General Public License. The &quot;Program&quot;, below, refers to any such program or work, and a work based on the Program means either the Program or any derivative work under copyright law: that is to say, a work containing the Program or a portion of it, either verbatim or with modifications and/or translated into another language. (Hereinafter, translation is included without limitation in the term modification .) Each licensee is addressed as you. &lt;br /&gt;  &lt;br /&gt;  Activities other than copying, distribution and modification are not covered by this License; they are outside its scope. The act of running the Program is not restricted, and the output from the Program is covered only if its contents constitute a work based on the Program (independent of having been made by running the Program). Whether that is true depends on what the Program does. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 1&lt;/strong&gt; You may copy and distribute verbatim copies of the Program&amp;#39;s source code as you receive it, in any medium, provided that you conspicuously and appropriately publish on each copy an appropriate copyright notice and disclaimer of warranty; keep intact all the notices that refer to this License and to the absence of any warranty; and give any other recipients of the Program a copy of this License along with the Program. &lt;br /&gt;  &lt;br /&gt;  You may charge a fee for the physical act of transferring a copy, and you may at your option offer warranty protection in exchange for a fee. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 2&lt;/strong&gt; You may modify your copy or copies of the Program or any portion of it, thus forming a work based on the Program, and copy and distribute such modifications or work under the terms of Section 1 above, provided that you also meet all of these conditions: &lt;br /&gt;  &lt;br /&gt;  You must cause the modified files to carry prominent notices stating that you changed the files and the date of any change. &lt;br /&gt;  &lt;br /&gt;  You must cause any work that you distribute or publish, that in whole or in part contains or is derived from the Program or any part thereof, to be licensed as a whole at no charge to all third parties under the terms of this License. &lt;br /&gt;  &lt;br /&gt;  If the modified program normally reads commands interactively when run, you must cause it, when started running for such interactive use in the most ordinary way, to print or display an announcement including an appropriate copyright notice and a notice that there is no warranty (or else, saying that you provide a warranty) and that users may redistribute the program under these conditions, and telling the user how to view a copy of this License. &lt;br /&gt;  &lt;br /&gt;  Exception: &lt;br /&gt;  &lt;br /&gt;  If the Program itself is interactive but does not normally print such an announcement, your work based on the Program is not required to print an announcement.) &lt;br /&gt;  &lt;br /&gt;  These requirements apply to the modified work as a whole. If identifiable sections of that work are not derived from the Program, and can be reasonably considered independent and separate works in themselves, then this License, and its terms, do not apply to those sections when you distribute them as separate works. But when you distribute the same sections as part of a whole which is a work based on the Program, the distribution of the whole must be on the terms of this License, whose permissions for other licensees extend to the entire whole, and thus to each and every part regardless of who wrote it. &lt;br /&gt;  &lt;br /&gt;  Thus, it is not the intent of this section to claim rights or contest your rights to work written entirely by you; rather, the intent is to exercise the right to control the distribution of derivative or collective works based on the Program. &lt;br /&gt;  &lt;br /&gt;  In addition, mere aggregation of another work not based on the Program with the Program (or with a work based on the Program) on a volume of a storage or distribution medium does not bring the other work under the scope of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 3&lt;/strong&gt; You may copy and distribute the Program (or a work based on it, under Section 2 in object code or executable form under the terms of Sections 1 and 2 above provided that you also do one of the following: &lt;br /&gt;  &lt;br /&gt;  Accompany it with the complete corresponding machine-readable source code, which must be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or, &lt;br /&gt;  &lt;br /&gt;  Accompany it with a written offer, valid for at least three years, to give any third party, for a charge no more than your cost of physically performing source distribution, a complete machine-readable copy of the corresponding source code, to be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or, &lt;br /&gt;  &lt;br /&gt;  Accompany it with the information you received as to the offer to distribute corresponding source code. (This alternative is allowed only for noncommercial distribution and only if you received the program in object code or executable form with such an offer, in accord with Subsection b above.) &lt;br /&gt;  &lt;br /&gt;  The source code for a work means the preferred form of the work for making modifications to it. For an executable work, complete source code means all the source code for all modules it contains, plus any associated interface definition files, plus the scripts used to control compilation and installation of the executable. However, as a special exception, the source code distributed need not include anything that is normally distributed (in either source or binary form) with the major components (compiler, kernel, and so on) of the operating system on which the executable runs, unless that component itself accompanies the executable. &lt;br /&gt;  &lt;br /&gt;  If distribution of executable or object code is made by offering access to copy from a designated place, then offering equivalent access to copy the source code from the same place counts as distribution of the source code, even though third parties are not compelled to copy the source along with the object code. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 4&lt;/strong&gt; You may not copy, modify, sublicense, or distribute the Program except as expressly provided under this License. Any attempt otherwise to copy, modify, sublicense or distribute the Program is void, and will automatically terminate your rights under this License. However, parties who have received copies, or rights, from you under this License will not have their licenses terminated so long as such parties remain in full compliance. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 5&lt;/strong&gt; You are not required to accept this License, since you have not signed it. However, nothing else grants you permission to modify or distribute the Program or its derivative works. These actions are prohibited by law if you do not accept this License. Therefore, by modifying or distributing the Program (or any work based on the Program), you indicate your acceptance of this License to do so, and all its terms and conditions for copying, distributing or modifying the Program or works based on it. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 6&lt;/strong&gt; Each time you redistribute the Program (or any work based on the Program), the recipient automatically receives a license from the original licensor to copy, distribute or modify the Program subject to these terms and conditions. You may not impose any further restrictions on the recipients&amp;#39; exercise of the rights granted herein. You are not responsible for enforcing compliance by third parties to this License. &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;Section 7&lt;/strong&gt; If, as a consequence of a court judgment or allegation of patent infringement or for any other reason (not limited to patent issues), conditions are imposed on you (whether by court order, agreement or otherwise) that contradict the conditions of this License, they do not excuse you from the conditions of this License. If you cannot distribute so as to satisfy simultaneously your obligations under this License and any other pertinent obligations, then as a consequence you may not distribute the Program at all. For example, if a patent license would not permit royalty-free redistribution of the Program by all those who receive copies directly or indirectly through you, then the only way you could satisfy both it and this License would be to refrain entirely from distribution of the Program. If any portion of this section is held invalid or unenforceable under any particular circumstance, the balance of the section is intended to apply and the section as a whole is intended to apply in other circumstances. It is not the purpose of this section to induce you to infringe any patents or other property right claims or to contest validity of any such claims; this section has the sole purpose of protecting the integrity of the free software distribution system, which is implemented by public license practices. Many people have made generous contributions to the wide range of software distributed through that system in reliance on consistent application of that system; it is up to the author/donor to decide if he or she is willing to distribute software through any other system and a licensee cannot impose that choice. This section is intended to make thoroughly clear what is believed to be a consequence of the rest of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 8&lt;/strong&gt; If the distribution and/or use of the Program is restricted in certain countries either by patents or by copyrighted interfaces, the original copyright holder who places the Program under this License may add an explicit geographical distribution limitation excluding those countries, so that distribution is permitted only in or among countries not thus excluded. In such case, this License incorporates the limitation as if written in the body of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 9&lt;/strong&gt; The Free Software Foundation may publish revised and/or new versions of the General Public License from time to time. Such new versions will be similar in spirit to the present version, but may differ in detail to address new problems or concerns. Each version is given a distinguishing version number. If the Program specifies a version number of this License which applies to it and &quot;any later version&quot;, you have the option of following the terms and conditions either of that version or of any later version published by the Free Software Foundation. If the Program does not specify a version number of this License, you may choose any version ever published by the Free Software Foundation. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 10&lt;/strong&gt; If you wish to incorporate parts of the Program into other free programs whose distribution conditions are different, write to the author to ask for permission. For software which is copyrighted by the Free Software Foundation, write to the Free Software Foundation; we sometimes make exceptions for this. Our decision will be guided by the two goals of preserving the free status of all derivatives of our free software and of promoting the sharing and reuse of software generally. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;NO WARRANTY Section 11&lt;/strong&gt; BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &quot;AS IS&quot; WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 12&lt;/strong&gt; IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. &lt;br /&gt;  &lt;br /&gt;  END OF TERMS AND CONDITIONS &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;How to Apply These Terms to Your New Programs&lt;/strong&gt; If you develop a new program, and you want it to be of the greatest possible use to the public, the best way to achieve this is to make it free software which everyone can redistribute and change under these terms. &lt;br /&gt;  &lt;br /&gt;  To do so, attach the following notices to the program. It is safest to attach them to the start of each source file to most effectively convey the exclusion of warranty; and each file should have at least the &quot;copyright&quot; line and a pointer to where the full notice is found. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;toendaCMS - XML Content Management and Weblogging System&lt;/strong&gt;    toendaCMS is a professionall web based Content Management and Weblogging System with a XML or SQL Database. &lt;br /&gt;  &lt;strong&gt;Copyright (C) 2003 - 2005 Jonathan Naumann &lt;em&gt;Toenda Software Development&lt;/em&gt;&lt;/strong&gt; This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. &lt;br /&gt;  &lt;br /&gt;  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. &lt;br /&gt;  &lt;br /&gt;  You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA &lt;br /&gt;  &lt;br /&gt;  Also add information on how to contact you by electronic and paper mail. &lt;br /&gt;  &lt;br /&gt;  If the program is interactive, make it output a short notice like this when it starts in an interactive mode: &lt;br /&gt;  &lt;br /&gt;  Gnomovision version 69, Copyright (C) year name of author Gnomovision comes with ABSOLUTELY NO WARRANTY; for details type `show w&amp;#39;. This is free software, and you are welcome to redistribute it under certain conditions; type `show c&amp;#39; for details. &lt;br /&gt;  &lt;br /&gt;  The hypothetical commands `show w&amp;#39; and `show c&amp;#39; should show the appropriate parts of the General Public License. Of course, the commands you use may be called something other than `show w&amp;#39; and `show c&amp;#39;; they could even be mouse-clicks or menu items--whatever suits your program. &lt;br /&gt;  &lt;br /&gt;  You should also get your employer (if you work as a programmer) or your school, if any, to sign a &quot;copyright disclaimer&quot; for the program, if necessary. Here is a sample; alter the names: &lt;br /&gt;  &lt;br /&gt;  Yoyodyne, Inc., hereby disclaims all copyright interest in the program `Gnomovision&amp;#39; (which makes passes at compilers) written by James Hacker. &lt;br /&gt;  &lt;br /&gt;  (signature of Ty Coon), 1 April 1989 Ty Coon, President of Vice &lt;br /&gt;  &lt;br /&gt;  This General Public License does not permit incorporating your program into proprietary programs. If your program is a subroutine library, you may consider it more useful to permit linking proprietary applications with the library. If this is what you want to do, use the GNU Library General Public License instead of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Toenda Software Development&lt;/strong&gt;', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'english_EN'),
('66115', 'sub1', 'test text in english', 'test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in englishtest text in englishtest text in english test text in english&lt;br /&gt;\r\n', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'english_EN'),
('3ce0c', 'Test', '', '{php:}echo &quot;hallo php&quot;;{:php}\r\n', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'germany_DE');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_content_languages`
-- 

CREATE TABLE `blog_content_languages` (
  `uid` varchar(5) collate utf8_unicode_ci NOT NULL,
  `content_uid` varchar(5) collate utf8_unicode_ci NOT NULL,
  `language` varchar(25) collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `key` varchar(255) collate utf8_unicode_ci default NULL,
  `content00` text collate utf8_unicode_ci,
  `content01` text collate utf8_unicode_ci,
  `foot` varchar(255) collate utf8_unicode_ci default NULL,
  `autor` varchar(255) collate utf8_unicode_ci default NULL,
  `db_layout` varchar(50) collate utf8_unicode_ci NOT NULL,
  `access` varchar(10) collate utf8_unicode_ci NOT NULL,
  `in_work` int(11) NOT NULL default '0',
  `published` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Daten für Tabelle `blog_content_languages`
-- 

INSERT INTO `blog_content_languages` (`uid`, `content_uid`, `language`, `title`, `key`, `content00`, `content01`, `foot`, `autor`, `db_layout`, `access`, `in_work`, `published`) VALUES ('fdgd7', '18e2a', 'germany_DE', 'Die toendaCMS Lizenz', 'GNU General Public License', '&lt;div align__________&quot;center&quot;&gt;\r\n&lt;strong&gt;GNU General Public License&lt;/strong&gt;\r\n&lt;/div&gt;\r\n&lt;div align__________&quot;center&quot;&gt;\r\n&lt;em&gt;Version 2, June 1991&lt;/em&gt;     1989, 1991 Free Software Foundation, Inc. &lt;br /&gt;\r\nFree Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA, 02111-1307, USA &lt;br /&gt;\r\nEveryone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed. &lt;br /&gt;\r\nVersion 2, June 1991\r\n&lt;/div&gt;\r\n&lt;br /&gt;\r\n&lt;h2&gt;GNU General Public License&lt;/h2&gt; &lt;br /&gt;\r\n&lt;p&gt;\r\n&lt;a href__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/osi-certified-120x100.png&quot; rel__________&quot;lightbox&quot;&gt;&lt;img align__________&quot;left&quot; alt__________&quot;osi-certified-120x100.png&quot; src__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/osi-certified-120x100.png&quot; title__________&quot;osi-certified-120x100.png&quot; /&gt;&lt;/a&gt;&lt;strong&gt;Preamble&lt;/strong&gt;\r\nThe licenses for most software are designed to take away your freedom\r\nto share and change it. By contrast, the GNU General Public License is\r\nintended to guarantee your freedom to share and changefree software -\r\nto make sure the software is free for all its users. This General\r\nPublic License applies to most of the Free Software Foundation&amp;#39;s\r\nsoftware and to any other program whose authors commit to using it.\r\n(Some other Free Software Foundation software is covered by the GNU\r\nLibrary General Public License instead.) You can apply it to your\r\nprograms, too. &lt;br /&gt;\r\n&lt;br /&gt;\r\nWhen we speak of free software, we are\r\nreferring to freedom, not price. Our General Public Licenses are\r\ndesigned to make sure that you have the freedom to distribute copies of\r\nfree software (and charge for this service if you wish), that you\r\nreceive source code or can get it if you want it, that you can change\r\nthe software or use pieces of it in new free programs; and that you\r\nknow you can do these things. &lt;br /&gt;\r\n&lt;br /&gt;\r\nTo protect your rights, we\r\nneed to make restrictions that forbid anyone to deny you these rights\r\nor to ask you to surrender the rights. These restrictions translate to\r\ncertain responsibilities for you if you distribute copies of the\r\nsoftware, or if you modify it. &lt;br /&gt;\r\n&lt;br /&gt;\r\nFor example, if you\r\ndistribute copies of such a program, whether gratis or for a fee, you\r\nmust give the recipients all the rights that you have. You must make\r\nsure that they, too, receive or can get the source code. And you must\r\nshow them these terms so they know their rights. &lt;br /&gt;\r\n&lt;br /&gt;\r\nWe protect your rights with two steps: &lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;ul&gt;\r\n	&lt;li&gt;copyright the software, and&lt;/li&gt;\r\n	&lt;li&gt;offer you this license which gives you legal permission to copy, distribute and/or modify the software.&lt;/li&gt;\r\n&lt;/ul&gt;\r\nAlso, for each author&amp;#39;s protection and ours, we want to make certain\r\nthat everyone understands that there is no warranty for this free\r\nsoftware. If the software is modified by someone else and passed on, we\r\nwant its recipients to know that what they have is not the original, so\r\nthat any problems introduced by others will not reflect on the original\r\nauthors&amp;#39; reputations. &lt;br /&gt;\r\n&lt;br /&gt;\r\nFinally, any free program is\r\nthreatened constantly by software patents. We wish to avoid the danger\r\nthat redistributors of a free program will individually obtain patent\r\nlicenses, in effect making the program proprietary. To prevent this, we\r\nhave made it clear that any patent must be licensed for everyone&amp;#39;s free\r\nuse or not licensed at all. &lt;br /&gt;\r\n&lt;br /&gt;\r\nThe precise terms and conditions for copying, distribution and modification follow.  {tcms_more}&lt;br /&gt;\r\n&lt;strong&gt;TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION&lt;/strong&gt;    &lt;strong&gt;Section 0&lt;/strong&gt;\r\nThis License applies to any program or other work which contains a\r\nnotice placed by the copyright holder saying it may be distributed\r\nunder the terms of this General Public License. The &quot;Program&quot;, below,\r\nrefers to any such program or work, and a work based on the Program\r\nmeans either the Program or any derivative work under copyright law:\r\nthat is to say, a work containing the Program or a portion of it,\r\neither verbatim or with modifications and/or translated into another\r\nlanguage. (Hereinafter, translation is included without limitation in\r\nthe term modification .) Each licensee is addressed as you. &lt;br /&gt;\r\n&lt;br /&gt;\r\nActivities other than copying, distribution and modification are not\r\ncovered by this License; they are outside its scope. The act of running\r\nthe Program is not restricted, and the output from the Program is\r\ncovered only if its contents constitute a work based on the Program\r\n(independent of having been made by running the Program). Whether that\r\nis true depends on what the Program does. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 1&lt;/strong&gt;\r\nYou may copy and distribute verbatim copies of the Program&amp;#39;s source\r\ncode as you receive it, in any medium, provided that you conspicuously\r\nand appropriately publish on each copy an appropriate copyright notice\r\nand disclaimer of warranty; keep intact all the notices that refer to\r\nthis License and to the absence of any warranty; and give any other\r\nrecipients of the Program a copy of this License along with the\r\nProgram. &lt;br /&gt;\r\n&lt;br /&gt;\r\nYou may charge a fee for the physical act of\r\ntransferring a copy, and you may at your option offer warranty\r\nprotection in exchange for a fee. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 2&lt;/strong&gt; You may\r\nmodify your copy or copies of the Program or any portion of it, thus\r\nforming a work based on the Program, and copy and distribute such\r\nmodifications or work under the terms of Section 1 above, provided that\r\nyou also meet all of these conditions: &lt;br /&gt;\r\n&lt;br /&gt;\r\nYou must cause the modified files to carry prominent notices stating that you changed the files and the date of any change. &lt;br /&gt;\r\n&lt;br /&gt;\r\nYou must cause any work that you distribute or publish, that in whole\r\nor in part contains or is derived from the Program or any part thereof,\r\nto be licensed as a whole at no charge to all third parties under the\r\nterms of this License. &lt;br /&gt;\r\n&lt;br /&gt;\r\nIf the modified program normally\r\nreads commands interactively when run, you must cause it, when started\r\nrunning for such interactive use in the most ordinary way, to print or\r\ndisplay an announcement including an appropriate copyright notice and a\r\nnotice that there is no warranty (or else, saying that you provide a\r\nwarranty) and that users may redistribute the program under these\r\nconditions, and telling the user how to view a copy of this License. &lt;br /&gt;\r\n&lt;br /&gt;\r\nException: &lt;br /&gt;\r\n&lt;br /&gt;\r\nIf the Program itself is interactive but does not normally print such\r\nan announcement, your work based on the Program is not required to\r\nprint an announcement.) &lt;br /&gt;\r\n&lt;br /&gt;\r\nThese requirements apply to the\r\nmodified work as a whole. If identifiable sections of that work are not\r\nderived from the Program, and can be reasonably considered independent\r\nand separate works in themselves, then this License, and its terms, do\r\nnot apply to those sections when you distribute them as separate works.\r\nBut when you distribute the same sections as part of a whole which is a\r\nwork based on the Program, the distribution of the whole must be on the\r\nterms of this License, whose permissions for other licensees extend to\r\nthe entire whole, and thus to each and every part regardless of who\r\nwrote it. &lt;br /&gt;\r\n&lt;br /&gt;\r\nThus, it is not the intent of this section to\r\nclaim rights or contest your rights to work written entirely by you;\r\nrather, the intent is to exercise the right to control the distribution\r\nof derivative or collective works based on the Program. &lt;br /&gt;\r\n&lt;br /&gt;\r\nIn\r\naddition, mere aggregation of another work not based on the Program\r\nwith the Program (or with a work based on the Program) on a volume of a\r\nstorage or distribution medium does not bring the other work under the\r\nscope of this License. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 3&lt;/strong&gt; You may copy and\r\ndistribute the Program (or a work based on it, under Section 2 in\r\nobject code or executable form under the terms of Sections 1 and 2\r\nabove provided that you also do one of the following: &lt;br /&gt;\r\n&lt;br /&gt;\r\nAccompany it with the complete corresponding machine-readable source\r\ncode, which must be distributed under the terms of Sections 1 and 2\r\nabove on a medium customarily used for software interchange; or, &lt;br /&gt;\r\n&lt;br /&gt;\r\nAccompany it with a written offer, valid for at least three years, to\r\ngive any third party, for a charge no more than your cost of physically\r\nperforming source distribution, a complete machine-readable copy of the\r\ncorresponding source code, to be distributed under the terms of\r\nSections 1 and 2 above on a medium customarily used for software\r\ninterchange; or, &lt;br /&gt;\r\n&lt;br /&gt;\r\nAccompany it with the information you\r\nreceived as to the offer to distribute corresponding source code. (This\r\nalternative is allowed only for noncommercial distribution and only if\r\nyou received the program in object code or executable form with such an\r\noffer, in accord with Subsection b above.) &lt;br /&gt;\r\n&lt;br /&gt;\r\nThe source code\r\nfor a work means the preferred form of the work for making\r\nmodifications to it. For an executable work, complete source code means\r\nall the source code for all modules it contains, plus any associated\r\ninterface definition files, plus the scripts used to control\r\ncompilation and installation of the executable. However, as a special\r\nexception, the source code distributed need not include anything that\r\nis normally distributed (in either source or binary form) with the\r\nmajor components (compiler, kernel, and so on) of the operating system\r\non which the executable runs, unless that component itself accompanies\r\nthe executable. &lt;br /&gt;\r\n&lt;br /&gt;\r\nIf distribution of executable or object\r\ncode is made by offering access to copy from a designated place, then\r\noffering equivalent access to copy the source code from the same place\r\ncounts as distribution of the source code, even though third parties\r\nare not compelled to copy the source along with the object code. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 4&lt;/strong&gt;\r\nYou may not copy, modify, sublicense, or distribute the Program except\r\nas expressly provided under this License. Any attempt otherwise to\r\ncopy, modify, sublicense or distribute the Program is void, and will\r\nautomatically terminate your rights under this License. However,\r\nparties who have received copies, or rights, from you under this\r\nLicense will not have their licenses terminated so long as such parties\r\nremain in full compliance. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 5&lt;/strong&gt; You are not\r\nrequired to accept this License, since you have not signed it. However,\r\nnothing else grants you permission to modify or distribute the Program\r\nor its derivative works. These actions are prohibited by law if you do\r\nnot accept this License. Therefore, by modifying or distributing the\r\nProgram (or any work based on the Program), you indicate your\r\nacceptance of this License to do so, and all its terms and conditions\r\nfor copying, distributing or modifying the Program or works based on\r\nit. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 6&lt;/strong&gt; Each time you redistribute the\r\nProgram (or any work based on the Program), the recipient automatically\r\nreceives a license from the original licensor to copy, distribute or\r\nmodify the Program subject to these terms and conditions. You may not\r\nimpose any further restrictions on the recipients&amp;#39; exercise of the\r\nrights granted herein. You are not responsible for enforcing compliance\r\nby third parties to this License. &lt;br /&gt;\r\n{tcms_more}&lt;br /&gt;\r\n&lt;strong&gt;Section 7&lt;/strong&gt;\r\nIf, as a consequence of a court judgment or allegation of patent\r\ninfringement or for any other reason (not limited to patent issues),\r\nconditions are imposed on you (whether by court order, agreement or\r\notherwise) that contradict the conditions of this License, they do not\r\nexcuse you from the conditions of this License. If you cannot\r\ndistribute so as to satisfy simultaneously your obligations under this\r\nLicense and any other pertinent obligations, then as a consequence you\r\nmay not distribute the Program at all. For example, if a patent license\r\nwould not permit royalty-free redistribution of the Program by all\r\nthose who receive copies directly or indirectly through you, then the\r\nonly way you could satisfy both it and this License would be to refrain\r\nentirely from distribution of the Program. If any portion of this\r\nsection is held invalid or unenforceable under any particular\r\ncircumstance, the balance of the section is intended to apply and the\r\nsection as a whole is intended to apply in other circumstances. It is\r\nnot the purpose of this section to induce you to infringe any patents\r\nor other property right claims or to contest validity of any such\r\nclaims; this section has the sole purpose of protecting the integrity\r\nof the free software distribution system, which is implemented by\r\npublic license practices. Many people have made generous contributions\r\nto the wide range of software distributed through that system in\r\nreliance on consistent application of that system; it is up to the\r\nauthor/donor to decide if he or she is willing to distribute software\r\nthrough any other system and a licensee cannot impose that choice. This\r\nsection is intended to make thoroughly clear what is believed to be a\r\nconsequence of the rest of this License. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 8&lt;/strong&gt;\r\nIf the distribution and/or use of the Program is restricted in certain\r\ncountries either by patents or by copyrighted interfaces, the original\r\ncopyright holder who places the Program under this License may add an\r\nexplicit geographical distribution limitation excluding those\r\ncountries, so that distribution is permitted only in or among countries\r\nnot thus excluded. In such case, this License incorporates the\r\nlimitation as if written in the body of this License. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 9&lt;/strong&gt;\r\nThe Free Software Foundation may publish revised and/or new versions of\r\nthe General Public License from time to time. Such new versions will be\r\nsimilar in spirit to the present version, but may differ in detail to\r\naddress new problems or concerns. Each version is given a\r\ndistinguishing version number. If the Program specifies a version\r\nnumber of this License which applies to it and &quot;any later version&quot;, you\r\nhave the option of following the terms and conditions either of that\r\nversion or of any later version published by the Free Software\r\nFoundation. If the Program does not specify a version number of this\r\nLicense, you may choose any version ever published by the Free Software\r\nFoundation. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 10&lt;/strong&gt; If you wish to incorporate\r\nparts of the Program into other free programs whose distribution\r\nconditions are different, write to the author to ask for permission.\r\nFor software which is copyrighted by the Free Software Foundation,\r\nwrite to the Free Software Foundation; we sometimes make exceptions for\r\nthis. Our decision will be guided by the two goals of preserving the\r\nfree status of all derivatives of our free software and of promoting\r\nthe sharing and reuse of software generally. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;NO WARRANTY Section 11&lt;/strong&gt;\r\nBECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY\r\nFOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN\r\nOTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES\r\nPROVIDE THE PROGRAM &quot;AS IS&quot; WITHOUT WARRANTY OF ANY KIND, EITHER\r\nEXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED\r\nWARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE\r\nENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH\r\nYOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL\r\nNECESSARY SERVICING, REPAIR OR CORRECTION. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Section 12&lt;/strong&gt;\r\nIN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING\r\nWILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR\r\nREDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR\r\nDAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL\r\nDAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM\r\n(INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED\r\nINACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF\r\nTHE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR\r\nOTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. &lt;br /&gt;\r\n&lt;br /&gt;\r\nEND OF TERMS AND CONDITIONS &lt;br /&gt;\r\n{tcms_more}&lt;br /&gt;\r\n&lt;strong&gt;How to Apply These Terms to Your New Programs&lt;/strong&gt;\r\nIf you develop a new program, and you want it to be of the greatest\r\npossible use to the public, the best way to achieve this is to make it\r\nfree software which everyone can redistribute and change under these\r\nterms. &lt;br /&gt;\r\n&lt;br /&gt;\r\nTo do so, attach the following notices to the\r\nprogram. It is safest to attach them to the start of each source file\r\nto most effectively convey the exclusion of warranty; and each file\r\nshould have at least the &quot;copyright&quot; line and a pointer to where the\r\nfull notice is found. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;toendaCMS - XML Content Management and Weblogging System&lt;/strong&gt;    toendaCMS is a professionall web based Content Management and Weblogging System with a XML or SQL Database. &lt;br /&gt;\r\n&lt;strong&gt;Copyright (C) 2003 - 2005 Jonathan Naumann &lt;em&gt;Toenda Software Development&lt;/em&gt;&lt;/strong&gt;\r\nThis program is free software; you can redistribute it and/or modify it\r\nunder the terms of the GNU General Public License as published by the\r\nFree Software Foundation; either version 2 of the License, or (at your\r\noption) any later version. &lt;br /&gt;\r\n&lt;br /&gt;\r\nThis program is distributed in\r\nthe hope that it will be useful, but WITHOUT ANY WARRANTY; without even\r\nthe implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR\r\nPURPOSE. See the GNU General Public License for more details. &lt;br /&gt;\r\n&lt;br /&gt;\r\nYou should have received a copy of the GNU General Public License along\r\nwith this program; if not, write to the Free Software Foundation, Inc.,\r\n59 Temple Place, Suite 330, Boston, MA 02111-1307 USA &lt;br /&gt;\r\n&lt;br /&gt;\r\nAlso add information on how to contact you by electronic and paper mail. &lt;br /&gt;\r\n&lt;br /&gt;\r\nIf the program is interactive, make it output a short notice like this when it starts in an interactive mode: &lt;br /&gt;\r\n&lt;br /&gt;\r\nGnomovision version 69, Copyright (C) year name of author Gnomovision\r\ncomes with ABSOLUTELY NO WARRANTY; for details type `show w&amp;#39;. This is\r\nfree software, and you are welcome to redistribute it under certain\r\nconditions; type `show c&amp;#39; for details. &lt;br /&gt;\r\n&lt;br /&gt;\r\nThe hypothetical\r\ncommands `show w&amp;#39; and `show c&amp;#39; should show the appropriate parts of the\r\nGeneral Public License. Of course, the commands you use may be called\r\nsomething other than `show w&amp;#39; and `show c&amp;#39;; they could even be\r\nmouse-clicks or menu items--whatever suits your program. &lt;br /&gt;\r\n&lt;br /&gt;\r\nYou should also get your employer (if you work as a programmer) or your\r\nschool, if any, to sign a &quot;copyright disclaimer&quot; for the program, if\r\nnecessary. Here is a sample; alter the names: &lt;br /&gt;\r\n&lt;br /&gt;\r\nYoyodyne,\r\nInc., hereby disclaims all copyright interest in the program\r\n`Gnomovision&amp;#39; (which makes passes at compilers) written by James\r\nHacker. &lt;br /&gt;\r\n&lt;br /&gt;\r\n(signature of Ty Coon), 1 April 1989 Ty Coon, President of Vice &lt;br /&gt;\r\n&lt;br /&gt;\r\nThis General Public License does not permit incorporating your program\r\ninto proprietary programs. If your program is a subroutine library, you\r\nmay consider it more useful to permit linking proprietary applications\r\nwith the library. If this is what you want to do, use the GNU Library\r\nGeneral Public License instead of this License. &lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;strong&gt;Toenda Software Development&lt;/strong&gt;\r\n', '', '', 'root', 'db_content_default.php', 'Public', 1, 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_downloads`
-- 

CREATE TABLE `blog_downloads` (
  `uid` varchar(10) NOT NULL default '',
  `name` varchar(255) default NULL,
  `date` varchar(16) NOT NULL default '',
  `desc` text,
  `type` varchar(255) NOT NULL default '',
  `sort` int(1) default NULL,
  `pub` int(1) default NULL,
  `access` varchar(10) default NULL,
  `image` varchar(255) default NULL,
  `file` varchar(255) default NULL,
  `cat` varchar(10) default NULL,
  `parent` varchar(10) default NULL,
  `sql_type` char(1) NOT NULL default '',
  `mirror` int(1) default NULL,
  PRIMARY KEY  (`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_downloads`
-- 

INSERT INTO `blog_downloads` (`uid`, `name`, `date`, `desc`, `type`, `sort`, `pub`, `access`, `image`, `file`, `cat`, `parent`, `sql_type`, `mirror`) VALUES ('05cb9c17d8', 'dsf', '02.08.2007-19:34', 'sdfsdf', 'zip', 1, 1, 'Public', '_mimetypes_', 'http://static.toenda.com/templates/pushbutton.zip', NULL, NULL, 'f', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_downloads_config`
-- 

CREATE TABLE `blog_downloads_config` (
  `uid` varchar(8) NOT NULL default '',
  `download_id` varchar(8) NOT NULL default '',
  `download_title` varchar(255) default NULL,
  `download_stamp` varchar(255) default NULL,
  `download_text` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_downloads_config`
-- 

INSERT INTO `blog_downloads_config` (`uid`, `download_id`, `download_title`, `download_stamp`, `download_text`) VALUES ('download', 'download', 'Downloads and Software', 'Toenda Software Downloads', 'Our software downloads.');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_frontpage`
-- 

CREATE TABLE `blog_frontpage` (
  `uid` varchar(9) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `front_id` varchar(9) NOT NULL default '',
  `front_title` varchar(255) default NULL,
  `front_stamp` varchar(255) default NULL,
  `front_text` text,
  `news_title` varchar(255) default NULL,
  `news_cut` int(5) NOT NULL default '0',
  `module_use_0` int(2) NOT NULL default '0',
  `sb_news_title` varchar(255) default NULL,
  `sb_news_amount` int(2) default NULL,
  `sb_news_chars` int(5) default NULL,
  `sb_news_enabled` int(1) NOT NULL default '0',
  `sb_news_display` int(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_frontpage`
-- 

INSERT INTO `blog_frontpage` (`uid`, `language`, `front_id`, `front_title`, `front_stamp`, `front_text`, `news_title`, `news_cut`, `module_use_0`, `sb_news_title`, `sb_news_amount`, `sb_news_chars`, `sb_news_enabled`, `sb_news_display`) VALUES ('24k58ilp6', 'english_EN', 'frontpage', 'Welcome to the Home of toendaCMS', 'Open Source Content Management Framework', 'Welcome to the Samplesite of the free Open Source Content Management Framework toendaCMS.&lt;br /&gt;\r\nIt is for enterprise purposes and/or private uses on the web. It offers\r\nfull flexibility and extendability while featuring an accomplished set\r\nof ready-made interfaces, function&amp;#39;s and modules.\r\n', 'News', 0, 5, 'Latest News', 5, 100, 0, 3),
('4frtgh587', 'germany_DE', 'frontpage', 'Willkommen auf der Demoseite von toendaCMS', 'Open Source Content Management Framework', 'Willkommen auf der Demoseite des Open-Source Content Management Frameworks toendaCMS.&lt;br /&gt;\r\n It is for enterprise purposes and/or private uses on the web. It offers full flexibility and extendability while featuring an accomplished set of ready-made interfaces, function&amp;#39;&amp;#39;s and modules.\r\n', 'Neuigkeiten', 0, 5, 'Die letzten Neuigkeiten', 5, 100, 0, 3);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_guestbook`
-- 

CREATE TABLE `blog_guestbook` (
  `uid` varchar(9) NOT NULL default '',
  `guest_id` varchar(9) default NULL,
  `booktitle` varchar(255) default NULL,
  `bookstamp` varchar(255) default NULL,
  `access` varchar(10) default NULL,
  `enabled` int(1) default NULL,
  `clean_link` int(1) NOT NULL default '0',
  `clean_script` int(1) NOT NULL default '0',
  `convert_at` int(1) NOT NULL default '0',
  `show_email` int(1) NOT NULL default '0',
  `name_width` varchar(4) default NULL,
  `text_width` varchar(4) default NULL,
  `color_row_1` varchar(6) default NULL,
  `color_row_2` varchar(6) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_guestbook`
-- 

INSERT INTO `blog_guestbook` (`uid`, `guest_id`, `booktitle`, `bookstamp`, `access`, `enabled`, `clean_link`, `clean_script`, `convert_at`, `show_email`, `name_width`, `text_width`, `color_row_1`, `color_row_2`) VALUES ('guestbook', 'guestbook', 'My Guests', 'of this beautiful website', 'Public', 1, 1, 1, 1, 1, '140', '360', 'efefef', 'ffffff');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_guestbook_items`
-- 

CREATE TABLE `blog_guestbook_items` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `text` text,
  `date` varchar(8) default NULL,
  `time` varchar(5) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_guestbook_items`
-- 

INSERT INTO `blog_guestbook_items` (`uid`, `name`, `email`, `text`, `date`, `time`) VALUES ('55cb02d7477921bb0091b9ba7ae91b85', 'vandango', 'vandango@toenda.com', 'Wow, whats a new and cool guestbook.', '20051124', '12:33');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_imagegallery`
-- 

CREATE TABLE `blog_imagegallery` (
  `uid` varchar(10) NOT NULL default '',
  `album` varchar(6) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `text` text,
  `date` varchar(14) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_imagegallery`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_imagegallery_config`
-- 

CREATE TABLE `blog_imagegallery_config` (
  `uid` varchar(12) NOT NULL default '',
  `image_id` varchar(12) NOT NULL default '',
  `image_title` varchar(255) default NULL,
  `image_stamp` text,
  `image_details` int(1) NOT NULL default '0',
  `use_comments` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `max_image` int(2) default NULL,
  `needle_image` varchar(255) default NULL,
  `show_lastimg_title` int(1) default NULL,
  `align_image` varchar(6) default NULL,
  `size_image` int(3) default NULL,
  `image_sort` varchar(4) NOT NULL default 'desc',
  `list_option` int(1) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_imagegallery_config`
-- 

INSERT INTO `blog_imagegallery_config` (`uid`, `image_id`, `image_title`, `image_stamp`, `image_details`, `use_comments`, `access`, `max_image`, `needle_image`, `show_lastimg_title`, `align_image`, `size_image`, `image_sort`, `list_option`) VALUES ('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 5, 'Last uploaded', 1, 'center', 100, 'desc', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_impressum`
-- 

CREATE TABLE `blog_impressum` (
  `uid` varchar(9) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `imp_id` varchar(9) NOT NULL default '',
  `imp_title` varchar(255) default NULL,
  `imp_stamp` varchar(255) default NULL,
  `imp_contact` varchar(10) NOT NULL default '',
  `taxno` varchar(50) default NULL,
  `ustid` varchar(50) default NULL,
  `legal` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_impressum`
-- 

INSERT INTO `blog_impressum` (`uid`, `language`, `imp_id`, `imp_title`, `imp_stamp`, `imp_contact`, `taxno`, `ustid`, `legal`) VALUES ('impressum', 'english_EN', 'impressum', 'Disclaimer', 'Information about this website', '10a1b5f6ab', '123456789', '123123d', 'No portion of this web site may be reproduced without express written consent from its owner.\r\n'),
('hgztkj87r', 'germany_DE', 'impressum', 'Impressum', 'Informationen &uuml;ber diese Webseite', '10a1b5f6ab', '123456789', '123123d', '&lt;span class__________&quot;contentmain&quot;&gt;&lt;span class__________&quot;contentmain&quot;&gt;&lt;strong&gt;Haftungsausschluss / Datenschutz&lt;/strong&gt;&lt;br /&gt;\r\n&lt;br /&gt;\r\n1. Wichtiger rechtlicher Hinweis und Haftungsausschlu&szlig;:&lt;br /&gt;\r\nDas Landgericht Hamburg hat am 12. Mai 1998 im Urteil 312 O 85/98\r\n&quot;Haftung f&uuml;r Links&quot; entschieden, da&szlig; durch die Ver&ouml;ffentlichung eines\r\nLinks auf einer Homepage die Inhalte der gelinkten Seiten mit zu\r\nverantworten sind. Das l&auml;&szlig;t sich nur verhindern, wenn man sich\r\nausdr&uuml;cklich von den Inhalten der gelinkten Seiten distanziert. Wir\r\ndistanzieren uns daher von allen Inhalten, die sich hinter den\r\nangegebenen Links, den dahinter stehenden Servern, weiterf&uuml;hrenden\r\nLinks, G&auml;steb&uuml;chern und s&auml;mtlichen anderen sichtbaren und nicht\r\nsichtbaren Inhalten verbergen. Sollte eine der Seiten auf den\r\nentsprechenden Servern gegen geltendes Recht versto&szlig;en, so ist uns\r\ndieses nicht bekannt. Auf entsprechende Benachrichtigung hin werden wir\r\nselbstverst&auml;ndlich den Link zu dem entsprechenden Server entfernen\r\n(nachzulesen unter www.online-recht.de). Sollte Ihre Homepage, gegen\r\nIhren Wunsch, in unserer Referenzliste verzeichnet sein, dann wenden\r\nSie sich bitte an uns. Wir werden den Link dann umgehend l&ouml;schen.\r\nVielen Dank &lt;br /&gt;\r\n2. Datenschutz:&lt;br /&gt;\r\nEs ist Absicht der Firma Toenda Software Development, die Gesetze zum\r\nSchutz der Privatsph&auml;re und die Datenschutzgesetze genauestens\r\neinzuhalten und zu respektieren. Wir m&ouml;chten dazu beitragen, das\r\nInternet zu einer sicheren und verbindlichen Informationsquelle f&uuml;r\r\nunsere Homepage-Besucher zu machen. Wir sch&uuml;tzen die pers&ouml;nlichen\r\nInformationen unserer G&auml;ste gegen m&ouml;glichen Datenmi&szlig;brauch. Wir geben\r\nau&szlig;erdem Zugriff auf eigene pers&ouml;nliche Informationen, so da&szlig;\r\nInformationen, die wir &uuml;ber Sie haben, ge&auml;ndert oder gel&ouml;scht werden\r\nkann. &lt;br /&gt;\r\n&lt;br /&gt;\r\n2.1 Pers&ouml;nlich identifizierbare Informationen&lt;br /&gt;\r\nWir sammeln pers&ouml;nlich identifizierbare Informationen nur wenn Sie sich\r\neintragen , um an unseren online- Wettbewerben (Preisausschreiben)\r\nteilzunehmen oder Sie um pers&ouml;nliche &Uuml;bersendung von Informationen\r\nbitten.&lt;br /&gt;\r\nDiese Daten werden von der Firma &lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;Toenda Software Development&lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;\r\ngenutzt und nicht an Drittfirmen weitergegeben. Wenn Sie unter 18\r\nJahren sind k&ouml;nnen Sie nur an Wettbewerben teilnehmen oder um\r\npers&ouml;nliche Infromations&uuml;bersendung bitten, wenn die Erlaubnis der\r\nEltern vorliegt. &lt;br /&gt;\r\n&lt;br /&gt;\r\n2. 2 Nicht pers&ouml;nlich identifizierbare Informationen&lt;br /&gt;\r\nWir bem&uuml;hen uns unser Web-Angebot laufend zu verbessern. Daf&uuml;r ist es\r\nn&uuml;tzlich, zu wissen, welche Informationen am beliebtesten ist. Zu\r\ndiesem Zwecke speichern wir Datum, Uhrzeit, Suchbegriff und die von\r\nIhnen angeforderte Information mit der jeweiligen IP-Adresse.&lt;br /&gt;\r\nEine IP-Adresse ist eine Nummer, die automatisch Ihrem Computer\r\nzugeteilt wird, wann immer Sie im Web surfen. Web-Server, d.h. die\r\nGro&szlig;computer, die die Webseiten &amp;bdquo;bereitstellen&amp;ldquo;, identifizieren Ihren\r\nComputer automatisch anhand seiner IP-Adresse. Die Firma &lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;Toenda Software Development&lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;\r\nsammelt IP-Adressen zus&auml;tzlich f&uuml;r Zwecke der Systemverwaltung, um\r\nBerichte zu erstellen und die Benutzung unserer Websites zu verfolgen.\r\nWenn Sie spezifische Seiten von den Websites der Firma anfordern,\r\nerkennen unsere Server oder Computer die IP-Adressen der G&auml;ste. Wir\r\nverbinden IP-Adressen aber nicht mit pers&ouml;nlich identifizierbaren\r\nInformationen, was bedeutet, da&szlig; der Benutzer f&uuml;r uns anonym bleibt.&lt;/span&gt;\r\n&lt;/span&gt;\r\n');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_knowledgebase`
-- 

CREATE TABLE `blog_knowledgebase` (
  `uid` varchar(10) NOT NULL default '',
  `category` varchar(10) default NULL,
  `parent` varchar(10) default NULL,
  `title` varchar(255) default NULL,
  `subtitle` varchar(255) default NULL,
  `content` text,
  `image` varchar(255) default NULL,
  `type` char(1) NOT NULL default '',
  `date` varchar(16) NOT NULL default '',
  `last_update` varchar(16) NOT NULL default '',
  `access` varchar(10) NOT NULL default '',
  `autor` varchar(32) NOT NULL default '',
  `sort` int(5) NOT NULL default '0',
  `publish_state` int(1) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_knowledgebase`
-- 

INSERT INTO `blog_knowledgebase` (`uid`, `category`, `parent`, `title`, `subtitle`, `content`, `image`, `type`, `date`, `last_update`, `access`, `autor`, `sort`, `publish_state`) VALUES ('6e6f2483b7', '', '', 'sdfsdf', 'sdfsdf', 'sdfsdf\r\n', '', 'a', '02.08.2007-19:33', '02.08.2007-19:33', 'Public', 'ccdc5cfffaf3cd9342e40dd9dcb3a3ff', 0, 2);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_knowledgebase_config`
-- 

CREATE TABLE `blog_knowledgebase_config` (
  `uid` varchar(13) NOT NULL default '',
  `id` varchar(13) NOT NULL default '',
  `title` varchar(255) default NULL,
  `subtitle` varchar(255) default NULL,
  `text` text,
  `enabled` int(1) NOT NULL default '0',
  `autor_enabled` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_knowledgebase_config`
-- 

INSERT INTO `blog_knowledgebase_config` (`uid`, `id`, `title`, `subtitle`, `text`, `enabled`, `autor_enabled`, `access`) VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 0, 'Public');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_links`
-- 

CREATE TABLE `blog_links` (
  `uid` varchar(32) NOT NULL default '',
  `type` char(1) NOT NULL default 'l',
  `category` varchar(32) default NULL,
  `sort` int(4) default NULL,
  `name` varchar(255) default NULL,
  `desc` text,
  `link` varchar(255) default NULL,
  `published` int(1) NOT NULL default '0',
  `target` varchar(20) default NULL,
  `rss` varchar(255) default NULL,
  `access` varchar(10) NOT NULL default '',
  `module` int(1) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_links`
-- 

INSERT INTO `blog_links` (`uid`, `type`, `category`, `sort`, `name`, `desc`, `link`, `published`, `target`, `rss`, `access`, `module`) VALUES ('34dr567zhtzh876sgh48r68f44h5s8z4', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 0, 'Toenda Software Development', 'Developer of toendaCMS', 'http://www.toenda.com', 1, '_blank', '', 'Public', 3),
('sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 'c', '', 0, 'Toenda', 'Toenda Software Development Links', '', 1, '', '', 'Public', 3),
('dsf78578asdas7das76das7d67as67d6', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 1, 'toendaCMS Demonstration Site', 'The officiell demonstration site of the content management and weblogging system toendaCMS.', 'http://toendacms.toenda.com', 1, '_blank', NULL, 'Public', 3),
('asdasdasdasdasd6786786as78d6as67', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 2, 'PHP.net', 'Officiell PHP webpage', 'http://www.php.net', 1, '_blank', '', 'Public', 2),
('d8f83e6e9acc6ad211104949db1285fd', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 3, 'vandango | creative coding', 'toendaCMS maindeveloper weblog', 'http://vandango.org', 1, '_blank', '', 'Public', 1),
('50c3ef9ef90f608dd85ca31166b62e68', 'c', NULL, 1, 'Linux', 'Some Links about Linus free operating system', '', 1, '', '', 'Public', 3),
('175b2bf8dd4a03d00038bb43ae06abf1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 0, 'Enlightenment', 'The best Unix / Linux Window Manager', 'http://www.enlightenment.org', 1, '_blank', '', 'Public', 3),
('43b59b86aa69a67ea020ead9e3ce54e1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 1, 'Kernel.org', 'The Linux Kernel', 'http://www.kernel.org', 1, '_blank', '', 'Public', 3);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_links_config`
-- 

CREATE TABLE `blog_links_config` (
  `uid` varchar(17) NOT NULL default '',
  `link_use_side_desc` int(1) default NULL,
  `link_use_side_title` int(1) default NULL,
  `link_side_title` varchar(255) default NULL,
  `link_use_main_desc` int(1) default NULL,
  `link_main_title` varchar(255) default NULL,
  `link_main_subtitle` varchar(255) default NULL,
  `link_main_text` text,
  `link_main_access` varchar(10) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_links_config`
-- 

INSERT INTO `blog_links_config` (`uid`, `link_use_side_desc`, `link_use_side_title`, `link_side_title`, `link_use_main_desc`, `link_main_title`, `link_main_subtitle`, `link_main_text`, `link_main_access`) VALUES ('links_config_side', 0, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL),
('links_config_main', NULL, NULL, NULL, 1, 'myLinks', 'A list of all websites i like', 'This is a example text for the textlink page.&lt;a href__________&quot;/toendacms/index.php/section/contactform/template/k2&quot;&gt;Kontaktformular&lt;/a&gt;', 'Public');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_news`
-- 

CREATE TABLE `blog_news` (
  `uid` varchar(10) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `title` varchar(255) default NULL,
  `autor` varchar(255) NOT NULL default '',
  `date` varchar(10) NOT NULL default '',
  `time` varchar(5) NOT NULL default '',
  `newstext` text,
  `stamp` double NOT NULL default '0',
  `published` int(1) NOT NULL default '0',
  `publish_date` varchar(16) NOT NULL default '',
  `comments_enabled` int(1) NOT NULL default '1',
  `image` varchar(255) default NULL,
  `access` varchar(10) NOT NULL default '',
  `show_on_frontpage` int(1) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_news`
-- 

INSERT INTO `blog_news` (`uid`, `language`, `title`, `autor`, `date`, `time`, `newstext`, `stamp`, `published`, `publish_date`, `comments_enabled`, `image`, `access`, `show_on_frontpage`) VALUES ('c4c846e167', 'english_EN', 'Hello world!', 'Dolly', '29.03.2007', '00:00', 'Hello world. This is Dolly  and you reading my first post. If you want you can delete it, but you can edit it too. Or you write a new one and let this where it is. It''s your choice.&lt;br /&gt;\r\n&lt;br /&gt;\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.&lt;br /&gt;\r\n', 200703290000, 1, '29.03.2007-00:00', 1, '', 'Public', 1),
('90ac2e39eb', 'germany_DE', 'Hallo Welt!', 'Dolly', '30.03.2007', '17:25', 'Hallo Welt. Ich bin Dolly und du liest gerade den ersten Eintrag. Wenn du willst, kannst du mich l&ouml;schen, oder du bearbeitest mich einfach. Order du schreibst einen neuen und l&auml;sst mich hier zur&uuml;ck, ganz wie du willst.&lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;a href__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/toendaCMS.png&quot; rel__________&quot;lightbox&quot;&gt;&lt;img align__________&quot;left&quot; alt__________&quot;toendaCMS.png&quot; src__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/toendaCMS.png&quot; title__________&quot;toendaCMS.png&quot; /&gt;&lt;/a&gt;\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.\r\n', 200703301725, 1, '30.03.2007-17:25', 1, '', 'Public', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_news_categories`
-- 

CREATE TABLE `blog_news_categories` (
  `uid` varchar(5) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_news_categories`
-- 

INSERT INTO `blog_news_categories` (`uid`, `name`, `desc`) VALUES ('erdf4', 'Uncategorized', 'News without a category.');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_news_to_categories`
-- 

CREATE TABLE `blog_news_to_categories` (
  `uid` varchar(32) NOT NULL default '',
  `news_uid` varchar(10) NOT NULL default '',
  `cat_uid` varchar(5) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_news_to_categories`
-- 

INSERT INTO `blog_news_to_categories` (`uid`, `news_uid`, `cat_uid`) VALUES ('faf794901b615e2c26ef4a78f7219853', '79b944ed5f', 'erdf4'),
('ec42d00d6ed95e280c1ed0086b6bba09', 'c4c846e167', 'erdf4'),
('145a5946991378852797f16685d75fb0', 'a4439ff6b4', 'erdf4'),
('019a7e022961e19855032b4981717200', '90ac2e39eb', 'erdf4');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_newsletter`
-- 

CREATE TABLE `blog_newsletter` (
  `uid` varchar(10) NOT NULL default '',
  `nl_title` varchar(255) NOT NULL default '',
  `nl_show_title` int(1) NOT NULL default '0',
  `nl_text` varchar(255) NOT NULL default '',
  `nl_link` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_newsletter`
-- 

INSERT INTO `blog_newsletter` (`uid`, `nl_title`, `nl_show_title`, `nl_text`, `nl_link`) VALUES ('newsletter', 'Newsletter', 1, 'You want always know whats up, subscribe now!', 'Submit');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_newsletter_items`
-- 

CREATE TABLE `blog_newsletter_items` (
  `uid` varchar(6) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_newsletter_items`
-- 

INSERT INTO `blog_newsletter_items` (`uid`, `user`, `email`) VALUES ('223594', 'Mr. Toenda', 'info@toenda.com'),
('f574da', 'Jonathan Naumann', 'info@toenda.com');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_newsmanager`
-- 

CREATE TABLE `blog_newsmanager` (
  `uid` varchar(11) character set latin1 collate latin1_german1_ci NOT NULL,
  `news_id` varchar(11) character set latin1 collate latin1_german1_ci NOT NULL,
  `news_title` varchar(255) default NULL,
  `news_stamp` varchar(255) default NULL,
  `news_text` text NOT NULL,
  `news_image` varchar(255) default NULL,
  `use_comments` int(1) NOT NULL default '0',
  `show_autor` int(1) NOT NULL default '0',
  `show_autor_as_link` int(1) NOT NULL default '0',
  `news_amount` int(5) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `news_cut` int(5) NOT NULL default '0',
  `use_gravatar` int(1) NOT NULL default '0',
  `use_emoticons` int(1) NOT NULL default '0',
  `use_rss091` int(1) default NULL,
  `use_rss10` int(1) default NULL,
  `use_rss20` int(1) default NULL,
  `use_atom03` int(1) default NULL,
  `use_opml` int(1) default NULL,
  `syn_amount` int(1) default NULL,
  `use_syn_title` int(1) default NULL,
  `def_feed` varchar(7) default NULL,
  `use_trackback` int(11) default NULL,
  `use_timesince` int(1) NOT NULL default '0',
  `readmore_link` int(1) NOT NULL default '0',
  `news_spacing` int(2) NOT NULL default '0',
  `language` varchar(25) NOT NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_newsmanager`
-- 

INSERT INTO `blog_newsmanager` (`uid`, `news_id`, `news_title`, `news_stamp`, `news_text`, `news_image`, `use_comments`, `show_autor`, `show_autor_as_link`, `news_amount`, `access`, `news_cut`, `use_gravatar`, `use_emoticons`, `use_rss091`, `use_rss10`, `use_rss20`, `use_atom03`, `use_opml`, `syn_amount`, `use_syn_title`, `def_feed`, `use_trackback`, `use_timesince`, `readmore_link`, `news_spacing`, `language`) VALUES ('newsmanager', 'newsmanager', 'News', 'Current', 'My newstext&lt;br /&gt;\r\n', '', 1, 1, 1, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 2, 0, 0, 'english_EN'),
('45789hgtzu', 'newsmanager', 'Neuigkeiten', 'Aktuell', 'Mein Neuigkeitentext und noch viel mehr&lt;br /&gt;\r\nUnd ein wenig Text ...&lt;br /&gt;\r\n', '', 1, 1, 1, 20, 'Public', 0, 1, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 0, 0, 0, 'germany_DE');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_notepad`
-- 

CREATE TABLE `blog_notepad` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(200) NOT NULL default '',
  `note` text,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_notepad`
-- 

INSERT INTO `blog_notepad` (`uid`, `name`, `note`) VALUES ('ccdc5cfffaf3cd9342e40dd9dcb3a3ff', 'root', 'Ihr Notizblock braucht Sie ...'),
('9e07ddbe2eb87663511e4716cb94eef2', 'writer', 'Ihr Notizblock braucht Sie');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_poll_config`
-- 

CREATE TABLE `blog_poll_config` (
  `uid` varchar(4) NOT NULL default '',
  `poll_title` varchar(30) default NULL,
  `allpoll_title` varchar(30) default NULL,
  `show_poll_title` int(1) NOT NULL default '0',
  `poll_side_width` int(3) NOT NULL default '0',
  `poll_main_width` int(3) NOT NULL default '0',
  `poll_sm_title` varchar(30) default NULL,
  `use_poll_sidemenu` int(1) NOT NULL default '0',
  `poll_sidemenu_id` int(2) NOT NULL default '0',
  `poll_tm_title` varchar(30) default NULL,
  `use_poll_topmenu` int(1) NOT NULL default '0',
  `poll_topmenu_id` int(2) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_poll_config`
-- 

INSERT INTO `blog_poll_config` (`uid`, `poll_title`, `allpoll_title`, `show_poll_title`, `poll_side_width`, `poll_main_width`, `poll_sm_title`, `use_poll_sidemenu`, `poll_sidemenu_id`, `poll_tm_title`, `use_poll_topmenu`, `poll_topmenu_id`) VALUES ('poll', 'Poll', 'All Polls', 1, 110, 500, 'Poll', 0, 2, 'Poll', 0, 4);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_poll_items`
-- 

CREATE TABLE `blog_poll_items` (
  `uid` varchar(8) NOT NULL default '',
  `poll_uid` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `domain` varchar(255) NOT NULL default '',
  `answer` int(1) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_poll_items`
-- 

INSERT INTO `blog_poll_items` (`uid`, `poll_uid`, `ip`, `domain`, `answer`) VALUES ('f2e874a9', '1386d1eb56f76a14a507f64a63617309', '127.0.0.1', 'localhost', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_polls`
-- 

CREATE TABLE `blog_polls` (
  `uid` varchar(32) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `question1` varchar(255) default NULL,
  `question2` varchar(255) default NULL,
  `question3` varchar(255) default NULL,
  `question4` varchar(255) default NULL,
  `question5` varchar(255) default NULL,
  `question6` varchar(255) default NULL,
  `question7` varchar(255) default NULL,
  `question8` varchar(255) default NULL,
  `question9` varchar(255) default NULL,
  `question10` varchar(255) default NULL,
  `question11` varchar(255) default NULL,
  `question12` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_polls`
-- 

INSERT INTO `blog_polls` (`uid`, `title`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `question11`, `question12`) VALUES ('1386d1eb56f76a14a507f64a63617309', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_products`
-- 

CREATE TABLE `blog_products` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `product_number` varchar(255) default NULL,
  `factory` varchar(255) default NULL,
  `factory_url` varchar(255) default NULL,
  `desc` text,
  `category` varchar(32) default NULL,
  `image1` varchar(255) default NULL,
  `date` varchar(16) NOT NULL default '',
  `price` varchar(50) default NULL,
  `price_tax` varchar(50) default NULL,
  `status` int(1) NOT NULL default '0',
  `quantity` int(10) default NULL,
  `weight` varchar(50) default NULL,
  `sort` int(5) NOT NULL default '0',
  `access` varchar(10) default NULL,
  `sql_type` char(1) NOT NULL default '',
  `image2` varchar(255) default NULL,
  `image3` varchar(255) default NULL,
  `image4` varchar(255) default NULL,
  `show_on_startpage` tinyint(4) NOT NULL default '0',
  `pub` tinyint(4) NOT NULL default '0',
  `parent` varchar(32) default NULL,
  `language` varchar(25) NOT NULL default 'english_EN',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_products`
-- 

INSERT INTO `blog_products` (`uid`, `name`, `product_number`, `factory`, `factory_url`, `desc`, `category`, `image1`, `date`, `price`, `price_tax`, `status`, `quantity`, `weight`, `sort`, `access`, `sql_type`, `image2`, `image3`, `image4`, `show_on_startpage`, `pub`, `parent`, `language`) VALUES ('13482fa849ab1b901ababf3e3fc0bbab', 'JobLight Jobportal Software', '', 'http://www.toenda.com', 'http://www.toenda.com', '', '2f10f7cf479f1c5c227452d45d8ad9d9', '', '15.07.2007-16:42', '-1', '0', 1, -1, '', 2, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('764f068e33673ecda7978c1a63b48294', 'test', NULL, NULL, NULL, '', '', NULL, '11.07.2007-21:49', NULL, NULL, 0, NULL, NULL, 1, 'Public', 'c', NULL, NULL, NULL, 0, 1, NULL, 'germany_DE'),
('32acfdf114279d275709c2e277341b5c', 'toendaCMS', 't-8237-42', 'http://www.toenda.com', 'http://www.toenda.com', 'Open Source Content Management Framework\r\n', '2f10f7cf479f1c5c227452d45d8ad9d9', 'toendaCMS_box_104.jpg', '15.07.2007-16:42', '1199', '19', 1, -1, '', 4, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('d71b909aa7d0f25fdb01a6afe6d5ac23', 'Zappr Photo Management', '', 'http://www.toenda.com', 'http://www.toenda.com', '', '2f10f7cf479f1c5c227452d45d8ad9d9', '', '15.07.2007-16:42', '-1', '0', 1, -1, '', 3, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('9593610a4bd7f9e0fa31753648a9d08b', 'Coca Cola GmbH', '', '', '', 'blubberlutsch', '', '', '18.07.2007-00:28', '-1', '19', 0, -1, '', 2, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('6031401fddf765e03ca0ec6261623cf6', 'Blubberlutsch', '777-123', 'www.hgmc.com', 'www.hgmc.com', '&lt;p&gt;\r\nManu Chao verbrachte seine Kindheit und Jugendzeit in &lt;a href__________&quot;http://de.wikipedia.org/wiki/Paris&quot; title__________&quot;Paris&quot;&gt;Paris&lt;/a&gt; als Sohn des &lt;a href__________&quot;http://de.wikipedia.org/wiki/Galicien&quot; title__________&quot;Galicien&quot;&gt;galizischen&lt;/a&gt; &lt;a href__________&quot;http://de.wikipedia.org/wiki/Journalist&quot; title__________&quot;Journalist&quot;&gt;Journalisten&lt;/a&gt; und &lt;a href__________&quot;http://de.wikipedia.org/wiki/Musiker&quot; title__________&quot;Musiker&quot;&gt;Musikers&lt;/a&gt; &lt;a class__________&quot;new&quot; href__________&quot;http://de.wikipedia.org/w/index.php?title__________Ram%C3%B3n_Chao&amp;action__________edit&quot; title__________&quot;Ram&oacute;n Chao&quot;&gt;Ram&oacute;n Chao&lt;/a&gt;, der von &lt;a class__________&quot;new&quot; href__________&quot;http://de.wikipedia.org/w/index.php?title__________Alessandro_Robecchi&amp;action__________edit&quot; title__________&quot;Alessandro Robecchi&quot;&gt;Alessandro Robecchi&lt;/a&gt;\r\nals &amp;bdquo;hochgebildeter Intellektueller und feinsinniger Berichterstatter\r\nder lateinamerikanischen Welt&amp;ldquo; bezeichnet wurde, auf. Seine &lt;a href__________&quot;http://de.wikipedia.org/wiki/Baskenland&quot; title__________&quot;Baskenland&quot;&gt;baskische&lt;/a&gt; Mutter &lt;a class__________&quot;new&quot; href__________&quot;http://de.wikipedia.org/w/index.php?title__________Felisa_Chao&amp;action__________edit&quot; title__________&quot;Felisa Chao&quot;&gt;Felisa Chao&lt;/a&gt; ist im k&uuml;nstlerischen Bereich t&auml;tig. Beide gingen ins &lt;a href__________&quot;http://de.wikipedia.org/wiki/Exil&quot; title__________&quot;Exil&quot;&gt;Exil&lt;/a&gt; nach Paris, um dem &lt;a href__________&quot;http://de.wikipedia.org/wiki/Faschismus&quot; title__________&quot;Faschismus&quot;&gt;faschistischen&lt;/a&gt; &lt;a href__________&quot;http://de.wikipedia.org/wiki/Regime&quot; title__________&quot;Regime&quot;&gt;Regime&lt;/a&gt; von &lt;a href__________&quot;http://de.wikipedia.org/wiki/Francisco_Franco&quot; title__________&quot;Francisco Franco&quot;&gt;General Franco&lt;/a&gt; zu entkommen. Sein j&uuml;ngerer Bruder &lt;a class__________&quot;new&quot; href__________&quot;http://de.wikipedia.org/w/index.php?title__________Antoine_Chao&amp;action__________edit&quot; title__________&quot;Antoine Chao&quot;&gt;Antoine Chao&lt;/a&gt; gr&uuml;ndete sp&auml;ter mit ihm zusammen die Band &lt;a href__________&quot;http://de.wikipedia.org/wiki/Mano_Negra&quot; title__________&quot;Mano Negra&quot;&gt;Mano Negra&lt;/a&gt;.\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\nIn den Banlieues, den Pariser Vororten, spielte sich das Leben des\r\n1961 geborenen Manu Chao zweigleisig ab: Zum einen in der Familie, wo\r\nstets &lt;a href__________&quot;http://de.wikipedia.org/wiki/Spanische_Sprache&quot; title__________&quot;Spanische Sprache&quot;&gt;spanisch&lt;/a&gt;\r\ngesprochen wurde und die regelm&auml;&szlig;ig von lateinamerikanischen\r\nIntellektuellen, Schriftstellern und Musikern besucht wurde. Und zum\r\nanderen auf den Stra&szlig;en, in denen &lt;a href__________&quot;http://de.wikipedia.org/wiki/Franz%C3%B6sische_Sprache&quot; title__________&quot;Franz&ouml;sische Sprache&quot;&gt;franz&ouml;sisch&lt;/a&gt;\r\ngesprochen wurde und in denen die Br&uuml;der Chao einige ihrer sp&auml;teren\r\nBandmitglieder kennenlernten. Deren Eltern waren zu gro&szlig;en Teilen\r\nebenfalls vor dem Franco-Regime gefl&uuml;chtet oder aus finanziellen\r\nGr&uuml;nden von &lt;a href__________&quot;http://de.wikipedia.org/wiki/Lateinamerika&quot; title__________&quot;Lateinamerika&quot;&gt;Lateinamerika&lt;/a&gt;, &lt;a href__________&quot;http://de.wikipedia.org/wiki/Afrika&quot; title__________&quot;Afrika&quot;&gt;Afrika&lt;/a&gt; oder aus dem arabischsprachigen Raum nach S&egrave;vres immigriert.\r\n&lt;/p&gt;\r\n', '9593610a4bd7f9e0fa31753648a9d08b', '', '18.07.2007-00:32', '0,39', '19', 1, -1, '330g', 5, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('b0b14e7381294e263b72a0c9d65b9f31', 'Coka Cola Zero', 'c-8521-45', 'www.coke.de', 'www.coke.de', 'Coca-Cola Zero erg&auml;nzt seit Juli 2006 das kalorienreduzierte bzw.\r\nzuckerfreie Produktsortiment von Coca-Cola in Deutschland. Coca-Cola\r\nZero ist ein Erfrischungsgetr&auml;nk, das echten Geschmack ohne Zucker\r\nbietet. Dank besonderer Geschmacks- kombinationen ist der Geschmack von\r\nCoca-Cola Zero sehr nahe an der klassischen Coke. \r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\nCoca-Cola Zero: Echter Geschmack und zero Zucker. \r\n', '9593610a4bd7f9e0fa31753648a9d08b', 'ccz.jpg', '18.07.2007-00:46', '38,50', '19', 1, -1, '330g', 6, 'Public', 'a', 'cczero.jpg', 'mob52_1162570717.jpg', 'img_range_coke.jpg', 1, 1, '', 'germany_DE'),
('9ce205bb06430aa26747544161f08655', 'autos', '', '', '', '', '', '', '21.07.2007-23:47', '-1', '19', 0, -1, '', 7, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('6dc37aed94ab7733c5255686233b0574', 'doors', '', '', '', '', '', '', '21.07.2007-23:48', '-1', '19', 0, -1, '', 8, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('da0cbbdb230f2ed27e8ed92b38e92917', 'zipfelm&uuml;tzen', '', '', '', '', '', '', '21.07.2007-23:49', '-1', '19', 0, -1, '', 9, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('93dfd10e552c3ed45a2c588e7ad0272e', 'sadasdas', '', '', '', 'sdasd\r\n', 'da0cbbdb230f2ed27e8ed92b38e92917', '', '22.07.2007-00:11', '-1', '19', 0, -1, '', 10, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('45de263d00b4bb677f325848a132a9c2', 'dd', '', '', '', 'asdasdasd\r\n', 'da0cbbdb230f2ed27e8ed92b38e92917', '', '22.07.2007-00:12', '-1', '19', 1, -1, '', 11, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('2f10f7cf479f1c5c227452d45d8ad9d9', 'Toenda', '', '', '', 'asdsadsad', '', '', '22.07.2007-15:45', '-1', '19', 0, -1, '', 1, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_products_config`
-- 

CREATE TABLE `blog_products_config` (
  `uid` varchar(8) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `products_id` varchar(8) NOT NULL default '',
  `products_title` varchar(255) NOT NULL default '',
  `products_stamp` varchar(255) NOT NULL default '',
  `products_text` text NOT NULL,
  `category_state` varchar(255) NOT NULL default '',
  `category_title` varchar(255) NOT NULL default '',
  `use_category_title` int(1) NOT NULL default '0',
  `show_price_only_users` tinyint(4) default NULL,
  `startpagetitle` varchar(255) default NULL,
  `use_sidebar_categories` tinyint(4) NOT NULL default '1',
  `max_latest_products` int(11) NOT NULL default '15'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_products_config`
-- 

INSERT INTO `blog_products_config` (`uid`, `language`, `products_id`, `products_title`, `products_stamp`, `products_text`, `category_state`, `category_title`, `use_category_title`, `show_price_only_users`, `startpagetitle`, `use_sidebar_categories`, `max_latest_products`) VALUES ('products', 'germany_DE', 'products', 'Products', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n', '', 'Product Categories', 1, 0, 'Aktuelle Angebot', 1, 15),
('f225076a', 'english_EN', 'products', 'sdfsdfsdf', 'sdfsdf', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.\r\n', '', 'sdfsdf', 1, 0, 'Current offers', 1, 15);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_session`
-- 

CREATE TABLE `blog_session` (
  `uid` varchar(32) NOT NULL default '',
  `date` varchar(20) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `user_id` varchar(32) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_session`
-- 

INSERT INTO `blog_session` (`uid`, `date`, `user`, `user_id`) VALUES ('a579eefac60b0139da98e972c19432dc', '1153685958', 'root', 'ccdc5cfffaf3cd9342e40dd9dcb3a3ff'),
('0a7219df8562254fe673bae16cab9c68', '1188506585', 'root', 'ccdc5cfffaf3cd9342e40dd9dcb3a3ff');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_sidebar`
-- 

CREATE TABLE `blog_sidebar` (
  `uid` varchar(32) NOT NULL default '',
  `title` varchar(255) default NULL,
  `key` varchar(255) default NULL,
  `content` text,
  `foot` varchar(255) default NULL,
  `id` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_sidebar`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_sidebar_extensions`
-- 

CREATE TABLE `blog_sidebar_extensions` (
  `uid` varchar(18) NOT NULL default '',
  `sidemenu_title` varchar(255) default NULL,
  `sidemenu` int(1) NOT NULL default '0',
  `sidebar_title` varchar(255) default NULL,
  `show_sidebar_title` int(1) NOT NULL default '0',
  `chooser_title` varchar(255) default NULL,
  `show_chooser_title` int(1) NOT NULL default '0',
  `search_title` varchar(255) default NULL,
  `show_search_title` int(1) NOT NULL default '0',
  `search_alignment` varchar(10) default NULL,
  `search_withbr` int(1) NOT NULL default '0',
  `search_withbutton` int(1) default NULL,
  `search_word` varchar(255) default NULL,
  `login_title` varchar(255) default NULL,
  `usermenu_title` varchar(255) default NULL,
  `nologin` varchar(255) default NULL,
  `reg_link` varchar(255) default NULL,
  `reg_user` varchar(255) default NULL,
  `reg_pass` varchar(255) default NULL,
  `login_user` int(1) NOT NULL default '0',
  `usermenu` int(1) NOT NULL default '0',
  `show_login_title` int(1) NOT NULL default '0',
  `show_news_cat_amount` int(1) default '0',
  `show_memberlist` int(11) NOT NULL default '0',
  `lang` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_sidebar_extensions`
-- 

INSERT INTO `blog_sidebar_extensions` (`uid`, `sidemenu_title`, `sidemenu`, `sidebar_title`, `show_sidebar_title`, `chooser_title`, `show_chooser_title`, `search_title`, `show_search_title`, `search_alignment`, `search_withbr`, `search_withbutton`, `search_word`, `login_title`, `usermenu_title`, `nologin`, `reg_link`, `reg_user`, `reg_pass`, `login_user`, `usermenu`, `show_login_title`, `show_news_cat_amount`, `show_memberlist`, `lang`) VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 0, 'Showcase', 1, 'Search website', 0, 'left', 0, 0, '', 'Login', 'Usermenu', 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 1, 'de;en;nl;');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_sidemenu`
-- 

CREATE TABLE `blog_sidemenu` (
  `uid` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `language` varchar(25) NOT NULL,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `id` int(3) NOT NULL default '0',
  `subid` char(3) character set utf8 collate utf8_unicode_ci NOT NULL,
  `root` varchar(5) default '-',
  `parent` varchar(5) character set utf8 collate utf8_unicode_ci NOT NULL,
  `parent_lvl1` varchar(5) default '-',
  `parent_lvl2` varchar(5) default '-',
  `parent_lvl3` varchar(5) default '-',
  `type` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `link` varchar(255) character set utf8 collate utf8_unicode_ci default NULL,
  `published` int(1) NOT NULL default '0',
  `access` varchar(10) character set utf8 collate utf8_unicode_ci NOT NULL,
  `target` varchar(20) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_sidemenu`
-- 

INSERT INTO `blog_sidemenu` (`uid`, `language`, `name`, `id`, `subid`, `root`, `parent`, `parent_lvl1`, `parent_lvl2`, `parent_lvl3`, `type`, `link`, `published`, `access`, `target`) VALUES ('r15tg', 'english_EN', 'Home', 1, '-', '-', '-', '-', '-', '-', 'link', 'frontpage', 1, 'Public', ''),
('6738n', 'english_EN', 'Pages', 0, '-', '-', '-', '-', '-', '-', 'title', '-', 0, 'Public', ''),
('51272', 'english_EN', 'Contact Me', 4, '-', '-', '-', '-', '-', '-', 'link', 'contactform', 1, 'Public', ''),
('dc688', 'english_EN', 'License', 2, '-', '-', '-', '-', '-', '-', 'link', '18e2a', 1, 'Public', ''),
('52d28', 'english_EN', 'Guestbook', 3, '-', '-', '-', '-', '-', '-', 'link', 'guestbook', 1, 'Public', ''),
('11d22', 'english_EN', 'sub1', 2, '0', '-', '2', '-', '-', '-', 'link', 'polls', 1, 'Public', ''),
('dfsd7', 'english_EN', 'subsub1', 2, '0', '-', '-', '-', '11d22', '-', 'link', 'search', 0, 'Public', NULL),
('c39d0', 'germany_DE', 'Navigation', 7, '-', '-', '-', '-', '-', '-', 'title', '0', 1, 'Public', ''),
('638ac', 'germany_DE', 'Lizenz', 10, '-', '-', '-', '-', '-', '-', 'link', '18e2a', 1, 'Public', ''),
('1fffa', 'germany_DE', 'Startseite', 8, '-', '-', '-', '-', '-', '-', 'link', 'frontpage', 0, 'Public', ''),
('a27fc', 'germany_DE', 'G&auml;stebuch', 9, '-', '-', '-', '-', '-', '-', 'link', 'guestbook', 1, 'Public', ''),
('e19ce', 'germany_DE', 'Kontaktformular', 11, '-', '-', '-', '-', '-', '-', 'link', 'contactform', 1, 'Public', ''),
('b0abf', 'germany_DE', 'Komponenten', 12, '-', '-', '-', '-', '-', '-', 'title', '-', 1, 'Public', ''),
('7364b', 'germany_DE', 'sadasd', 8, '1', '-', '8', '-', '-', '-', 'link', 'impressum', 1, 'Public', ''),
('60af3', 'germany_DE', 'Domainchecker', 13, '-', '-', '-', '-', '-', '-', 'link', 'components&item=domainchecker', 1, 'Public', ''),
('e0fab', 'germany_DE', 'Shop', 14, '-', '-', '-', '-', '-', '-', 'link', 'components&item=tcmsshop', 1, 'Public', ''),
('f48d6', 'germany_DE', 'Test', 15, '-', '-', '-', '-', '-', '-', 'link', '3ce0c', 1, 'Public', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_statistics`
-- 

CREATE TABLE `blog_statistics` (
  `host` varchar(255) NOT NULL default '',
  `site_url` varchar(255) NOT NULL default '',
  `value` int(10) default '0',
  `ip_uid` varchar(32) default NULL,
  `referrer` varchar(255) default NULL,
  `timestamp` datetime default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_statistics`
-- 

INSERT INTO `blog_statistics` (`host`, `site_url`, `value`, `ip_uid`, `referrer`, `timestamp`) VALUES ('localhost', '/toendacms_svn/toendacms/', 29, 'a84573f07ee669969e4cc7b88b0f6c4b', 'http://localhost/toendacms_svn/', '2007-07-30 20:01:32'),
('localhost', '/toendacms_svn/toendacms/index.php/section:products/template:k2/lang:de', 2, 'a0cdf664ad4b7de524521df9a378629e', 'http://localhost/toendacms_svn/toendacms/', '2007-07-14 14:50:42'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html', 198, '4d22a521425317f0226508b3f9812534', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=offers', '2007-07-26 21:11:10'),
('localhost', '/toendacms_svn/toendacms/index.php/de/contact.html', 12, 'c0e26a49eae98b0cff8342aa5902ea5b', 'http://localhost/toendacms_svn/toendacms/index.php/de/License.html', '2007-07-24 22:10:36'),
('localhost', '/toendacms_svn/toendacms/index.php/en/products.html', 1, 'a5b068f6649021a1a859e1656e9b645b', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html', '2007-07-14 21:03:37'),
('localhost', '/toendacms_svn/toendacms/index.php/nl/products.html', 1, '8621a52928b1fb24fc5e63e6b6e90f55', 'http://localhost/toendacms_svn/toendacms/index.php/en/products.html', '2007-07-14 21:03:39'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse', 201, '426a7666ff4aab21513aa810e8ab2cdd', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=latest', '2007-07-26 21:09:16'),
('localhost', '/toendacms_svn/toendacms/index.php/de/frontpage.html', 53, '4a47ecce2e92bd4ba9cce60f11874b3b', 'http://localhost/toendacms_svn/toendacms/index.php/en/frontpage.html', '2007-07-26 21:08:43'),
('localhost', '/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', 59, 'b9a80edb7130d2ab89a53e1b01faebcb', 'http://localhost/toendacms_svn/toendacms/index.php/de/frontpage.html', '2007-07-22 14:48:30'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=13482fa849ab1b901ababf3e3fc0bbab', 17, '7f058f8273d5e768001db28dfc38bff8', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse&category=764f068e33673ecda7978c1a63b48294', '2007-07-22 15:35:22'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/lightbox/images/closelabel.gif', 1, '2dfe93296e35b9201a4b2f9758667180', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', '2007-07-15 02:40:34'),
('localhost', '/toendacms_svn/toendacms/index.php/de/images/closelabel.gif', 11, 'cf3ca668c92f1f76dd18feab3b22e728', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', '2007-07-15 02:40:55'),
('localhost', '/toendacms_svn/toendacms/index.php/de/images/loading.gif', 8, 'c7cecdcd46d877fcf1f906ab4814e0b5', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', '2007-07-15 02:23:53'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/lightbox/images/loading.gif', 1, '17f658782466bbd78e35b4ce6f6547ad', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', '2007-07-15 02:25:37'),
('localhost', '/toendacms_svn/toendacms/index.php/de/closelabel.gif', 3, '2b132273c7964b41a5601049a941cba4', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', '2007-07-15 02:43:24'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=offers', 101, '63a1b92ef572ffbf523db284e4405863', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse', '2007-07-26 21:09:48'),
('localhost', '/toendacms_svn/toendacms/index.php/de/news.html', 14, 'a5227af2c49fb901f9b239c3150a487e', 'http://localhost/toendacms_svn/toendacms/index.php/de/frontpage.html', '2007-07-21 14:14:46'),
('localhost', '/toendacms_svn/toendacms/index.php/de/news.html?news=archive', 8, 'bb015c782df94918ea06163483b682ac', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=archive&cmd=category', '2007-07-18 01:27:04'),
('localhost', '/toendacms_svn/toendacms/index.php/de/news.html?news=archive&cmd=category', 15, 'a499da6798767e9ef98af0d350eee3ab', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=archive', '2007-07-18 01:27:08'),
('localhost', '/toendacms_svn/toendacms/index.php/en/news.html', 1, '4d49ab4e698facfaa7fa4f15f94bd252', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=archive&cmd=category', '2007-07-18 01:24:34'),
('localhost', '/toendacms_svn/toendacms/index.php/de/guestbook.html', 1, '1e36e7539f47da63985a033b26f620a2', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse', '2007-07-19 23:20:10'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', 77, 'ba53a180993a4fc7fb084b46bec7b7ef', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=offers', '2007-07-24 00:47:47'),
('localhost', '/toendacms_svn/toendacms/index.php/en/news.html?news=archive&cmd=category', 1, 'c9c5c03f05c47a7c94abc394166b65a7', 'http://localhost/toendacms_svn/toendacms/index.php/en/news.html', '2007-07-18 01:24:39'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=6031401fddf765e03ca0ec6261623cf6', 11, 'ee35f40171c79c69a15ed5640897ba1d', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=offers', '2007-07-20 00:11:50'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=32acfdf114279d275709c2e277341b5c', 7, 'b8a74731df6ff25d7df998acd6f49b96', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=offers', '2007-07-24 00:13:34'),
('localhost', '/toendacms_svn/toendacms/index.php/de/gallery.html?albums=3fe4cb', 1, '6c133e844d47d3a6b8a4610979515e49', 'http://localhost/toendacms_svn/toendacms/index.php/de/gallery.html', '2007-07-21 15:12:00'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&category=9593610a4bd7f9e0fa31753648a9d08b', 4, 'c6d433ad1c4abae569742d044e8711c7', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', '2007-07-24 00:03:23'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=45de263d00b4bb677f325848a132a9c2', 1, '32f62133019e9e59e218310ca11fcccc', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html', '2007-07-22 14:31:09'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse&category=9593610a4bd7f9e0fa31753648a9d08b', 6, '222b9ad1d9f120df613f27499ca25b3d', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', '2007-07-24 00:13:56'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse&category=764f068e33673ecda7978c1a63b48294', 20, 'efaf1a0d9285d82864e66b0034922307', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse', '2007-07-22 17:48:24'),
('localhost', '/toendacms_svn/toendacms/index.php/de/download.html', 4, '11d211092a423cea1d7acd6240018183', 'http://localhost/toendacms_svn/toendacms/index.php/de/gallery.html', '2007-07-21 14:14:52'),
('localhost', '/toendacms_svn/toendacms/index.php/de/gallery.html', 7, '5389a6b1b1f7d737da925e1b0f772c07', 'http://localhost/toendacms_svn/toendacms/index.php/de/gallery.html?albums=3fe4cb', '2007-07-21 15:12:22'),
('localhost', '/toendacms_svn/toendacms/index.php/de/register.html', 21, 'a96b61be92c40858c8af2bb7ef9f7ab1', 'http://localhost/toendacms_svn/toendacms/index.php/de/news.html?news=90ac2e39eb', '2007-07-22 15:01:51'),
('localhost', '/toendacms_svn/toendacms/index.php/de/register.html?cmd=lostpassword', 3, 'd2c1a2f84929d5404ccdca6e361044d0', 'http://localhost/toendacms_svn/toendacms/index.php/de/register.html', '2007-07-22 15:03:18'),
('localhost', '/toendacms_svn/toendacms/index.php/de/profile.html?action=list', 2, '34e2b40582847652f2f9fa2e5fb07e00', 'http://localhost/toendacms_svn/toendacms/index.php/de/register.html', '2007-07-22 15:02:08'),
('localhost', '/toendacms_svn/toendacms/index.php/de/18e2a.html', 32, 'de672bfa0a98de09d2a0029cfe57713c', 'http://localhost/toendacms_svn/toendacms/index.php/de/register.html?cmd=lostpassword', '2007-07-22 15:03:57'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse&category=2f10f7cf479f1c5c227452d45d8ad9d9', 2, '9df7802eed7db848790aebccb805f456', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse', '2007-07-22 17:52:19'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&category=764f068e33673ecda7978c1a63b48294', 1, 'b1b3348fe38940419e3eba30483693b6', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=13482fa849ab1b901ababf3e3fc0bbab', '2007-07-22 15:27:59'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall', 4, '4156ef51a5c530bbaf1e321520958b28', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', '2007-07-22 17:53:24'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?ampaction=showall&amp:cmd=browse&category=', 2, '0c8a2eab0cc19542d55941943af924c7', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=browse', '2007-07-22 16:44:24'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', 25, '06b0dc0416988505ae294a81a0187740', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo-welt.html', '2007-07-26 00:56:07'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?ampaction=showall&cmd=browse&category=764f068e33673ecda7978c1a63b48294', 1, '720c3152fa00e3898771b52a65499c19', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?ampaction=showall&amp:cmd=browse&category=', '2007-07-22 16:44:28'),
('localhost', '/toendacms_svn/toendacms/?', 14, 'b62d8e8d2d282b232167dd98b335512c', 'http://localhost/toendacms_svn/toendacms/?', '2007-07-22 16:55:17'),
('localhost', '/toendacms_svn/toendacms/index.php/products.html?action=showall&category=9593610a4bd7f9e0fa31753648a9d08b', 1, '72c1d65d9bfc1004a912cc41e78ac2bc', 'http://localhost/toendacms_svn/toendacms/?', '2007-07-22 16:54:29'),
('localhost', '/toendacms_svn/toendacms/index.php/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', 1, '02368e01ea9cac14bd8789229015c704', 'http://localhost/toendacms_svn/toendacms/?', '2007-07-22 16:55:00'),
('localhost', '/toendacms_svn/toendacms/index.php/products.html?action=showall&cmd=browse&category=9593610a4bd7f9e0fa31753648a9d08b', 1, '80968a84a7377771e6c46c90f84f2705', 'http://localhost/toendacms_svn/toendacms/?', '2007-07-22 16:55:07'),
('localhost', '/toendacms_svn/toendacms/index.php/products.html?action=showall&cmd=browse&category=764f068e33673ecda7978c1a63b48294', 1, 'b1a3b87155b509c46a30f1069ea702f4', 'http://localhost/toendacms_svn/toendacms/?', '2007-07-22 16:55:21'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31/template/printer', 2, 'a2593285b1ee64aeff22e5eed876f41b', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', '2007-07-22 17:23:59'),
('localhost', '/toendacms_svn/toendacms/index.php/de/products.html?action=showall&cmd=latest', 12, 'b1a2df096ca8e1cbb4ffea732e873543', 'http://localhost/toendacms_svn/toendacms/index.php/de/products.html', '2007-07-26 21:09:13'),
('localhost', '/toendacms_svn/toendacms/index.php/de/produkte.html', 12, 'ef6f69277e12f3de93f22a386d94996c', 'http://localhost/toendacms_svn/toendacms/index.php/en/produkte.html?action=showall&cmd=offers', '2007-07-26 21:18:22'),
('localhost', '/toendacms_svn/toendacms/?id=contactform&item=adressbook&lang=de', 2, 'cea2fb3618fe135814a39c6a6fa590a1', 'http://localhost/toendacms_svn/toendacms/index.php/de/kontakt.html', '2007-07-26 21:19:40'),
('localhost', '/toendacms_svn/toendacms/index.php/de/contact.html?contact_email=max@musterman.com', 1, 'c167b97146bc22a4cb4d4c268a5ce2df', 'http://localhost/toendacms_svn/toendacms/?id=contactform&s=biz&item=adressbook&lang=de', '2007-07-24 00:43:52'),
('localhost', '/toendacms_svn/toendacms/index.php/de/startseite.html', 55, '0285065b14f191dd462c3bddcc2e945b', 'http://localhost/toendacms_svn/toendacms/index.php/de/gaestebuch.html', '2007-07-26 21:20:12'),
('localhost', '/toendacms_svn/toendacms/index.php/de/sub1.html', 1, '265119df08581bc6effb079e110e6d2b', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-24 19:28:48'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Lizenz.html', 11, '84a69ad593721ee75a97a408bba838bc', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-24 19:54:04'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-?-ss-Lizenz-aou-als-Text.html', 3, 'c8829a448141ab636233d204f3cb7707', 'http://localhost/toendacms_svn/toendacms/index.php/de/Lizenz.html', '2007-07-24 19:55:20'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Die-toendaCMS--ss-Lizenz-aou-als-Text.html', 16, '92394bed7b5640e7563a4ab471cce96d', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS--ss-Lizenz-aou-als-Text.html', '2007-07-24 20:04:13'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-ss-Lizenz-aou-als-Text.html', 16, '992035f98cbeb5e7ac8eec79ce073983', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS--ss-Lizenz-aou-als-Text.html', '2007-07-24 20:28:49'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz-als-Text.html', 31, '8d8f8e23a320a24087a2fbb62ec8a94c', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-24 23:16:18'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz-als-Text.html?id=18e2a&lang=de', 1, 'ac5783669bdb474ee88cc8c2642cb13c', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz-als-Text.html', '2007-07-24 21:36:24'),
('localhost', '/toendacms_svn/toendacms/index.php/en/Die-toendaCMS-Lizenz-als-Text.html', 2, '5de610215b82d3683322704c2955a7f0', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz-als-Text.html', '2007-07-24 21:53:28'),
('localhost', '/toendacms_svn/toendacms/index.php/en/startseite.html', 6, 'f02e0d1cb3f67661fac8171d19f2a2b8', 'http://localhost/toendacms_svn/toendacms/index.php/en/neuigkeiten.html', '2007-07-24 21:13:53'),
('localhost', '/toendacms_svn/toendacms/index.php/en/License.html', 23, 'd4f1ef15613c464da871fb2cd1504a8a', 'http://localhost/toendacms_svn/toendacms/index.php/en/Die-toendaCMS-Lizenz-als-Text.html', '2007-07-24 21:53:36'),
('localhost', '/toendacms_svn/toendacms/index.php/en/License.html?page=2', 1, '68500550f2c681eac64da6f20b45a2db', 'http://localhost/toendacms_svn/toendacms/index.php/en/License.html', '2007-07-24 21:13:37'),
('localhost', '/toendacms_svn/toendacms/index.php/en/License.html?page=4', 1, '22599806cf92c798ea75c5e50c5f2ea5', 'http://localhost/toendacms_svn/toendacms/index.php/en/License.html?page=2', '2007-07-24 21:13:41'),
('localhost', '/toendacms_svn/toendacms/index.php/en/neuigkeiten.html', 1, '22b2f2d39badad9a2bb48c8de33aaca8', 'http://localhost/toendacms_svn/toendacms/index.php/en/License.html?page=4', '2007-07-24 21:13:43'),
('localhost', '/toendacms_svn/toendacms/?id=18e2a&lang=de', 15, '95361c353fc5d45cf134af8c8a8422c6', 'http://localhost/toendacms_svn/toendacms/', '2007-07-25 23:23:39'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/styles/tcms_common.css', 3, 'fdf18bd253cca73969e5fd9ccb72ccf5', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:07'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/styles/tcms_editor.css', 3, 'f0806e505be32b11c7bedc2472174eda', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:08'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/antiframe.js', 3, '90aac5e38b0407e0fd5908e65e48a581', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:09'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/browsercheck.js', 3, '2151256651782dac51fc80625d392d12', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:11'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/jscrypt.js', 3, '9f5cbc64afd96131dff92958b45ffdd1', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:12'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/dhtml.js', 3, 'a167930eeb302d6baac414e3e8bf0193', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:13'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/edit.js', 3, '855e5fb4b6862cccddae8a276e767cd4', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:15'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/lightbox2/prototype.js', 3, '67e9d15974c47960e0254e894afa1279', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:16'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/lightbox2/scriptaculous.js?load=effects', 3, 'ccad811aa2cf0fe0e4379c3a7dc2ed93', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:17'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/lightbox2/lightbox.js', 2, '03d4b721387ba4195b131a438cae2cbd', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:18'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/js/lightbox2/css/lightbox.css', 2, '07c29bfb1916128fa667ce8a1abd6d16', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:19'),
('localhost', '/toendacms_svn/toendacms/index.php/de/theme/k2/images/k2_moz.css', 2, '409589c9915336a06189979629c8d167', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:20'),
('localhost', '/toendacms_svn/toendacms/?id=18e2a&lang=en', 1, 'a178d38a022bba7cfc3c836ad46527eb', 'http://localhost/toendacms_svn/toendacms/?id=18e2a&s=k2&lang=de', '2007-07-24 21:27:26'),
('localhost', '/toendacms_svn/toendacms/?id=frontpage&lang=en', 1, '1c3f6ea267e5068dfe8d172f5bcf60db', 'http://localhost/toendacms_svn/toendacms/?id=18e2a&s=k2&lang=en', '2007-07-24 21:27:40'),
('localhost', '/toendacms_svn/toendacms/index.php/de/License.html', 4, '5085385bca4f63574ba6f2bc2c25064a', 'http://localhost/toendacms_svn/toendacms/index.php/en/License.html', '2007-07-24 22:01:42'),
('localhost', '/toendacms_svn/toendacms/index.php//Die-toendaCMS-Lizenz-als-Text.htmlde', 3, 'a5b309545cf45f2c9a7925d69188d0f8', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz-als-Text.html', '2007-07-24 21:34:00'),
('localhost', '/toendacms_svn/toendacms/index.php//Die-toendaCMS-Lizenz-als-Text.htmlen', 1, 'a6161a647b5c42538f63c9b5d7e08d74', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz-als-Text.html', '2007-07-24 21:50:34'),
('localhost', '/toendacms_svn/toendacms/index.php/de/produkte.html?action=showall&cmd=browse&category=9593610a4bd7f9e0fa31753648a9d08b', 1, '988d1c766f7885c2fefc3e9cfe915a52', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html', '2007-07-24 22:11:39'),
('localhost', '/toendacms_svn/toendacms/index.php/de/produkte.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', 3, 'eeaf71cf91eae3f28c17938023055c0f', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html?action=showall&category=2f10f7cf479f1c5c227452d45d8ad9d9', '2007-07-26 21:18:59'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten.html?news=90ac2e39eb', 1, 'b5df53f564f6ff0182a557e52e98b497', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-24 22:13:56'),
('localhost', '/toendacms_svn/toendacms/index.php/en/produkte.html', 8, '5b6b6b91a5b4ad0281317d35ae09a382', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html', '2007-07-26 21:17:59'),
('localhost', '/toendacms_svn/toendacms/index.php/admin.html', 1, '7b67772d0dcdc05c6cf0bc4578bb5fc7', '', '2007-07-24 22:15:25'),
('localhost', '/toendacms_svn/toendacms/index.php/de/cs.html?item=domainchecker', 13, '717286cafe175a45b405847354a192fb', 'http://localhost/toendacms_svn/toendacms/index.php/de/cs.html?item=domainchecker', '2007-07-24 23:13:51'),
('localhost', '/toendacms_svn/toendacms/index.php/de/cs.html?item=tcmsshop', 1, '6e7ee4f6b92f92f4adbe1cbb550d1c79', 'http://localhost/toendacms_svn/toendacms/index.php/de/cs.html?item=domainchecker', '2007-07-24 22:56:18'),
('localhost', '/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz.html', 10, '4c3098c677ce6d158403877f552404dd', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html?action=showall&category=9593610a4bd7f9e0fa31753648a9d08b', '2007-07-26 21:19:32'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo-welt.html', 18, '3654c8930a389dff462931f9dbbcde13', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-26 00:56:32'),
('localhost', '/toendacms_svn/toendacms/index.php/de/anmeldung.html', 1, 'cfa5e1a822cd4072e716ac49d98bcba7', 'http://localhost/toendacms_svn/toendacms/index.php/de/Die-toendaCMS-Lizenz.html', '2007-07-25 01:22:33'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/flags/en.png', 1, 'ff3478f5f6efa1a55929df6ab5952e4c', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:22'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/flags/de.png', 1, '8ceb2458c7bf93ea6ae0b8115ab7d9bc', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:22'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/logos/f_rss091.png', 1, '9ddee94da1e5a862a9c503f6c84fd97b', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:23'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/flags/nl.png', 1, '00fc9c41a77c2744217e4acce605c32a', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:24'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/logos/f_rss10.png', 1, 'c3b421d78555050ffd77d721429641f6', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:26'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/logos/f_rss20.png', 1, 'a00b54cf177f12843d668ba6d72717df', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:28'),
('localhost', '/toendacms_svn/toendacms/index.php/de/engine/images/logos/atom03.gif', 1, '92a64cfde59bca30b5807d680b9c357f', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-25 23:23:29'),
('localhost', '/toendacms_svn/toendacms/index.php/de/startseite.html?session=45645645645645645645645645645645', 3, '8fe743cb0ccfe0359eba80263c3862f0', '', '2007-07-25 23:42:05'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo.html', 8, 'baa9128613807689f3b826afd1325e9f', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-26 00:02:05'),
('localhost', '/toendacms_svn/toendacms/index.php/en/news/hello-world.html', 96, '5c92bef3bd70bc546ca94933b0db8bb6', 'http://localhost/toendacms_svn/toendacms/index.php/en/news.html?cat=erdf4', '2007-07-26 20:39:48'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten.html?cat=erdf4', 1, '675b36c92752dc8c2fd4f4f5aaa60d25', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-26 00:14:40'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo-welt-ich-bins.html', 1, '4f5036e1f4bec78c1e4eff3ed23d35a9', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:02:48'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo-welt2.html', 1, '7559051a2108cde11799005ec27501c0', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:11:32'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/das-fussball-stockchen....html', 3, '2e07940d9e7ddcf18596d8f977dddba7', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo-welt.html', '2007-07-26 00:34:53'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/toendacms-commit-12-16-alpha.html', 1, '517b52877c5b3a2df9eb04a929415f47', 'http://localhost/toendacms_svn/toendacms/index.php/de/startseite.html', '2007-07-26 00:29:14'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/toendacms-commit-12-1.6-alpha.html', 1, '3c6c1d480f5ec4b66d3078a63cacfee0', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:31:50'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/hallo-welt!.html', 1, 'aa0398b9ad4fe913fd0c0793a909018a', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:30:57'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/die-toendacms-lizenz-aeoeue-als-text.html', 3, 'e426e989e48a77f782e01c30777fedd0', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:55:37'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/das-fussball-st-ckchen....html', 1, '9e181a7b9252c86bd6c57395956b3a1c', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:32:34'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/das-fussball-stoeckchen....html', 7, '544df3a680def4f462255955ac67e253', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten.html', '2007-07-26 00:51:38'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/das-fussball-st%F6ckchen....html', 2, 'bd11dc9bc61767d18cadf6a216768255', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten/das-fussball-stoeckchen....html', '2007-07-26 00:36:13'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/die-toendacms-lizenz-%E4%F6%FC-als-text.html', 2, 'd1c29ed6a77cff0cfad069921d35d7ab', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten/die-toendacms-lizenz-aeoeue-als-text.html', '2007-07-26 00:55:53'),
('localhost', '/toendacms_svn/toendacms/index.php/de/neuigkeiten/die-toendacms-lizenz-als-text.html', 1, '2dd572783e166fa2ccfcff8b3c8fcbf6', 'http://localhost/toendacms_svn/toendacms/index.php/de/neuigkeiten/die-toendacms-lizenz-%E4%F6%FC-als-text.html', '2007-07-26 00:55:57'),
('localhost', '/toendacms_svn/toendacms/index.php/en/news.html?cat=erdf4', 6, '924aa3e5d9a41282a745aa235ea37aad', 'http://localhost/toendacms_svn/toendacms/index.php/en/frontpage.html', '2007-07-26 20:47:18'),
('localhost', '/toendacms_svn/toendacms/index.php/en/frontpage.html', 7, '9b3eddaa12673cac90456855a8aea990', 'http://localhost/toendacms_svn/toendacms/index.php/en/frontpage.html', '2007-07-26 21:08:40'),
('localhost', '/toendacms_svn/toendacms/index.php/de/galerie.html', 2, 'f07f11da2868507b5af2c6e47959ddd4', 'http://localhost/toendacms_svn/toendacms/', '2007-07-26 21:12:28'),
('localhost', '/toendacms_svn/toendacms/index.php/nl/produkte.html', 1, '5640fa7774653ac445dc1c296bfc62d4', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html', '2007-07-26 21:15:04'),
('localhost', '/toendacms_svn/toendacms/index.php/en/produkte.html?action=showall&cmd=latest', 1, 'f82c141f854a4a616e0266581b0d6bdf', 'http://localhost/toendacms_svn/toendacms/index.php/en/produkte.html', '2007-07-26 21:18:15'),
('localhost', '/toendacms_svn/toendacms/index.php/en/produkte.html?action=showall&cmd=offers', 1, '46b42247e8b593eaf225d57e5e7bcaf7', 'http://localhost/toendacms_svn/toendacms/index.php/en/produkte.html?action=showall&cmd=latest', '2007-07-26 21:18:18'),
('localhost', '/toendacms_svn/toendacms/index.php/de/produkte.html?action=showone&article=32acfdf114279d275709c2e277341b5c', 1, '1eb4e97f6f00516152481393915ad524', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html', '2007-07-26 21:18:39'),
('localhost', '/toendacms_svn/toendacms/index.php/de/produkte.html?action=showall&category=2f10f7cf479f1c5c227452d45d8ad9d9', 1, '9983a0da5f41dfb299a3716ba36f2579', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html?action=showone&article=32acfdf114279d275709c2e277341b5c', '2007-07-26 21:18:47'),
('localhost', '/toendacms_svn/toendacms/index.php/de/produkte.html?action=showall&category=9593610a4bd7f9e0fa31753648a9d08b', 1, '49c051a2f1b8c4d7439f72483f23cda1', 'http://localhost/toendacms_svn/toendacms/index.php/de/produkte.html?action=showone&article=b0b14e7381294e263b72a0c9d65b9f31', '2007-07-26 21:19:23'),
('localhost', '/toendacms_svn/toendacms/index.php/de/kontakt.html', 1, '8dd73542e571164eb142db0c1879d1cf', 'http://localhost/toendacms_svn/toendacms/index.php/de/die-toendacms-lizenz.html', '2007-07-26 21:19:35'),
('localhost', '/toendacms_svn/toendacms/?id=contactform&lang=de', 1, 'eaaf80144f6d7b59273d3a5b165c8ad6', 'http://localhost/toendacms_svn/toendacms/?id=contactform&s=k2&item=adressbook&lang=de', '2007-07-26 21:19:45'),
('localhost', '/toendacms_svn/toendacms/index.php/de/gaestebuch.html', 1, 'a440a8291ecf0ee635368c43763d1e94', 'http://localhost/toendacms_svn/toendacms/?id=contactform&s=k2&lang=de', '2007-07-26 21:19:55'),
('localhost', '/toendacms_svn/toendacms/index.php?session=8679d01a141da142f1f261ec75a0063f', 1, '261c05c91373e1e2bdee50e03ff5f61c', 'http://localhost/toendacms_svn/toendacms/engine/admin/admin.php?id_user=8679d01a141da142f1f261ec75a0063f&site=mod_global', '2007-07-27 00:41:11');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_statistics_ip`
-- 

CREATE TABLE `blog_statistics_ip` (
  `uid` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `value` int(10) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_statistics_ip`
-- 

INSERT INTO `blog_statistics_ip` (`uid`, `ip`, `value`) VALUES ('a84573f07ee669969e4cc7b88b0f6c4b', '127.0.0.1', 29),
('a0cdf664ad4b7de524521df9a378629e', '127.0.0.1', 3),
('4d22a521425317f0226508b3f9812534', '127.0.0.1', 25),
('c0e26a49eae98b0cff8342aa5902ea5b', '127.0.0.1', 17),
('a5b068f6649021a1a859e1656e9b645b', '127.0.0.1', 1),
('8621a52928b1fb24fc5e63e6b6e90f55', '127.0.0.1', 1),
('4a47ecce2e92bd4ba9cce60f11874b3b', '127.0.0.1', 25),
('b9a80edb7130d2ab89a53e1b01faebcb', '127.0.0.1', 13),
('cf3ca668c92f1f76dd18feab3b22e728', '127.0.0.1', 6),
('c7cecdcd46d877fcf1f906ab4814e0b5', '127.0.0.1', 6),
('17f658782466bbd78e35b4ce6f6547ad', '127.0.0.1', 1),
('2dfe93296e35b9201a4b2f9758667180', '127.0.0.1', 1),
('2b132273c7964b41a5601049a941cba4', '127.0.0.1', 6),
('7f058f8273d5e768001db28dfc38bff8', '127.0.0.1', 13),
('426a7666ff4aab21513aa810e8ab2cdd', '127.0.0.1', 25),
('63a1b92ef572ffbf523db284e4405863', '127.0.0.1', 25),
('a5227af2c49fb901f9b239c3150a487e', '127.0.0.1', 11),
('bb015c782df94918ea06163483b682ac', '127.0.0.1', 8),
('a499da6798767e9ef98af0d350eee3ab', '127.0.0.1', 8),
('4d49ab4e698facfaa7fa4f15f94bd252', '127.0.0.1', 1),
('c9c5c03f05c47a7c94abc394166b65a7', '127.0.0.1', 1),
('1e36e7539f47da63985a033b26f620a2', '127.0.0.1', 1),
('ee35f40171c79c69a15ed5640897ba1d', '127.0.0.1', 10),
('ba53a180993a4fc7fb084b46bec7b7ef', '127.0.0.1', 14),
('c6d433ad1c4abae569742d044e8711c7', '127.0.0.1', 14),
('222b9ad1d9f120df613f27499ca25b3d', '127.0.0.1', 14),
('efaf1a0d9285d82864e66b0034922307', '127.0.0.1', 13),
('11d211092a423cea1d7acd6240018183', '127.0.0.1', 11),
('5389a6b1b1f7d737da925e1b0f772c07', '127.0.0.1', 11),
('a96b61be92c40858c8af2bb7ef9f7ab1', '127.0.0.1', 13),
('d2c1a2f84929d5404ccdca6e361044d0', '127.0.0.1', 13),
('34e2b40582847652f2f9fa2e5fb07e00', '127.0.0.1', 13),
('de672bfa0a98de09d2a0029cfe57713c', '127.0.0.1', 13),
('6c133e844d47d3a6b8a4610979515e49', '127.0.0.1', 1),
('32f62133019e9e59e218310ca11fcccc', '127.0.0.1', 1),
('b8a74731df6ff25d7df998acd6f49b96', '127.0.0.1', 14),
('b1b3348fe38940419e3eba30483693b6', '127.0.0.1', 1),
('4156ef51a5c530bbaf1e321520958b28', '127.0.0.1', 13),
('9df7802eed7db848790aebccb805f456', '127.0.0.1', 13),
('0c8a2eab0cc19542d55941943af924c7', '127.0.0.1', 13),
('720c3152fa00e3898771b52a65499c19', '127.0.0.1', 1),
('b62d8e8d2d282b232167dd98b335512c', '127.0.0.1', 13),
('72c1d65d9bfc1004a912cc41e78ac2bc', '127.0.0.1', 1),
('02368e01ea9cac14bd8789229015c704', '127.0.0.1', 1),
('80968a84a7377771e6c46c90f84f2705', '127.0.0.1', 1),
('b1a3b87155b509c46a30f1069ea702f4', '127.0.0.1', 1),
('a2593285b1ee64aeff22e5eed876f41b', '127.0.0.1', 13),
('b1a2df096ca8e1cbb4ffea732e873543', '127.0.0.1', 25),
('cea2fb3618fe135814a39c6a6fa590a1', '127.0.0.1', 27),
('c167b97146bc22a4cb4d4c268a5ce2df', '127.0.0.1', 1),
('06b0dc0416988505ae294a81a0187740', '127.0.0.1', 23),
('0285065b14f191dd462c3bddcc2e945b', '127.0.0.1', 27),
('265119df08581bc6effb079e110e6d2b', '127.0.0.1', 1),
('84a69ad593721ee75a97a408bba838bc', '127.0.0.1', 15),
('c8829a448141ab636233d204f3cb7707', '127.0.0.1', 15),
('92394bed7b5640e7563a4ab471cce96d', '127.0.0.1', 15),
('992035f98cbeb5e7ac8eec79ce073983', '127.0.0.1', 15),
('8d8f8e23a320a24087a2fbb62ec8a94c', '127.0.0.1', 17),
('5de610215b82d3683322704c2955a7f0', '127.0.0.1', 17),
('f02e0d1cb3f67661fac8171d19f2a2b8', '127.0.0.1', 15),
('d4f1ef15613c464da871fb2cd1504a8a', '127.0.0.1', 17),
('68500550f2c681eac64da6f20b45a2db', '127.0.0.1', 1),
('22599806cf92c798ea75c5e50c5f2ea5', '127.0.0.1', 1),
('22b2f2d39badad9a2bb48c8de33aaca8', '127.0.0.1', 1),
('95361c353fc5d45cf134af8c8a8422c6', '127.0.0.1', 20),
('fdf18bd253cca73969e5fd9ccb72ccf5', '127.0.0.1', 19),
('f0806e505be32b11c7bedc2472174eda', '127.0.0.1', 19),
('90aac5e38b0407e0fd5908e65e48a581', '127.0.0.1', 19),
('2151256651782dac51fc80625d392d12', '127.0.0.1', 19),
('9f5cbc64afd96131dff92958b45ffdd1', '127.0.0.1', 19),
('a167930eeb302d6baac414e3e8bf0193', '127.0.0.1', 19),
('855e5fb4b6862cccddae8a276e767cd4', '127.0.0.1', 19),
('67e9d15974c47960e0254e894afa1279', '127.0.0.1', 19),
('ccad811aa2cf0fe0e4379c3a7dc2ed93', '127.0.0.1', 19),
('03d4b721387ba4195b131a438cae2cbd', '127.0.0.1', 19),
('07c29bfb1916128fa667ce8a1abd6d16', '127.0.0.1', 19),
('409589c9915336a06189979629c8d167', '127.0.0.1', 19),
('a178d38a022bba7cfc3c836ad46527eb', '127.0.0.1', 1),
('1c3f6ea267e5068dfe8d172f5bcf60db', '127.0.0.1', 1),
('5085385bca4f63574ba6f2bc2c25064a', '127.0.0.1', 17),
('a5b309545cf45f2c9a7925d69188d0f8', '127.0.0.1', 17),
('ac5783669bdb474ee88cc8c2642cb13c', '127.0.0.1', 1),
('a6161a647b5c42538f63c9b5d7e08d74', '127.0.0.1', 1),
('ef6f69277e12f3de93f22a386d94996c', '127.0.0.1', 27),
('988d1c766f7885c2fefc3e9cfe915a52', '127.0.0.1', 1),
('eeaf71cf91eae3f28c17938023055c0f', '127.0.0.1', 27),
('b5df53f564f6ff0182a557e52e98b497', '127.0.0.1', 1),
('7b67772d0dcdc05c6cf0bc4578bb5fc7', '127.0.0.1', 1),
('717286cafe175a45b405847354a192fb', '127.0.0.1', 17),
('6e7ee4f6b92f92f4adbe1cbb550d1c79', '127.0.0.1', 1),
('4c3098c677ce6d158403877f552404dd', '127.0.0.1', 27),
('cfa5e1a822cd4072e716ac49d98bcba7', '127.0.0.1', 1),
('ff3478f5f6efa1a55929df6ab5952e4c', '127.0.0.1', 1),
('8ceb2458c7bf93ea6ae0b8115ab7d9bc', '127.0.0.1', 1),
('9ddee94da1e5a862a9c503f6c84fd97b', '127.0.0.1', 1),
('00fc9c41a77c2744217e4acce605c32a', '127.0.0.1', 1),
('c3b421d78555050ffd77d721429641f6', '127.0.0.1', 1),
('a00b54cf177f12843d668ba6d72717df', '127.0.0.1', 1),
('92a64cfde59bca30b5807d680b9c357f', '127.0.0.1', 1),
('8fe743cb0ccfe0359eba80263c3862f0', '127.0.0.1', 20),
('3654c8930a389dff462931f9dbbcde13', '127.0.0.1', 23),
('baa9128613807689f3b826afd1325e9f', '127.0.0.1', 20),
('4f5036e1f4bec78c1e4eff3ed23d35a9', '127.0.0.1', 1),
('7559051a2108cde11799005ec27501c0', '127.0.0.1', 1),
('675b36c92752dc8c2fd4f4f5aaa60d25', '127.0.0.1', 1),
('517b52877c5b3a2df9eb04a929415f47', '127.0.0.1', 1),
('aa0398b9ad4fe913fd0c0793a909018a', '127.0.0.1', 1),
('3c6c1d480f5ec4b66d3078a63cacfee0', '127.0.0.1', 1),
('9e181a7b9252c86bd6c57395956b3a1c', '127.0.0.1', 1),
('2e07940d9e7ddcf18596d8f977dddba7', '127.0.0.1', 23),
('544df3a680def4f462255955ac67e253', '127.0.0.1', 23),
('bd11dc9bc61767d18cadf6a216768255', '127.0.0.1', 23),
('e426e989e48a77f782e01c30777fedd0', '127.0.0.1', 23),
('d1c29ed6a77cff0cfad069921d35d7ab', '127.0.0.1', 23),
('2dd572783e166fa2ccfcff8b3c8fcbf6', '127.0.0.1', 1),
('5c92bef3bd70bc546ca94933b0db8bb6', '127.0.0.1', 25),
('924aa3e5d9a41282a745aa235ea37aad', '127.0.0.1', 25),
('9b3eddaa12673cac90456855a8aea990', '127.0.0.1', 25),
('f07f11da2868507b5af2c6e47959ddd4', '127.0.0.1', 27),
('5b6b6b91a5b4ad0281317d35ae09a382', '127.0.0.1', 27),
('5640fa7774653ac445dc1c296bfc62d4', '127.0.0.1', 1),
('f82c141f854a4a616e0266581b0d6bdf', '127.0.0.1', 1),
('46b42247e8b593eaf225d57e5e7bcaf7', '127.0.0.1', 1),
('1eb4e97f6f00516152481393915ad524', '127.0.0.1', 1),
('9983a0da5f41dfb299a3716ba36f2579', '127.0.0.1', 1),
('49c051a2f1b8c4d7439f72483f23cda1', '127.0.0.1', 1),
('8dd73542e571164eb142db0c1879d1cf', '127.0.0.1', 1),
('eaaf80144f6d7b59273d3a5b165c8ad6', '127.0.0.1', 1),
('a440a8291ecf0ee635368c43763d1e94', '127.0.0.1', 1),
('261c05c91373e1e2bdee50e03ff5f61c', '127.0.0.1', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_statistics_os`
-- 

CREATE TABLE `blog_statistics_os` (
  `uid` varchar(32) NOT NULL default '',
  `browser` varchar(255) default NULL,
  `os` varchar(255) default NULL,
  `value` int(10) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_statistics_os`
-- 

INSERT INTO `blog_statistics_os` (`uid`, `browser`, `os`, `value`) VALUES ('552d3d91be3151ca77252cebdde54c42', 'Mozilla Firefox 2.0.0.4', 'Microsoft Windows Vista', 239),
('7b19a04af96b56d341cb89953696b04f', 'Mozilla Firefox 2.0.0.5', 'Microsoft Windows Vista', 1142),
('65f1e8e545be6d47cb70ebe4770988fe', 'Microsoft Internet Explorer 7.0', 'Microsoft Windows Vista', 82);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_topmenu`
-- 

CREATE TABLE `blog_topmenu` (
  `uid` varchar(5) NOT NULL,
  `language` varchar(25) NOT NULL,
  `name` varchar(255) default NULL,
  `id` int(4) NOT NULL default '0',
  `type` varchar(10) default NULL,
  `link` varchar(255) default NULL,
  `published` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `target` varchar(20) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_topmenu`
-- 

INSERT INTO `blog_topmenu` (`uid`, `language`, `name`, `id`, `type`, `link`, `published`, `access`, `target`) VALUES ('1fbae', 'english_EN', 'Home', 0, 'link', 'frontpage', 1, 'Public', ''),
('3c6d9', 'english_EN', 'News', 1, 'link', 'newsmanager', 1, 'Public', ''),
('d2112', 'english_EN', 'Downloads', 2, 'link', 'download', 1, 'Public', ''),
('706b2', 'english_EN', 'Gallery', 3, 'link', 'imagegallery', 1, 'Public', ''),
('7e31e', 'germany_DE', 'Startseite', 7, 'link', 'frontpage', 1, 'Public', ''),
('61c34', 'germany_DE', 'Neuigkeiten', 8, 'link', 'newsmanager', 1, 'Public', ''),
('f39c7', 'germany_DE', 'Downloads', 9, 'link', 'download', 1, 'Public', ''),
('ac64b', 'germany_DE', 'Gallery', 10, 'link', 'imagegallery', 1, 'Public', ''),
('87f51', 'germany_DE', 'Produkte', 11, 'link', 'products', 1, 'Public', ''),
('fb2ee', 'germany_DE', 'FAQ', 12, 'link', 'knowledgebase', 1, 'Public', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_user`
-- 

CREATE TABLE `blog_user` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `username` varchar(255) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `group` varchar(32) NOT NULL,
  `join_date` varchar(19) NOT NULL default '',
  `last_login` varchar(19) default NULL,
  `birthday` varchar(10) default NULL,
  `gender` varchar(5) NOT NULL default '',
  `occupation` varchar(255) default NULL,
  `homepage` varchar(255) default NULL,
  `icq` varchar(20) default NULL,
  `aim` varchar(20) default NULL,
  `yim` varchar(20) default NULL,
  `msn` varchar(20) default NULL,
  `skype` varchar(100) default '',
  `enabled` int(1) NOT NULL default '0',
  `tcms_enabled` int(1) NOT NULL default '0',
  `static_value` int(1) NOT NULL default '0',
  `signature` text,
  `location` varchar(255) default NULL,
  `hobby` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `blog_user`
-- 

INSERT INTO `blog_user` (`uid`, `name`, `username`, `password`, `email`, `group`, `join_date`, `last_login`, `birthday`, `gender`, `occupation`, `homepage`, `icq`, `aim`, `yim`, `msn`, `skype`, `enabled`, `tcms_enabled`, `static_value`, `signature`, `location`, `hobby`) VALUES ('ccdc5cfffaf3cd9342e40dd9dcb3a3ff', 'Dolly', 'root', '5473e3f141e0328ce87dac9366e0aace', 'info@toenda.com', 'Administrator', '2006.01.22-22:26:44', '2007.08.30-22:43:05', '26.11.1982', '-', '', 'http://www.vandango.org', '', '', '', '', '', 1, 1, 1, '', '', ''),
('9e07ddbe2eb87663511e4716cb94eef2', 'writer', 'writer', 'a82feee3cc1af8bcabda979e8775ef0f', 'info@toenda.com', 'Writer', '2006.08.21-23:09:14', '2006.10.06-20:43:46', '01.1.', '-', '', '', '', '', '', '', '', 1, 1, 0, '', '', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_usergroup`
-- 

CREATE TABLE `blog_usergroup` (
  `uid` varchar(32) collate utf8_unicode_ci NOT NULL,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `right` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Daten für Tabelle `blog_usergroup`
-- 

INSERT INTO `blog_usergroup` (`uid`, `name`, `right`) VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3),
('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2),
('daf91e6be506252b897977537fa488c8', 'Developer', 0),
('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1),
('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4),
('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `blog_userpage`
-- 

CREATE TABLE `blog_userpage` (
  `uid` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `text_width` varchar(5) collate utf8_unicode_ci default NULL,
  `input_width` varchar(5) collate utf8_unicode_ci default NULL,
  `news_publish` int(1) NOT NULL default '0',
  `image_publish` int(1) NOT NULL default '0',
  `album_publish` int(1) NOT NULL default '0',
  `cat_publish` int(1) NOT NULL default '0',
  `pic_publish` char(1) collate utf8_unicode_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Daten für Tabelle `blog_userpage`
-- 

INSERT INTO `blog_userpage` (`uid`, `text_width`, `input_width`, `news_publish`, `image_publish`, `album_publish`, `cat_publish`, `pic_publish`) VALUES ('userpage', '150', '150', 1, 1, 1, 1, '1');
