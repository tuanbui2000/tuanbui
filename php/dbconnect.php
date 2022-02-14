    <?php 
        class connect{
            public $db;
            //コンストラクタ・dbを接続する
            function __construct(){
                try{
                $this->db = new PDO('mysql:host=localhost;dbname=training;charset=utf8','root','');
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }catch(PDOException $e){
                    print ('データベースに接続できませんでした。'.$e->getMessage());
                }catch(Exception $e){
                    print ('予期せぬエラーです'.$e->getMessage());
                }
            }
            //デストラクタ・dbを切断する
            function __destruct(){
                $this->db = null;
            }
        }
    ?>
        


<?php
                    // try {
                    //     // database connect
                    //     $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                    //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //     $stmt = $db->prepare($sql_syntax);
                    //     $stmt->execute();

                    //     //display data
                    //     while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                    //         echo "<div class='remaining'>
                    //         <button>$data[0]</button> 
                    //          $data[1] $data[2]個<br>
                    //          </div>     ";
                    //     }
                    //     $db = null;
                    // } catch (PDOException $e) {
                    //     print('database not connected ' . $e->getMessage());
                    // } catch (Exception $e) {
                    //     print('予期せぬerorr ' . $e->getMessage());
                    // }
                    ?>