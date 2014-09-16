<?php
/*
	Author: Helge Sverre Hessevik Liseth
	Website: www.helgesverre.com
	
	Email: helge.sverre@gmail.com
	Twitter: @HelgeSverre
	
	License: Attribution-ShareAlike 4.0 International
	
*/



/**
* Class responsible for checking if a domain is registered
*
* @author  Helge Sverre <email@helgesverre.com>
*
* @param boolean $error_reporting Set if the function should display errors or suppress them, default is false
* @return boolean true means the domain is NOT registered
*/
class DomainAvailability {
	
	private  $error_reporting;


	public function __construct($debug = false) {
		if ( $debug ) {
			error_reporting(E_ALL);
			$error_reporting = true;
		} else {
			
			error_reporting(0);		
			$error_reporting = false;
		}
		
	}


	/**
	* This function checks if the supplied domain name is registered
	*
	* @author  Helge Sverre <email@helgesverre.com>
	*
	* @param string $domain The domain that will be checked for registration.
	* @param boolean $error_reporting Set if the function should display errors or suppress them, default is TRUE
	* @return boolean true means the domain is NOT registered
	*/
	public function is_available($domain) {
		
		// make the domain lowercase
		$domain = strtolower($domain);

		// Set the timeout (in seconds) for the socket open function.
		$timeout = 10;
		
		
		
		/**
		* This array contains the list of WHOIS servers and the "domain not found" string 
		* to be searched for to check if the domain is available for registration.
		*
		* NOTE: The "domain not found" string may change at any time for any reason.
		*/
		$whois_arr = array(
			".com" =>  array("whois.verisign-grs.com", "No match for "),
			".net" =>  array("whois.verisign-grs.com", "No match for "),
			".org" =>  array("whois.pir.org", "NOT FOUND"),
			".co.uk" =>  array("whois.nic.uk", "No match for "),
			".io" =>  array("whois.nic.io", "is available for purchase"),
			".computer" => array( "whois.donuts.co", "Domain not found."),
			".ac" => array("whois.nic.ac","is available for purchase"),
			".academy" => array("whois.donuts.co","Domain not found."),
			".actor" => array("whois.unitedtld.com","Domain not found."),
			".ae" => array("whois.aeda.net.ae","No Data Found"),
			".aero" => array("whois.aero","NOT FOUND"),
			".af" => array("whois.nic.af","Domain Status: No Object Found"),
			".ag" => array("whois.nic.ag","NOT FOUND"),
			".agency" => array("whois.donuts.co","Domain not found."),
			".ai" => array("whois.ai","If you would like to register this, or any .ai domain"),
			".am" => array("whois.amnic.net","No match"),
			".archi" => array("whois.ksregistry.net","not found..."),
			".arpa" => array("whois.iana.org","% This query returned 0 objects."),
			".as" => array("whois.nic.as","Domain Status: Available"),
			".asia" => array("whois.nic.asia","NOT FOUND"),
			".associates" => array("whois.donuts.co","Domain not found."),
			".at" => array("whois.nic.at","% nothing found"),
			".au" => array("whois.audns.net.au","No Data Found"),
			".aw" => array("whois.nic.aw"," is free"),
			".ax" => array("whois.ax","No records matching "),
			".az" => array("whois.az","MATCH"),
			".bar" => array("whois.nic.bar","DOMAIN NOT FOUND"),
			".bargains" => array("whois.donuts.co","Domain not found."),
			".be" => array("whois.dns.be","Status:	AVAILABLE"),
			".berlin" => array("whois.nic.berlin","% No match"),
			".bg" => array("whois.register.bg","does not exist in database!"),
			".bi" => array("whois1.nic.bi","Domain Status: No Object Found"),
			".bike" => array("whois.donuts.co","Domain not found."),
			".biz" => array("whois.biz","Not found: "),
			".bj" => array("whois.nic.bj","No records matching"),
			".black" => array("whois.afilias.net","NOT FOUND"),
			".blackfriday" => array("whois.uniregistry.net","is available for"),
			".blue" => array("whois.afilias.net","NOT FOUND"),
			".bn" => array("whois.bn","No records matching"),
			".boutique" => array("whois.donuts.co","Domain not found."),
			".build" => array("whois.nic.build","No Data Found"),
			".builders" => array("whois.donuts.co","Domain not found."),
			".bw" => array("whois.nic.net.bw","Domain Status: No Object Found"),
			".by" => array("whois.cctld.by","Object does not exist"),
			".ca" => array("whois.cira.ca","Domain status:         available"),
			".cab" => array("whois.donuts.co","Domain not found."),
			".camera" => array("whois.donuts.co","Domain not found."),
			".camp" => array("whois.donuts.co","Domain not found."),
			".captial" => array("whois.donuts.co","Domain not found."),
			".cards" => array("whois.donuts.co","Domain not found."),
			".careers" => array("whois.donuts.co","Domain not found."),
			".cat" => array("whois.cat","NOT FOUND."),
			".catering" => array("whois.donuts.co","Domain not found."),
			".cc" => array("ccwhois.verisign-grs.com","No match for"),
			".center" => array("whois.donuts.co","Domain not found."),
			".ceo" => array("whois.nic.ceo","Not found:"),
			".cf" => array("whois.dot.cf","Invalid query or domain name not known in Dot CF Domain Registry"),
			".ch" => array("whois.nic.ch","We do not have an entry in our database matching your query."),
			".cheap" => array("whois.donuts.co","Domain not found."),
			".christmas" => array("whois.uniregistry.net","is available for registration"),
			".ci" => array("whois.nic.ci","not found"),
			".cl" => array("whois.nic.cl",": no existe"),
			".cleaning" => array("whois.donuts.co","Domain not found."),
			".clothing" => array("whois.donuts.co","Domain not found."),
			".club" => array("whois.nic.club","Not found:"),
			".cn" => array("whois.cnnic.cn","no matching record."),
			".co" => array("whois.nic.co","Not found:"),
			".codes" => array("whois.donuts.co","Domain not found."),
			".coffee" => array("whois.donuts.co","Domain not found."),
			".college" => array("whois.centralnic.com","DOMAIN NOT FOUND"),
			".cologne" => array("whois-fe1.pdt.cologne.tango.knipp.de","no matching objects found"),
			".community" => array("whois.donuts.co","Domain not found."),
			".company" => array("whois.donuts.co","Domain not found."),
			".construction" => array("whois.donuts.co","Domain not found."),
			".contractors" => array("whois.donuts.co","Domain not found."),
			".cooking" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			".cool" => array("whois.donuts.co","Domain not found."),
			".coop" => array("whois.nic.coop","No domain records were found to match"),
			".country" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			".cruises" => array("whois.donuts.co","Domain not found."),
			".cx" => array("whois.nic.cx","Domain Status: No Object Found"),
			".cz" => array("whois.nic.cz","No entries found."),
			".dating" => array("whois.donuts.co","Domain not found."),
			".de" => array("whois.denic.de","MATCH"),
			".democrat" => array("whois.unitedtld.com","MATCH"),
			".desi" => array("whois.ksregistry.net","MATCH"),
			".diamonds" => array("whois.donuts.co","Domain not found."),
			".directory" => array("whois.donuts.co","Domain not found."),
			".dj" => array("none","MATCH"),
			".dk" => array("whois.dk-hostmaster.dk","MATCH"),
			".dm" => array("whois.nic.dm","MATCH"),
			".do" => array("none","MATCH"),
			".domains" => array("whois.donuts.co","Domain not found."),
			".dz" => array("whois.nic.dz","MATCH"),
			".ec" => array("whois.nic.ec","MATCH"),
			".edu" => array("whois.educause.edu","MATCH"),
			".education" => array("whois.donuts.co","Domain not found."),
			".ee" => array("whois.tld.ee","MATCH"),
			".eg" => array("none","MATCH"),
			".eh" => array("none","MATCH"),
			".email" => array("whois.donuts.co","Domain not found."),
			".engineering" => array("whois.donuts.co","Domain not found."),
			".enterprises" => array("whois.donuts.co","Domain not found."),
			".equipment" => array("whois.donuts.co","Domain not found."),
			".er" => array("none","MATCH"),
			".es" => array("whois.nic.es","MATCH"),
			".estate" => array("whois.donuts.co","Domain not found."),
			".et" => array("none","MATCH"),
			".eu" => array("whois.eu","MATCH"),
			".eus" => array("whois.eus.coreregistry.net","MATCH"),
			".events" => array("whois.donuts.co","Domain not found."),
			".expert" => array("whois.donuts.co","Domain not found."),
			".exposed" => array("whois.donuts.co","Domain not found."),
			".farm" => array("whois.donuts.co","Domain not found."),
			".feedback" => array("whois.centralnic.com","MATCH"),
			".fi" => array("whois.fi","MATCH"),
			".fish" => array("whois.donuts.co","Domain not found."),
			".fishing" => array("whois-dub.mm-registry.com","MATCH"),
			".fj" => array("none","MATCH"),
			".fk" => array("none","MATCH"),
			".flights" => array("whois.donuts.co","Domain not found."),
			".florist" => array("whois.donuts.co","Domain not found."),
			".fm" => array("none","MATCH"),
			".fo" => array("whois.nic.fo","MATCH"),
			".foo" => array("domain-registry-whois.l.google.com","MATCH"),
			".foundation" => array("whois.donuts.co","Domain not found."),
			".fr" => array("whois.nic.fr","MATCH"),
			".frogans" => array("whois-frogans.nic.fr","MATCH"),
			".futbol" => array("whois.unitedtld.com","MATCH"),
			".ga" => array("whois.gal.coreregistry.net","MATCH"),
			".gal" => array("whois.donuts.co","Domain not found."),
			".gallery" => array("none","MATCH"),
			".gb" => array("none","MATCH"),
			".gd" => array("whois.nic.gd","MATCH"),
			".ge" => array("none","MATCH"),
			".gf" => array("none","MATCH"),
			".gg" => array("whois.gg","MATCH"),
			".gh" => array("none","MATCH"),
			".gi" => array("whois2.afilias-grs.net","MATCH"),
			".gift" => array("whois.uniregistry.net","MATCH"),
			".gl" => array("whois.nic.gl","MATCH"),
			".glass" => array("whois.donuts.co","Domain not found."),
			".gm" => array("none","MATCH"),
			".gn" => array("none","MATCH"),
			".gop" => array("whois-cl01.mm-registry.com","MATCH"),
			".gov" => array("whois.dotgov.gov","MATCH"),
			".gp" => array("none","MATCH"),
			".gq" => array("none","MATCH"),
			".gr" => array("none","MATCH"),
			".graphics" => array("whois.donuts.co","Domain not found."),
			".gripe" => array("whois.donuts.co","Domain not found."),
			".gs" => array("whois.nic.gs","MATCH"),
			".gt" => array("none","MATCH"),
			".gu" => array("none","MATCH"),
			".guitars" => array("whois.uniregistry.net","MATCH"),
			".guru" => array("whois.donuts.co","Domain not found."),
			".gw" => array("none","MATCH"),
			".gy" => array("whois.registry.gy","MATCH"),
			".haus" => array("whois.unitedtld.com","MATCH"),
			".hk" => array("whois.hkirc.hk","MATCH"),
			".hm" => array("none","MATCH"),
			".hn" => array("whois.nic.hn","MATCH"),
			".holiday" => array("whois.donuts.co","Domain not found."),
			".horse" => array("whois-dub.mm-registry.com","MATCH"),
			".house" => array("whois.donuts.co","Domain not found."),
			".hr" => array("whois.dns.hr","MATCH"),
			".ht" => array("whois.nic.ht","MATCH"),
			".hu" => array("whois.nic.hu","MATCH"),
			".id" => array("whois.pandi.or.id","MATCH"),
			".ie" => array("whois.domainregistry.ie","MATCH"),
			".il" => array("whois.isoc.org.il","MATCH"),
			".im" => array("whois.nic.im","MATCH"),
			".immobilien" => array("whois.unitedtld.com","MATCH"),
			".in" => array("whois.inregistry.net","MATCH"),
			".industries" => array("whois.donuts.co","Domain not found."),
			".info" => array("whois.afilias.net","NOT FOUND"),
			".institute" => array("whois.donuts.co","Domain not found."),
			".int" => array("whois.iana.org","MATCH"),
			".international" => array("whois.donuts.co","Domain not found."),
			".iq" => array("whois.cmc.iq","MATCH"),
			".ir" => array("whois.nic.ir","No entries found in the selected"),
			".is" => array("whois.isnic.is","No entries found for query"),
			".it" => array("whois.nic.it","Status:             AVAILABLE"),
			".je" => array("whois.je","Domain Status: No Object Found"),
			".jetzt" => array("none","MATCH"),
			".jm" => array("none","MATCH"),
			".jo" => array("none","MATCH"),
			".jobs" => array("jobswhois.verisign-grs.com","No match for"),
			".jp" => array("whois.jprs.jp","No match!!"),
			".kaufen" => array("whois.unitedtld.com","MATCH"),
			".ke" => array("whois.kenic.or.ke","MATCH"),
			".kg" => array("whois.domain.kg","MATCH"),
			".kh" => array("none","MATCH"),
			".ki" => array("whois.nic.ki","MATCH"),
			".kim" => array("whois.afilias.net","MATCH"),
			".kitchen" => array("whois.donuts.co","Domain not found."),
			".kiwi" => array("whois.dot-kiwi.com","MATCH"),
			".km" => array("none","MATCH"),
			".kn" => array("none","MATCH"),
			".koeln" => array("whois-fe1.pdt.koeln.tango.knipp.de","MATCH"),
			".kp" => array("none","MATCH"),
			".kr" => array("whois.kr","MATCH"),
			".kred" => array("none","MATCH"),
			".kw" => array("none","MATCH"),
			".ky" => array("none","MATCH"),
			".kz" => array("whois.nic.kz","MATCH"),
			".la" => array("whois.nic.la","MATCH"),
			".land" => array("whois.donuts.co","Domain not found."),
			".lb" => array("none","MATCH"),
			".lc" => array("none","MATCH"),
			".lease" => array("whois.donuts.co","Domain not found."),
			".li" => array("whois.nic.li","MATCH"),
			".lighting" => array("whois.donuts.co","Domain not found."),
			".limo" => array("whois.donuts.co","Domain not found."),
			".link" => array("whois.uniregistry.net","MATCH"),
			".lk" => array("none","MATCH"),
			".london" => array("whois-lon.mm-registry.com","MATCH"),
			".lr" => array("none","MATCH"),
			".ls" => array("none","MATCH"),
			".lt" => array("whois.domreg.lt","MATCH"),
			".lu" => array("whois.dns.lu","MATCH"),
			".luxury" => array("whois.nic.luxury","MATCH"),
			".lv" => array("whois.nic.lv","MATCH"),
			".ly" => array("whois.nic.ly","MATCH"),
			".ma" => array("whois.iam.net.ma","MATCH"),
			".management" => array("whois.donuts.co","Domain not found."),
			".mango" => array("whois.mango.coreregistry.net","no matching objects found"),
			".marketing" => array("whois.donuts.co","Domain not found."),
			".mc" => array("none","MATCH"),
			".md" => array("whois.nic.md","No match for"),
			".me" => array("whois.nic.me","NOT FOUND"),
			".media" => array("whois.donuts.co","Domain not found."),
			".meet" => array("whois.afilias.net","MATCH"),
			".menu" => array("whois.nic.menu","No Data Found"),
			".mf" => array("none","MATCH"),
			".mg" => array("whois.nic.mg","Domain Status: Available"),
			".mh" => array("none","MATCH"),
			".miami" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			".mil" => array("none","MATCH"),
			".mk" => array("whois.marnet.mk","no entries found"),
			".ml" => array("whois.dot.ml","domain name not known"),
			".mm" => array("none","MATCH"),
			".mn" => array("whois.nic.mn","MATCH"),
			".mo" => array("whois.monic.mo","No match for"),
			".mobi" => array("whois.dotmobiregistry.net","NOT FOUND"),
			".moda" => array("whois.unitedtld.com","Domain not found."),
			".moe" => array("none","MATCH"),
			".monash" => array("whois.nic.monash","No Data Found"),
			".mp" => array("whois.nic.mp","MATCH"),
			".mq" => array("none","MATCH"),
			".mr" => array("none","MATCH"),
			".ms" => array("whois.nic.ms","Domain Status: No Object Found"),
			".mt" => array("none","MATCH"),
			".mu" => array("whois.nic.mu","Domain Status: No Object Found"),
			".museum" => array("whois.museum","NOT FOUND."),
			".mv" => array("none","MATCH"),
			".mw" => array("none","MATCH"),
			".mx" => array("whois.mx","MATCH"),
			".my" => array("whois.domainregistry.my","MATCH"),
			".mz" => array("none","MATCH"),
			".na" => array("whois.na-nic.com.na","Domain Status: No Object Found"),
			".nagoya" => array("none","MATCH"),
			".name" => array("whois.nic.name","No match for"),
			".nc" => array("whois.nc","No entries found in the .nc database"),
			".ne" => array("none","MATCH"),
			".neustar" => array("none","MATCH"),
			".nf" => array("whois.nic.nf","Domain Status: No Object Found"),
			".ng" => array("whois.nic.net.ng","Domain Status: Available"),
			".ni" => array("none","MATCH"),
			".ninja" => array("whois.unitedtld.com","Domain not found."),
			".nl" => array("whois.domain-registry.nl","is free"),
			".no" => array("whois.norid.no","% No match"),
			".np" => array("none","MATCH"),
			".nr" => array("none","MATCH"),
			".nu" => array("whois.iis.nu","not found."),
			".nyc" => array("none","MATCH"),
			".nz" => array("whois.srs.net.nz","query_status: 260 Will be Available"),
			".okinawa" => array("none","MATCH"),
			".om" => array("whois.registry.om","No Data Found"),
			".onl" => array("whois.afilias-srs.net","NOT FOUND"),
			".pa" => array("none","MATCH"),
			".paris" => array("whois-paris.nic.fr","Requested Domain cannot be found"),
			".partners" => array("whois.donuts.co","Domain not found."),
			".parts" => array("whois.donuts.co","Domain not found."),
			".pe" => array("kero.yachay.pe","Status: Not Registered"),
			".pf" => array("whois.registry.pf","Domain unknown"),
			".pg" => array("none","MATCH"),
			".ph" => array("none","MATCH"),
			".photo" => array("whois.uniregistry.net","is available for registration"),
			".photography" => array("whois.donuts.co","Domain not found."),
			".photos" => array("whois.donuts.co","Domain not found."),
			".pics" => array("whois.uniregistry.net","is available for registration"),
			".pictures" => array("whois.donuts.co","Domain not found."),
			".pink" => array("whois.afilias.net","NOT FOUND"),
			".pk" => array("none","MATCH"),
			".pl" => array("whois.dns.pl","No information available"),
			".plumbing" => array("whois.donuts.co","Domain not found."),
			".pm" => array("whois.nic.pm","No entries found"),
			".pn" => array("none","MATCH"),
			".post" => array("whois.dotpostregistry.net","NOT FOUND"),
			".pr" => array("whois.nic.pr","is not registered."),
			".pro" => array("whois.dotproregistry.net","NOT FOUND"),
			".productions" => array("whois.donuts.co","Domain not found."),
			".properties" => array("whois.donuts.co","Domain not found."),
			".ps" => array("none","MATCH"),
			".pt" => array("whois.dns.pt","no match"),
			".pub" => array("whois.unitedtld.com","Domain not found."),
			".pw" => array("whois.nic.pw","DOMAIN NOT FOUND"),
			".py" => array("none","MATCH"),
			".qa" => array("whois.registry.qa","No Data Found"),
			".qpon" => array("none","MATCH"),
			".quebec" => array("whois.quebec.rs.corenic.net","no matching objects found"),
			".re" => array("whois.nic.re","No entries found"),
			".recipes" => array("whois.donuts.co","Domain not found."),
			".red" => array("whois.afilias.net","NOT FOUND"),
			".reisen" => array("whois.donuts.co","Domain not found."),
			".ren" => array("none","MATCH"),
			".rentals" => array("whois.donuts.co","Domain not found."),
			".repair" => array("whois.donuts.co","Domain not found."),
			".report" => array("whois.donuts.co","Domain not found."),
			".rest" => array("whois.centralnic.com","DOMAIN NOT FOUND"),
			".reviews" => array("whois.unitedtld.com","Domain not found."),
			".rich" => array("whois.afilias-srs.net","NOT FOUND"),
			".ro" => array("whois.rotld.ro","No entries found"),
			".rocks" => array("whois.unitedtld.com","Domain not found."),
			".rodeo" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			".rs" => array("whois.rnids.rs","Domain is not registered"),
			".ru" => array("whois.tcinet.ru","No entries found"),
			".ruhr" => array("whois.nic.ruhr","no matching objects found"),
			".rw" => array("none","MATCH"),
			".ryukyu" => array("", "MATCH"),
			".sa" => array("whois.nic.net.sa","No Match for"),
			".saarland" => array("whois.ksregistry.net","not found..."),
			".sb" => array("whois.nic.net.sb","Domain Status: No Object Found"),
			".sc" => array("whois2.afilias-grs.net","NOT FOUND"),
			".sd" => array("none","MATCH"),
			".se" => array("whois.iis.se","not found."),
			".services" => array("whois.donuts.co","Domain not found."),
			".sexy" => array("whois.uniregistry.net","is available for"),
			".sg" => array("whois.sgnic.sg","Domain Not Found"),
			".sh" => array("whois.nic.sh","is available for purchase"),
			".shiksha" => array("whois.afilias.net","NOT FOUND"),
			".shoes" => array("whois.donuts.co","Domain not found."),
			".si" => array("whois.arnes.si","No entries found"),
			".singles" => array("whois.donuts.co","Domain not found."),
			".sj" => array("none","MATCH"),
			".sk" => array("whois.sk-nic.sk","Not found."),
			".sl" => array("none","MATCH"),
			".sm" => array("whois.nic.sm","No entries found."),
			".sn" => array("whois.nic.sn","NOT FOUND"),
			".so" => array("whois.nic.so","DOMAIN NOT FOUND"),
			".social" => array("whois.unitedtld.com","MATCH"),
			".sohu" => array("none","MATCH"),
			".solar" => array("whois.donuts.co","Domain not found."),
			".solutions" => array("whois.donuts.co","Domain not found."),
			".soy" => array("domain-registry-whois.l.google.com","Domain not found"),
			".sr" => array("none","MATCH"),
			".ss" => array("none","MATCH"),
			".st" => array("whois.nic.st","No entries found"),
			".su" => array("whois.tcinet.ru","No entries found"),
			".supplies" => array("whois.donuts.co","Domain not found."),
			".supply" => array("whois.donuts.co","Domain not found."),
			".support" => array("whois.donuts.co","Domain not found."),
			".sv" => array("none","MATCH"),
			".sx" => array("whois.sx","Status: AVAILABLE"),
			".sy" => array("whois.tld.sy","Domain Status: Available"),
			".systems" => array("whois.donuts.co","Domain not found."),
			".sz" => array("none","MATCH"),
			".tattoo" => array("whois.uniregistry.net","is available for registration"),
			".tc" => array("whois.meridiantld.net","Domain Status: No Object Found"),
			".td" => array("none","MATCH"),
			".technology" => array("whois.donuts.co","Domain not found."),
			".tel" => array("whois.nic.tel","Not found:"),
			".tf" => array("whois.nic.tf","No entries found"),
			".tg" => array("none","MATCH"),
			".th" => array("whois.thnic.co.th","No match for"),
			".tienda" => array("whois.donuts.co","Domain not found."),
			".tips" => array("whois.donuts.co","Domain not found."),
			".tj" => array("none","MATCH"),
			".tk" => array("whois.dot.tk","Invalid query or domain name not known"),
			".tl" => array("whois.nic.tl","Domain Status: No Object Found"),
			".tm" => array("whois.nic.tm","is available for purchase"),
			".tn" => array("whois.ati.tn","NO OBJECT FOUND!"),
			".to" => array("whois.tonic.to","No match for"),
			".today" => array("whois.donuts.co","Domain not found."),
			".tokyo" => array("none","MATCH"),
			".tools" => array("whois.donuts.co","Domain not found."),
			".town" => array("whois.donuts.co","Domain not found."),
			".toys" => array("whois.donuts.co","Domain not found."),
			".tp" => array("none","MATCH"),
			".tr" => array("whois.nic.tr","Invalid input"),
			".trade" => array("none","MATCH"),
			".training" => array("whois.donuts.co","Domain not found."),
			".travel" => array("whois.nic.travel","Not found:"),
			".tt" => array("none","MATCH"),
			".tv" => array("tvwhois.verisign-grs.com","No match for"),
			".tw" => array("whois.twnic.net.tw","No Found"),
			".tz" => array("whois.tznic.or.tz","No entries found."),
			".ua" => array("whois.ua","No entries found for"),
			".ug" => array("whois.co.ug","No entries found for the selected source(s)."),
			".uk" => array("whois.nic.uk","This domain name has not been registered."),
			".um" => array("none","MATCH"),
			".university" => array("whois.donuts.co","Domain not found."),
			".uno" => array("none","MATCH"),
			".us" => array("whois.nic.us","Not found"),
			".uy" => array("whois.nic.org.uy","MATCH"),
			".uz" => array("whois.cctld.uz","MATCH"),
			".va" => array("none","MATCH"),
			".vacations" => array("whois.donuts.co","Domain not found."),
			".vc" => array("whois2.afilias-grs.net","MATCH"),
			".ve" => array("whois.nic.ve","MATCH"),
			".vegas" => array("whois.afilias-srs.net","MATCH"),
			".ventures" => array("whois.donuts.co","Domain not found."),
			".vg" => array("ccwhois.ksregistry.net","MATCH"),
			".vi" => array("none","MATCH"),
			".vi" => array("none","MATCH"),
			".viajes" => array("whois.donuts.co","Domain not found."),
			".villas" => array("whois.donuts.co","Domain not found."),
			".vision" => array("whois.donuts.co","Domain not found."),
			".vn" => array("none","MATCH"),
			".vodka" => array("whois-dub.mm-registry.com","MATCH"),
			".vote" => array("whois.afilias.net","MATCH"),
			".voting" => array("whois.voting.tld-box.at","MATCH"),
			".voto" => array("whois.afilias.net","MATCH"),
			".voyage" => array("whois.donuts.co","Domain not found."),
			".vu" => array("vunic.vu","MATCH"),
			".wang" => array("whois.gtld.knet.cn","MATCH"),
			".watch" => array("whois.donuts.co","Domain not found."),
			".webcam" => array("none","MATCH"),
			".wed" => array("whois.nic.wed","MATCH"),
			".wf" => array("whois.nic.wf","MATCH"),
			".wien" => array("whois.nic.wien","MATCH"),
			".wiki" => array("whois.nic.wiki","MATCH"),
			".works" => array("whois.donuts.co","Domain not found."),
			".ws" => array("whois.website.ws","MATCH"),
			".xxx" => array("whois.nic.xxx","MATCH"),
			".xyz" => array("whois.nic.xyz","MATCH"),
			".ye" => array("none","MATCH"),
			".yokohoma" =>array("none","MATCH"),
			".yt" =>array("whois.nic.yt","MATCH"),
			".za" =>array("none","MATCH"),
			".zm" =>array("whois.nic.zm","MATCH"),
			".zone" =>array( "whois.donuts.co","Domain not found."),
			".zw" =>array("none","MATCH")
		);


		// gethostbyname returns the same string if it cant find the domain, 
		// we do a further check to see if it is a false positive
		if (gethostbyname($domain) == $domain) {

			// get the TLD of the domain
			$tld = $this->get_tld($domain);

			// If an entry for the TLD exists in the whois array 
			if ($whois_arr[$tld][0]) {
				// set the hostname for the whois server
				$whois_server = $whois_arr[$tld][0];

				// set the "domain not found" string
				$bad_string = $whois_arr[$tld][1];
			} else {
				// TODO: REFACTOR THIS
				// TLD is not in the whois array, die
				die("WHOIS server not found for that TLD");
			}
				
			// Connect to whois server and get information
			$fp = fsockopen($whois_server, 43, $errno, $errstr, $timeout);
			if (!$fp) {
				// display the socket error if error reporting is enabled.
				if ($error_reporting) {
					echo "{$errstr} ({$errno})<br />\n";
				} 		
			} else {

				// Construct the WHOIS request as specified in RFC 3912 ( http://tools.ietf.org/html/rfc3912 )
				$out = $domain . "\r\n";

				// Send the WHOIS request
				fwrite($fp, $out);
				
				// assign null to $whois to stop php complaining about it not being defined.
				$whois = null;

				// While the connnection is receiving data
				while (!feof($fp)) {
					// append the incommming data to a variable, sorry for the magic number
					$whois .= fgets($fp, 128);
				}
			
				// close the connection to the WHOIS server
				fclose($fp);
				
				// If you find the "domain not found" string in the result, the domain is available.
				if (strpos($whois, $bad_string) !== FALSE) {
					return TRUE; // available
				} else {
					return FALSE; // not available
				}	
			}

		} else {
			// not available
			return FALSE;	
		}
	}
	
	/**
	* Extracts the TLD from a domain, supports URLS with "www." at the beginning.
	*
	* @author  Helge Sverre <email@helgesverre.com>
	*
	* @param string $domain The domain that will get it's TLD extracted
	* @return string The TLD for $domain
	*/

	public function get_tld ($domain) {

		$hasWWW = substr($domain, strpos($domain, "www."));

		// this checks the domain string to see if it has "www."" included at the end
		if ( !$hasWWW || empty($hasWWW) ) {
			// If "www." is not found in the domain string then set the offset to 0
			$domain_offset = 0;
		} else {
			// If "www." is found in the domain string then set the offset to 4
			$domain_offset = 4; 
		}
		
		// Find the first occurence of ".", start at the domain offset so it doesnt use "www." as the first occurence
		$tld_index = strpos($domain, ".", $domain_offset);

		// Use the position of the first occurence of "." to extract out the TLD
		$tld = substr($domain, $tld_index, ( strlen($domain) - $tld_index ) ); 
		return $tld;
	}
}





?>
