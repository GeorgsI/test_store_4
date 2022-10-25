console.log(1);


function  adminDellUser(e){          
         let num = e.getAttribute('data-deluser');
         console.log(num);
            
 
            let idRow = {
                id:num
            };

            //del(idRow , 'Core/deliaAdmin.php' ,'POST' );
            del(idRow , 'AdminDelit' ,'POST' );
}   
    
  
function  updateUserForm(e){ 


    let updateFrame='';

    let numUp = e.getAttribute('data-updateuser');
            
            updateFrame = document.createElement('div');  
            updateFrame.classList.add('updateWrepper');
            document.querySelector('.main').appendChild(updateFrame);
            /*document.querySelector('.updateWrepper').innerHTML = elemFormUpdate;*/

            let idRow = {
                id:numUp 
            };
            del(idRow , 'PreviewInsert' ,'POST' );
      
} 










function  updateadmin(){  
    
            
 
            let idRow = {
                id:document.querySelector("#idUser").value,
                name:document.querySelector("#name").value,
                surname:document.querySelector("#surname").value,
                patronymic:document.querySelector("#patronymic").value,
                email:document.querySelector("#email").value
            };


            del(idRow , 'InsertAdmin' ,'POST' );
            //del(idRow , 'Core/insertAdmin.php' ,'POST' );
           

} 





    
    
function closeFormUpdate(){
          
        //let formbtnupdateUserClose = document.querySelector(".form-btn-updateUserClose");
       // formbtnupdateUserClose.onclick = () => {
        document.querySelector('.updateWrepper').remove();
  //  };        
       
}


    
    
function del(data, responseFile, metod ){
    console.log(data);      
    sendRequestAdmin(data, responseFile, metod );   
}
    

    
function sendRequestAdmin(data, responseFile, metod)
{
    let xhr = new XMLHttpRequest();
    //данные формы
   
    
    //преобразуем их в JSON
    let requestJSON = JSON.stringify(data);
    console.log(typeof(requestJSON));
    
    
    xhr.open(metod, responseFile, true);
    //устанавливаем заголовок формата данных json
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = updateDocument; //имя функции обработки ответа сервера

    function updateDocument() {
        if (xhr.readyState === 4) { //проверяем статус завершения запроса - 4
            if (xhr.status === 200) { //проверяем код состояния 200 - OK
                let answerJSON = xhr.responseText;//ответ в JSON
                //парсим JSON, получаем аналог объекта PHP
                
                console.log(answerJSON);
                let answer = JSON.parse(answerJSON);
                if (answer.error) {
                    document.getElementById("autherror").innerHTML = answer.error + ": " + answer.message;
                    document.getElementById("auth").innerHTML ='';
                } 
                else if(answer.wrepperForm){
                     document.querySelector(".updateWrepper").innerHTML = answer.wrepperForm;
                }
                else {
                    document.getElementById("auth").innerHTML = answer.message;
                }
            }
        }
    }
    xhr.send(requestJSON); //посылаем данные методом POST
} 







    
    
    
    
    
    
    
    