
function init(){
    console.log('Initializing')
}

function newAccount(){
    var subm=document.querySelector('input[type=submit]');
    var form= document.getElementsByTagName('form')[0];

    if(subm.getAttribute('value')=='Log in'){
        document.getElementById('username').value='';
        document.getElementById('password').value='';
        document.getElementById('login').style.height='550px';
        lblNumber=document.createElement('label');
        lblNumber.textContent='Serial Number';
        lblNumber.className='elementNew';
        lblNumber.setAttribute('id','lblNumber')
        inpNumber=document.createElement('input');
        inpNumber.setAttribute('type','number');
        inpNumber.setAttribute('placeholder','Enter serial number');
        inpNumber.className='elementNew';
        inpNumber.setAttribute('id','serialnumber');
        inpNumber.value='';

        lblName=document.createElement('label');
        lblName.textContent='Name';
        lblName.className='elementNew';
        inpNumber.setAttribute('id','lblname');
        inpName=document.createElement('input');
        inpName.setAttribute('type','text')
        inpName.setAttribute('placeholder','Enter your name');
        inpName.className='elementNew';
        inpName.setAttribute('id','name');
        inpNumber.value='';
        
        document.querySelector('input[type=submit]').setAttribute('value','Sign up');
        document.querySelector('h3').textContent='Sign up here';
        document.getElementsByTagName('a')[0].textContent='I already have an account';
        //form.appendChild(lblNumber);
        form.insertBefore(inpName, form.children[0]);
        form.insertBefore(lblName, form.children[0]);
        form.insertBefore(inpNumber, form.children[0]);
        form.insertBefore(lblNumber, form.children[0]);
    }else{
        document.querySelector('.elementNew').remove();
        document.querySelector('.elementNew').remove();
        document.querySelector('.elementNew').remove();
        document.querySelector('.elementNew').remove();

        document.getElementById('username').value='';
        document.getElementById('password').value='';
        document.getElementById('login').style.height='450px';
        document.querySelector('h3').textContent='Log in here';
        document.querySelector('input[type=submit]').setAttribute('value','Log in');
        document.getElementsByTagName('a')[0].textContent='Create an account';
       
    }
    
}


$(document).ready(function() {
 
}); 