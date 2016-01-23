<?php 
class ConnectionFactory{
    private static $conn;
    public static function connect()
    {
        if(!ConnectionFactory::$conn)
        {
            try{
                self::$conn = new PDO(DB_DATA_SOURCE, DB_USERNAME, DB_PASSWORD);
             }
             catch (PDOException $exception) 
             {
                echo "Oh no, there was a problem" . $exception->getMessage();
             }
        }
        return ConnectionFactory ::$conn;
    }
}
?>
