<?php

Class CBRwidget extends CWidget {

    public $curs= array();
    public $listcurs = array();
	
    /**
    * Run widget
    */
     
    public function run()
    {
       return self::cbr();
    }

     /**
     * Processing currency.
     * @return string 
     */
     
    public function cbr()
    {
		
	$xml = new DOMDocument();
        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y');

     if ($xml->load($url)) {
 
            $documentElement = $xml->documentElement;
            $items = $documentElement->getElementsByTagName('Valute');
 
            foreach ($items as $item) {
            	
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $curs = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $this->listcurs[$code] = floatval(str_replace(',', '.', $curs));
              
            }
 
            foreach($this->curs as $curs) {
		
		echo " <br>$curs ".$this->listcurs[$curs];
		  
	    }
        } 
    }
}

?>
