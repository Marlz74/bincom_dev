<?php require "module.php"; ?>
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
        <h2 class="  flex-center " style="padding-top: 2rem; padding-bottom: 1rem;">UPDATE RESULT</h2>
        <div class="form-wrap">
            
            <form action="" method="post" class="border">
                <div class="input-wrap ">
                    <select name="state" id="state">
                        <option value="" selected disabled>Choose State</option>
                        <?php
                            $query=new query();
                            $sql='SELECT * FROM `states`';
                            $query->prepareQuery($sql,'','');
                            $result=json_decode($query->executeSelect());
                            foreach ($result as $key => $value) {?> 
                                <option value="<?=$result[$key]->state_id;?>"><?=$result[$key]->state_name;?></option>
                            
                            <?php } ?>
                    </select>

                    <select name="lga" id="lga">
                        <option value="" selected disabled>Choose LGA</option>
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
<script src="module.js"></script>
    <script>
        var SelectTags =document.querySelectorAll('select'),modelContainer=document.querySelector('.model-container'),dismissBtn=document.querySelector('.dismiss button'),loader=document.querySelector('.loader'),polling_unit=document.querySelector('input'),content=document.querySelector('.content');
        var requests=new request();
        dismissBtn.onclick=()=>{
            modelContainer.classList.add('hide');
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

        function handleResponse1(res){
            if(res==false){
                content.innerHTML=`<h2 style="color:var(--fade_red);">Ward has not been uploaded</h2>`;
                modelContainer.classList.remove('hide');
                loader.classList.add('hide');
            }else{
                let option='<option value="" selected disabled>Choose Ward</option>';
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
            SelectTags[2].innerHTML='<option value="" selected disabled>Choose Ward</option>';
            let selected=SelectTags[1][SelectTags[1].selectedIndex].value;

            if(selected!='' && initail_value!=selected){
                loader.classList.remove('hide');
                lga_initail_value=selected;
                requests.ajaxCall('get','polling-result.php',{'lga':selected,get_ward:1},handleResponse1)
            }
        }
        
    </script>


</html>