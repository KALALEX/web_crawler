<?php
require_once('SQLconfig.php');
require_once('json_operations.php');
class db_operations
{
    // Prints all homepages
    static function print_all_homepages($dbconn){
        // Run query
        $querry = "SELECT link FROM homepages";
        $result = $dbconn->query($querry);

        // Print Result
//    while ($row = $result->fetch_assoc()){
//        array_push($courses, new Course($row["course"], $row["credits"], $row["instructor"], $row["year"], $row["section"], $row["lab"], $row["studentNum"]));
//    }
        foreach ($result as $item){
            foreach ($item as $value)
                print "<p>" . $value . "</p>";
        }

    }
    // Inserts an array of elements into a row of a table
    static function insert($table, $row, $input, $dbconn){
        $querry = "INSERT INTO " . $table . " (" . $row . ") VALUES ";
        foreach ($input as $value){
            $querry = $querry . '("' . $value . '")';
            if ($value == $input[sizeof($input) - 1]){
                $querry = $querry . ";";
            }else{
                $querry = $querry . ",";
            }
        }
        if ($dbconn->query($querry) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $querry . "<br>" . $dbconn->error;
        }
    }
    static function update_db_from_json(){
        $homePagesToAdd = [];
        foreach (glob("*.json") as $filename) {
            //echo "$filename size " . filesize($filename) . "\n";
            $json_data = json_operations::get_data($filename);
            array_push($homePagesToAdd, $json_data[0]);
            print "<p>" . $json_data[0] . "</p>\n";
        }

        // Connect to DB
        $dbconn = mysqli_connect(DB_HOST, DB_USER,DB_PASSWORD, DB_DATABASE) or die('MySQL connection failed!' . mysqli_connect_error());
        mysqli_set_charset($dbconn, "utf8");

        db_operations::insert("homepages","link",$homePagesToAdd,$dbconn);
        // Prints all homepages
        db_operations::print_all_homepages($dbconn);


        foreach (glob("*.json") as $filename) {
            $json_data = json_operations::get_data($filename);

            $querry = "SELECT id FROM homepages WHERE link='" . $json_data[0] . "'";
            $result = $dbconn->query($querry);
            foreach ($result as $item){
                foreach ($item as $value){
                    $id = $value;
                }
            }
            $querry = "INSERT INTO pages (id, link, title) VALUES ";
            print "\n\n\n\n";
            $i=0;
            foreach ($json_data[1] as $link){
                $querry = $querry . '(' . $id . ', "' . $link . '", "' . $json_data[2][$i] . '")';
                if ($link == $json_data[1][sizeof($json_data[1]) - 1]){
                    $querry = $querry . ";";
                }else{
                    $querry = $querry . ",";
                }
                $i++;
            }
            if ($dbconn->query($querry) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $querry . "<br>" . $dbconn->error;
            }
        }
        $dbconn->close();
    }
}