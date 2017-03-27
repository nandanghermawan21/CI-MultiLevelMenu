<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MultiLevelMenu {

    /*
     * properti id tertinggi yang akan ditampilkan
     */
    public $ParentId = 0;
    
    public $Data = array();
           
    /*
     * query untuk mengambil data dari database
     */
    public $QgetMenuTree = 'SELECT a.id, a.parent_id, b.nama, b.url, b.class_icon FROM menu_tree a JOIN menu b ON a.id = b.id';
   

    function __construct($ParentId = 0) {
         $Data['ParentId'] = $ParentId;
        
    }
    
    
    public function GetData() {
        $CI = &get_instance();
        $query = $CI->db->query($this->QgetMenuTree);
        return $query->result_array();
    }
    
    /*
     * return array data yang telah diurutkan dari query $QgetMenuTree
     */
    public function GenerateOrderedMenu(){        
        $OrderedMenu = $this->OrderedMenu($this->GetData());
        $Data['ParentId'] = $this->ParentId;
        $Data['Menu'] = $OrderedMenu;
        return $Data;
    }
    
    /*
     * return html menu dari query $QgetMenuTree
     */
    public function GenerateOrderedMenuHtml(){
        $OrderedMenu = $this->HtmlRenderMenu($this->GetData());
        $Data['ParentId'] = $this->ParentId;
        $Data['Menu'] = $OrderedMenu;
        return $Data;
    }

    
    /*
     * return ordered menu dari array format array harus seperti dibawah
     * 
     * array(‘id’=>…, ‘parent_id’=>…, ‘name’=>…, ‘url’=>…),
       array(‘id’=>…, ‘parent_id’=>…, ‘name’=>…, ‘url’=>…),
     * 
     */
    public function OrderedMenu($array, $parent_id = 0) {
        $temp_array = array();
        foreach ($array as $element) {
            if ($element['parent_id'] == $parent_id) {
                $element['subs'] = $this->OrderedMenu($array, $element['id']);
                $temp_array[] = $element;
            }
        }
        return $temp_array;
    }
    
    
     /*
     * return ordered mhtml menu format array harus seperti dibawah
     * 
     * array(‘id’=>…, ‘parent_id’=>…, ‘name’=>…, ‘url’=>…),
       array(‘id’=>…, ‘parent_id’=>…, ‘name’=>…, ‘url’=>…),
     * 
     */
    public function HtmlRenderMenu($array, $parent_id = 0) {
        $menu_html = '<ul>';
        foreach ($array as $element) {
            if ($element['parent_id'] == $parent_id) {
                $menu_html .= '<li><a href="' . $element['url'] . '">' . $element['nama'] . '</a>';
                $menu_html .= $this->HtmlRenderMenu($array, $element['id']);
                $menu_html .= '</li>';
            }
        }
        $menu_html .= '</ul>';
        return $menu_html;
    }

}
