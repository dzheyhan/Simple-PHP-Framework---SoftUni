<H1>Welcome tu HOME</H1>
<a href="/account/login">Login</a>
<a href="/account/register">Register</a>
<BUTTON id="show_books">Show-books</BUTTON>
<DIV id='books'></DIV>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<SCRIPT>
$('#show_books').on('click',function(ev){
$.ajax({
        url:'/books/showBooks',
        method:'GET'
    }) .success(function(data) {
        $('#books').html(data);
    })
    })

</script>