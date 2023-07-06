<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Cetakpdf extends CI_Controller

{

	public function __construct() {

      parent::__construct();

      $this->load->library('session');

  	}



	public function index()

	{

	}



	public function cetak_testpdf()

    { //echo "string"; die();

       //load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

  		// 	$parameterx = $this->encryption->decrypt($parametercetak);

		// $parameter = explode(',', $parameterx);

		// $nomatrik = $parameter[0];

		// $data['nomatrik']=$nomatrik;

  		// $data_online_px01=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// $this->template->set('data_online_px01',$data_online_px01); 

		// $data['data_online_px01']=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// if(!empty($data_online_px01)){

		// 	$px01program = trim($data_online_px01[0]->px01program);

		// 	$px01kodfak = trim($data_online_px01[0]->px01kodfak);

		// 	$px01thppgn = trim($data_online_px01[0]->px01tahap);

		//  	$data['px01program']=$px01program;

		//  	$data['px01kodfak']=$px01kodfak;

		//  	$data['px01thppgn']=$px01thppgn;

		// 	$data_pn23=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$this->template->set('data_pn23',$data_pn23); 

		// 	$data['data_pn23']=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$data_px08=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		// 	$this->template->set('data_px08',$data_px08); 

		// 	$data['data_px08']=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		//  }

       
        ini_set('memory_limit', '256M'); 

        $html = $this->load->view('student_f/test_generatepdf', $data, true);

        //$html = $this->load->view('student_f/test_generatepdf');

        $pdf->AddPage(

        	'P', // L - landscape, P - portrait 

        	'', 

        	'', 

        	'', 

        	'',

        	15, // margin_left

        	15, // margin right

       		5, // margin top

       		5, // margin bottom

        	5, // margin header

        	5); // margin footer



         //set header di html

		// $pdf->SetWatermarkImage('assets/img/cop_mohor.png',

		// 		  0.9, //transparency

		// 		 array(50,30), //size  (no kecik nipis no beso lebar) W x H

		// 		 array(225,160)); //position (no kecik left no beso right) / (no kecik atas no beso bawah) 

		

		$pdf->SetWatermarkImage('assets/templatesijil/FEP_CERT/CERT-COA-Based1.png','D');

		$pdf->watermarkImgBehind = true;

		$pdf->showWatermarkImage = true;



		//$pdf->SetHTMLFooter('<p style="text-align: center"><font color="grey"><i>Slip ini dijana oleh sistem, tandatangan tidak diperlukan.</i></font></p>', 'O', true);

		// $pdf->SetWatermarkText('DRAFT');

		// $pdf->showWatermarkText = true;



       // render the view into HTML

        $pdf->WriteHTML($html); // write the HTML into the PDF 

        $output = 'sijil' . date('Y_m_d_H_i_s') . '_.pdf';

        $pdf->Output("$output", 'I'); // save to file because we can

        exit();

    }

    public function cetak_achievementcert()

    { //echo "string"; die();

       //load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

  		// 	$parameterx = $this->encryption->decrypt($parametercetak);

		// $parameter = explode(',', $parameterx);

		// $nomatrik = $parameter[0];

		// $data['nomatrik']=$nomatrik;

  		// $data_online_px01=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// $this->template->set('data_online_px01',$data_online_px01); 

		// $data['data_online_px01']=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// if(!empty($data_online_px01)){

		// 	$px01program = trim($data_online_px01[0]->px01program);

		// 	$px01kodfak = trim($data_online_px01[0]->px01kodfak);

		// 	$px01thppgn = trim($data_online_px01[0]->px01tahap);

		//  	$data['px01program']=$px01program;

		//  	$data['px01kodfak']=$px01kodfak;

		//  	$data['px01thppgn']=$px01thppgn;

		// 	$data_pn23=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$this->template->set('data_pn23',$data_pn23); 

		// 	$data['data_pn23']=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$data_px08=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		// 	$this->template->set('data_px08',$data_px08); 

		// 	$data['data_px08']=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		//  }

        // $pdf->SetWatermarkImage('assets/templatesijil/FEP_CERT/CERT-COA-Based1.png');

        // $pdf->watermarkImgBehind = true;

        // $pdf->showWatermarkImage = true;

       
        ini_set('memory_limit', '256M'); 



        $html = $this->load->view('student_f/achievementcert_pdf', $data, true);

        //$html = $this->load->view('student_f/test_generatepdf');

        $pdf->AddPage(

        	'P', // L - landscape, P - portrait 

        	'', 

        	'', 

        	'', 

        	'',

        	15, // margin_left

        	15, // margin right

       		5, // margin top

       		5, // margin bottom

        	5, // margin header

        	5); // margin footer





         //set header di html

		// $pdf->SetWatermarkImage('assets/img/cop_mohor.png',

		// 		  0.9, //transparency

		// 		 array(50,30), //size  (no kecik nipis no beso lebar) W x H

		// 		 array(225,160)); //position (no kecik left no beso right) / (no kecik atas no beso bawah) 

		
     //  $pdf->SetWatermarkImage('./assets/templatesijil/FEP_CERT/CERT-COA-Based1.jpg',0.8);
     // $pdf->showWatermarkImage = true;





		//$pdf->SetHTMLFooter('<p style="text-align: center"><font color="grey"><i>Slip ini dijana oleh sistem, tandatangan tidak diperlukan.</i></font></p>', 'O', true);

		// $pdf->SetWatermarkText('DRAFT');

		// $pdf->showWatermarkText = true;



       // render the view into HTML

        $pdf->WriteHTML($html); // write the HTML into the PDF 

        $output = 'sijil' . date('Y_m_d_H_i_s') . '_.pdf';

        $pdf->Output("$output", 'I'); // save to file because we can

        exit();

    }


    public function cetak_completioncert()

    { //echo "string"; die();

       //load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

  		// 	$parameterx = $this->encryption->decrypt($parametercetak);

		// $parameter = explode(',', $parameterx);

		// $nomatrik = $parameter[0];

		// $data['nomatrik']=$nomatrik;

  		// $data_online_px01=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// $this->template->set('data_online_px01',$data_online_px01); 

		// $data['data_online_px01']=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// if(!empty($data_online_px01)){

		// 	$px01program = trim($data_online_px01[0]->px01program);

		// 	$px01kodfak = trim($data_online_px01[0]->px01kodfak);

		// 	$px01thppgn = trim($data_online_px01[0]->px01tahap);

		//  	$data['px01program']=$px01program;

		//  	$data['px01kodfak']=$px01kodfak;

		//  	$data['px01thppgn']=$px01thppgn;

		// 	$data_pn23=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$this->template->set('data_pn23',$data_pn23); 

		// 	$data['data_pn23']=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$data_px08=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		// 	$this->template->set('data_px08',$data_px08); 

		// 	$data['data_px08']=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		//  }

       
        ini_set('memory_limit', '256M'); 

        $html = $this->load->view('student_f/completioncert_pdf', $data, true);

        //$html = $this->load->view('student_f/test_generatepdf');

        $pdf->AddPage(

        	'P', // L - landscape, P - portrait 

        	'', 

        	'', 

        	'', 

        	'',

        	15, // margin_left

        	15, // margin right

       		5, // margin top

       		5, // margin bottom

        	5, // margin header

        	5); // margin footer



         //set header di html

		// $pdf->SetWatermarkImage('assets/img/cop_mohor.png',

		// 		  0.9, //transparency

		// 		 array(50,30), //size  (no kecik nipis no beso lebar) W x H

		// 		 array(225,160)); //position (no kecik left no beso right) / (no kecik atas no beso bawah) 

		

		$pdf->SetWatermarkImage('assets/templatesijil/FEP_CERT/CERT-COC-Based1.png','D');

		$pdf->watermarkImgBehind = true;

		$pdf->showWatermarkImage = true;



		//$pdf->SetHTMLFooter('<p style="text-align: center"><font color="grey"><i>Slip ini dijana oleh sistem, tandatangan tidak diperlukan.</i></font></p>', 'O', true);

		// $pdf->SetWatermarkText('DRAFT');

		// $pdf->showWatermarkText = true;



       // render the view into HTML

        $pdf->WriteHTML($html); // write the HTML into the PDF 

        $output = 'sijil' . date('Y_m_d_H_i_s') . '_.pdf';

        $pdf->Output("$output", 'I'); // save to file because we can

        exit();

    }

    public function cetak_mmscert()

    { //echo "string"; die();

       //load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

  		// 	$parameterx = $this->encryption->decrypt($parametercetak);

		// $parameter = explode(',', $parameterx);

		// $nomatrik = $parameter[0];

		// $data['nomatrik']=$nomatrik;

  		// $data_online_px01=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// $this->template->set('data_online_px01',$data_online_px01); 

		// $data['data_online_px01']=$this->pengesahan_m->get_online_px01fbiojnr($nomatrik);

		// if(!empty($data_online_px01)){

		// 	$px01program = trim($data_online_px01[0]->px01program);

		// 	$px01kodfak = trim($data_online_px01[0]->px01kodfak);

		// 	$px01thppgn = trim($data_online_px01[0]->px01tahap);

		//  	$data['px01program']=$px01program;

		//  	$data['px01kodfak']=$px01kodfak;

		//  	$data['px01thppgn']=$px01thppgn;

		// 	$data_pn23=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$this->template->set('data_pn23',$data_pn23); 

		// 	$data['data_pn23']=$this->pengesahan_m->get_sah_pn23($nomatrik);

		// 	$data_px08=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		// 	$this->template->set('data_px08',$data_px08); 

		// 	$data['data_px08']=$this->pengesahan_m->get_online_px08fbiodata($nomatrik);

		//  }

       
        ini_set('memory_limit', '256M'); 

        $pdf->AddPage(

        	'P', // L - landscape, P - portrait 

        	'', 

        	'', 

        	'', 

        	'',

        	15, // margin_left

        	15, // margin right

       		5, // margin top

       		5, // margin bottom

        	5, // margin header

        	5); // margin footer

        $pdf->SetWatermarkImage('assets/templatesijil/FEP_CERT/CERT-MMS-Based1.png','D');

		$pdf->watermarkImgBehind = true;

		$pdf->showWatermarkImage = true;


        $html_mms1 = $this->load->view('student_f/mmscert1_pdf', $data, true);

        $html_mms2 = $this->load->view('student_f/mmscert2_pdf', $data, true);

        // render the view into HTML
        $pdf->WriteHTML($html_mms1); // write the HTML into the PDF

        $pdf->AddPage(

        	'P', // L - landscape, P - portrait 

        	'', 

        	'', 

        	'', 

        	'',

        	15, // margin_left

        	15, // margin right

       		5, // margin top

       		5, // margin bottom

        	5, // margin header

        	5); // margin footer



         //set header di html

		// $pdf->SetWatermarkImage('assets/img/cop_mohor.png',

		// 		  0.9, //transparency

		// 		 array(50,30), //size  (no kecik nipis no beso lebar) W x H

		// 		 array(225,160)); //position (no kecik left no beso right) / (no kecik atas no beso bawah) 

		

		$pdf->SetWatermarkImage('assets/templatesijil/FEP_CERT/CERT-MMS-Based1.png','D');

		$pdf->watermarkImgBehind = true;

		$pdf->showWatermarkImage = true;



		//$pdf->SetHTMLFooter('<p style="text-align: center"><font color="grey"><i>Slip ini dijana oleh sistem, tandatangan tidak diperlukan.</i></font></p>', 'O', true);

		// $pdf->SetWatermarkText('DRAFT');

		// $pdf->showWatermarkText = true;



       // render the view into HTML

        $pdf->WriteHTML($html_mms2); // write the HTML into the PDF 

        $output = 'sijil' . date('Y_m_d_H_i_s') . '_.pdf';

        $pdf->Output("$output", 'I'); // save to file because we can

        exit();

    }


    

}

?>