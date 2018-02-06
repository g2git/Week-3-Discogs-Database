<?php

include_once 'database.php';

//find all root nodes to use as table names
function dataInsertion()
{
    $xmlfile = 'discogs-database/discogs_20081014_labels.xml';
    $reader = new XMLReader;
    $reader->open($xmlfile);
    $tableNames=array();

    while ($reader->read()) {
        if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'label') {
            $element = new SimpleXMLElement($reader->readOuterXml());
            $kids = $element->children();

            foreach ($kids as $nodes) {
                $name = $nodes->getName();
                if (!in_array($name, $tableNames)) {
                    array_push($tableNames, $name);
                }
            }
        }
    }
    print_r($tableNames);
}

function attrInsertion()
{
    global $connection;

    $xmlfile = 'discogs-database/discogs_20081014_labels.xml';
    $reader = new XMLReader;
    $reader->open($xmlfile);
    $attrTable=array();
    $childTable=array();
    $valTable=array();
    $label_count=1;

    while ($reader->read()) {
        if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'label'&& $reader->depth==1) {
            $element = new SimpleXMLElement($reader->readOuterXml());

            //inserting name
            // $kids4 = $element->children();
            // $kids4 = $kids4->name;
            // $kids4 = $kids4->__toString();

            //inserting sublabels
            // $kids4 = $element->children();
            // $kids4 = $kids4->sublabels;
            // $kids4 = $kids4->label;
            // $kids4 = json_encode($kids4);

            //inserting profile
            // $kids4 = $element->children();
            // $kids4 = $kids4->profile;
            // $kids4 = $kids4->__toString();

            //inserting contactinfo
            // $kids4 = $element->children();
            // $kids4 = $kids4->contactinfo;
            // $kids4 = $kids4->__toString();

            //inserting parentLabel
            // $kids4 = $element->children();
            // $kids4 = $kids4->parentLabel;
            // $kids4 = $kids4->__toString();

            //inserting urls
            // $kids4 = $element->children();
            // $kids4 = $kids4->urls;
            // $kids4 = $kids4->url;
            // $kids4 = json_encode($kids4, JSON_UNESCAPED_SLASHES);



            //$label_count++;

            // if ($label_count == 26){
            //   //print_r($valTable);
            //   exit;
            // }


            // if(!$reader->isEmptyElement){
//
            // $kids2 = $element->children();
//
            // foreach ($kids2 as $nodes2) {
            //   $name2 = $nodes2->getName();
//    if(!in_array($name2, $childTable)){
//     array_push($childTable,$name2);
            //   }
            // }
//
            // }


            //find attribute categories
            // $kids = $element->attributes();
            // foreach ($kids as $nodes => $v) {
//    if(!in_array($nodes, $attrTable)){
//     array_push($attrTable,$nodes);
            //   }
            // }

            //insert images
            $kids4 = $element->children();
            $kids4 = $kids4->images;
            $kids4 = json_encode($kids4, JSON_UNESCAPED_SLASHES);

            $kids4=mysqli_real_escape_string($connection, $kids4);
            $sql = "INSERT INTO images (image)
  VALUES ('$kids4')";
            $result = mysqli_query($connection, $sql);
        }
    }
}

attrInsertion();
