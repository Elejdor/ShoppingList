<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShoppingList
 *
 * @author WolfGD = Łukasz Nizik
 */

 //klasa produktu na liscie
class Product {
    private $name = "";
    private $checked = false;
    private $id = 0;
    
    public function setName ($string) {
        $this->name = $string;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setChecked($bool) {
        $this->checked = $bool;
    }
    
    public function getChecked() {
        return $this->checked;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
}

//klasa dla pojedynczej listy
class ShoppingList {
    
    private $id;
    private $name;
    var $items = array(); //array of Products    

    public function getAndroidString()
    {
        $result = ''; 
        
        foreach ($this->items as $value) {
            echo $value->getName().'|'.$value->getChecked().';';
        }
        
        return $result;
    }
    
    function addProduct(Product $prod)
    {
        $this->items[count($this->items)] = $prod;        
    }
    
    public function getProduct($id)
    {
        return $this->items[$id];
    }
    
    public function propagateFromSql(array $sqlArray)
    {
        foreach ($sqlArray as $value) {
            $this->addProduct($value);
        }
    }
    
    public function getItems()
    {
        return $this->items;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($val)
    {
        $this->name = $val;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($val)
    {
        $this->id = $val;
    }
}

