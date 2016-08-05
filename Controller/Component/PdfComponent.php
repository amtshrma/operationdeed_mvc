<?php
/**
 * Custom component
 * PHP 5
 * Date Of Creation   : 19 Aug 2015
 * @Manish Singh
 */

App::uses('Component', 'Controller');

class PdfComponent extends Component {

    /*
    * create_pdf function
    * Functionality -  To Create Pdf and upload it into - WWW_ROOT . 'files/pdf' . DS
    * Created date - 19-Aug-2015
    */
    
    public function create_pdf($renderFile = null) {
       
       $this->layout = '/pdf/default';  
       //$this->render($renderFile); //'/Pdf/my_pdf_view'
    }
    
    /*
    * download_pdf function
    * Functionality -  To Download Pdf
    * Created date - 19-Aug-2015
    */
    
    public function download_pdf($filename = null) {
        
        $this->viewClass = 'Media';
        
        $params = array(	
           'id' => $filename,                                               //'test.pdf',
           'name' => 'your_test' ,
           'download' => true,
           'extension' => 'pdf',
           'path' => WWW_ROOT . 'files/pdf' . DS
        );
        
        //$this->set($params);		
    }
    
    /*
    * show_pdf function
    * Functionality -  To Show Pdf - Without Download
    * Created date - 19-Aug-2015
    */
    
    public function show_pdf($filename = null) {
        
        $this->viewClass = 'Media';
        
        $params = array(	
           'id' => $filename,                                           //'test.pdf',
           'name' => 'your_test' ,
           'download' => false,
           'extension' => 'pdf',
           'path' => WWW_ROOT . 'files/pdf' . DS
        );
        
       $this->set($params);		
    }
}
?>