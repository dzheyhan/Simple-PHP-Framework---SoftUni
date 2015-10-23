<!DOCTYPE html>
<html>
    <head>
        <link  rel="stylesheet" href="/content/styles.css" />
        <title> <?php if(isset($this->title))
            echo htmlspecialchars($this->title);?></title>
    </head>
    
    
    <body>
        
        <header>
            <a href="/"><img src="/content/images/logo.png"><a/>
        <ul>
            <li><a href="/">Home</a> </li>
            <li><a href="/authors">Authors</a> </li>
            <?php if($this->isLoggedIn):?>
            <li><a href="/Books">Books</a> </li>
            <?php endif;?>
            <li><a href="/account">account</a> </li>
           
        </ul>
                <?php if($this->isLoggedIn): ?>
                <div id="logged-in-info">
                    <span>Hellom <?php echo $_SESSION['username'];?></span>
                    <form action="/account/logout">
                        <input type="submit" value="Logout">   
                    </form>
                </div>
                <?php endif;?>
        </header>
        
<?php include 'messages.php'; ?> 
