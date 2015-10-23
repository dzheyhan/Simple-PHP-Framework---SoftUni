<h1>CREAT NEW AUTHOR<h1/>
    <form method="POST" action="/authors/create">
        Name:<input type="text" name="author_name">   
        <?php echo $this->getValidationError('author_name'); ?>
        <br/>
        <input type="submit" value="Create new Author">
    </form>
    
    