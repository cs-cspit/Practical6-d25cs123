<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = htmlspecialchars($_POST["name"]);
        $gender = $_POST["gender"];
        $msg = htmlspecialchars($_POST["msg"]);
        $email = $_POST["email"];
        if(isset($_POST["hobbies"])){
            $hobbies = $_POST["hobbies"];
            $hobbyString = implode(',', $hobbies);
            $data = "$name | $gender | $msg | $email | $hobbyString\n";
            file_put_contents("data.txt", $data, FILE_APPEND);
        }else{
            $hobbyString = "None";
        }
        echo "Name: $name <br>";
        echo "Hobbies: $hobbyString";

//Database Connection
    $conn =  new mysqli("localhost", "root", "","college");
        if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
        }
            if(!empty($name) && !empty($gender) && !empty($msg)){
            $sql = "INSERT INTO users (name, gender, msg, email) VALUES ('$name', '$gender', '$msg', '$email')";
            $result = $conn->query($sql);
                if($result === TRUE){
                    echo "Data inserted successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Something went wrong!";
            }
    
}
?>
