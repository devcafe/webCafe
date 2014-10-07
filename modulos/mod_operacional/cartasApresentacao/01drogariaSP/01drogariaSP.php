<?php
  include("../../../../conf/conn.php");

  $idLoja = $_GET['idLoja'];

  $mat = $_GET['mat'];

  $loja = $pdo->prepare("
    Select
      *
    From
      ipsum_operacionallojas a
    Inner Join ipsum_operacionalbandeiras b On (a.idEstabBandeira = b.idBandeira)
    Where
      a.idLoja = ?
  ");

  $loja->execute(array( $idLoja ));

  $resLoja = $loja->fetch(PDO::FETCH_OBJ);
  
  setlocale(LC_TIME, "pt");

?>


<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="CARTA%20DROGARIA%20SP%20CAFE_arquivos/filelist.xml">
<link rel=Edit-Time-Data
href="CARTA%20DROGARIA%20SP%20CAFE_arquivos/editdata.mso">
<!--[if !mso]>
<style>
v\:* {behavior:url(#default#VML);}
o\:* {behavior:url(#default#VML);}
w\:* {behavior:url(#default#VML);}
.shape {behavior:url(#default#VML);}
</style>
<![endif]-->
<title>São Paulo, 18 de abril de 2008</title>
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>lucianaradaic</o:Author>
  <o:LastAuthor>Luis Abeno</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>75</o:TotalTime>
  <o:LastPrinted>2014-08-11T17:27:00Z</o:LastPrinted>
  <o:Created>2014-08-28T19:59:00Z</o:Created>
  <o:LastSaved>2014-08-28T19:59:00Z</o:LastSaved>
  <o:Pages>1</o:Pages>
  <o:Words>314</o:Words>
  <o:Characters>2112</o:Characters>
  <o:Company>Cafe Comunicacao</o:Company>
  <o:Lines>17</o:Lines>
  <o:Paragraphs>4</o:Paragraphs>
  <o:CharactersWithSpaces>2422</o:CharactersWithSpaces>
  <o:Version>15.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:TargetScreenSize>800x600</o:TargetScreenSize>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<link rel=dataStoreItem
href="CARTA%20DROGARIA%20SP%20CAFE_arquivos/item0001.xml"
target="CARTA%20DROGARIA%20SP%20CAFE_arquivos/props002.xml">
<link rel=themeData href="CARTA%20DROGARIA%20SP%20CAFE_arquivos/themedata.thmx">
<link rel=colorSchemeMapping
href="CARTA%20DROGARIA%20SP%20CAFE_arquivos/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:GrammarState>Clean</w:GrammarState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:HyphenationZone>21</w:HyphenationZone>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>PT-BR</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:UseWord2010TableStyleRules/>
   <w:DontGrowAutofit/>
   <w:DontUseIndentAsNumberingTabStop/>
   <w:FELineBreak11/>
   <w:WW11IndentRules/>
   <w:DontAutofitConstrainedTables/>
   <w:AutofitLikeWW11/>
   <w:HangulWidthLikeWW11/>
   <w:UseNormalStyleForList/>
   <w:DontVertAlignCellWithSp/>
   <w:DontBreakConstrainedForcedTables/>
   <w:DontVertAlignInTxbx/>
   <w:Word11KerningPairs/>
   <w:CachedColBalance/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" LatentStyleCount="371">
  <w:LsdException Locked="false" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="99" SemiHidden="true"
   Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="99" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 6"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536870145 1107305727 0 0 415 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
 /* Style Definitions */
 .WordSection1{
  width: 800px;
  margin: 0 auto;
  padding:30px 80px 30px 80px;
 }
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 212.6pt right 425.2pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	tab-stops:center 212.6pt right 425.2pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:"Times New Roman";}
  .toUp{
margin-top: -88px;
float: right;
margin-right: 30px;
  }
p.MsoDocumentMap, li.MsoDocumentMap, div.MsoDocumentMap
	{mso-style-noshow:yes;
	mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	background:navy;
	font-size:10.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:"Times New Roman";}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-unhide:no;
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	font-family:"Tahoma","sans-serif";
	mso-fareast-font-family:"Times New Roman";}
span.GramE
	{mso-style-name:"";
	mso-gram-e:yes;}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("CARTA%20DROGARIA%20SP%20CAFE_arquivos/header.htm") fs;
	mso-footnote-continuation-separator:url("CARTA%20DROGARIA%20SP%20CAFE_arquivos/header.htm") fcs;
	mso-endnote-separator:url("CARTA%20DROGARIA%20SP%20CAFE_arquivos/header.htm") es;
	mso-endnote-continuation-separator:url("CARTA%20DROGARIA%20SP%20CAFE_arquivos/header.htm") ecs;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:70.85pt 3.0cm 70.85pt 3.0cm;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-header:url("CARTA%20DROGARIA%20SP%20CAFE_arquivos/header.htm") h1;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Tabela normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="3074"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=PT-BR style='tab-interval:35.4pt'>

<div class=WordSection1>

<p class=MsoNormal align=right style='text-align:left;mso-outline-level:1'><!--[if gte vml 1]><v:group
 id="_x0000_s1026" style='position:absolute;left:0;text-align:left;
 margin-left:-38.2pt;margin-top:-64.85pt;width:182.7pt;height:125.8pt;
 z-index:251657728' coordorigin="384,364" coordsize="4992,3902">
 <v:shapetype id="_x0000_t75" coordsize="21600,21600" o:spt="75"
  o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe" filled="f" stroked="f">
  <v:stroke joinstyle="miter"/>
  <v:formulas>
   <v:f eqn="if lineDrawn pixelLineWidth 0"/>
   <v:f eqn="sum @0 1 0"/>
   <v:f eqn="sum 0 0 @1"/>
   <v:f eqn="prod @2 1 2"/>
   <v:f eqn="prod @3 21600 pixelWidth"/>
   <v:f eqn="prod @3 21600 pixelHeight"/>
   <v:f eqn="sum @0 0 1"/>
   <v:f eqn="prod @6 1 2"/>
   <v:f eqn="prod @7 21600 pixelWidth"/>
   <v:f eqn="sum @8 21600 0"/>
   <v:f eqn="prod @7 21600 pixelHeight"/>
   <v:f eqn="sum @10 21600 0"/>
  </v:formulas>
  <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
  <o:lock v:ext="edit" aspectratio="t"/>
 </v:shapetype><v:shape id="_x0000_s1027" type="#_x0000_t75" style='position:absolute;
  left:384;top:364;width:4992;height:3902'>
  <v:imagedata src="CARTA%20DROGARIA%20SP%20CAFE_arquivos/image001.png"
   o:title=""/>
 </v:shape><v:rect id="_x0000_s1028" style='position:absolute;left:576;top:3696;
  width:4608;height:528;mso-wrap-style:none;v-text-anchor:middle' stroked="f"/>
</v:group><![endif]--><![if !vml]><span style='mso-ignore:vglayout;position:
relative;z-index:251657728'><span style='left:0px;
top:-87px;width:244px;height:168px'><img width=244 height=168
src="CARTA%20DROGARIA%20SP%20CAFE_arquivos/image002.jpg" style = "text-align:left !important;" v:shapes="_x0000_s1026 _x0000_s1027 _x0000_s1028"></span></span><![endif]>

<div class = "toUp">
<span style='font-size:11.0pt;font-family:"Arial","sans-serif"'> <?php echo "SÃO PAULO"; ?>, </span><!--[if supportFields]><span
style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>TIME \@ &quot;d' de 'MMMM' de 'yyyy&quot; <span
style='mso-element:field-separator'></span></span><![endif]--><span
style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'><?php  echo date('d') ?> de <?php  echo strftime("%B"); ?> de <?php  echo date('Y'); ?></span></span>
</div>

<!--[if supportFields]><span
style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-element:field-end'></span></span><![endif]--><span style='font-size:
11.0pt;font-family:"Arial","sans-serif"'><o:p></o:p></span></p>

<p class=MsoNormal align=right style='text-align:right'><span style='font-size:
11.0pt;font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=right style='text-align:right'><span style='font-size:
11.0pt;font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=right style='text-align:right'><span style='font-size:
11.0pt;font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=right style='text-align:right'><span style='font-size:
11.0pt;font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify;mso-outline-level:1'><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'>Ao<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;mso-outline-level:1'><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif";color:black'><?php  echo utf8_decode($resLoja->nome); ?><o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify;mso-outline-level:1'><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif";color:black'><span style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD LOJA <span style='mso-element:field-separator'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif";color:black'><span style='mso-no-proof:yes'><?php  echo utf8_decode($resLoja->bandeira); ?></span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif";color:black'><span style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif";color:black'><o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD ENDEREÇO <span style='mso-element:
field-separator'></span></span></b><![endif]--><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'><?php  echo utf8_decode($resLoja->rua); ?>,<?php  echo $resLoja->numero; ?></span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD BAIRRO <span style='mso-element:
field-separator'></span></span></b><![endif]--><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'><?php  echo utf8_decode($resLoja->bairro); ?></span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'> – </span></b><!--[if supportFields]><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD CIDADE <span style='mso-element:
field-separator'></span></span></b><![endif]--><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'><?php  echo utf8_decode($resLoja->cidade); ?></span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'>- <?php  echo $resLoja->uf; ?><o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>Prezados Senhores,<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>A <b style='mso-bidi-font-weight:normal'>ABBOTT
</b>declara para os devidos fins que o(a) Sr.(a)</span><b style='mso-bidi-font-weight:
normal'><span style='font-family:"Arial","sans-serif"'> </span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'><span
style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD NOME_COLABORADOR <span
style='mso-element:field-separator'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'>RICARDO RODRIGUES SANTOS</span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'><span
style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'>,
</span></b><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'>brasileiro(a),
portador(a) da cédula de identidade <b style='mso-bidi-font-weight:normal'>RG
nº </b></span><!--[if supportFields]><b style='mso-bidi-font-weight:normal'><span
style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD RG <span style='mso-element:field-separator'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-no-proof:yes'>416366089</span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'> </span></b><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'>funcionário(a) desta empresa e será deslocado para
atuação nessa loja na condição de </span><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD FUNÇÃO <span style='mso-element:
field-separator'></span></span></b><![endif]--><b style='mso-bidi-font-weight:
normal'><span style='font-size:11.0pt;font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'>REPOSITOR(A)</span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'><span style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'> </span></b><span style='font-size:11.0pt;font-family:
"Arial","sans-serif"'>visando realizar exposição dos produtos fornecidos por<b
style='mso-bidi-font-weight:normal'> ABBOTT, </b>conforme o disposto no Acordo
Comercial assinado com V. Sras.<b style='mso-bidi-font-weight:normal'><span
style='color:black'><o:p></o:p></span></b></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>Declaro que o (a) Sr.(a) </span><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'><span
style='mso-element:field-begin'></span><span
style='mso-spacerun:yes'> </span>MERGEFIELD &quot;NOME_COLABORADOR&quot; <span
style='mso-element:field-separator'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'><span
style='mso-no-proof:yes'>RICARDO RODRIGUES SANTOS</span></span></b><!--[if supportFields]><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'><span
style='mso-element:field-end'></span></span></b><![endif]--><b
style='mso-bidi-font-weight:normal'><span style='font-family:"Arial","sans-serif"'>,</span></b><span
style='font-size:11.0pt;font-family:"Arial","sans-serif"'> é funcionário(a)
devidamente registrado e que todas as obrigações trabalhistas e previdenciárias
do(a) mesmo(a) são devidamente cumpridas. Comprometo-me a apresentar, a cada
seis meses, uma nova declaração nestes termos, a carteira de trabalho do
funcionário, bem como uma cópia das guias de recolhimento dos encargos
referentes ao Fundo de Garantia por Tempo de Serviço (FGTS) e ao Instituto
Nacional de Seguro Social (INSS) devidamente quitadas. Estou ciente de que,
caso as obrigações acima não <span class=GramE>sejam</span> cumpridas, o acesso
do promotor à loja será impedido até que sejam sanadas as irregularidades
encontradas.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>Declaro também estar ciente de que não existe
vínculo empregatício entre o (a) referido(a) funcionário(a) e o DROGARIA SÃO PAULO,
obrigando-me a assumir quaisquer despesas decorrentes de processos judiciais ou
administrativos movidos por este(a) funcionário(a) contra o DROGARIA SÃO PAULO.<b
style='mso-bidi-font-weight:normal'><o:p></o:p></b></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>Por fim, assumo toda e qualquer
responsabilidade pela qualidade dos produtos e adequação às exigências legais
em vigor, bem como quaisquer atos ou omissões do(a) referido(a) funcionário(a),
ficando obrigada a ressarcir o DROGARIA SÃO PAULO por qualquer prejuízo sofrido
em decorrência dos produtos e/ou da conduta do(a) referido(a) funcionário(a).<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>Esta declaração terá validade pelo prazo de 6
meses e prevalecerá sobre o Acordo Comercial assinado por mim junto a esta
empresa. O Acordo Comercial, contudo, deverá ser aplicado subsidiariamente para
as condições não previstas nesta declaração.<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify;mso-outline-level:1'><span
style='font-size:11.0pt;font-family:"Arial","sans-serif"'>Atenciosamente,<o:p></o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'>__________________________________________<o:p></o:p></span></p>

<p class=MsoNormal style='mso-outline-level:1'><b style='mso-bidi-font-weight:
normal'><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>CAFÉ
EXPRESSO SERVIÇOS DE TERCEIRIZAÇÃO DE MÃO DE OBRA LTDA.<o:p></o:p></span></b></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='text-align:justify'><span style='font-size:11.0pt;
font-family:"Arial","sans-serif"'><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>
