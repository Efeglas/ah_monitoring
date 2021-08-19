<?php 

include "./pdo.php";


$db = new ApiConnection();

$result = $db->Select("SELECT id, visible FROM sold");

//var_dump($result);


switch ($_POST["mode"]) {
    case 'getAllSoldProductData':
        $returnArray = [];

        $sql = "SELECT s.id, p.name, p.pic, r.color, s.count, s.price, s.deposite, s.ah_cut, s.date FROM sold as s 
        JOIN product as p ON p.id=s.productID
        JOIN rarities as r ON r.id=p.rarity
        WHERE s.visible='1'";
        $result = $db->Select($sql);

        $sum = 0;

        foreach ($result as $key => $value) {
            $gain = round((($value["count"]*$value["price"]) + $value["deposite"]) - $value["ah_cut"], 4);
            $result[$key]["gain"] = $gain;
            $sum += $gain;
        }

        $returnArray["data"] = $result;
        $returnArray["sum"] = round($sum, 4);
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
        break;
    case 'insertSoldPruduct':
        $productId = $_POST["data"]["product"];
        $count = $_POST["data"]["count"];
        $deposite = $_POST["data"]["deposite"];
        $price = $_POST["data"]["price"];
        $ahCut = $_POST["data"]["ahCut"];
        $date = $_POST["data"]["date"];   
        $returnArray = [];

        $db->Execute("INSERT INTO sold (productID, count, price, deposite, ah_cut, date) VALUES ('$productId', '$count', '$price', '$deposite', '$ahCut', '$date')");
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
        break;
    case 'getProducts':
        $returnArray = [];

        $result = $db->Select("SELECT id, name FROM product WHERE visible='1'");
        $returnArray["data"] = $result;
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
            
        break;
    
    default:
        # code...
        break;
}

$db->Close();

?>