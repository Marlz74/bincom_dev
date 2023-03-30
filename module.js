
class request{
    ajaxCall(method,url,params=[],callback){
        var xhr=new XMLHttpRequest();
        switch(method.toLowerCase()){
            case 'get':
                let searchParams=new URLSearchParams();
                for(let key in params){
                    searchParams.append(key,params[key]);
                }
                url=url+'?'+searchParams.toString();
                break;
        }
        xhr.open(method,url,true);
        xhr.onload=()=>{
            if(xhr.status==200){
                callback(xhr.responseText);
            }
        }
        switch(method.toLowerCase()){
            case 'post':
                let formData=new FormData();
                for(let key in params){
                    formData.set(key,params[key]);
                }
                xhr.send(formData);
                break ;
            default :
                xhr.send();
                break;
    
        }
    
    
    }
}
