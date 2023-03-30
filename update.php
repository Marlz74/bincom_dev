<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE RESULT :: BINCOM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="model.css">
</head>
<body>
    <div class="model-container flex-center-colum overlay hide">
        <div class="model-box ">
            <div class="content">
       
            </div>
            <div class="dismiss flex-center controls">
                <button>Dismiss</button>
            </div>
            <div class="controls flex-center hide">
                <button>Confirm</button> <button>Cancel</button>
            </div>

        </div>
    </div>
    <div class="container">
        <?php require "header.php";?>
        <h2 class="  flex-center " style="padding-top: 2rem; padding-bottom: 1rem;">UPDATE RESULT</h2>
        <div class="   form-wrap">
            
            <form action="" method="post" class="border">
                <div class="input-wrap">
                    <select name="state" id="state">
                        <option value="" selected disabled>Choose State</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                        <option value="Akwa Ibom">Akwa Ibom</option>
                    </select>
                    <select name="lga" id="lga">
                        <option value="" selected disabled>Choose LGA</option>
                        <option value="Uruan">Uruan</option>
                        <option value="Uruan">Uruan</option>
                        <option value="Uruan">Uruan</option>
                        <option value="Uruan">Uruan</option>
                    </select>
                </div>
                <div class="input-wrap">
                    <select name="ward" id="ward">
                        <option value="" selected disabled>Choose Ward</option>
                        <option value="Uruan">Uruan</option>
                        <option value="Uruan">Uruan</option>
                        <option value="Uruan">Uruan</option>
                        <option value="Uruan">Uruan</option>
                    </select>
                    <input type="text" name="lga" placeholder="Enter Polling Unit`">
                </div>
                <div class="input-wrap submit-wrap">
                    <input type="submit" value="Update Result">
                </div>
                


                
            </form>
        </div>


    </div>

</body>
</html>