<?php
use Dompdf\Dompdf; 

class Files {

	/*
	 * Dompdf library
	 * Param
	 * @param content = binary
	 * @param filename = nama fail
	 * @param stream = true (stream), false (download)
	 */

	public static function dompdf($content = '', $filename= 'file', $stream = true)
	{
		$dompdf = new DOMPDF();
		$dompdf->load_html($content);

		$dompdf->render();
		if ($stream)
		{
			$dompdf->stream($filename.".pdf", array("Attachment" => 0));
		}
		else
		{
			return $dompdf->output();
		}
	}

	/*
	 * Direct jana PDF dari PHP/Codeigniter
	 */

	//public static function stream($namafail = '', $jenisfail = '', $datafail = '')
	public static function stream($namafail = '', $datafail = '')
	{
		/*
		 * Dapatkan auto content type dari file extension. Guna library di application/config/mimes.php
		 */

		$obj =& get_instance();
		$obj->mimes =& get_mimes();
		$ext = pathinfo($namafail, PATHINFO_EXTENSION);
		$content_type =  (is_array($obj->mimes[$ext])) ? $obj->mimes[$ext][0] : $obj->mimes[$ext]; //dbug($datafail); die();
		//$content_type = 'application/pdf';
		//$namafail = 'file.pdf';
		
		if (strlen($datafail)===0) 
		{
			die('file not found');
		}
		else
		{
			header("Content-Type: ".$content_type);
			header("Content-Description: File Transfer");
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");
			header("Content-Transfer-Encoding: binary");
			header('Content-disposition: inline; filename='.$namafail);
			header("Content-length: ".strlen($datafail));
			echo $datafail; 
			exit();
		}
	}

	public static function assets_path($data= array())
	{
		$assets['css'] = array();
		$assets['js'] = array();
		//dbug($data);

		if (in_array("datatables", $data) or in_array("dt", $data))
		{
		    array_push($assets['css'], getenv('assets').'css/jquery.dataTables.css');
		    array_push($assets['css'], getenv('assets').'css/responsive.dataTables.min.css');
		    array_push($assets['js'], getenv('assets').'js/jquery.dataTables.js');
		    array_push($assets['js'], getenv('assets').'js/dataTables.responsive.min.js');
		}

		if (in_array("datatables-colreorder", $data) or in_array("dt-colreorder", $data))
		{
		    array_push($assets['css'], getenv('assets').'css/colReorder.dataTables.min.css');
		    array_push($assets['js'], getenv('assets').'js/dataTables.colReorder.min.js');
		}

		if (in_array("datatables-fixedheader", $data) or in_array("dt-fixedheader", $data))
		{
		    array_push($assets['css'], getenv('assets').'css/fixedHeader.dataTables.min.css');
		    array_push($assets['js'], getenv('assets').'js/dataTables.fixedHeader.min.js');
		}

		if (in_array("datatables-buttons", $data) or in_array("dt-buttons", $data))
		{
			array_push($assets['css'], getenv('assets').'css/buttons.dataTables.min.css');
			array_push($assets['js'], getenv('assets').'js/dataTables.buttons.min.js');
		}

		if (in_array("toastr", $data))
		{
		    array_push($assets['css'], getenv('assets').'css/toastr.min.css');
		    array_push($assets['js'], getenv('assets').'js/toastr.min.js');
		}

		return $assets;
	}

	public static function to_json($result = '')
	{
		header("HTTP/1.1 200 OK");
		header('Content-Type: application/json');
		echo json_encode($result);
		exit();
	}
	
	public static function _curl($url='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	public static function hextobin($hexstr)
    {
        $n = strlen($hexstr);
        $sbin="";
        $i=0;
        while($i<$n)
        {
            $a =substr($hexstr,$i,2);
            $c = pack("H*",$a);
            if ($i==0){$sbin=$c;}
            else {$sbin.=$c;}
            $i+=2;
        }
        return $sbin;
    }

	public static function strToHex($string)
	{
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }

    return strToUpper($hex);
	}
	public static function hexToStr($hex){
	    $string='';
	    for ($i=0; $i < strlen($hex)-1; $i+=2){
	        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
	    }
	    return $string;
	}

	/*
	 * Library TCPDF
	 * Param
	 * @param content = binary (blob)
	 * @param filename = nama fail
	 * @param stream = true (stream), false (dwonload)
	 */

	public static function tcpdf($content='', $filename= 'file',  $stream = true)
	{
		$stream = ($stream) ? 'I' : 'D';

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('');
		$pdf->SetTitle('');
		$pdf->SetSubject('');
		$pdf->SetKeywords(', , ,');

		// remove line header and footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// set font
		$pdf->SetFont('dejavusans', '', 10);

		// add a page
		$pdf->AddPage();

		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

		// output the HTML content
		$pdf->writeHTML($content, true, false, true, false, '');
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output($filename, 'I');

	}

}
