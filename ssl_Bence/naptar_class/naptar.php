<?php 
	/**
	 * Naptar generálás
	 */
	class Naptar
	{
		
		function __construct(int $apartmanSzam)
		{
			$this->apartmanSzam = $apartmanSzam;
			$this->honapok = array("zero", "Január", "Február", "Március", "Április", "Május", "Június", "Július", "Agusztus", "Szeptember", "Október", "November", "December");
			$this->elozoHonapNapokKihagyas = array(6, 0, 1, 2, 3, 4, 5);

			(isset($_SESSION["ev"])) 
				? $this->ev = $_SESSION["ev"]
				: $this->ev = date("Y"); 

			(isset($_SESSION["ev"])) 
				? $this->honap = $_SESSION["honap"]
				: $this->honap = date("m");


			$this->kov_honap = date("m", strtotime("01-$honap-$ev +1 month"));
			$this->kov_ev = date("Y", strtotime("01.".date("m").".".date("Y")." +1 month"));
			
			$this->elozo_honap = date("m", strtotime("01.".date("m").".".date("Y")." -1 month"));
			$this->elozo_ev = date("Y", strtotime("01.".date("m").".".date("Y")." -1 month"));

			$this->honap_napok_szama = cal_days_in_month(CAL_GREGORIAN, $honap, $ev);
			$this->honap_elso_napja = date("w", strtotime("$ev-$honap-01"));
			
			$this->elozo_honap_nap_szam =  cal_days_in_month(CAL_GREGORIAN, date("m", strtotime("-1 month")), date("Y", strtotime("-1 month")));
			$this->elozo_honap_megjelenitendo_napok = $elozo_honap_nap_szam - $elozo_honap_napok_kihagyas[$honap_elso_napja] + 1;

			$napszam = 1 - $elozo_honap_napok_kihagyas[$honap_elso_napja];
			}

		function createNaptar() : str 
		{
			string $naptarHTMLString = "";

		}
	}


 ?>