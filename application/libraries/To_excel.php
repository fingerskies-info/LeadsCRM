<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Create Excel file - Library
|--------------------------------------------------------------------------
| Created:  24/04/2013
|
|       Excel library for Code Igniter applications
|       Author: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
|       https://github.com/EllisLab/CodeIgniter/wiki/Excel-Plugin
|
|       Updated by: ccontreras: 19 May 2011 11:59 AM
|       
|       Updated for Codeigniter 2.1.3  and converted to library file
|       by Timothy Head: 11/06/2013
|
*/
class To_excel {
    
    function create_excel($query, $filename='exceloutput')
    {
        $ci =& get_instance();
        $ci->load->helper('download');
    
        $headers = ''; // just creating the var for field headers to append to below
        $data = ''; // just creating the var for field data to append to below
         
        $fields = $query->list_fields();
        if ($query->num_rows() == 0) {
            echo '<p>The table appears to have no data.</p>';
        } else {
            foreach ($fields as $field) {
               $headers .= $field . "\t";
            }
       
            foreach ($query->result() as $row) {
                $line = '';
                foreach($row as $value) {                                            
                    if (( ! isset($value)) OR ($value == "")) {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line)."\n";
            }
            
            $data = str_replace("\r","",$data);

            force_download($filename . ".xls", $headers . "\n" . $data);
        } 
    }
}