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
    <div class="loader overlay flex-center hide">
        <img src="spinner.gif" alt="">
    </div>
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
            <select name="lga" id="lga">
                <option value="" selected disabled>Choose LGA</option>
            </select>
        </div>
        <div class="table hide">
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
<script src="module.js"></script>
<script>
        var SelectTags =document.querySelectorAll('select'),modelContainer=document.querySelector('.model-container'),dismissBtn=document.querySelector('.dismiss button'),loader=document.querySelector('.loader'),polling_unit=document.querySelector('input'),content=document.querySelector('.content');
        var requests=new request();
        dismissBtn.onclick=()=>{
            modelContainer.classList.add('hide');
            location.reload();
        }
        function handleResponse(res){
            if(res==false){
                content.innerHTML=`<h2 style="color:var(--fade_red);">Local Government has not been uploaded</h2>`;
                modelContainer.classList.remove('hide');
                loader.classList.add('hide');
            }else{
                let option='<option value="" selected disabled>Choose LGA</option>';
                let response=JSON.parse(res);
                for(let i=0;i<response.length;i++){
                    option+=`<option value="${response[i].lga_id}">${response[i].lga_name}</option>`;
                }
                SelectTags[1].innerHTML=option;
                SelectTags[1].disabled=false;
                loader.classList.add('hide');
            }
        }
        let initail_value,lga_initail_value='';
        
        SelectTags[0].onmouseleave=(e)=>{
            if(e.target.tagName!='SELECT'){
                return false;
            }
            SelectTags[1].innerHTML='<option value="" selected disabled>Choose LGA</option>';
            let selected=SelectTags[0][SelectTags[0].selectedIndex].value;

            if(selected!='' && initail_value!=selected){
                loader.classList.remove('hide');
                initail_value=selected;
                requests.ajaxCall('get','polling-result.php',{'state':selected,get_lga:1},handleResponse)
            }
        }

        SelectTags[1].onmouseleave=(e)=>{
            if(e.target.tagName!='SELECT'){
                return false;
            }
            let selected=SelectTags[1][SelectTags[1].selectedIndex].value;

            if(selected!='' && lga_initail_value!=selected){
                loader.classList.remove('hide');
                lga_initail_value=selected;
                // pu==polling unit 
                requests.ajaxCall('get','polling-result.php',{'pu':selected,get_all_pu:1},(res)=>{
                    console.log(res)
                    if(res==false){
                        content.innerHTML=`<h2 style="color:var(--fade_red);">Result has not been uploaded for this polling unit</h2>`;
                        loader.classList.add('hide');
                        modelContainer.classList.remove('hide');
                    }else{
                        let data='';
                        let response=JSON.parse(res);
                        for(let i=0;i<response.length;i++){
                            data+=`
                            <tr>
                                <td>${response[i].polling_unit_name}</td>
                                <td>${response[i].party_abbreviation}</td>
                                <td>${response[i].party_score}</td>
                            </tr>
                            `;
                        }
                        document.querySelector('tbody').innerHTML=data;
                        loader.classList.add('hide');
                        document.querySelector('.table').classList.remove('hide');
                    }
                })
            }
        }

    
        
    </script>
</html>