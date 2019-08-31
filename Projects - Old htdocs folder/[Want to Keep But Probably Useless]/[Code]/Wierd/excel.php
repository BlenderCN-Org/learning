<?php
    //
    class SimpleExcelCellsTypes {
        const None = 0;
        const Numeric = 1;
        const Date = 2;
        const Text = 3;
    }
    class SimpleExcelSheets {
        public $named = null;        
        public $fullfile = null;
        public $has_header = null;
        public $has_data = null;
        public $max_row = 1;
    }
    class SimpleExcel {
        //
        private $ColumnText = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ','EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EW','EX','EY','EZ','FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FW','FX','FY','FZ','GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GW','GX','GY','GZ','HA','HB','HC','HD','HE','HF','HG','HH','HI','HJ','HK','HL','HM','HN','HO','HP','HQ','HR','HS','HT','HU','HV','HW','HX','HY','HZ','IA','IB','IC','ID','IE','IF','IG','IH','II','IJ','IK','IL','IM','IN','IO','IP','IQ','IR','IS','IT','IU','IV');
        //
        private $Strings = array();
        private $Header = array();
        //
        private $worksheets = array();
        //
        private $DataFile = "";
        //
        private $db = null;
        //
        public $CreatedBy = "";
        public $Company = "";
        //
        private $workbook = "";
        private $styles = "";
        private $sharedStrings = "";
        private $content_types = "";
        private $rels = "";
        private $app = "";
        private $core = "";
        private $xl_rels = "";
        private $theme1 = "";
        private $sheet1_rels = "";
        //
        private $MaxColumn = 0;
        private $MaxRow = 0;
        //
        private $ActiveSheet = 0;
        //
        function __construct() {
            // Create the SQLite database in memory at creation.
            if (is_null($this->db)) {
                if ($this->db = new SQLite3(':memory:')) {
                    $this->db->exec('CREATE TABLE storage (sheet INT, row INT, column INT, data_type INT, original_value TEXT, date_value INT, text_index INT);');
                } else {
                }
            }
            //
            $Sheet1 = new SimpleExcelSheets();
            $Sheet1->named = "Sheet1";
            $Sheet1->has_header = false;
            $Sheet1->has_data = false;
            $this->worksheets[] = $Sheet1;
            //
            $Sheet2 = new SimpleExcelSheets();
            $Sheet2->named = "Sheet2";
            $Sheet2->has_header = false;
            $Sheet2->has_data = false;
            $this->worksheets[] = $Sheet2;
            //
            $Sheet3 = new SimpleExcelSheets();
            $Sheet3->named = "Sheet3";
            $Sheet3->has_header = false;
            $Sheet3->has_data = false;
            $this->worksheets[] = $Sheet3;
            //
        }
        //
        function checkDatabase($clearData = false, $clearHeader = false) {
            //
            if (is_null($this->db)) {
                $this->db = new SQLite3(':memory:');
                $this->db->exec('CREATE TABLE storage (sheet INT, row INT, column INT, data_type INT, original_value TEXT, date_value INT, text_index INT);');
            } else {
                if ($clearData == true) {
                    $this->worksheets[$this->ActiveSheet]->has_data = false;
                    $this->db->exec("DELETE FROM storage WHERE sheet = {$this->ActiveSheet} AND row > 1;");
                }
                if ($clearHeader == true) {
                    $this->worksheets[$this->ActiveSheet]->has_header = false;
                    $this->db->exec("DELETE FROM storage WHERE sheet = {$this->ActiveSheet} AND row = 1;");
                }
            }
            //            
        }
        //
        private function EscapeXML($text) {
            return str_replace("%", "%", str_replace(">", ">", str_replace("<", "<", str_replace("&", "&", $text))));
        }
        //
        private function BuildFiles() {
            //
            // ------> /xl/workbook.xml as $workbook, simple container listing worksheets with their IDs.
            ;{
            $this->workbook = " <?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?> ";
            $this->workbook .= "<workbook xmlns=\"http://schemas.openxmlformats.org/spreadsheetml/2006/main\" xmlns:r=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships\">";
            $this->workbook .= "    <fileVersion appName=\"xl\" lastEdited=\"4\" lowestEdited=\"4\" rupBuild=\"4506\" />";
            $this->workbook .= "    <workbookPr defaultThemeVersion=\"124226\" />";
            $this->workbook .= "    <bookViews>";
            $this->workbook .= "        <workbookView xWindow=\"240\" yWindow=\"75\" windowWidth=\"16140\" windowHeight=\"10365\" />";
            $this->workbook .= "    </bookViews>";
            $this->workbook .= "    <sheets>";
            foreach ($this->worksheets as $key=>$value) {
                // Loop through all worksheets in the workbook.
                $this->workbook .= "        <sheet name=\"".$value->named."\" sheetId=\"".(string)($key+1)."\" r:id=\"rId".(string)($key+1)."\" />";
                // Use the name of the workbook and then the index (1 based) as the Sheet ID and the internal rId.
            }
            $this->workbook .= "    </sheets>";
            $this->workbook .= "    <calcPr calcId=\"114210\" />";
            $this->workbook .= "</workbook>";
            ;}
            // ------> /xl/styles.xml as $styles, container for all styles used in the workbook. Indexes (used as IDs) are 0 based.
            ;{
            $this->styles = " <?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?> ";
            $this->styles .= "<styleSheet xmlns=\"http://schemas.openxmlformats.org/spreadsheetml/2006/main\">";
            $this->styles .= "    <fonts count=\"2\">";
            $this->styles .= "        <font>";
            $this->styles .= "            <sz val=\"10\" />";
            $this->styles .= "            <name val=\"Arial\" />";
            $this->styles .= "        </font>";
            $this->styles .= "        <font>";
            $this->styles .= "            <b />";
            $this->styles .= "            <sz val=\"10\" />";
            $this->styles .= "            <name val=\"Arial\" />";
            $this->styles .= "            <family val=\"2\" />";
            $this->styles .= "        </font>";
            $this->styles .= "    </fonts>";
            $this->styles .= "    <fills count=\"3\">";
            $this->styles .= "        <fill>";
            $this->styles .= "            <patternFill patternType=\"none\" />";
            $this->styles .= "        </fill>";
            $this->styles .= "        <fill>";
            $this->styles .= "            <patternFill patternType=\"gray125\" />";
            $this->styles .= "        </fill>";
            $this->styles .= "        <fill>";
            $this->styles .= "            <patternFill patternType=\"solid\">";
            $this->styles .= "                <fgColor indexed=\"22\" />";
            $this->styles .= "                <bgColor indexed=\"64\" />";
            $this->styles .= "            </patternFill>";
            $this->styles .= "        </fill>";
            $this->styles .= "    </fills>";
            $this->styles .= "    <borders count=\"2\">";
            $this->styles .= "        <border>";
            $this->styles .= "            <left />";
            $this->styles .= "            <right />";
            $this->styles .= "            <top />";
            $this->styles .= "            <bottom />";
            $this->styles .= "            <diagonal />";
            $this->styles .= "        </border>";
            $this->styles .= "        <border>";
            $this->styles .= "            <left style=\"thin\">";
            $this->styles .= "                <color indexed=\"64\" />";
            $this->styles .= "            </left>";
            $this->styles .= "            <right style=\"thin\">";
            $this->styles .= "                <color indexed=\"64\" />";
            $this->styles .= "            </right>";
            $this->styles .= "            <top style=\"thin\">";
            $this->styles .= "                <color indexed=\"64\" />";
            $this->styles .= "            </top>";
            $this->styles .= "            <bottom style=\"thin\">";
            $this->styles .= "                <color indexed=\"64\" />";
            $this->styles .= "            </bottom>";
            $this->styles .= "            <diagonal />";
            $this->styles .= "        </border>";
            $this->styles .= "    </borders>";
            $this->styles .= "    <cellStyleXfs count=\"1\">";
            $this->styles .= "        <xf numFmtId=\"0\" fontId=\"0\" fillId=\"0\" borderId=\"0\" />";
            $this->styles .= "    </cellStyleXfs>";
            $this->styles .= "    <cellXfs count=\"3\">";
            $this->styles .= "        <xf numFmtId=\"0\" fontId=\"0\" fillId=\"0\" borderId=\"0\" xfId=\"0\" />";
            $this->styles .= "        <xf numFmtId=\"0\" fontId=\"1\" fillId=\"2\" borderId=\"1\" xfId=\"0\" applyFont=\"1\" applyFill=\"1\" applyBorder=\"1\" applyAlignment=\"1\">";
            $this->styles .= "            <alignment horizontal=\"center\" />";
            $this->styles .= "        </xf>";
            $this->styles .= "        <xf numFmtId=\"14\" fontId=\"0\" fillId=\"0\" borderId=\"0\" xfId=\"0\" applyNumberFormat=\"1\" />";
            $this->styles .= "    </cellXfs>";
            $this->styles .= "    <cellStyles count=\"1\">";
            $this->styles .= "        <cellStyle name=\"Normal\" xfId=\"0\" builtinId=\"0\" />";
            $this->styles .= "    </cellStyles>";
            $this->styles .= "    <dxfs count=\"0\" />";
            $this->styles .= "    <tableStyles count=\"0\" defaultTableStyle=\"TableStyleMedium9\" defaultPivotStyle=\"PivotStyleLight16\" />";
            $this->styles .= "</styleSheet>";
            ;}
            // ------> /xl/sharedStrings.xml as $sharedStrings
            ;{
            $this->sharedStrings = " <?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?> ";
            $this->sharedStrings .= "<sst xmlns=\"http://schemas.openxmlformats.org/spreadsheetml/2006/main\" count=\"".(string)count($this->Strings)."\" uniqueCount=\"".(string)count($this->Strings)."\">";
            foreach ($this->Strings as $value) {
                $this->sharedStrings .= "    <si><t>".$this->EscapeXML($value)."</t></si>";
            }            
            $this->sharedStrings .= "</sst>";
            ;}
            // ------> /xl/worksheets/sheet1.xml as $Sheet1
            ;{
            foreach ($this->worksheets as $key=>$value) {
                while (true) {
                    $value->fullfile = sys_get_temp_dir().'/'.uniqid('SimpleExcel', true).'.xml';
                    if (!file_exists($value->fullfile)) break;
                }
                if (!$f = fopen($value->fullfile, 'w')) {exit;}
                if ($value->has_header == false && $value->has_data == false) {
                    fwrite($f, " <?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?> ");
                    fwrite($f, "<worksheet xmlns=\"http://schemas.openxmlformats.org/spreadsheetml/2006/main\" xmlns:r=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships\">");
                    fwrite($f, "    <dimension ref=\"A1\" />");
                    fwrite($f, "    <sheetViews>");
                    fwrite($f, "        <sheetView workbookViewId=\"0\" />");
                    fwrite($f, "    </sheetViews>");
                    fwrite($f, "    <sheetFormatPr defaultRowHeight=\"12.75\" />");
                    fwrite($f, "    <sheetData />");
                    fwrite($f, "    <phoneticPr fontId=\"0\" type=\"noConversion\" />");
                    fwrite($f, "    <pageMargins left=\"0.75\" right=\"0.75\" top=\"1\" bottom=\"1\" header=\"0.5\" footer=\"0.5\" />");
                    fwrite($f, "    <headerFooter alignWithMargins=\"0\" />");
                    fwrite($f, "</worksheet>");
                } else {
                    fwrite($f, " <?xml version=\"1.0\" encoding=\"utf-8\" standalone=\"yes\"?> ");
                    fwrite($f, "<worksheet xmlns=\"http://schemas.openxmlformats.org/spreadsheetml/2006/main\" xmlns:r=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships\">");
                    fwrite($f, "    <dimension ref=\"A1:".$this->ColumnText[$this->MaxColumn].(string)($value->max_row)."\" />");
                    fwrite($f, "    <sheetViews>");
                    if ($key == 0) {
                        fwrite($f, "        <sheetView tabSelected=\"1\" workbookViewId=\"0\">");
                    } else {
                        fwrite($f, "        <sheetView tabSelected=\"0\" workbookViewId=\"0\">");
                    }
                    fwrite($f, "            <selection activeCell=\"A1\" sqref=\"A1\" />");
                    fwrite($f, "        </sheetView>");
                    fwrite($f, "    </sheetViews>");
                    fwrite($f, "    <sheetFormatPr defaultRowHeight=\"12.75\" />");
                    fwrite($f, "    <cols>");
                    fwrite($f, "        <col min=\"1\" max=\"".(string)$this->MaxColumn."\" width=\"10.140625\" bestFit=\"1\" customWidth=\"1\" />");
                    fwrite($f, "    </cols>");
                    fwrite($f, "    <sheetData>");
                    $column = 1;
                    $row_index = 0;
                    $results = $this->db->query("SELECT s1.row, (SELECT count(s2.column) FROM storage s2 WHERE s2.sheet = s1.sheet AND s2.row = s1.row) as column_count, s1.column, s1.data_type, s1.original_value, s1.date_value, s1.text_index FROM storage s1 WHERE s1.sheet = $key ORDER BY s1.row, s1.column;");
                    while ($e = $results->fetchArray(SQLITE3_NUM)) {
                        if ($e[0] != $row_index) {
                            if ($e[0] > 1) {fwrite($f, "        </row>");}
                            fwrite($f, "        <row r=\"{$e[0]}\" spans=\"1:".$e[1]."\">");
                            $row_index = $e[0];
                        }
                        if ($e[0] == 1) {
                            fwrite($f, "            <c r=\"".$this->ColumnText[$e[2]-1].(string)$e[0]."\" s=\"1\" t=\"s\">");
                            fwrite($f, "                <v>".$e[6]."</v>");
                        } else {
                            switch ($e[3]) {
                                case SimpleExcelCellsTypes::None:
                                    fwrite($f, "            <c r=\"".$this->ColumnText[$e[2]-1].(string)$e[0]."\">");
                                    fwrite($f, "                <v></v>");
                                    break;
                                case SimpleExcelCellsTypes::Numeric:
                                    fwrite($f, "            <c r=\"".$this->ColumnText[$e[2]-1].(string)$e[0]."\">");
                                    fwrite($f, "                <v>".$e[4]."</v>");
                                    break;
                                case SimpleExcelCellsTypes::Text:
                                    fwrite($f, "            <c r=\"".$this->ColumnText[$e[2]-1].(string)$e[0]."\" t=\"s\">");
                                    fwrite($f, "                <v>".$e[6]."</v>");
                                    break;
                                case SimpleExcelCellsTypes::Date:
                                    fwrite($f, "            <c r=\"".$this->ColumnText[$e[2]-1].(string)$e[0]."\" s=\"2\">");
                                    fwrite($f, "                <v>".(string)round(25569 + ($e[5] / 86400), 0, PHP_ROUND_HALF_DOWN)."</v>");
                                    break;
                                default:
                                    fwrite($f, "            <c r=\"".$this->ColumnText[$e[2]-1].(string)$e[0]."\">");
                                    fwrite($f, "                <v>".$e[4]."</v>");
                                    break;
                            }
                        }
                        fwrite($f, "            </c>");
                    }
                    fwrite($f, "        </row>");                    
                    fwrite($f, "    </sheetData>");
                    fwrite($f, "    <phoneticPr fontId=\"0\" type=\"noConversion\" />");
                    fwrite($f, "    <pageMargins left=\"0.75\" right=\"0.75\" top=\"1\" bottom=\"1\" header=\"0.5\" footer=\"0.5\" />");
                    fwrite($f, "    <pageSetup orientation=\"portrait\" verticalDpi=\"0\" r:id=\"rId1\" />");
                    fwrite($f, "    <headerFooter alignWithMargins=\"0\" />");
                    fwrite($f, "</worksheet>");
                }
                fclose($f);
            }
            ;}
            // ------> /[Content_Types].xml as $content_types
            ;{
            $this->content_types = " <?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> ";
            $this->content_types .= "<Types xmlns=\"http://schemas.openxmlformats.org/package/2006/content-types\">";
            $this->content_types .= "    <Override PartName=\"/xl/theme/theme1.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.theme+xml\"/>";
            $this->content_types .= "    <Override PartName=\"/xl/styles.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml\"/>";
            $this->content_types .= "    <Default Extension=\"rels\" ContentType=\"application/vnd.openxmlformats-package.relationships+xml\"/>";
            $this->content_types .= "    <Default Extension=\"xml\" ContentType=\"application/xml\"/>";
            $this->content_types .= "    <Override PartName=\"/xl/workbook.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml\"/>";
            $this->content_types .= "    <Override PartName=\"/docProps/app.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.extended-properties+xml\"/>";
            //
            foreach ($this->worksheets as $key=>$value) {
                $this->content_types .= "    <Override PartName=\"/xl/worksheets/sheet".(string)($key+1).".xml\" ContentType=\"application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml\"/>";
            }
            //
            $this->content_types .= "    <Override PartName=\"/xl/sharedStrings.xml\" ContentType=\"application/vnd.openxmlformats-officedocument.spreadsheetml.sharedStrings+xml\"/>";
            $this->content_types .= "    <Override PartName=\"/docProps/core.xml\" ContentType=\"application/vnd.openxmlformats-package.core-properties+xml\"/>";
            $this->content_types .= "</Types>";
            ;}
            // ------> /_rels/.rels as $rels
            ;{
            $this->rels = " <?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> ";
            $this->rels .= "<Relationships xmlns=\"http://schemas.openxmlformats.org/package/2006/relationships\">";
            $this->rels .= "    <Relationship Id=\"rId3\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties\" Target=\"docProps/app.xml\"/>";
            $this->rels .= "    <Relationship Id=\"rId2\" Type=\"http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties\" Target=\"docProps/core.xml\"/>";
            $this->rels .= "    <Relationship Id=\"rId1\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument\" Target=\"xl/workbook.xml\"/>";
            $this->rels .= "</Relationships>";
            ;}
            // ------> /docProps/app.xml as $app
            ;{
            $this->app = " <?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> ";
            $this->app .= "<Properties xmlns=\"http://schemas.openxmlformats.org/officeDocument/2006/extended-properties\" xmlns:vt=\"http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes\">";
            $this->app .= "    <Application>Microsoft Excel</Application>";
            $this->app .= "    <DocSecurity>0</DocSecurity>";
            $this->app .= "    <ScaleCrop>false</ScaleCrop>";
            $this->app .= "    <HeadingPairs>";
            $this->app .= "        <vt:vector size=\"2\" baseType=\"variant\">";
            $this->app .= "            <vt:variant>";
            $this->app .= "                <vt:lpstr>Worksheets</vt:lpstr>";
            $this->app .= "            </vt:variant>";
            $this->app .= "            <vt:variant>";
            $this->app .= "                <vt:i4>".(string)count($this->worksheets)."</vt:i4>";
            $this->app .= "            </vt:variant>";
            $this->app .= "        </vt:vector>";
            $this->app .= "    </HeadingPairs>";
            $this->app .= "    <TitlesOfParts>";
            $this->app .= "        <vt:vector size=\"".(string)count($this->worksheets)."\" baseType=\"lpstr\">";
            foreach ($this->worksheets as $key=>$value) {
                $this->app .= "        <vt:lpstr>".$value->named."</vt:lpstr>";
            }
            $this->app .= "        </vt:vector>";
            $this->app .= "    </TitlesOfParts>";
            $this->app .= "    <Company>{$this->Company}</Company>";
            $this->app .= "    <LinksUpToDate>false</LinksUpToDate>";
            $this->app .= "    <SharedDoc>false</SharedDoc>";
            $this->app .= "    <HyperlinksChanged>false</HyperlinksChanged>";
            $this->app .= "    <AppVersion>12.0000</AppVersion>";
            $this->app .= "</Properties>";
            ;}
            // ------> /docProps/core.xml as $core
            ;{
            $this->core = " <?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> ";
            $this->core .="<cp:coreProperties xmlns:cp=\"http://schemas.openxmlformats.org/package/2006/metadata/core-properties\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:dcterms=\"http://purl.org/dc/terms/\" xmlns:dcmitype=\"http://purl.org/dc/dcmitype/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">";
            $this->core .= "    <dc:creator>{$this->CreatedBy}</dc:creator>";
            $this->core .= "    <dcterms:created xsi:type=\"dcterms:W3CDTF\">2012-12-06T16:50:38Z</dcterms:created>";
            $this->core .= "</cp:coreProperties>";
            ;}
            // ------> /xl/_rels/workbook.xml.rels as $xl_rels
            ;{
            $this->xl_rels = " <?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> ";
            $this->xl_rels .= "<Relationships xmlns=\"http://schemas.openxmlformats.org/package/2006/relationships\">";
            foreach ($this->worksheets as $key=>$value) {
                $this->xl_rels .= "    <Relationship Id=\"rId".(string)($key+1)."\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet\" Target=\"worksheets/sheet".(string)($key+1).".xml\"/>";
            }
            $this->xl_rels .= "    <Relationship Id=\"rId".(string)(count($this->worksheets)+3)."\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/sharedStrings\" Target=\"sharedStrings.xml\"/>";
            $this->xl_rels .= "    <Relationship Id=\"rId".(string)(count($this->worksheets)+2)."\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles\" Target=\"styles.xml\"/>";
            $this->xl_rels .= "    <Relationship Id=\"rId".(string)(count($this->worksheets)+1)."\" Type=\"http://schemas.openxmlformats.org/officeDocument/2006/relationships/theme\" Target=\"theme/theme1.xml\"/>";
            $this->xl_rels .= "</Relationships>";
            ;}
            // ------> /xl/theme/theme1.xml as $theme1        
            ;{
            $this->theme1 = " <?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?> ";
            $this->theme1 .= "<a:theme xmlns:a=\"http://schemas.openxmlformats.org/drawingml/2006/main\" name=\"Office Theme\">";
            $this->theme1 .= "    <a:themeElements>";
            $this->theme1 .= "        <a:clrScheme name=\"Office\">";
            $this->theme1 .= "            <a:dk1><a:sysClr val=\"windowText\" lastClr=\"000000\"/></a:dk1>";
            $this->theme1 .= "            <a:lt1><a:sysClr val=\"window\" lastClr=\"FFFFFF\"/></a:lt1>";
            $this->theme1 .= "            <a:dk2><a:srgbClr val=\"1F497D\"/></a:dk2>";
            $this->theme1 .= "            <a:lt2><a:srgbClr val=\"EEECE1\"/></a:lt2>";
            $this->theme1 .= "            <a:accent1><a:srgbClr val=\"4F81BD\"/></a:accent1>";
            $this->theme1 .= "            <a:accent2><a:srgbClr val=\"C0504D\"/></a:accent2>";
            $this->theme1 .= "            <a:accent3><a:srgbClr val=\"9BBB59\"/></a:accent3>";
            $this->theme1 .= "            <a:accent4><a:srgbClr val=\"8064A2\"/></a:accent4>";
            $this->theme1 .= "            <a:accent5><a:srgbClr val=\"4BACC6\"/></a:accent5>";
            $this->theme1 .= "            <a:accent6><a:srgbClr val=\"F79646\"/></a:accent6>";
            $this->theme1 .= "            <a:hlink><a:srgbClr val=\"0000FF\"/></a:hlink>";
            $this->theme1 .= "            <a:folHlink><a:srgbClr val=\"800080\"/></a:folHlink>";
            $this->theme1 .= "        </a:clrScheme>";
            $this->theme1 .= "        <a:fontScheme name=\"Office\">";
            $this->theme1 .= "            <a:majorFont>";
            $this->theme1 .= "                <a:latin typeface=\"Cambria\"/>";
            $this->theme1 .= "                <a:ea typeface=\"\"/>";
            $this->theme1 .= "                <a:cs typeface=\"\"/>";
            $this->theme1 .= "                <a:font script=\"Jpan\" typeface=\"MS P????\"/>";
            $this->theme1 .= "                <a:font script=\"Hang\" typeface=\"?? ??\"/>";
            $this->theme1 .= "                <a:font script=\"Hans\" typeface=\"??\"/>";
            $this->theme1 .= "                <a:font script=\"Hant\" typeface=\"????\"/>";
            $this->theme1 .= "                <a:font script=\"Arab\" typeface=\"Times New Roman\"/>";
            $this->theme1 .= "                <a:font script=\"Hebr\" typeface=\"Times New Roman\"/>";
            $this->theme1 .= "                <a:font script=\"Thai\" typeface=\"Tahoma\"/>";
            $this->theme1 .= "                <a:font script=\"Ethi\" typeface=\"Nyala\"/>";
            $this->theme1 .= "                <a:font script=\"Beng\" typeface=\"Vrinda\"/>";
            $this->theme1 .= "                <a:font script=\"Gujr\" typeface=\"Shruti\"/>";
            $this->theme1 .= "                <a:font script=\"Khmr\" typeface=\"MoolBoran\"/>";
            $this->theme1 .= "                <a:font script=\"Knda\" typeface=\"Tunga\"/>";
            $this->theme1 .= "                <a:font script=\"Guru\" typeface=\"Raavi\"/>";
            $this->theme1 .= "                <a:font script=\"Cans\" typeface=\"Euphemia\"/>";
            $this->theme1 .= "                <a:font script=\"Cher\" typeface=\"Plantagenet Cherokee\"/>";
            $this->theme1 .= "                <a:font script=\"Yiii\" typeface=\"Microsoft Yi Baiti\"/>";
            $this->theme1 .= "                <a:font script=\"Tibt\" typeface=\"Microsoft Himalaya\"/>";
            $this->theme1 .= "                <a:font script=\"Thaa\" typeface=\"MV Boli\"/>";
            $this->theme1 .= "                <a:font script=\"Deva\" typeface=\"Mangal\"/>";
            $this->theme1 .= "                <a:font script=\"Telu\" typeface=\"Gautami\"/>";
            $this->theme1 .= "                <a:font script=\"Taml\" typeface=\"Latha\"/>";
            $this->theme1 .= "                <a:font script=\"Syrc\" typeface=\"Estrangelo Edessa\"/>";
            $this->theme1 .= "                <a:font script=\"Orya\" typeface=\"Kalinga\"/>";
            $this->theme1 .= "                <a:font script=\"Mlym\" typeface=\"Kartika\"/>";
            $this->theme1 .= "                <a:font script=\"Laoo\" typeface=\"DokChampa\"/>";
            $this->theme1 .= "                <a:font script=\"Sinh\" typeface=\"Iskoola Pota\"/>";
            $this->theme1 .= "                <a:font script=\"Mong\" typeface=\"Mongolian Baiti\"/>";
            $this->theme1 .= "                <a:font script=\"Viet\" typeface=\"Times New Roman\"/>";
            $this->theme1 .= "                <a:font script=\"Uigh\" typeface=\"Microsoft Uighur\"/>";
            $this->theme1 .= "            </a:majorFont>";
            $this->theme1 .= "            <a:minorFont>";
            $this->theme1 .= "                <a:latin typeface=\"Calibri\"/>";
            $this->theme1 .= "                <a:ea typeface=\"\"/>";
            $this->theme1 .= "                <a:cs typeface=\"\"/>";
            $this->theme1 .= "                <a:font script=\"Jpan\" typeface=\"MS P????\"/>";
            $this->theme1 .= "                <a:font script=\"Hang\" typeface=\"?? ??\"/>";
            $this->theme1 .= "                <a:font script=\"Hans\" typeface=\"??\"/>";
            $this->theme1 .= "                <a:font script=\"Hant\" typeface=\"????\"/>";
            $this->theme1 .= "                <a:font script=\"Arab\" typeface=\"Arial\"/>";
            $this->theme1 .= "                <a:font script=\"Hebr\" typeface=\"Arial\"/>";
            $this->theme1 .= "                <a:font script=\"Thai\" typeface=\"Tahoma\"/>";
            $this->theme1 .= "                <a:font script=\"Ethi\" typeface=\"Nyala\"/>";
            $this->theme1 .= "                <a:font script=\"Beng\" typeface=\"Vrinda\"/>";
            $this->theme1 .= "                <a:font script=\"Gujr\" typeface=\"Shruti\"/>";
            $this->theme1 .= "                <a:font script=\"Khmr\" typeface=\"DaunPenh\"/>";
            $this->theme1 .= "                <a:font script=\"Knda\" typeface=\"Tunga\"/>";
            $this->theme1 .= "                <a:font script=\"Guru\" typeface=\"Raavi\"/>";
            $this->theme1 .= "                <a:font script=\"Cans\" typeface=\"Euphemia\"/>";
            $this->theme1 .= "                <a:font script=\"Cher\" typeface=\"Plantagenet Cherokee\"/>";
            $this->theme1 .= "                <a:font script=\"Yiii\" typeface=\"Microsoft Yi Baiti\"/>";
            $this->theme1 .= "                <a:font script=\"Tibt\" typeface=\"Microsoft Himalaya\"/>";
            $this->theme1 .= "                <a:font script=\"Thaa\" typeface=\"MV Boli\"/>";
            $this->theme1 .= "                <a:font script=\"Deva\" typeface=\"Mangal\"/>";
            $this->theme1 .= "                <a:font script=\"Telu\" typeface=\"Gautami\"/>";
            $this->theme1 .= "                <a:font script=\"Taml\" typeface=\"Latha\"/>";
            $this->theme1 .= "                <a:font script=\"Syrc\" typeface=\"Estrangelo Edessa\"/>";
            $this->theme1 .= "                <a:font script=\"Orya\" typeface=\"Kalinga\"/>";
            $this->theme1 .= "                <a:font script=\"Mlym\" typeface=\"Kartika\"/>";
            $this->theme1 .= "                <a:font script=\"Laoo\" typeface=\"DokChampa\"/>";
            $this->theme1 .= "                <a:font script=\"Sinh\" typeface=\"Iskoola Pota\"/>";
            $this->theme1 .= "                <a:font script=\"Mong\" typeface=\"Mongolian Baiti\"/>";
            $this->theme1 .= "                <a:font script=\"Viet\" typeface=\"Arial\"/>";
            $this->theme1 .= "                <a:font script=\"Uigh\" typeface=\"Microsoft Uighur\"/>";
            $this->theme1 .= "            </a:minorFont>";
            $this->theme1 .= "        </a:fontScheme>";
            $this->theme1 .= "        <a:fmtScheme name=\"Office\">";
            $this->theme1 .= "            <a:fillStyleLst>";
            $this->theme1 .= "                <a:solidFill>";
            $this->theme1 .= "                    <a:schemeClr val=\"phClr\"/>";
            $this->theme1 .= "                </a:solidFill>";
            $this->theme1 .= "                <a:gradFill rotWithShape=\"1\">";
            $this->theme1 .= "                    <a:gsLst>";
            $this->theme1 .= "                        <a:gs pos=\"0\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:tint val=\"50000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"300000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"35000\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:tint val=\"37000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"300000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"100000\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:tint val=\"15000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"350000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                    </a:gsLst>";
            $this->theme1 .= "                    <a:lin ang=\"16200000\" scaled=\"1\"/>";
            $this->theme1 .= "                </a:gradFill>";
            $this->theme1 .= "                <a:gradFill rotWithShape=\"1\">";
            $this->theme1 .= "                    <a:gsLst>";
            $this->theme1 .= "                        <a:gs pos=\"0\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:shade val=\"51000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"130000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"80000\">";
            $this->theme1 .= "                        <a:schemeClr val=\"phClr\"><a:shade val=\"93000\"/><a:satMod val=\"130000\"/></a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"100000\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:shade val=\"94000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"135000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                    </a:gsLst>";
            $this->theme1 .= "                    <a:lin ang=\"16200000\" scaled=\"0\"/>";
            $this->theme1 .= "                </a:gradFill>";
            $this->theme1 .= "                </a:fillStyleLst>";
            $this->theme1 .= "            <a:lnStyleLst>";
            $this->theme1 .= "                <a:ln w=\"9525\" cap=\"flat\" cmpd=\"sng\" algn=\"ctr\">";
            $this->theme1 .= "                    <a:solidFill>";
            $this->theme1 .= "                        <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                            <a:shade val=\"95000\"/>";
            $this->theme1 .= "                            <a:satMod val=\"105000\"/>";
            $this->theme1 .= "                        </a:schemeClr>";
            $this->theme1 .= "                    </a:solidFill>";
            $this->theme1 .= "                    <a:prstDash val=\"solid\"/>";
            $this->theme1 .= "                </a:ln>";
            $this->theme1 .= "                <a:ln w=\"25400\" cap=\"flat\" cmpd=\"sng\" algn=\"ctr\">";
            $this->theme1 .= "                    <a:solidFill>";
            $this->theme1 .= "                        <a:schemeClr val=\"phClr\"/>";
            $this->theme1 .= "                    </a:solidFill>";
            $this->theme1 .= "                    <a:prstDash val=\"solid\"/>";
            $this->theme1 .= "                </a:ln>";
            $this->theme1 .= "                <a:ln w=\"38100\" cap=\"flat\" cmpd=\"sng\" algn=\"ctr\">";
            $this->theme1 .= "                    <a:solidFill>";
            $this->theme1 .= "                        <a:schemeClr val=\"phClr\"/>";
            $this->theme1 .= "                    </a:solidFill>";
            $this->theme1 .= "                    <a:prstDash val=\"solid\"/>";
            $this->theme1 .= "                </a:ln>";
            $this->theme1 .= "            </a:lnStyleLst>";
            $this->theme1 .= "            <a:effectStyleLst>";
            $this->theme1 .= "                <a:effectStyle>";
            $this->theme1 .= "                    <a:effectLst>";
            $this->theme1 .= "                        <a:outerShdw blurRad=\"40000\" dist=\"20000\" dir=\"5400000\" rotWithShape=\"0\">";
            $this->theme1 .= "                            <a:srgbClr val=\"000000\">";
            $this->theme1 .= "                                <a:alpha val=\"38000\"/>";
            $this->theme1 .= "                            </a:srgbClr>";
            $this->theme1 .= "                        </a:outerShdw>";
            $this->theme1 .= "                    </a:effectLst>";
            $this->theme1 .= "                </a:effectStyle>";
            $this->theme1 .= "                <a:effectStyle>";
            $this->theme1 .= "                    <a:effectLst>";
            $this->theme1 .= "                        <a:outerShdw blurRad=\"40000\" dist=\"23000\" dir=\"5400000\" rotWithShape=\"0\">";
            $this->theme1 .= "                            <a:srgbClr val=\"000000\">";
            $this->theme1 .= "                                <a:alpha val=\"35000\"/>";
            $this->theme1 .= "                            </a:srgbClr>";
            $this->theme1 .= "                        </a:outerShdw>";
            $this->theme1 .= "                    </a:effectLst>";
            $this->theme1 .= "                </a:effectStyle>";
            $this->theme1 .= "                <a:effectStyle>";
            $this->theme1 .= "                    <a:effectLst>";
            $this->theme1 .= "                        <a:outerShdw blurRad=\"40000\" dist=\"23000\" dir=\"5400000\" rotWithShape=\"0\">";
            $this->theme1 .= "                            <a:srgbClr val=\"000000\">";
            $this->theme1 .= "                                <a:alpha val=\"35000\"/>";
            $this->theme1 .= "                            </a:srgbClr>";
            $this->theme1 .= "                        </a:outerShdw>";
            $this->theme1 .= "                    </a:effectLst>";
            $this->theme1 .= "                    <a:scene3d>";
            $this->theme1 .= "                        <a:camera prst=\"orthographicFront\">";
            $this->theme1 .= "                            <a:rot lat=\"0\" lon=\"0\" rev=\"0\"/>";
            $this->theme1 .= "                        </a:camera>";
            $this->theme1 .= "                        <a:lightRig rig=\"threePt\" dir=\"t\">";
            $this->theme1 .= "                            <a:rot lat=\"0\" lon=\"0\" rev=\"1200000\"/>";
            $this->theme1 .= "                        </a:lightRig>";
            $this->theme1 .= "                    </a:scene3d>";
            $this->theme1 .= "                    <a:sp3d>";
            $this->theme1 .= "                        <a:bevelT w=\"63500\" h=\"25400\"/>";
            $this->theme1 .= "                    </a:sp3d>";
            $this->theme1 .= "                </a:effectStyle>";
            $this->theme1 .= "            </a:effectStyleLst>";
            $this->theme1 .= "            <a:bgFillStyleLst>";
            $this->theme1 .= "                <a:solidFill>";
            $this->theme1 .= "                <a:schemeClr val=\"phClr\"/>";
            $this->theme1 .= "                </a:solidFill>";
            $this->theme1 .= "                <a:gradFill rotWithShape=\"1\">";
            $this->theme1 .= "                    <a:gsLst>";
            $this->theme1 .= "                        <a:gs pos=\"0\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                            <a:tint val=\"40000\"/>";
            $this->theme1 .= "                            <a:satMod val=\"350000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"40000\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                            <a:tint val=\"45000\"/>";
            $this->theme1 .= "                            <a:shade val=\"99000\"/>";
            $this->theme1 .= "                            <a:satMod val=\"350000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"100000\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:shade val=\"20000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"255000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                    </a:gsLst>";
            $this->theme1 .= "                    <a:path path=\"circle\">";
            $this->theme1 .= "                        <a:fillToRect l=\"50000\" t=\"-80000\" r=\"50000\" b=\"180000\"/>";
            $this->theme1 .= "                    </a:path>";
            $this->theme1 .= "                </a:gradFill>";
            $this->theme1 .= "                <a:gradFill rotWithShape=\"1\">";
            $this->theme1 .= "                    <a:gsLst>";
            $this->theme1 .= "                        <a:gs pos=\"0\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:tint val=\"80000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"300000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                        <a:gs pos=\"100000\">";
            $this->theme1 .= "                            <a:schemeClr val=\"phClr\">";
            $this->theme1 .= "                                <a:shade val=\"30000\"/>";
            $this->theme1 .= "                                <a:satMod val=\"200000\"/>";
            $this->theme1 .= "                            </a:schemeClr>";
            $this->theme1 .= "                        </a:gs>";
            $this->theme1 .= "                    </a:gsLst>";
            $this->theme1 .= "                    <a:path path=\"circle\">";
            $this->theme1 .= "                        <a:fillToRect l=\"50000\" t=\"50000\" r=\"50000\" b=\"50000\"/>";
            $this->theme1 .= "                    </a:path>";
            $this->theme1 .= "                </a:gradFill>";
            $this->theme1 .= "            </a:bgFillStyleLst>";
            $this->theme1 .= "        </a:fmtScheme>";
            $this->theme1 .= "    </a:themeElements>";
            $this->theme1 .= "    <a:objectDefaults/>";
            $this->theme1 .= "    <a:extraClrSchemeLst/>";
            $this->theme1 .= "</a:theme>";
            ;}
            //
        }
        //
        private function IsDate($Value) {
            // I lost where I stole this from and I can't seem to find the post.  Stackoverflow, I think.
            $formats = array("m/d/Y", "Ymd", "Y-m-d");
            foreach ($formats as $format) {
                $date = DateTime::createFromFormat($format, $Value);
                if ($date == false) 
                    return false;
                else
                    return $date->sub(new DateInterval('P1D'))->getTimestamp();
            }
        }
        //
        private function AddStringToArray($Value) {
            $Result = array_key_exists($Value, $this->Strings);
            if ($Result != false) {
                return $Result;
            } else {
                return array_push($this->Strings, $Value) - 1;
                // Returns the new array count so, subtract one for the index of the string.
            }
        }
        //
        public function SetHeader($Header) {
            //
            checkDatabase(false, true);
            //
            $column_index = 1;
            foreach ($Header as $value) {
                //
                if ($value != '') {$this->worksheets[$this->ActiveSheet]->has_header = true;}
                //
                $Type = SimpleExcelCellsTypes::Text;
                $OriginalValue = $value;
                $TextIndex = $this->AddStringToArray($value);
                //
                $Result = $this->db->exec("INSERT INTO storage (sheet, row, column, data_type, original_value, date_value, text_index) VALUES ({$this->ActiveSheet}, 1, $column_index, $Type, '".$this->db->escapeString($OriginalValue)."', 0, $TextIndex);");
                if ($Result) {
                } else {
                }
                //
                $column_index++;
                //
            }
            //
            if (($column_index-1) > $this->MaxColumn) {$this->MaxColumn = ($column_index-1);}
            //
        }
        //
        public function SetDataByArray($Data, $MaxRow) {
            //
            checkDatabase(true);
            //
            $Type = SimpleExcelCellsTypes::None;
            $OriginalValue = "";
            $DateValue = 0;
            $TextIndex = 0;
            //
            $this->db->exec("BEGIN TRANSACTION;");
            $row_index = 2;
            for ($i = 0; $i < $MaxRow; ++$i) {
                $row = $Data[$i];
                $column_index = 1;
                foreach ($row as $column) {
                    $OriginalValue = $column;
                    if ($column == '') {
                        $Type = SimpleExcelCellsTypes::None;
                    } else {
                        $this->worksheets[$this->ActiveSheet]->has_data = true;
                        if (is_numeric($column)) {
                            $Type = SimpleExcelCellsTypes::Numeric;
                        } else {
                            $Result = $this->IsDate($column);
                            if ($Result) {
                                // Date
                                $Type = SimpleExcelCellsTypes::Date;
                                $DateValue = $Result;
                            } else {
                                // Assumed string
                                $Type = SimpleExcelCellsTypes::Text;
                                $TextIndex = $this->AddStringToArray($column);
                            }
                        }
                    }                    
                    $this->db->exec("INSERT INTO storage (sheet, row, column, data_type, original_value, date_value, text_index) VALUES ({$this->ActiveSheet}, $row_index, $column_index, $Type, '".$this->db->escapeString($OriginalValue)."', $DateValue, $TextIndex);");
                    $column_index++;
                }
                $row_index++;
                if (count($row) > $this->MaxColumn) {$this->MaxColumn = count($row);}
            }
            $this->db->exec("COMMIT TRANSACTION;");
            //
            $this->worksheets[$this->ActiveSheet]->max_row = $row_index - 1;
            // Store maximum row count.
        }
        //
        public function setActiveSheet($Index) {
            //
            if ($Index < 0 || $Index > (count($this->worksheets) - 1)) {return false;}
            //
            $this->ActiveSheet = $Index;
            //
            return true;
            //
        }
        //
        public function addSheet($Named) {            
            $Sheet = new SimpleExcelSheets();
            $Sheet->named = $Named;
            $Sheet->has_header = false;
            $Sheet->has_data = false;
            $this->worksheets[] = $Sheet;
            $this->ActiveSheet = count($this->worksheets)-1;
        }
        //
        public function write($FullPath) {
            //
            $this->BuildFiles();
            //
            $zip = new ZipArchive;
            $res = $zip->open($FullPath, ZipArchive::CREATE);
            if ($res == TRUE) {
                //
                $zip->addFromString('[Content_Types].xml', $this->content_types);
                //
                $zip->addFromString('_rels/.rels', $this->rels);
                //
                $zip->addFromString('docProps/app.xml', $this->app);
                $zip->addFromString('docProps/core.xml', $this->core);
                //
                $zip->addFromString('xl/_rels/workbook.xml.rels', $this->xl_rels);
                //
                $zip->addFromString('xl/theme/theme1.xml', $this->theme1);
                //
                $zip->addFromString('xl/workbook.xml', $this->workbook);
                $zip->addFromString('xl/styles.xml', $this->styles);
                $zip->addFromString('xl/sharedStrings.xml', $this->sharedStrings);
                //
                $zip->addEmptyDir('xl/printerSettings');
                //                
                foreach ($this->worksheets as $key=>$value) {
                    $zip->addFile($value->fullfile, "xl/worksheets/sheet".(string)($key+1).".xml");
                }
                //
                $zip->close();
                //
                foreach ($this->worksheets as $key=>$value) {
                    unlink($value->fullfile);
                }
                //
            }
            //
        }
        //
        function __destruct() {
            // Deconstruct - clean up.
            if (!is_null($this->db)) {
                $this->db->close();
            }
        }
    }
    // ************************************************************
    // Begin Example
    // ************************************************************
    $excel = new SimpleExcel();
    // Create the class.
    $excel->Company = "Seijin Solutions LLC";
    $excel->CreatedBy = "Sam Shults";
    // Set a couple properties.
    $excel->SetHeader(array('Header A','Header B','Header C','Header D'));    
    // Create the header in the spreadsheet.
    $mysqli = new mysqli("localhost", "some_user", "hahaha_right", "some_db");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $Data = array();
    // Create the array to store the data.
    $mysqli->real_query("SELECT header_a, header_b, header_c, header_d FROM fake_table;");
    if ($res = $mysqli->use_result()) {
        while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            $Data[] = $row;
            // Store the row in the array.
        }
        $res->free();
    }
    $mysqli->close();
    //
    $excel->SetDataByArray($Data, count($Data) - 1);
    // Store the array of data in the spreadsheet, passing the row count.
    $excel->write('./test.xlsx');
    // Write the Excel file.
?> 