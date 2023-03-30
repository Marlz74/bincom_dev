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
                    <select name="state" id="state" required>
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

                    <select name="lga" id="lga" required>
                        <option value="" selected disabled>Choose LGA</option>
                    </select>
                </div>
                <div class="input-wrap">
                    <select name="ward" id="ward" required>
                        <option value="" selected disabled>Choose Ward</option>
                    </select>
                    <select name="pu" id="pu" required>
                        <option value="" selected disabled>Choose Polling Unit</option>
                    </select>
                    
                </div>

                <div class="input-wrap">
                    <input type="number" name="result" placeholder="Enter Polling Unit Result" min="0" required>
                    <input type="text" name="lga" placeholder="Enter Polling Unit Name" required style="pointer-events: none;opacity:0; visibility: hidden;">
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
        var SelectTags =document.querySelectorAll('select'),modelContainer=document.querySelector('.model-container'),dismissBtn=document.querySelector('.dismiss button'),loader=document.querySelector('.loader'),polling_unit=document.querySelector('input'),content=document.querySelector('.content'),form=document.querySelector('form');
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
        function handleResponse2(res){
            if(res==false){
                content.innerHTML=`<h2 style="color:var(--fade_red);">Polling unit has not been uploaded</h2>`;
                modelContainer.classList.remove('hide');
                loader.classList.add('hide');
            }else{
                let option='<option value="" selected disabled>Choose Polling Unit</option>';
                let response=JSON.parse(res);
                for(let i=0;i<response.length;i++){
                    option+=`<option value="${response[i].uniqueid}">${response[i].polling_unit_name}</option>`;
                }
                SelectTags[3].innerHTML=option;
                SelectTags[3].disabled=false;
                loader.classList.add('hide');
            }
        }

        let initail_value,lga_initail_value,ward_initail_value='';
        
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

            if(selected!='' && lga_initail_value!=selected){
                loader.classList.remove('hide');
                lga_initail_value=selected;
                requests.ajaxCall('get','polling-result.php',{'lga':selected,get_ward:1},handleResponse1)
            }
        }
        SelectTags[2].onmouseleave=(e)=>{
            if(e.target.tagName!='SELECT'){
                return false;
            }
            SelectTags[3].innerHTML='<option value="" selected disabled>Choose Polling Unit</option>';
            let selected=SelectTags[2][SelectTags[2].selectedIndex].value;

            if(selected!='' && ward_initail_value!=selected){
                loader.classList.remove('hide');
                ward_initail_value=selected;
                requests.ajaxCall('get','polling-result.php',{'pu':selected,get_pu:1},handleResponse2)
            }
        }

        form.onsubmit=(e)=>{
            e.preventDefault();
            var xhr=new XMLHttpRequest();
             xhr.open('POST','polling-result.php',true);
             xhr.onload=()=>{
                 if(xhr.status==200){                    
                     console.log(xhr.response)
                 }
             }
             let formdata=new FormData(form);
             formdata.set('action','submit')
             
             xhr.send(formdata);
        }
        
    </script>


</html>