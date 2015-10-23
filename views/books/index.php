<h1>Books<h1/>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            </tr>
            <?php  foreach($this->books as $book):?>
            <tr>
                <td><?php echo $book['0'] ?></td>
                <td><?php echo $book['1'] ?></td>
             </tr>
             <?php endforeach; ?> 
    </table>    
   <?php var_dump($this->pageSize); ?>
    <a href="/books/index/<?php echo $this->page-1;?>/<?php echo $this->pageSize;?>">Previus</a>
    <a href="/books/index/<?php echo $this->page+1;?>/<?php echo $this->pageSize;?>">Next</a>