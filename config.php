<?php
    //Declare credentials
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name="seriez";
    $videosTable = "series";
    $usersTable = "users";
     
    // Connecting to database.
    $conn = new mysqli($host, $username, $password);  
    if($conn->connect_error){
        die("Connection failed ".$conn->connect_error);
    }else{
        $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
        if($conn->query($sql)){
            //Database created successfully
            
            $sql = "USE $db_name";
            if($conn->query($sql)){
                //We entered into the db
                //Now create tables
                
                //Create Users Table
                $users_query = "CREATE TABLE IF NOT EXISTS $usersTable (
                    id INT AUTO_INCREMENT,
                    username VARCHAR(100) NOT NULL UNIQUE, 
                    passwd VARCHAR(100) NOT NULL , 
                    user_type VARCHAR(50) DEFAULT 'user',
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (id))";     
                if(!$conn->query($users_query)){
                    echo "Erro creating table $usersTable".$conn->error; 
                }
                //Create table to store video, image locations, and webseries data 
                $videos_query = "CREATE TABLE IF NOT EXISTS $videosTable (
                    series_id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    series_name varchar(255) NOT NULL,
                    description text(1000),
                    seasons INT default 1,
                    episodes INT default 2,
                    duration DECIMAL(10,2) default 20,
                    rating DECIMAL(10,2) default 0,
                    video_location varchar(255) NOT NULL,
                    image_location varchar(255) NOT NULL,
                    publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                  )";
                if(!$conn->query($videos_query)){
                    echo "Erro creating table".$videosTable." ".$conn->error; 
                }   
                //Create a genres table
                //Since a webseries can have more than one genre
                //It is like a multi-valued attribute in ER diagram
                $genres_query = "CREATE TABLE IF NOT EXISTS GENRES(
                                genre_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                genre_name VARCHAR(30) NOT NULL,                        
                                webseries_id INT(11) NOT NULL,      
                                FOREIGN KEY (webseries_id) references series(series_id)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE
                                )";
                if(!$conn->query($genres_query)){
                    echo "Erro creating table genres table".$conn->error; 
                }   
                $comments = "CREATE TABLE IF NOT EXISTS comments(
                            comment_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            name VARCHAR(100),
                            email VARCHAR(40) NOT NULL,
                            message text(1000) default 'Thank You'
                            )";
                if(!$conn->query($comments)){
                    echo "Erro creating comments  table".$conn->error; 
                }
            }else{
                echo "Error opening database: " . $conn->error;
            }
        }else{
            echo "Error CREATING database: " . $conn->error;
        }
    }
    
?>