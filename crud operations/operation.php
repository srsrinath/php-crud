<?php
require_once("db.php");
require_once("component.php");

$con=Createdb();


if(isset($_POST['create'])){
    createData();
}




if(isset($_POST['update'])){
    UpdateData();
}


if(isset($_POST['delete'])){
    DeleteRecord();
}


if(isset($_POST['deleteall'])){
    deleteAll();

}





function createData(){
$bookname=textboxValue(value:"book_name");
$bookpublisher=textboxValue(value:"book_publisher");
$bookprice=textboxValue(value:"book_price");
if($bookname && $bookpublisher && $bookprice){
$sql="INSERT INTO books(book_name,book_publisher,book_price)VALUES('$bookname','$bookpublisher','$bookprice')";

if(mysqli_query($GLOBALS['con'],$sql)){

    TextNode(classname:"success",msg:"Record successfully inserted");
}else{
    echo"error";
}

}else{
TextNode(classname:"error",msg:"provide Data in the Textbox");
}


}

function textboxValue($value){
    $textbox=mysqli_real_escape_string($GLOBALS['con'],trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}

//messages display in color formate.
function TextNode($classname,$msg){
$element="<h6 class='$classname'>$msg</h6>";
echo $element;
}



// get data from mysql database

function getdata(){
    $sql="SELECT * FROM books";
    $result=mysqli_query($GLOBALS['con'],$sql);
    if(mysqli_num_rows($result) >  0)
    {
      return $result;  
    }
}


//update data

function UpdateData(){
$bookid=textboxValue("book_id");
$bookname=textboxValue("book_name");

$bookpublisher=textboxValue("book_publisher");

$bookprice=textboxValue("book_price");

if($bookname && $bookpublisher && $bookprice){
    $sql=
    "
    UPDATE books SET book_name='$bookname',book_publisher='$bookpublisher',book_price='$bookprice' WHERE id='$bookid'";
if(mysqli_query($GLOBALS['con'],$sql))
{
    TextNode(classname:"success",msg:"Data Successfully Updated");

}else{
    TextNode(classname:"error",msg:"enable to Updated Data");

}


}else{
    TextNode(classname:"error",msg:"select Data using edit icon");

}


}


function DeleteRecord(){
$bookid=(int)textboxValue(value:'book_id');

$sql = "DELETE FROM books where id='$bookid'";

if(mysqli_query($GLOBALS['con'],$sql))
{
    TextNode(classname:"success",msg:"Record Deleted successfully");

}else{
    TextNode(classname:"error",msg:"enable to delete data");

}

}

function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 3){
                buttonElement(btnid:"btn-deleteall",styleclass:"btn btn-danger",text:"<i class='fas fa-trash'></i>Delete All",name:"deleteall", attr:"");                return;
            }
        }
    }
}


function deleteAll(){
    $sql = "DROP TABLE books";

    if(mysqli_query($GLOBALS['con'], $sql)){
        TextNode("success","All Record deleted Successfully...!");
        Createdb();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}


// set id to textbox
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}













?>