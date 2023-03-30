<div class="links flex-center">
    <a href="index.php" class="active">Polling Unit Result</a>
    <a href="lga.php">LGA Result</a>
    <a href="update.php">Update Result</a>
</div>

<script>
    var url=location.pathname.split('/');
    url=url[url.length-1];
    var links=document.querySelectorAll('.links a');
    links.forEach(link=>{
        switch(url){
            case '':
                break;
            default :
            link.attributes[0].value==url?link.classList.add('active'):link.classList.remove('active');
            break;
        }
        
    })


</script>