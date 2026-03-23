let x = 2.34;
console.log(Math.floor(x)); //выведет 2, т.к. округляет до точки
console.log(Math.round(x)); //выведет 2.34, т.к. округляет по мат. правилам
console.log(Math.random(x)); //выведет случайное число в диапозоне x
console.log(Math.random()); //выведет случайное число
console.log(x.toPrecision()); //выведет 2.34; toPrecision() - возврат точного числа

function randomInt(min = 0, max){
    return Math.floor(Math.random() * (max -min++) + min);
}

console.log(randomInt(0, 36));