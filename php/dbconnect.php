<?php
                    try {
                        // database connect
                        $db = new PDO('mysql:host=localhost;dbname=kushitori;charset=utf8', 'root', '');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  


                        $stmt = $db->prepare($sql_syntax);
                        $stmt->execute();

                        //display data
                        while ($data = $stmt->fetch(PDO::FETCH_NUM)) {
                            echo "<button style='background-image: url(../images/products/$data[0].jpg);'>
                            <h2> $data[1]</h2>
                             <hr>
                             <h3> $data[2]¥</h3>
                             </button>";
                        }
                        $db = null;
                    } catch (PDOException $e) {
                        print('database not connected ' . $e->getMessage());
                    } catch (Exception $e) {
                        print('予期せぬerorr ' . $e->getMessage());
                    }
                    ?>
                </div>