<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //pobieram wartosci wpisane w formie typu POST
$identifier = $_POST['identifier'];
$names = $_POST['name'];

$sl = new ShoppingList();
$sl->setName($identifier);

for ($i = 0; $i < count($names); $i++) {
    $prod = new Product();
    $prod->setName($names[$i]);

    $sl->addProduct($prod);
}

slQueries::SubmitList($sl);
?>
<div class="alert alert-success">
    <strong>Success!</strong> You have successfully added list <strong><?php echo $identifier; ?></strong>.
</div>