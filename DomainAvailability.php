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
			"com" =>  array("whois.verisign-grs.com", "No match for "),
			"net" =>  array("whois.verisign-grs.com", "No match for "),
			"org" =>  array("whois.pir.org", "NOT FOUND"),
			"co.uk" =>  array("whois.nic.uk", "No match for "),
			"io" =>  array("whois.nic.io", "is available for purchase"),
			"computer" => array( "whois.donuts.co", "Domain not found."),
			"ac" => array("whois.nic.ac","is available for purchase"),
			"academy" => array("whois.donuts.co","Domain not found."),
			"actor" => array("whois.unitedtld.com","Domain not found."),
			"ae" => array("whois.aeda.net.ae","No Data Found"),
			"aero" => array("whois.aero","NOT FOUND"),
			"af" => array("whois.nic.af","Domain Status: No Object Found"),
			"ag" => array("whois.nic.ag","NOT FOUND"),
			"agency" => array("whois.donuts.co","Domain not found."),
			"ai" => array("whois.ai","If you would like to register this, or any .ai domain"),
			"am" => array("whois.amnic.net","No match"),
			"archi" => array("whois.ksregistry.net","not found..."),
			"arpa" => array("whois.iana.org","% This query returned 0 objects."),
			"as" => array("whois.nic.as","Domain Status: Available"),
			"asia" => array("whois.nic.asia","NOT FOUND"),
			"associates" => array("whois.donuts.co","Domain not found."),
			"at" => array("whois.nic.at","% nothing found"),
			"au" => array("whois.audns.net.au","No Data Found"),
			"aw" => array("whois.nic.aw"," is free"),
			"ax" => array("whois.ax","No records matching "),
			"az" => array("whois.az","MATCH"), // not responding
			"bar" => array("whois.nic.bar","DOMAIN NOT FOUND"),
			"bargains" => array("whois.donuts.co","Domain not found."),
			"be" => array("whois.dns.be","Status:	AVAILABLE"),
			"berlin" => array("whois.nic.berlin","% No match"),
			"bg" => array("whois.register.bg","does not exist in database!"),
			"bi" => array("whois1.nic.bi","Domain Status: No Object Found"),
			"bike" => array("whois.donuts.co","Domain not found."),
			"biz" => array("whois.biz","Not found: "),
			"bj" => array("whois.nic.bj","No records matching"),
			"blackfriday" => array("whois.uniregistry.net","is available for"),
			"bn" => array("whois.bn","No records matching"),
			"boutique" => array("whois.donuts.co","Domain not found."),
			"build" => array("whois.nic.build","No Data Found"),
			"builders" => array("whois.donuts.co","Domain not found."),
			"bw" => array("whois.nic.net.bw","Domain Status: No Object Found"),
			"by" => array("whois.cctld.by","Object does not exist"),
			"ca" => array("whois.cira.ca","Domain status:         available"),
			"cab" => array("whois.donuts.co","Domain not found."),
			"camera" => array("whois.donuts.co","Domain not found."),
			"camp" => array("whois.donuts.co","Domain not found."),
			"captial" => array("whois.donuts.co","Domain not found."),
			"cards" => array("whois.donuts.co","Domain not found."),
			"careers" => array("whois.donuts.co","Domain not found."),
			"cat" => array("whois.cat","NOT FOUND."),
			"catering" => array("whois.donuts.co","Domain not found."),
			"cc" => array("ccwhois.verisign-grs.com","No match for"),
			"center" => array("whois.donuts.co","Domain not found."),
			"ceo" => array("whois.nic.ceo","Not found:"),
			"cf" => array("whois.dot.cf","Invalid query or domain name not known in Dot CF Domain Registry"),
			"ch" => array("whois.nic.ch","We do not have an entry in our database matching your query."),
			"cheap" => array("whois.donuts.co","Domain not found."),
			"christmas" => array("whois.uniregistry.net","is available for registration"),
			"ci" => array("whois.nic.ci","not found"),
			"cl" => array("whois.nic.cl",": no existe"),
			"cleaning" => array("whois.donuts.co","Domain not found."),
			"clothing" => array("whois.donuts.co","Domain not found."),
			"club" => array("whois.nic.club","Not found:"),
			"cn" => array("whois.cnnic.cn","no matching record."),
			"co" => array("whois.nic.co","Not found:"),
			"codes" => array("whois.donuts.co","Domain not found."),
			"coffee" => array("whois.donuts.co","Domain not found."),
			"college" => array("whois.centralnic.com","DOMAIN NOT FOUND"),
			"cologne" => array("whois-fe1.pdt.cologne.tango.knipp.de","no matching objects found"),
			"community" => array("whois.donuts.co","Domain not found."),
			"company" => array("whois.donuts.co","Domain not found."),
			"construction" => array("whois.donuts.co","Domain not found."),
			"contractors" => array("whois.donuts.co","Domain not found."),
			"cooking" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"cool" => array("whois.donuts.co","Domain not found."),
			"coop" => array("whois.nic.coop","No domain records were found to match"),
			"country" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"cruises" => array("whois.donuts.co","Domain not found."),
			"cx" => array("whois.nic.cx","Domain Status: No Object Found"),
			"cz" => array("whois.nic.cz","No entries found."),
			"dating" => array("whois.donuts.co","Domain not found."),
			"de" => array("whois.denic.de","Status: free"),
			"democrat" => array("whois.unitedtld.com","Domain not found."),
			"desi" => array("whois.ksregistry.net","not found..."),
			"diamonds" => array("whois.donuts.co","Domain not found."),
			"directory" => array("whois.donuts.co","Domain not found."),
			"dk" => array("whois.dk-hostmaster.dk","No entries found for the selected source."),
			"dm" => array("whois.nic.dm","not found..."),
			"domains" => array("whois.donuts.co","Domain not found."),
			"dz" => array("whois.nic.dz","NO OBJECT FOUND!"),
			"ec" => array("whois.nic.ec","Status: Not Registered"),
			"edu" => array("whois.educause.edu","No Match"),
			"education" => array("whois.donuts.co","Domain not found."),
			"ee" => array("whois.tld.ee","No entries found."),
			"email" => array("whois.donuts.co","Domain not found."),
			"engineering" => array("whois.donuts.co","Domain not found."),
			"enterprises" => array("whois.donuts.co","Domain not found."),
			"equipment" => array("whois.donuts.co","Domain not found."),
			"es" => array("whois.nic.es","MATCH"), //  You need your IP to be whitelisted, read more: https://sede.red.gob.es/eRegistro/inicio.action
			"estate" => array("whois.donuts.co","Domain not found."),
			"eu" => array("whois.eu","Status: AVAILABLE"),
			"eus" => array("whois.eus.coreregistry.net","no matching objects found"),
			"events" => array("whois.donuts.co","Domain not found."),
			"expert" => array("whois.donuts.co","Domain not found."),
			"exposed" => array("whois.donuts.co","Domain not found."),
			"farm" => array("whois.donuts.co","Domain not found."),
			"feedback" => array("whois.centralnic.com","DOMAIN NOT FOUND"),
			"fi" => array("whois.fi","Domain not found"),
			"fish" => array("whois.donuts.co","Domain not found."),
			"fishing" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"flights" => array("whois.donuts.co","Domain not found."),
			"florist" => array("whois.donuts.co","Domain not found."),
			"fo" => array("whois.nic.fo","No entries found."),
			"foo" => array("domain-registry-whois.l.google.com","Domain not found"),
			"foundation" => array("whois.donuts.co","Domain not found."),
			"fr" => array("whois.nic.fr","No entries found"),
			"frogans" => array("whois-frogans.nic.fr","Requested Domain cannot be found"),
			"futbol" => array("whois.unitedtld.com","Domain not found."),
			"ga" => array("whois.gal.coreregistry.net","no matching objects found"),
			"gal" => array("whois.donuts.co","Domain not found."),
			"gd" => array("whois.nic.gd","not found..."),
			"gg" => array("whois.gg","Domain Status: No Object Found"),
			"gi" => array("whois2.afilias-grs.net","NOT FOUND"),
			"gift" => array("whois.uniregistry.net","is available for registration"),
			"gl" => array("whois.nic.gl","Domain Status: No Object Found"),
			"glass" => array("whois.donuts.co","Domain not found."),
			"gop" => array("whois-cl01.mm-registry.com","Status: Not Registered"),
			"gov" => array("whois.dotgov.gov","MATCH"), // not responding, awaiting answer from registrar: http://i.gyazo.com/5318b9ed2ba6452c3688ecc666126f63.png
			"graphics" => array("whois.donuts.co","Domain not found."),
			"gripe" => array("whois.donuts.co","Domain not found."),
			"gs" => array("whois.nic.gs","Domain Status: No Object Found"),
			"guitars" => array("whois.uniregistry.net","is available for registration"),
			"guru" => array("whois.donuts.co","Domain not found."),
			"gy" => array("whois.registry.gy","Domain Status: No Object Found"),
			"haus" => array("whois.unitedtld.com","Domain not found."),
			"hk" => array("whois.hkirc.hk","The domain has not been registered."),
			"hn" => array("whois.nic.hn","Domain Status: No Object Found"),
			"holiday" => array("whois.donuts.co","Domain not found."),
			"horse" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"house" => array("whois.donuts.co","Domain not found."),
			"hr" => array("whois.dns.hr","ERROR: no entries found"),
			"ht" => array("whois.nic.ht","Domain Status: No Object Found"),
			"hu" => array("whois.nic.hu","No match"),
			"id" => array("whois.pandi.or.id","DOMAIN NOT FOUND"),
			"ie" => array("whois.domainregistry.ie","Not Registered"),
			"il" => array("whois.isoc.org.il","No data was found to match the request criteria."),
			"im" => array("whois.nic.im","was not found."),
			"immobilien" => array("whois.unitedtld.com","Domain not found."),
			"in" => array("whois.inregistry.net","NOT FOUND"),
			"industries" => array("whois.donuts.co","Domain not found."),
			"institute" => array("whois.donuts.co","Domain not found."),
			"int" => array("whois.iana.org","This query returned 0 objects."),
			"international" => array("whois.donuts.co","Domain not found."),
			"iq" => array("whois.cmc.iq","Domain Status: No Object Found"),
			"ir" => array("whois.nic.ir","No entries found in the selected"),
			"is" => array("whois.isnic.is","No entries found for query"),
			"it" => array("whois.nic.it","Status:             AVAILABLE"),
			"je" => array("whois.je","Domain Status: No Object Found"),
			"jobs" => array("jobswhois.verisign-grs.com","No match for"),
			"jp" => array("whois.jprs.jp","No match!!"),
			"kaufen" => array("whois.unitedtld.com","Domain not found."),
			"ke" => array("whois.kenic.or.ke","Status: Not Registered"),
			"kg" => array("whois.domain.kg","Data not found. This domain is available for registration."),
			"ki" => array("whois.nic.ki","Domain Status: No Object Found"),
			"kitchen" => array("whois.donuts.co","Domain not found."),
			"kiwi" => array("whois.dot-kiwi.com","Status: Not Registered"),
			"koeln" => array("whois-fe1.pdt.koeln.tango.knipp.de","no matching objects found"),
			"kr" => array("whois.kr","Above domain name is not registered to KRNIC."),
			"kz" => array("whois.nic.kz","Nothing found for this query."),
			"la" => array("whois.nic.la","DOMAIN NOT FOUND"),
			"land" => array("whois.donuts.co","Domain not found."),
			"lease" => array("whois.donuts.co","Domain not found."),
			"li" => array("whois.nic.li","We do not have an entry in our database matching your query"),
			"lighting" => array("whois.donuts.co","Domain not found."),
			"limo" => array("whois.donuts.co","Domain not found."),
			"link" => array("whois.uniregistry.net","is available for registration"),
			"london" => array("whois-lon.mm-registry.com","Status: Not Registered"),
			"lt" => array("whois.domreg.lt","Status:			available"),
			"lu" => array("whois.dns.lu","No such domain"),
			"luxury" => array("whois.nic.luxury","No Data Found"),
			"lv" => array("whois.nic.lv","Status: free"),
			"ly" => array("whois.nic.ly","Not found"),
			"ma" => array("whois.iam.net.ma","No Objects Found"),
			"management" => array("whois.donuts.co","Domain not found."),
			"mango" => array("whois.mango.coreregistry.net","no matching objects found"),
			"marketing" => array("whois.donuts.co","Domain not found."),
			"md" => array("whois.nic.md","No match for"),
			"me" => array("whois.nic.me","NOT FOUND"),
			"media" => array("whois.donuts.co","Domain not found."),
			"menu" => array("whois.nic.menu","No Data Found"),
			"mg" => array("whois.nic.mg","Domain Status: Available"),
			"miami" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"mk" => array("whois.marnet.mk","no entries found"),
			"ml" => array("whois.dot.ml","domain name not known"),
			"mn" => array("whois.nic.mn","MATCH"), // not responding
			"mo" => array("whois.monic.mo","No match for"),
			"mobi" => array("whois.dotmobiregistry.net","NOT FOUND"),
			"moda" => array("whois.unitedtld.com","Domain not found."),
			"monash" => array("whois.nic.monash","No Data Found"),
			"mp" => array("whois.nic.mp","MATCH"), // not responding
			"ms" => array("whois.nic.ms","Domain Status: No Object Found"),
			"mu" => array("whois.nic.mu","Domain Status: No Object Found"),
			"museum" => array("whois.museum","NOT FOUND."),
			"mx" => array("whois.mx","Object_Not_Found"),
			"my" => array("whois.domainregistry.my","does not exist in database"),
			"na" => array("whois.na-nic.com.na","Domain Status: No Object Found"),
			"name" => array("whois.nic.name","No match for"),
			"nc" => array("whois.nc","No entries found in the .nc database"),
			"nf" => array("whois.nic.nf","Domain Status: No Object Found"),
			"ng" => array("whois.nic.net.ng","Domain Status: Available"),
			"ninja" => array("whois.unitedtld.com","Domain not found."),
			"nl" => array("whois.domain-registry.nl","is free"),
			"no" => array("whois.norid.no","% No match"),
			"nu" => array("whois.iis.nu","not found."),
			"nz" => array("whois.srs.net.nz","query_status: 260 Will be Available"),
			"om" => array("whois.registry.om","No Data Found"),
			"onl" => array("whois.afilias-srs.net","NOT FOUND"),
			"paris" => array("whois-paris.nic.fr","Requested Domain cannot be found"),
			"partners" => array("whois.donuts.co","Domain not found."),
			"parts" => array("whois.donuts.co","Domain not found."),
			"pe" => array("kero.yachay.pe","Status: Not Registered"),
			"pf" => array("whois.registry.pf","Domain unknown"),
			"photo" => array("whois.uniregistry.net","is available for registration"),
			"photography" => array("whois.donuts.co","Domain not found."),
			"photos" => array("whois.donuts.co","Domain not found."),
			"pics" => array("whois.uniregistry.net","is available for registration"),
			"pictures" => array("whois.donuts.co","Domain not found."),
			"pl" => array("whois.dns.pl","No information available"),
			"plumbing" => array("whois.donuts.co","Domain not found."),
			"pm" => array("whois.nic.pm","No entries found"),
			"post" => array("whois.dotpostregistry.net","NOT FOUND"),
			"pr" => array("whois.nic.pr","is not registered."),
			"pro" => array("whois.dotproregistry.net","NOT FOUND"),
			"productions" => array("whois.donuts.co","Domain not found."),
			"properties" => array("whois.donuts.co","Domain not found."),
			"pt" => array("whois.dns.pt","no match"),
			"pub" => array("whois.unitedtld.com","Domain not found."),
			"pw" => array("whois.nic.pw","DOMAIN NOT FOUND"),
			"qa" => array("whois.registry.qa","No Data Found"),
			"quebec" => array("whois.quebec.rs.corenic.net","no matching objects found"),
			"re" => array("whois.nic.re","No entries found"),
			"recipes" => array("whois.donuts.co","Domain not found."),
			"reisen" => array("whois.donuts.co","Domain not found."),
			"rentals" => array("whois.donuts.co","Domain not found."),
			"repair" => array("whois.donuts.co","Domain not found."),
			"report" => array("whois.donuts.co","Domain not found."),
			"rest" => array("whois.centralnic.com","DOMAIN NOT FOUND"),
			"reviews" => array("whois.unitedtld.com","Domain not found."),
			"rich" => array("whois.afilias-srs.net","NOT FOUND"),
			"ro" => array("whois.rotld.ro","No entries found"),
			"rocks" => array("whois.unitedtld.com","Domain not found."),
			"rodeo" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"rs" => array("whois.rnids.rs","Domain is not registered"),
			"ru" => array("whois.tcinet.ru","No entries found"),
			"ruhr" => array("whois.nic.ruhr","no matching objects found"),
			"sa" => array("whois.nic.net.sa","No Match for"),
			"saarland" => array("whois.ksregistry.net","not found..."),
			"sb" => array("whois.nic.net.sb","Domain Status: No Object Found"),
			"sc" => array("whois2.afilias-grs.net","NOT FOUND"),
			"se" => array("whois.iis.se","not found."),
			"services" => array("whois.donuts.co","Domain not found."),
			"sexy" => array("whois.uniregistry.net","is available for"),
			"sg" => array("whois.sgnic.sg","Domain Not Found"),
			"sh" => array("whois.nic.sh","is available for purchase"),
			"shoes" => array("whois.donuts.co","Domain not found."),
			"si" => array("whois.arnes.si","No entries found"),
			"singles" => array("whois.donuts.co","Domain not found."),
			"sk" => array("whois.sk-nic.sk","Not found."),
			"sm" => array("whois.nic.sm","No entries found."),
			"sn" => array("whois.nic.sn","NOT FOUND"),
			"so" => array("whois.nic.so","DOMAIN NOT FOUND"),
			"social" => array("whois.unitedtld.com","Domain not found."),
			"solar" => array("whois.donuts.co","Domain not found."),
			"solutions" => array("whois.donuts.co","Domain not found."),
			"soy" => array("domain-registry-whois.l.google.com","Domain not found"),
			"st" => array("whois.nic.st","No entries found"),
			"su" => array("whois.tcinet.ru","No entries found"),
			"supplies" => array("whois.donuts.co","Domain not found."),
			"supply" => array("whois.donuts.co","Domain not found."),
			"support" => array("whois.donuts.co","Domain not found."),
			"sx" => array("whois.sx","Status: AVAILABLE"),
			"sy" => array("whois.tld.sy","Domain Status: Available"),
			"systems" => array("whois.donuts.co","Domain not found."),
			"tattoo" => array("whois.uniregistry.net","is available for registration"),
			"tc" => array("whois.meridiantld.net","Domain Status: No Object Found"),
			"technology" => array("whois.donuts.co","Domain not found."),
			"tel" => array("whois.nic.tel","Not found:"),
			"tf" => array("whois.nic.tf","No entries found"),
			"th" => array("whois.thnic.co.th","No match for"),
			"tienda" => array("whois.donuts.co","Domain not found."),
			"tips" => array("whois.donuts.co","Domain not found."),
			"tk" => array("whois.dot.tk","Invalid query or domain name not known"),
			"tl" => array("whois.nic.tl","Domain Status: No Object Found"),
			"tm" => array("whois.nic.tm","is available for purchase"),
			"tn" => array("whois.ati.tn","NO OBJECT FOUND!"),
			"to" => array("whois.tonic.to","No match for"),
			"today" => array("whois.donuts.co","Domain not found."),
			"tools" => array("whois.donuts.co","Domain not found."),
			"town" => array("whois.donuts.co","Domain not found."),
			"toys" => array("whois.donuts.co","Domain not found."),
			"tr" => array("whois.nic.tr","No match found for"),
			"training" => array("whois.donuts.co","Domain not found."),
			"travel" => array("whois.nic.travel","Not found:"),
			"tv" => array("tvwhois.verisign-grs.com","No match for"),
			"tw" => array("whois.twnic.net.tw","No Found"),
			"tz" => array("whois.tznic.or.tz","No entries found."),
			"ua" => array("whois.ua","No entries found for"),
			"ug" => array("whois.co.ug","No entries found for the selected source(s)."),
			"uk" => array("whois.nic.uk","This domain name has not been registered."),
			"university" => array("whois.donuts.co","Domain not found."),
			"us" => array("whois.nic.us","Not found"),
			"uy" => array("whois.nic.org.uy","No match for"),
			"black" => array("whois.afilias.net","NOT FOUND"),
			"blue" => array("whois.afilias.net","NOT FOUND"),
			"info" => array("whois.afilias.net","NOT FOUND"),
			"kim" => array("whois.afilias.net","NOT FOUND"),
			"pink" => array("whois.afilias.net","NOT FOUND"),
			"red" => array("whois.afilias.net","NOT FOUND"),
			"shiksha" => array("whois.afilias.net","NOT FOUND"),
			"uz" => array("whois.cctld.uz","not found in database"),
			"vacations" => array("whois.donuts.co","Domain not found."),
			"vc" => array("whois2.afilias-grs.net","NOT FOUND"),
			"ve" => array("whois.nic.ve","No match for"),
			"vegas" => array("whois.afilias-srs.net","NOT FOUND"),
			"ventures" => array("whois.donuts.co","Domain not found."),
			"vg" => array("ccwhois.ksregistry.net","not found..."),
			"viajes" => array("whois.donuts.co","Domain not found."),
			"villas" => array("whois.donuts.co","Domain not found."),
			"vision" => array("whois.donuts.co","Domain not found."),
			"vodka" => array("whois-dub.mm-registry.com","Status: Not Registered"),
			"voting" => array("whois.voting.tld-box.at","No match"),
			"voyage" => array("whois.donuts.co","Domain not found."),
			"vu" => array("vunic.vu","is not valid!"),
			"wang" => array("whois.gtld.knet.cn","No match"),
			"watch" => array("whois.donuts.co","Domain not found."),
			"wed" => array("whois.nic.wed","Domain Status: No Object Found"),
			"wf" => array("whois.nic.wf","No entries found in the AFNIC Database."),
			"wien" => array("whois.nic.wien","No match"),
			"wiki" => array("whois.nic.wiki","DOMAIN NOT FOUND"),
			"works" => array("whois.donuts.co","Domain not found."),
			"ws" => array("whois.website.ws","No match for"),
			"xxx" => array("whois.nic.xxx","NOT FOUND"),
			"xyz" => array("whois.nic.xyz","DOMAIN NOT FOUND"),
			"yt" => array("whois.nic.yt","No entries found in the AFNIC Database."),
			"ryukyu" => array("whois.nic.ryukyu", "DOMAIN NOT FOUND"),
			"zm" => array("whois.nic.zm","Domain Status: No Object Found"),
			"zone" => array( "whois.donuts.co","Domain not found.")
		);


		// gethostbyname returns the same string if it cant find the domain,
		// we do a further check to see if it is a false positive
		if (gethostbyname($domain) == $domain) {
			// get the TLD of the domain
			$tld = $this->get_tld($domain);

			// If an entry for the TLD exists in the whois array
			if (isset($whois_arr[$tld][0])) {
				// set the hostname for the whois server
				$whois_server = $whois_arr[$tld][0];

				// set the "domain not found" string
				$bad_string = $whois_arr[$tld][1];
			} else {
				// TODO: REFACTOR THIS
				// TLD is not in the whois array, die
				throw new Exception("WHOIS server not found for that TLD");
			}

			// Connect to whois server and get information
			$fp = fsockopen($whois_server, 43, $errno, $errstr, $timeout);
			if (!$fp) {
				// display the socket error if error reporting is enabled.
				if ($this->error_reporting) {
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
		$split = explode('.', $domain);

		if(count($split) === 0) {
			throw new Exception('Invalid domain extension');
		}
		return end($split);
	}
}

