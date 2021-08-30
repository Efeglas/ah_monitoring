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
    case 'stat_test':
        $product = $_POST["product"];
        $returnArray = [];

        $sql = "SELECT s.price, s.date, p.name FROM sold as s 
        JOIN product as p ON p.id=s.productID
        WHERE s.visible='1' AND s.productID='$product'";
        $result = $db->Select($sql);
        $returnArray["data"] = $result;
        $returnArray["msg"] = "success";

        $returnArray["price"] = [];
        $returnArray["date"] = [];
        $returnArray["name"] = $result[0]["name"];

        foreach ($result as $key => $value) {
            array_push($returnArray["price"], $value["price"]);
            array_push($returnArray["date"], $value["date"]);
        }


        

        echo json_encode($returnArray);
        break;
    case 'insertDailyPrice':
        $data = $_POST["data"];

        $returnArray = [];
        //var_dump($data);
        foreach ($data as $key => $value) {

            $sql = "SELECT id FROM addon_products WHERE itemID='$key'";
            $result = $db->Select($sql);
            $id = $result[0]["id"];

            $length = strlen($value);
            $slicedEnd = substr($value, $length - 4);
            $slicedGold= substr($value, 0, $length - 4);         
            $price = $slicedGold . "." . $slicedEnd;

            $sql = "INSERT INTO addon_price (addon_productID, price) VALUES ('$id', '$price')";
            //var_dump($sql);
            $db->Execute($sql);
            $returnArray["msg"] = "success";
        }

        echo json_encode($returnArray);
        break;
    case 'getStatForDailyPrices':
        $returnArray = [];
        $sql = "SELECT p.price, prod.name, prod.id, p.date FROM addon_price as p 
        JOIN addon_products as prod ON prod.id=p.addon_productID";
        $result = $db->Select($sql);
        $obj = (object) array('1' => 'foo');
        
        $data = [];

        foreach ($result as $key => $value) {
            if (array_key_exists($value["id"], $data)) {
                array_push($data[$value["id"]]->labels, $value["date"]);
                array_push($data[$value["id"]]->data, $value["price"]);
            } else {
                $data[$value["id"]] = (object) array('id' => $value["id"], 'labels' => [], 'data' => [], 'name' => $value["name"]);
                array_push($data[$value["id"]]->labels, $value["date"]);
                array_push($data[$value["id"]]->data, $value["price"]);
            }
        }

        $returnArray["data"] = $data;
        echo json_encode($returnArray);
        break;
    default:
        # code...
        break;
}

$db->Close();

?>