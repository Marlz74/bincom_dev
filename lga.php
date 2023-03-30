<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEARCH POLLING UNIT :: BINCOM</title>
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
        <div class="filter-wrap flex-btw border">
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
        <div class="table">
            <table>
                <caption><h2>Election Result</h2></caption>
                <thead>
                    <tr>
                        <th>Polling Unit</th>
                        <th>Party</th>
                        <th>Result</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr>
                        <td>Polling Unit</td>
                        <td>PDP</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>Polling Unit</td>
                        <td>PDP</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>Polling Unit</td>
                        <td>PDP</td>
                        <td>500</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>