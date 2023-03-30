<?php
    require "module.php";
    $query=new query();
    if(isset($_GET['get_lga'])){
        $state_id=intval($query->sanitize( $_GET['state']));
        $sql='SELECT lga_name,lga_id FROM lga where state_id=?';
        $query->prepareQuery($sql,'i',$state_id);
        echo ($query->executeSelect()!=false)?$query->executeSelect():false;
    }elseif(isset($_POST['polling_unit'])){
        $search="%".$query->sanitize($_POST['search'])."%";
        $sql='SELECT `announced_pu_results`.`party_abbreviation`,`announced_pu_results`.`party_score`,`polling_unit`.`polling_unit_name` FROM `announced_pu_results`,`polling_unit` where `announced_pu_results`.`polling_unit_uniqueid`=`polling_unit`.`uniqueid` and (`polling_unit`.`polling_unit_name` like ? or `polling_unit`.`polling_unit_description` like ?)';
        $query->prepareQuery($sql,'ss',$search,$search);
        echo ($query->executeSelect()!=false)?$query->executeSelect():false;

    }elseif(isset($_GET['get_all_pu'])){
        $pu=$query->sanitize($_GET['pu']);
        $sql='SELECT `announced_pu_results`.`party_abbreviation`,`announced_pu_results`.`party_score`,`polling_unit`.`polling_unit_name` FROM `announced_pu_results`,`polling_unit` where `announced_pu_results`.`polling_unit_uniqueid`=`polling_unit`.`uniqueid` and (`announced_pu_results`.`polling_unit_uniqueid`=?)';
        $query->prepareQuery($sql,'i',$pu);
        echo ($query->executeSelect()!=false)?$query->executeSelect():false;

    }elseif(isset($_GET['get_ward'])){
        $state_id=intval($query->sanitize( $_GET['lga']));
        $sql='SELECT lga_name,lga_id FROM lga where state_id=?';
        $query->prepareQuery($sql,'i',$state_id);
        echo ($query->executeSelect()!=false)?$query->executeSelect():false;
    }elseif(isset($_GET['get_pu'])){
        $ward_id=intval($query->sanitize( $_GET['pu']));
        $sql='SELECT `polling_unit`.`polling_unit_name`,`polling_unit`.`uniqueid` FROM `polling_unit` where `polling_unit`.`ward_id`=?';
        $query->prepareQuery($sql,'i',$ward_id);
        echo ($query->executeSelect()!=false)?$query->executeSelect():false;
    }


?>

