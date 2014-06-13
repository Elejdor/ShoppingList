<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mysql_connector
 *
 * @author Łukasz Nizik
 */

//pomoc przy laczeniu z baza
class connector {

    public function connect() {
        $link = mysql_connect(config::$url, config::$dbname, config::$password);
        mysql_select_db(config::$dbname, $link);
        mysql_query('SET NAMES ' . config::$encoding);
    }

    public function query($query_string) {
        return mysql_query($query_string);
    }
    
    public function dispose()
    {
        mysql_close();
    }

}

class slQueries {

//pobiera pojedyncza liste z bazy danych
    static public function GetList($name) {
        $con = new connector();
        $con->connect();
        
        $query = 'SELECT Products.id, Products.name, Products.checked, Lists.name as ListName, Lists.id as ListId FROM Products,Lists '
                . 'WHERE Products.id_list=Lists.id AND Lists.name=\'' . $name.'\'';
        
        $response = mysql_query($query);
        $sl = new ShoppingList();
        
        if (!$response) {
        $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }        
		
        while ($row = mysql_fetch_array($response)) {  
            $sl->setName($row['ListName']);
            $sl->setId($row['ListId']);
            
            $tmpProd = new Product();
            $tmpProd->setId($row['id']);
            $tmpProd->setName($row['name']);
            $tmpProd->setChecked($row['checked']);
            
            $sl->addProduct($tmpProd);
        }
        
        $con->dispose();
        return $sl;
    }

    static public function SubmitList($sl)
    {
        $con = new connector();
        $con->connect();
        
        //add new list
        $query = 'INSERT INTO Lists(name) values(\''.$sl->getName().'\')';        
        mysql_query($query);
        
        $query = 'SELECT id FROM Lists where name=\''.$sl->getName().'\'';
        
        $myId = mysql_query($query);

        $myId = mysql_fetch_array($myId);
        $sl->setId($myId['id']);
        
        foreach ($sl->items as $prod)
        {
            $myBool = ($prod->getChecked()) ? 'TRUE' : 'FALSE';
            
            $query = 'INSERT INTO Products(name,checked,id_list) values(\''.$prod->getName().'\','.$myBool.',\''.$sl->getId().'\')';
            
            mysql_query($query);
        }
        $con->dispose();
    }
}
