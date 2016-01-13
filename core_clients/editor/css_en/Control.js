/*
***********************************************************************
			Web CSS Editor Version JS-1.1
			
												Author: Hsun-Cheng Hu
												Mail: huchengtw@gmail.com
			
	Web CSS Editor is written by JScript with DHTML. The layout is similar
to FrontPage's CSS Editor. Web CSS Editor Version JS-1.1 only supports 
common CSS, such as: font, border, background, position, etc. 

	Web CSS Editor Version JS-1.1 supports CSS generation and CSS Parsing now.
Note: Web CSS Editor Version JS-1.1 will view all of length unit as "px". This
version doesn't have the ability to distinguish CSS Length Unit.
	 

License:
	Web CSS Editor Version JS-1.1 is free, but users are asked for putting 
the Author Name (Hsun-Cheng Hu) and the Source Web site in the software which 
contains Web CSS Editor Version JS-1.1.

***********************************************************************
*/
var mUnderLine=0;
var mSmallCaps=1;
var mLineThrough=2;
var mUpperCase=3;
var mOverLine=4;
var mCapitalize=5;
var mBlink=6;
var mHidden=7;
var mNone=8;
var mNoColor=9;

var stlNone=0;
var stlLeft=1;
var stlRight=2;

var posNone=0;
var posAbsolute=1;
var posRelative=2;

var tfFont=0;
var tfSpan=1;

var tbBorder=0;
var tbBackground=1;

var tlIcon=0;
var tlCommon=1;
var tlNumeric=2;

var bInitialize=false;

function onClick(iType)
{
	switch(iType)
	{
		case mUnderLine:
			PreviewBox.style.textDecorationUnderline=event.srcElement.checked;
			break;
			
		case mSmallCaps:
			if(event.srcElement.checked)
				PreviewBox.style.fontVariant="small-caps";
			else
				PreviewBox.style.fontVariant="";
			break;		
			
		case mLineThrough:
			PreviewBox.style.textDecorationLineThrough=event.srcElement.checked;
			break;		
			
		case mUpperCase:
			if(event.srcElement.checked)
			{
				PreviewBox.style.textTransform="uppercase";
				tt_capitalize.checked=false;
			}
			else
				PreviewBox.style.textTransform="";
			break;
					
		case mOverLine:
			PreviewBox.style.textDecorationOverline=event.srcElement.checked;
			break;
					
		case mCapitalize:
			if(event.srcElement.checked)
			{
				PreviewBox.style.textTransform="capitalize";
				tt_uppercase.checked=false;
			}
			else
				PreviewBox.style.textTransform="";
			break;
						
		case mBlink:
			PreviewBox.style.textDecorationBlink=event.srcElement.checked;
			break;
			
		case mHidden:
			if(event.srcElement.checked)
				PreviewBox.style.visibility="hidden";
			else
				PreviewBox.style.visibility="";
			break;
			
		case mNone:
			if(event.srcElement.checked)
			{	
				td_Under.checked=false;
				td_LineThrough.checked=false;
				td_Over.checked=false;
				td_Blink.checked=false;
			}
			PreviewBox.style.textDecorationNone=event.srcElement.checked;		
			break;
			
		case mNoColor:
			color.value="";
			color.style.backgroundColor="";
			PreviewBox.style.color=""		
			break;	
	}
	
}

function TabChange(iType)
{
	FontTabFont.className="tabNonSelected";
	FontTabSpan.className="tabNonSelected";

	if(iType==tfFont)
		FontTabFont.className="tabSelected";	
	else
		FontTabSpan.className="tabSelected";
	
	if(FontTabFont.className=="tabNonSelected")
	{
		FontTable.style.display="none";
		FontSpan.style.display="inline";
	}
	else
	{
		FontTable.style.display="inline";
		FontSpan.style.display="none";		
	}
}
function ApplySpanPoint()
{
	PreviewBox.style.letterSpacing="";
	if(SpanPoint.value && SpanPoint.value!="" && SpanSize.value!="Normal")
	{
		if(SpanSize.value=="Loose")
			PreviewBox.style.letterSpacing=SpanPoint.value+"pt"
		else
			PreviewBox.style.letterSpacing="-"+SpanPoint.value+"pt"		
	}
}

function alterSpanPoint(change)
{
	var iPoint=parseInt(SpanPoint.value);	
	if(isNaN(iPoint))
	{
		SpanPoint.value=0;	
	}
	else
	{
		if(iPoint > 0 && change < 0)
		{
			SpanPoint.value=iPoint+change;		
		}
		if(change > 0)
		{
			SpanPoint.value=iPoint+change;		
		}		
	}
	ApplySpanPoint();
}

function ItemChange()
{
	FontItem.className="tabNonSelected";
	ParaItem.className="tabNonSelected";
	BorderItem.className="tabNonSelected";
	ListItem.className="tabNonSelected";
	PositionItem.className="tabNonSelected";		
	FontTab.style.display="none";
	ParaTab.style.display="none";
	BorderTab.style.display="none";
	PositionTab.style.display="none";
	ListTab.style.display="none";
	var oObj=event.srcElement;
	oObj.className="tabSelected";
	if(oObj.id=="FontItem")
	{
		FontTab.style.display="inline";
	}
	if(oObj.id=="ParaItem")
	{
		ParaTab.style.display="inline";
	}
	if(oObj.id=="BorderItem")
	{
		BorderTab.style.display="inline";
	}
	
	if(oObj.id=="ListItem")
	{
		ListTab.style.display="inline";
	}	
	
	if(oObj.id=="PositionItem")
	{
		PositionTab.style.display="inline";
	}
	
}

function ApplyLeftIdent()
{
	ParaPreviewBox.style.marginLeft="";
	if(LeftIdent.value)
	{
			ParaPreviewBox.style.marginLeft=LeftIdent.value;		
	}
}

function alterLeftIdent(change)
{
	var iPoint=parseInt(LeftIdent.value);	
	if(isNaN(iPoint))
	{
		LeftIdent.value=0;	
	}
	else
	{
		LeftIdent.value=iPoint+change;
	}
	
	ApplyLeftIdent();
}
function ApplyRightIdent()
{
	ParaPreviewBox.style.marginRight="";
	if(RightIdent.value)
	{
			ParaPreviewBox.style.marginRight=RightIdent.value;		
	}
}

function alterRightIdent(change)
{
	var iPoint=parseInt(RightIdent.value);	
	if(isNaN(iPoint))
	{
		RightIdent.value=0;	
	}
	else
	{
		RightIdent.value=iPoint+change;
	}
	ApplyRightIdent();
}
function ApplyFirstLineIdent()
{
	ParaPreviewBox.style.marginRight="";
	if(FirstLineIdent.value)
	{
			ParaPreviewBox.style.textIndent=FirstLineIdent.value + "px";
	}
}

function alterFirstLineIdent(change)
{
	var iPoint=parseInt(FirstLineIdent.value);	
	if(isNaN(iPoint))
	{
		FirstLineIdent.value=0;	
	}
	else
	{
		FirstLineIdent.value=iPoint+change;
	}
	ApplyFirstLineIdent();
}

function ApplyBeforeSpan()
{
	ParaPreviewBox.style.marginTop="";
	if(BeforeSpan.value)
	{
			ParaPreviewBox.style.marginTop=BeforeSpan.value;		
	}
}

function alterBeforeSpan(change)
{
	var iPoint=parseInt(BeforeSpan.value);	
	if(isNaN(iPoint))
	{
		BeforeSpan.value=0;	
	}
	else
	{
		BeforeSpan.value=iPoint+change;
	}
	ApplyBeforeSpan();
}

function ApplyAfterSpan()
{
	ParaPreviewBox.style.marginBottom="";
	if(AfterSpan.value)
	{
			ParaPreviewBox.style.marginBottom=AfterSpan.value;		
	}
}

function alterAfterSpan(change)
{
	var iPoint=parseInt(AfterSpan.value);	
	if(isNaN(iPoint))
	{
		AfterSpan.value=0;	
	}
	else
	{
		AfterSpan.value=iPoint+change;
	}
	ApplyAfterSpan();
}

function ApplyWordSpace()
{
	ParaPreviewBox.style.wordSpacing="";
	if(WordSpace.value)
	{
			ParaPreviewBox.style.wordSpacing=WordSpace.value;		
	}
}

function alterWordSpace(change)
{
	var iPoint=parseInt(WordSpace.value);	
	if(isNaN(iPoint))
	{
		WordSpace.value=0;	
	}
	else
	{
		WordSpace.value=iPoint+change;
	}
	ApplyWordSpace();
}

function ApplyPositionLeft()
{
	PositionPreviewBox.style.left="";
	if(PositionLeft.value)
	{
			PositionPreviewBox.style.left=PositionLeft.value;		
	}
}

function alterPositionLeft(change)
{
	
	var iPoint=parseInt(PositionLeft.value);	
	if(isNaN(iPoint))
	{
		PositionLeft.value=0;	
	}
	else
	{
		PositionLeft.value=iPoint+change;
	}
	ApplyPositionLeft();
}

function ApplyPositionHeight()
{
	PositionPreviewBox.style.height="";
	if(PositionHeight.value)
	{
			PositionPreviewBox.style.height=PositionHeight.value;		
	}
}

function alterPositionHeight(change)
{
	var iPoint=parseInt(PositionHeight.value);	
	if(isNaN(iPoint))
	{
		PositionHeight.value=0;	
	}
	else
	{
		if(iPoint > 0 && change < 0)
		{
			PositionHeight.value=iPoint+change;		
		}
		if(change > 0)
		{
			PositionHeight.value=iPoint+change;		
		}		
	}
	ApplyPositionHeight();
}

function ApplyPositionTop()
{
	PositionPreviewBox.style.top="";
	if(PositionTop.value)
	{
			PositionPreviewBox.style.top=PositionTop.value;		
	}
}

function alterPositionTop(change)
{

	var iPoint=parseInt(PositionTop.value);	
	if(isNaN(iPoint))
	{
		PositionTop.value=0;	
	}
	else
	{
		PositionTop.value=iPoint+change;
	}
	ApplyPositionTop();
}

function ApplyPositionWidth()
{
	PositionPreviewBox.style.width="";

	if(PositionWidth.value)
	{
			PositionPreviewBox.style.width=PositionWidth.value;		
	}
}

function alterPositionWidth(change)
{
	var iPoint=parseInt(PositionWidth.value);	
	if(isNaN(iPoint))
	{
		PositionWidth.value=0;	
	}
	else
	{
		if(iPoint > 0 && change < 0)
		{
			PositionWidth.value=iPoint+change;		
		}
		if(change > 0)
		{
			PositionWidth.value=iPoint+change;		
		}
	}
	ApplyPositionWidth();
}

function ApplyLayerSequence()
{
	PositionPreviewBox.style.zIndex="";
	if(LayerSequence.value)
	{
			PositionPreviewBox.style.zIndex=LayerSequence.value;
			PositionPreviewBox.style.position="absolute";		
	}
}

function alterLayerSequence(change)
{
	var iPoint=parseInt(LayerSequence.value);	
	if(isNaN(iPoint))
	{
		LayerSequence.value=0;	
	}
	else
	{
		LayerSequence.value=iPoint+change;
	}
	ApplyLayerSequence();
}

function EnableUpDownControl(bEnable, sControlName)
{
	if(bEnable)
	{
		eval(sControlName+".disabled=false");
		eval(sControlName+"Up.disabled=false");
		eval(sControlName+"Down.disabled=false");		
	}
	else
	{
		eval(sControlName+".disabled=true");
		eval(sControlName+"Up.disabled=true");
		eval(sControlName+"Down.disabled=true");	
	}
}

function StyleChange(iType)
{
	StyleNone.className="NonRedBorder";
	StyleLeft.className="NonRedBorder";
	StyleRight.className="NonRedBorder";
	if(event.srcElement.id=="StyleNone")	
	{
		StyleNone.className="RedBorder";
		PositionPreviewBox.style.styleFloat="";
	}
	if(event.srcElement.id=="StyleLeft")	
	{
		StyleLeft.className="RedBorder";
		PositionPreviewBox.style.styleFloat="left";
	}
	if(event.srcElement.id=="StyleRight")	
	{
		StyleRight.className="RedBorder";
		PositionPreviewBox.style.styleFloat="right";
	}		
}

function PositionChange(iType)
{
	PositionNone.className="NonRedBorder";
	PositionAbsolute.className="NonRedBorder";
	PositionRelative.className="NonRedBorder";
	if(event.srcElement.id=="PositionNone")	
	{
		PositionNone.className="RedBorder";	
	}
	if(event.srcElement.id=="PositionAbsolute")	
	{
		PositionAbsolute.className="RedBorder";			
	}
	if(event.srcElement.id=="PositionRelative")	
	{
		PositionRelative.className="RedBorder";	
	}
	ChangePositionAndSizeStatus();
}

function ChangePositionAndSizeStatus()
{
	if(PositionRelative.className=="RedBorder")
	{
		
		PositionPreviewBox.style.position="relative";
		PositionPreviewBox.style.left=PositionLeft.value;
		PositionPreviewBox.style.top=PositionTop.value;				
		PositionPreviewBox.style.zIndex=LayerSequence.value;		
		EnableUpDownControl(true, "PositionLeft");
		EnableUpDownControl(true, "PositionTop");
		EnableUpDownControl(true, "LayerSequence");	
	}
	if(PositionAbsolute.className=="RedBorder")
	{
		
		PositionPreviewBox.style.position="absolute";
		PositionPreviewBox.style.left=PositionLeft.value;
		PositionPreviewBox.style.top=PositionTop.value;		
		PositionPreviewBox.style.zIndex=LayerSequence.value;		
		EnableUpDownControl(true, "PositionLeft");
		EnableUpDownControl(true, "PositionTop");
		EnableUpDownControl(true, "LayerSequence");	
	}
	if(PositionNone.className=="RedBorder")
	{
		
		PositionPreviewBox.style.position="";
		PositionPreviewBox.style.left="";
		PositionPreviewBox.style.top="";		
		PositionPreviewBox.style.zIndex="";				
		EnableUpDownControl(false, "PositionLeft");
		EnableUpDownControl(false, "PositionTop");
		EnableUpDownControl(false, "LayerSequence");	
	}
	
}

function BorderSettingChange()
{
	BorderDefault.className="NonRedBorder";
	BorderSquare.className="NonRedBorder";
	BorderUserDefined.className="NonRedBorder";
	if(event.srcElement.id=="BorderDefault")
	{
		BorderDefault.className="RedBorder";
		DrawBorderDefault();
	}
	if(event.srcElement.id=="BorderSquare")
	{
		BorderSquare.className="RedBorder";
		DrawBorderSquare();
	}
	if(event.srcElement.id=="BorderUserDefined")
	{
		BorderUserDefined.className="RedBorder";
		DrawBorderUserDefined();
	}		
}

function DrawBorderUserDefined()
{
	EnableUpDownControl(true, "PendingTop");
	EnableUpDownControl(true, "PendingBottom");
	EnableUpDownControl(true, "PendingLeft");
	EnableUpDownControl(true, "PendingRight");
}

//take all borders off
function DrawBorderDefault()
{
	BorderStyle.options.item(0).selected=true;
	BorderSize.value="";
	
	PendingTop.value="";
	PendingBottom.value="";
	PendingLeft.value="";
	PendingRight.value="";
	ApplyBorderPending();

	EnablePaddingControl(false);			
	
	BorderUp.checked=false;
	DeApplyBorder("Top");
	BorderDown.checked=false;
	DeApplyBorder("Bottom");	
	BorderLeft.checked=false;
	DeApplyBorder("Left");	
	BorderRight.checked=false;
	DeApplyBorder("Right");
	

}

function DeApplyBorder(sType)
{
	eval("BorderPreviewBox.style.border"+sType+"=\"\"");
}

function DrawBorderSquare()
{
	BorderStyle.options.item(0).selected=true;
	BorderSize.value=1;
	PendingTop.value=1;
	PendingBottom.value=1;
	PendingLeft.value=4;
	PendingRight.value=4;
	ApplyBorderPending();
	
	EnablePaddingControl(true);
	
	BorderUp.checked=true;
	ApplyBorder("Top");
	BorderDown.checked=true;
	ApplyBorder("Bottom");	
	BorderLeft.checked=true;
	ApplyBorder("Left");	
	BorderRight.checked=true;
	ApplyBorder("Right");	
}
function ApplyBorder(sType)
{
	eval("BorderPreviewBox.style.border"+sType+"=\""+BorderSize.value+" " + BorderStyle.value + " " +BorderColor.value+"\"");
}

function alterBorderSize(change)
{
	var iPoint=parseInt(BorderSize.value);	
	if(isNaN(iPoint))
	{
		BorderSize.value=0;	
	}
	else
	{
		if(iPoint > 0 && change < 0)
		{
			BorderSize.value=iPoint+change;		
		}
		if(change > 0)
		{
			BorderSize.value=iPoint+change;		
		}
	}
	ApplyBorderSize();
}

function ApplyBorderSize()
{
	if(BorderSquare.className=="RedBorder")
	{
		ApplyBorder("Top");
		ApplyBorder("Bottom");
		ApplyBorder("Left");
		ApplyBorder("Right");	
	}
}

function BorderColorChange()
{
	if(BorderSquare.className=="RedBorder")
	{
		ApplyBorder("Top");
		ApplyBorder("Bottom");
		ApplyBorder("Left");
		ApplyBorder("Right");	
	}
}


function BorderStyleChange()
{
	if(BorderSquare.className=="RedBorder")
	{
		ApplyBorder("Top");
		ApplyBorder("Bottom");
		ApplyBorder("Left");
		ApplyBorder("Right");	
	}
}

function alterPendingTop(change)
{
	var iPoint=parseInt(PendingTop.value);	
	if(isNaN(iPoint))
	{
		PendingTop.value=0;	
	}
	else
	{
		PendingTop.value=iPoint+change;
	}
	ApplyBorderPending();
}

function alterPendingBottom(change)
{
	var iPoint=parseInt(PendingBottom.value);	
	if(isNaN(iPoint))
	{
		PendingBottom.value=0;	
	}
	else
	{
		PendingBottom.value=iPoint+change;
	}
	ApplyBorderPending();
}

function alterPendingLeft(change)
{
	var iPoint=parseInt(PendingLeft.value);	
	if(isNaN(iPoint))
	{
		PendingLeft.value=0;	
	}
	else
	{
		PendingLeft.value=iPoint+change;
	}
	ApplyBorderPending();
}

function alterPendingRight(change)
{
	var iPoint=parseInt(PendingRight.value);	
	if(isNaN(iPoint))
	{
		PendingRight.value=0;	
	}
	else
	{
		PendingRight.value=iPoint+change;
	}
	ApplyBorderPending();
}

function ApplyBorderPending()
{
	if(PendingTop.value)
		BorderPreviewBox.style.paddingTop=PendingTop.value;
	else
		BorderPreviewBox.style.paddingTop="";
	if(PendingBottom.value)
		BorderPreviewBox.style.paddingBottom=PendingBottom.value;
	else
		BorderPreviewBox.style.paddingBottom="";
		
	if(PendingLeft.value)
		BorderPreviewBox.style.paddingLeft=PendingLeft.value;				
	else
		BorderPreviewBox.style.paddingLeft="";
		
	if(PendingRight.value)
		BorderPreviewBox.style.paddingRight=PendingRight.value;
	else
		BorderPreviewBox.style.paddingRight="";
		
}

function EnablePaddingControl(bResult)
{
	EnableUpDownControl(bResult, "PendingTop");
	EnableUpDownControl(bResult, "PendingBottom");
	EnableUpDownControl(bResult, "PendingLeft");
	EnableUpDownControl(bResult, "PendingRight");
}

function BorderSideChange()
{
	BorderDefault.className="NonRedBorder";
	BorderSquare.className="NonRedBorder";
	BorderUserDefined.className="RedBorder"
	EnablePaddingControl(true);
	if(!BorderSize.value || BorderSize.value=="")
		BorderSize.value=1;
	if(event.srcElement.id=="BorderUp")
	{
		if(BorderUp.checked)
		{
			ApplyBorder("Top");
			
		}
		else
		{
			DeApplyBorder("Top");
		}
	}
	if(event.srcElement.id=="BorderDown")
	{
		if(BorderDown.checked)
		{
			ApplyBorder("Bottom");
						
		}
		else
		{
			DeApplyBorder("Bottom");
		}	
	}
	if(event.srcElement.id=="BorderLeft")
	{
		if(BorderLeft.checked)
		{
			ApplyBorder("Left");
						
		}
		else
		{
			DeApplyBorder("Left");
		}	
	}
	if(event.srcElement.id=="BorderRight")
	{
		if(BorderRight.checked)
		{
			ApplyBorder("Right");			
		}
		else
		{
			DeApplyBorder("Right");
		}	
	}			
		
}

function BorderTabChange(iType)
{
	TabBorderTab.className="tabNonSelected";
	TabBackgroundTab.className="tabNonSelected";
	if(iType==tbBorder)
		TabBorderTab.className="tabSelected";	
	else
		TabBackgroundTab.className="tabSelected";	
	
	if(TabBorderTab.className=="tabNonSelected")
	{
		BorderTable.style.display="none";
		BackgroundTable.style.display="inline";
	}
	else
	{
		BorderTable.style.display="inline";
		BackgroundTable.style.display="none";		
	}
}

function ListTabChange(iType)
{
	TabIconTab.className="tabNonSelected";
	TabCommonTab.className="tabNonSelected";
	TabNumericTab.className="tabNonSelected";
	IconItemTable.style.display="none";
	CommonItemTable.style.display="none";	
	NumericItemTable.style.display="none";		
	if(iType==tlIcon)
	{
		IconItemTable.style.display="inline";		
		TabIconTab.className="tabSelected";	
	}
	
	if(iType==tlCommon)
	{
		CommonItemTable.style.display="inline";	
		TabCommonTab.className="tabSelected";	
	}
		
	if(iType==tlNumeric)
	{
		NumericItemTable.style.display="inline";	
		TabNumericTab.className="tabSelected";	
	}
}

function BackgroundImageChange()
{
	if(BackgroundImage.value && BackgroundImage.value!="")	
	{
		BackgroundPositionY.disabled=false;
		BackgroundRepeat.disabled=false;
		BackgroundPositionX.disabled=false;
		BackgroundAttachment.disabled=false;
		BackgroundPreviewBox.style.backgroundImage="url("+BackgroundImage.value+")";
		ApplyBackgroundImageProperty();						
	}
	else
	{
		BackgroundPositionY.disabled=true;
		BackgroundRepeat.disabled=true;
		BackgroundPositionX.disabled=true;
		BackgroundAttachment.disabled=true;
		BackgroundPreviewBox.style.backgroundImage="";
		ClearBackgroundImageProperty();			
	}
}

function ClearBackgroundImageProperty()
{
	BackgroundPreviewBox.style.backgroundRepeat="";
	BackgroundPreviewBox.style.backgroundPositionX="";
	BackgroundPreviewBox.style.backgroundPositionY="";
	BackgroundPreviewBox.style.backgroundAttachment="";
}

function ApplyBackgroundImageProperty()
{
	BackgroundPreviewBox.style.backgroundRepeat=BackgroundRepeat.value;
	BackgroundPreviewBox.style.backgroundPositionX=BackgroundPositionX.value;
	BackgroundPreviewBox.style.backgroundPositionY=BackgroundPositionY.value;
	BackgroundPreviewBox.style.backgroundAttachment=BackgroundAttachment.value;			
}

function ListSettingChange()
{
	CommonNone.className="NonRedBorder";
	CommonDisc.className="NonRedBorder";
	CommonCircle.className="NonRedBorder"
	CommonSquare.className="NonRedBorder";
	
	NumericNone.className="NonRedBorder";
	NumericDecimal.className="NonRedBorder"
	NumericLowerAlpha.className="NonRedBorder";
	NumericLowerRoman.className="NonRedBorder";
	NumericUpperAlpha.className="NonRedBorder"
	NumericUpperRoman.className="NonRedBorder"
	ListItemPreviewBox.style.listStyleType="";
	ListItemPreviewBox.style.listStyleImage="";
	
	if(event.srcElement.id=="ListStyleImage")
	{
		ListItemPreviewBox.style.listStyleImage="url("+ListStyleImage.value+")";
	}
	else
	{
		ListStyleImage.value="";
	}	
	if(event.srcElement.id=="CommonNone")
	{
		CommonNone.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="none";
	}
	if(event.srcElement.id=="CommonDisc")
	{
		CommonDisc.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="disc";		
	}
	if(event.srcElement.id=="CommonCircle")
	{
		CommonCircle.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="circle";		
	}
	if(event.srcElement.id=="CommonSquare")
	{
		CommonSquare.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="square";		
	}
	if(event.srcElement.id=="NumericNone")
	{
		NumericNone.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="none";		
	}
	if(event.srcElement.id=="NumericDecimal")
	{
		NumericDecimal.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="decimal";		
	}
	if(event.srcElement.id=="NumericLowerAlpha")
	{
		NumericLowerAlpha.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="lower-alpha";		
	}
	if(event.srcElement.id=="NumericLowerRoman")
	{
		NumericLowerRoman.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="lower-roman";		
	}
	
	if(event.srcElement.id=="NumericUpperAlpha")
	{
		NumericUpperAlpha.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="upper-alpha";		
	}
	if(event.srcElement.id=="NumericUpperRoman")
	{
		NumericUpperRoman.className="RedBorder";
		ListItemPreviewBox.style.listStyleType="upper-roman";		
	}		
}

function ListStylePositionChange()
{
	if(ListStylePosition.checked)
	{
		ListItemPreviewBox.style.listStylePosition="outside";
	}
	else
	{
		ListItemPreviewBox.style.listStylePosition="inside";
	}
}

function RenderCSS()
{
	if(BackgroundPreviewBox.style.color && BackgroundPreviewBox.style.color!="" )
	{
		PreviewBox.style.color="";
	}
	var TotalCSSStr=""; 
	if(PreviewBox.style.cssText && PreviewBox.style.cssText!="")
		TotalCSSStr+=PreviewBox.style.cssText+";\r\n";
		
	if(ParaPreviewBox.style.cssText && ParaPreviewBox.style.cssText!="")		
		TotalCSSStr+=ParaPreviewBox.style.cssText+";\r\n";
		
	if(BorderPreviewBox.style.cssText && BorderPreviewBox.style.cssText!="")
		TotalCSSStr+=BorderPreviewBox.style.cssText+";\r\n";
		
	if(BackgroundPreviewBox.style.cssText && BackgroundPreviewBox.style.cssText!="")
		TotalCSSStr+=BackgroundPreviewBox.style.cssText+";\r\n";
	
	if(ListItemPreviewBox.style.cssText && ListItemPreviewBox.style.cssText!="")	
		TotalCSSStr+=ListItemPreviewBox.style.cssText+";\r\n";
					
	if(PositionPreviewBox.style.cssText && PositionPreviewBox.style.cssText!="")
		TotalCSSStr+=PositionPreviewBox.style.cssText+";\r\n";
	
	
	window.returnValue=TotalCSSStr;
	window.close();			
}

function ParseCSS(sCSS)
{
	if(!sCSS||sCSS==""||sCSS==null)
		return;
	ParseCSSContainer.style.cssText=sCSS;
	LoadFontCSSFromContainer(ParseCSSContainer);
	LoadParagraphCSSFromContainer(ParseCSSContainer);
	LoadBorderCSSFromContainer(ParseCSSContainer);
	LoadBackgroundCSSFromContainer(ParseCSSContainer);
	LoadListItemCSSFromContainer(ParseCSSContainer);
	LoadPositionCSSFromContainer(ParseCSSContainer);
	ParseCSSContainer.style.cssText="";
	ParseCSSContainer.style.visibility="hidden";
}

function GetRidOfLengthUnit(sStr)
{
	sStr=sStr.replace("em","");
	sStr=sStr.replace("ex","");	
	sStr=sStr.replace("px","");
	sStr=sStr.replace("%","");	
	sStr=sStr.replace("in","");
	sStr=sStr.replace("cm","");	
	sStr=sStr.replace("mm","");
	sStr=sStr.replace("pt","");	
	sStr=sStr.replace("pc","");	
	return sStr;
}

function LoadFontCSSFromContainer(oContainer)
{
	var bFound=false;
	var oOption;
	//FontFamily
	if(oContainer.style.fontFamily && oContainer.style.fontFamily!="")
	{
		bFound=false;
		for(var i=0;(i<FontFamilySelect.options.length)&&!bFound;i++)
		{
			if(FontFamilySelect.options.item(i).value.toLowerCase()==oContainer.style.fontFamily.toLowerCase())
			{
				FontFamilySelect.options.item(i).selected=true;	
				bFound=true;
			}
		}
		if(!bFound)
		{
			oOption = document.createElement("OPTION");
			oOption.text=oContainer.style.fontFamily;
			oOption.value=oContainer.style.fontFamily;
						
			FontFamilySelect.add(oOption);
			oOption.selected=true;
		}
		FontFamily.value=FontFamilySelect.value;
		PreviewBox.style.fontFamily=FontFamilySelect.value;
	}
	var sStyleAndWeightStr="";
	//Font Style and Weight
	if(oContainer.style.fontStyle && oContainer.style.fontStyle!="")
	{
		sStyleAndWeightStr=oContainer.style.fontStyle;	
	}
	if(oContainer.style.fontWeight && oContainer.style.fontWeight!="")
	{
		if(sStyleAndWeightStr=="")
		{
			sStyleAndWeightStr=oContainer.style.fontWeight;	
		}
		else
		{
			sStyleAndWeightStr+="+"+oContainer.style.fontWeight;
		}
	}
	if(sStyleAndWeightStr && sStyleAndWeightStr!="")
	{
		bFound=false;
		for(var i=0;(i<FontStyleSelect.options.length)&&!bFound;i++)
		{
			if(FontStyleSelect.options.item(i).value.toLowerCase()==sStyleAndWeightStr.toLowerCase())
			{
				FontStyleSelect.options.item(i).selected=true;	
				bFound=true;
			}
		}
		if(bFound)
		{
			FontStyle.value=FontStyleSelect.value;
			PreviewBox.style.fontStyle=oContainer.style.fontStyle;
			PreviewBox.style.fontWeight=oContainer.style.fontWeight;
		}
	}
	
	//Font Size
	if(oContainer.style.fontSize && oContainer.style.fontSize!="")
	{
		bFound=false;
		for(var i=0;(i<FontSizeSelect.options.length)&&!bFound;i++)
		{
			if(FontSizeSelect.options.item(i).value.toLowerCase()==oContainer.style.fontSize.toLowerCase())
			{
				FontSizeSelect.options.item(i).selected=true;	
				bFound=true;
			}
		}
		if(!bFound)
		{
			oOption = document.createElement("OPTION");
			oOption.text=oContainer.style.fontSize;
			oOption.value=oContainer.style.fontSize;
			
			FontSizeSelect.add(oOption);
			oOption.selected=true;
		}
		FontSize.value=FontSizeSelect.value;
		PreviewBox.style.fontSize=FontSizeSelect.value;
	}
	
	//Font Color
	if(oContainer.style.color && oContainer.style.color!="")
	{
		color.value=oContainer.style.color;
		color.style.backgroundColor=oContainer.style.color;
		PreviewBox.style.color=oContainer.style.color;	
	}			
	
	//Underline
	td_Under.checked=oContainer.style.textDecorationUnderline;
	PreviewBox.style.textDecorationUnderline=oContainer.style.textDecorationUnderline;
	//Line-Through
	td_LineThrough.checked=oContainer.style.textDecorationLineThrough;
	PreviewBox.style.textDecorationLineThrough=oContainer.style.textDecorationLineThrough;	
	//Over Line
	td_Over.checked=oContainer.style.textDecorationOverline;
	PreviewBox.style.textDecorationOverline=oContainer.style.textDecorationOverline;
	//Blink
	td_Blink.checked=oContainer.style.textDecorationBlink;
	PreviewBox.style.textDecorationBlink=oContainer.style.textDecorationBlink;
	//Small-Cap fontVariant
	font_variant_small.checked=oContainer.style.fontVariant.toLowerCase()=="small-caps";
	PreviewBox.style.fontVariant=oContainer.style.fontVariant;
	//uppercase textTransform
	tt_uppercase.checked=oContainer.style.textTransform.toLowerCase()=="uppercase";
	tt_capitalize.checked=oContainer.style.textTransform.toLowerCase()=="capitalize";	
	PreviewBox.style.textTransform=oContainer.style.textTransform;
	//Hidden
	visibility_hidden.checked=oContainer.style.visibility=="hidden";
	PreviewBox.style.visibility=oContainer.style.visibility;
	//No-Decoration
	if(oContainer.style.textDecorationNone)
	{	
		td_Under.checked=false;
		td_LineThrough.checked=false;
		td_Over.checked=false;
		td_Blink.checked=false;
		td_None.checked=true;
		PreviewBox.style.textDecorationNone=oContainer.style.textDecorationNone;
	}
	
	//letterSpacing
	if(oContainer.style.letterSpacing && oContainer.style.letterSpacing!="" && oContainer.style.letterSpacing!="normal")
	{
		EnableUpDownControl(true,"SpanPoint");	
		if(oContainer.style.letterSpacing.indexOf("-") < 0 )
		{
			SpanSize.options.item(1).selected=true;
		}
		else
		{
			SpanSize.options.item(2).selected=true;
		}
		PreviewBox.style.letterSpacing=oContainer.style.letterSpacing;
		SpanPoint.value=GetRidOfLengthUnit(oContainer.style.letterSpacing.replace("-",""));
	}
	else
	{
		SpanSize.options.item(0).selected=true;
		EnableUpDownControl(false,"SpanPoint");
	}
	
	
	//Text Position
	if(oContainer.style.verticalAlign && oContainer.style.verticalAlign!="")
	{
		bFound=false;
		for(var i=0;(i<TextPosition.options.length)&&!bFound;i++)
		{
			if(TextPosition.options.item(i).value.toLowerCase()==oContainer.style.verticalAlign.toLowerCase())
			{
				TextPosition.options.item(i).selected=true;	
				PreviewBox.style.verticalAlign=oContainer.style.verticalAlign;				
				bFound=true;
			}
		}
	}
}

function LoadParagraphCSSFromContainer(oContainer)
{
	var bFound=false;
	var sTmpStr="";
	//text-align And textJustify
	if(oContainer.style.textAlign && oContainer.style.textAlign!="")
	{
		sTmpStr=oContainer.style.textAlign;	
	}
	if(oContainer.style.textJustify && oContainer.style.textJustify!="")
	{
		if(sTmpStr=="")
		{
			sTmpStr=oContainer.style.textJustify;	
		}
		else
		{
			sTmpStr+="+"+oContainer.style.textJustify;
		}
	}
	if(sTmpStr && sTmpStr!="")
	{
		bFound=false;
		for(var i=0;(i<textAlign.options.length)&&!bFound;i++)
		{
			if(textAlign.options.item(i).value.toLowerCase()==sTmpStr.toLowerCase())
			{
				textAlign.options.item(i).selected=true;	
				bFound=true;
			}
		}
		if(bFound)
		{
			PreviewBox.style.textAlign=oContainer.style.textAlign;
			PreviewBox.style.textJustify=oContainer.style.textJustify;
		}
	}
	
	// margin Left
	if(oContainer.style.marginLeft && oContainer.style.marginLeft!="")
	{
		LeftIdent.value=GetRidOfLengthUnit(oContainer.style.marginLeft);
		ParaPreviewBox.style.marginLeft=oContainer.style.marginLeft;
	}	
	
	// margin right
	if(oContainer.style.marginRight && oContainer.style.marginRight!="")
	{
		RightIdent.value=GetRidOfLengthUnit(oContainer.style.marginRight);
		ParaPreviewBox.style.marginRight=oContainer.style.marginRight;
	}
	
	// text ident
	if(oContainer.style.textIndent && oContainer.style.textIndent!="")
	{
		FirstLineIdent.value=GetRidOfLengthUnit(oContainer.style.textIndent);
		ParaPreviewBox.style.textIndent=oContainer.style.textIndent;
	}

	// marginTop
	if(oContainer.style.marginTop && oContainer.style.marginTop!="")
	{
		BeforeSpan.value=GetRidOfLengthUnit(oContainer.style.marginTop);
		ParaPreviewBox.style.marginTop=oContainer.style.marginTop;
	}
	
	// marginBottom
	if(oContainer.style.marginBottom && oContainer.style.marginBottom!="")
	{
		AfterSpan.value=GetRidOfLengthUnit(oContainer.style.marginBottom);
		ParaPreviewBox.style.marginBottom=oContainer.style.marginBottom;
	}
	
	//wordSpacing
	if(oContainer.style.wordSpacing && oContainer.style.wordSpacing!="")
	{
		WordSpace.value=GetRidOfLengthUnit(oContainer.style.wordSpacing);
		ParaPreviewBox.style.wordSpacing=oContainer.style.wordSpacing;
	}			

	//line height
	if(oContainer.style.lineHeight && oContainer.style.lineHeight!="")
	{
		bFound=false;
		for(var i=0;(i<LineHeight.options.length)&&!bFound;i++)
		{
			if(LineHeight.options.item(i).value.toLowerCase()==oContainer.style.lineHeight.toLowerCase())
			{
				LineHeight.options.item(i).selected=true;	
				bFound=true;
			}
		}
		if(!bFound)
		{
			oOption = document.createElement("OPTION");
			oOption.text=oContainer.style.lineHeight;
			oOption.value=oContainer.style.lineHeight;
			LineHeight.add(oOption);
			oOption.selected=true;
		}
		ParaPreviewBox.style.lineHeight=LineHeight.value;
	}		
}

function LoadBorderCSSFromContainer(oContainer)
{
	if(oContainer.style.paddingTop&&oContainer.style.paddingTop!=""||
	   oContainer.style.paddingBottom&&oContainer.style.paddingBottom!=""||
	   oContainer.style.paddingLeft&&oContainer.style.paddingLeft!=""||
	   oContainer.style.paddingRight&&oContainer.style.paddingRight!=""||
	   oContainer.style.borderTop&&oContainer.style.borderTop!=""||
	   oContainer.style.borderBottom&&oContainer.style.borderBottom!=""||
	   oContainer.style.borderLeft&&oContainer.style.borderLeft!=""||
	   oContainer.style.borderRight&&oContainer.style.borderRight!="")
	 {
		BorderDefault.className="NonRedBorder";
		BorderSquare.className="NonRedBorder";
		BorderUserDefined.className="RedBorder";
		EnablePaddingControl(true);
		if(oContainer.style.paddingTop&&oContainer.style.paddingTop!="")   
		{
			PendingTop.value=GetRidOfLengthUnit(oContainer.style.paddingTop);
			BorderPreviewBox.style.paddingTop=oContainer.style.paddingTop;	
		}
		if(oContainer.style.paddingBottom&&oContainer.style.paddingBottom!="")   
		{
			PendingBottom.value=GetRidOfLengthUnit(oContainer.style.paddingBottom);
			BorderPreviewBox.style.paddingBottom=oContainer.style.paddingBottom;	
		}
		if(oContainer.style.paddingLeft&&oContainer.style.paddingLeft!="")   
		{
			PendingLeft.value=GetRidOfLengthUnit(oContainer.style.paddingLeft);
			BorderPreviewBox.style.paddingLeft=oContainer.style.paddingLeft;	
		}
		if(oContainer.style.paddingRight&&oContainer.style.paddingRight!="")   
		{
			PendingRight.value=GetRidOfLengthUnit(oContainer.style.paddingRight);
			BorderPreviewBox.style.paddingRight=oContainer.style.paddingRight;	
		}
		if(oContainer.style.borderTop&&oContainer.style.borderTop!="")
		{
			BorderPreviewBox.style.borderTop=oContainer.style.borderTop;
		}  
		if(oContainer.style.borderBottom&&oContainer.style.borderBottom!="")
		{
			BorderPreviewBox.style.borderBottom=oContainer.style.borderBottom;
		}  
		if(oContainer.style.borderLeft&&oContainer.style.borderLeft!="")
		{
			BorderPreviewBox.style.borderLeft=oContainer.style.borderLeft;
		}  						
		if(oContainer.style.borderRight&&oContainer.style.borderRight!="")
		{
			BorderPreviewBox.style.borderRight=oContainer.style.borderRight;
		}  						
	 }
	 else
	 {
		BorderDefault.className="RedBorder";
		BorderSquare.className="NonRedBorder";
		BorderUserDefined.className="NonRedBorder";	 
	 }
}
function LoadBackgroundCSSFromContainer(oContainer)
{
	if(oContainer.style.backgroundColor&&oContainer.style.backgroundColor!="")
	{
		BackgroundColor.style.backgroundColor=oContainer.style.backgroundColor;
		BackgroundColor.value=oContainer.style.backgroundColor;
		BackgroundPreviewBox.style.backgroundColor=oContainer.style.backgroundColor;
	} 
	if(oContainer.style.color&&oContainer.style.color!="")
	{
		ForegroundColor.style.backgroundColor=oContainer.style.color;
		ForegroundColor.value=oContainer.style.color;
		BackgroundPreviewBox.style.color=oContainer.style.color;
	}
	if(oContainer.style.backgroundImage&&oContainer.style.backgroundImage!="")
	{ 
		BackgroundPositionY.disabled=false;
		BackgroundRepeat.disabled=false;
		BackgroundPositionX.disabled=false;
		BackgroundAttachment.disabled=false;
		ArgumentBGImageFile.innerText=oContainer.style.backgroundImage.substring(4,oContainer.style.backgroundImage.length-1);
		BackgroundPreviewBox.style.backgroundImage=oContainer.style.backgroundImage;
		bFound=false;
		for(var i=0;(i<BackgroundPositionY.options.length)&&!bFound;i++)
		{
			if(BackgroundPositionY.options.item(i).value.toLowerCase()==oContainer.style.backgroundPositionY.toLowerCase())
			{
				BackgroundPositionY.options.item(i).selected=true;	
				bFound=true;
			}
		}
		bFound=false;
		for(var i=0;(i<BackgroundRepeat.options.length)&&!bFound;i++)
		{
			if(BackgroundRepeat.options.item(i).value.toLowerCase()==oContainer.style.backgroundRepeat.toLowerCase())
			{
				BackgroundRepeat.options.item(i).selected=true;	
				bFound=true;
			}
		}
		bFound=false;
		for(var i=0;(i<BackgroundPositionX.options.length)&&!bFound;i++)
		{
			if(BackgroundPositionX.options.item(i).value.toLowerCase()==oContainer.style.backgroundPositionX.toLowerCase())
			{
				BackgroundPositionX.options.item(i).selected=true;	
				bFound=true;
			}
		}
		bFound=false;
		for(var i=0;(i<BackgroundAttachment.options.length)&&!bFound;i++)
		{
			if(BackgroundAttachment.options.item(i).value.toLowerCase()==oContainer.style.backgroundAttachment.toLowerCase())
			{
				BackgroundAttachment.options.item(i).selected=true;	
				bFound=true;
			}
		}								
		ApplyBackgroundImageProperty();
	}		
	
}
function LoadListItemCSSFromContainer(oContainer)
{
	CommonNone.className="NonRedBorder";
	CommonDisc.className="NonRedBorder";
	CommonCircle.className="NonRedBorder"
	CommonSquare.className="NonRedBorder";
	
	NumericNone.className="NonRedBorder";
	NumericDecimal.className="NonRedBorder"
	NumericLowerAlpha.className="NonRedBorder";
	NumericLowerRoman.className="NonRedBorder";
	NumericUpperAlpha.className="NonRedBorder";
	NumericUpperRoman.className="NonRedBorder";
	
	if(oContainer.style.listStyleImage&&oContainer.style.listStyleImage!="")
	{
		ArgumentListImageFile.innerText=oContainer.style.listStyleImage.substring(4,oContainer.style.listStyleImage.length-1)
		ListItemPreviewBox.style.listStyleImage=oContainer.style.listStyleImage;	
	}
	else
	{
		CommonDisc.className="RedBorder";
	}
	
	if(oContainer.style.listStyleType.toLowerCase()=="none")
	{
		CommonNone.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="none";
	}
	if(oContainer.style.listStyleType.toLowerCase()=="circle")
	{
		CommonCircle.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="circle";		
	}
	if(oContainer.style.listStyleType.toLowerCase()=="square")
	{
		CommonSquare.className="RedBorder";
		CommonDisc.className="NonRedBorder";		
		ListItemPreviewBox.style.listStyleType="square";		
	}
	if(oContainer.style.listStyleType.toLowerCase()=="decimal")
	{
		NumericDecimal.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="decimal";		
	}
	if(oContainer.style.listStyleType.toLowerCase()=="lower-alpha")
	{
		NumericLowerAlpha.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="lower-alpha";		
	}
	if(oContainer.style.listStyleType.toLowerCase()=="lower-roman")
	{
		NumericLowerRoman.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="lower-roman";		
	}
	
	if(oContainer.style.listStyleType.toLowerCase()=="upper-alpha")
	{
		NumericUpperAlpha.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="upper-alpha";		
	}
	if(oContainer.style.listStyleType.toLowerCase()=="upper-roman")
	{
		NumericUpperRoman.className="RedBorder";
		CommonDisc.className="NonRedBorder";
		ListItemPreviewBox.style.listStyleType="upper-roman";		
	}
	ListStylePosition.checked=oContainer.style.listStylePosition!="inside";
	ListItemPreviewBox.style.listStylePosition=oContainer.style.listStylePosition;	
}
function LoadPositionCSSFromContainer(oContainer)
{
	StyleNone.className="NonRedBorder";
	StyleLeft.className="NonRedBorder";
	StyleRight.className="NonRedBorder";
	var bSelected=false;
	if(oContainer.style.styleFloat.toLowerCase()=="left")	
	{
		StyleLeft.className="RedBorder";
		bSelected=true;
		PositionPreviewBox.style.styleFloat="left";
	}
	if(oContainer.style.styleFloat.toLowerCase()=="right")	
	{
		StyleRight.className="RedBorder";
		bSelected=true;
		PositionPreviewBox.style.styleFloat="right";
	}
	if(!bSelected)	
	{
		StyleNone.className="RedBorder";
	}
	bSelected=false;
	PositionNone.className="NonRedBorder";
	PositionAbsolute.className="NonRedBorder";
	PositionRelative.className="NonRedBorder";
	if(oContainer.style.position.toLowerCase()=="relative")	
	{
		PositionRelative.className="RedBorder";
		PositionPreviewBox.style.position="relative";
		bSelected=true;	
	}	
	if(oContainer.style.position.toLowerCase()=="absolute")	
	{
		PositionAbsolute.className="RedBorder";
		PositionPreviewBox.style.position="absolute";
		bSelected=true;	
	}
	if(!bSelected)	
	{
		PositionNone.className="RedBorder";
	}
	if(oContainer.style.left&& oContainer.style.left!="")
	{
		PositionLeft.value=GetRidOfLengthUnit(oContainer.style.left);
	}
	if(oContainer.style.top&& oContainer.style.top!="")
	{
		PositionTop.value=GetRidOfLengthUnit(oContainer.style.top);
	}
	if(oContainer.style.zIndex&& oContainer.style.zIndex!="")
	{
		LayerSequence.value=oContainer.style.zIndex;
	}		
	ChangePositionAndSizeStatus();	
	if(oContainer.style.width&& oContainer.style.width!="")
	{
		PositionWidth.value=GetRidOfLengthUnit(oContainer.style.width);
		PositionPreviewBox.style.width=oContainer.style.width;
	}
	if(oContainer.style.height&& oContainer.style.height!="")
	{
		PositionHeight.value=GetRidOfLengthUnit(oContainer.style.height);
		PositionPreviewBox.style.height=oContainer.style.height;
	}		
}