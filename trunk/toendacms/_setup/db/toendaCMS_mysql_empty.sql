-- phpMyAdmin SQL Dump
-- version 2.8.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 17. Februar 2007 um 01:11
-- Server Version: 5.0.21
-- PHP-Version: 5.2.1
-- 
-- Datenbank: `tcms_blog`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####albums`
-- 

CREATE TABLE `#####albums` (
  `uid` varchar(12) NOT NULL default '',
  `title` varchar(255) default NULL,
  `album_id` varchar(6) NOT NULL default '',
  `published` int(1) NOT NULL default '0',
  `desc` text,
  `image` varchar(255) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####albums`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####comments`
-- 

CREATE TABLE `#####comments` (
  `uid` varchar(10) NOT NULL default '',
  `module` varchar(5) NOT NULL default '',
  `timestamp` varchar(14) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) default NULL,
  `web` varchar(255) default NULL,
  `msg` text,
  `time` varchar(14) NOT NULL default '',
  `ip` varchar(15) default NULL,
  `domain` varchar(255) default NULL,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####comments`
-- 

INSERT INTO `#####comments` (`uid`, `module`, `timestamp`, `name`, `email`, `web`, `msg`, `time`, `ip`, `domain`) VALUES ('c4c846e167', 'news', '20051126005016', 'vandango', 'vandango@toenda.com', 'http://vandango.org', 'This is a test comment ...', '20051126005016', '127.0.0.1', 'localhost');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####contactform`
-- 

CREATE TABLE `#####contactform` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####contactform`
-- 

INSERT INTO `#####contactform` (`uid`, `language`, `contact`, `show_contacts_in_sidebar`, `send_id`, `contacttitle`, `contactstamp`, `contacttext`, `access`, `enabled`, `use_adressbook`, `use_contact`, `show_contactemail`) VALUES ('contactform', 'english_EN', 'info@toenda.com', 0, 'contactform', 'Contact Us and ...', '... send us a message.', 'my contacttext&lt;br /&gt;\r\n', 'Public', 1, 1, 1, 1),
('196716e11c5', 'germany_DE', 'info@toenda.com', 0, 'contactform', 'Kontaktformular', '', 'Und ein wenig Text ...\r\n', 'Public', 1, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####contacts`
-- 

CREATE TABLE `#####contacts` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####contacts`
-- 

INSERT INTO `#####contacts` (`uid`, `default_con`, `published`, `name`, `position`, `email`, `street`, `country`, `state`, `town`, `postal`, `phone`, `fax`) VALUES ('10a1b5f6ab', 1, 1, 'Max Musterman', 'CEO', 'max@musterman.com', 'Musterstrasse 123', 'Deutschland', '', 'Musterstadt', 28203, '', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####content`
-- 

CREATE TABLE `#####content` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####content`
-- 

INSERT INTO `#####content` (`uid`, `title`, `key`, `content00`, `content01`, `foot`, `db_layout`, `access`, `in_work`, `published`, `autor`, `language`) VALUES ('18e2a', 'License', 'toendaCMS &amp; GNU General Public License', '&lt;div align__________&quot;center&quot;&gt;&lt;strong&gt;GNU General Public License&lt;/strong&gt;&lt;/div&gt; &lt;div align__________&quot;center&quot;&gt;     &lt;em&gt;Version 2, June 1991&lt;/em&gt;     1989, 1991 Free Software Foundation, Inc. &lt;br /&gt;  Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA, 02111-1307, USA &lt;br /&gt;  Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed. &lt;br /&gt;  Version 2, June 1991&lt;/div&gt; &lt;br /&gt; &lt;h2&gt;GNU General Public License&lt;/h2&gt; &lt;br /&gt; &lt;p&gt;&lt;strong&gt;&lt;img src__________&quot;http://localhost/toendacms/data/images/Image/osi-certified-120x100.png&quot; border__________&quot;0&quot; alt__________&quot;&quot; hspace__________&quot;4&quot; width__________&quot;120&quot; height__________&quot;100&quot; align__________&quot;left&quot; /&gt;Preamble&lt;/strong&gt; The licenses for most software are designed to take away your freedom to share and change it. By contrast, the GNU General Public License is intended to guarantee your freedom to share and changefree software - to make sure the software is free for all its users. This General Public License applies to most of the Free Software Foundation&amp;#39;s software and to any other program whose authors commit to using it. (Some other Free Software Foundation software is covered by the GNU Library General Public License instead.) You can apply it to your programs, too. &lt;br /&gt;  &lt;br /&gt;  When we speak of free software, we are referring to freedom, not price. Our General Public Licenses are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things. &lt;br /&gt;  &lt;br /&gt;  To protect your rights, we need to make restrictions that forbid anyone to deny you these rights or to ask you to surrender the rights. These restrictions translate to certain responsibilities for you if you distribute copies of the software, or if you modify it. &lt;br /&gt;  &lt;br /&gt;  For example, if you distribute copies of such a program, whether gratis or for a fee, you must give the recipients all the rights that you have. You must make sure that they, too, receive or can get the source code. And you must show them these terms so they know their rights. &lt;br /&gt;  &lt;br /&gt;  We protect your rights with two steps: &lt;br /&gt;  &lt;/p&gt; &lt;ul&gt;     &lt;li&gt;copyright the software, and&lt;/li&gt;     &lt;li&gt;offer you this license which gives you legal permission to copy, distribute and/or modify the software.&lt;/li&gt; &lt;/ul&gt; Also, for each author&amp;#39;s protection and ours, we want to make certain that everyone understands that there is no warranty for this free software. If the software is modified by someone else and passed on, we want its recipients to know that what they have is not the original, so that any problems introduced by others will not reflect on the original authors&amp;#39; reputations. &lt;br /&gt;  &lt;br /&gt;  Finally, any free program is threatened constantly by software patents. We wish to avoid the danger that redistributors of a free program will individually obtain patent licenses, in effect making the program proprietary. To prevent this, we have made it clear that any patent must be licensed for everyone&amp;#39;s free use or not licensed at all. &lt;br /&gt;  &lt;br /&gt;  The precise terms and conditions for copying, distribution and modification follow.  {tcms_more}&lt;br /&gt;  &lt;strong&gt;TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION&lt;/strong&gt;    &lt;strong&gt;Section 0&lt;/strong&gt; This License applies to any program or other work which contains a notice placed by the copyright holder saying it may be distributed under the terms of this General Public License. The &quot;Program&quot;, below, refers to any such program or work, and a work based on the Program means either the Program or any derivative work under copyright law: that is to say, a work containing the Program or a portion of it, either verbatim or with modifications and/or translated into another language. (Hereinafter, translation is included without limitation in the term modification .) Each licensee is addressed as you. &lt;br /&gt;  &lt;br /&gt;  Activities other than copying, distribution and modification are not covered by this License; they are outside its scope. The act of running the Program is not restricted, and the output from the Program is covered only if its contents constitute a work based on the Program (independent of having been made by running the Program). Whether that is true depends on what the Program does. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 1&lt;/strong&gt; You may copy and distribute verbatim copies of the Program&amp;#39;s source code as you receive it, in any medium, provided that you conspicuously and appropriately publish on each copy an appropriate copyright notice and disclaimer of warranty; keep intact all the notices that refer to this License and to the absence of any warranty; and give any other recipients of the Program a copy of this License along with the Program. &lt;br /&gt;  &lt;br /&gt;  You may charge a fee for the physical act of transferring a copy, and you may at your option offer warranty protection in exchange for a fee. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 2&lt;/strong&gt; You may modify your copy or copies of the Program or any portion of it, thus forming a work based on the Program, and copy and distribute such modifications or work under the terms of Section 1 above, provided that you also meet all of these conditions: &lt;br /&gt;  &lt;br /&gt;  You must cause the modified files to carry prominent notices stating that you changed the files and the date of any change. &lt;br /&gt;  &lt;br /&gt;  You must cause any work that you distribute or publish, that in whole or in part contains or is derived from the Program or any part thereof, to be licensed as a whole at no charge to all third parties under the terms of this License. &lt;br /&gt;  &lt;br /&gt;  If the modified program normally reads commands interactively when run, you must cause it, when started running for such interactive use in the most ordinary way, to print or display an announcement including an appropriate copyright notice and a notice that there is no warranty (or else, saying that you provide a warranty) and that users may redistribute the program under these conditions, and telling the user how to view a copy of this License. &lt;br /&gt;  &lt;br /&gt;  Exception: &lt;br /&gt;  &lt;br /&gt;  If the Program itself is interactive but does not normally print such an announcement, your work based on the Program is not required to print an announcement.) &lt;br /&gt;  &lt;br /&gt;  These requirements apply to the modified work as a whole. If identifiable sections of that work are not derived from the Program, and can be reasonably considered independent and separate works in themselves, then this License, and its terms, do not apply to those sections when you distribute them as separate works. But when you distribute the same sections as part of a whole which is a work based on the Program, the distribution of the whole must be on the terms of this License, whose permissions for other licensees extend to the entire whole, and thus to each and every part regardless of who wrote it. &lt;br /&gt;  &lt;br /&gt;  Thus, it is not the intent of this section to claim rights or contest your rights to work written entirely by you; rather, the intent is to exercise the right to control the distribution of derivative or collective works based on the Program. &lt;br /&gt;  &lt;br /&gt;  In addition, mere aggregation of another work not based on the Program with the Program (or with a work based on the Program) on a volume of a storage or distribution medium does not bring the other work under the scope of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 3&lt;/strong&gt; You may copy and distribute the Program (or a work based on it, under Section 2 in object code or executable form under the terms of Sections 1 and 2 above provided that you also do one of the following: &lt;br /&gt;  &lt;br /&gt;  Accompany it with the complete corresponding machine-readable source code, which must be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or, &lt;br /&gt;  &lt;br /&gt;  Accompany it with a written offer, valid for at least three years, to give any third party, for a charge no more than your cost of physically performing source distribution, a complete machine-readable copy of the corresponding source code, to be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or, &lt;br /&gt;  &lt;br /&gt;  Accompany it with the information you received as to the offer to distribute corresponding source code. (This alternative is allowed only for noncommercial distribution and only if you received the program in object code or executable form with such an offer, in accord with Subsection b above.) &lt;br /&gt;  &lt;br /&gt;  The source code for a work means the preferred form of the work for making modifications to it. For an executable work, complete source code means all the source code for all modules it contains, plus any associated interface definition files, plus the scripts used to control compilation and installation of the executable. However, as a special exception, the source code distributed need not include anything that is normally distributed (in either source or binary form) with the major components (compiler, kernel, and so on) of the operating system on which the executable runs, unless that component itself accompanies the executable. &lt;br /&gt;  &lt;br /&gt;  If distribution of executable or object code is made by offering access to copy from a designated place, then offering equivalent access to copy the source code from the same place counts as distribution of the source code, even though third parties are not compelled to copy the source along with the object code. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 4&lt;/strong&gt; You may not copy, modify, sublicense, or distribute the Program except as expressly provided under this License. Any attempt otherwise to copy, modify, sublicense or distribute the Program is void, and will automatically terminate your rights under this License. However, parties who have received copies, or rights, from you under this License will not have their licenses terminated so long as such parties remain in full compliance. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 5&lt;/strong&gt; You are not required to accept this License, since you have not signed it. However, nothing else grants you permission to modify or distribute the Program or its derivative works. These actions are prohibited by law if you do not accept this License. Therefore, by modifying or distributing the Program (or any work based on the Program), you indicate your acceptance of this License to do so, and all its terms and conditions for copying, distributing or modifying the Program or works based on it. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 6&lt;/strong&gt; Each time you redistribute the Program (or any work based on the Program), the recipient automatically receives a license from the original licensor to copy, distribute or modify the Program subject to these terms and conditions. You may not impose any further restrictions on the recipients&amp;#39; exercise of the rights granted herein. You are not responsible for enforcing compliance by third parties to this License. &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;Section 7&lt;/strong&gt; If, as a consequence of a court judgment or allegation of patent infringement or for any other reason (not limited to patent issues), conditions are imposed on you (whether by court order, agreement or otherwise) that contradict the conditions of this License, they do not excuse you from the conditions of this License. If you cannot distribute so as to satisfy simultaneously your obligations under this License and any other pertinent obligations, then as a consequence you may not distribute the Program at all. For example, if a patent license would not permit royalty-free redistribution of the Program by all those who receive copies directly or indirectly through you, then the only way you could satisfy both it and this License would be to refrain entirely from distribution of the Program. If any portion of this section is held invalid or unenforceable under any particular circumstance, the balance of the section is intended to apply and the section as a whole is intended to apply in other circumstances. It is not the purpose of this section to induce you to infringe any patents or other property right claims or to contest validity of any such claims; this section has the sole purpose of protecting the integrity of the free software distribution system, which is implemented by public license practices. Many people have made generous contributions to the wide range of software distributed through that system in reliance on consistent application of that system; it is up to the author/donor to decide if he or she is willing to distribute software through any other system and a licensee cannot impose that choice. This section is intended to make thoroughly clear what is believed to be a consequence of the rest of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 8&lt;/strong&gt; If the distribution and/or use of the Program is restricted in certain countries either by patents or by copyrighted interfaces, the original copyright holder who places the Program under this License may add an explicit geographical distribution limitation excluding those countries, so that distribution is permitted only in or among countries not thus excluded. In such case, this License incorporates the limitation as if written in the body of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 9&lt;/strong&gt; The Free Software Foundation may publish revised and/or new versions of the General Public License from time to time. Such new versions will be similar in spirit to the present version, but may differ in detail to address new problems or concerns. Each version is given a distinguishing version number. If the Program specifies a version number of this License which applies to it and &quot;any later version&quot;, you have the option of following the terms and conditions either of that version or of any later version published by the Free Software Foundation. If the Program does not specify a version number of this License, you may choose any version ever published by the Free Software Foundation. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 10&lt;/strong&gt; If you wish to incorporate parts of the Program into other free programs whose distribution conditions are different, write to the author to ask for permission. For software which is copyrighted by the Free Software Foundation, write to the Free Software Foundation; we sometimes make exceptions for this. Our decision will be guided by the two goals of preserving the free status of all derivatives of our free software and of promoting the sharing and reuse of software generally. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;NO WARRANTY Section 11&lt;/strong&gt; BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &quot;AS IS&quot; WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Section 12&lt;/strong&gt; IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. &lt;br /&gt;  &lt;br /&gt;  END OF TERMS AND CONDITIONS &lt;br /&gt;  {tcms_more}&lt;br /&gt;  &lt;strong&gt;How to Apply These Terms to Your New Programs&lt;/strong&gt; If you develop a new program, and you want it to be of the greatest possible use to the public, the best way to achieve this is to make it free software which everyone can redistribute and change under these terms. &lt;br /&gt;  &lt;br /&gt;  To do so, attach the following notices to the program. It is safest to attach them to the start of each source file to most effectively convey the exclusion of warranty; and each file should have at least the &quot;copyright&quot; line and a pointer to where the full notice is found. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;toendaCMS - XML Content Management and Weblogging System&lt;/strong&gt;    toendaCMS is a professionall web based Content Management and Weblogging System with a XML or SQL Database. &lt;br /&gt;  &lt;strong&gt;Copyright (C) 2003 - 2005 Jonathan Naumann &lt;em&gt;Toenda Software Development&lt;/em&gt;&lt;/strong&gt; This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version. &lt;br /&gt;  &lt;br /&gt;  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. &lt;br /&gt;  &lt;br /&gt;  You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA &lt;br /&gt;  &lt;br /&gt;  Also add information on how to contact you by electronic and paper mail. &lt;br /&gt;  &lt;br /&gt;  If the program is interactive, make it output a short notice like this when it starts in an interactive mode: &lt;br /&gt;  &lt;br /&gt;  Gnomovision version 69, Copyright (C) year name of author Gnomovision comes with ABSOLUTELY NO WARRANTY; for details type `show w&amp;#39;. This is free software, and you are welcome to redistribute it under certain conditions; type `show c&amp;#39; for details. &lt;br /&gt;  &lt;br /&gt;  The hypothetical commands `show w&amp;#39; and `show c&amp;#39; should show the appropriate parts of the General Public License. Of course, the commands you use may be called something other than `show w&amp;#39; and `show c&amp;#39;; they could even be mouse-clicks or menu items--whatever suits your program. &lt;br /&gt;  &lt;br /&gt;  You should also get your employer (if you work as a programmer) or your school, if any, to sign a &quot;copyright disclaimer&quot; for the program, if necessary. Here is a sample; alter the names: &lt;br /&gt;  &lt;br /&gt;  Yoyodyne, Inc., hereby disclaims all copyright interest in the program `Gnomovision&amp;#39; (which makes passes at compilers) written by James Hacker. &lt;br /&gt;  &lt;br /&gt;  (signature of Ty Coon), 1 April 1989 Ty Coon, President of Vice &lt;br /&gt;  &lt;br /&gt;  This General Public License does not permit incorporating your program into proprietary programs. If your program is a subroutine library, you may consider it more useful to permit linking proprietary applications with the library. If this is what you want to do, use the GNU Library General Public License instead of this License. &lt;br /&gt;  &lt;br /&gt;  &lt;strong&gt;Toenda Software Development&lt;/strong&gt;', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', NULL),
('66115', 'sub1', 'test text in english', 'test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in englishtest text in englishtest text in english test text in english&lt;br /&gt;\r\n', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'english_EN');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####content_languages`
-- 

CREATE TABLE `#####content_languages` (
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
) ENGINE=InnoDB ;

-- 
-- Daten für Tabelle `#####content_languages`
-- 

INSERT INTO `#####content_languages` (`uid`, `content_uid`, `language`, `title`, `key`, `content00`, `content01`, `foot`, `autor`, `db_layout`, `access`, `in_work`, `published`) VALUES ('fdgd7', '18e2a', 'germany_DE', 'sub1', 'testtext in deutsch', 'testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch testtext in deutsch\r\n', '', '', 'root', 'db_content_default.php', 'Public', 1, 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####downloads`
-- 

CREATE TABLE `#####downloads` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####downloads`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####downloads_config`
-- 

CREATE TABLE `#####downloads_config` (
  `uid` varchar(8) NOT NULL default '',
  `download_id` varchar(8) NOT NULL default '',
  `download_title` varchar(255) default NULL,
  `download_stamp` varchar(255) default NULL,
  `download_text` text
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####downloads_config`
-- 

INSERT INTO `#####downloads_config` (`uid`, `download_id`, `download_title`, `download_stamp`, `download_text`) VALUES ('download', 'download', 'Downloads and Software', 'Toenda Software Downloads', 'Our software downloads.');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####frontpage`
-- 

CREATE TABLE `#####frontpage` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####frontpage`
-- 

INSERT INTO `#####frontpage` (`uid`, `language`, `front_id`, `front_title`, `front_stamp`, `front_text`, `news_title`, `news_cut`, `module_use_0`, `sb_news_title`, `sb_news_amount`, `sb_news_chars`, `sb_news_enabled`, `sb_news_display`) VALUES ('24k58ilp6', 'english_EN', 'frontpage', 'Welcome to the Home of toendaCMS', 'Open Source Content Management Framework', 'Welcome to the Samplesite of the free Open Source Content Management Framework toendaCMS.&lt;br /&gt;\r\nIt is for enterprise purposes and/or private uses on the web. It offers\r\nfull flexibility and extendability while featuring an accomplished set\r\nof ready-made interfaces, function&amp;#39;s and modules.\r\n', 'News', 0, 5, 'Latest News', 5, 100, 0, 3),
('4frtgh587', 'germany_DE', 'frontpage', 'Willkommen auf der Demoseite von toendaCMS', 'Open Source Content Management Framework', 'Willkommen auf der Demoseite des Open-Source Content Management Frameworks toendaCMS.&lt;br /&gt;\r\n It is for enterprise purposes and/or private uses on the web. It offers full flexibility and extendability while featuring an accomplished set of ready-made interfaces, function&amp;#39;&amp;#39;s and modules.\r\n', 'Neuigkeiten', 0, 5, 'Die letzten Neuigkeiten', 5, 100, 0, 3);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####guestbook`
-- 

CREATE TABLE `#####guestbook` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####guestbook`
-- 

INSERT INTO `#####guestbook` (`uid`, `guest_id`, `booktitle`, `bookstamp`, `access`, `enabled`, `clean_link`, `clean_script`, `convert_at`, `show_email`, `name_width`, `text_width`, `color_row_1`, `color_row_2`) VALUES ('guestbook', 'guestbook', 'My Guests', 'of this beautiful website', 'Public', 1, 1, 1, 1, 1, '140', '360', 'efefef', 'ffffff');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####guestbook_items`
-- 

CREATE TABLE `#####guestbook_items` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `text` text,
  `date` varchar(8) default NULL,
  `time` varchar(5) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####guestbook_items`
-- 

INSERT INTO `#####guestbook_items` (`uid`, `name`, `email`, `text`, `date`, `time`) VALUES ('55cb02d7477921bb0091b9ba7ae91b85', 'vandango', 'vandango@toenda.com', 'Wow, whats a new and cool guestbook.', '20051124', '12:33');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####imagegallery`
-- 

CREATE TABLE `#####imagegallery` (
  `uid` varchar(10) NOT NULL default '',
  `album` varchar(6) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `text` text,
  `date` varchar(14) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####imagegallery`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####imagegallery_config`
-- 

CREATE TABLE `#####imagegallery_config` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####imagegallery_config`
-- 

INSERT INTO `#####imagegallery_config` (`uid`, `image_id`, `image_title`, `image_stamp`, `image_details`, `use_comments`, `access`, `max_image`, `needle_image`, `show_lastimg_title`, `align_image`, `size_image`, `image_sort`, `list_option`) VALUES ('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 5, 'Last uploaded', 1, 'center', 100, 'desc', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####impressum`
-- 

CREATE TABLE `#####impressum` (
  `uid` varchar(9) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `imp_id` varchar(9) NOT NULL default '',
  `imp_title` varchar(255) default NULL,
  `imp_stamp` varchar(255) default NULL,
  `imp_contact` varchar(10) NOT NULL default '',
  `taxno` varchar(50) default NULL,
  `ustid` varchar(50) default NULL,
  `legal` text
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####impressum`
-- 

INSERT INTO `#####impressum` (`uid`, `language`, `imp_id`, `imp_title`, `imp_stamp`, `imp_contact`, `taxno`, `ustid`, `legal`) VALUES ('impressum', 'english_EN', 'impressum', 'Disclaimer', 'Information about this website', '10a1b5f6ab', '123456789', '123123d', 'No portion of this web site may be reproduced without express written consent from its owner.'),
('hgztkj87r', 'germany_DE', 'impressum', 'Impressum', 'Informationen &uuml;ber diese Webseite', '10a1b5f6ab', '123456789', '123123d', '&lt;span class__________&quot;contentmain&quot;&gt;&lt;span class__________&quot;contentmain&quot;&gt;&lt;strong&gt;Haftungsausschluss / Datenschutz&lt;/strong&gt;&lt;br /&gt;\r\n&lt;br /&gt;\r\n1. Wichtiger rechtlicher Hinweis und Haftungsausschlu&szlig;:&lt;br /&gt;\r\nDas Landgericht Hamburg hat am 12. Mai 1998 im Urteil 312 O 85/98\r\n&quot;Haftung f&uuml;r Links&quot; entschieden, da&szlig; durch die Ver&ouml;ffentlichung eines\r\nLinks auf einer Homepage die Inhalte der gelinkten Seiten mit zu\r\nverantworten sind. Das l&auml;&szlig;t sich nur verhindern, wenn man sich\r\nausdr&uuml;cklich von den Inhalten der gelinkten Seiten distanziert. Wir\r\ndistanzieren uns daher von allen Inhalten, die sich hinter den\r\nangegebenen Links, den dahinter stehenden Servern, weiterf&uuml;hrenden\r\nLinks, G&auml;steb&uuml;chern und s&auml;mtlichen anderen sichtbaren und nicht\r\nsichtbaren Inhalten verbergen. Sollte eine der Seiten auf den\r\nentsprechenden Servern gegen geltendes Recht versto&szlig;en, so ist uns\r\ndieses nicht bekannt. Auf entsprechende Benachrichtigung hin werden wir\r\nselbstverst&auml;ndlich den Link zu dem entsprechenden Server entfernen\r\n(nachzulesen unter www.online-recht.de). Sollte Ihre Homepage, gegen\r\nIhren Wunsch, in unserer Referenzliste verzeichnet sein, dann wenden\r\nSie sich bitte an uns. Wir werden den Link dann umgehend l&ouml;schen.\r\nVielen Dank &lt;br /&gt;\r\n2. Datenschutz:&lt;br /&gt;\r\nEs ist Absicht der Firma Toenda Software Development, die Gesetze zum\r\nSchutz der Privatsph&auml;re und die Datenschutzgesetze genauestens\r\neinzuhalten und zu respektieren. Wir m&ouml;chten dazu beitragen, das\r\nInternet zu einer sicheren und verbindlichen Informationsquelle f&uuml;r\r\nunsere Homepage-Besucher zu machen. Wir sch&uuml;tzen die pers&ouml;nlichen\r\nInformationen unserer G&auml;ste gegen m&ouml;glichen Datenmi&szlig;brauch. Wir geben\r\nau&szlig;erdem Zugriff auf eigene pers&ouml;nliche Informationen, so da&szlig;\r\nInformationen, die wir &uuml;ber Sie haben, ge&auml;ndert oder gel&ouml;scht werden\r\nkann. &lt;br /&gt;\r\n&lt;br /&gt;\r\n2.1 Pers&ouml;nlich identifizierbare Informationen&lt;br /&gt;\r\nWir sammeln pers&ouml;nlich identifizierbare Informationen nur wenn Sie sich\r\neintragen , um an unseren online- Wettbewerben (Preisausschreiben)\r\nteilzunehmen oder Sie um pers&ouml;nliche &Uuml;bersendung von Informationen\r\nbitten.&lt;br /&gt;\r\nDiese Daten werden von der Firma &lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;Toenda Software Development&lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;\r\ngenutzt und nicht an Drittfirmen weitergegeben. Wenn Sie unter 18\r\nJahren sind k&ouml;nnen Sie nur an Wettbewerben teilnehmen oder um\r\npers&ouml;nliche Infromations&uuml;bersendung bitten, wenn die Erlaubnis der\r\nEltern vorliegt. &lt;br /&gt;\r\n&lt;br /&gt;\r\n2. 2 Nicht pers&ouml;nlich identifizierbare Informationen&lt;br /&gt;\r\nWir bem&uuml;hen uns unser Web-Angebot laufend zu verbessern. Daf&uuml;r ist es\r\nn&uuml;tzlich, zu wissen, welche Informationen am beliebtesten ist. Zu\r\ndiesem Zwecke speichern wir Datum, Uhrzeit, Suchbegriff und die von\r\nIhnen angeforderte Information mit der jeweiligen IP-Adresse.&lt;br /&gt;\r\nEine IP-Adresse ist eine Nummer, die automatisch Ihrem Computer\r\nzugeteilt wird, wann immer Sie im Web surfen. Web-Server, d.h. die\r\nGro&szlig;computer, die die Webseiten &amp;bdquo;bereitstellen&amp;ldquo;, identifizieren Ihren\r\nComputer automatisch anhand seiner IP-Adresse. Die Firma &lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;Toenda Software Development&lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;\r\nsammelt IP-Adressen zus&auml;tzlich f&uuml;r Zwecke der Systemverwaltung, um\r\nBerichte zu erstellen und die Benutzung unserer Websites zu verfolgen.\r\nWenn Sie spezifische Seiten von den Websites der Firma anfordern,\r\nerkennen unsere Server oder Computer die IP-Adressen der G&auml;ste. Wir\r\nverbinden IP-Adressen aber nicht mit pers&ouml;nlich identifizierbaren\r\nInformationen, was bedeutet, da&szlig; der Benutzer f&uuml;r uns anonym bleibt.&lt;/span&gt;\r\n&lt;/span&gt;\r\n');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####knowledgebase`
-- 

CREATE TABLE `#####knowledgebase` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####knowledgebase`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####knowledgebase_config`
-- 

CREATE TABLE `#####knowledgebase_config` (
  `uid` varchar(13) NOT NULL default '',
  `id` varchar(13) NOT NULL default '',
  `title` varchar(255) default NULL,
  `subtitle` varchar(255) default NULL,
  `text` text,
  `enabled` int(1) NOT NULL default '0',
  `autor_enabled` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####knowledgebase_config`
-- 

INSERT INTO `#####knowledgebase_config` (`uid`, `id`, `title`, `subtitle`, `text`, `enabled`, `autor_enabled`, `access`) VALUES ('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Here you will find an example set of FAQs and Articles.', 1, 0, 'Public');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####links`
-- 

CREATE TABLE `#####links` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####links`
-- 

INSERT INTO `#####links` (`uid`, `type`, `category`, `sort`, `name`, `desc`, `link`, `published`, `target`, `rss`, `access`, `module`) VALUES ('34dr567zhtzh876sgh48r68f44h5s8z4', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 0, 'Toenda Software Development', 'Developer of toendaCMS', 'http://www.toenda.com', 1, '_blank', '', 'Public', 3),
('sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 'c', '', 0, 'Toenda', 'Toenda Software Development Links', '', 1, '', '', 'Public', 3),
('dsf78578asdas7das76das7d67as67d6', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 1, 'toendaCMS Demonstration Site', 'The officiell demonstration site of the content management and weblogging system toendaCMS.', 'http://toendacms.toenda.com', 1, '_blank', NULL, 'Public', 3),
('asdasdasdasdasd6786786as78d6as67', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 2, 'PHP.net', 'Officiell PHP webpage', 'http://www.php.net', 1, '_blank', '', 'Public', 2),
('d8f83e6e9acc6ad211104949db1285fd', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 3, 'vandango | creative coding', 'toendaCMS maindeveloper weblog', 'http://vandango.org', 1, '_blank', '', 'Public', 1),
('50c3ef9ef90f608dd85ca31166b62e68', 'c', NULL, 1, 'Linux', 'Some Links about Linus free operating system', '', 1, '', '', 'Public', 3),
('175b2bf8dd4a03d00038bb43ae06abf1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 0, 'Enlightenment', 'The best Unix / Linux Window Manager', 'http://www.enlightenment.org', 1, '_blank', '', 'Public', 3),
('43b59b86aa69a67ea020ead9e3ce54e1', 'l', '50c3ef9ef90f608dd85ca31166b62e68', 1, 'Kernel.org', 'The Linux Kernel', 'http://www.kernel.org', 1, '_blank', '', 'Public', 3);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####links_config`
-- 

CREATE TABLE `#####links_config` (
  `uid` varchar(17) NOT NULL default '',
  `link_use_side_desc` int(1) default NULL,
  `link_use_side_title` int(1) default NULL,
  `link_side_title` varchar(255) default NULL,
  `link_use_main_desc` int(1) default NULL,
  `link_main_title` varchar(255) default NULL,
  `link_main_subtitle` varchar(255) default NULL,
  `link_main_text` text,
  `link_main_access` varchar(10) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####links_config`
-- 

INSERT INTO `#####links_config` (`uid`, `link_use_side_desc`, `link_use_side_title`, `link_side_title`, `link_use_main_desc`, `link_main_title`, `link_main_subtitle`, `link_main_text`, `link_main_access`) VALUES ('links_config_side', 0, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL),
('links_config_main', NULL, NULL, NULL, 1, 'myLinks', 'A list of all websites i like', 'This is a example text for the textlink page.&lt;a href__________&quot;/toendacms/index.php/section/contactform/template/k2&quot;&gt;Kontaktformular&lt;/a&gt;', 'Public');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####news`
-- 

CREATE TABLE `#####news` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####news`
-- 

INSERT INTO `#####news` (`uid`, `language`, `title`, `autor`, `date`, `time`, `newstext`, `stamp`, `published`, `publish_date`, `comments_enabled`, `image`, `access`, `show_on_frontpage`) VALUES ('c4c846e167', 'english_EN', 'Hello world!', 'Dolly', '21.10.2006', '00:00', 'Hello world. This is Dolly  and you reading my first post. If you want you can delete it, but you can edit it too. Or you write a new one and let this where it is. It&amp;#39;s your choice.\r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n', 200610210000, 1, '21.10.2006-00:00', 1, '', 'Public', 1),
('90ac2e39eb', 'germany_DE', 'Hallo Welt!', 'Dolly', '04.02.2007', '17:25', 'Hallo Welt. Ich bin Dolly und du liest gerade den ersten Eintrag. Wenn du willst, kannst du mich l&ouml;schen, oder du bearbeitest mich einfach. Order du schreibst einen neuen und l&auml;sst mich hier zur&uuml;ck, ganz wie du willst.&lt;br /&gt;\r\n&lt;br /&gt;\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.\r\n', 200702041725, 1, '04.02.2007-17:25', 1, '', 'Public', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####news_categories`
-- 

CREATE TABLE `#####news_categories` (
  `uid` varchar(5) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `desc` text
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####news_categories`
-- 

INSERT INTO `#####news_categories` (`uid`, `name`, `desc`) VALUES ('erdf4', 'Uncategorized', 'News without a category.');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####news_to_categories`
-- 

CREATE TABLE `#####news_to_categories` (
  `uid` varchar(32) NOT NULL default '',
  `news_uid` varchar(10) NOT NULL default '',
  `cat_uid` varchar(5) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####news_to_categories`
-- 

INSERT INTO `#####news_to_categories` (`uid`, `news_uid`, `cat_uid`) VALUES ('faf794901b615e2c26ef4a78f7219853', '79b944ed5f', 'erdf4'),
('6a3636d84f84b27a967cb93207b26713', 'c4c846e167', 'erdf4'),
('145a5946991378852797f16685d75fb0', 'a4439ff6b4', 'erdf4'),
('ebb5930080c754cd74c764653be5fc84', '90ac2e39eb', 'erdf4');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####newsletter`
-- 

CREATE TABLE `#####newsletter` (
  `uid` varchar(10) NOT NULL default '',
  `nl_title` varchar(255) NOT NULL default '',
  `nl_show_title` int(1) NOT NULL default '0',
  `nl_text` varchar(255) NOT NULL default '',
  `nl_link` varchar(255) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####newsletter`
-- 

INSERT INTO `#####newsletter` (`uid`, `nl_title`, `nl_show_title`, `nl_text`, `nl_link`) VALUES ('newsletter', 'Newsletter', 1, 'You want always know whats up, subscribe now!', 'Submit');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####newsletter_items`
-- 

CREATE TABLE `#####newsletter_items` (
  `uid` varchar(6) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####newsletter_items`
-- 

INSERT INTO `#####newsletter_items` (`uid`, `user`, `email`) VALUES ('223594', 'Mr. Toenda', 'info@toenda.com'),
('f574da', 'Jonathan Naumann', 'info@toenda.com');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####newsmanager`
-- 

CREATE TABLE `#####newsmanager` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####newsmanager`
-- 

INSERT INTO `#####newsmanager` (`uid`, `news_id`, `news_title`, `news_stamp`, `news_text`, `news_image`, `use_comments`, `show_autor`, `show_autor_as_link`, `news_amount`, `access`, `news_cut`, `use_gravatar`, `use_emoticons`, `use_rss091`, `use_rss10`, `use_rss20`, `use_atom03`, `use_opml`, `syn_amount`, `use_syn_title`, `def_feed`, `use_trackback`, `use_timesince`, `readmore_link`, `news_spacing`, `language`) VALUES ('newsmanager', 'newsmanager', 'News', 'Current', 'My newstext&lt;br /&gt;\r\n', '', 1, 1, 1, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 2, 0, 0, 'english_EN'),
('45789hgtzu', 'newsmanager', 'Neuigkeiten', 'Aktuell', 'Mein Neuigkeitentext und noch viel mehr<br />\r\nUnd ein wenig Text ...<br />\r\n', '', 1, 1, 1, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 2, 0, 0, 'germany_DE');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####notepad`
-- 

CREATE TABLE `#####notepad` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(200) NOT NULL default '',
  `note` text,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####notepad`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####poll_config`
-- 

CREATE TABLE `#####poll_config` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####poll_config`
-- 

INSERT INTO `#####poll_config` (`uid`, `poll_title`, `allpoll_title`, `show_poll_title`, `poll_side_width`, `poll_main_width`, `poll_sm_title`, `use_poll_sidemenu`, `poll_sidemenu_id`, `poll_tm_title`, `use_poll_topmenu`, `poll_topmenu_id`) VALUES ('poll', 'Poll', 'All Polls', 1, 110, 500, 'Poll', 0, 2, 'Poll', 0, 4);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####poll_items`
-- 

CREATE TABLE `#####poll_items` (
  `uid` varchar(8) NOT NULL default '',
  `poll_uid` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `domain` varchar(255) NOT NULL default '',
  `answer` int(1) NOT NULL default '0'
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####poll_items`
-- 

INSERT INTO `#####poll_items` (`uid`, `poll_uid`, `ip`, `domain`, `answer`) VALUES ('f2e874a9', '1386d1eb56f76a14a507f64a63617309', '127.0.0.1', 'localhost', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####polls`
-- 

CREATE TABLE `#####polls` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####polls`
-- 

INSERT INTO `#####polls` (`uid`, `title`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `question11`, `question12`) VALUES ('1386d1eb56f76a14a507f64a63617309', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####products`
-- 

CREATE TABLE `#####products` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `product_number` varchar(255) default NULL,
  `factory` varchar(255) default NULL,
  `factory_url` varchar(255) default NULL,
  `desc` text,
  `category` varchar(255) NOT NULL default '',
  `image` varchar(255) default NULL,
  `date` varchar(16) NOT NULL default '',
  `price` varchar(50) default NULL,
  `price_tax` varchar(50) default NULL,
  `status` int(1) NOT NULL default '0',
  `quantity` int(10) default NULL,
  `weight` varchar(50) default NULL,
  `sort` int(5) NOT NULL default '0',
  `access` varchar(10) default NULL,
  `sql_type` char(1) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####products`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####products_config`
-- 

CREATE TABLE `#####products_config` (
  `uid` varchar(8) NOT NULL default '',
  `products_id` varchar(8) NOT NULL default '',
  `products_title` varchar(255) NOT NULL default '',
  `products_stamp` varchar(255) NOT NULL default '',
  `products_text` text NOT NULL,
  `category_state` varchar(255) NOT NULL default '',
  `category_title` varchar(255) NOT NULL default '',
  `use_category_title` int(1) NOT NULL default '0'
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####products_config`
-- 

INSERT INTO `#####products_config` (`uid`, `products_id`, `products_title`, `products_stamp`, `products_text`, `category_state`, `category_title`, `use_category_title`) VALUES ('products', 'products', 'Products', 'Toenda Software Products', 'Our software products.', 'fghfh', 'Product Categories', 1);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####session`
-- 

CREATE TABLE `#####session` (
  `uid` varchar(32) NOT NULL default '',
  `date` varchar(20) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `user_id` varchar(32) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####session`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####sidebar`
-- 

CREATE TABLE `#####sidebar` (
  `uid` varchar(32) NOT NULL default '',
  `title` varchar(255) default NULL,
  `key` varchar(255) default NULL,
  `content` text,
  `foot` varchar(255) default NULL,
  `id` varchar(255) NOT NULL default ''
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####sidebar`
-- 

INSERT INTO `#####sidebar` (`uid`, `title`, `key`, `content`, `foot`, `id`) VALUES ('frontpage', 'Wenn ich gross bin', '', 'Ich bin nur ein kleiner Blindtext\r\nWenn ich gross bin, will ich Ulysses von James Joyce werden. Aber jetzt lohnt es sich noch nicht, mich weiterzulesen. Denn vorerst bin ich nur ein kleiner Blindtext.', '', 'frontpage');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####sidebar_extensions`
-- 

CREATE TABLE `#####sidebar_extensions` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####sidebar_extensions`
-- 

INSERT INTO `#####sidebar_extensions` (`uid`, `sidemenu_title`, `sidemenu`, `sidebar_title`, `show_sidebar_title`, `chooser_title`, `show_chooser_title`, `search_title`, `show_search_title`, `search_alignment`, `search_withbr`, `search_withbutton`, `search_word`, `login_title`, `usermenu_title`, `nologin`, `reg_link`, `reg_user`, `reg_pass`, `login_user`, `usermenu`, `show_login_title`, `show_news_cat_amount`, `show_memberlist`, `lang`) VALUES ('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 0, 'Showcase', 1, 'Search website', 0, 'left', 0, 0, '', 'Login', 'Usermenu', 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 1, 'de;en;nl;');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####sidemenu`
-- 

CREATE TABLE `#####sidemenu` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####sidemenu`
-- 

INSERT INTO `#####sidemenu` (`uid`, `language`, `name`, `id`, `subid`, `root`, `parent`, `parent_lvl1`, `parent_lvl2`, `parent_lvl3`, `type`, `link`, `published`, `access`, `target`) VALUES ('r15tg', 'english_EN', 'Home', 1, '-', '-', '-', '-', '-', '-', 'link', 'frontpage', 1, 'Public', ''),
('6738n', 'english_EN', 'Pages', 0, '-', '-', '-', '-', '-', '-', 'title', '-', 0, 'Public', ''),
('51272', 'english_EN', 'Contact Me', 4, '-', '-', '-', '-', '-', '-', 'link', 'contactform', 1, 'Public', ''),
('dc688', 'english_EN', 'License', 2, '-', '-', '-', '-', '-', '-', 'link', '18e2a', 1, 'Public', ''),
('52d28', 'english_EN', 'Guestbook', 3, '-', '-', '-', '-', '-', '-', 'link', 'guestbook', 1, 'Public', ''),
('11d22', 'english_EN', 'sub1', 2, '0', '-', '2', '-', '-', '-', 'link', 'polls', 1, 'Public', ''),
('dfsd7', 'english_EN', 'subsub1', 2, '0', '-', '-', '-', '11d22', '-', 'link', 'search', 0, 'Public', NULL),
('c39d0', 'germany_DE', 'Navigation', 0, '-', '-', '-', '-', '-', '-', 'title', 'frontpage', 0, 'Public', ''),
('638ac', 'germany_DE', 'Lizenz', 2, '-', '-', '-', '-', '-', '-', 'link', '18e2a', 1, 'Public', ''),
('1fffa', 'germany_DE', 'Startseite', 1, '-', '-', '-', '-', '-', '-', 'link', '-', 1, 'Public', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####statistics`
-- 

CREATE TABLE `#####statistics` (
  `host` varchar(255) NOT NULL default '',
  `site_url` varchar(255) NOT NULL default '',
  `value` int(10) default '0',
  `ip_uid` varchar(32) default NULL,
  `referrer` varchar(255) default NULL,
  `timestamp` datetime default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####statistics`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####statistics_ip`
-- 

CREATE TABLE `#####statistics_ip` (
  `uid` varchar(32) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  `value` int(10) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####statistics_ip`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####statistics_os`
-- 

CREATE TABLE `#####statistics_os` (
  `uid` varchar(32) NOT NULL default '',
  `browser` varchar(255) default NULL,
  `os` varchar(255) default NULL,
  `value` int(10) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####statistics_os`
-- 


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####topmenu`
-- 

CREATE TABLE `#####topmenu` (
  `uid` varchar(5) NOT NULL,
  `language` varchar(25) NOT NULL,
  `name` varchar(255) default NULL,
  `id` int(4) NOT NULL default '0',
  `type` varchar(10) default NULL,
  `link` varchar(255) default NULL,
  `published` int(1) NOT NULL default '0',
  `access` varchar(10) NOT NULL default '',
  `target` varchar(20) default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####topmenu`
-- 

INSERT INTO `#####topmenu` (`uid`, `language`, `name`, `id`, `type`, `link`, `published`, `access`, `target`) VALUES ('1fbae', 'english_EN', 'Home', 0, 'link', 'frontpage', 1, 'Public', ''),
('3c6d9', 'english_EN', 'News', 1, 'link', 'newsmanager', 1, 'Public', ''),
('d2112', 'english_EN', 'Downloads', 2, 'link', 'download', 1, 'Public', ''),
('706b2', 'english_EN', 'Shop', 3, 'link', 'components&item=tcmsshop', 1, 'Public', ''),
('7e31e', 'germany_DE', 'Home', 0, 'link', 'frontpage', 1, 'Public', ''),
('61c34', 'germany_DE', 'Neuigkeiten', 1, 'link', 'newsmanager', 1, 'Public', ''),
('f39c7', 'germany_DE', 'Downloads', 2, 'link', 'download', 1, 'Public', ''),
('ac64b', 'germany_DE', 'Shop', 3, 'link', 'components&item=tcmsshop', 1, 'Public', '');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####user`
-- 

CREATE TABLE `#####user` (
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
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####user`
-- 
-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####usergroup`
-- 

CREATE TABLE `#####usergroup` (
  `uid` varchar(32) collate utf8_unicode_ci NOT NULL,
  `name` varchar(25) collate utf8_unicode_ci NOT NULL,
  `right` int(1) NOT NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####usergroup`
-- 

INSERT INTO `#####usergroup` (`uid`, `name`, `right`) VALUES ('418aed8f001f0b88e36bc68013000794', 'Editor', 3),
('7f2a4a04ddeffc7caa029e289be712a1', 'Writer', 2),
('daf91e6be506252b897977537fa488c8', 'Developer', 0),
('8a318ecd72b639ceca72c87dbc6f241c', 'Administrator', 1),
('fcc0abe286b322744765b271c8ede1fd', 'Presenter', 4),
('c4e1aea1d163b0d3b3db90b667a2ba81', 'User', 5);

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `#####userpage`
-- 

CREATE TABLE `#####userpage` (
  `uid` varchar(8) collate utf8_unicode_ci NOT NULL default '',
  `text_width` varchar(5) collate utf8_unicode_ci default NULL,
  `input_width` varchar(5) collate utf8_unicode_ci default NULL,
  `news_publish` int(1) NOT NULL default '0',
  `image_publish` int(1) NOT NULL default '0',
  `album_publish` int(1) NOT NULL default '0',
  `cat_publish` int(1) NOT NULL default '0',
  `pic_publish` char(1) collate utf8_unicode_ci default NULL
) ENGINE=MyISAM ;

-- 
-- Daten für Tabelle `#####userpage`
-- 

INSERT INTO `#####userpage` (`uid`, `text_width`, `input_width`, `news_publish`, `image_publish`, `album_publish`, `cat_publish`, `pic_publish`) VALUES ('userpage', '150', '150', 0, 0, 0, 0, '0');
