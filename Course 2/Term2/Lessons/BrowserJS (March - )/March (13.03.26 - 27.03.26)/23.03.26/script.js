const button = document.querySelector('button')
const p = document.querySelector('p')
button.addEventListener('click', function(){
    alert('Button is pressed');
    p.textContent = 'Another one';
});
document.addEventListener('keydown', function(event){
    if(event.key == "1"){
        p.textContent = 'Button 1 is pressed'
    }
    if(event.key == "2"){
        p.textContent = 'Button 2 is pressed'
    }
});