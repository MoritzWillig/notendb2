<?php
  /**
   * Abstract base class for Controllers
   * 
   * @package    MVC_Framework
   * @subpackage Abstracts
   * @author     Max Weller <max.weller@teamwiki.net>
   **/
	
  class Controller {
    
    var $template_vars = array();
    var $Session;
    var $DID;
    
    function __construct() {
      $this->Session = load_model("session");
      
      $this->DID = isset($_GET["datei"]) && intval($_GET["datei"]) > 0 ? intval($_GET["datei"]) : -1;
      set_view_var("DID", $this->DID);
      
      $user = $this->Session->getUser();
      $this->template_vars["Benutzername"] = $user["kuerzel"];
      $this->template_vars["IsAdmin"] = $this->Session->isAdmin();
      
      $this->load_menu();
    }
    
    function load_menu() {
      $this->template_vars["Main_Menu"] = array(
        "kurs/view"             => "Liste der Kurse",
        "schueler/view"         => "Schülerliste",
        "tabelle/zuordnung"     => "Zuordnung",
        "tabelle/noten/meine"   => "Noten(eigene)",
        "tabelle/noten/alle"    => "Noten(alle)",
        "tabelle/zeugnis"       => "Zeugnisdruck",
        "offline/info"          => "Offline"
      );
    }
    
    function display_layout() {
      load_view("layout", $this->template_vars);
    }
    
    function require_login() {
      if (! $this->Session->getLoggedIn()) {
        header("Location: ".URL_PREFIX."user/login");
        exit;
      }
    }
    
    function require_datei() {
      if ($this->DID == -1) {
        $this->template_vars["Inhalt"] = 
                  get_view("error_no_datei_selected", array());
      
        $this->display_layout();
        
        exit;
      }
    }
    
  }
  
?>