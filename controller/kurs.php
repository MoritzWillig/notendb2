<?php
  /**
   * Controller for viewing and creating Kurs items
   * 
   * @package    NotenDB2
   * @subpackage Controllers
   * @author     Max Weller <max.weller@teamwiki.net>, Moritz Willig <>
   **/
	
  class KursController extends Controller {
    var $DB;
    var $Datei;
    var $Kurs;
    var $LehrerKurs;
    
    function __construct() {
      parent::__construct();
      
      $this->require_login();
      
      $this->DB = load_model("database");
      
      $this->Datei = load_model("datei");
      
      $this->Kurs = load_model("kurs");
      $this->Kurs->DID = $this->DID;
      
      $this->LehrerKurs = load_model("rel_lehrer_kurs");
      
      $this->template_vars["Dateien"] = $this->Datei->get_ordered_list();
      
      $this->require_datei();
    }
    
    function view() {
      //$list = $this->Kurs->get_all();
      $list = $this->Kurs->get_all_with_lehrer_namen();
      for($i = 0; $i < count($list); $i++) $list[$i]["rlk_set"] = strpos(",".$list[$i]["lehrer_namen"].",", ",".$this->Session->getUser("name").",") !== false;
      
      $this->template_vars["Inhalt"] = 
                  get_view("kurs_list", array("Liste" => $list));
      
      $this->display_layout();
    }
    
    function edit($kuid) {
      if ($kuid == "new") $id = null; else $id = intval($kuid);
      
      if (isset($_POST["e"])) {
        $set = $_POST["e"];
        $this->Kurs->set($id, $set);
        if ($id == null) $id = mysql_insert_id();
        $this->LehrerKurs->deleteAllByKuid($id);
        if (is_array($_POST["rlk_list"])) foreach($_POST["rlk_list"] as $d) $this->LehrerKurs->addByRel($d, $id);
        if ($_POST["e"]["saveAndNew"]) $id = null; else $kuid = $id;
      }
      
      $Lehrer = load_model("lehrer");       $Lehrer->DID = $this->DID;
      $Schueler = load_model("schueler");   $Schueler->DID = $this->DID;
      
      if ($id === null) {
        $kurs = array_fill_keys(array_keys($this->Kurs->structure), "");
        $lehrer = $Lehrer->get_all("name,vorname");
        $schueler = array();
      } else {
        $kurs = $this->Kurs->get_by_id($id);
        
        $this->DB->sql("SELECT vorname,name,lid,r_kuid FROM lehrer AS l LEFT OUTER JOIN rel_lehrer_kurs AS rlk ON rlk.r_lid=l.lid AND r_kuid=%d WHERE r_kuid=%d OR isnull(r_kuid) ORDER BY name,vorname", $id, $id);
        $lehrer = $this->DB->getlist();
        
        $schueler = $Schueler->get_all_by_kurs($id);
      }
      unset($kurs["kuid"]); unset($kurs["did"]);
      
      $this->template_vars["Inhalt"] = 
                     get_view("kurs_edit", array(
                          "Data" => $kurs,
                          "Error" => false,
                          "MethodURL" => "kurs/edit/$kuid",
                          "Lehrer" => $lehrer,
                          "Schueler" => $schueler
                     ));
      
      $this->display_layout();
      
    }
  }
  
?>