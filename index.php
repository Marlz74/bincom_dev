<?php require "module.php"; ?>
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
    <div class="model-container flex-center-colum overlay hide" >
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
                <?php 
                $query=new query();
                $sql='SELECT * FROM `states`';
                $query->prepareQuery($sql,'','');
                $result=json_decode($query->executeSelect());
                foreach ($result as $key => $value) {?>
                    <option value="<?=$result[$key]->state_id;?>"><?=$result[$key]->state_name;?></option>
                <?php
                }
                ?>
            </select>
            <select name="lga" id="lga" disabled>
                <option value="" selected disabled>Choose LGA</option>
                <option value="Uruan">Uruan</option>
                <option value="Uruan">Uruan</option>
                <option value="Uruan">Uruan</option>
                <option value="Uruan">Uruan</option>
            </select>
            <input type="text" name="punit" placeholder="Enter Polling Unit">
            
        </div>
        <div class="table">
            <table>
                <caption><h2>Election Result</h2></caption>
                <thead>
                    <tr>
                        <th>Party</th>
                        <th>Result</th>
                    </tr> 
                </thead>
                <tbody>
                    <tr>
                        <td>PDP</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>PDP</td>
                        <td>500</td>
                    </tr>
                    <tr>
                        <td>PDP</td>
                        <td>500</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <script src="module.js"></script>
    <script>
        function handleResponse(res){
            console.log(res)
        }
        let initail_value='';
        var SelectTags =document.querySelectorAll('select');
        SelectTags[0].onmouseleave=(e)=>{
            if(e.target.tagName!='SELECT'){
                return false;
            }
            let selected=SelectTags[0][SelectTags[0].selectedIndex].value;

            if(selected!='' && initail_value!=selected){
                initail_value=selected;
                ajaxCall('get','polling-result.php',{'state':selected,id:'id'},handleResponse)
            }
        }
        
    </script>

</body>
</html>