const signupbutton=document.getElementById('signup');
const signinbutton=document.getElementById('signin');
const signinform=document.getElementById('logpage');
const signupform=document.getElementById('regpage');

signupbutton.addEventListener('click',function(){
    signinform.style.display= "none";
    signupform.style.display="block";
});
signinbutton.addEventListener('click',function(){
    signupform.style.display="none";
    signinform.style.display="block";
});

