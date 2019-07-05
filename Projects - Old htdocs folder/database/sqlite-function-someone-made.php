<?php 
/* sqlitedb class */ 
class sqlitedb extends PDO { 

// left out function __construct(){} etc. 

        /** 
         *  Print ($caption,$sql,FALSE) or 
         *  return ($caption,$sql,TRUE) an HTML table 
         *  representing the full resultset from the 
    *  query in $sql (non-paging) in row/column 
    *  representation. 
         *  Requires classes in css for every datatype 
    *  that might be returned, like: 

.datetime { text-align: right; } 
.integer  { text-align: right; } 
.text     { text-align: left; } 
.varchar  { text-align: left; } 
.string   { text-align: left; } 
    * 
         */ 

        function HTMLtable($caption,$sql,$ReturnString = 
FALSE){ 
                $res = $this->query($sql);   
                if ($res){ 
                        if ($row = $res->fetch()){ 
                                $nrofcols = $res->columnCount(); 
                                if ($nrofcols > 0){ 
                                        $ret = sprintf('<table 
summary="tableview"><caption>%s</caption> 
',$caption); 
//	column horizontal alignment according to type 
                                        for ($i = 0;$i < $nrofcols;$i++){ 
                                                $metadata = $res->getColumnMeta($i); 
                                                reset($metadata); 
                                                $class = preg_replace( 
 array('/[)(0-9]*/') 
,array("") 
,strtolower( 
 (array_key_exists ( 'sqlite:decl_type', $metadata ) 
)?$metadata['sqlite:decl_type']:$metadata['native_type'] 
)); 
                                                $ret .= sprintf('  <colgroup 
span="1" class="%s"></colgroup>%s',$class,"\n"); 
                                        } 
                                        $ret .= '  <tr>'; 
//	column headings 
                                        for ($i = 0;$i < $nrofcols;$i++){ 
                                                $metadata = $res->getColumnMeta($i); 
                                                $ret .= sprintf( 
'<th>%s</th>',$metadata['name']); 
                                        } 
                                        $ret .= "</tr>\n"; 
// table rows 
                                        while ($row){ 
                                                $ret .= '  <tr>'; 
                                                for ($i = 0;$i < $nrofcols;$i++){ 
// column data 
                                                        $ret .= 
sprintf('<td>%s</td>',$row[$i]); 
                                                } 
                                                $ret .= "</tr>\n"; 
                                                $row = $res->fetch(); 
                                        } 
                                        $ret .= '</table>'; 
                                } else { 
                                        $ret = 'no columns'; 
                                } 
                        } else { 
                                $ret = 'no data'; 
                        } 
                } else { 
                        $ret = 'no table'; 
                } 
                if ($ReturnString){ 
                        return $ret; 
                } else { 
                        print $ret; 
                        unset($ret); 
                } 
        } // HTMLtable() 

} // end class sqlitedb 

?> 