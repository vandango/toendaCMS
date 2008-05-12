
// directory of where all the images are
var cmThemeOfficeBase = '../images/';

// the follow block allows user to re-define theme base directory
// before it is loaded.
try
{
	if (myThemeOfficeBase)
	{
		cmThemeOfficeBase = myThemeOfficeBase;
	}
}
catch (e)
{
}

var cmThemeOffice = 
{
  	mainFolderLeft: '&nbsp;',
	mainFolderRight: '&nbsp;',
	mainItemLeft: '&nbsp;',
	mainItemRight: '&nbsp;',
	folderLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif" />',
	folderRight: '<img alt="" src="' + cmThemeOfficeBase + 'arrow.gif" />',
	itemLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif" />',
	itemRight: '<img alt="" src="' + cmThemeOfficeBase + 'blank.gif" />',
	mainSpacing: 0,
	subSpacing: 0,
	delay: 300
};

// for horizontal menu split
var cmThemeOfficeHSplit = [_cmNoClick, '<td class="ThemeOfficeMenuItemLeft"></td><td colspan="2"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainHSplit = [_cmNoClick, '<td class="ThemeOfficeMainItemLeft"></td><td colspan="2"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainVSplit = [_cmNoClick, '|'];
