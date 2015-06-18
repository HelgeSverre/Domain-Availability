<?php

require_once("./src/AvailabilityService.php");


class TldExtractionTest extends PHPUnit_Framework_TestCase
{

	private $service;

    public function __construct()
    {
        $this->service = new HelgeSverre\DomainAvailability\AvailabilityService();
    }



    public function testExtensionExtraction()
    {
        $available = $this->service->getTld("helgesverre.com");
        $this->assertEquals($available, "com");

        $available = $this->service->getTld("helgesverre.net");
        $this->assertEquals($available, "net");

        $available = $this->service->getTld("helgesverre.org");
        $this->assertEquals($available, "org");

        $available = $this->service->getTld("helgesverre.co");
        $this->assertEquals($available, "co");

        $available = $this->service->getTld("helgesverre.io");
        $this->assertEquals($available, "io");

        $available = $this->service->getTld("helgesverre.computer");
        $this->assertEquals($available, "computer");

        $available = $this->service->getTld("helgesverre.ac");
        $this->assertEquals($available, "ac");

        $available = $this->service->getTld("helgesverre.co.uk");
        $this->assertEquals($available, "uk");

        $available = $this->service->getTld("helgesverre.org.uk");
        $this->assertEquals($available, "uk");

        $available = $this->service->getTld("helgesverre.academy");
        $this->assertEquals($available, "academy");

        $available = $this->service->getTld("helgesverre.actor");
        $this->assertEquals($available, "actor");

        $available = $this->service->getTld("helgesverre.ae");
        $this->assertEquals($available, "ae");

        $available = $this->service->getTld("helgesverre.aero");
        $this->assertEquals($available, "aero");

        $available = $this->service->getTld("helgesverre.af");
        $this->assertEquals($available, "af");

        $available = $this->service->getTld("helgesverre.ag");
        $this->assertEquals($available, "ag");

        $available = $this->service->getTld("helgesverre.agency");
        $this->assertEquals($available, "agency");

        $available = $this->service->getTld("helgesverre.ai");
        $this->assertEquals($available, "ai");

        $available = $this->service->getTld("helgesverre.am");
        $this->assertEquals($available, "am");

        $available = $this->service->getTld("helgesverre.archi");
        $this->assertEquals($available, "archi");

        $available = $this->service->getTld("helgesverre.arpa");
        $this->assertEquals($available, "arpa");

        $available = $this->service->getTld("helgesverre.as");
        $this->assertEquals($available, "as");

        $available = $this->service->getTld("helgesverre.asia");
        $this->assertEquals($available, "asia");

        $available = $this->service->getTld("helgesverre.associates");
        $this->assertEquals($available, "associates");

        $available = $this->service->getTld("helgesverre.at");
        $this->assertEquals($available, "at");

        $available = $this->service->getTld("helgesverre.au");
        $this->assertEquals($available, "au");

        $available = $this->service->getTld("helgesverre.aw");
        $this->assertEquals($available, "aw");

        $available = $this->service->getTld("helgesverre.ax");
        $this->assertEquals($available, "ax");

        $available = $this->service->getTld("helgesverre.az");
        $this->assertEquals($available, "az");

        $available = $this->service->getTld("helgesverre.bar");
        $this->assertEquals($available, "bar");

        $available = $this->service->getTld("helgesverre.bargains");
        $this->assertEquals($available, "bargains");

        $available = $this->service->getTld("helgesverre.bayern");
        $this->assertEquals($available, "bayern");

        $available = $this->service->getTld("helgesverre.be");
        $this->assertEquals($available, "be");

        $available = $this->service->getTld("helgesverre.berlin");
        $this->assertEquals($available, "berlin");

        $available = $this->service->getTld("helgesverre.bg");
        $this->assertEquals($available, "bg");

        $available = $this->service->getTld("helgesverre.bi");
        $this->assertEquals($available, "bi");

        $available = $this->service->getTld("helgesverre.bike");
        $this->assertEquals($available, "bike");

        $available = $this->service->getTld("helgesverre.biz");
        $this->assertEquals($available, "biz");

        $available = $this->service->getTld("helgesverre.bj");
        $this->assertEquals($available, "bj");

        $available = $this->service->getTld("helgesverre.blackfriday");
        $this->assertEquals($available, "blackfriday");

        $available = $this->service->getTld("helgesverre.bn");
        $this->assertEquals($available, "bn");

        $available = $this->service->getTld("helgesverre.boutique");
        $this->assertEquals($available, "boutique");

        $available = $this->service->getTld("helgesverre.build");
        $this->assertEquals($available, "build");

        $available = $this->service->getTld("helgesverre.builders");
        $this->assertEquals($available, "builders");

        $available = $this->service->getTld("helgesverre.bw");
        $this->assertEquals($available, "bw");

        $available = $this->service->getTld("helgesverre.by");
        $this->assertEquals($available, "by");

        $available = $this->service->getTld("helgesverre.ca");
        $this->assertEquals($available, "ca");

        $available = $this->service->getTld("helgesverre.cab");
        $this->assertEquals($available, "cab");

        $available = $this->service->getTld("helgesverre.camera");
        $this->assertEquals($available, "camera");

        $available = $this->service->getTld("helgesverre.camp");
        $this->assertEquals($available, "camp");

        $available = $this->service->getTld("helgesverre.captial");
        $this->assertEquals($available, "captial");

        $available = $this->service->getTld("helgesverre.cards");
        $this->assertEquals($available, "cards");

        $available = $this->service->getTld("helgesverre.careers");
        $this->assertEquals($available, "careers");

        $available = $this->service->getTld("helgesverre.cat");
        $this->assertEquals($available, "cat");

        $available = $this->service->getTld("helgesverre.catering");
        $this->assertEquals($available, "catering");

        $available = $this->service->getTld("helgesverre.cc");
        $this->assertEquals($available, "cc");

        $available = $this->service->getTld("helgesverre.center");
        $this->assertEquals($available, "center");

        $available = $this->service->getTld("helgesverre.ceo");
        $this->assertEquals($available, "ceo");

        $available = $this->service->getTld("helgesverre.cf");
        $this->assertEquals($available, "cf");

        $available = $this->service->getTld("helgesverre.ch");
        $this->assertEquals($available, "ch");

        $available = $this->service->getTld("helgesverre.cheap");
        $this->assertEquals($available, "cheap");

        $available = $this->service->getTld("helgesverre.christmas");
        $this->assertEquals($available, "christmas");

        $available = $this->service->getTld("helgesverre.ci");
        $this->assertEquals($available, "ci");

        $available = $this->service->getTld("helgesverre.cl");
        $this->assertEquals($available, "cl");

        $available = $this->service->getTld("helgesverre.cleaning");
        $this->assertEquals($available, "cleaning");

        $available = $this->service->getTld("helgesverre.clothing");
        $this->assertEquals($available, "clothing");

        $available = $this->service->getTld("helgesverre.club");
        $this->assertEquals($available, "club");

        $available = $this->service->getTld("helgesverre.cn");
        $this->assertEquals($available, "cn");

        $available = $this->service->getTld("helgesverre.co");
        $this->assertEquals($available, "co");

        $available = $this->service->getTld("helgesverre.codes");
        $this->assertEquals($available, "codes");

        $available = $this->service->getTld("helgesverre.coffee");
        $this->assertEquals($available, "coffee");

        $available = $this->service->getTld("helgesverre.college");
        $this->assertEquals($available, "college");

        $available = $this->service->getTld("helgesverre.cologne");
        $this->assertEquals($available, "cologne");

        $available = $this->service->getTld("helgesverre.community");
        $this->assertEquals($available, "community");

        $available = $this->service->getTld("helgesverre.company");
        $this->assertEquals($available, "company");

        $available = $this->service->getTld("helgesverre.construction");
        $this->assertEquals($available, "construction");

        $available = $this->service->getTld("helgesverre.contractors");
        $this->assertEquals($available, "contractors");

        $available = $this->service->getTld("helgesverre.cooking");
        $this->assertEquals($available, "cooking");

        $available = $this->service->getTld("helgesverre.cool");
        $this->assertEquals($available, "cool");

        $available = $this->service->getTld("helgesverre.coop");
        $this->assertEquals($available, "coop");

        $available = $this->service->getTld("helgesverre.country");
        $this->assertEquals($available, "country");

        $available = $this->service->getTld("helgesverre.cruises");
        $this->assertEquals($available, "cruises");

        $available = $this->service->getTld("helgesverre.cx");
        $this->assertEquals($available, "cx");

        $available = $this->service->getTld("helgesverre.cz");
        $this->assertEquals($available, "cz");

        $available = $this->service->getTld("helgesverre.dating");
        $this->assertEquals($available, "dating");

        $available = $this->service->getTld("helgesverre.de");
        $this->assertEquals($available, "de");

        $available = $this->service->getTld("helgesverre.democrat");
        $this->assertEquals($available, "democrat");

        $available = $this->service->getTld("helgesverre.desi");
        $this->assertEquals($available, "desi");

        $available = $this->service->getTld("helgesverre.diamonds");
        $this->assertEquals($available, "diamonds");

        $available = $this->service->getTld("helgesverre.directory");
        $this->assertEquals($available, "directory");

        $available = $this->service->getTld("helgesverre.dk");
        $this->assertEquals($available, "dk");

        $available = $this->service->getTld("helgesverre.dm");
        $this->assertEquals($available, "dm");

        $available = $this->service->getTld("helgesverre.domains");
        $this->assertEquals($available, "domains");

        $available = $this->service->getTld("helgesverre.dz");
        $this->assertEquals($available, "dz");

        $available = $this->service->getTld("helgesverre.ec");
        $this->assertEquals($available, "ec");

        $available = $this->service->getTld("helgesverre.edu");
        $this->assertEquals($available, "edu");

        $available = $this->service->getTld("helgesverre.education");
        $this->assertEquals($available, "education");

        $available = $this->service->getTld("helgesverre.ee");
        $this->assertEquals($available, "ee");

        $available = $this->service->getTld("helgesverre.email");
        $this->assertEquals($available, "email");

        $available = $this->service->getTld("helgesverre.engineering");
        $this->assertEquals($available, "engineering");

        $available = $this->service->getTld("helgesverre.enterprises");
        $this->assertEquals($available, "enterprises");

        $available = $this->service->getTld("helgesverre.equipment");
        $this->assertEquals($available, "equipment");

        $available = $this->service->getTld("helgesverre.es");
        $this->assertEquals($available, "es");

        $available = $this->service->getTld("helgesverre.estate");
        $this->assertEquals($available, "estate");

        $available = $this->service->getTld("helgesverre.eu");
        $this->assertEquals($available, "eu");

        $available = $this->service->getTld("helgesverre.eus");
        $this->assertEquals($available, "eus");

        $available = $this->service->getTld("helgesverre.events");
        $this->assertEquals($available, "events");

        $available = $this->service->getTld("helgesverre.expert");
        $this->assertEquals($available, "expert");

        $available = $this->service->getTld("helgesverre.exposed");
        $this->assertEquals($available, "exposed");

        $available = $this->service->getTld("helgesverre.farm");
        $this->assertEquals($available, "farm");

        $available = $this->service->getTld("helgesverre.feedback");
        $this->assertEquals($available, "feedback");

        $available = $this->service->getTld("helgesverre.fi");
        $this->assertEquals($available, "fi");

        $available = $this->service->getTld("helgesverre.fish");
        $this->assertEquals($available, "fish");

        $available = $this->service->getTld("helgesverre.fishing");
        $this->assertEquals($available, "fishing");

        $available = $this->service->getTld("helgesverre.flights");
        $this->assertEquals($available, "flights");

        $available = $this->service->getTld("helgesverre.florist");
        $this->assertEquals($available, "florist");

        $available = $this->service->getTld("helgesverre.fo");
        $this->assertEquals($available, "fo");

        $available = $this->service->getTld("helgesverre.foo");
        $this->assertEquals($available, "foo");

        $available = $this->service->getTld("helgesverre.foundation");
        $this->assertEquals($available, "foundation");

        $available = $this->service->getTld("helgesverre.fr");
        $this->assertEquals($available, "fr");

        $available = $this->service->getTld("helgesverre.frogans");
        $this->assertEquals($available, "frogans");

        $available = $this->service->getTld("helgesverre.futbol");
        $this->assertEquals($available, "futbol");

        $available = $this->service->getTld("helgesverre.ga");
        $this->assertEquals($available, "ga");

        $available = $this->service->getTld("helgesverre.gal");
        $this->assertEquals($available, "gal");

        $available = $this->service->getTld("helgesverre.gd");
        $this->assertEquals($available, "gd");

        $available = $this->service->getTld("helgesverre.gg");
        $this->assertEquals($available, "gg");

        $available = $this->service->getTld("helgesverre.gi");
        $this->assertEquals($available, "gi");

        $available = $this->service->getTld("helgesverre.gift");
        $this->assertEquals($available, "gift");

        $available = $this->service->getTld("helgesverre.gl");
        $this->assertEquals($available, "gl");

        $available = $this->service->getTld("helgesverre.glass");
        $this->assertEquals($available, "glass");

        $available = $this->service->getTld("helgesverre.gop");
        $this->assertEquals($available, "gop");

        $available = $this->service->getTld("helgesverre.gov");
        $this->assertEquals($available, "gov");

        $available = $this->service->getTld("helgesverre.graphics");
        $this->assertEquals($available, "graphics");

        $available = $this->service->getTld("helgesverre.gripe");
        $this->assertEquals($available, "gripe");

        $available = $this->service->getTld("helgesverre.gs");
        $this->assertEquals($available, "gs");

        $available = $this->service->getTld("helgesverre.guitars");
        $this->assertEquals($available, "guitars");

        $available = $this->service->getTld("helgesverre.guru");
        $this->assertEquals($available, "guru");

        $available = $this->service->getTld("helgesverre.gy");
        $this->assertEquals($available, "gy");

        $available = $this->service->getTld("helgesverre.haus");
        $this->assertEquals($available, "haus");

        $available = $this->service->getTld("helgesverre.hk");
        $this->assertEquals($available, "hk");

        $available = $this->service->getTld("helgesverre.hn");
        $this->assertEquals($available, "hn");

        $available = $this->service->getTld("helgesverre.holiday");
        $this->assertEquals($available, "holiday");

        $available = $this->service->getTld("helgesverre.horse");
        $this->assertEquals($available, "horse");

        $available = $this->service->getTld("helgesverre.house");
        $this->assertEquals($available, "house");

        $available = $this->service->getTld("helgesverre.hr");
        $this->assertEquals($available, "hr");

        $available = $this->service->getTld("helgesverre.ht");
        $this->assertEquals($available, "ht");

        $available = $this->service->getTld("helgesverre.hu");
        $this->assertEquals($available, "hu");

        $available = $this->service->getTld("helgesverre.id");
        $this->assertEquals($available, "id");

        $available = $this->service->getTld("helgesverre.ie");
        $this->assertEquals($available, "ie");

        $available = $this->service->getTld("helgesverre.il");
        $this->assertEquals($available, "il");

        $available = $this->service->getTld("helgesverre.im");
        $this->assertEquals($available, "im");

        $available = $this->service->getTld("helgesverre.immobilien");
        $this->assertEquals($available, "immobilien");

        $available = $this->service->getTld("helgesverre.in");
        $this->assertEquals($available, "in");

        $available = $this->service->getTld("helgesverre.industries");
        $this->assertEquals($available, "industries");

        $available = $this->service->getTld("helgesverre.institute");
        $this->assertEquals($available, "institute");

        $available = $this->service->getTld("helgesverre.int");
        $this->assertEquals($available, "int");

        $available = $this->service->getTld("helgesverre.international");
        $this->assertEquals($available, "international");

        $available = $this->service->getTld("helgesverre.iq");
        $this->assertEquals($available, "iq");

        $available = $this->service->getTld("helgesverre.ir");
        $this->assertEquals($available, "ir");

        $available = $this->service->getTld("helgesverre.is");
        $this->assertEquals($available, "is");

        $available = $this->service->getTld("helgesverre.it");
        $this->assertEquals($available, "it");

        $available = $this->service->getTld("helgesverre.je");
        $this->assertEquals($available, "je");

        $available = $this->service->getTld("helgesverre.jobs");
        $this->assertEquals($available, "jobs");

        $available = $this->service->getTld("helgesverre.jp");
        $this->assertEquals($available, "jp");

        $available = $this->service->getTld("helgesverre.kaufen");
        $this->assertEquals($available, "kaufen");

        $available = $this->service->getTld("helgesverre.ke");
        $this->assertEquals($available, "ke");

        $available = $this->service->getTld("helgesverre.kg");
        $this->assertEquals($available, "kg");

        $available = $this->service->getTld("helgesverre.ki");
        $this->assertEquals($available, "ki");

        $available = $this->service->getTld("helgesverre.kitchen");
        $this->assertEquals($available, "kitchen");

        $available = $this->service->getTld("helgesverre.kiwi");
        $this->assertEquals($available, "kiwi");

        $available = $this->service->getTld("helgesverre.koeln");
        $this->assertEquals($available, "koeln");

        $available = $this->service->getTld("helgesverre.kr");
        $this->assertEquals($available, "kr");

        $available = $this->service->getTld("helgesverre.kz");
        $this->assertEquals($available, "kz");

        $available = $this->service->getTld("helgesverre.la");
        $this->assertEquals($available, "la");

        $available = $this->service->getTld("helgesverre.land");
        $this->assertEquals($available, "land");

        $available = $this->service->getTld("helgesverre.lease");
        $this->assertEquals($available, "lease");

        $available = $this->service->getTld("helgesverre.li");
        $this->assertEquals($available, "li");

        $available = $this->service->getTld("helgesverre.lighting");
        $this->assertEquals($available, "lighting");

        $available = $this->service->getTld("helgesverre.limo");
        $this->assertEquals($available, "limo");

        $available = $this->service->getTld("helgesverre.link");
        $this->assertEquals($available, "link");

        $available = $this->service->getTld("helgesverre.london");
        $this->assertEquals($available, "london");

        $available = $this->service->getTld("helgesverre.lt");
        $this->assertEquals($available, "lt");

        $available = $this->service->getTld("helgesverre.lu");
        $this->assertEquals($available, "lu");

        $available = $this->service->getTld("helgesverre.luxury");
        $this->assertEquals($available, "luxury");

        $available = $this->service->getTld("helgesverre.lv");
        $this->assertEquals($available, "lv");

        $available = $this->service->getTld("helgesverre.ly");
        $this->assertEquals($available, "ly");

        $available = $this->service->getTld("helgesverre.ma");
        $this->assertEquals($available, "ma");

        $available = $this->service->getTld("helgesverre.management");
        $this->assertEquals($available, "management");

        $available = $this->service->getTld("helgesverre.mango");
        $this->assertEquals($available, "mango");

        $available = $this->service->getTld("helgesverre.marketing");
        $this->assertEquals($available, "marketing");

        $available = $this->service->getTld("helgesverre.md");
        $this->assertEquals($available, "md");

        $available = $this->service->getTld("helgesverre.me");
        $this->assertEquals($available, "me");

        $available = $this->service->getTld("helgesverre.media");
        $this->assertEquals($available, "media");

        $available = $this->service->getTld("helgesverre.menu");
        $this->assertEquals($available, "menu");

        $available = $this->service->getTld("helgesverre.mg");
        $this->assertEquals($available, "mg");

        $available = $this->service->getTld("helgesverre.miami");
        $this->assertEquals($available, "miami");

        $available = $this->service->getTld("helgesverre.mk");
        $this->assertEquals($available, "mk");

        $available = $this->service->getTld("helgesverre.ml");
        $this->assertEquals($available, "ml");

        $available = $this->service->getTld("helgesverre.mn");
        $this->assertEquals($available, "mn");

        $available = $this->service->getTld("helgesverre.mo");
        $this->assertEquals($available, "mo");

        $available = $this->service->getTld("helgesverre.mobi");
        $this->assertEquals($available, "mobi");

        $available = $this->service->getTld("helgesverre.moda");
        $this->assertEquals($available, "moda");

        $available = $this->service->getTld("helgesverre.monash");
        $this->assertEquals($available, "monash");

        $available = $this->service->getTld("helgesverre.mp");
        $this->assertEquals($available, "mp");

        $available = $this->service->getTld("helgesverre.ms");
        $this->assertEquals($available, "ms");

        $available = $this->service->getTld("helgesverre.mu");
        $this->assertEquals($available, "mu");

        $available = $this->service->getTld("helgesverre.museum");
        $this->assertEquals($available, "museum");

        $available = $this->service->getTld("helgesverre.mx");
        $this->assertEquals($available, "mx");

        $available = $this->service->getTld("helgesverre.my");
        $this->assertEquals($available, "my");

        $available = $this->service->getTld("helgesverre.na");
        $this->assertEquals($available, "na");

        $available = $this->service->getTld("helgesverre.name");
        $this->assertEquals($available, "name");

        $available = $this->service->getTld("helgesverre.nc");
        $this->assertEquals($available, "nc");

        $available = $this->service->getTld("helgesverre.nf");
        $this->assertEquals($available, "nf");

        $available = $this->service->getTld("helgesverre.ng");
        $this->assertEquals($available, "ng");

        $available = $this->service->getTld("helgesverre.ninja");
        $this->assertEquals($available, "ninja");

        $available = $this->service->getTld("helgesverre.nl");
        $this->assertEquals($available, "nl");

        $available = $this->service->getTld("helgesverre.no");
        $this->assertEquals($available, "no");

        $available = $this->service->getTld("helgesverre.nu");
        $this->assertEquals($available, "nu");

        $available = $this->service->getTld("helgesverre.nz");
        $this->assertEquals($available, "nz");

        $available = $this->service->getTld("helgesverre.om");
        $this->assertEquals($available, "om");

        $available = $this->service->getTld("helgesverre.onl");
        $this->assertEquals($available, "onl");

        $available = $this->service->getTld("helgesverre.paris");
        $this->assertEquals($available, "paris");

        $available = $this->service->getTld("helgesverre.partners");
        $this->assertEquals($available, "partners");

        $available = $this->service->getTld("helgesverre.parts");
        $this->assertEquals($available, "parts");

        $available = $this->service->getTld("helgesverre.pe");
        $this->assertEquals($available, "pe");

        $available = $this->service->getTld("helgesverre.pf");
        $this->assertEquals($available, "pf");

        $available = $this->service->getTld("helgesverre.photo");
        $this->assertEquals($available, "photo");

        $available = $this->service->getTld("helgesverre.photography");
        $this->assertEquals($available, "photography");

        $available = $this->service->getTld("helgesverre.photos");
        $this->assertEquals($available, "photos");

        $available = $this->service->getTld("helgesverre.pics");
        $this->assertEquals($available, "pics");

        $available = $this->service->getTld("helgesverre.pictures");
        $this->assertEquals($available, "pictures");

        $available = $this->service->getTld("helgesverre.pl");
        $this->assertEquals($available, "pl");

        $available = $this->service->getTld("helgesverre.plumbing");
        $this->assertEquals($available, "plumbing");

        $available = $this->service->getTld("helgesverre.pm");
        $this->assertEquals($available, "pm");

        $available = $this->service->getTld("helgesverre.post");
        $this->assertEquals($available, "post");

        $available = $this->service->getTld("helgesverre.pr");
        $this->assertEquals($available, "pr");

        $available = $this->service->getTld("helgesverre.pro");
        $this->assertEquals($available, "pro");

        $available = $this->service->getTld("helgesverre.productions");
        $this->assertEquals($available, "productions");

        $available = $this->service->getTld("helgesverre.properties");
        $this->assertEquals($available, "properties");

        $available = $this->service->getTld("helgesverre.pt");
        $this->assertEquals($available, "pt");

        $available = $this->service->getTld("helgesverre.pub");
        $this->assertEquals($available, "pub");

        $available = $this->service->getTld("helgesverre.pw");
        $this->assertEquals($available, "pw");

        $available = $this->service->getTld("helgesverre.qa");
        $this->assertEquals($available, "qa");

        $available = $this->service->getTld("helgesverre.quebec");
        $this->assertEquals($available, "quebec");

        $available = $this->service->getTld("helgesverre.re");
        $this->assertEquals($available, "re");

        $available = $this->service->getTld("helgesverre.recipes");
        $this->assertEquals($available, "recipes");

        $available = $this->service->getTld("helgesverre.reisen");
        $this->assertEquals($available, "reisen");

        $available = $this->service->getTld("helgesverre.rentals");
        $this->assertEquals($available, "rentals");

        $available = $this->service->getTld("helgesverre.repair");
        $this->assertEquals($available, "repair");

        $available = $this->service->getTld("helgesverre.report");
        $this->assertEquals($available, "report");

        $available = $this->service->getTld("helgesverre.rest");
        $this->assertEquals($available, "rest");

        $available = $this->service->getTld("helgesverre.reviews");
        $this->assertEquals($available, "reviews");

        $available = $this->service->getTld("helgesverre.rich");
        $this->assertEquals($available, "rich");

        $available = $this->service->getTld("helgesverre.ro");
        $this->assertEquals($available, "ro");

        $available = $this->service->getTld("helgesverre.rocks");
        $this->assertEquals($available, "rocks");

        $available = $this->service->getTld("helgesverre.rodeo");
        $this->assertEquals($available, "rodeo");

        $available = $this->service->getTld("helgesverre.rs");
        $this->assertEquals($available, "rs");

        $available = $this->service->getTld("helgesverre.ru");
        $this->assertEquals($available, "ru");

        $available = $this->service->getTld("helgesverre.ruhr");
        $this->assertEquals($available, "ruhr");

        $available = $this->service->getTld("helgesverre.sa");
        $this->assertEquals($available, "sa");

        $available = $this->service->getTld("helgesverre.saarland");
        $this->assertEquals($available, "saarland");

        $available = $this->service->getTld("helgesverre.sb");
        $this->assertEquals($available, "sb");

        $available = $this->service->getTld("helgesverre.sc");
        $this->assertEquals($available, "sc");

        $available = $this->service->getTld("helgesverre.se");
        $this->assertEquals($available, "se");

        $available = $this->service->getTld("helgesverre.services");
        $this->assertEquals($available, "services");

        $available = $this->service->getTld("helgesverre.sexy");
        $this->assertEquals($available, "sexy");

        $available = $this->service->getTld("helgesverre.sg");
        $this->assertEquals($available, "sg");

        $available = $this->service->getTld("helgesverre.sh");
        $this->assertEquals($available, "sh");

        $available = $this->service->getTld("helgesverre.shoes");
        $this->assertEquals($available, "shoes");

        $available = $this->service->getTld("helgesverre.si");
        $this->assertEquals($available, "si");

        $available = $this->service->getTld("helgesverre.singles");
        $this->assertEquals($available, "singles");

        $available = $this->service->getTld("helgesverre.sk");
        $this->assertEquals($available, "sk");

        $available = $this->service->getTld("helgesverre.sm");
        $this->assertEquals($available, "sm");

        $available = $this->service->getTld("helgesverre.sn");
        $this->assertEquals($available, "sn");

        $available = $this->service->getTld("helgesverre.so");
        $this->assertEquals($available, "so");

        $available = $this->service->getTld("helgesverre.social");
        $this->assertEquals($available, "social");

        $available = $this->service->getTld("helgesverre.solar");
        $this->assertEquals($available, "solar");

        $available = $this->service->getTld("helgesverre.solutions");
        $this->assertEquals($available, "solutions");

        $available = $this->service->getTld("helgesverre.soy");
        $this->assertEquals($available, "soy");

        $available = $this->service->getTld("helgesverre.st");
        $this->assertEquals($available, "st");

        $available = $this->service->getTld("helgesverre.su");
        $this->assertEquals($available, "su");

        $available = $this->service->getTld("helgesverre.supplies");
        $this->assertEquals($available, "supplies");

        $available = $this->service->getTld("helgesverre.supply");
        $this->assertEquals($available, "supply");

        $available = $this->service->getTld("helgesverre.support");
        $this->assertEquals($available, "support");

        $available = $this->service->getTld("helgesverre.sx");
        $this->assertEquals($available, "sx");

        $available = $this->service->getTld("helgesverre.sy");
        $this->assertEquals($available, "sy");

        $available = $this->service->getTld("helgesverre.systems");
        $this->assertEquals($available, "systems");

        $available = $this->service->getTld("helgesverre.tattoo");
        $this->assertEquals($available, "tattoo");

        $available = $this->service->getTld("helgesverre.tc");
        $this->assertEquals($available, "tc");

        $available = $this->service->getTld("helgesverre.technology");
        $this->assertEquals($available, "technology");

        $available = $this->service->getTld("helgesverre.tel");
        $this->assertEquals($available, "tel");

        $available = $this->service->getTld("helgesverre.tf");
        $this->assertEquals($available, "tf");

        $available = $this->service->getTld("helgesverre.th");
        $this->assertEquals($available, "th");

        $available = $this->service->getTld("helgesverre.tienda");
        $this->assertEquals($available, "tienda");

        $available = $this->service->getTld("helgesverre.tips");
        $this->assertEquals($available, "tips");

        $available = $this->service->getTld("helgesverre.tk");
        $this->assertEquals($available, "tk");

        $available = $this->service->getTld("helgesverre.tl");
        $this->assertEquals($available, "tl");

        $available = $this->service->getTld("helgesverre.tm");
        $this->assertEquals($available, "tm");

        $available = $this->service->getTld("helgesverre.tn");
        $this->assertEquals($available, "tn");

        $available = $this->service->getTld("helgesverre.to");
        $this->assertEquals($available, "to");

        $available = $this->service->getTld("helgesverre.today");
        $this->assertEquals($available, "today");

        $available = $this->service->getTld("helgesverre.tools");
        $this->assertEquals($available, "tools");

        $available = $this->service->getTld("helgesverre.town");
        $this->assertEquals($available, "town");

        $available = $this->service->getTld("helgesverre.toys");
        $this->assertEquals($available, "toys");

        $available = $this->service->getTld("helgesverre.tr");
        $this->assertEquals($available, "tr");

        $available = $this->service->getTld("helgesverre.training");
        $this->assertEquals($available, "training");

        $available = $this->service->getTld("helgesverre.travel");
        $this->assertEquals($available, "travel");

        $available = $this->service->getTld("helgesverre.tv");
        $this->assertEquals($available, "tv");

        $available = $this->service->getTld("helgesverre.tw");
        $this->assertEquals($available, "tw");

        $available = $this->service->getTld("helgesverre.tz");
        $this->assertEquals($available, "tz");

        $available = $this->service->getTld("helgesverre.ua");
        $this->assertEquals($available, "ua");

        $available = $this->service->getTld("helgesverre.ug");
        $this->assertEquals($available, "ug");

        $available = $this->service->getTld("helgesverre.uk");
        $this->assertEquals($available, "uk");

        $available = $this->service->getTld("helgesverre.university");
        $this->assertEquals($available, "university");

        $available = $this->service->getTld("helgesverre.us");
        $this->assertEquals($available, "us");

        $available = $this->service->getTld("helgesverre.uy");
        $this->assertEquals($available, "uy");

        $available = $this->service->getTld("helgesverre.black");
        $this->assertEquals($available, "black");

        $available = $this->service->getTld("helgesverre.blue");
        $this->assertEquals($available, "blue");

        $available = $this->service->getTld("helgesverre.info");
        $this->assertEquals($available, "info");

        $available = $this->service->getTld("helgesverre.kim");
        $this->assertEquals($available, "kim");

        $available = $this->service->getTld("helgesverre.pink");
        $this->assertEquals($available, "pink");

        $available = $this->service->getTld("helgesverre.red");
        $this->assertEquals($available, "red");

        $available = $this->service->getTld("helgesverre.shiksha");
        $this->assertEquals($available, "shiksha");

        $available = $this->service->getTld("helgesverre.uz");
        $this->assertEquals($available, "uz");

        $available = $this->service->getTld("helgesverre.vacations");
        $this->assertEquals($available, "vacations");

        $available = $this->service->getTld("helgesverre.vc");
        $this->assertEquals($available, "vc");

        $available = $this->service->getTld("helgesverre.ve");
        $this->assertEquals($available, "ve");

        $available = $this->service->getTld("helgesverre.vegas");
        $this->assertEquals($available, "vegas");

        $available = $this->service->getTld("helgesverre.ventures");
        $this->assertEquals($available, "ventures");

        $available = $this->service->getTld("helgesverre.vg");
        $this->assertEquals($available, "vg");

        $available = $this->service->getTld("helgesverre.viajes");
        $this->assertEquals($available, "viajes");

        $available = $this->service->getTld("helgesverre.villas");
        $this->assertEquals($available, "villas");

        $available = $this->service->getTld("helgesverre.vision");
        $this->assertEquals($available, "vision");

        $available = $this->service->getTld("helgesverre.vodka");
        $this->assertEquals($available, "vodka");

        $available = $this->service->getTld("helgesverre.voting");
        $this->assertEquals($available, "voting");

        $available = $this->service->getTld("helgesverre.voyage");
        $this->assertEquals($available, "voyage");

        $available = $this->service->getTld("helgesverre.vu");
        $this->assertEquals($available, "vu");

        $available = $this->service->getTld("helgesverre.wang");
        $this->assertEquals($available, "wang");

        $available = $this->service->getTld("helgesverre.watch");
        $this->assertEquals($available, "watch");

        $available = $this->service->getTld("helgesverre.wed");
        $this->assertEquals($available, "wed");

        $available = $this->service->getTld("helgesverre.wf");
        $this->assertEquals($available, "wf");

        $available = $this->service->getTld("helgesverre.wien");
        $this->assertEquals($available, "wien");

        $available = $this->service->getTld("helgesverre.wiki");
        $this->assertEquals($available, "wiki");

        $available = $this->service->getTld("helgesverre.works");
        $this->assertEquals($available, "works");

        $available = $this->service->getTld("helgesverre.ws");
        $this->assertEquals($available, "ws");

        $available = $this->service->getTld("helgesverre.xxx");
        $this->assertEquals($available, "xxx");

        $available = $this->service->getTld("helgesverre.xyz");
        $this->assertEquals($available, "xyz");

        $available = $this->service->getTld("helgesverre.yt");
        $this->assertEquals($available, "yt");

        $available = $this->service->getTld("helgesverre.ryukyu");
        $this->assertEquals($available, "ryukyu");

        $available = $this->service->getTld("helgesverre.zm");
        $this->assertEquals($available, "zm");

        $available = $this->service->getTld("helgesverre.zone");
        $this->assertEquals($available, "zone");

        $available = $this->service->getTld("helgesverre.za");
        $this->assertEquals($available, "za");

    }


}
