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
          
        $returnArray = [];

        $db->Execute("INSERT INTO sold (productID, count, price, deposite, ah_cut) VALUES ('$productId', '$count', '$price', '$deposite', '$ahCut')");
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
        break;
    case 'getProductsForOptions':
        $returnArray = [];

        $result = $db->Select("SELECT id, name FROM product WHERE visible='1'");
        $returnArray["data"] = $result;
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
            
        break;
    case 'getAllProductsData':
        $returnArray = [];

        $sql = "SELECT p.id, p.name, p.pic, r.name as rarity, r.color, c.name as category FROM product as p 
        JOIN rarities as r ON r.id=p.rarity
        JOIN categories as c ON c.id=p.category
        WHERE p.visible='1'";
        $result = $db->Select($sql);
        $returnArray["data"] = $result;
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
        break;
    case 'getRaritiesForOptions':
        $returnArray = [];

        $result = $db->Select("SELECT id, name, color FROM rarities WHERE visible='1'");
        $returnArray["data"] = $result;
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
        break;
    case 'getCategoriesForOptions':
        $returnArray = [];

        $result = $db->Select("SELECT id, name FROM categories WHERE visible='1'");
        $returnArray["data"] = $result;
        $returnArray["msg"] = "success";

        echo json_encode($returnArray);
        break;
    case 'saveProduct':
        $name = $_POST["name"];
        $rarity = $_POST["rarity"];
        $category = $_POST["category"];
        
        $file = $_FILES["image"];
        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileTmp_name = $file["tmp_name"];

        $fileDestination = "../data/imgs/" . $fileName;

        $returnArray = [];

        $db->Execute("INSERT INTO product (name, rarity, category, pic) VALUES ('$name', '$rarity', '$category', '$fileName')");
        $returnArray["msg"] = "success";

        move_uploaded_file($fileTmp_name, $fileDestination);

        echo json_encode($returnArray);

        break;
    default:
        # code...
        break;
}

$db->Close();

?>