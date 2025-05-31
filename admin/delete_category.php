  <?php
            require_once '../config/db.php';
            
            $query = $pdo->prepare("DELETE FROM categories");
            $query->execute();
            $categories = $query->fetchAll();
            foreach ($categories as $category) {
                ?> 
                 <a href="./delete_category.php?id=<?php echo $category['id'];?>" class="btn btn-danger btn-circle btn-sm"> <i class="fas fa-trash"></i></a></td>
                      <?php
                      }
                      ?>