const user = {
    name : 'Иванов',
    birth : 2005,
    sayHello : function(){
        console.log('Hello' + this.name)
    }
};

user.sayHello();