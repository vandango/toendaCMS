-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. April 2008 um 11:25
-- Server Version: 5.0.45
-- PHP-Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
) ;

--
-- Daten für Tabelle `#####albums`
--

INSERT INTO `#####albums` (`uid`, `title`, `album_id`, `published`, `desc`, `image`) VALUES
('030a5e799cd0', 'gfhgfh', '799cd0', 1, 'gdfhdsfdsfdsf', 'Sonnenuntergang.jpg'),
('c91c7a36b2e6', 'dsfds', '36b2e6', 1, 'dsfdsfdsfdsfdsf', '');

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
  `domain` varchar(255) default NULL
) ;

--
-- Daten für Tabelle `#####comments`
--

INSERT INTO `#####comments` (`uid`, `module`, `timestamp`, `name`, `email`, `web`, `msg`, `time`, `ip`, `domain`) VALUES
('c4c846e167', 'news', '20051126005016', 'vandango', 'vandango@toenda.com', 'http://vandango.org', 'This is a test comment ...', '20051126005016', '127.0.0.1', 'localhost'),
('90ac2e39eb', 'news', '20070701170303', 'vandango', 'vandango@toenda.com', 'http://vandango.org', 'Ein Kommentar, hier sind &lt;strong&gt;fette&lt;/strong&gt; Texte\r\nund &lt;a href__________&quot;http://www.toendacms.com&quot; target__________&quot;_blank&quot;&gt;Links&lt;/a&gt; erlaubt.', '20070701170303', '127.0.0.1', 'vandango-PC'),
('8337f6d091', 'news', '20080213094734', 'vandango', 'vandango@toenda.com', 'http://www.vandango.org', 'dfgdsfdsf', '20080213094734', '127.0.0.1', 'localhost');

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
) ;

--
-- Daten für Tabelle `#####contactform`
--

INSERT INTO `#####contactform` (`uid`, `language`, `contact`, `show_contacts_in_sidebar`, `send_id`, `contacttitle`, `contactstamp`, `contacttext`, `access`, `enabled`, `use_adressbook`, `use_contact`, `show_contactemail`) VALUES
('contactform', 'english_EN', 'info@toenda.com', 0, 'contactform', 'Contact Us and ...', '... send us a message.', 'my contacttext&lt;br /&gt;\r\n', 'Public', 1, 1, 1, 1),
('196716e11c5', 'germany_DE', 'info@toenda.com', 1, 'contactform', 'Kontaktformular', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.', 'Public', 1, 1, 1, 1);

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
) ;

--
-- Daten für Tabelle `#####contacts`
--

INSERT INTO `#####contacts` (`uid`, `default_con`, `published`, `name`, `position`, `email`, `street`, `country`, `state`, `town`, `postal`, `phone`, `fax`) VALUES
('10a1b5f6ab', 1, 1, 'Max Musterman', 'CEO', 'max@musterman.com', 'Musterstrasse 123', 'Deutschland', '', 'Musterstadt', 8203, '', '');

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
) ;

--
-- Daten für Tabelle `#####content`
--

INSERT INTO `#####content` (`uid`, `title`, `key`, `content00`, `content01`, `foot`, `db_layout`, `access`, `in_work`, `published`, `autor`, `language`) VALUES
('18e2a', 'License', 'toendaCMS &amp; GNU General Public License', '&lt;h3 style__________&quot;text-align: center&quot;&gt;GNU GENERAL PUBLIC LICENSE&lt;/h3&gt;\r\n&lt;p style__________&quot;text-align: center&quot;&gt;Version 3, 29 June 2007&lt;/p&gt;\r\n&lt;p&gt;Copyright &amp;copy; 2007 Free Software Foundation, Inc.&lt;/p&gt;\r\n&lt;p&gt;Everyone is permitted to copy and distribute verbatim copies\r\nof this license document, but changing it is not allowed.&lt;/p&gt;\r\n&lt;h3&gt;&lt;a name__________&quot;preamble&quot;&gt;&lt;/a&gt;Preamble&lt;/h3&gt;\r\n&lt;p&gt;The GNU General Public License is a free, copyleft license for\r\nsoftware and other kinds of works.&lt;/p&gt;\r\n&lt;p&gt;The licenses for most software and other practical works are designed\r\nto take away your freedom to share and change the works.  By contrast,\r\nthe GNU General Public License is intended to guarantee your freedom to\r\nshare and change all versions of a program--to make sure it remains free\r\nsoftware for all its users.  We, the Free Software Foundation, use the\r\nGNU General Public License for most of our software; it applies also to\r\nany other work released this way by its authors.  You can apply it to\r\nyour programs, too.&lt;/p&gt;\r\n&lt;p&gt;When we speak of free software, we are referring to freedom, not\r\nprice.  Our General Public Licenses are designed to make sure that you\r\nhave the freedom to distribute copies of free software (and charge for\r\nthem if you wish), that you receive source code or can get it if you\r\nwant it, that you can change the software or use pieces of it in new\r\nfree programs, and that you know you can do these things.&lt;/p&gt;\r\n&lt;p&gt;To protect your rights, we need to prevent others from denying you\r\nthese rights or asking you to surrender the rights.  Therefore, you have\r\ncertain responsibilities if you distribute copies of the software, or if\r\nyou modify it: responsibilities to respect the freedom of others.&lt;/p&gt;\r\n&lt;p&gt;For example, if you distribute copies of such a program, whether\r\ngratis or for a fee, you must pass on to the recipients the same\r\nfreedoms that you received.  You must make sure that they, too, receive\r\nor can get the source code.  And you must show them these terms so they\r\nknow their rights.&lt;/p&gt;\r\n&lt;p&gt;Developers that use the GNU GPL protect your rights with two steps:\r\n(1) assert copyright on the software, and (2) offer you this License\r\ngiving you legal permission to copy, distribute and/or modify it.&lt;/p&gt;\r\n&lt;p&gt;For the developers&#039; and authors&#039; protection, the GPL clearly explains\r\nthat there is no warranty for this free software.  For both users&#039; and\r\nauthors&#039; sake, the GPL requires that modified versions be marked as\r\nchanged, so that their problems will not be attributed erroneously to\r\nauthors of previous versions.&lt;/p&gt;\r\n&lt;p&gt;Some devices are designed to deny users access to install or run\r\nmodified versions of the software inside them, although the manufacturer\r\ncan do so.  This is fundamentally incompatible with the aim of\r\nprotecting users&#039; freedom to change the software.  The systematic\r\npattern of such abuse occurs in the area of products for individuals to\r\nuse, which is precisely where it is most unacceptable.  Therefore, we\r\nhave designed this version of the GPL to prohibit the practice for those\r\nproducts.  If such problems arise substantially in other domains, we\r\nstand ready to extend this provision to those domains in future versions\r\nof the GPL, as needed to protect the freedom of users.&lt;/p&gt;\r\n&lt;p&gt;Finally, every program is threatened constantly by software patents.\r\nStates should not allow patents to restrict development and use of\r\nsoftware on general-purpose computers, but in those that do, we wish to\r\navoid the special danger that patents applied to a free program could\r\nmake it effectively proprietary.  To prevent this, the GPL assures that\r\npatents cannot be used to render the program non-free.&lt;/p&gt;\r\n&lt;p&gt;The precise terms and conditions for copying, distribution and\r\nmodification follow.&lt;/p&gt;\r\n&lt;h3&gt;&lt;a name__________&quot;terms&quot;&gt;&lt;/a&gt;TERMS AND CONDITIONS&lt;/h3&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section0&quot;&gt;&lt;/a&gt;0. Definitions.&lt;/h4&gt;\r\n&lt;p&gt;&amp;ldquo;This License&amp;rdquo; refers to version 3 of the GNU General Public License.&lt;/p&gt;\r\n&lt;p&gt;&amp;ldquo;Copyright&amp;rdquo; also means copyright-like laws that apply to other kinds of\r\nworks, such as semiconductor masks.&lt;/p&gt;\r\n&lt;p&gt;&amp;ldquo;The Program&amp;rdquo; refers to any copyrightable work licensed under this\r\nLicense.  Each licensee is addressed as &amp;ldquo;you&amp;rdquo;.  &amp;ldquo;Licensees&amp;rdquo; and\r\n&amp;ldquo;recipients&amp;rdquo; may be individuals or organizations.&lt;/p&gt;\r\n&lt;p&gt;To &amp;ldquo;modify&amp;rdquo; a work means to copy from or adapt all or part of the work\r\nin a fashion requiring copyright permission, other than the making of an\r\nexact copy.  The resulting work is called a &amp;ldquo;modified version&amp;rdquo; of the\r\nearlier work or a work &amp;ldquo;based on&amp;rdquo; the earlier work.&lt;/p&gt;\r\n&lt;p&gt;A &amp;ldquo;covered work&amp;rdquo; means either the unmodified Program or a work based\r\non the Program.&lt;/p&gt;\r\n&lt;p&gt;To &amp;ldquo;propagate&amp;rdquo; a work means to do anything with it that, without\r\npermission, would make you directly or secondarily liable for\r\ninfringement under applicable copyright law, except executing it on a\r\ncomputer or modifying a private copy.  Propagation includes copying,\r\ndistribution (with or without modification), making available to the\r\npublic, and in some countries other activities as well.&lt;/p&gt;\r\n&lt;p&gt;To &amp;ldquo;convey&amp;rdquo; a work means any kind of propagation that enables other\r\nparties to make or receive copies.  Mere interaction with a user through\r\na computer network, with no transfer of a copy, is not conveying.&lt;/p&gt;\r\n&lt;p&gt;An interactive user interface displays &amp;ldquo;Appropriate Legal Notices&amp;rdquo;\r\nto the extent that it includes a convenient and prominently visible\r\nfeature that (1) displays an appropriate copyright notice, and (2)\r\ntells the user that there is no warranty for the work (except to the\r\nextent that warranties are provided), that licensees may convey the\r\nwork under this License, and how to view a copy of this License.  If\r\nthe interface presents a list of user commands or options, such as a\r\nmenu, a prominent item in the list meets this criterion.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section1&quot;&gt;&lt;/a&gt;1. Source Code.&lt;/h4&gt;\r\n&lt;p&gt;The &amp;ldquo;source code&amp;rdquo; for a work means the preferred form of the work\r\nfor making modifications to it.  &amp;ldquo;Object code&amp;rdquo; means any non-source\r\nform of a work.&lt;/p&gt;\r\n&lt;p&gt;A &amp;ldquo;Standard Interface&amp;rdquo; means an interface that either is an official\r\nstandard defined by a recognized standards body, or, in the case of\r\ninterfaces specified for a particular programming language, one that\r\nis widely used among developers working in that language.&lt;/p&gt;\r\n&lt;p&gt;The &amp;ldquo;System Libraries&amp;rdquo; of an executable work include anything, other\r\nthan the work as a whole, that (a) is included in the normal form of\r\npackaging a Major Component, but which is not part of that Major\r\nComponent, and (b) serves only to enable use of the work with that\r\nMajor Component, or to implement a Standard Interface for which an\r\nimplementation is available to the public in source code form.  A\r\n&amp;ldquo;Major Component&amp;rdquo;, in this context, means a major essential component\r\n(kernel, window system, and so on) of the specific operating system\r\n(if any) on which the executable work runs, or a compiler used to\r\nproduce the work, or an object code interpreter used to run it.&lt;/p&gt;\r\n&lt;p&gt;The &amp;ldquo;Corresponding Source&amp;rdquo; for a work in object code form means all\r\nthe source code needed to generate, install, and (for an executable\r\nwork) run the object code and to modify the work, including scripts to\r\ncontrol those activities.  However, it does not include the work&#039;s\r\nSystem Libraries, or general-purpose tools or generally available free\r\nprograms which are used unmodified in performing those activities but\r\nwhich are not part of the work.  For example, Corresponding Source\r\nincludes interface definition files associated with source files for\r\nthe work, and the source code for shared libraries and dynamically\r\nlinked subprograms that the work is specifically designed to require,\r\nsuch as by intimate data communication or control flow between those\r\nsubprograms and other parts of the work.&lt;/p&gt;\r\n&lt;p&gt;The Corresponding Source need not include anything that users\r\ncan regenerate automatically from other parts of the Corresponding\r\nSource.&lt;/p&gt;\r\n&lt;p&gt;The Corresponding Source for a work in source code form is that\r\nsame work.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section2&quot;&gt;&lt;/a&gt;2. Basic Permissions.&lt;/h4&gt;\r\n&lt;p&gt;All rights granted under this License are granted for the term of\r\ncopyright on the Program, and are irrevocable provided the stated\r\nconditions are met.  This License explicitly affirms your unlimited\r\npermission to run the unmodified Program.  The output from running a\r\ncovered work is covered by this License only if the output, given its\r\ncontent, constitutes a covered work.  This License acknowledges your\r\nrights of fair use or other equivalent, as provided by copyright law.&lt;/p&gt;\r\n&lt;p&gt;You may make, run and propagate covered works that you do not\r\nconvey, without conditions so long as your license otherwise remains\r\nin force.  You may convey covered works to others for the sole purpose\r\nof having them make modifications exclusively for you, or provide you\r\nwith facilities for running those works, provided that you comply with\r\nthe terms of this License in conveying all material for which you do\r\nnot control copyright.  Those thus making or running the covered works\r\nfor you must do so exclusively on your behalf, under your direction\r\nand control, on terms that prohibit them from making any copies of\r\nyour copyrighted material outside their relationship with you.&lt;/p&gt;\r\n&lt;p&gt;Conveying under any other circumstances is permitted solely under\r\nthe conditions stated below.  Sublicensing is not allowed; section 10\r\nmakes it unnecessary.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section3&quot;&gt;&lt;/a&gt;3. Protecting Users&#039; Legal Rights From Anti-Circumvention Law.&lt;/h4&gt;\r\n&lt;p&gt;No covered work shall be deemed part of an effective technological\r\nmeasure under any applicable law fulfilling obligations under article\r\n11 of the WIPO copyright treaty adopted on 20 December 1996, or\r\nsimilar laws prohibiting or restricting circumvention of such\r\nmeasures.&lt;/p&gt;\r\n&lt;p&gt;When you convey a covered work, you waive any legal power to forbid\r\ncircumvention of technological measures to the extent such circumvention\r\nis effected by exercising rights under this License with respect to\r\nthe covered work, and you disclaim any intention to limit operation or\r\nmodification of the work as a means of enforcing, against the work&#039;s\r\nusers, your or third parties&#039; legal rights to forbid circumvention of\r\ntechnological measures.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section4&quot;&gt;&lt;/a&gt;4. Conveying Verbatim Copies.&lt;/h4&gt;\r\n&lt;p&gt;You may convey verbatim copies of the Program&#039;s source code as you\r\nreceive it, in any medium, provided that you conspicuously and\r\nappropriately publish on each copy an appropriate copyright notice;\r\nkeep intact all notices stating that this License and any\r\nnon-permissive terms added in accord with section 7 apply to the code;\r\nkeep intact all notices of the absence of any warranty; and give all\r\nrecipients a copy of this License along with the Program.&lt;/p&gt;\r\n&lt;p&gt;You may charge any price or no price for each copy that you convey,\r\nand you may offer support or warranty protection for a fee.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section5&quot;&gt;&lt;/a&gt;5. Conveying Modified Source Versions.&lt;/h4&gt;\r\n&lt;p&gt;You may convey a work based on the Program, or the modifications to\r\nproduce it from the Program, in the form of source code under the\r\nterms of section 4, provided that you also meet all of these conditions:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;a) The work must carry prominent notices stating that you modified\r\n	it, and giving a relevant date.&lt;/li&gt;\r\n&lt;li&gt;b) The work must carry prominent notices stating that it is\r\n	released under this License and any conditions added under section\r\n	7.  This requirement modifies the requirement in section 4 to\r\n	&amp;ldquo;keep intact all notices&amp;rdquo;.&lt;/li&gt;\r\n&lt;li&gt;c) You must license the entire work, as a whole, under this\r\n	License to anyone who comes into possession of a copy.  This\r\n	License will therefore apply, along with any applicable section 7\r\n	additional terms, to the whole of the work, and all its parts,\r\n	regardless of how they are packaged.  This License gives no\r\n	permission to license the work in any other way, but it does not\r\n	invalidate such permission if you have separately received it.&lt;/li&gt;\r\n&lt;li&gt;d) If the work has interactive user interfaces, each must display\r\n	Appropriate Legal Notices; however, if the Program has interactive\r\n	interfaces that do not display Appropriate Legal Notices, your\r\n	work need not make them do so.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;A compilation of a covered work with other separate and independent\r\nworks, which are not by their nature extensions of the covered work,\r\nand which are not combined with it such as to form a larger program,\r\nin or on a volume of a storage or distribution medium, is called an\r\n&amp;ldquo;aggregate&amp;rdquo; if the compilation and its resulting copyright are not\r\nused to limit the access or legal rights of the compilation&#039;s users\r\nbeyond what the individual works permit.  Inclusion of a covered work\r\nin an aggregate does not cause this License to apply to the other\r\nparts of the aggregate.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section6&quot;&gt;&lt;/a&gt;6. Conveying Non-Source Forms.&lt;/h4&gt;\r\n&lt;p&gt;You may convey a covered work in object code form under the terms\r\nof sections 4 and 5, provided that you also convey the\r\nmachine-readable Corresponding Source under the terms of this License,\r\nin one of these ways:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;a) Convey the object code in, or embodied in, a physical product\r\n	(including a physical distribution medium), accompanied by the\r\n	Corresponding Source fixed on a durable physical medium\r\n	customarily used for software interchange.&lt;/li&gt;\r\n&lt;li&gt;b) Convey the object code in, or embodied in, a physical product\r\n	(including a physical distribution medium), accompanied by a\r\n	written offer, valid for at least three years and valid for as\r\n	long as you offer spare parts or customer support for that product\r\n	model, to give anyone who possesses the object code either (1) a\r\n	copy of the Corresponding Source for all the software in the\r\n	product that is covered by this License, on a durable physical\r\n	medium customarily used for software interchange, for a price no\r\n	more than your reasonable cost of physically performing this\r\n	conveying of source, or (2) access to copy the\r\n	Corresponding Source from a network server at no charge.&lt;/li&gt;\r\n&lt;li&gt;c) Convey individual copies of the object code with a copy of the\r\n	written offer to provide the Corresponding Source.  This\r\n	alternative is allowed only occasionally and noncommercially, and\r\n	only if you received the object code with such an offer, in accord\r\n	with subsection 6b.&lt;/li&gt;\r\n&lt;li&gt;d) Convey the object code by offering access from a designated\r\n	place (gratis or for a charge), and offer equivalent access to the\r\n	Corresponding Source in the same way through the same place at no\r\n	further charge.  You need not require recipients to copy the\r\n	Corresponding Source along with the object code.  If the place to\r\n	copy the object code is a network server, the Corresponding Source\r\n	may be on a different server (operated by you or a third party)\r\n	that supports equivalent copying facilities, provided you maintain\r\n	clear directions next to the object code saying where to find the\r\n	Corresponding Source.  Regardless of what server hosts the\r\n	Corresponding Source, you remain obligated to ensure that it is\r\n	available for as long as needed to satisfy these requirements.&lt;/li&gt;\r\n&lt;li&gt;e) Convey the object code using peer-to-peer transmission, provided\r\n	you inform other peers where the object code and Corresponding\r\n	Source of the work are being offered to the general public at no\r\n	charge under subsection 6d.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;A separable portion of the object code, whose source code is excluded\r\nfrom the Corresponding Source as a System Library, need not be\r\nincluded in conveying the object code work.&lt;/p&gt;\r\n&lt;p&gt;A &amp;ldquo;User Product&amp;rdquo; is either (1) a &amp;ldquo;consumer product&amp;rdquo;, which means any\r\ntangible personal property which is normally used for personal, family,\r\nor household purposes, or (2) anything designed or sold for incorporation\r\ninto a dwelling.  In determining whether a product is a consumer product,\r\ndoubtful cases shall be resolved in favor of coverage.  For a particular\r\nproduct received by a particular user, &amp;ldquo;normally used&amp;rdquo; refers to a\r\ntypical or common use of that class of product, regardless of the status\r\nof the particular user or of the way in which the particular user\r\nactually uses, or expects or is expected to use, the product.  A product\r\nis a consumer product regardless of whether the product has substantial\r\ncommercial, industrial or non-consumer uses, unless such uses represent\r\nthe only significant mode of use of the product.&lt;/p&gt;\r\n&lt;p&gt;&amp;ldquo;Installation Information&amp;rdquo; for a User Product means any methods,\r\nprocedures, authorization keys, or other information required to install\r\nand execute modified versions of a covered work in that User Product from\r\na modified version of its Corresponding Source.  The information must\r\nsuffice to ensure that the continued functioning of the modified object\r\ncode is in no case prevented or interfered with solely because\r\nmodification has been made.&lt;/p&gt;\r\n&lt;p&gt;If you convey an object code work under this section in, or with, or\r\nspecifically for use in, a User Product, and the conveying occurs as\r\npart of a transaction in which the right of possession and use of the\r\nUser Product is transferred to the recipient in perpetuity or for a\r\nfixed term (regardless of how the transaction is characterized), the\r\nCorresponding Source conveyed under this section must be accompanied\r\nby the Installation Information.  But this requirement does not apply\r\nif neither you nor any third party retains the ability to install\r\nmodified object code on the User Product (for example, the work has\r\nbeen installed in ROM).&lt;/p&gt;\r\n&lt;p&gt;The requirement to provide Installation Information does not include a\r\nrequirement to continue to provide support service, warranty, or updates\r\nfor a work that has been modified or installed by the recipient, or for\r\nthe User Product in which it has been modified or installed.  Access to a\r\nnetwork may be denied when the modification itself materially and\r\nadversely affects the operation of the network or violates the rules and\r\nprotocols for communication across the network.&lt;/p&gt;\r\n&lt;p&gt;Corresponding Source conveyed, and Installation Information provided,\r\nin accord with this section must be in a format that is publicly\r\ndocumented (and with an implementation available to the public in\r\nsource code form), and must require no special password or key for\r\nunpacking, reading or copying.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section7&quot;&gt;&lt;/a&gt;7. Additional Terms.&lt;/h4&gt;\r\n&lt;p&gt;&amp;ldquo;Additional permissions&amp;rdquo; are terms that supplement the terms of this\r\nLicense by making exceptions from one or more of its conditions.\r\nAdditional permissions that are applicable to the entire Program shall\r\nbe treated as though they were included in this License, to the extent\r\nthat they are valid under applicable law.  If additional permissions\r\napply only to part of the Program, that part may be used separately\r\nunder those permissions, but the entire Program remains governed by\r\nthis License without regard to the additional permissions.&lt;/p&gt;\r\n&lt;p&gt;When you convey a copy of a covered work, you may at your option\r\nremove any additional permissions from that copy, or from any part of\r\nit.  (Additional permissions may be written to require their own\r\nremoval in certain cases when you modify the work.)  You may place\r\nadditional permissions on material, added by you to a covered work,\r\nfor which you have or can give appropriate copyright permission.&lt;/p&gt;\r\n&lt;p&gt;Notwithstanding any other provision of this License, for material you\r\nadd to a covered work, you may (if authorized by the copyright holders of\r\nthat material) supplement the terms of this License with terms:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;a) Disclaiming warranty or limiting liability differently from the\r\n	terms of sections 15 and 16 of this License; or&lt;/li&gt;\r\n&lt;li&gt;b) Requiring preservation of specified reasonable legal notices or\r\n	author attributions in that material or in the Appropriate Legal\r\n	Notices displayed by works containing it; or&lt;/li&gt;\r\n&lt;li&gt;c) Prohibiting misrepresentation of the origin of that material, or\r\n	requiring that modified versions of such material be marked in\r\n	reasonable ways as different from the original version; or&lt;/li&gt;\r\n&lt;li&gt;d) Limiting the use for publicity purposes of names of licensors or\r\n	authors of the material; or&lt;/li&gt;\r\n&lt;li&gt;e) Declining to grant rights under trademark law for use of some\r\n	trade names, trademarks, or service marks; or&lt;/li&gt;\r\n&lt;li&gt;f) Requiring indemnification of licensors and authors of that\r\n	material by anyone who conveys the material (or modified versions of\r\n	it) with contractual assumptions of liability to the recipient, for\r\n	any liability that these contractual assumptions directly impose on\r\n	those licensors and authors.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;All other non-permissive additional terms are considered &amp;ldquo;further\r\nrestrictions&amp;rdquo; within the meaning of section 10.  If the Program as you\r\nreceived it, or any part of it, contains a notice stating that it is\r\ngoverned by this License along with a term that is a further\r\nrestriction, you may remove that term.  If a license document contains\r\na further restriction but permits relicensing or conveying under this\r\nLicense, you may add to a covered work material governed by the terms\r\nof that license document, provided that the further restriction does\r\nnot survive such relicensing or conveying.&lt;/p&gt;\r\n&lt;p&gt;If you add terms to a covered work in accord with this section, you\r\nmust place, in the relevant source files, a statement of the\r\nadditional terms that apply to those files, or a notice indicating\r\nwhere to find the applicable terms.&lt;/p&gt;\r\n&lt;p&gt;Additional terms, permissive or non-permissive, may be stated in the\r\nform of a separately written license, or stated as exceptions;\r\nthe above requirements apply either way.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section8&quot;&gt;&lt;/a&gt;8. Termination.&lt;/h4&gt;\r\n&lt;p&gt;You may not propagate or modify a covered work except as expressly\r\nprovided under this License.  Any attempt otherwise to propagate or\r\nmodify it is void, and will automatically terminate your rights under\r\nthis License (including any patent licenses granted under the third\r\nparagraph of section 11).&lt;/p&gt;\r\n&lt;p&gt;However, if you cease all violation of this License, then your\r\nlicense from a particular copyright holder is reinstated (a)\r\nprovisionally, unless and until the copyright holder explicitly and\r\nfinally terminates your license, and (b) permanently, if the copyright\r\nholder fails to notify you of the violation by some reasonable means\r\nprior to 60 days after the cessation.&lt;/p&gt;\r\n&lt;p&gt;Moreover, your license from a particular copyright holder is\r\nreinstated permanently if the copyright holder notifies you of the\r\nviolation by some reasonable means, this is the first time you have\r\nreceived notice of violation of this License (for any work) from that\r\ncopyright holder, and you cure the violation prior to 30 days after\r\nyour receipt of the notice.&lt;/p&gt;\r\n&lt;p&gt;Termination of your rights under this section does not terminate the\r\nlicenses of parties who have received copies or rights from you under\r\nthis License.  If your rights have been terminated and not permanently\r\nreinstated, you do not qualify to receive new licenses for the same\r\nmaterial under section 10.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section9&quot;&gt;&lt;/a&gt;9. Acceptance Not Required for Having Copies.&lt;/h4&gt;\r\n&lt;p&gt;You are not required to accept this License in order to receive or\r\nrun a copy of the Program.  Ancillary propagation of a covered work\r\noccurring solely as a consequence of using peer-to-peer transmission\r\nto receive a copy likewise does not require acceptance.  However,\r\nnothing other than this License grants you permission to propagate or\r\nmodify any covered work.  These actions infringe copyright if you do\r\nnot accept this License.  Therefore, by modifying or propagating a\r\ncovered work, you indicate your acceptance of this License to do so.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section10&quot;&gt;&lt;/a&gt;10. Automatic Licensing of Downstream Recipients.&lt;/h4&gt;\r\n&lt;p&gt;Each time you convey a covered work, the recipient automatically\r\nreceives a license from the original licensors, to run, modify and\r\npropagate that work, subject to this License.  You are not responsible\r\nfor enforcing compliance by third parties with this License.&lt;/p&gt;\r\n&lt;p&gt;An &amp;ldquo;entity transaction&amp;rdquo; is a transaction transferring control of an\r\norganization, or substantially all assets of one, or subdividing an\r\norganization, or merging organizations.  If propagation of a covered\r\nwork results from an entity transaction, each party to that\r\ntransaction who receives a copy of the work also receives whatever\r\nlicenses to the work the party&#039;s predecessor in interest had or could\r\ngive under the previous paragraph, plus a right to possession of the\r\nCorresponding Source of the work from the predecessor in interest, if\r\nthe predecessor has it or can get it with reasonable efforts.&lt;/p&gt;\r\n&lt;p&gt;You may not impose any further restrictions on the exercise of the\r\nrights granted or affirmed under this License.  For example, you may\r\nnot impose a license fee, royalty, or other charge for exercise of\r\nrights granted under this License, and you may not initiate litigation\r\n(including a cross-claim or counterclaim in a lawsuit) alleging that\r\nany patent claim is infringed by making, using, selling, offering for\r\nsale, or importing the Program or any portion of it.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section11&quot;&gt;&lt;/a&gt;11. Patents.&lt;/h4&gt;\r\n&lt;p&gt;A &amp;ldquo;contributor&amp;rdquo; is a copyright holder who authorizes use under this\r\nLicense of the Program or a work on which the Program is based.  The\r\nwork thus licensed is called the contributor&#039;s &amp;ldquo;contributor version&amp;rdquo;.&lt;/p&gt;\r\n&lt;p&gt;A contributor&#039;s &amp;ldquo;essential patent claims&amp;rdquo; are all patent claims\r\nowned or controlled by the contributor, whether already acquired or\r\nhereafter acquired, that would be infringed by some manner, permitted\r\nby this License, of making, using, or selling its contributor version,\r\nbut do not include claims that would be infringed only as a\r\nconsequence of further modification of the contributor version.  For\r\npurposes of this definition, &amp;ldquo;control&amp;rdquo; includes the right to grant\r\npatent sublicenses in a manner consistent with the requirements of\r\nthis License.&lt;/p&gt;\r\n&lt;p&gt;Each contributor grants you a non-exclusive, worldwide, royalty-free\r\npatent license under the contributor&#039;s essential patent claims, to\r\nmake, use, sell, offer for sale, import and otherwise run, modify and\r\npropagate the contents of its contributor version.&lt;/p&gt;\r\n&lt;p&gt;In the following three paragraphs, a &amp;ldquo;patent license&amp;rdquo; is any express\r\nagreement or commitment, however denominated, not to enforce a patent\r\n(such as an express permission to practice a patent or covenant not to\r\nsue for patent infringement).  To &amp;ldquo;grant&amp;rdquo; such a patent license to a\r\nparty means to make such an agreement or commitment not to enforce a\r\npatent against the party.&lt;/p&gt;\r\n&lt;p&gt;If you convey a covered work, knowingly relying on a patent license,\r\nand the Corresponding Source of the work is not available for anyone\r\nto copy, free of charge and under the terms of this License, through a\r\npublicly available network server or other readily accessible means,\r\nthen you must either (1) cause the Corresponding Source to be so\r\navailable, or (2) arrange to deprive yourself of the benefit of the\r\npatent license for this particular work, or (3) arrange, in a manner\r\nconsistent with the requirements of this License, to extend the patent\r\nlicense to downstream recipients.  &amp;ldquo;Knowingly relying&amp;rdquo; means you have\r\nactual knowledge that, but for the patent license, your conveying the\r\ncovered work in a country, or your recipient&#039;s use of the covered work\r\nin a country, would infringe one or more identifiable patents in that\r\ncountry that you have reason to believe are valid.&lt;/p&gt;\r\n&lt;p&gt;If, pursuant to or in connection with a single transaction or\r\narrangement, you convey, or propagate by procuring conveyance of, a\r\ncovered work, and grant a patent license to some of the parties\r\nreceiving the covered work authorizing them to use, propagate, modify\r\nor convey a specific copy of the covered work, then the patent license\r\nyou grant is automatically extended to all recipients of the covered\r\nwork and works based on it.&lt;/p&gt;\r\n&lt;p&gt;A patent license is &amp;ldquo;discriminatory&amp;rdquo; if it does not include within\r\nthe scope of its coverage, prohibits the exercise of, or is\r\nconditioned on the non-exercise of one or more of the rights that are\r\nspecifically granted under this License.  You may not convey a covered\r\nwork if you are a party to an arrangement with a third party that is\r\nin the business of distributing software, under which you make payment\r\nto the third party based on the extent of your activity of conveying\r\nthe work, and under which the third party grants, to any of the\r\nparties who would receive the covered work from you, a discriminatory\r\npatent license (a) in connection with copies of the covered work\r\nconveyed by you (or copies made from those copies), or (b) primarily\r\nfor and in connection with specific products or compilations that\r\ncontain the covered work, unless you entered into that arrangement,\r\nor that patent license was granted, prior to 28 March 2007.&lt;/p&gt;\r\n&lt;p&gt;Nothing in this License shall be construed as excluding or limiting\r\nany implied license or other defenses to infringement that may\r\notherwise be available to you under applicable patent law.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section12&quot;&gt;&lt;/a&gt;12. No Surrender of Others&#039; Freedom.&lt;/h4&gt;\r\n&lt;p&gt;If conditions are imposed on you (whether by court order, agreement or\r\notherwise) that contradict the conditions of this License, they do not\r\nexcuse you from the conditions of this License.  If you cannot convey a\r\ncovered work so as to satisfy simultaneously your obligations under this\r\nLicense and any other pertinent obligations, then as a consequence you may\r\nnot convey it at all.  For example, if you agree to terms that obligate you\r\nto collect a royalty for further conveying from those to whom you convey\r\nthe Program, the only way you could satisfy both those terms and this\r\nLicense would be to refrain entirely from conveying the Program.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section13&quot;&gt;&lt;/a&gt;13. Use with the GNU Affero General Public License.&lt;/h4&gt;\r\n&lt;p&gt;Notwithstanding any other provision of this License, you have\r\npermission to link or combine any covered work with a work licensed\r\nunder version 3 of the GNU Affero General Public License into a single\r\ncombined work, and to convey the resulting work.  The terms of this\r\nLicense will continue to apply to the part which is the covered work,\r\nbut the special requirements of the GNU Affero General Public License,\r\nsection 13, concerning interaction through a network will apply to the\r\ncombination as such.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section14&quot;&gt;&lt;/a&gt;14. Revised Versions of this License.&lt;/h4&gt;\r\n&lt;p&gt;The Free Software Foundation may publish revised and/or new versions of\r\nthe GNU General Public License from time to time.  Such new versions will\r\nbe similar in spirit to the present version, but may differ in detail to\r\naddress new problems or concerns.&lt;/p&gt;\r\n&lt;p&gt;Each version is given a distinguishing version number.  If the\r\nProgram specifies that a certain numbered version of the GNU General\r\nPublic License &amp;ldquo;or any later version&amp;rdquo; applies to it, you have the\r\noption of following the terms and conditions either of that numbered\r\nversion or of any later version published by the Free Software\r\nFoundation.  If the Program does not specify a version number of the\r\nGNU General Public License, you may choose any version ever published\r\nby the Free Software Foundation.&lt;/p&gt;\r\n&lt;p&gt;If the Program specifies that a proxy can decide which future\r\nversions of the GNU General Public License can be used, that proxy&#039;s\r\npublic statement of acceptance of a version permanently authorizes you\r\nto choose that version for the Program.&lt;/p&gt;\r\n&lt;p&gt;Later license versions may give you additional or different\r\npermissions.  However, no additional obligations are imposed on any\r\nauthor or copyright holder as a result of your choosing to follow a\r\nlater version.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section15&quot;&gt;&lt;/a&gt;15. Disclaimer of Warranty.&lt;/h4&gt;\r\n&lt;p&gt;THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY\r\nAPPLICABLE LAW.  EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT\r\nHOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &amp;ldquo;AS IS&amp;rdquo; WITHOUT WARRANTY\r\nOF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO,\r\nTHE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR\r\nPURPOSE.  THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM\r\nIS WITH YOU.  SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF\r\nALL NECESSARY SERVICING, REPAIR OR CORRECTION.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section16&quot;&gt;&lt;/a&gt;16. Limitation of Liability.&lt;/h4&gt;\r\n&lt;p&gt;IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING\r\nWILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MODIFIES AND/OR CONVEYS\r\nTHE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY\r\nGENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE\r\nUSE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF\r\nDATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD\r\nPARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS),\r\nEVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF\r\nSUCH DAMAGES.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section17&quot;&gt;&lt;/a&gt;17. Interpretation of Sections 15 and 16.&lt;/h4&gt;\r\n&lt;p&gt;If the disclaimer of warranty and limitation of liability provided\r\nabove cannot be given local legal effect according to their terms,\r\nreviewing courts shall apply local law that most closely approximates\r\nan absolute waiver of all civil liability in connection with the\r\nProgram, unless a warranty or assumption of liability accompanies a\r\ncopy of the Program in return for a fee.&lt;/p&gt;\r\n&lt;p&gt;END OF TERMS AND CONDITIONS&lt;/p&gt;\r\n&lt;h3&gt;&lt;a name__________&quot;howto&quot;&gt;&lt;/a&gt;How to Apply These Terms to Your New Programs&lt;/h3&gt;\r\n&lt;p&gt;If you develop a new program, and you want it to be of the greatest\r\npossible use to the public, the best way to achieve this is to make it\r\nfree software which everyone can redistribute and change under these terms.&lt;/p&gt;\r\n&lt;p&gt;To do so, attach the following notices to the program.  It is safest\r\nto attach them to the start of each source file to most effectively\r\nstate the exclusion of warranty; and each file should have at least\r\nthe &amp;ldquo;copyright&amp;rdquo; line and a pointer to where the full notice is found.&lt;/p&gt;\r\n&lt;pre&gt;    toendaCMS - Your ideas ahead!&lt;br /&gt;&lt;br /&gt;Copyright (C) 2003 - 2008  Jonathan Naumann - Toenda Software Development&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;This program is free software: you can redistribute it and/or modify&lt;br /&gt;&lt;br /&gt;it under the terms of the GNU General Public License as published by&lt;br /&gt;&lt;br /&gt;the Free Software Foundation, either version 3 of the License, or&lt;br /&gt;&lt;br /&gt;(at your option) any later version.&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;This program is distributed in the hope that it will be useful,&lt;br /&gt;&lt;br /&gt;but WITHOUT ANY WARRANTY; without even the implied warranty of&lt;br /&gt;&lt;br /&gt;MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the&lt;br /&gt;&lt;br /&gt;GNU General Public License for more details.&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;You should have received a copy of the GNU General Public License&lt;br /&gt;&lt;br /&gt;along with this program.  If not, see .&lt;br /&gt;&lt;br /&gt;&lt;/pre&gt;\r\n&lt;p&gt;Also add information on how to contact you by electronic and paper mail.&lt;/p&gt;\r\n&lt;p&gt;If the program does terminal interaction, make it output a short\r\nnotice like this when it starts in an interactive mode:&lt;/p&gt;\r\n&lt;pre&gt;    toendaCMS - Your ideas ahead! Copyright (C) 2003 - 2008 Jonathan naumann - Toenda Software Development&lt;br /&gt;&lt;br /&gt;This program comes with ABSOLUTELY NO WARRANTY; for details type `show w&#039;.&lt;br /&gt;&lt;br /&gt;This is free software, and you are welcome to redistribute it&lt;br /&gt;&lt;br /&gt;under certain conditions; type `show c&#039; for details.&lt;br /&gt;&lt;br /&gt;&lt;/pre&gt;\r\n&lt;p&gt;The hypothetical commands `show w&#039; and `show c&#039; should show the appropriate\r\nparts of the General Public License.  Of course, your program&#039;s commands\r\nmight be different; for a GUI interface, you would use an &amp;ldquo;about box&amp;rdquo;.&lt;/p&gt;\r\n&lt;p&gt;You should also get your employer (if you work as a programmer) or school,\r\nif any, to sign a &amp;ldquo;copyright disclaimer&amp;rdquo; for the program, if necessary.\r\nFor more information on this, and how to apply and follow the GNU GPL, see\r\n.&lt;/p&gt;\r\n&lt;p&gt;The GNU General Public License does not permit incorporating your program\r\ninto proprietary programs.  If your program is a subroutine library, you\r\nmay consider it more useful to permit linking proprietary applications with\r\nthe library.  If this is what you want to do, use the GNU Lesser General\r\nPublic License instead of this License.  But first, please read\r\n.&lt;/p&gt;', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'germany_DE'),
('66115', 'sub1', 'test text in english', 'test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in english test text in englishtest text in englishtest text in english test text in english&lt;br /&gt;\r\n', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'english_EN'),
('3ce0c', 'Test', '', '{php:}echo &quot;hallo php&quot;;{:php}\r\n', '', '', 'db_content_default.php', 'Public', 1, 1, 'root', 'germany_DE'),
('8521c', 'Neuigkeiten', NULL, NULL, NULL, NULL, NULL, 'Public', 0, 0, 'root', NULL),
('bcdea', 'Seite 1', NULL, NULL, NULL, NULL, NULL, 'Public', 0, 0, 'root', NULL),
('7ea00', 'Seite 2', NULL, NULL, NULL, NULL, NULL, 'Public', 0, 0, 'root', NULL);

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
) ;

--
-- Daten für Tabelle `#####content_languages`
--

INSERT INTO `#####content_languages` (`uid`, `content_uid`, `language`, `title`, `key`, `content00`, `content01`, `foot`, `autor`, `db_layout`, `access`, `in_work`, `published`) VALUES
('fdgd7', '18e2a', 'germany_DE', 'Die toendaCMS Lizenz', 'GNU General Public License', '&lt;h3 style__________&quot;text-align: center&quot;&gt;GNU GENERAL PUBLIC LICENSE&lt;/h3&gt;\r\n&lt;p style__________&quot;text-align: center&quot;&gt;Version 3, 29 June 2007&lt;/p&gt;\r\n&lt;p&gt;Copyright &amp;copy; 2007 Free Software Foundation, Inc.&lt;/p&gt;\r\n&lt;p&gt;Everyone is permitted to copy and distribute verbatim copies\r\nof this license document, but changing it is not allowed.&lt;/p&gt;\r\n&lt;h3&gt;&lt;a name__________&quot;preamble&quot;&gt;&lt;/a&gt;Preamble&lt;/h3&gt;\r\n&lt;p&gt;The GNU General Public License is a free, copyleft license for\r\nsoftware and other kinds of works.&lt;/p&gt;\r\n&lt;p&gt;The licenses for most software and other practical works are designed\r\nto take away your freedom to share and change the works.  By contrast,\r\nthe GNU General Public License is intended to guarantee your freedom to\r\nshare and change all versions of a program--to make sure it remains free\r\nsoftware for all its users.  We, the Free Software Foundation, use the\r\nGNU General Public License for most of our software; it applies also to\r\nany other work released this way by its authors.  You can apply it to\r\nyour programs, too.&lt;/p&gt;\r\n&lt;p&gt;When we speak of free software, we are referring to freedom, not\r\nprice.  Our General Public Licenses are designed to make sure that you\r\nhave the freedom to distribute copies of free software (and charge for\r\nthem if you wish), that you receive source code or can get it if you\r\nwant it, that you can change the software or use pieces of it in new\r\nfree programs, and that you know you can do these things.&lt;/p&gt;\r\n&lt;p&gt;To protect your rights, we need to prevent others from denying you\r\nthese rights or asking you to surrender the rights.  Therefore, you have\r\ncertain responsibilities if you distribute copies of the software, or if\r\nyou modify it: responsibilities to respect the freedom of others.&lt;/p&gt;\r\n&lt;p&gt;For example, if you distribute copies of such a program, whether\r\ngratis or for a fee, you must pass on to the recipients the same\r\nfreedoms that you received.  You must make sure that they, too, receive\r\nor can get the source code.  And you must show them these terms so they\r\nknow their rights.&lt;/p&gt;\r\n&lt;p&gt;Developers that use the GNU GPL protect your rights with two steps:\r\n(1) assert copyright on the software, and (2) offer you this License\r\ngiving you legal permission to copy, distribute and/or modify it.&lt;/p&gt;\r\n&lt;p&gt;For the developers&#039; and authors&#039; protection, the GPL clearly explains\r\nthat there is no warranty for this free software.  For both users&#039; and\r\nauthors&#039; sake, the GPL requires that modified versions be marked as\r\nchanged, so that their problems will not be attributed erroneously to\r\nauthors of previous versions.&lt;/p&gt;\r\n&lt;p&gt;Some devices are designed to deny users access to install or run\r\nmodified versions of the software inside them, although the manufacturer\r\ncan do so.  This is fundamentally incompatible with the aim of\r\nprotecting users&#039; freedom to change the software.  The systematic\r\npattern of such abuse occurs in the area of products for individuals to\r\nuse, which is precisely where it is most unacceptable.  Therefore, we\r\nhave designed this version of the GPL to prohibit the practice for those\r\nproducts.  If such problems arise substantially in other domains, we\r\nstand ready to extend this provision to those domains in future versions\r\nof the GPL, as needed to protect the freedom of users.&lt;/p&gt;\r\n&lt;p&gt;Finally, every program is threatened constantly by software patents.\r\nStates should not allow patents to restrict development and use of\r\nsoftware on general-purpose computers, but in those that do, we wish to\r\navoid the special danger that patents applied to a free program could\r\nmake it effectively proprietary.  To prevent this, the GPL assures that\r\npatents cannot be used to render the program non-free.&lt;/p&gt;\r\n&lt;p&gt;The precise terms and conditions for copying, distribution and\r\nmodification follow.&lt;/p&gt;\r\n&lt;h3&gt;&lt;a name__________&quot;terms&quot;&gt;&lt;/a&gt;TERMS AND CONDITIONS&lt;/h3&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section0&quot;&gt;&lt;/a&gt;0. Definitions.&lt;/h4&gt;\r\n&lt;p&gt;&amp;ldquo;This License&amp;rdquo; refers to version 3 of the GNU General Public License.&lt;/p&gt;\r\n&lt;p&gt;&amp;ldquo;Copyright&amp;rdquo; also means copyright-like laws that apply to other kinds of\r\nworks, such as semiconductor masks.&lt;/p&gt;\r\n&lt;p&gt;&amp;ldquo;The Program&amp;rdquo; refers to any copyrightable work licensed under this\r\nLicense.  Each licensee is addressed as &amp;ldquo;you&amp;rdquo;.  &amp;ldquo;Licensees&amp;rdquo; and\r\n&amp;ldquo;recipients&amp;rdquo; may be individuals or organizations.&lt;/p&gt;\r\n&lt;p&gt;To &amp;ldquo;modify&amp;rdquo; a work means to copy from or adapt all or part of the work\r\nin a fashion requiring copyright permission, other than the making of an\r\nexact copy.  The resulting work is called a &amp;ldquo;modified version&amp;rdquo; of the\r\nearlier work or a work &amp;ldquo;based on&amp;rdquo; the earlier work.&lt;/p&gt;\r\n&lt;p&gt;A &amp;ldquo;covered work&amp;rdquo; means either the unmodified Program or a work based\r\non the Program.&lt;/p&gt;\r\n&lt;p&gt;To &amp;ldquo;propagate&amp;rdquo; a work means to do anything with it that, without\r\npermission, would make you directly or secondarily liable for\r\ninfringement under applicable copyright law, except executing it on a\r\ncomputer or modifying a private copy.  Propagation includes copying,\r\ndistribution (with or without modification), making available to the\r\npublic, and in some countries other activities as well.&lt;/p&gt;\r\n&lt;p&gt;To &amp;ldquo;convey&amp;rdquo; a work means any kind of propagation that enables other\r\nparties to make or receive copies.  Mere interaction with a user through\r\na computer network, with no transfer of a copy, is not conveying.&lt;/p&gt;\r\n&lt;p&gt;An interactive user interface displays &amp;ldquo;Appropriate Legal Notices&amp;rdquo;\r\nto the extent that it includes a convenient and prominently visible\r\nfeature that (1) displays an appropriate copyright notice, and (2)\r\ntells the user that there is no warranty for the work (except to the\r\nextent that warranties are provided), that licensees may convey the\r\nwork under this License, and how to view a copy of this License.  If\r\nthe interface presents a list of user commands or options, such as a\r\nmenu, a prominent item in the list meets this criterion.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section1&quot;&gt;&lt;/a&gt;1. Source Code.&lt;/h4&gt;\r\n&lt;p&gt;The &amp;ldquo;source code&amp;rdquo; for a work means the preferred form of the work\r\nfor making modifications to it.  &amp;ldquo;Object code&amp;rdquo; means any non-source\r\nform of a work.&lt;/p&gt;\r\n&lt;p&gt;A &amp;ldquo;Standard Interface&amp;rdquo; means an interface that either is an official\r\nstandard defined by a recognized standards body, or, in the case of\r\ninterfaces specified for a particular programming language, one that\r\nis widely used among developers working in that language.&lt;/p&gt;\r\n&lt;p&gt;The &amp;ldquo;System Libraries&amp;rdquo; of an executable work include anything, other\r\nthan the work as a whole, that (a) is included in the normal form of\r\npackaging a Major Component, but which is not part of that Major\r\nComponent, and (b) serves only to enable use of the work with that\r\nMajor Component, or to implement a Standard Interface for which an\r\nimplementation is available to the public in source code form.  A\r\n&amp;ldquo;Major Component&amp;rdquo;, in this context, means a major essential component\r\n(kernel, window system, and so on) of the specific operating system\r\n(if any) on which the executable work runs, or a compiler used to\r\nproduce the work, or an object code interpreter used to run it.&lt;/p&gt;\r\n&lt;p&gt;The &amp;ldquo;Corresponding Source&amp;rdquo; for a work in object code form means all\r\nthe source code needed to generate, install, and (for an executable\r\nwork) run the object code and to modify the work, including scripts to\r\ncontrol those activities.  However, it does not include the work&#039;s\r\nSystem Libraries, or general-purpose tools or generally available free\r\nprograms which are used unmodified in performing those activities but\r\nwhich are not part of the work.  For example, Corresponding Source\r\nincludes interface definition files associated with source files for\r\nthe work, and the source code for shared libraries and dynamically\r\nlinked subprograms that the work is specifically designed to require,\r\nsuch as by intimate data communication or control flow between those\r\nsubprograms and other parts of the work.&lt;/p&gt;\r\n&lt;p&gt;The Corresponding Source need not include anything that users\r\ncan regenerate automatically from other parts of the Corresponding\r\nSource.&lt;/p&gt;\r\n&lt;p&gt;The Corresponding Source for a work in source code form is that\r\nsame work.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section2&quot;&gt;&lt;/a&gt;2. Basic Permissions.&lt;/h4&gt;\r\n&lt;p&gt;All rights granted under this License are granted for the term of\r\ncopyright on the Program, and are irrevocable provided the stated\r\nconditions are met.  This License explicitly affirms your unlimited\r\npermission to run the unmodified Program.  The output from running a\r\ncovered work is covered by this License only if the output, given its\r\ncontent, constitutes a covered work.  This License acknowledges your\r\nrights of fair use or other equivalent, as provided by copyright law.&lt;/p&gt;\r\n&lt;p&gt;You may make, run and propagate covered works that you do not\r\nconvey, without conditions so long as your license otherwise remains\r\nin force.  You may convey covered works to others for the sole purpose\r\nof having them make modifications exclusively for you, or provide you\r\nwith facilities for running those works, provided that you comply with\r\nthe terms of this License in conveying all material for which you do\r\nnot control copyright.  Those thus making or running the covered works\r\nfor you must do so exclusively on your behalf, under your direction\r\nand control, on terms that prohibit them from making any copies of\r\nyour copyrighted material outside their relationship with you.&lt;/p&gt;\r\n&lt;p&gt;Conveying under any other circumstances is permitted solely under\r\nthe conditions stated below.  Sublicensing is not allowed; section 10\r\nmakes it unnecessary.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section3&quot;&gt;&lt;/a&gt;3. Protecting Users&#039; Legal Rights From Anti-Circumvention Law.&lt;/h4&gt;\r\n&lt;p&gt;No covered work shall be deemed part of an effective technological\r\nmeasure under any applicable law fulfilling obligations under article\r\n11 of the WIPO copyright treaty adopted on 20 December 1996, or\r\nsimilar laws prohibiting or restricting circumvention of such\r\nmeasures.&lt;/p&gt;\r\n&lt;p&gt;When you convey a covered work, you waive any legal power to forbid\r\ncircumvention of technological measures to the extent such circumvention\r\nis effected by exercising rights under this License with respect to\r\nthe covered work, and you disclaim any intention to limit operation or\r\nmodification of the work as a means of enforcing, against the work&#039;s\r\nusers, your or third parties&#039; legal rights to forbid circumvention of\r\ntechnological measures.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section4&quot;&gt;&lt;/a&gt;4. Conveying Verbatim Copies.&lt;/h4&gt;\r\n&lt;p&gt;You may convey verbatim copies of the Program&#039;s source code as you\r\nreceive it, in any medium, provided that you conspicuously and\r\nappropriately publish on each copy an appropriate copyright notice;\r\nkeep intact all notices stating that this License and any\r\nnon-permissive terms added in accord with section 7 apply to the code;\r\nkeep intact all notices of the absence of any warranty; and give all\r\nrecipients a copy of this License along with the Program.&lt;/p&gt;\r\n&lt;p&gt;You may charge any price or no price for each copy that you convey,\r\nand you may offer support or warranty protection for a fee.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section5&quot;&gt;&lt;/a&gt;5. Conveying Modified Source Versions.&lt;/h4&gt;\r\n&lt;p&gt;You may convey a work based on the Program, or the modifications to\r\nproduce it from the Program, in the form of source code under the\r\nterms of section 4, provided that you also meet all of these conditions:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;a) The work must carry prominent notices stating that you modified\r\n	it, and giving a relevant date.&lt;/li&gt;\r\n&lt;li&gt;b) The work must carry prominent notices stating that it is\r\n	released under this License and any conditions added under section\r\n	7.  This requirement modifies the requirement in section 4 to\r\n	&amp;ldquo;keep intact all notices&amp;rdquo;.&lt;/li&gt;\r\n&lt;li&gt;c) You must license the entire work, as a whole, under this\r\n	License to anyone who comes into possession of a copy.  This\r\n	License will therefore apply, along with any applicable section 7\r\n	additional terms, to the whole of the work, and all its parts,\r\n	regardless of how they are packaged.  This License gives no\r\n	permission to license the work in any other way, but it does not\r\n	invalidate such permission if you have separately received it.&lt;/li&gt;\r\n&lt;li&gt;d) If the work has interactive user interfaces, each must display\r\n	Appropriate Legal Notices; however, if the Program has interactive\r\n	interfaces that do not display Appropriate Legal Notices, your\r\n	work need not make them do so.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;A compilation of a covered work with other separate and independent\r\nworks, which are not by their nature extensions of the covered work,\r\nand which are not combined with it such as to form a larger program,\r\nin or on a volume of a storage or distribution medium, is called an\r\n&amp;ldquo;aggregate&amp;rdquo; if the compilation and its resulting copyright are not\r\nused to limit the access or legal rights of the compilation&#039;s users\r\nbeyond what the individual works permit.  Inclusion of a covered work\r\nin an aggregate does not cause this License to apply to the other\r\nparts of the aggregate.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section6&quot;&gt;&lt;/a&gt;6. Conveying Non-Source Forms.&lt;/h4&gt;\r\n&lt;p&gt;You may convey a covered work in object code form under the terms\r\nof sections 4 and 5, provided that you also convey the\r\nmachine-readable Corresponding Source under the terms of this License,\r\nin one of these ways:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;a) Convey the object code in, or embodied in, a physical product\r\n	(including a physical distribution medium), accompanied by the\r\n	Corresponding Source fixed on a durable physical medium\r\n	customarily used for software interchange.&lt;/li&gt;\r\n&lt;li&gt;b) Convey the object code in, or embodied in, a physical product\r\n	(including a physical distribution medium), accompanied by a\r\n	written offer, valid for at least three years and valid for as\r\n	long as you offer spare parts or customer support for that product\r\n	model, to give anyone who possesses the object code either (1) a\r\n	copy of the Corresponding Source for all the software in the\r\n	product that is covered by this License, on a durable physical\r\n	medium customarily used for software interchange, for a price no\r\n	more than your reasonable cost of physically performing this\r\n	conveying of source, or (2) access to copy the\r\n	Corresponding Source from a network server at no charge.&lt;/li&gt;\r\n&lt;li&gt;c) Convey individual copies of the object code with a copy of the\r\n	written offer to provide the Corresponding Source.  This\r\n	alternative is allowed only occasionally and noncommercially, and\r\n	only if you received the object code with such an offer, in accord\r\n	with subsection 6b.&lt;/li&gt;\r\n&lt;li&gt;d) Convey the object code by offering access from a designated\r\n	place (gratis or for a charge), and offer equivalent access to the\r\n	Corresponding Source in the same way through the same place at no\r\n	further charge.  You need not require recipients to copy the\r\n	Corresponding Source along with the object code.  If the place to\r\n	copy the object code is a network server, the Corresponding Source\r\n	may be on a different server (operated by you or a third party)\r\n	that supports equivalent copying facilities, provided you maintain\r\n	clear directions next to the object code saying where to find the\r\n	Corresponding Source.  Regardless of what server hosts the\r\n	Corresponding Source, you remain obligated to ensure that it is\r\n	available for as long as needed to satisfy these requirements.&lt;/li&gt;\r\n&lt;li&gt;e) Convey the object code using peer-to-peer transmission, provided\r\n	you inform other peers where the object code and Corresponding\r\n	Source of the work are being offered to the general public at no\r\n	charge under subsection 6d.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;A separable portion of the object code, whose source code is excluded\r\nfrom the Corresponding Source as a System Library, need not be\r\nincluded in conveying the object code work.&lt;/p&gt;\r\n&lt;p&gt;A &amp;ldquo;User Product&amp;rdquo; is either (1) a &amp;ldquo;consumer product&amp;rdquo;, which means any\r\ntangible personal property which is normally used for personal, family,\r\nor household purposes, or (2) anything designed or sold for incorporation\r\ninto a dwelling.  In determining whether a product is a consumer product,\r\ndoubtful cases shall be resolved in favor of coverage.  For a particular\r\nproduct received by a particular user, &amp;ldquo;normally used&amp;rdquo; refers to a\r\ntypical or common use of that class of product, regardless of the status\r\nof the particular user or of the way in which the particular user\r\nactually uses, or expects or is expected to use, the product.  A product\r\nis a consumer product regardless of whether the product has substantial\r\ncommercial, industrial or non-consumer uses, unless such uses represent\r\nthe only significant mode of use of the product.&lt;/p&gt;\r\n&lt;p&gt;&amp;ldquo;Installation Information&amp;rdquo; for a User Product means any methods,\r\nprocedures, authorization keys, or other information required to install\r\nand execute modified versions of a covered work in that User Product from\r\na modified version of its Corresponding Source.  The information must\r\nsuffice to ensure that the continued functioning of the modified object\r\ncode is in no case prevented or interfered with solely because\r\nmodification has been made.&lt;/p&gt;\r\n&lt;p&gt;If you convey an object code work under this section in, or with, or\r\nspecifically for use in, a User Product, and the conveying occurs as\r\npart of a transaction in which the right of possession and use of the\r\nUser Product is transferred to the recipient in perpetuity or for a\r\nfixed term (regardless of how the transaction is characterized), the\r\nCorresponding Source conveyed under this section must be accompanied\r\nby the Installation Information.  But this requirement does not apply\r\nif neither you nor any third party retains the ability to install\r\nmodified object code on the User Product (for example, the work has\r\nbeen installed in ROM).&lt;/p&gt;\r\n&lt;p&gt;The requirement to provide Installation Information does not include a\r\nrequirement to continue to provide support service, warranty, or updates\r\nfor a work that has been modified or installed by the recipient, or for\r\nthe User Product in which it has been modified or installed.  Access to a\r\nnetwork may be denied when the modification itself materially and\r\nadversely affects the operation of the network or violates the rules and\r\nprotocols for communication across the network.&lt;/p&gt;\r\n&lt;p&gt;Corresponding Source conveyed, and Installation Information provided,\r\nin accord with this section must be in a format that is publicly\r\ndocumented (and with an implementation available to the public in\r\nsource code form), and must require no special password or key for\r\nunpacking, reading or copying.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section7&quot;&gt;&lt;/a&gt;7. Additional Terms.&lt;/h4&gt;\r\n&lt;p&gt;&amp;ldquo;Additional permissions&amp;rdquo; are terms that supplement the terms of this\r\nLicense by making exceptions from one or more of its conditions.\r\nAdditional permissions that are applicable to the entire Program shall\r\nbe treated as though they were included in this License, to the extent\r\nthat they are valid under applicable law.  If additional permissions\r\napply only to part of the Program, that part may be used separately\r\nunder those permissions, but the entire Program remains governed by\r\nthis License without regard to the additional permissions.&lt;/p&gt;\r\n&lt;p&gt;When you convey a copy of a covered work, you may at your option\r\nremove any additional permissions from that copy, or from any part of\r\nit.  (Additional permissions may be written to require their own\r\nremoval in certain cases when you modify the work.)  You may place\r\nadditional permissions on material, added by you to a covered work,\r\nfor which you have or can give appropriate copyright permission.&lt;/p&gt;\r\n&lt;p&gt;Notwithstanding any other provision of this License, for material you\r\nadd to a covered work, you may (if authorized by the copyright holders of\r\nthat material) supplement the terms of this License with terms:&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;a) Disclaiming warranty or limiting liability differently from the\r\n	terms of sections 15 and 16 of this License; or&lt;/li&gt;\r\n&lt;li&gt;b) Requiring preservation of specified reasonable legal notices or\r\n	author attributions in that material or in the Appropriate Legal\r\n	Notices displayed by works containing it; or&lt;/li&gt;\r\n&lt;li&gt;c) Prohibiting misrepresentation of the origin of that material, or\r\n	requiring that modified versions of such material be marked in\r\n	reasonable ways as different from the original version; or&lt;/li&gt;\r\n&lt;li&gt;d) Limiting the use for publicity purposes of names of licensors or\r\n	authors of the material; or&lt;/li&gt;\r\n&lt;li&gt;e) Declining to grant rights under trademark law for use of some\r\n	trade names, trademarks, or service marks; or&lt;/li&gt;\r\n&lt;li&gt;f) Requiring indemnification of licensors and authors of that\r\n	material by anyone who conveys the material (or modified versions of\r\n	it) with contractual assumptions of liability to the recipient, for\r\n	any liability that these contractual assumptions directly impose on\r\n	those licensors and authors.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;All other non-permissive additional terms are considered &amp;ldquo;further\r\nrestrictions&amp;rdquo; within the meaning of section 10.  If the Program as you\r\nreceived it, or any part of it, contains a notice stating that it is\r\ngoverned by this License along with a term that is a further\r\nrestriction, you may remove that term.  If a license document contains\r\na further restriction but permits relicensing or conveying under this\r\nLicense, you may add to a covered work material governed by the terms\r\nof that license document, provided that the further restriction does\r\nnot survive such relicensing or conveying.&lt;/p&gt;\r\n&lt;p&gt;If you add terms to a covered work in accord with this section, you\r\nmust place, in the relevant source files, a statement of the\r\nadditional terms that apply to those files, or a notice indicating\r\nwhere to find the applicable terms.&lt;/p&gt;\r\n&lt;p&gt;Additional terms, permissive or non-permissive, may be stated in the\r\nform of a separately written license, or stated as exceptions;\r\nthe above requirements apply either way.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section8&quot;&gt;&lt;/a&gt;8. Termination.&lt;/h4&gt;\r\n&lt;p&gt;You may not propagate or modify a covered work except as expressly\r\nprovided under this License.  Any attempt otherwise to propagate or\r\nmodify it is void, and will automatically terminate your rights under\r\nthis License (including any patent licenses granted under the third\r\nparagraph of section 11).&lt;/p&gt;\r\n&lt;p&gt;However, if you cease all violation of this License, then your\r\nlicense from a particular copyright holder is reinstated (a)\r\nprovisionally, unless and until the copyright holder explicitly and\r\nfinally terminates your license, and (b) permanently, if the copyright\r\nholder fails to notify you of the violation by some reasonable means\r\nprior to 60 days after the cessation.&lt;/p&gt;\r\n&lt;p&gt;Moreover, your license from a particular copyright holder is\r\nreinstated permanently if the copyright holder notifies you of the\r\nviolation by some reasonable means, this is the first time you have\r\nreceived notice of violation of this License (for any work) from that\r\ncopyright holder, and you cure the violation prior to 30 days after\r\nyour receipt of the notice.&lt;/p&gt;\r\n&lt;p&gt;Termination of your rights under this section does not terminate the\r\nlicenses of parties who have received copies or rights from you under\r\nthis License.  If your rights have been terminated and not permanently\r\nreinstated, you do not qualify to receive new licenses for the same\r\nmaterial under section 10.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section9&quot;&gt;&lt;/a&gt;9. Acceptance Not Required for Having Copies.&lt;/h4&gt;\r\n&lt;p&gt;You are not required to accept this License in order to receive or\r\nrun a copy of the Program.  Ancillary propagation of a covered work\r\noccurring solely as a consequence of using peer-to-peer transmission\r\nto receive a copy likewise does not require acceptance.  However,\r\nnothing other than this License grants you permission to propagate or\r\nmodify any covered work.  These actions infringe copyright if you do\r\nnot accept this License.  Therefore, by modifying or propagating a\r\ncovered work, you indicate your acceptance of this License to do so.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section10&quot;&gt;&lt;/a&gt;10. Automatic Licensing of Downstream Recipients.&lt;/h4&gt;\r\n&lt;p&gt;Each time you convey a covered work, the recipient automatically\r\nreceives a license from the original licensors, to run, modify and\r\npropagate that work, subject to this License.  You are not responsible\r\nfor enforcing compliance by third parties with this License.&lt;/p&gt;\r\n&lt;p&gt;An &amp;ldquo;entity transaction&amp;rdquo; is a transaction transferring control of an\r\norganization, or substantially all assets of one, or subdividing an\r\norganization, or merging organizations.  If propagation of a covered\r\nwork results from an entity transaction, each party to that\r\ntransaction who receives a copy of the work also receives whatever\r\nlicenses to the work the party&#039;s predecessor in interest had or could\r\ngive under the previous paragraph, plus a right to possession of the\r\nCorresponding Source of the work from the predecessor in interest, if\r\nthe predecessor has it or can get it with reasonable efforts.&lt;/p&gt;\r\n&lt;p&gt;You may not impose any further restrictions on the exercise of the\r\nrights granted or affirmed under this License.  For example, you may\r\nnot impose a license fee, royalty, or other charge for exercise of\r\nrights granted under this License, and you may not initiate litigation\r\n(including a cross-claim or counterclaim in a lawsuit) alleging that\r\nany patent claim is infringed by making, using, selling, offering for\r\nsale, or importing the Program or any portion of it.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section11&quot;&gt;&lt;/a&gt;11. Patents.&lt;/h4&gt;\r\n&lt;p&gt;A &amp;ldquo;contributor&amp;rdquo; is a copyright holder who authorizes use under this\r\nLicense of the Program or a work on which the Program is based.  The\r\nwork thus licensed is called the contributor&#039;s &amp;ldquo;contributor version&amp;rdquo;.&lt;/p&gt;\r\n&lt;p&gt;A contributor&#039;s &amp;ldquo;essential patent claims&amp;rdquo; are all patent claims\r\nowned or controlled by the contributor, whether already acquired or\r\nhereafter acquired, that would be infringed by some manner, permitted\r\nby this License, of making, using, or selling its contributor version,\r\nbut do not include claims that would be infringed only as a\r\nconsequence of further modification of the contributor version.  For\r\npurposes of this definition, &amp;ldquo;control&amp;rdquo; includes the right to grant\r\npatent sublicenses in a manner consistent with the requirements of\r\nthis License.&lt;/p&gt;\r\n&lt;p&gt;Each contributor grants you a non-exclusive, worldwide, royalty-free\r\npatent license under the contributor&#039;s essential patent claims, to\r\nmake, use, sell, offer for sale, import and otherwise run, modify and\r\npropagate the contents of its contributor version.&lt;/p&gt;\r\n&lt;p&gt;In the following three paragraphs, a &amp;ldquo;patent license&amp;rdquo; is any express\r\nagreement or commitment, however denominated, not to enforce a patent\r\n(such as an express permission to practice a patent or covenant not to\r\nsue for patent infringement).  To &amp;ldquo;grant&amp;rdquo; such a patent license to a\r\nparty means to make such an agreement or commitment not to enforce a\r\npatent against the party.&lt;/p&gt;\r\n&lt;p&gt;If you convey a covered work, knowingly relying on a patent license,\r\nand the Corresponding Source of the work is not available for anyone\r\nto copy, free of charge and under the terms of this License, through a\r\npublicly available network server or other readily accessible means,\r\nthen you must either (1) cause the Corresponding Source to be so\r\navailable, or (2) arrange to deprive yourself of the benefit of the\r\npatent license for this particular work, or (3) arrange, in a manner\r\nconsistent with the requirements of this License, to extend the patent\r\nlicense to downstream recipients.  &amp;ldquo;Knowingly relying&amp;rdquo; means you have\r\nactual knowledge that, but for the patent license, your conveying the\r\ncovered work in a country, or your recipient&#039;s use of the covered work\r\nin a country, would infringe one or more identifiable patents in that\r\ncountry that you have reason to believe are valid.&lt;/p&gt;\r\n&lt;p&gt;If, pursuant to or in connection with a single transaction or\r\narrangement, you convey, or propagate by procuring conveyance of, a\r\ncovered work, and grant a patent license to some of the parties\r\nreceiving the covered work authorizing them to use, propagate, modify\r\nor convey a specific copy of the covered work, then the patent license\r\nyou grant is automatically extended to all recipients of the covered\r\nwork and works based on it.&lt;/p&gt;\r\n&lt;p&gt;A patent license is &amp;ldquo;discriminatory&amp;rdquo; if it does not include within\r\nthe scope of its coverage, prohibits the exercise of, or is\r\nconditioned on the non-exercise of one or more of the rights that are\r\nspecifically granted under this License.  You may not convey a covered\r\nwork if you are a party to an arrangement with a third party that is\r\nin the business of distributing software, under which you make payment\r\nto the third party based on the extent of your activity of conveying\r\nthe work, and under which the third party grants, to any of the\r\nparties who would receive the covered work from you, a discriminatory\r\npatent license (a) in connection with copies of the covered work\r\nconveyed by you (or copies made from those copies), or (b) primarily\r\nfor and in connection with specific products or compilations that\r\ncontain the covered work, unless you entered into that arrangement,\r\nor that patent license was granted, prior to 28 March 2007.&lt;/p&gt;\r\n&lt;p&gt;Nothing in this License shall be construed as excluding or limiting\r\nany implied license or other defenses to infringement that may\r\notherwise be available to you under applicable patent law.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section12&quot;&gt;&lt;/a&gt;12. No Surrender of Others&#039; Freedom.&lt;/h4&gt;\r\n&lt;p&gt;If conditions are imposed on you (whether by court order, agreement or\r\notherwise) that contradict the conditions of this License, they do not\r\nexcuse you from the conditions of this License.  If you cannot convey a\r\ncovered work so as to satisfy simultaneously your obligations under this\r\nLicense and any other pertinent obligations, then as a consequence you may\r\nnot convey it at all.  For example, if you agree to terms that obligate you\r\nto collect a royalty for further conveying from those to whom you convey\r\nthe Program, the only way you could satisfy both those terms and this\r\nLicense would be to refrain entirely from conveying the Program.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section13&quot;&gt;&lt;/a&gt;13. Use with the GNU Affero General Public License.&lt;/h4&gt;\r\n&lt;p&gt;Notwithstanding any other provision of this License, you have\r\npermission to link or combine any covered work with a work licensed\r\nunder version 3 of the GNU Affero General Public License into a single\r\ncombined work, and to convey the resulting work.  The terms of this\r\nLicense will continue to apply to the part which is the covered work,\r\nbut the special requirements of the GNU Affero General Public License,\r\nsection 13, concerning interaction through a network will apply to the\r\ncombination as such.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section14&quot;&gt;&lt;/a&gt;14. Revised Versions of this License.&lt;/h4&gt;\r\n&lt;p&gt;The Free Software Foundation may publish revised and/or new versions of\r\nthe GNU General Public License from time to time.  Such new versions will\r\nbe similar in spirit to the present version, but may differ in detail to\r\naddress new problems or concerns.&lt;/p&gt;\r\n&lt;p&gt;Each version is given a distinguishing version number.  If the\r\nProgram specifies that a certain numbered version of the GNU General\r\nPublic License &amp;ldquo;or any later version&amp;rdquo; applies to it, you have the\r\noption of following the terms and conditions either of that numbered\r\nversion or of any later version published by the Free Software\r\nFoundation.  If the Program does not specify a version number of the\r\nGNU General Public License, you may choose any version ever published\r\nby the Free Software Foundation.&lt;/p&gt;\r\n&lt;p&gt;If the Program specifies that a proxy can decide which future\r\nversions of the GNU General Public License can be used, that proxy&#039;s\r\npublic statement of acceptance of a version permanently authorizes you\r\nto choose that version for the Program.&lt;/p&gt;\r\n&lt;p&gt;Later license versions may give you additional or different\r\npermissions.  However, no additional obligations are imposed on any\r\nauthor or copyright holder as a result of your choosing to follow a\r\nlater version.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section15&quot;&gt;&lt;/a&gt;15. Disclaimer of Warranty.&lt;/h4&gt;\r\n&lt;p&gt;THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY\r\nAPPLICABLE LAW.  EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT\r\nHOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM &amp;ldquo;AS IS&amp;rdquo; WITHOUT WARRANTY\r\nOF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO,\r\nTHE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR\r\nPURPOSE.  THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM\r\nIS WITH YOU.  SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF\r\nALL NECESSARY SERVICING, REPAIR OR CORRECTION.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section16&quot;&gt;&lt;/a&gt;16. Limitation of Liability.&lt;/h4&gt;\r\n&lt;p&gt;IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING\r\nWILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MODIFIES AND/OR CONVEYS\r\nTHE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY\r\nGENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE\r\nUSE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF\r\nDATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD\r\nPARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS),\r\nEVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF\r\nSUCH DAMAGES.&lt;/p&gt;\r\n&lt;h4&gt;&lt;a name__________&quot;section17&quot;&gt;&lt;/a&gt;17. Interpretation of Sections 15 and 16.&lt;/h4&gt;\r\n&lt;p&gt;If the disclaimer of warranty and limitation of liability provided\r\nabove cannot be given local legal effect according to their terms,\r\nreviewing courts shall apply local law that most closely approximates\r\nan absolute waiver of all civil liability in connection with the\r\nProgram, unless a warranty or assumption of liability accompanies a\r\ncopy of the Program in return for a fee.&lt;/p&gt;\r\n&lt;p&gt;END OF TERMS AND CONDITIONS&lt;/p&gt;\r\n&lt;h3&gt;&lt;a name__________&quot;howto&quot;&gt;&lt;/a&gt;How to Apply These Terms to Your New Programs&lt;/h3&gt;\r\n&lt;p&gt;If you develop a new program, and you want it to be of the greatest\r\npossible use to the public, the best way to achieve this is to make it\r\nfree software which everyone can redistribute and change under these terms.&lt;/p&gt;\r\n&lt;p&gt;To do so, attach the following notices to the program.  It is safest\r\nto attach them to the start of each source file to most effectively\r\nstate the exclusion of warranty; and each file should have at least\r\nthe &amp;ldquo;copyright&amp;rdquo; line and a pointer to where the full notice is found.&lt;/p&gt;\r\n&lt;pre&gt;    toendaCMS - Your ideas ahead!&lt;br /&gt;&lt;br /&gt;Copyright (C) 2003 - 2008  Jonathan Naumann - Toenda Software Development&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;This program is free software: you can redistribute it and/or modify&lt;br /&gt;&lt;br /&gt;it under the terms of the GNU General Public License as published by&lt;br /&gt;&lt;br /&gt;the Free Software Foundation, either version 3 of the License, or&lt;br /&gt;&lt;br /&gt;(at your option) any later version.&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;This program is distributed in the hope that it will be useful,&lt;br /&gt;&lt;br /&gt;but WITHOUT ANY WARRANTY; without even the implied warranty of&lt;br /&gt;&lt;br /&gt;MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the&lt;br /&gt;&lt;br /&gt;GNU General Public License for more details.&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;You should have received a copy of the GNU General Public License&lt;br /&gt;&lt;br /&gt;along with this program.  If not, see .&lt;br /&gt;&lt;br /&gt;&lt;/pre&gt;\r\n&lt;p&gt;Also add information on how to contact you by electronic and paper mail.&lt;/p&gt;\r\n&lt;p&gt;If the program does terminal interaction, make it output a short\r\nnotice like this when it starts in an interactive mode:&lt;/p&gt;\r\n&lt;pre&gt;    toendaCMS - Your ideas ahead! Copyright (C) 2003 - 2008 Jonathan naumann - Toenda Software Development&lt;br /&gt;&lt;br /&gt;This program comes with ABSOLUTELY NO WARRANTY; for details type `show w&#039;.&lt;br /&gt;&lt;br /&gt;This is free software, and you are welcome to redistribute it&lt;br /&gt;&lt;br /&gt;under certain conditions; type `show c&#039; for details.&lt;br /&gt;&lt;br /&gt;&lt;/pre&gt;\r\n&lt;p&gt;The hypothetical commands `show w&#039; and `show c&#039; should show the appropriate\r\nparts of the General Public License.  Of course, your program&#039;s commands\r\nmight be different; for a GUI interface, you would use an &amp;ldquo;about box&amp;rdquo;.&lt;/p&gt;\r\n&lt;p&gt;You should also get your employer (if you work as a programmer) or school,\r\nif any, to sign a &amp;ldquo;copyright disclaimer&amp;rdquo; for the program, if necessary.\r\nFor more information on this, and how to apply and follow the GNU GPL, see\r\n.&lt;/p&gt;\r\n&lt;p&gt;The GNU General Public License does not permit incorporating your program\r\ninto proprietary programs.  If your program is a subroutine library, you\r\nmay consider it more useful to permit linking proprietary applications with\r\nthe library.  If this is what you want to do, use the GNU Lesser General\r\nPublic License instead of this License.  But first, please read\r\n.&lt;/p&gt;', '', '', 'root', 'db_content_default.php', 'Public', 1, 1);

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
) ;

--
-- Daten für Tabelle `#####downloads`
--

INSERT INTO `#####downloads` (`uid`, `name`, `date`, `desc`, `type`, `sort`, `pub`, `access`, `image`, `file`, `cat`, `parent`, `sql_type`, `mirror`) VALUES
('05cb9c17d8', 'dsf', '02.08.2007-19:34', 'sdfsdfdsfdsfdsfdsfdsfdsf', 'zip', 2, 1, 'Public', '_mimetypes_', 'http://static.toenda.com/templates/pushbutton.zip', NULL, NULL, 'f', 1),
('9deda931c7', 'sdfdsf', '29.01.2008-10:22', '', 'png', 3, 1, 'Public', '_mimetypes_', 'regular_expressions_cheat_sheet.png', NULL, NULL, 'f', 0),
('8466591749', 'Base', '04.02.2008-13:46', '', 'folder', 1, 1, 'Public', NULL, NULL, NULL, NULL, 'd', NULL),
('89370422f5', '(PRODUCT) RED Wallpaper', '05.02.2008-14:15', '', 'jpg', 4, 1, 'Public', '_mimetypes_', 'Admired.jpg', NULL, NULL, 'f', 0);

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
) ;

--
-- Daten für Tabelle `#####downloads_config`
--

INSERT INTO `#####downloads_config` (`uid`, `download_id`, `download_title`, `download_stamp`, `download_text`) VALUES
('download', 'download', 'Downloads and Software', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');

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
) ;

--
-- Daten für Tabelle `#####frontpage`
--

INSERT INTO `#####frontpage` (`uid`, `language`, `front_id`, `front_title`, `front_stamp`, `front_text`, `news_title`, `news_cut`, `module_use_0`, `sb_news_title`, `sb_news_amount`, `sb_news_chars`, `sb_news_enabled`, `sb_news_display`) VALUES
('24k58ilp6', 'english_EN', 'frontpage', 'Welcome to the Home of toendaCMS', 'Open Source Content Management Framework', 'Welcome to the Samplesite of the free Open Source Content Management Framework toendaCMS.&lt;br /&gt;\r\nIt is for enterprise purposes and/or private uses on the web. It offers\r\nfull flexibility and extendability while featuring an accomplished set\r\nof ready-made interfaces, function&amp;#39;s and modules.\r\n', 'News', 0, 5, 'Latest News', 5, 100, 0, 3),
('4frtgh587', 'germany_DE', 'frontpage', 'Willkommen auf der Demoseite von toendaCMS', 'Open Source Content Management Framework', 'Willkommen auf der Demoseite des Open-Source Content Management Frameworks toendaCMS.&lt;br /&gt;\r\n It is for enterprise purposes and/or private uses on the web. It offers full flexibility and extendability while featuring an accomplished set of ready-made interfaces, function&#039;&#039;s and modules.', 'Neuigkeiten', 0, 5, 'Die letzten Neuigkeiten', 5, 100, 0, 3);

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
  `color_row_2` varchar(6) default NULL,
  `text` text,
  `language` varchar(25) NOT NULL default 'english_EN'
) ;

--
-- Daten für Tabelle `#####guestbook`
--

INSERT INTO `#####guestbook` (`uid`, `guest_id`, `booktitle`, `bookstamp`, `access`, `enabled`, `clean_link`, `clean_script`, `convert_at`, `show_email`, `name_width`, `text_width`, `color_row_1`, `color_row_2`, `text`, `language`) VALUES
('guestbook', 'guestbook', 'Guestbook', 'Lorem ipsum dolor', 'Public', 1, 1, 1, 1, 1, '140', '360', 'efefef', 'ffffff', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.', 'germany_DE'),
('dd7048ed1', 'guestbook', 'sdasd', 'asdasd', 'Public', 1, 0, 0, 0, 0, '0', '0', '', '', '', 'english_EN');

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
) ;

--
-- Daten für Tabelle `#####guestbook_items`
--

INSERT INTO `#####guestbook_items` (`uid`, `name`, `email`, `text`, `date`, `time`) VALUES
('55cb02d7477921bb0091b9ba7ae91b85', 'vandango', 'vandango@toenda.com', 'Wow, whats a new and cool guestbook.', '20051124', '12:33'),
('bd51471a4ffec17e0b69a1864003b8bb', 'uz', 'zuzu@jhkj.de', 'uhasduhaskd', '20080314', '12:49');

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
) ;

--
-- Daten für Tabelle `#####imagegallery`
--

INSERT INTO `#####imagegallery` (`uid`, `album`, `image`, `text`, `date`) VALUES
('ddb16b6726', '799cd0', 'Sonnenuntergang.jpg', 'Sonnenuntergang.jpg', '20080129135136'),
('3c5fc7f0c0', '799cd0', 'Winter.jpg', 'Winter.jpg', '20080129135140');

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
  `list_option` int(1) NOT NULL default '0',
  `list_option_amount` tinyint(4) NOT NULL default '4'
) ;

--
-- Daten für Tabelle `#####imagegallery_config`
--

INSERT INTO `#####imagegallery_config` (`uid`, `image_id`, `image_title`, `image_stamp`, `image_details`, `use_comments`, `access`, `max_image`, `needle_image`, `show_lastimg_title`, `align_image`, `size_image`, `image_sort`, `list_option`, `list_option_amount`) VALUES
('imagegallery', 'imagegallery', 'Imagegallery', 'Picture i like', 0, 1, 'Public', 5, 'Last uploaded', 1, 'center', 100, 'asc', 1, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####imprint`
--

CREATE TABLE `#####imprint` (
  `uid` varchar(9) NOT NULL default '',
  `language` varchar(25) NOT NULL,
  `imp_id` varchar(9) NOT NULL default '',
  `imp_title` varchar(255) default NULL,
  `imp_stamp` varchar(255) default NULL,
  `imp_contact` varchar(10) NOT NULL default '',
  `taxno` varchar(50) default NULL,
  `ustid` varchar(50) default NULL,
  `legal` text
) ;

--
-- Daten für Tabelle `#####imprint`
--

INSERT INTO `#####imprint` (`uid`, `language`, `imp_id`, `imp_title`, `imp_stamp`, `imp_contact`, `taxno`, `ustid`, `legal`) VALUES
('imprint', 'english_EN', 'imprint', 'Disclaimer', 'Information about this website', '10a1b5f6ab', '123456789', '123123d', 'No portion of this web site may be reproduced without express written consent from its owner.\r\n'),
('hgztkj87r', 'germany_DE', 'imprint', 'Impressum', 'Informationen &amp;#252;ber diese Webseite', '10a1b5f6ab', '123456789', '123123d', '&lt;span class__________&quot;contentmain&quot;&gt;&lt;span class__________&quot;contentmain&quot;&gt;&lt;strong&gt;Haftungsausschluss / Datenschutz&lt;/strong&gt;&lt;br /&gt; &lt;br /&gt; 1. Wichtiger rechtlicher Hinweis und Haftungsausschlu&amp;szlig;:&lt;br /&gt; Das Landgericht Hamburg hat am 12. Mai 1998 im Urteil 312 O 85/98\r\n&quot;Haftung f&amp;uuml;r Links&quot; entschieden, da&amp;szlig; durch die Ver&amp;ouml;ffentlichung eines\r\nLinks auf einer Homepage die Inhalte der gelinkten Seiten mit zu\r\nverantworten sind. Das l&amp;auml;&amp;szlig;t sich nur verhindern, wenn man sich\r\nausdr&amp;uuml;cklich von den Inhalten der gelinkten Seiten distanziert. Wir\r\ndistanzieren uns daher von allen Inhalten, die sich hinter den\r\nangegebenen Links, den dahinter stehenden Servern, weiterf&amp;uuml;hrenden\r\nLinks, G&amp;auml;steb&amp;uuml;chern und s&amp;auml;mtlichen anderen sichtbaren und nicht\r\nsichtbaren Inhalten verbergen. Sollte eine der Seiten auf den\r\nentsprechenden Servern gegen geltendes Recht versto&amp;szlig;en, so ist uns\r\ndieses nicht bekannt. Auf entsprechende Benachrichtigung hin werden wir\r\nselbstverst&amp;auml;ndlich den Link zu dem entsprechenden Server entfernen\r\n(nachzulesen unter www.online-recht.de). Sollte Ihre Homepage, gegen\r\nIhren Wunsch, in unserer Referenzliste verzeichnet sein, dann wenden\r\nSie sich bitte an uns. Wir werden den Link dann umgehend l&amp;ouml;schen.\r\nVielen Dank &lt;br /&gt; 2. Datenschutz:&lt;br /&gt; Es ist Absicht der Firma Toenda Software Development, die Gesetze zum\r\nSchutz der Privatsph&amp;auml;re und die Datenschutzgesetze genauestens\r\neinzuhalten und zu respektieren. Wir m&amp;ouml;chten dazu beitragen, das\r\nInternet zu einer sicheren und verbindlichen Informationsquelle f&amp;uuml;r\r\nunsere Homepage-Besucher zu machen. Wir sch&amp;uuml;tzen die pers&amp;ouml;nlichen\r\nInformationen unserer G&amp;auml;ste gegen m&amp;ouml;glichen Datenmi&amp;szlig;brauch. Wir geben\r\nau&amp;szlig;erdem Zugriff auf eigene pers&amp;ouml;nliche Informationen, so da&amp;szlig;\r\nInformationen, die wir &amp;uuml;ber Sie haben, ge&amp;auml;ndert oder gel&amp;ouml;scht werden\r\nkann. &lt;br /&gt; &lt;br /&gt; 2.1 Pers&amp;ouml;nlich identifizierbare Informationen&lt;br /&gt; Wir sammeln pers&amp;ouml;nlich identifizierbare Informationen nur wenn Sie sich\r\neintragen , um an unseren online- Wettbewerben (Preisausschreiben)\r\nteilzunehmen oder Sie um pers&amp;ouml;nliche &amp;Uuml;bersendung von Informationen\r\nbitten.&lt;br /&gt; Diese Daten werden von der Firma &lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;Toenda Software Development&lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt; genutzt und nicht an Drittfirmen weitergegeben. Wenn Sie unter 18\r\nJahren sind k&amp;ouml;nnen Sie nur an Wettbewerben teilnehmen oder um\r\npers&amp;ouml;nliche Infromations&amp;uuml;bersendung bitten, wenn die Erlaubnis der\r\nEltern vorliegt. &lt;br /&gt; &lt;br /&gt; 2. 2 Nicht pers&amp;ouml;nlich identifizierbare Informationen&lt;br /&gt; Wir bem&amp;uuml;hen uns unser Web-Angebot laufend zu verbessern. Daf&amp;uuml;r ist es\r\nn&amp;uuml;tzlich, zu wissen, welche Informationen am beliebtesten ist. Zu\r\ndiesem Zwecke speichern wir Datum, Uhrzeit, Suchbegriff und die von\r\nIhnen angeforderte Information mit der jeweiligen IP-Adresse.&lt;br /&gt; Eine IP-Adresse ist eine Nummer, die automatisch Ihrem Computer\r\nzugeteilt wird, wann immer Sie im Web surfen. Web-Server, d.h. die\r\nGro&amp;szlig;computer, die die Webseiten &amp;bdquo;bereitstellen&amp;ldquo;, identifizieren Ihren\r\nComputer automatisch anhand seiner IP-Adresse. Die Firma &lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt;Toenda Software Development&lt;/span&gt;&lt;span class__________&quot;contentmain&quot;&gt; sammelt IP-Adressen zus&amp;auml;tzlich f&amp;uuml;r Zwecke der Systemverwaltung, um\r\nBerichte zu erstellen und die Benutzung unserer Websites zu verfolgen.\r\nWenn Sie spezifische Seiten von den Websites der Firma anfordern,\r\nerkennen unsere Server oder Computer die IP-Adressen der G&amp;auml;ste. Wir\r\nverbinden IP-Adressen aber nicht mit pers&amp;ouml;nlich identifizierbaren\r\nInformationen, was bedeutet, da&amp;szlig; der Benutzer f&amp;uuml;r uns anonym bleibt.&lt;/span&gt; &lt;/span&gt;');

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
) ;

--
-- Daten für Tabelle `#####knowledgebase`
--

INSERT INTO `#####knowledgebase` (`uid`, `category`, `parent`, `title`, `subtitle`, `content`, `image`, `type`, `date`, `last_update`, `access`, `autor`, `sort`, `publish_state`) VALUES
('6e6f2483b7', '', '', 'sdfsdf', 'sdfsdf', 'sdfsdf', '', 'a', '02.08.2007-19:33', '04.02.2008-15:12', 'Public', 'ccdc5cfffaf3cd9342e40dd9dcb3a3ff', 2, 2),
('4da17b1b80', '', '', 'asdasd', 'asdasdasdasdas', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', '', 'c', '04.02.2008-15:12', '04.02.2008-15:12', 'Public', 'ccdc5cfffaf3cd9342e40dd9dcb3a3ff', 1, 2);

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
) ;

--
-- Daten für Tabelle `#####knowledgebase_config`
--

INSERT INTO `#####knowledgebase_config` (`uid`, `id`, `title`, `subtitle`, `text`, `enabled`, `autor_enabled`, `access`) VALUES
('knowledgebase', 'knowledgebase', 'FAQs and Articles', 'A small knowledge database', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.', 1, 0, 'Public');

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
) ;

--
-- Daten für Tabelle `#####links`
--

INSERT INTO `#####links` (`uid`, `type`, `category`, `sort`, `name`, `desc`, `link`, `published`, `target`, `rss`, `access`, `module`) VALUES
('34dr567zhtzh876sgh48r68f44h5s8z4', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 0, 'Toenda Software Development', 'Developer of toendaCMS', 'http://www.toenda.com', 1, '_blank', '', 'Public', 3),
('sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 'c', '', 0, 'Toenda', 'Toenda Software Development Links', '', 1, '', '', 'Public', 3),
('dsf78578asdas7das76das7d67as67d6', 'l', 'sdf7sdf768sd7f78sdf6sd76fsdfsd7f', 1, 'toendaCMS Demonstration Site', '', 'http://toendacms.toenda.com', 1, '_blank', '', 'Public', 3),
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
) ;

--
-- Daten für Tabelle `#####links_config`
--

INSERT INTO `#####links_config` (`uid`, `link_use_side_desc`, `link_use_side_title`, `link_side_title`, `link_use_main_desc`, `link_main_title`, `link_main_subtitle`, `link_main_text`, `link_main_access`) VALUES
('links_config_side', 0, 1, 'Blogroll', NULL, NULL, NULL, NULL, NULL),
('links_config_main', NULL, NULL, NULL, 1, 'myLinks', 'A list of all websites i like', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.', 'Public');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####log`
--

CREATE TABLE `#####log` (
  `uid` varchar(32) collate latin1_general_ci NOT NULL,
  `user_uid` varchar(32) collate latin1_general_ci default NULL,
  `stamp` int(11) NOT NULL COMMENT 'UNIX-Timestamp',
  `ip` varchar(40) collate latin1_general_ci default NULL,
  `module` varchar(40) collate latin1_general_ci default NULL,
  `text` text collate latin1_general_ci
)  COLLATE=latin1_general_ci;

--
-- Daten für Tabelle `#####log`
--

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
) ;

--
-- Daten für Tabelle `#####news`
--

INSERT INTO `#####news` (`uid`, `language`, `title`, `autor`, `date`, `time`, `newstext`, `stamp`, `published`, `publish_date`, `comments_enabled`, `image`, `access`, `show_on_frontpage`) VALUES
('c4c846e167', 'english_EN', 'Hello world!', 'Dolly', '29.03.2007', '00:00', 'Hello world. This is Dolly  and you reading my first post. If you want you can delete it, but you can edit it too. Or you write a new one and let this where it is. It''s your choice.&lt;br /&gt;\r\n&lt;br /&gt;\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.&lt;br /&gt;\r\n', 200703290000, 1, '29.03.2007-00:00', 1, '', 'Public', 1),
('90ac2e39eb', 'germany_DE', 'Hallo Welt!', 'Dolly', '30.03.2007', '17:25', 'Hallo Welt. Ich bin Dolly und du liest gerade den ersten Eintrag. Wenn du willst, kannst du mich l&ouml;schen, oder du bearbeitest mich einfach. Order du schreibst einen neuen und l&auml;sst mich hier zur&uuml;ck, ganz wie du willst.&lt;br /&gt;\r\n&lt;br /&gt;\r\n&lt;a href__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/toendaCMS.png&quot; rel__________&quot;lightbox&quot;&gt;&lt;img align__________&quot;left&quot; alt__________&quot;toendaCMS.png&quot; src__________&quot;http://localhost/toendacms_svn/toendacms/data/images/Image/toendaCMS.png&quot; title__________&quot;toendaCMS.png&quot; /&gt;&lt;/a&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integertellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio&lt;br /&gt;\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 200703301725, 1, '30.03.2007-17:25', 1, '', 'Public', 1),
('8337f6d091', 'germany_DE', 'Lorem', 'root', '30.01.2008', '13:26', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.&lt;br /&gt;&lt;br /&gt; Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.', 200801301326, 1, '30.01.2008-13:26', 1, '', 'Public', 1);

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
) ;

--
-- Daten für Tabelle `#####newsletter`
--

INSERT INTO `#####newsletter` (`uid`, `nl_title`, `nl_show_title`, `nl_text`, `nl_link`) VALUES
('newsletter', 'Newsletter', 1, 'You want always know whats up, subscribe now!', 'Submit');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####newsletter_items`
--

CREATE TABLE `#####newsletter_items` (
  `uid` varchar(6) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default ''
) ;

--
-- Daten für Tabelle `#####newsletter_items`
--

INSERT INTO `#####newsletter_items` (`uid`, `user`, `email`) VALUES
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
  `use_rss091_img` tinyint(4) NOT NULL default '1',
  `rss091_text` varchar(255) NOT NULL default '',
  `use_rss10_img` tinyint(4) NOT NULL default '1',
  `rss10_text` varchar(255) NOT NULL default '',
  `use_rss20_img` tinyint(4) NOT NULL default '1',
  `rss20_feed` varchar(255) NOT NULL default '',
  `use_atom03_img` tinyint(4) NOT NULL default '1',
  `atom03_text` varchar(255) NOT NULL default '',
  `use_opml_img` tinyint(4) NOT NULL default '1',
  `opml_text` varchar(255) NOT NULL default '',
  `use_comment_feed` tinyint(4) NOT NULL default '1',
  `comment_feed_text` varchar(255) default '',
  `comment_feed_type` varchar(7) default '',
  `use_comment_feed_img` tinyint(4) NOT NULL default '0',
  `comments_feed_amount` int(11) NOT NULL default '5',
  PRIMARY KEY  (`uid`)
) ;

--
-- Daten für Tabelle `#####newsmanager`
--

INSERT INTO `#####newsmanager` (`uid`, `news_id`, `news_title`, `news_stamp`, `news_text`, `news_image`, `use_comments`, `show_autor`, `show_autor_as_link`, `news_amount`, `access`, `news_cut`, `use_gravatar`, `use_emoticons`, `use_rss091`, `use_rss10`, `use_rss20`, `use_atom03`, `use_opml`, `syn_amount`, `use_syn_title`, `def_feed`, `use_trackback`, `use_timesince`, `readmore_link`, `news_spacing`, `language`, `use_rss091_img`, `rss091_text`, `use_rss10_img`, `rss10_text`, `use_rss20_img`, `rss20_feed`, `use_atom03_img`, `atom03_text`, `use_opml_img`, `opml_text`, `use_comment_feed`, `comment_feed_text`, `comment_feed_type`, `use_comment_feed_img`, `comments_feed_amount`) VALUES
('newsmanager', 'newsmanager', 'News', 'Current', 'My newstext&lt;br /&gt;\r\n', '', 1, 1, 1, 20, 'Public', 0, 0, 1, 1, 1, 1, 1, 1, 5, 0, 'RSS2.0', 0, 2, 0, 0, 'english_EN', 1, '', 1, '', 1, '', 1, '', 1, '', 1, '', '', 0, 5),
('45789hgtzu', 'newsmanager', 'Neuigkeiten', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.', '', 1, 1, 1, 20, 'Public', 0, 1, 1, 0, 0, 1, 0, 0, 5, 0, 'RSS2.0', 0, 2, 0, 20, 'germany_DE', 0, '', 0, '', 0, 'News abonnieren', 0, '', 0, '', 1, 'Kommentare abonnieren', 'RSS2.0', 0, 25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####news_categories`
--

CREATE TABLE `#####news_categories` (
  `uid` varchar(5) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `desc` text
) ;

--
-- Daten für Tabelle `#####news_categories`
--

INSERT INTO `#####news_categories` (`uid`, `name`, `desc`) VALUES
('erdf4', 'Uncategorized', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####news_to_categories`
--

CREATE TABLE `#####news_to_categories` (
  `uid` varchar(32) NOT NULL default '',
  `news_uid` varchar(10) NOT NULL default '',
  `cat_uid` varchar(5) NOT NULL default ''
) ;

--
-- Daten für Tabelle `#####news_to_categories`
--

INSERT INTO `#####news_to_categories` (`uid`, `news_uid`, `cat_uid`) VALUES
('faf794901b615e2c26ef4a78f7219853', '79b944ed5f', 'erdf4'),
('ec42d00d6ed95e280c1ed0086b6bba09', 'c4c846e167', 'erdf4'),
('145a5946991378852797f16685d75fb0', 'a4439ff6b4', 'erdf4'),
('a8cdb72fd378709583e4fe3c94bacaff', '90ac2e39eb', 'erdf4'),
('8495d08bee50689735b8d55c3b2fbd4b', '8337f6d091', 'erdf4');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####notepad`
--

CREATE TABLE `#####notepad` (
  `uid` varchar(32) NOT NULL default '',
  `name` varchar(200) NOT NULL default '',
  `note` text,
  PRIMARY KEY  (`uid`)
) ;

--
-- Daten für Tabelle `#####notepad`
--

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
) ;

--
-- Daten für Tabelle `#####polls`
--

INSERT INTO `#####polls` (`uid`, `title`, `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `question9`, `question10`, `question11`, `question12`) VALUES
('1386d1eb56f76a14a507f64a63617309', 'This toendaCMS installation was ....', 'Absolutely simple', 'Reasonably easy', 'Not straight-forward but I worked it out', 'I had to install extra server stuff', 'I had no idea and got my friend to do it', 'My dog ran away with the README ...', NULL, NULL, NULL, NULL, NULL, NULL);

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
) ;

--
-- Daten für Tabelle `#####poll_config`
--

INSERT INTO `#####poll_config` (`uid`, `poll_title`, `allpoll_title`, `show_poll_title`, `poll_side_width`, `poll_main_width`, `poll_sm_title`, `use_poll_sidemenu`, `poll_sidemenu_id`, `poll_tm_title`, `use_poll_topmenu`, `poll_topmenu_id`) VALUES
('poll', 'Poll', 'All Polls', 1, 110, 500, 'Poll', 0, 2, 'Poll', 0, 4);

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
) ;

--
-- Daten für Tabelle `#####poll_items`
--

INSERT INTO `#####poll_items` (`uid`, `poll_uid`, `ip`, `domain`, `answer`) VALUES
('f2e874a9', '1386d1eb56f76a14a507f64a63617309', '127.0.0.1', 'localhost', 1);

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
) ;

--
-- Daten für Tabelle `#####products`
--

INSERT INTO `#####products` (`uid`, `name`, `product_number`, `factory`, `factory_url`, `desc`, `category`, `image1`, `date`, `price`, `price_tax`, `status`, `quantity`, `weight`, `sort`, `access`, `sql_type`, `image2`, `image3`, `image4`, `show_on_startpage`, `pub`, `parent`, `language`) VALUES
('13482fa849ab1b901ababf3e3fc0bbab', 'JobLight Jobportal Software', '', 'http://www.toenda.com', 'http://www.toenda.com', '', '2f10f7cf479f1c5c227452d45d8ad9d9', '', '15.07.2007-16:42', '-1', '0', 1, -1, '', 2, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('764f068e33673ecda7978c1a63b48294', 'test', NULL, NULL, NULL, '', '', NULL, '11.07.2007-21:49', NULL, NULL, 0, NULL, NULL, 1, 'Public', 'c', NULL, NULL, NULL, 0, 1, NULL, 'germany_DE'),
('32acfdf114279d275709c2e277341b5c', 'toendaCMS', 't-8237-42', 'http://www.toenda.com', 'http://www.toenda.com', 'Open Source Content Management Framework\r\n', '2f10f7cf479f1c5c227452d45d8ad9d9', 'toendaCMS_box_104.jpg', '15.07.2007-16:42', '1199', '19', 1, -1, '', 4, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('d71b909aa7d0f25fdb01a6afe6d5ac23', 'Zappr Photo Management', '', 'http://www.toenda.com', 'http://www.toenda.com', '', '2f10f7cf479f1c5c227452d45d8ad9d9', '', '15.07.2007-16:42', '-1', '0', 1, -1, '', 3, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('9593610a4bd7f9e0fa31753648a9d08b', 'Coca Cola GmbH', '', '', '', 'blubberlutsch', '', '', '18.07.2007-00:28', '-1', '19', 0, -1, '', 2, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('6031401fddf765e03ca0ec6261623cf6', 'Blubberlutsch', '777-123', 'www.hgmc.com', 'www.hgmc.com', '&lt;p&gt;Manu Chao verbrachte seine Kindheit und Jugendzeit in Paris als Sohn des galizischen Journalisten und Musikers &lt;span class__________&quot;new&quot;&gt;Ram&amp;oacute;n Chao&lt;/span&gt;, der von &lt;span class__________&quot;new&quot;&gt;Alessandro Robecchi&lt;/span&gt; als &amp;bdquo;hochgebildeter Intellektueller und feinsinniger Berichterstatter\r\nder lateinamerikanischen Welt&amp;ldquo; bezeichnet wurde, auf. Seine baskische Mutter &lt;span class__________&quot;new&quot;&gt;Felisa Chao&lt;/span&gt; ist im k&amp;uuml;nstlerischen Bereich t&amp;auml;tig. Beide gingen ins Exil nach Paris, um dem faschistischen Regime von General Franco zu entkommen. Sein j&amp;uuml;ngerer Bruder &lt;span class__________&quot;new&quot;&gt;Antoine Chao&lt;/span&gt; gr&amp;uuml;ndete sp&amp;auml;ter mit ihm zusammen die Band Mano Negra.&lt;/p&gt;\r\n&lt;p&gt;In den Banlieues, den Pariser Vororten, spielte sich das Leben des\r\n1961 geborenen Manu Chao zweigleisig ab: Zum einen in der Familie, wo\r\nstets spanisch gesprochen wurde und die regelm&amp;auml;&amp;szlig;ig von lateinamerikanischen\r\nIntellektuellen, Schriftstellern und Musikern besucht wurde. Und zum\r\nanderen auf den Stra&amp;szlig;en, in denen franz&amp;ouml;sisch gesprochen wurde und in denen die Br&amp;uuml;der Chao einige ihrer sp&amp;auml;teren\r\nBandmitglieder kennenlernten. Deren Eltern waren zu gro&amp;szlig;en Teilen\r\nebenfalls vor dem Franco-Regime gefl&amp;uuml;chtet oder aus finanziellen\r\nGr&amp;uuml;nden von Lateinamerika, Afrika oder aus dem arabischsprachigen Raum nach S&amp;egrave;vres immigriert.&lt;/p&gt;', '', '_empty_', '18.07.2007-00:32', '0,39', '19', 1, -1, '330g', 5, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('b0b14e7381294e263b72a0c9d65b9f31', 'Coka Cola Zero', 'c-8521-45', 'www.coke.de', 'www.coke.de', 'Coca-Cola Zero erg&auml;nzt seit Juli 2006 das kalorienreduzierte bzw.\r\nzuckerfreie Produktsortiment von Coca-Cola in Deutschland. Coca-Cola\r\nZero ist ein Erfrischungsgetr&auml;nk, das echten Geschmack ohne Zucker\r\nbietet. Dank besonderer Geschmacks- kombinationen ist der Geschmack von\r\nCoca-Cola Zero sehr nahe an der klassischen Coke. \r\n&lt;br /&gt;\r\n&lt;br /&gt;\r\nCoca-Cola Zero: Echter Geschmack und zero Zucker. \r\n', '9593610a4bd7f9e0fa31753648a9d08b', 'ccz.jpg', '18.07.2007-00:46', '38,50', '19', 1, -1, '330g', 6, 'Public', 'a', 'cczero.jpg', 'mob52_1162570717.jpg', 'img_range_coke.jpg', 1, 1, '', 'germany_DE'),
('9ce205bb06430aa26747544161f08655', 'autos', '', '', '', '', '', '', '21.07.2007-23:47', '-1', '19', 0, -1, '', 7, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('6dc37aed94ab7733c5255686233b0574', 'doors', '', '', '', '', '', '', '21.07.2007-23:48', '-1', '19', 0, -1, '', 8, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('da0cbbdb230f2ed27e8ed92b38e92917', 'zipfelm&uuml;tzen', '', '', '', '', '', '', '21.07.2007-23:49', '-1', '19', 0, -1, '', 9, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE'),
('93dfd10e552c3ed45a2c588e7ad0272e', 'sadasdas', '', '', '', 'sdasd\r\n', 'da0cbbdb230f2ed27e8ed92b38e92917', '', '22.07.2007-00:11', '-1', '19', 0, -1, '', 10, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('45de263d00b4bb677f325848a132a9c2', 'dd', '', '', '', 'asdasdasd\r\n', 'da0cbbdb230f2ed27e8ed92b38e92917', '', '22.07.2007-00:12', '-1', '19', 1, -1, '', 11, 'Public', 'a', '', '', '', 1, 1, '', 'germany_DE'),
('2f10f7cf479f1c5c227452d45d8ad9d9', 'Toenda', '', '', '', 'asdsadsad', '', '', '22.07.2007-15:45', '-1', '19', 0, -1, '', 1, 'Public', 'c', '', '', '', 0, 1, '', 'germany_DE');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####products_config`
--

CREATE TABLE `#####products_config` (
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
) ;

--
-- Daten für Tabelle `#####products_config`
--

INSERT INTO `#####products_config` (`uid`, `language`, `products_id`, `products_title`, `products_stamp`, `products_text`, `category_state`, `category_title`, `use_category_title`, `show_price_only_users`, `startpagetitle`, `use_sidebar_categories`, `max_latest_products`) VALUES
('f225076a', 'english_EN', 'products', 'sdfsdfsdf', 'sdfsdf', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer\r\ntellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam\r\nfeugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio\r\nmauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris\r\ndolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque\r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis\r\negestas.\r\n', '', 'sdfsdf', 1, 0, 'Current offers', 1, 15),
('products', 'germany_DE', 'products', 'Products', 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tellus libero, euismod sed, gravida nec, tincidunt vitae, urna. Nam feugiat nulla ac quam. Nulla tincidunt, nulla quis luctus ornare, odio mauris lobortis velit, ut eleifend ligula risus a purus. Integer mauris dolor, suscipit sit amet, interdum vel, laoreet id, pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.\r\n', '', 'Product Categories', 1, 0, 'Aktuelle Angebot', 1, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `#####session`
--

CREATE TABLE `#####session` (
  `uid` varchar(32) NOT NULL default '',
  `date` varchar(20) NOT NULL default '',
  `user` varchar(255) NOT NULL default '',
  `user_id` varchar(32) NOT NULL default ''
) ;

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
) ;

--
-- Daten für Tabelle `#####sidebar`
--


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
) ;

--
-- Daten für Tabelle `#####sidebar_extensions`
--

INSERT INTO `#####sidebar_extensions` (`uid`, `sidemenu_title`, `sidemenu`, `sidebar_title`, `show_sidebar_title`, `chooser_title`, `show_chooser_title`, `search_title`, `show_search_title`, `search_alignment`, `search_withbr`, `search_withbutton`, `search_word`, `login_title`, `usermenu_title`, `nologin`, `reg_link`, `reg_user`, `reg_pass`, `login_user`, `usermenu`, `show_login_title`, `show_news_cat_amount`, `show_memberlist`, `lang`) VALUES
('sidebar_extensions', 'Sidemenu', 0, 'Sidebar', 0, 'Showcase', 1, 'Search website', 0, 'left', 0, 0, '', 'Login', 'Usermenu', 'No account yet?', 'Create one', 'Username', 'Password', 1, 1, 1, 1, 1, 'de;en;nl;');

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
) ;

--
-- Daten für Tabelle `#####sidemenu`
--

INSERT INTO `#####sidemenu` (`uid`, `language`, `name`, `id`, `subid`, `root`, `parent`, `parent_lvl1`, `parent_lvl2`, `parent_lvl3`, `type`, `link`, `published`, `access`, `target`) VALUES
('r15tg', 'english_EN', 'Home', 1, '-', '-', '-', '-', '-', '-', 'link', 'frontpage', 1, 'Public', ''),
('6738n', 'english_EN', 'Pages', 0, '-', '-', '-', '-', '-', '-', 'title', '-', 0, 'Public', ''),
('51272', 'english_EN', 'Contact Me', 4, '-', '-', '-', '-', '-', '-', 'link', 'contactform', 1, 'Public', ''),
('dc688', 'english_EN', 'License', 2, '-', '-', '-', '-', '-', '-', 'link', '18e2a', 1, 'Public', ''),
('52d28', 'english_EN', 'Guestbook', 3, '-', '-', '-', '-', '-', '-', 'link', 'guestbook', 1, 'Public', ''),
('11d22', 'english_EN', 'sub1', 2, '0', '-', '2', '-', '-', '-', 'link', 'polls', 1, 'Public', ''),
('dfsd7', 'english_EN', 'subsub1', 2, '0', '-', '-', '-', '11d22', '-', 'link', 'search', 0, 'Public', NULL),
('c39d0', 'germany_DE', 'Navigation', 10, '-', '-', '-', '-', '-', '-', 'title', '0', 1, 'Public', ''),
('e19ce', 'germany_DE', 'Lizenz', 12, '-', '-', '-', '-', '-', '-', 'link', '18e2a', 0, 'Public', ''),
('50981', 'germany_DE', 'Neuigkeiten', 11, '-', '-', '-', '-', '-', '-', 'link', 'newsmanager', 0, 'Public', ''),
('4836d', 'germany_DE', 'Seite 1', 11, '1', '-', '11', '50981', '-', '-', 'link', 'bcdea', 1, 'Public', ''),
('0fcb8', 'germany_DE', 'Seite 2', 11, '2', '-', '11', '50981', '-', '-', 'link', '7ea00', 1, 'Public', '');

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
) ;

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
) ;

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
) ;

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
) ;

--
-- Daten für Tabelle `#####topmenu`
--

INSERT INTO `#####topmenu` (`uid`, `language`, `name`, `id`, `type`, `link`, `published`, `access`, `target`) VALUES
('1fbae', 'english_EN', 'Home', 0, 'link', 'frontpage', 1, 'Public', ''),
('3c6d9', 'english_EN', 'News', 1, 'link', 'newsmanager', 1, 'Public', ''),
('d2112', 'english_EN', 'Downloads', 2, 'link', 'download', 1, 'Public', ''),
('706b2', 'english_EN', 'Gallery', 3, 'link', 'imagegallery', 1, 'Public', ''),
('7e31e', 'germany_DE', 'Startseite', 7, 'link', 'frontpage', 1, 'Public', ''),
('61c34', 'germany_DE', 'Neuigkeiten', 8, 'link', 'newsmanager', 1, 'Public', ''),
('f39c7', 'germany_DE', 'Downloads', 9, 'link', 'download', 1, 'Public', ''),
('ac64b', 'germany_DE', 'Gallery', 10, 'link', 'imagegallery', 1, 'Public', ''),
('87f51', 'germany_DE', 'Produkte', 11, 'link', 'products', 1, 'Public', ''),
('fb2ee', 'germany_DE', 'Links', 12, 'link', 'links', 1, 'Public', ''),
('0f239', 'germany_DE', 'Suche', 17, 'link', 'search', 1, 'Public', '');

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
) ;

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
) ;

--
-- Daten für Tabelle `#####usergroup`
--

INSERT INTO `#####usergroup` (`uid`, `name`, `right`) VALUES
('418aed8f001f0b88e36bc68013000794', 'Editor', 3),
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
) ;

--
-- Daten für Tabelle `#####userpage`
--

INSERT INTO `#####userpage` (`uid`, `text_width`, `input_width`, `news_publish`, `image_publish`, `album_publish`, `cat_publish`, `pic_publish`) VALUES
('userpage', '150', '150', 1, 1, 1, 1, '1');
