<?php

namespace Helge\Tests;

use Helge\Client\SimpleWhoisClient;
use Helge\Loader\JsonLoader;
use Helge\Service\DomainAvailability;

/**
 * This class specifies functional tests that check that the servers in the included 'data/servers.json' works correctly
 */
class ServerDataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Helge\Service\DomainAvailability
     */
    protected $service;

    /**
     * @var JsonLoader
     */
    protected $jsonLoader;

    public function setup()
    {
        $whoisClient = new SimpleWhoisClient();
        $this->jsonLoader = new JsonLoader("src/data/servers.json");
        $this->service = new DomainAvailability($whoisClient, $this->getJsonLoader());
    }


    /**
     * This test checks that domains that are expected to be available are reported as such
     *
     * @param string $availableDomain
     *
     * @throws \Exception
     * @dataProvider availableDomainsProvider
     */
    public function testAvailableDomains($availableDomain)
    {
        $this->assertTrue(
            $this->getService()->isAvailable($availableDomain),
            'Domain \''.$availableDomain.'\' was expected to be reported available but was not'
        );
    }

    /**
     * Generates test cases for available domains iterating over all supported TLDs and adding 'helge-sverre-domain-availability'
     * as the next level of domain
     *
     * @return array
     */
    public function availableDomainsProvider()
    {
        $loader = new JsonLoader("src/data/servers.json");
        $cases = array();
        foreach (array_keys($loader->load()) as $TLD) {
            $cases[] = array('helge-sverre-domain-availability.'.$TLD);
        }
        return $cases;
    }


    /**
     * This test checks that domains that are known to be taken are correctly reported as not available
     *
     * @param string $testDomain
     *
     * @param string $tld
     *
     * @throws \Exception
     * @dataProvider nonAvailableDomainsProvider
     */
    public function testNonAvailableDomains($testDomain, $tld)
    {
        $this->assertFalse(
            $this->getService()->isAvailable($testDomain),
            'Domain \''.$testDomain.'\' for TLD \''.strtoupper($tld).'\' is expected to be registered but was '.
            'reported as available'
        );
    }

    /**
     * Effort needs to be made to only provide domains that are almost guaranteed to always be registered in order to avoid
     * false positives. Good examples include those domains used by the registrars themselves or domains of large companies
     * such as Google
     *
     * @return array
     */
    public function nonAvailableDomainsProvider()
    {
        return array(
            array('example.com', 'com'), // rfc2606
            array('example.net', 'net'), // rfc2606
            array('example.org', 'org'), // rfc2606

            // Google regional domains
            array('google.ac', 'ac'), // Ascension Island
            // array('google.ad', 'ad'), // Andorra (not yet supported)
            array('google.ae', 'ae'), // United Arab Emirates
            // array('google.com.af', 'com.af'), // Afghanistan (not yet supported)
            // array('google.com.ag', 'com.ag'), // Antigua and Barbuda (not yet supported)
            // array('google.com.ai', 'com.ai'), // Anguilla (not yet supported)
            // array('google.al', 'al'), // Albania (not yet supported)
            array('google.am', 'am'), // Armenia
            // array('google.co.ao', 'co.ao'), // Angola (not yet supported)
            // array('google.com.ar', 'com.ar'), // Argentina (not yet supported)
            array('google.as', 'as'), // American Samoa
            array('google.at', 'at'), // Austria
            // array('google.com.au', 'com.au'), // Australia (not yet supported)
            array('google.az', 'az'), // Azerbaijan
            // array('google.ba', 'ba'), // Bosnia and Herzegovina (not yet supported)
            // array('google.com.bd', 'com.bd'), // Bangladesh (not yet supported)
            array('google.be', 'be'), // Belgium
            // array('google.bf', 'bf'), // Burkina Faso (not yet supported)
            array('google.bg', 'bg'), // Bulgaria
            // array('google.com.bh', 'com.bh'), // Bahrain (not yet supported)
            array('google.bi', 'bi'), // Burundi
            array('google.bj', 'bj'), // Benin
            array('google.com.bn', 'com.bn'), // Brunei (not yet supported)
            // array('google.com.bo', 'com.bo'), // Bolivia (not yet supported)
            // array('google.com.br', 'com.br'), // Brazil (not yet supported)
            // array('google.bs', 'bs'), // Bahamas (not yet supported)
            // array('google.bt', 'bt'), // Bhutan (not yet supported)
            // array('google.co.bw', 'co.bw'), // Botswana (not yet supported)
            array('google.by', 'by'), // Belarus
            // array('google.com.bz', 'com.bz'), // Belize (not yet supported)
            array('google.ca', 'ca'), // Canada
            // array('google.com.kh', 'com.kh'), // Cambodia (not yet supported)
            array('google.cc', 'cc'), // Cocos (Keeling) Islands
            // array('google.cd', 'cd'), // Democratic Republic of the Congo (not yet supported)
            array('google.cf', 'cf'), // Central African Republic
            array('google.cat', 'cat'), // Catalan Countries
            // array('google.cg', 'cg'), // Republic of the Congo (not yet supported)
            array('google.ch', 'ch'), // Switzerland
            array('google.ci', 'ci'), // Ivory Coast
            // array('google.co.ck', 'co.ck'), // Cook Islands (not yet supported)
            array('google.cl', 'cl'), // Chile
            // array('google.cm', 'cm'), // Cameroon (not yet supported)
            array('google.cn', 'cn'), // China
            // array('google.com.co', 'com.co'), // Colombia (not yet supported)
            // array('google.co.cr', 'co.cr'), // Costa Rica (not yet supported)
            // array('google.com.cu', 'com.cu'), // Cuba (not yet supported)
            // array('google.cv', 'cv'), // Cape Verde (not yet supported)
            // array('google.com.cy', 'com.cy'), // Cyprus (not yet supported)
            array('google.cz', 'cz'), // Czech Republic
            array('google.de', 'de'), // Germany
            // array('google.dj', 'dj'), // Djibouti (not yet supported)
            array('google.dk', 'dk'), // Denmark
            array('google.dm', 'dm'), // Dominica
            // array('google.com.do', 'com.do'), // Dominican Republic (not yet supported)
            array('google.dz', 'dz'), // Algeria
            // array('google.com.ec', 'com.ec'), // Ecuador (not yet supported)
            array('google.ee', 'ee'), // Estonia
            // array('google.com.eg', 'com.eg'), // Egypt (not yet supported)
            array('google.es', 'es'), // Spain
            // array('google.com.et', 'com.et'), // Ethiopia (not yet supported)
            array('google.fi', 'fi'), // Finland
            // array('google.com.fj', 'com.fj'), // Fiji (not yet supported)
            // array('google.fm', 'fm'), // Federated States of Micronesia (not yet supported)
            array('google.fr', 'fr'), // France
            array('google.ga', 'ga'), // Gabon
            // array('google.ge', 'ge'), // Georgia (not yet supported)
            // array('google.gf', 'gf'), // French Guiana (not yet supported)
            array('google.gg', 'gg'), // Guernsey
            // array('google.com.gh', 'com.gh'), // Ghana (not yet supported)
            // array('google.com.gi', 'com.gi'), // Gibraltar (not yet supported)
            array('google.gl', 'gl'), // Greenland
            // array('google.gm', 'gm'), // Gambia (not yet supported)
            // array('google.gp', 'gp'), // Guadeloupe (not yet supported)
            // array('google.gr', 'gr'), // Greece (not yet supported)
            // array('google.com.gt', 'com.gt'), // Guatemala (not yet supported)
            array('google.gy', 'gy'), // Guyana
            // array('google.com.hk', 'com.hk'), // Hong Kong (not yet supported)
            array('google.hn', 'hn'), // Honduras
            array('google.hr', 'hr'), // Croatia
            array('google.ht', 'ht'), // Haiti
            array('google.hu', 'hu'), // Hungary
            // array('google.co.id', 'co.id'), // Indonesia (not yet supported)
            array('google.iq', 'iq'), // Iraq
            array('google.ie', 'ie'), // Ireland
            // array('google.co.il', 'co.il'), // Israel (not yet supported)
            array('google.im', 'im'), // Isle of Man
            array('google.co.in', 'co.in'), // India
            array('google.io', 'io'), // British Indian Ocean Territory
            array('google.is', 'is'), // Iceland
            array('google.it', 'it'), // Italy
            array('google.je', 'je'), // Jersey
            // array('google.com.jm', 'com.jm'), // Jamaica (not yet supported)
            // array('google.jo', 'jo'), // Jordan (not yet supported)
            // array('google.co.jp', 'co.jp'), // Japan (not yet supported)
            // array('google.co.ke', 'co.ke'), // Kenya (not yet supported)
            array('google.ki', 'ki'), // Kiribati
            array('google.kg', 'kg'), // Kyrgyzstan
            // array('google.co.kr', 'co.kr'), // South Korea (not yet supported)
            // array('google.com.kw', 'com.kw'), // Kuwait (not yet supported)
            array('google.kz', 'kz'), // Kazakhstan
            array('google.la', 'la'), // Laos
            // array('google.com.lb', 'com.lb'), // Lebanon (not yet supported)
            // array('google.com.lc', 'com.lc'), // Saint Lucia (not yet supported)
            array('google.li', 'li'), // Liechtenstein
            // array('google.lk', 'lk'), // Sri Lanka (not yet supported)
            // array('google.co.ls', 'co.ls'), // Lesotho (not yet supported)
            array('google.lt', 'lt'), // Lithuania
            array('google.lu', 'lu'), // Luxembourg
            array('google.lv', 'lv'), // Latvia
            // array('google.com.ly', 'com.ly'), // Libya (not yet supported)
            // array('google.co.ma', 'co.ma'), // Morocco (not yet supported)
            array('google.md', 'md'), // Moldova
            array('google.me', 'me'), // Montenegro
            array('google.mg', 'mg'), // Madagascar
            array('google.mk', 'mk'), // Macedonia
            array('google.ml', 'ml'), // Mali
            // array('google.com.mm', 'com.mm'), // Myanmar (not yet supported)
            array('google.mn', 'mn'), // Mongolia
            array('google.ms', 'ms'), // Montserrat
            // array('google.com.mt', 'com.mt'), // Malta (not yet supported)
            array('google.mu', 'mu'), // Mauritius
            // array('google.mv', 'mv'), // Maldives (not yet supported)
            // array('google.mw', 'mw'), // Malawi (not yet supported)
            // array('google.com.mx', 'com.mx'), // Mexico (not yet supported)
            // array('google.com.my', 'com.my'), // Malaysia (not yet supported)
            // array('google.co.mz', 'co.mz'), // Mozambique (not yet supported)
            // array('google.com.na', 'com.na'), // Namibia (not yet supported)
            // array('google.ne', 'ne'), // Niger (not yet supported)
            // array('google.com.nf', 'com.nf'), // Norfolk Island (not yet supported)
            // array('google.com.ng', 'com.ng'), // Nigeria (not yet supported)
            // array('google.com.ni', 'com.ni'), // Nicaragua (not yet supported)
            array('google.nl', 'nl'), // Netherlands
            array('google.no', 'no'), // Norway
            // array('google.com.np', 'com.np'), // Nepal (not yet supported)
            // array('google.nr', 'nr'), // Nauru (not yet supported)
            array('google.nu', 'nu'), // Niue
            // array('google.co.nz', 'co.nz'), // New Zealand (not yet supported)
            // array('google.com.om', 'com.om'), // Oman (not yet supported)
            // array('google.com.pk', 'com.pk'), // Pakistan (not yet supported)
            // array('google.com.pa', 'com.pa'), // Panama (not yet supported)
            // array('google.com.pe', 'com.pe'), // Peru (not yet supported)
            // array('google.com.ph', 'com.ph'), // Philippines (not yet supported)
            array('google.pl', 'pl'), // Poland
            // array('google.com.pg', 'com.pg'), // Papua New Guinea (not yet supported)
            // array('google.pn', 'pn'), // Pitcairn Islands (not yet supported)
            // array('google.com.pr', 'com.pr'), // Puerto Rico (not yet supported)
            // array('google.ps', 'ps'), // Palestine[4] (not yet supported)
            array('google.pt', 'pt'), // Portugal
            // array('google.com.py', 'com.py'), // Paraguay (not yet supported)
            // array('google.com.qa', 'com.qa'), // Qatar (not yet supported)
            array('google.ro', 'ro'), // Romania
            array('google.rs', 'rs'), // Serbia
            array('google.ru', 'ru'), // Russia
            // array('google.rw', 'rw'), // Rwanda (not yet supported)
            // array('google.com.sa', 'com.sa'), // Saudi Arabia (not yet supported)
            // array('google.com.sb', 'com.sb'), // Solomon Islands (not yet supported)
            array('google.sc', 'sc'), // Seychelles
            array('google.se', 'se'), // Sweden
            // array('google.com.sg', 'com.sg'), // Singapore (not yet supported)
            array('google.sh', 'sh'), // Saint Helena, Ascension and Tristan da Cunha
            array('google.si', 'si'), // Slovenia
            array('google.sk', 'sk'), // Slovakia
            // array('google.com.sl', 'com.sl'), // Sierra Leone (not yet supported)
            array('google.sn', 'sn'), // Senegal
            array('google.sm', 'sm'), // San Marino
            array('google.so', 'so'), // Somalia
            array('google.st', 'st'), // São Tomé and Príncipe
            // array('google.sr', 'sr'), // Suriname (not yet supported)
            // array('google.com.sv', 'com.sv'), // El Salvador (not yet supported)
            // array('google.td', 'td'), // Chad (not yet supported)
            // array('google.tg', 'tg'), // Togo (not yet supported)
            // array('google.co.th', 'co.th'), // Thailand (not yet supported)
            // array('google.com.tj', 'com.tj'), // Tajikistan (not yet supported)
            array('google.tk', 'tk'), // Tokelau
            array('google.tl', 'tl'), // Timor-Leste
            array('google.tm', 'tm'), // Turkmenistan
            array('google.to', 'to'), // Tonga
            array('google.tn', 'tn'), // Tunisia
            // array('google.com.tr', 'com.tr'), // Turkey (not yet supported)
            // array('google.tt', 'tt'), // Trinidad and Tobago (not yet supported)
            // array('google.com.tw', 'com.tw'), // Taiwan (not yet supported)
            // array('google.co.tz', 'co.tz'), // Tanzania (not yet supported)
            // array('google.com.ua', 'com.ua'), // Ukraine (not yet supported)
            // array('google.co.ug', 'co.ug'), // Uganda (not yet supported)
            array('google.co.uk', 'co.uk'), // United Kingdom
            array('google.com', 'com'), // United States
            // array('google.com.uy', 'com.uy'), // Uruguay (not yet supported)
            // array('google.co.uz', 'co.uz'), // Uzbekistan (not yet supported)
            // array('google.com.vc', 'com.vc'), // Saint Vincent and the Grenadines (not yet supported)
            // array('google.co.ve', 'co.ve'), // Venezuela (not yet supported)
            array('google.vg', 'vg'), // British Virgin Islands
            // array('google.co.vi', 'co.vi'), // United States Virgin Islands (not yet supported)
            // array('google.com.vn', 'com.vn'), // Vietnam (not yet supported)
            array('google.vu', 'vu'), // Vanuatu
            array('google.ws', 'ws'), // Samoa
            array('google.co.za', 'co.za'), // South Africa
            // array('google.co.zm', 'co.zm'), // Zambia (not yet supported)
            // array('google.co.zw', 'co.zw'), // Zimbabwe (not yet supported)

            // WHOIS Server Domains
            array('whois.aero', 'aero'),
            array('whois.nic.af', 'af'),
            array('whois.nic.ag', 'ag'),
            array('whois.ai', 'ai'),
            array('whois.nic.asia', 'asia'),
            array('whois.nic.aw', 'aw'),
            array('whois.ax', 'ax'),
            array('whois.nic.bar', 'bar'),
            array('whois.nic.berlin', 'berlin'),
            array('whois.biz', 'biz'),
            array('whois.nic.build', 'build'),
            array('whois.nic.net.bw', 'bw'),
            array('whois.nic.ceo', 'ceo'),
            array('whois.nic.club', 'club'),
            array('whois.nic.co', 'co'),
            array('whois.nic.coop', 'coop'),
            array('whois.nic.cx', 'cx'),
            array('whois.educause.edu', 'edu'),
            array('whois.eu', 'eu'),
            array('whois.nic.fo', 'fo'),
            array('whois.nic.gd', 'gd'),
            array('whois.dotgov.gov', 'gov'),
            array('whois.nic.gs', 'gs'),
            array('whois.hkirc.hk', 'hk'),
            array('whois.nic.ir', 'ir'),
            array('whois.jprs.jp', 'jp'),
            array('whois.kr', 'kr'),
            array('whois.nic.luxury', 'luxury'),
            array('whois.nic.ly', 'ly'),
            array('whois.nic.menu', 'menu'),
            array('whois.monic.mo', 'mo'),
            array('whois.nic.monash', 'monash'),
            array('whois.museum', 'museum'),
            array('whois.mx', 'mx'),
            array('whois.nic.name', 'name'),
            array('whois.nc', 'nc'),
            array('whois.nic.nf', 'nf'),
            array('whois.registry.om', 'om'),
            array('kero.yachay.pe', 'pe'),
            array('whois.registry.pf', 'pf'),
            array('whois.nic.pm', 'pm'),
            array('whois.nic.pr', 'pr'),
            array('whois.nic.pw', 'pw'),
            array('whois.registry.qa', 'qa'),
            array('whois.nic.re', 're'),
            array('whois.nic.ruhr', 'ruhr'),
            array('whois.sgnic.sg', 'sg'),
            array('whois.sx', 'sx'),
            array('whois.tld.sy', 'sy'),
            array('whois.nic.tel', 'tel'),
            array('whois.nic.tf', 'tf'),
            array('whois.nic.tr', 'tr'),
            array('whois.nic.travel', 'travel'),
            array('whois.ua', 'ua'),
            array('whois.nic.uk', 'uk'),
            array('whois.nic.us', 'us'),
            array('whois.cctld.uz', 'uz'),
            array('whois.nic.ve', 've'),
            array('whois.nic.wed', 'wed'),
            array('whois.nic.wf', 'wf'),
            array('whois.nic.wien', 'wien'),
            array('whois.nic.wiki', 'wiki'),
            array('whois.nic.xxx', 'xxx'),
            array('whois.nic.xyz', 'xyz'),
            array('whois.nic.yt', 'yt'),
            array('whois.nic.ryukyu', 'ryukyu'),
            array('net-whois.registry.net.za', 'net.za'),
            array('whois.nic.joburg', 'joburg'),
            array('whois.nic.durban', 'durban'),
            array('whois.nic.capetown', 'capetown'),

            // Registry Sites
            array('isoc.org.il', 'org.il'),

            // Registrar Sites
            array('pandi.id', 'id'),
            array('indoreg.co.id', 'co.id'),
            array('internic.co.il', 'co.il'),
            array('get.mp', 'mp'),
            array('nic.ec', 'ec'),

            // TLDs missing example test domains
            // computer
            // academy
            // actor
            // agency
            // archi
            // arpa
            // associates
            // bargains
            // bike
            // blackfriday
            // boutique
            // builders
            // cab
            // camera
            // camp
            // captial
            // cards
            // careers
            // catering
            // center
            // cheap
            // christmas
            // cleaning
            // clothing
            // codes
            // coffee
            // college
            // cologne
            // community
            // company
            // construction
            // contractors
            // cooking
            // cool
            // country
            // cruises
            // dating
            // democrat
            // desi
            // diamonds
            // directory
            // domains
            // education
            // email
            // engineering
            // enterprises
            // equipment
            // estate
            // eus
            // events
            // expert
            // exposed
            // farm
            // feedback
            // fish
            // fishing
            // flights
            // florist
            // foo
            // foundation
            // frogans
            // futbol
            // gal
            // gi
            // gift
            // glass
            // gop
            // graphics
            // gripe
            // guitars
            // guru
            // haus
            // holiday
            // horse
            // house
            // immobilien
            // in
            // industries
            // institute
            // int
            // international
            // jobs
            // kaufen
            // kitchen
            // kiwi
            // koeln
            // land
            // lease
            // lighting
            // limo
            // link
            // london
            // management
            // mango
            // marketing
            // media
            // miami
            // mobi
            // moda
            // ninja
            // onl
            // paris
            // partners
            // parts
            // photo
            // photography
            // photos
            // pics
            // pictures
            // plumbing
            // post
            // pro
            // productions
            // properties
            // pub
            // quebec
            // recipes
            // reisen
            // rentals
            // repair
            // report
            // rest
            // reviews
            // rich
            // rocks
            // rodeo
            // saarland
            // services
            // sexy
            // shoes
            // singles
            // social
            // solar
            // solutions
            // soy
            // su
            // supplies
            // supply
            // support
            // systems
            // tattoo
            // tc
            // technology
            // tienda
            // tips
            // today
            // tools
            // town
            // toys
            // training
            // tv
            // university
            // black
            // blue
            // info
            // kim
            // pink
            // red
            // shiksha
            // vacations
            // vc
            // vegas
            // ventures
            // viajes
            // villas
            // vision
            // vodka
            // voting
            // voyage
            // wang
            // watch
            // works
            // zone
            // org.za
            // web.za
            // edu.bn
            // org.bn
            // net.bn
            // au
            // il
            // ke
            // ma
            // na
            // ng
            // nz
            // sa
            // sb
            // th
            // tw
            // tz
            // ug
            // uy
            // zm
            // my

        );
    }

    /**
     * @return DomainAvailability
     */
    protected function getService()
    {
        return $this->service;
    }

    /**
     * @return JsonLoader
     */
    protected function getJsonLoader()
    {
        return $this->jsonLoader;
    }
}
